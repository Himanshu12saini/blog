<?php 
include "config.php";
if(isset($_POST['submit'])){
    $error = [];
    

    if( empty( $_POST['tittle'] ) ){
        $error['title'] = "Please enter title";
    }else{
        $tittle = test_input($_POST["tittle"]);
    }
    if( empty($_POST['body'] )){
        $error['body'] = "Please enter body";
    }else{
        $body = test_input($_POST["body"]);

    }
    // $imageFileType = strtolower(pathinfo($_FILES["file"]['name'],PATHINFO_EXTENSION));


    // if( empty($_FILES["file"]['name'] )){
    //     $error['file'] = "Please enter file";
    // }elseif($_FILES["file"]["size"] > 500000) {
    //     $error['file'] = "Sorry, your file is too large.";
    //   }elseif($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    //   && $imageFileType != "gif" ) {
    //     $error = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    //   }else{
    //     $error['file'] = "file not required";
    //   }
    // // }else{
    // //     $file = $_FILES['file'];
    // //     $filesize = filesize($file['tmp_name']);
    // //     $filename = "./image/" . $file['name'];
     
    // // }
$filename = time().$_FILES['file']['name'];
$destination = 'image/'.$filename;
$extension = pathinfo($filename,PATHINFO_EXTENSION);

$tmp_name = $_FILES['file']['tmp_name'];
$size = $_FILES['file']['size'];

if(empty($filename)){
    $error['file'] = 'file is required';
}elseif(!in_array($extension,['png','jpg','jpeg'])){
    $error['file'] = 'file does not match';
}elseif($size<50000){
    $error['file'] = 'file is to large';
}else{
    move_uploaded_file('tmp_name','$destination');
}

$tittle = $_POST['tittle'];
$body = $_POST['body'];
$file = $_FILES['file'];

// Remember On thing always create the file name by your self
// using a time stamp otherwise it may replace the old file if name is similar.
// Got my posix_initgroups
// okh sir
// Alright
// Kye restriction laga nahi??
// File type file size??
// sir betana lgaka file ma
// okay
// echo "<pre>";
// print_r($_FILES["file"]);
// die;


if( empty($error) ){
    move_uploaded_file($_FILES["file"]["tmp_name"], "image/{$file["name"]}");
$fileName = $file["name"];

$sql = "INSERT INTO blog(tittle,body,file,user_id)VALUES('$tittle','$body','$fileName','1')";
$result = mysqli_query($connect,$sql);
if($result){
   header("location:index.php");
}else{
   echo "error";
}
}
}
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }
  if(isset($_FILES['filename'])){

  }

  
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Xtra Blog</title>
	<link rel="stylesheet" href="fontawesome/css/all.min.css"> <!-- https://fontawesome.com/ -->
	<link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro&display=swap" rel="stylesheet"> <!-- https://fonts.google.com/ -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/templatemo-xtra-blog.css" rel="stylesheet">
    <style>
        .error{
            color:red;
        }
        </style>
</head>
<body>
<?php include "sidebar.php"; ?>
    <?php include "header.php";?>   
            <!-- Search form -->
            <div class="row tm-row tm-mb-120">
                <div class="col-12">
                    <h2 class="tm-color-primary tm-post-title tm-mb-60">Add Blog</h2>
                </div>
                <div class="col-lg-7 tm-contact-left">
                    <form method="POST" action="" class="mb-5 ml-auto mr-0 tm-contact-form" enctype="multipart/form-data">                        
                        <div class="form-group row mb-4">
                            <label for="tittle" class="col-sm-3 col-form-label text-right tm-color-primary">Title</label>
                            <div class="col-sm-9">
                                <input class="form-control mr-0 ml-auto" name="tittle" id="tittle" type="text">                            
                            </div>
                            <?= $error['title']??'' ?>
                            <span class="error">*</span>
                        </div>
                        <div class="form-group row mb-5">
                            <label for="body" class="col-sm-3 col-form-label text-right tm-color-primary">Content</label>
                            <div class="col-sm-9">
                                <textarea class="form-control mr-0 ml-auto" name="body" id="body" rows="8"></textarea>                                
                            </div>
                            <?= $error['body']??'' ?>
                            <span class="error">*</span>
                        </div>
                        <div class="form-group row mb-5">
                            <label for="file" class="col-sm-3 col-form-label text-right tm-color-primary">Image</label>
                            <div class="col-sm-9">
                                <input type="file" class="file-control" name="file" id="file" rows="8" >                                
                            </div>
                            <?= $error['file']??'' ?>
                            <span class="error">*</span>
                        </div>
                        <div class="form-group row text-right">
                            <div class="col-12">
                                <input type="submit" name="submit" value="save" class="btn-btn tm-btn-primary tm-btn-small">                    
                            </div>                            
                        </div>                                
                    </form>
                </div>
               
            </div>      
            <?php  include "fotter.php"; ?> 
    <script src="js/jquery.min.js"></script>
    <script src="js/templatemo-script.js"></script>
</body>
</html>