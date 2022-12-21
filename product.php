<?php

 @include('config.php');
 session_start();
 $cus_email = $_SESSION['cus_email'];
    if(!isset($cus_email)){
        header('location:login.php');
    }
    
    if(isset($_POST['raad'])){
    unset($cus_email);
    session_destroy();
    header('location:login.php');
    }

    if (isset($_POST['sd'])) {
    header('location:pay.php');
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>AamarPay</title>
</head>
<body>
    <?php
    $amount = 800;

    ?>
<div class="container ">
        <div class="row">
            <div class="col-md-9 ">
                <div class="card">
                    <div class="card-header">AamarPay</div>
                    <div class="card-body">
                        <h2>Product</h2>
                        <form class="row g-3 " action= "" method="post">
                        <div class="col-12 ">
                            <label for="inputAddress2" class="form-label">Buy a product</label>
                           </div>
                        <div class="row g-3">
                        <label for="inputamount" class="from-label" value="<?php echo"$amount"?>">price -<?php echo"$amount"?></label>
                        </div>
                        <div class="col-12">
                            <button type="submit" name="sd" value="submit" class="btn btn-primary">Pay</button>
                            <button type="submit" name="raad" value="submit" onclick="return confirm('are your sure you want to logout?');" class="btn btn-primary">logout</button>

                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
</body>
</html>