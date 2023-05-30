 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <title>Document</title>
    <!-- <link rel="stylesheet" href="style.css">     -->
<style>
.error {
  color:red;
}
  </style>
    <?php
    if(isset($_POST['submit'])){
      include "auth.php";
    }else{
      $validation = [];
      session_start();
      if(!empty($_SESSION["user_details"])){
            header("location:index.php");
        }
    }
      
    ?>
</head>
<body>
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="col-mt-5">
          <div class="card">
            <div class="card-header">
              <div class="card-title">
                <h2>LOGIN</h2>
              </div>
                  <form action="login.php" method="POST">

                  <div>
                    <label for="email"><b>Email</b></label>
                    <input type="email" name="email" class="form-control"/>
                    <span class="error">*<?php if(isset($validation['emailErr'])){
                      echo $validation['emailErr'];
                    }?></span>
                  </div>
                  <br>
                  <div>
                    <label for="password"><b>Password</b></label>
                    <input type="password" name="password" class="form-control"/>
                    <span class="error">*<?php if(isset($validation['passwordErr'])){
                      echo $validation['passwordErr'];
                    }?></span>
                  </div>
                  <br>
                  <div>
                    <button type="submit" name="submit" class="btn btn-primary w-100">Login</button>
                  </div>
            </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>

</html>