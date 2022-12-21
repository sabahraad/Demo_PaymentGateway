<?php

@include('config.php');
if(isset($_POST['submit'])){
    
    $cus_name=($_POST['cus_name']);
    $cus_email=($_POST['cus_email']);
    $password=md5($_POST['password']);
    $cpassword=md5($_POST['cpassword']);

    $select = "SELECT * FROM customer WHERE cus_email='$cus_email' && password ='$password' ";
    $result = mysqli_query($conn,$select);
    
    if(mysqli_num_rows($result) > 0 ){
        $error[] ='user already exits';
    }else{
        if($password != $cpassword){
            $error[] = 'password not matched';
        }
        else{
            $insert = "INSERT INTO customer (cus_name,cus_email,password)VALUES('$cus_name','$cus_email','$password')";
            mysqli_query($conn, $insert);
            header('location:login.php');

        }
    }

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
<div class="container ">
        <div class="row">
            <div class="col-md-9 ">
                <div class="card">
                    <div class="card-header">AamarPay</div>
                    <div class="card-body">
                        <h2>Registration</h2>
                        <?php

                        if(isset($error)){
                            foreach( $error as $error){
                                echo '<span class="error-msg">'.$error.'</span>';
                            };
                        };
                        
                        ?>
                        <form class="row g-3 " action= "" method="POST">
                        <div class="col-12 ">
                            <label for="inputAddress2" class="form-label">Full Name</label>
                            <input type="text" name="cus_name"  class="form-control" id="inputAddress2" placeholder="Apartment, studio, or floor" required>
                        </div>
                        <div class="col-md-12">
                            <label for="inputCity" class="form-label">Email</label>
                            <input type="email" name="cus_email" class="form-control" id="inputCity" required>
                        </div>
                        <div class="col-md-12">
                            <label for="inputPassword" name="password" class="form-label">password</label>
                            <input type="password" name="password" class="form-control" id="inputpassword" required>
                        </div>
                        <div class="col-md-12">
                            <label for="inputcPassword" name="cpassword" class="form-label">cpassword</label>
                            <input type="cpassword" name="cpassword" class="form-control" id="inputcpassword" required>
                        </div>
                        <div class="col-12">
                        <button type="submit" name="submit" value="register now" class="form-btn btn btn-primary">Registration</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    
</body>
</html>