<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>eBay Product Search</title>
    <script>window._epn = { campaign: 5339019424 }; </script>
    <script src="https://epnt.ebay.com/static/epn-smart-tools.js"></script>
    <style>
        body { font-family: Arial, sans-serif; }
        .product { max-width:500px;border: 1px solid #ccc; padding: 20px; margin: 20px; }
        .product img { max-width: 100px; max-height: 100px; }
    </style>
</head>
<?php include "lib/jmhp.php";?>
<body>
        <form method="post">
            <label for="searchTerm">Enter search term:</label>
            <input type="text" id="searchTerm" name="searchTerm" required>
            <label for="minPrice">Min Price:</label>
<br>
            <input type="range" id="minPrice" name="minPrice" min="0" max="1000" value="0">
            <span id="minPriceOutput">0</span>
            <label for="maxPrice">Max Price:</label>
            <input type="range" id="maxPrice" name="maxPrice" min="0" max="1000" value="1000">
            <span id="maxPriceOutput">1000</span>
            <button type="submit">Search</button>
        </form>
<br>
    <div class="fhs w">

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $searchTerm = $_POST["searchTerm"];
            $minPrice = $_POST["minPrice"];
            $maxPrice = $_POST["maxPrice"];

            $url = "https://svcs.ebay.com/services/search/FindingService/v1";
            $url .= "?OPERATION-NAME=findItemsByKeywords";
            $url .= "&SERVICE-VERSION=1.0.0";
            $url .= "&SECURITY-APPNAME=JeanMich-Jswitchs-PRD-7fcc2d46c-1b092efd";
            $url .= "&RESPONSE-DATA-FORMAT=JSON";
            $url .= "&REST-PAYLOAD";
            $url .= "&keywords=" . urlencode($searchTerm);
            $url .= "&paginationInput.entriesPerPage=10";
            $url .= "&itemFilter(0).name=MinPrice&itemFilter(0).value=" . urlencode($minPrice);
            $url .= "&itemFilter(1).name=MaxPrice&itemFilter(1).value=" . urlencode($maxPrice);

            $response = file_get_contents($url);
            $data = json_decode($response, true);

            if (isset($data["findItemsByKeywordsResponse"][0]["searchResult"][0]["item"])) {
                foreach ($data["findItemsByKeywordsResponse"][0]["searchResult"][0]["item"] as $item) {
                    $title = $item["title"][0];
                    $price = $item["sellingStatus"][0]["convertedCurrentPrice"][0]["__value__"];
                    $currency = $item["sellingStatus"][0]["convertedCurrentPrice"][0]["@currencyId"];
                    $url = $item["viewItemURL"][0];
                    $image = isset($item["galleryURL"][0]) ? $item["galleryURL"][0] : "No Image Available";

                    echo "<div class='product'>
                            <img src='$image'><br>
                            <b>$title</b><br>
                            Price: $price $currency<br>
                            <a href='$url'>View Item</a>
                            </div>";
                }
            } else {
                echo "No products found for '$searchTerm'";
            }
        }
        ?>

        <script>
            const minPriceInput = document.getElementById("minPrice");
            const maxPriceInput = document.getElementById("maxPrice");
            const minPriceOutput = document.getElementById("minPriceOutput");
            const maxPriceOutput = document.getElementById("maxPriceOutput");

            minPriceInput.addEventListener("input", function() {
                minPriceOutput.textContent = minPriceInput.value;
            });

            maxPriceInput.addEventListener("input", function() {
                maxPriceOutput.textContent = maxPriceInput.value;
            });
        </script>
    </div>
</body>

</html>

