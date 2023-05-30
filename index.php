<?php 
include "config.php";
$results_per_page = 2;  
if (!isset ($_GET['page']) ) {  
	$page = 1;  
} else {  
	$page = $_GET['page'];  
}  
$page_first_result = ($page-1) * $results_per_page; 
$sql = "SELECT * FROM blog";
$result = mysqli_query($connect,$sql);
$number_of_result = mysqli_num_rows($result);  
$number_of_page = ceil($number_of_result / $results_per_page);              

$sqlLimit = $sql . " LIMIT " . $page_first_result . ',' . $results_per_page;
$resultData = mysqli_query($connect,$sqlLimit);




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
</head>
<body>

	<?php include "sidebar.php"; ?>
	<?php include "header.php";?>    
			<div class="row tm-row">
				<?php

			if ($resultData->num_rows > 0) {
	// output data of each row
	while($row = $resultData->fetch_assoc()) {
		?>     <article class="col-12 col-md-6 tm-post">
		<hr class="tm-hr-primary">
		<a href="post.php?id=<?= $row['id'] ?>" class="effect-lily tm-post-link tm-pt-60">
			<div class=" tm-post-link-inner">
				<img src="<?= 'image/'.$row['file'] ?>" alt="Image" class="img-fluid">                            
			</div>
			<span class="position-absolute tm-new-badge">New</span>
			<h2 class="tm-pt-30 tm-color-primary tm-post-title"><?= $row['tittle'] ?></h2>
		</a>                    
		<p class="tm-pt-30">
		<?= $row['body'] ?>
		</p>
		<div class="d-flex justify-content-between tm-pt-45">
			<span class="tm-color-primary">Publish Date</span>
			<span class="tm-color-primary"><?=date("F d,Y",strtotime($row['publish_date']))?></span>
		</div>
		<hr>
		</article><?php
	}
  } else {
	echo "0 results";
  }?>
			</div>
	  

			<?php  
			echo "<ul class='pagination admin-pagination'>";
			for($page=1;$page<=$number_of_page;$page++){
				echo "<li>
				<a href='index.php?page=" . $page . "'>
				<button class='tm-btn-primary mx-1'>" . $page . "</button>
				</a>
				</li>";
			}
			echo "</ul>";
			?>
		  <?php  include "fotter.php"; ?> 
</body>
</html>