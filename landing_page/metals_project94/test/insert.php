<?php

session_start();
include 'dbh.inc.php';
$_SESSION['test'] = $_POST['LINE_NO'];
echo  $_POST['LINE_NO'];


$LINE_NO = $_POST['LINE_NO'];
$QUANTITY = $_POST['QUANTITY'];
$UNIT_OF_MEASURE = $_POST['UNIT_OF_MEASURE'];
$UNIT_SELLING_PRICE = $_POST['UNIT_SELLING_PRICE'];


$query = "INSERT INTO XX_QUOTE_LINES_ALL(LINE_NO,QUANTITY,UNIT_OF_MEASURE,UNIT_SELLING_PRICE)
VALUES (:LINE_NO, :QUANTITY, :UNIT_OF_MEASURE,:UNIT_SELLING_PRICE)";

$result1 = oci_parse($conn, $query);

oci_bind_by_name($result1, ":LINE_NO", $LINE_NO);
oci_bind_by_name($result1, ":QUANTITY", $QUANTITY);
oci_bind_by_name($result1, ":UNIT_OF_MEASURE", $UNIT_OF_MEASURE);
oci_bind_by_name($result1, ":UNIT_SELLING_PRICE", $UNIT_SELLING_PRICE);

oci_execute($result1);