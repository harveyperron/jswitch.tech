<!DOCTYPE html>
<html lang="en">
<head>
	<title>
		Boutique Jswitch
	</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Boutique Jswitch</title>
	<meta property="og:url" content="https://jswitch.tech">
    <meta property="og:type" content="website">
    <meta property="og:title" content="Boutique Jswitch">
    <meta property="og:description" content="Trouver ce que vous cherchez">
    <meta property="og:image" content="https://jswitch.tech/jslogo.png">
    <meta property="og:image:alt" content="Jswitch">
    <meta property="og:site_name" content="Boutique Jswitch">
    <meta name="author" content="Jean Harvey">
    <meta name="description" content="Deal Magnet for electronic products">
    <meta name="keywords" content="tv,smartphones, mobile phone,computers,smartwatches,pc,laptopsi,website, products, services, online store">
    <link rel="icon" href="https://jswitch.tech/jslogo.png" type="image/png">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@100;400&display=swap" rel="stylesheet">
<script>window._epn = {campaign: 5339019424};</script>
<script src="https://epnt.ebay.com/static/epn-smart-tools.js"></script>
    <style>
#colorisCurtain{
	display:none;
	width:100vw;
	height:100vh;
	position:fixed;
	background:rgba(1,1,1,.6);
	top:0;
	left:0;
	z-index:2;
}
#categoriesMenu{
	z-index:3;
	left:50%;
	top:50%;
	transform:translate(-50%);
}
/* Style for the submenu */
.categories-submenu {
    position: absolute;
    background-color: #f9f9f9;
    min-width: 160px;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    z-index: 1;
}

/* Style for the submenu items */
.categories-submenu .nav-item {
    color: black;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
}

/* Change color on hover */
.categories-submenu .nav-item:hover {
    background-color: #f1f1f1;
}
		.product_image{
			width:60%;
		}
		.price{
			padding:1vh;
			background:#b50202;
			color:#f0ce9c;
			width:min-content;
			white-space:nowrap;
			font-weight:bold
		}
		a{
			text-decoration:none;
			color:black;
		}
        .product:hover {
		background:white;
			box-shadow:0 0 13px black;
            border: 1px solid black;
		
	}
        .product {
			max-width:300px;
            border: 1px solid darkgrey;
			border-radius:2px;
			box-shadow:-3px 3px 3px grey;
            padding: 10px;
            margin: 10px;
            display: inline-block;
        }
	.nav-item:hover{
		color:white;
			background:#b50202;
		
	}
	.nav-item{
		cursor:pointer;
		text-shadow:.5px 0.5px 3px black;
		margin:2vw;
		padding:1vh;
		font-weight:bold;
		color:#edbf18;
	}
	#topbar{
		text-shadow:-1px 1px 1px black;
		box-shadow:3px 3px 17px black;
		background:linear-gradient(to right,black,#022cb5);
		color:#fca903;
		margin:0;
		padding:1vw;
		position:fixed;
		width:98vw;
		left:0;
	}
	body{
		padding:0;
		margin:0;
	}
	:root{
		margin:0;
		background:#fca903;
		background:white;
		padding:0;
		font-family: 'Roboto Slab', serif;
	}
	#logo{
		color:white;
	}
.nav-off{
  transform: translateY(0);
  transition: transform 0.7s;
}
.nav-scrolled {
  transform: translateY(-100%);
  transition: transform 0.7s;
}
.divulgation{
	font-size:1.3vh;
	padding:1vw;
}
  #search-container {
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    display: flex;
    border-radius: 25px;
    overflow: hidden;
  }

  #keywords {
    padding: 10px 20px;
    border: none;
    outline: none;
    font-size: 16px;
    border-radius: 25px 0 0 25px;
    flex-grow: 1;
  }

  #searchbutton {
    padding: 10px 20px;
    border: none;
    background-color: #007BFF;
    color: white;
    font-size: 16px;
    cursor: pointer;
    border-radius: 0 25px 25px 0;
    transition: background-color 0.3s ease;
  }

  #searchbutton:hover {
    background-color: #0056b3;
  }
    </style>
<?php include "visitors_data.php";?>
<?php include "lib/jmhp.php";?>
</head>
<body>
<center>
<div id=topbar class="fhb w topbar">
	<a id=logo href="https://jswitch.tech"  class="fhc w">
		<div class="fvc">
		<img style="width:50px;height:50px;" src='jslogo.png'></img>
    	</div>
		<div class="fvc">
		&nbspjswitch.tech
    	</div>
    </a>

<div id=colorisCurtain></div>
<!-- Submenu for categories, initially hidden -->
<div id="categoriesMenu" class="categories-submenu navbar" style="display: none;">
    <div rel="smart tv" class="nav-item">Télévisions</div>
    <div rel="phone mobile" class="nav-item">Téléphones</div>
    <div rel="laptop deal windows" class="nav-item">Laptops</div>
    <div rel="PC" class="nav-item">PCs</div>
    <div rel="Chromebook" class="nav-item">Chromebooks</div>
    <div rel="smart watch" class="nav-item">Smartwatches</div>
    <div rel="ebike" class="nav-item">Ebikes</div>
    <div rel="fpv drone" class="nav-item">Drones</div>
</div>
<button id="categoriesButton" class="fvc w">Categories</button>
<div class="fvc">
    	<div id="search-container">
    	    <input autofocus type="text" id="keywords" placeholder="Search...">
    	    <button id="searchbutton">Search</button>
    	</div>
    </div>
	</div>

<div id=top_spacer style='height:30vh;'></div>
<div class=divulgation>
* Affiliation Amazon et Ebay: Les liens sont comissionnés. Celà n'affecte pas les prix.
</div>
    <div id="results" class="fhc w results-container"></div>

<script type="text/template" id="product-template">
	<a href="{listing_url}">
    <div class="fvb w product">
        <div class="fhb w">
           	<div class='f3'>État: {condition}</div>
           	<div class="fvc f1 price">{price}</div>
		</div>
        <div class="fhc">
       	<img class='product_image' src="{thumbnail}" alt="No image provided"></img>
		</div>
       	<h3>{title}</h3>
    </div>
	</a>
</script>
</center>
</body>
<script>
// Get the button and the submenu
var categoriesButton = document.getElementById('categoriesButton');
var categoriesMenu = document.getElementById('categoriesMenu');

// Toggle submenu on button click
categoriesButton.onclick = function(event) {
    // Prevent clicks on the button from being captured by the document
    event.stopPropagation();
    // Toggle the display of the submenu
    categoriesMenu.style.display = categoriesMenu.style.display === 'block' ? 'none' : 'block';
	document.getElementById('colorisCurtain').style.display='block';
};

var colorisCurtain=gid('colorisCurtain');
// Hide submenu when clicking anywhere else on the document
colorisCurtain.onclick = function(event) {
    // If the clicked element is not the menu or the button, hide the menu
    if (!categoriesMenu.contains(event.target) && event.target !== categoriesButton) {
        categoriesMenu.style.display = 'none';
		document.getElementById('colorisCurtain').style.display='none';
    }
};

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
   function convert_links(){
      var head= document.getElementsByTagName('head')[0];
      var script= document.createElement('script');
      script.src= 'https://epnt.ebay.com/static/epn-smart-tools.js';
      head.appendChild(script);
   }
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
convert_links();
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
        .replace(/\{condition\}/g, product.condition[0]['conditionDisplayName']).replace(/Refurbished/g,'Refurbished &#9851; &#65039') // Provide a default value
        .replace(/\{price\}/g, 'CA$ ' + product.sellingStatus[0].convertedCurrentPrice[0].__value__);
      resultsContainer.innerHTML += productHtml;
		categoriesMenu.style.display = 'none';
		document.getElementById('colorisCurtain').style.display='none';

window._epn = {campaign: 5339019424};
    });
  } else {
    console.error('Products is not an array', products);
    resultsContainer.innerHTML += "<br><br>Aucun produit trouvé.";
  }
}
var topbar= document.getElementById("topbar");
var top_spacer=document.getElementById("top_spacer");
var topbar_height= topbar.offsetHeight;
top_spacer.style.height = topbar_height+ "px";
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

let prevScrollPos = window.pageYOffset;
var topbar=gid('topbar');
window.addEventListener('scroll', () => {
  const currentScrollPos = window.pageYOffset;
	if(currentScrollPos>=50){
  
  if (prevScrollPos > currentScrollPos) {
    topbar.classList.remove('nav-scrolled');
    topbar.classList.add('nav-off');
  } else {
    topbar.classList.add('nav-scrolled');
    topbar.classList.remove('nav-off');
  }
  
  prevScrollPos = currentScrollPos;
	}
});
    </script>
</html>

