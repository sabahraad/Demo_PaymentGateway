<?php

$conn = mysqli_connect('localhost', 'root', '', 'aamarpay');

if(!$conn){
    echo "Database not Connected" . mysqli_connect_error();
}

?>