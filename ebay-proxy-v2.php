<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
// Proxy Script for eBay API Requests
putenv('EBAY_APP_ID=JeanMich-Jswitchs-PRD-7fcc2d46c-1b092efd');
require __DIR__ . '/vendor/autoload.php';
use Dotenv\Dotenv;
// Load environment variables
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->safeLoad();

// eBay Finding API endpoint
$api_endpoint = 'https://svcs.ebay.com/services/search/FindingService/v1';

// Your eBay developer application ID, fetched from environment variable
$ebay_app_id = getenv('EBAY_APP_ID');
if (!$ebay_app_id) {
    error_log("EBAY_APP_ID environment variable is not set");
    http_response_code(500); // Internal Server Error
    die(json_encode(['error' => 'Internal server error']));
}

// Validate and sanitize input
if (isset($_GET['category_id']) && !empty($_GET['category_id'])) {
    $category_id = filter_var($_GET['category_id'], FILTER_VALIDATE_INT);
    if ($category_id === false) {
        http_response_code(400);
        die(json_encode(['error' => 'Invalid category ID']));
    }
} else {
    $category_id = null;
}
if (isset($_GET['keywords']) && !empty($_GET['keywords'])) {
    $raw_keywords = $_GET['keywords'];
    $search_keywords = filter_var($raw_keywords, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    if ($search_keywords === false) {
        error_log("Failed to sanitize keywords. Raw input was: " . $raw_keywords);
        http_response_code(500); // Internal Server Error
        die(json_encode(['error' => 'Failed to process search keywords']));
    }

    error_log("Received and sanitized keywords: " . $search_keywords);
} else {
    // Handle the error appropriately if 'keywords' parameter is missing or empty
    http_response_code(400); // Bad Request
    die(json_encode(['error' => 'Missing or empty search keywords parameter']));
}

// Construct the API request URL with filters for Canada
// Construct the API request URL with filters for Canada
$request_url = "$api_endpoint?OPERATION-NAME=findItemsByKeywords" .
    "&SERVICE-VERSION=1.0.0" .
    "&SECURITY-APPNAME=$ebay_app_id" .
    "&RESPONSE-DATA-FORMAT=JSON" .
    "&REST-PAYLOAD" .
    "&GLOBAL-ID=EBAY-ENCA" .  // Specify the eBay Canada site
    "&keywords=" . urlencode($search_keywords) . // Use urlencode() to handle spaces and special characters
    "&itemFilter(0).name=AvailableTo" .
    "&itemFilter(0).value=CA"; 
    //"&itemFilter(1).name=LocatedIn" .
    //"&itemFilter(1).value=CA"; // Adding a filter to return items located in Canada


if ($category_id !== null) {
    $request_url .= "&categoryId=$category_id";
}
// Initialize cURL session
$ch = curl_init();

// Set cURL options
curl_setopt($ch, CURLOPT_URL, $request_url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; YourApplicationName/1.0; +http://yourwebsite.com)');

// Execute cURL session and get the response
$response = curl_exec($ch);

// Check for cURL errors
if (curl_errno($ch)) {
    error_log('cURL error: ' . curl_error($ch));
    http_response_code(500); // Internal Server Error
    die(json_encode(['error' => 'Internal server error']));
}

// Close cURL session
curl_close($ch);

// Set the response content type to JSON
header('Content-Type: application/json');

if (empty($response)) {
    error_log('Empty response from eBay API');
    http_response_code(500); // Internal Server Error
    die(json_encode(['error' => 'Internal server error']));
}
// Check if the response is valid JSON
json_decode($response);
if (json_last_error() !== JSON_ERROR_NONE) {
    error_log('Invalid JSON response from eBay API');
    http_response_code(500); // Internal Server Error
    die(json_encode(['error' => 'Internal server error']));
}

// Add CORS headers if necessary
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET');
header('Access-Control-Allow-Headers: Content-Type');

// Return the API response to the client
echo $response;
?>
