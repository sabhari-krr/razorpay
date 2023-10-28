<?php
require('config.php');
require('razorpay-php/Razorpay.php');
session_start();
error_reporting(0);
// Create the Razorpay Order

use Razorpay\Api\Api;

$api = new Api($keyId, $keySecret);

//
// We create an razorpay order using orders api
// Docs: https://docs.razorpay.com/docs/orders
//
$price = $_POST['ipPlan'];
$_SESSION['ipPlan'] = $price;
$customername = $_POST['ipname'];
$_SESSION['ipname'] = $customername;
$email = $_POST['ipemail'];
$_SESSION['ipemail'] = $email;
$address = $_POST['ipAddress'];
$_SESSION['ipAddress'] = $address;
$contactno = $_POST['ipMobile'];
$_SESSION['ipMobile'] = $contactno;
$gender = $_POST['ipGender'];
$_SESSION['ipGender'] = $gender;
$zip = $_POST['ipZip'];
$_SESSION['ipZip'] = $zip;

$orderData = [
  'receipt'         => 3456,
  'amount'          => $price * 100, // 2000 rupees in paise
  'currency'        => 'INR',
  'payment_capture' => 1 // auto capture
];

$razorpayOrder = $api->order->create($orderData);

$razorpayOrderId = $razorpayOrder['id'];

$_SESSION['razorpay_order_id'] = $razorpayOrderId;

$displayAmount = $amount = $orderData['amount'];

if ($displayCurrency !== 'INR') {
  $url = "https://api.fixer.io/latest?symbols=$displayCurrency&base=INR";
  $exchange = json_decode(file_get_contents($url), true);

  $displayAmount = $exchange['rates'][$displayCurrency] * $amount / 100;
}

$data = [
  "key"               => $keyId,
  "amount"            => $amount,
  "name"              => $customername,
  "description"       => $price . " rupees plan",
  "image"             => "https://static.wixstatic.com/media/80d629_1f002c8ba3a8402bac2de7a9a591aed9~mv2.png/v1/crop/x_84,y_103,w_416,h_296/fill/w_134,h_95,al_c,q_85,usm_0.66_1.00_0.01,enc_auto/80d629_1f002c8ba3a8402bac2de7a9a591aed9~mv2.png",
  "prefill"           => [
    "name"              => $customername,
    "email"             => $email,
    "contact"           => $contactno,
  ],
  "notes"             => [
    "address"           => "Karur",
    "merchant_order_id" => "Ms9llf",
  ],
  "theme"             => [
    "color"             => "#F37254"
  ],
  "order_id"          => $razorpayOrderId,
];

if ($displayCurrency !== 'INR') {
  $data['display_currency']  = $displayCurrency;
  $data['display_amount']    = $displayAmount;
}

$json = json_encode($data);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Confirm Payment</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  <style>
    body {
      background-color: #8EC5FC;
      background-image: linear-gradient(62deg, #8EC5FC 0%, #E0C3FC 100%);
    }

    .rightcontainer {
      background: rgba(255, 255, 255, 0.25);
      box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
      backdrop-filter: blur(4px);
      -webkit-backdrop-filter: blur(4px);
      border-radius: 10px;
      border: 1px solid rgba(255, 255, 255, 0.18);
    }

    .razorpay-payment-button {
      background-color: #4CAF50;
      /* Green */
      color: white;
      padding: 15px 32px;
      text-align: center;
      text-decoration: none;
      display: inline-block;
      font-size: 26px;
      border-radius: 12px;
      border: 0px;
    }
  </style>
</head>

<body class="container d-flex justify-content-center align-items-center vh-100 my-auto">

  <form action="verify.php" method="POST">
    <script src="https://checkout.razorpay.com/v1/checkout.js" data-key="<?php echo $data['key'] ?>" data-amount="<?php echo $data['amount'] ?>" data-currency="INR" data-name="<?php echo $data['name'] ?>" data-image="<?php echo $data['image'] ?>" data-description="<?php echo $data['description'] ?>" data-prefill.name="<?php echo $data['prefill']['name'] ?>" data-prefill.email="<?php echo $data['prefill']['email'] ?>" data-prefill.contact="<?php echo $data['prefill']['contact'] ?>" data-notes.shopping_order_id="3456" data-order_id="<?php echo $data['order_id'] ?>" <?php if ($displayCurrency !== 'INR') { ?> data-display_amount="<?php echo $data['display_amount'] ?>" <?php } ?> <?php if ($displayCurrency !== 'INR') { ?> data-display_currency="<?php echo $data['display_currency'] ?>" <?php } ?>>
    </script>
    <!-- Any extra fields to be submitted with the form but not sent to Razorpay -->
    <input type="hidden" name="shopping_order_id" value="3456">
  </form>
</body>

</html>