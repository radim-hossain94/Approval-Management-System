<?php
$connect = mysqli_connect("localhost", "root", "", "metal_project");
$sql = "INSERT INTO quote_lines(order_item,quantity,uom,unit_selling_price,unit_list_price) VALUES('".$_POST["order_item"]."', '".$_POST["quantity"]."', '".$_POST["uom"]."', '".$_POST["unit_selling_price"]."', '".$_POST["unit_list_price"]."')";
if(mysqli_query($connect, $sql))
{
     echo 'Data Inserted';
}
 ?>
