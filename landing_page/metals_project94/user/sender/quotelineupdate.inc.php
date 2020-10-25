<?php
session_start();

include "dbh.inc.php";

$_SESSION['LINE_NO'] = $_POST['LINE_NO'];
$_SESSION['QUANTITY'] = $_POST['QUANTITY'];
// $_SESSION['UNIT_SELLING_PRICE'] = $_POST['UNIT_SELLING_PRICE'];

if(!empty($_SESSION['QUANTITY'])){
    $sql = "Update XX_QUOTE_LINES_ALL set QUANTITY = '".$_POST['QUANTITY']."' 
    where LINE_NO = '".$_POST['LINE_NO']."' ";
    $result= oci_parse($conn, $sql);
    oci_execute($result);
}



// if(!empty($_SESSION['UNIT_SELLING_PRICE'])){
//     $sql = "Update XX_QUOTE_LINES_ALL set UNIT_SELLING_PRICE = '".$_POST['UNIT_SELLING_PRICE']."' 
//     where LINE_NO = '".$_POST['LINE_NO']."' ";
//     $result= oci_parse($conn, $sql);
//     oci_execute($result);
// }


?>