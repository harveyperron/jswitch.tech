<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Boutique Jswitch</title>
	<meta property="og:url" content="https://jswitch.tech">
    <meta property="og:type" content="website">
    <meta property="og:title" content="Boutique Jswitch">
    <meta property="og:condition" content="Deals on electronics">
    <meta property="og:image" content="https://jswitch.tech/jslogo.png">
    <meta property="og:image:alt" content="Jswitch">
    <meta property="og:site_name" content="Boutique Jswitch">

    <!-- Other Meta Tags (optional) -->
    <meta name="condition" content="search engine for electronic products.">
    <meta name="keywords" content="ebay">

    <!-- Favicon (optional) -->
    <link rel="icon" href="https://jswitch.tech/jslogo.png" type="image/png">
    <script>window._epn = { campaign: 5339019424 }; </script>
    <script src="https://epnt.ebay.com/static/epn-smart-tools.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
		.nav-item{
			margin:2vw;
			font-weight:bold;
		}
		.price{
			background:#b50202;
			color:white;
		}
		a{
			text-decoration:none;
			color:black;
		}
        .product:hover {
		background:white;
	}
        .product {
			max-width:300px;
            border: 1px solid black;;
            padding: 10px;
            margin: 10px;
            display: inline-block;
        }

        .product img {
            max-width: 100px;
            max-height: 100px;
        }
	.nav-item:hover{
		color:white;
			background:#b50202;
		
	}
	.nav-item{cursor:pointer;}
	.topbar{
		background:#022cb5;
		color:#fca903;
		margin:0;
		margin:0;
		padding:3vh;
	}
	body{
		padding:0;
		margin:0;
	}
	:root{
		margin:0;
		background:#fca903;
		padding:0;
	}
	#logo{color:white;
	font-weight:bold;
}
    </style>
<?php include "lib/jmhp.php";?>
</head>
<body>
<center>
<div class="topbar">

	<a id=logo href="https://jswitch.tech"  class="fhc w">
		<div class="fvc">
		<img style="width:50px;height:50px;" src='jslogo.png'></img>
    	</div>
		<div class="fvc">
		&nbspjswitch.tech
    	</div>
    </a>


	<div class="fhc w navbar">
        <div rel="smart tv" class="nav-item">Télévisions</div>
        <div rel="smartphone" class="nav-item">Téléphone</div>
        <div rel="Windows laptop" class="nav-item">Laptop(windows)</div>
        <div rel="Chromebook" class="nav-item">Chromebook</div>
        <div rel="computer" class="nav-item">PC de bureau</div>
        <div rel="smart watch" class="nav-item">Montres</div>
        <div rel="ebike" class="nav-item">Vélos</div>
        <div rel="fpv drone" class="nav-item">Drones</div>
    </div>

<div class="fvc">
    	<div id="search-container">
    	    <input autofocus type="text" id="keywords" placeholder="Search...">
    	    <button id="searchbutton">Search</button>
    	</div>
    </div>
	</div>

    <div id="results" class="fhc w results-container"></div>
</center>
</body>

    <script type="text/template" id="product-template">
		<a href="{listing_url}">
        <div class="fhc w product">
            <img src="{thumbnail}" alt="{title}">
            <div class="fvc w product-info">
                <h3>{title}</h3>
                <div>État: {condition}</div>
                <div class="price">{price}</div>
            </div>
        </div>
		</a>
</script>
<script>
var keywords="";
document.getElementById("keywords").addEventListener("keydown", function(event) {
   	if(event.key === "Enter") {
	    keywords = document.getElementById('keywords').value;
   	    searchProducts(keywords);
   	}
});
document.getElementById('searchbutton').addEventListener('click', function() {
  	keywords = document.getElementById('keywords').value;
	searchProducts(keywords);
});
function searchProducts(keywords) {
    fetch(`https://jswitch.tech/ebay-proxy-v2.php?keywords=${encodeURIComponent(keywords)}`)
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok ' + response.statusText);
        }
        return response.text();
    })
    .then(text => {
        console.log(text);  // Log the raw response text
        return JSON.parse(text);
    })
    .then(data => {
        console.log(data);
        displayProducts(data);
        // Your existing code to handle the data
    })
    .catch(error => {
        console.error('Error:', error);
    });
}

function displayProducts(data) {
  const resultsContainer = document.getElementById('results');
  resultsContainer.innerHTML = '';

  const template = document.getElementById('product-template').innerHTML;

  // Accessing the products array from the eBay API response
  const products = data.findItemsByKeywordsResponse[0].searchResult[0].item;

  if (Array.isArray(products)) {
    products.forEach(product => {
      const productHtml = template
        .replace(/\{listing_url\}/g, product.viewItemURL)
        .replace(/\{thumbnail\}/g, product.galleryURL[0])
        .replace(/\{title\}/g, product.title[0])
        .replace(/\{condition\}/g, product.condition[0]['conditionDisplayName']) // Provide a default value
        .replace(/\{price\}/g, 'CA$ ' + product.sellingStatus[0].convertedCurrentPrice[0].__value__);
      resultsContainer.innerHTML += productHtml;
    });
  } else {
    console.error('Products is not an array', products);
    resultsContainer.innerHTML += "<br><br>Aucun produit trouvé.";
  }
}
window.onload=
searchProducts('smart tv refurbished');
document.addEventListener('DOMContentLoaded', (event) => {
    const navItems = document.querySelectorAll('.navbar .nav-item');
    navItems.forEach(item => {
        item.addEventListener('click', function() {
            searchProducts(this.getAttribute('rel'));
        });
    });
});

    </script>
</html>

