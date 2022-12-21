<?php
@include('config.php');
session_start();
if(isset($_POST['submit'])){

    $cus_email=($_POST['cus_email']);
    $password=md5($_POST['password']);

    $select = "SELECT * FROM customer WHERE cus_email='$cus_email' ";
    $result = mysqli_query($conn,$select);
   
    $row = mysqli_fetch_array($result);
    $pass = $row['password'];

    if (mysqli_num_rows($result) <= 0) {
        $error = 'Please Register First';
    } else{
        if ($pass != $password) {
            $errorr = 'Email or Password in not correct';
        } else {
            $_SESSION['cus_email'] = $row['cus_email'];
            header('location:product.php');
        }
    }

};
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
<div class="container ">
        <div class="row">
            <div class="col-md-9 ">
                <div class="card">
                    <div class="card-header">AamarPay</div>
                    <div class="card-body">
                        <h2>Login</h2>
                        <form class="row g-3 " action= "" method="post">
                        
                        <?php

                        if(isset($error)){
                                echo '<span class="error-msg">'.$error.'</span>';      
                        };
                        if(isset($errorr)){
                            echo '<span class="errorr-msg">'.$errorr.'</span>';      
                        };
                        ?>
                        <div class="col-md-12">
                            <label for="inputCity" class="form-label">Email</label>
                            <input type="email" name="cus_email" class="form-control" id="inputCity" required>
                        </div>
                        <div class="col-md-12">
                            <label for="inputPassword" name="password" class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" id="inputpassword" required>
                        </div>
                        <div class="col-12">
                        <button type="submit" name="submit" href="" class="btn btn-primary">Login</button>
                            <button type="submit"  href="http://localhost/AamarPay/registration.php" class="btn btn-primary">Registration</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    
</body>
</html>
