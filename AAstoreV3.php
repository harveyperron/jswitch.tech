<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jswitch's search engine</title>
    <script>window._epn = { campaign: 5339019424 }; </script>
    <script src="https://epnt.ebay.com/static/epn-smart-tools.js"></script>
    <style>
        body { background:black;color:white;font-family: Arial, sans-serif; }
		a{text-decoration:none;color:white;}
        .product { 
		max-width:500px;border: 1px solid #ccc; padding: 20px; margin: 20px; }
		.product:hover{
border: 1px solid black; 
		}
        .product img { max-width: 100px; max-height: 100px; }
    </style>
</head>
<?php include "lib/jmhp.php";?>
<body>
        <form method="post">
            <label for="searchTerm">Search</label>
            <input type="text" id="searchTerm" name="searchTerm" required>
            <button type="submit">Search</button>
            <label for="minPrice">Min $</label>
            <input type="range" id="minPrice" name="minPrice" min="0" max="8000" value="0">
            <span id="minPriceOutput">0</span>
            <label for="maxPrice">Max $</label>
            <input type="range" id="maxPrice" name="maxPrice" min="0" max="8000" value="8000">
            <span id="maxPriceOutput">8000</span>
        </form>


        <?php
        $categories = ["laptop", "pc", "smartphone", "smart tv", "strange electronics"];
        foreach ($categories as $category) {
            $url = "https://svcs.ebay.com/services/search/FindingService/v1";
            $url .= "?OPERATION-NAME=findItemsByKeywords";
            $url .= "&SERVICE-VERSION=1.0.0";
            $url .= "&SECURITY-APPNAME=JeanMich-Jswitchs-PRD-7fcc2d46c-1b092efd";
            $url .= "&RESPONSE-DATA-FORMAT=JSON";
            $url .= "&REST-PAYLOAD";
            $url .= "&keywords=" . urlencode($category);
            $url .= "&paginationInput.entriesPerPage=3";

            $response = file_get_contents($url);
            $data = json_decode($response, true);

            if (isset($data["findItemsByKeywordsResponse"][0]["searchResult"][0]["item"])) {
                echo "<h3>$category</h3><div class='fhs w'>";
                foreach ($data["findItemsByKeywordsResponse"][0]["searchResult"][0]["item"] as $item) {
                    $title = $item["title"][0];
                    $price = $item["sellingStatus"][0]["convertedCurrentPrice"][0]["__value__"];
                    $currency = $item["sellingStatus"][0]["convertedCurrentPrice"][0]["@currencyId"];
                    $url = $item["viewItemURL"][0];
                    $image = isset($item["galleryURL"][0]) ? $item["galleryURL"][0] : "No Image Available";

                    echo "
                            <a href='$url'>
<div class='product'>
                            <img src='$image'><br>
                            <b>$price $currency</b><br>
                            $title<br>
                            </div></a>";
                }
				echo "</div>";
            } else {
                echo "<p>No products found for '$category'</p>";
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
</body>

</html>

