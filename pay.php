<?php
@include('config.php');
session_start();
$cus_email = $_SESSION['cus_email'];

    $select = "SELECT * FROM customer WHERE cus_email='$cus_email' ";
    $result = mysqli_query($conn,$select);
   
    $row = mysqli_fetch_array($result);
    $name = $row['cus_name'];

$amount = 800;


?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AamarPay</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
<div class="container">
        <div class="row">
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">AamarPay</div>
                    <div class="card-body">
                        <h2>PAY Details</h2>

                        <form class="row g-3" action= "pgprocess.php" method="post">
                        
                        <div class="col-md-6">
                            <label for="inputEmail4" class="form-label">Price of the Product</label>
                            <input type="amount" name="amount" class="form-control" id="inputEmail4" value= <?php echo "$amount" ?> disabled>
                        </div>
                        <div class="col-md-6">
                            <label for="inputcurrency4" class="form-label">Currency</label>
                            <input type="currency" name="currency"  class="form-control" id="inputcurrency4">
                        </div>
                        <div class="col-12">
                            <label for="inputAddress" class="form-label">desc</label>
                            <input type="text" name="desc" class="form-control" id="inputAddress" placeholder="product name">
                        </div>
                        <div class="col-12">
                            <label for="inputAddress2" class="form-label">Full Name</label>
                            <input type="text" name="cus_name"  class="form-control" id="inputAddress2" value= <?php echo "$name" ?>>
                        </div>
                        <div class="col-md-6">
                            <label for="inputCity" class="form-label">Email</label>
                            <input type="text" name="cus_email" class="form-control" id="inputCity" value= <?php echo "$cus_email" ?> >
                        </div>
                        <div class="col-md-4">
                            <label for="inputState" name="currency" class="form-label">Address</label>
                            <input type="text" name="cus_add1" class="form-control" id="inputCity">
                        </div>
                        <div class="col-md-2">
                            <label for="inputZip" class="form-label">Address 2</label>
                            <input type="text" name="cus_add2" class="form-control" id="inputZip">
                        </div>
                        <div class="col-md-4">
                            <label for="inputState" name="currency" class="form-label">City</label>
                            <input type="text" name="cus_city" class="form-control" id="inputCity">
                        </div>
                        <div class="col-md-4">
                            <label for="inputState" name="currency" class="form-label">State</label>
                            <input type="text" name="cus_state" class="form-control" id="inputCity">
                        </div>
                        <div class="col-md-4">
                            <label for="inputState" name="currency" class="form-label">Country</label>
                            <input type="text" name="cus_country" class="form-control" id="inputCity">
                        </div>
                        <div class="col-md-4">
                            <label for="inputState" name="currency" class="form-label">Phone Number</label>
                            <input type="text" name="cus_phone" class="form-control" id="inputCity">
                        </div>
                        <input type="hidden" name="status" id="statusId" value=0 >
                        <div class="col-12">
                            <button type="submit"  name="raad" class="btn btn-primary">PAY</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
</body>
</html>