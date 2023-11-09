<?php
require_once('vendor/autoload.php');
\Stripe\Stripe::setApiKey('sk_test_51MoIdhJO5OCfeChiVE1Ua91vFQWumGwLfCnvf2E6PCAd0gapqv4yBl0X2iRVL9xhD5rRs3DT3qXt9JFPsQY0UoLV00gJ9q4bRT');
$intent = \Stripe\PaymentIntent::create([
  'amount' => $total_to_pay*100,
  'payment_method' => 'pm_card_visa',
  'currency' => 'cad',
]);
$intent->confirm();
echo json_encode(array('client_secret' => $intent->client_secret));

?>
