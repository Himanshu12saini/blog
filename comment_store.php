
<?php
include "config.php";
session_start();
if(isset($_POST['submit'])){
    $user_details = unserialize($_SESSION['user_details']);
    $blog_id = $_POST['blog_id'];
    $user_id = $user_details['id'];
    $comment = $_POST['message'];



$sql = "INSERT INTO comments(blog_id,user_id,comment)VALUES('$blog_id','$user_id','$comment')";
$result = mysqli_query($connect,$sql);
if($result){
   header("location:post.php?id={$_POST['blog_id']}");
}else{
   echo "error";
}
}

?>