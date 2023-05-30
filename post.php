<?php
session_start();
include "config.php";
$sql = "SELECT * FROM blog WHERE id = {$_GET['id']}";
$result = mysqli_query($connect,$sql);
// SELECT column_name(s)
// FROM table1
// LEFT JOIN table2
// ON table1.column_name = table2.column_name;
$sql2 = "SELECT comments.*, user.username,user.image FROM comments LEFT JOIN user ON comments.user_id = user.id";
// print_r($sql2);
// die;
$result2 = mysqli_query($connect,$sql2);




$user_details = unserialize($_SESSION['user_details']);
// print_r($user_details);


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xtra Blog</title>
    <link rel="stylesheet" href="fontawesome/css/all.min.css"> <!-- https://fontawesome.com/ -->
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro&display=swap" rel="stylesheet">
    <!-- https://fonts.google.com/ -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/templatemo-xtra-blog.css" rel="stylesheet">
	<style>
	img.mb-2.rounded-circle.img-thumbnail {
    width: 120px;
    height: 120px;
}

</style>

    <!--
TemplateMo 553 Xtra Blog

https://templatemo.com/tm-553-xtra-blog

-->
</head>

<body>
    <?php include "sidebar.php"; ?>
    <?php include "header.php";?>
    <div class="row tm-row">
        <div class="col-12">
            <hr class="tm-hr-primary tm-mb-55">
            <!-- Video player 1422x800 -->
            <?php

			if ($result->num_rows > 0) {
	// output data of each row
	while($row = $result->fetch_assoc()) {
		?>
            <div class=" tm-post-link-inner">
                <img src="<?= 'image/'.$row['file'] ?>" alt="Image" class="img-fluid">
            </div>
        </div>
    </div>
    <div class="row tm-row">
        <div class="col-lg-8 tm-post-col">
            <div class="tm-post-full">
                <div class="mb-4">
                    <h2 class="pt-2 tm-color-primary tm-post-title"><?= $row['tittle'] ?></h2>
                    <p class="tm-mb-40"><?= $row['publish_date'] ?></p>

                    <?= $row['body'] ?>
                </div><?php
	}
  } else {
	echo "0 results";
  }?>
            </div>

            <!-- Comments -->
            <div>
                <h2 class="tm-color-primary tm-post-title">Comments</h2>
                <hr class="tm-hr-primary tm-mb-45">
                <!-- <div class="tm-comment tm-mb-45">
								<!-- <figure class="tm-comment-figure">
									<img src="img/comment-1.jpg" alt="Image" class="mb-2 rounded-circle img-thumbnail">
									<figcaption class="tm-color-primary text-center">Mark Sonny</figcaption>
								</figure>
								<div>
									<p>
										Praesent aliquam ex vel lectus ornare tritique. Nunc et eros
										quis enim feugiat tincidunt et vitae dui. Nullam consectetur
										justo ac ex laoreet rhoncus. Nunc id leo pretium, faucibus 
										sapien vel, euismod turpis.
									</p>
									<div class="d-flex justify-content-between">
										<a href="#" class="tm-color-primary">REPLY</a>
										<span class="tm-color-primary">June 14, 2020</span>
									</div>                                                 
								</div>                                
							</div> -->

                <?php
						if ($result2->num_rows > 0) {
						// output data of each row
						while($data = $result2->fetch_assoc()) {
						
						?><div class="tm-comment-reply tm-mb-45">
                    <hr>
                    <div class="tm-comment">
                        <figure class="tm-comment-figure">
                            <img src="img/<?= $data['image'] ?>" alt="Image" class="mb-2 rounded-circle img-thumbnail">
                            <figcaption class="tm-color-primary text-center"><?= $data['username'] ?></figcaption>
                        </figure>
                        <p>
                            <?= $data['comment'] ?>
                        </p>
                    </div>
                    <span
                        class="d-block text-right tm-color-primary"><?=date("F d,Y",strtotime($data['created_at']))?></span>
                </div> <?php
	}
  } else {
	echo "0 results";
  }?>
                <form action="comment_store.php" class="mb-5 tm-comment-form" method="POST">
                    <h2 class="tm-color-primary tm-post-title mb-4">Your comment</h2>
                    <div class="mb-4">
                        <input type="hidden" name="blog_id" value="<?php echo $_GET['id'];?>" />
                        <textarea class="form-control" name="message" rows="6" placeholder="Share your comment"
                            value="<?php echo $user_details['comment'];?>"></textarea>
                    </div>
                    <div class="text-right">
                        <button class="tm-btn tm-btn-primary tm-btn-small" name="submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    </div>
    <?php  include "fotter.php"; ?>
    <script src="js/jquery.min.js"></script>
    <script src="js/templatemo-script.js"></script>
</body>

</html>
