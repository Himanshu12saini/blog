<?php
include "config.php";

$search = $_POST['search'];
// $column = $_POST['column'];


$sql = "select * from blog LIKE '%$search%'";

$result = $connnect->query($sql);

if ($result->num_rows > 0){
while($row = $result->fetch_assoc() ){
	echo $row["tittle"]."  ".$row["body"]."<br>";
}
} else {
	echo "0 records";
}


?>