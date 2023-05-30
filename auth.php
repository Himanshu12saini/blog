<?php 
include "config.php";
session_start();
$email = $password = "";
$validation = [];

if(empty($_POST['email'])){
    $validation['emailErr'] = "email is required";
}else{
    $email = test_input($_POST['email']);
}

if(empty($_POST['password'])){
    $validation['passwordErr'] = "Password is required";
}else{
    $password = md5(test_input($_POST['password']));
}


if(count($validation)==0){
    $sql = "SELECT * FROM user WHERE email = '$email' && password = '$password'";
    $result = mysqli_query($connect,$sql); 
   $query = mysqli_num_rows($result);
   $details=mysqli_fetch_assoc($result);
   if(empty($details)){
    echo "No User Found with the following credentials";
   }else {
    $_SESSION['user_details'] = serialize($details);
    header("location:index.php");
   }
}

function test_input($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>
