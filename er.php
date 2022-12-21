<?php
include('config.php');
session_start();
$email = $_SESSION['cus_email'];

$select = "SELECT * FROM customer WHERE cus_email='$email' ";
$result = mysqli_query($conn,$select);
$row = mysqli_fetch_array($result);
$cus_name = $row['cus_name'];

    $amount=700;


if(isset($_POST['raad'])){
    
    $tran_id=random_int(11111111,99999999);
    $status=0;	
    $pg_txnid=0;	
    $date=date("Y-m-d");
    $signature_key="dbb74894e82415a2f7ff0ec3a97e4183";				
    $success_url=0;	
    $fail_url=0;
    $cancel_url=0;	
    $amount=700;
    $currency=$_POST['currency'];		
    $desc=$_POST['desc'];
    $cus_name=$row['cus_name'];
    $cus_email=$email;
    $cus_add1=$_POST['cus_add1'];
    $cus_add2 = $_POST['cus_add2'];
    $cus_city=$_POST['cus_city'];
    $cus_state=$_POST['cus_state'];
    $cus_country=$_POST['cus_country'];
    $cus_phone=$_POST['cus_phone'];
    $store_id= "aamarpaytest";

    $re = "INSERT INTO `pay`( `status`, `pg_txnid`, `date`, `store_id`, `signature_key`, `tran_id`, `success_url`, `fail_url`, `cancel_url`, `amount`, `currency`, `desc`, `cus_name`, `cus_email`, `cus_add1`, `cus_add2`, `cus_city`, `cus_state`, `cus_country`, `cus_phone`) VALUES ('$status','$pg_txnid','$date','$store_id','$signature_key','$tran_id','$success_url','$fail_url','$cancel_url','$amount','$currency','$desc','$cus_name','$cus_email','$cus_add1','$cus_add2','$cus_city','$cus_state','$cus_country','$cus_phone')";
    mysqli_query($conn, $re);
   
    $query = "SELECT * FROM pay WHERE cus_email = '$email'";

    $result = $conn->query($query);
    
    if (mysqli_num_rows($result) > 0) {

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
                'success_url' => 'www.google.com',//route('success'), //your success route
                'fail_url' => 'www.gmail.com', //your fail route
                'cancel_url' => 'www.facebook.com', //your cancel url
                'opt_a' => 'Reshad',  //optional paramter
                'opt_b' => 'Akil',
                'opt_c' => 'Liza', 
                'opt_d' => 'Sohel',
                'signature_key' => 'dbb74894e82415a2f7ff0ec3a97e4183'
            ); //signature key will provided aamarpay, contact integration@aamarpay.com for test/live signature key

            foreach($fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
            $fields_string = rtrim($fields_string, '&'); 
            
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
        }    
        
        
    
}

?>