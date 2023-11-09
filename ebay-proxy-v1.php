<?php
header("Access-Control-Allow-Origin: *"); // Allow requests from any origin (CORS)
header("Content-Type: application/json");

// eBay API endpoint
$apiEndpoint = "https://svcs.ebay.com/services/search/FindingService/v1";

// Extract the request parameters from the query string
$queryString = $_SERVER['QUERY_STRING'];

// Make a request to eBay API
$response = file_get_contents("$apiEndpoint?$queryString");

// Forward eBay API response to the client
echo $response;
?>
