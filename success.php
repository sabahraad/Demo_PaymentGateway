<?php

if($_POST['pay_status']=="Successful"){
    $tran_id= $_POST['mer_txnid'];
    
}

    ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2>Success</h2>
    <?php  echo "tran_id = $tran_id"   ?>
    
</body>
</html>