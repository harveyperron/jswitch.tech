<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jswitch's Search Engine</title>
	<meta property="og:url" content="https://jswitch.tech">
    <meta property="og:type" content="website">
    <meta property="og:title" content="Jswitch's Search Engine">
    <meta property="og:description" content="Deals on electronics">
    <meta property="og:image" content="https://jswitch.tech/jslogo.png">
    <meta property="og:image:alt" content="Jswitch">
    <meta property="og:site_name" content="Jswitch's Search Engine">

    <!-- Other Meta Tags (optional) -->
    <meta name="description" content="search engine for electronic products.">
    <meta name="keywords" content="ebay">

    <!-- Favicon (optional) -->
    <link rel="icon" href="https://jswitch.tech/jslogo.png" type="image/png">
    <script>window._epn = { campaign: 5339019424 }; </script>
    <script src="https://epnt.ebay.com/static/epn-smart-tools.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        /* Your styles here */
		a{
			text-decoration:none;
			color:black;
		}
		.product-price{
			background:yellow;
			color:black;
		}
        .product {
			max-width:300px;
            border: 1px solid #ccc;
            border-radius: 10px;
            padding: 10px;
            margin: 10px;
            display: inline-block;
        }

        .product img {
            max-width: 100px;
            max-height: 100px;
        }
		
    </style>
<?php include 'lib/jmhp.php';?>
</head>

<body>
<center>
    <div class="container">
        <div class="card">
			<div class='fhc w'>
			<img src='jslogo.png'></img>
            <h2>Welcome to Jswitch's Search Engine</h2>
			</div>
            <div class="search-form">
                <input autofocus type="text" id="searchTerm" placeholder="Enter your search term..." required>
                <button onclick="searchProducts()">Search</button>
            </div>
            <div class="results" id="results">
                <!-- Search results will appear here dynamically -->
            </div>
        </div>
    </div>

    <script>
        function searchProducts() {
            const searchTerm = document.getElementById("searchTerm").value;
            const resultsContainer = document.getElementById("results");
            resultsContainer.innerHTML = ""; // Clear previous results

            // Validate search term
            if (searchTerm.trim() === "") {
                resultsContainer.innerHTML = "<p>Please enter a valid search term.</p>";
                return;
            }

            // Make an AJAX request to your PHP script, which will forward the request to eBay API
            $.ajax({
                url: 'https://jswitch.tech/ebay-proxy.php', // Update with the actual path to your PHP script
                dataType: 'json',
                data: {
                    'OPERATION-NAME': 'findItemsByKeywords',
                    'SECURITY-APPNAME': 'JeanMich-Jswitchs-PRD-7fcc2d46c-1b092efd',
                    'RESPONSE-DATA-FORMAT': 'JSON',
                    'REST-PAYLOAD': true,
                    'keywords': searchTerm,
                    'paginationInput.entriesPerPage': 50
                },
                success: function (data) {
                    // Handle the response data and display search results
                    if (data.findItemsByKeywordsResponse && data.findItemsByKeywordsResponse[0].searchResult[0].item) {
                        const items = data.findItemsByKeywordsResponse[0].searchResult[0].item;
                        items.forEach(item => {
                            const productCard = document.createElement("div");
                            productCard.className = "product";
	productCard.innerHTML = `<center>
    <a href="${item.viewItemURL ? item.viewItemURL[0] : '#'}" target="_blank">
	<div>
        <img src="${item.galleryURL ? item.galleryURL[0] : 'no-image.jpg'}" alt="${item.title[0]}">
        <h3>${item.title[0]}</h3>
        <p class="product-description">${item.subtitle ? item.subtitle[0] : 'No description available.'}</p>
        <p class="product-price">$${parseFloat(item.sellingStatus[0].convertedCurrentPrice[0].__value__).toFixed(2)} CAD</p>
	</div>
    </a>
</center>
`;

                            resultsContainer.appendChild(productCard);
                        });
                    } else {
                        resultsContainer.innerHTML = "<p>No results found.</p>";
                    }
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    // Handle errors and log detailed information
                    console.error("API Request Failed:");
                    console.error("Status:", textStatus);
                    console.error("Error Thrown:", errorThrown);
                    resultsContainer.innerHTML = `<p>Failed to fetch results. Please try again later.</p>`;
                }
            });
        }
document.getElementById("searchTerm").addEventListener("keydown", function(event) {
    if (event.key === "Enter") {
        searchProducts();
    }
});
document.getElementById("searchTerm").value='laptop';
searchProducts();
document.getElementById("searchTerm").value='';
    </script>
</center>
</body>

</html>

