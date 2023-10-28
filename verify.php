<?php

require('config.php');
session_start();
//db connection
$conn = mysqli_connect($host, $username, $password, $dbname);

require('razorpay-php/Razorpay.php');

use Razorpay\Api\Api;
use Razorpay\Api\Errors\SignatureVerificationError;

$success = true;

$error = "Payment Failed";

if (empty($_POST['razorpay_payment_id']) === false) {
    $api = new Api($keyId, $keySecret);

    try {
        // Please note that the razorpay order ID must
        // come from a trusted source (session here, but
        // could be database or something else)
        $attributes = array(
            'razorpay_order_id' => $_SESSION['razorpay_order_id'],
            'razorpay_payment_id' => $_POST['razorpay_payment_id'],
            'razorpay_signature' => $_POST['razorpay_signature']
        );

        $api->utility->verifyPaymentSignature($attributes);
    } catch (SignatureVerificationError $e) {
        $success = false;
        $error = 'Razorpay Error : ' . $e->getMessage();
    }
}

if ($success === true) {
    $razorpay_order_id = $_SESSION['razorpay_order_id'];
    $razorpay_payment_id = $_POST['razorpay_payment_id'];
    $_SESSION['razorpay_payment_id'] = $razorpay_payment_id;
    $email = $_SESSION['ipemail'];
    $name = $_SESSION['ipname'];
    $address = $_SESSION['ipAddress'];
    $phone = $_SESSION['ipMobile'];
    $gender = $_SESSION['ipGender'];
    $zip = $_SESSION['ipZip'];
    $price = $_SESSION['ipPlan'];
    $sql = "INSERT INTO `orders` (`order_id`, `razorpay_payment_id`,`name`, `status`, `email`,`phone`, `price`,`address`, `gender`,`zip`) VALUES ('$razorpay_order_id', '$razorpay_payment_id','$name', 'success', '$email','$phone', '$price','$address','$gender','$zip')";
    if (mysqli_query($conn, $sql)) {
        header("Location: paysuccess.php");
    }

    $html = "<p>Your payment was successful</p>
             <p>Payment ID: {$_POST['razorpay_payment_id']}</p>";
} else {
    $html = "<p>Your payment failed</p>
             <p>{$error}</p>";
}

echo $html;
