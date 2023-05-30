<?php
$servername = "localhost";
$username = "root";
$password = "";
$db = "blog_web";

$connect = mysqli_connect($servername,$username,$password,$db);
if(!$connect){
   echo "error";
   die;
}
?>