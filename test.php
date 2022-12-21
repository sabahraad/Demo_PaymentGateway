<?php


        // print_r('hello');
        // die();

            $url = 'https://sandbox.aamarpay.com/request.php'; 
   
            $fields = array(
        
                'store_id' => 'aamarpaytest', //store id will be aamarpay,  contact integration@aamarpay.com for test/live id
                'amount' => $amount, //transaction amount
                'payment_type' => 'VISA', //no need to change
                'currency' => $_POST['currency'],  //currenct will be USD/BDT
                'tran_id' => $tran_id, //transaction id must be unique from your end
                'cus_name' => $row['cus_name'],  //customer name
                'cus_email' => $email, //customer email address
                'cus_add1' => $_POST['cus_add1'],  //customer address
                'cus_add2' => $_POST['cus_add2'], //customer address
                'cus_city' => $_POST['cus_city'],  //customer city
                'cus_state' => $_POST['cus_state'],  //state
                'cus_postcode' => '1206', //postcode or zipcode
                'cus_country' => $_POST['cus_country'],  //country
                'cus_phone' => $_POST['cus_phone'], //customer phone number
                'cus_fax' => 'Not¬Applicable',  //fax
                'ship_name' => 'ship name', //ship name
                'ship_add1' => 'House B-121, Road 21',  //ship address
                'ship_add2' => 'Mohakhali',
                'ship_city' => 'Dhaka', 
                'ship_state' => 'Dhaka',
                'ship_postcode' => '1212', 
                'ship_country' => 'Bangladesh',
                'desc' => $_POST['desc'], 
                'success_url' => header('location:success.php'),//route('success'), //your success route
                'fail_url' => header('location:fail.php'), //your fail route
                'cancel_url' => header('location:product.php'), //your cancel url
                'opt_a' => 'Reshad',  //optional paramter
                'opt_b' => 'Akil',
                'opt_c' => 'Liza', 
                'opt_d' => 'Sohel',
                'signature_key' => 'dbb74894e82415a2f7ff0ec3a97e4183'
            ); //signature key will provided aamarpay, contact integration@aamarpay.com for test/live signature key

    
                $fields_string = http_build_query($fields);
            
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_VERBOSE, true);
                curl_setopt($ch, CURLOPT_URL, $url);  
            
                curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                $url_forward = str_replace('"', '', stripslashes(curl_exec($ch)));	
                curl_close($ch); 
            
                redirect_to_merchant($url_forward);

function redirect_to_merchant($url) {

    ?>
    <html xmlns="http://www.w3.org/1999/xhtml">
      <head><script type="text/javascript">
        function closethisasap() { document.forms["redirectpost"].submit(); } 
      </script></head>
      <body onLoad="closethisasap();">
      
        <form name="redirectpost" method="post" action="<?php echo 'https://sandbox.aamarpay.com/'.$url; ?>"></form>
        <!-- for live url https://secure.aamarpay.com -->
      </body>
    </html>
    <?php	
    exit;
} 


   


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

                        <form class="row g-3" action= "" method="post">
                        
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
                            <input type="text" name="desc" class="form-control" id="inputAddress" placeholder="1234 Main St">
                        </div>
                        <div class="col-12">
                            <label for="inputAddress2" class="form-label">Full Name</label>
                            <input type="text" name="cus_name"  class="form-control" id="inputAddress2" value= <?php echo "$cus_name" ?>>
                        </div>
                        <div class="col-md-6">
                            <label for="inputCity" class="form-label">Email</label>
                            <input type="text" name="cus_email" class="form-control" id="inputCity" value= <?php echo "$email" ?>>
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