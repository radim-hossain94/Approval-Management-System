<?php
	$connect = mysqli_connect("localhost", "root", "", "metal_project");
	$line_no = $_POST["line_no"];
	$text = $_POST["text"];
	$column_name = $_POST["column_name"];
	$sql = "UPDATE quote_lines SET ".$column_name."='".$text."' WHERE line_no='".$line_no."'";
	if(mysqli_query($connect, $sql))
	{
		echo 'Data Updated';
	}
 ?>
