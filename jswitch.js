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

