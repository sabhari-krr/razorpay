<?php
require('config.php');
session_start();
$conn = mysqli_connect($host, $username, $password, $dbname);
$razorpay_order_id = $_SESSION['razorpay_order_id'];
$razorpay_payment_id = $_SESSION['razorpay_payment_id'];
$email = $_SESSION['ipemail'];
$name = $_SESSION['ipname'];
$address = $_SESSION['ipAddress'];
$phone = $_SESSION['ipMobile'];
$gender = $_SESSION['ipGender'];
$zip = $_SESSION['ipZip'];
$price = $_SESSION['ipPlan'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
    </style>

</head>

<body class="container d-flex justify-content-center align-items-center vh-100">

    <div class="rightcontainer table-responsive w-75 mx-auto">
        <table class="table table-striped table-bordered ">
            <thead class="text-center">
                <tr>
                    <th colspan="2" class="bg-success text-light">Payment Successful</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="fw-bolder">Order ID</td>
                    <td><?php echo $razorpay_order_id; ?></td>
                </tr>
                <tr>
                    <td class="fw-bolder">Payment ID </td>
                    <td><?php echo $razorpay_payment_id; ?></td>
                </tr>
                <tr>
                    <td class="fw-bolder">Email </td>
                    <td><?php echo $email; ?></td>
                </tr>
                <tr>
                    <td class="fw-bolder">Name </td>
                    <td><?php echo $name; ?></td>
                </tr>
                <tr>
                    <td class="fw-bolder">Address </td>
                    <td><?php echo $address; ?></td>
                </tr>
                <tr>
                    <td class="fw-bolder">Mobile </td>
                    <td><?php echo $phone; ?></td>
                </tr>
                <tr>
                    <td class="fw-bolder">Zip </td>
                    <td><?php echo $zip; ?></td>
                </tr>
                <tr>
                    <td class="fw-bolder">Paid Amount </td>
                    <td>₹.<?php echo $price; ?></td>
                </tr>
                <tr class="text-end">
                    <td colspan="2">
                        <button type="submit" name="submit" class="btn btn-danger rounded-pill px-5" onclick="redirect()">Make Another Payment</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <script>
        function redirect() {
            document.location.href = "index.php";
        }
    </script>

</body>

</html>