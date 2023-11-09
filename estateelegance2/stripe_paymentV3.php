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
<script src="https://checkout.stripe.com/checkout.js" class="stripe-button active" data-key="pk_test_TzcRBxsPAsRFUBfvpkQr1Lgj" data-amount="999" data-name="Demo Site" data-description="Widget" data-image="https://stripe.com/img/documentation/checkout/marketplace.png" data-locale="auto" data-notrack=""></script>
<form action="" method="POST">
  <script
    src="https://checkout.stripe.com/checkout.js" class="stripe-button"
    data-key="pk_test_51MoIdhJO5OCfeChimGE7JQpGWwKoxMLHHLIebgMvNFQE0hQ9jrJ01JvbGGxyllcH4rjUbgJTBBnWnULUmlfIJ04e00fmGkA2Vi"
    data-amount="<?php echo $stripe_total;?>"
    data-name="Estate Elegance"
    data-description="custom services"
    data-image="https://estateelegance.com/wp-content/uploads/2023/03/9-1920x1281.jpg"
    data-locale="auto">
  </script>
</form>
