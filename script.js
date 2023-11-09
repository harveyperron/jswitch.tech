document.addEventListener('DOMContentLoaded', function () {
  async function search() {
    const keywords = document.getElementById('keywords').value;
    const minPrice = document.getElementById('min-price').value;
    const maxPrice = document.getElementById('max-price').value;
    const freeDelivery = document.getElementById('free-delivery').checked;
    const fastDelivery = document.getElementById('fast-delivery').checked;

    const params = new URLSearchParams({
      keywords,
      minPrice,
      maxPrice,
      freeDelivery,
      fastDelivery
    });

	fetch('ebay-proxy-v2.php?' + params.toString())
    .then(response => response.json())
    .then(data => {
        console.log("Raw response data:", data);  // Log the raw response data
        displayProducts(data);
    })
    .catch(error => {
        console.error('Error:', error);
    });

  }

  function updatePriceLabel() {
    const minPrice = document.getElementById('min-price').value;
    const maxPrice = document.getElementById('max-price').value;
    document.getElementById('price-range-label').textContent = `${minPrice} - ${maxPrice}`;
  }

function displayProducts(products) {
  const resultsContainer = document.getElementById('results');
  resultsContainer.innerHTML = '';

  const template = document.getElementById('product-template').innerHTML;

  if (!Array.isArray(products)) {
    console.error('Products is not an array', products);
    return;
  }

  // Ensure there are at least 20 products
  while (products.length < 20) {
    products = products.concat(products);
  }
  products = products.slice(0, 20);

  products.forEach(product => {
    const productHtml = template
      .replace('{thumbnail}', product.thumbnail)
      .replace('{title}', product.title)
      .replace('{description}', product.description)
      .replace('{price}', product.price);

    resultsContainer.innerHTML += productHtml;
  });
}


  document.getElementById('keywords').addEventListener('keyup', function(event) {
    if (event.key === 'Enter') {
      event.preventDefault();
      search();
    }
  });

  document.getElementById('searchbutton').addEventListener('click', search);
});

