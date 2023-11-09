<?php
$amount=$_GET['amount'];
$project_name=urldecode($_GET['project_name']);
$ordered_services = array();
$new_content=array(
	'price_data' => array(
		'currency' => 'cad',
		'unit_amount' => 100 * $amount,
		'product_data' => array('name' => $project_name),
	),
'quantity' => 1,
);
array_push($ordered_services,$new_content);
require_once('stripe_package/stripe-php-10.13.0-beta.4/init.php');
\Stripe\Stripe::setApiKey('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');
header('Content-Type: application/json');
$checkout_session = \Stripe\Checkout\Session::create([
  'success_url' => 'https://jswitch.tech?stripe_succeed=1',
  'cancel_url' => 'https://jswitch.tech?stripe_succeed=0',
  'payment_method_types' => ['card'],
  'mode'=>'payment',
  'line_items' => $ordered_services,
]);
echo json_encode(['sessionId' => $checkout_session->id]);
?>
