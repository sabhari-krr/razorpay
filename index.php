<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Page</title>
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

    <div class="rightcontainer w-50 p-4">
        <form class="row g-3" action="pay.php" method="post">
            <div class="col-md-6">
                <label for="ipemail" class="form-label">Email</label>
                <input type="email" class="form-control" id="ipemail" name="ipemail" placeholder="sabhari@krr.com">
            </div>
            <div class="col-md-6">
                <label for="ipname" class="form-label">Name</label>
                <input type="text" class="form-control" id="ipname" name="ipname" placeholder="Sabhari">
            </div>
            <div class="col-12">
                <label for="ipAddress" class="form-label">Address</label>
                <input type="text" class="form-control" id="ipAddress" name="ipAddress" placeholder="Hopes College Road, Coimbatore">
            </div>
            <div class="col-12">
                <label for="ipPlan" class="form-label">Membership Plan</label>
                <select id="ipPlan" class="form-select" name="ipPlan">
                    <option selected value="">Choose...</option>
                    <option value="3000">3 Months->3k</option>
                    <option value="5000">6 Months->5k</option>
                    <option value="8000">12 Months->8k</option>

                </select>
            </div>
            <div class="col-md-6">
                <label for="ipMobile" class="form-label">Phone</label>
                <input type="number" class="form-control" id="ipMobile" name="ipMobile">
            </div>
            <div class="col-md-4">
                <label for="ipGender" class="form-label">Gender</label>
                <select id="ipGender" class="form-select" name="ipGender">
                    <option selected value="">Choose...</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                    <option value="Other">Other</option>

                </select>
            </div>
            <div class="col-md-2">
                <label for="ipZip" class="form-label">Zip</label>
                <input type="number" class="form-control" id="ipZip" name="ipZip">
            </div>
            <div class="col-12 text-center">
                <button type="submit" name="submit" class="btn btn-danger rounded-pill px-5">Pay</button>
            </div>
        </form>
    </div>
</body>

</html>