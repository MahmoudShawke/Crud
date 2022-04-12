<?php

$servername='localhost';
$dbname='blog';
$username='root';
$password='';


$con=mysqli_connect($servername,$username,$password,$dbname);
if($con){



}else {

    echo mysqli_connect_error();
}



?>