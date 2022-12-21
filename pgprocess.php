<?php
error_reporting(0);
include('config.php');
session_start();
$email = $_SESSION['cus_email'];

$select = "SELECT * FROM customer WHERE cus_email='$email' ";
$result = mysqli_query($conn,$select);
$row = mysqli_fetch_array($result);



if(isset($_POST['raad'])){

    function rand_string( $length ) {
        $str="";
        $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $size = strlen( $chars );
        for( $i = 0; $i < $length; $i++) { $str .= $chars[ rand( 0, $size - 1 ) ]; }
        return $str;
    }

    $cur_random_value=rand_string(10);


    $status=0;	
    $pg_txnid=0;	
    $date=date("Y-m-d");
    $signature_key="dbb74894e82415a2f7ff0ec3a97e4183";				
    $success_url=0;	
    $fail_url=0;
    $cancel_url=0;	
    $amount=850;
    $currency=$_POST['currency'];		
    $desc=$_POST['desc'];
    $cus_name = $row['cus_name'];
    $cus_email=$email;
    $cus_add1=$_POST['cus_add1'];
    $cus_add2 = $_POST['cus_add2'];
    $cus_city=$_POST['cus_city'];
    $cus_state=$_POST['cus_state'];
    $cus_country=$_POST['cus_country'];
    $cus_phone=$_POST['cus_phone'];
    $store_id= "aamarpaytest";

    $re = "INSERT INTO `pay`( `status`, `pg_txnid`, `date`, `store_id`, `signature_key`, `tran_id`, `success_url`, `fail_url`, `cancel_url`, `amount`, `currency`, `desc`, `cus_name`, `cus_email`, `cus_add1`, `cus_add2`, `cus_city`, `cus_state`, `cus_country`, `cus_phone`) VALUES ('$status','$pg_txnid','$date','$store_id','$signature_key','$cur_random_value','$success_url','$fail_url','$cancel_url','$amount','$currency','$desc','$cus_name','$cus_email','$cus_add1','$cus_add2','$cus_city','$cus_state','$cus_country','$cus_phone')";
    mysqli_query($conn, $re);
   
    function redirect_to_merchant($url) {
    
        ?>
        <html xmlns="http://www.w3.org/1999/xhtml">
          <head><script type="text/javascript">
            function closethisasap() { document.forms["redirectpost"].submit(); } 
          </script></head>
          <body onLoad="closethisasap();">
          
            <form name="redirectpost" method="post" action="<?php echo 'https://sandbox.aamarpay.com/'.$url; ?>"></form>
          </body>
        </html>
        <?php	
        exit;
    } 
    
    
    
    $url = 'https://sandbox.aamarpay.com/request.php';
    $fields = array(
        'store_id' => $store_id, 
        'amount' => $amount, 
        'payment_type' => 'VISA',
        'currency' => $_POST['currency'], 
        'tran_id' => $cur_random_value,
        'cus_name' => $cus_name, 
        'cus_email' => $email,
        'cus_add1' => $_POST['cus_add1'], 
        'cus_add2' => $_POST['cus_add2'],
        'cus_city' => $_POST['cus_city'], 
        'cus_state' => $_POST['cus_state'], 
        'cus_postcode' => '1206',
        'cus_country' => $_POST['cus_country'], 
        'cus_phone' => $_POST['cus_phone'],
        'cus_fax' => 'Not¬Applicable',
         'ship_name' => $cus_name,
        'ship_add1' => 'House B-121, Road 21',
         'ship_add2' => 'Mohakhali',
        'ship_city' => 'Dhaka', 
        'ship_state' => 'Dhaka',
        'ship_postcode' => '1212', 
        'ship_country' => 'Bangladesh',
        'desc' => $_POST['desc'], 
        'success_url' => 'http://localhost/aamarpay/success.php',
        'fail_url' => 'http://localhost/aamarpay/fail.php',
        'cancel_url' => 'http://localhost/aamarpay/product.php',
        'opt_a' => 'Reshad', 
        'opt_b' => 'Akil',
        'opt_c' => 'Liza', 
        'opt_d' => 'Sohel',
        'signature_key' => $signature_key);


    foreach($fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
    $fields_string = rtrim($fields_string, '&'); 
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_VERBOSE, true);
    curl_setopt($ch, CURLOPT_URL, $url);  
    curl_setopt($ch, CURLOPT_POST, count($fields)); 
    curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    $url_forward = str_replace('"', '', stripslashes(curl_exec($ch)));	
    curl_close($ch); 
    
    redirect_to_merchant($url_forward);
    
}

?>