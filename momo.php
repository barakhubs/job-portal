<?php
require_once('./lib/Beyonic.php');
Beyonic::setApiKey("ab594c14986612f6167a975e1c369e71edab6900");

$payment = Beyonic_Payment::create(array(
  "phonenumber" => "+80000000001",
  "first_name" => "Kennedy",
  "last_name" => "Kennedy",
  "amount" => "100.2",
  "currency" => "BXC",
  "description" => "Per diem payment",
  "payment_type" => "money",
  "callback_url" => "https://my.website/payments/callback",
  "metadata" => array("id"=>"1234", "name"=>"Lucy")
));

print_r($payment);  // Examine the returned object
?>