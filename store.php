<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jswitch's search engine</title>
    <script>window._epn = { campaign: 5339019424 }; </script>
    <script src="https://epnt.ebay.com/static/epn-smart-tools.js"></script>
    <style>
    :root{background:black;}    
	body { background:url('https://scontent-yyz1-1.xx.fbcdn.net/v/t39.30808-6/392928037_122104203308079941_9148054450554028701_n.png?_nc_cat=102&ccb=1-7&_nc_sid=5f2048&_nc_ohc=Zrs3X8j38FgAX9TVvg_&_nc_ht=scontent-yyz1-1.xx&oh=00_AfCB2lHqn-WGcC04Mpp_JdER2VL3jJSxxOg02WUGCK2rZQ&oe=65445EC1');
	background-size:100%;
	background-position:center center;
    background-attachment: fixed;
	color:white;
    font-family: 'Georgia', serif; /* Elegant serif font */
    font-size: 16px; /* Base font size */
    line-height: 1.6; /* Line height for readability */
}
		a{text-decoration:none;color:white;}
	.price{
		font-weight:bold;
		background:yellow;
		color:black;
	}
     .card{ 
		border-radius:17px;
		border: 1px solid #ccc;
		background:rgba(1,1,1,.7);
		padding: 20px; margin: 20px; 
		transition:.3s;}

        .product { 
		border-radius:17px;
		max-width:200px;border: 1px solid #ccc;
		background:rgba(1,1,1,.7);
		padding: 20px; margin: 20px; 
		transition:.3s;
}
		.product:hover{
			background:white;
			color:black;
		}
		.texte{
		text-align:justify;
		}
        .product img { 

		border-radius:0px;
max-width: 100px; max-height: 100px; }
    </style>
</head>
<?php include "lib/jmhp.php";?>
<body>
<center>
<div id=intro_section class="card fhs w">
<img style="height:50px;width:50px;border-radius:100%;" src='https://scontent-yyz1-1.xx.fbcdn.net/v/t39.30808-1/392958307_122102814638079941_8227325382732676759_n.jpg?stp=c10.0.166.166a_dst-jpg&_nc_cat=101&ccb=1-7&_nc_sid=5f2048&_nc_ohc=y66xqob6NEYAX8PlF1y&_nc_ht=scontent-yyz1-1.xx&oh=00_AfCgqrOH9zzl54Rw8WzTbKvVYDe-UbQ6OWIH1p80oQv-eg&oe=654485AA'></img>
<div class=texte>
&nbsp
&nbsp
&nbsp
&nbsp
Bienvenue sur notre nouvelle application web (en développement)!
Les suggestions fonctionnent et les produits sont à jour en rafraichissant la page. Mais le moteur de recherche reste encore défaillant. Je devrai encore continuer de fouetter chatGPT pour me faire un meilleur code :P Bref je fais des tests <a href="https://jswitch.tech/story.php">ici</a>
</div>
</div>

	<div id=search_section class=card>
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
</div>
	</div>


        <?php
		//Suggestion section:
        $categories = ["Laptop", "PC", "Smartphone", "Smart TV", "e-bike","gaming console","smart home"];
        foreach ($categories as $category) {
            $url = "https://svcs.ebay.com/services/search/FindingService/v1";
            $url .= "?OPERATION-NAME=findItemsByKeywords";
            $url .= "&SERVICE-VERSION=1.0.0";
            $url .= "&SECURITY-APPNAME=JeanMich-Jswitchs-PRD-7fcc2d46c-1b092efd";
            $url .= "&RESPONSE-DATA-FORMAT=JSON";
            $url .= "&REST-PAYLOAD";
            $url .= "&keywords=" . urlencode($category);
            $url .= "&paginationInput.entriesPerPage=12";

            $response = file_get_contents($url);
            $data = json_decode($response, true);

            if (isset($data["findItemsByKeywordsResponse"][0]["searchResult"][0]["item"])) {
                echo "<div class='card'><h3>{$category}s</h3><div class='fhs w'>";
                foreach ($data["findItemsByKeywordsResponse"][0]["searchResult"][0]["item"] as $item) {
                    $title = $item["title"][0];
                    $price = $item["sellingStatus"][0]["convertedCurrentPrice"][0]["__value__"];
                    $currency = $item["sellingStatus"][0]["convertedCurrentPrice"][0]["@currencyId"];
                    $url = $item["viewItemURL"][0];
                    $image = isset($item["galleryURL"][0]) ? $item["galleryURL"][0] : "No Image Available";
if ($currency === "USD") {
                    // Convert USD to CAD (Canadian Dollars)
                    $price = round($price * 1.31, 2);
                    $currency = "CAD";
                }
                    echo "
                            <a href='$url'>
<div class='product'>
                            <img src='$image'><br>
                            <div class=price>$price $currency</div>
                            $title<br>
                            </div></a>";
                }
				echo "</div></div>";
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
Jswitch&copy 2023
</center>
</body>

</html>
