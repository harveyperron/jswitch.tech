<?php
$servername = "localhost";$username ="u853804124_u853804124_jzy";$password = "servicesFormDb2";$database="u853804124_services";$conn = mysqli_connect($servername, $username, $password, $database);if(!$conn){die("Connection failed:".mysqli_connect_error());}
$query="select * from orders where order_id=".$_GET['order_id'];
if($result = $conn-> query($query)){
    while ($row = $result->fetch_assoc()) {
        $requested_services=json_decode($row["requested_services"]);
        $appointment_datetime=$row["appointment_datetime"];
        $client_address=$row["client_address"];
        $client_address2=$row["client_address2"];
        $client_city=$row["client_city"];
        $client_province=$row["client_province"];
        $client_postalcode=$row["client_postalcode"];
        $client_firstname=$row["client_firstname"];
        $client_lastname=$row["client_lastname"];
        $client_email=$row["client_email"];
        $client_phone=$row["client_phone"];
        $order_price=$row["order_price"];
        $filing_datetime=$row["filing_datetime"];
        $order_paid=$row["order_paid"];
		$tax_rate=$row["tax_rate"];
		$order_tax=$row["order_tax"];
		$stripe_total=100*($order_price+$order_tax);
	}
}
$conn->close();
echo "Order total: CAD".$order_price;
echo "<br>";
echo "Taxes : CAD".$order_tax;
echo "<br>";
echo "Total: CAD".$stripe_total/100;
echo "<br>";
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script src="https://js.stripe.com/v3/"></script>

<script>
const queryString = window.location.search;
const urlParams = new URLSearchParams(queryString);
const client_secret = urlParams.get('client_secret')
// Replace 'your_client_secret' with the actual client secret you obtained from the Payment Intent
var clientSecret = client_secret;

// Call Stripe.js library with your publishable key
var stripe = Stripe('pk_test_51MoIdhJO5OCfeChimGE7JQpGWwKoxMLHHLIebgMvNFQE0hQ9jrJ01JvbGGxyllcH4rjUbgJTBBnWnULUmlfIJ04e00fmGkA2Vi');

// Use the client secret to retrieve the Payment Intent object
stripe.retrievePaymentIntent(clientSecret).then(function(result) {
  var paymentIntent = result.paymentIntent;

  // Use Stripe's pre-built checkout page to process the payment
  stripe.redirectToCheckout({
    sessionId: paymentIntent.id
  }).then(function(result) {
    // If redirectToCheckout fails, display an error message to the customer
    console.error(result.error.message);
  });
});

  </script>
