<?php
	$connect = mysqli_connect("localhost", "root", "", "metal_project");
	$sql = "DELETE FROM quote_lines WHERE line_no = '".$_POST["line_no"]."'";
	if(mysqli_query($connect, $sql))
	{
		echo 'Data Deleted';
	}
 ?>
