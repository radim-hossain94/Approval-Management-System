<?php

include 'dbh.inc.php';



if(isset($_POST['search']))
{
echo $_POST['ASSESSMENT_NUMBER'];
echo  $_POST['QUOTE_NUMBER'];
echo $_POST['QUOTE_STATUS'];
echo $_POST['from_date'];
echo $_POST['to_date'];
$ASSESSMENT_NUMBER = $_POST['ASSESSMENT_NUMBER'];
$QUOTE_NUMBER = $_POST['QUOTE_NUMBER'];
$CUSTOMER_ID = $_POST['CUSTOMER_ID'];
$QUOTE_STATUS = $_POST['QUOTE_STATUS'];
$from_date = $_POST['from_date'];
$to_date = $_POST['to_date'];

$query = "SELECT * FROM XX_QUOTE_HEADERS_ALL WHERE ASSESSMENT_NUMBER LIKE '%".$ASSESSMENT_NUMBER."%' AND QUOTE_NUMBER LIKE '%".$QUOTE_NUMBER."%' AND CUSTOMER_ID LIKE '%".$CUSTOMER_ID."%' AND QUOTE_STATUS LIKE '%".$QUOTE_STATUS."%'";
// AND QUOTE_DATE BETWEEN to_date('".$_POST["from_date"]."','yyyy-mm-dd') AND to_date('".$_POST["to_date"]."','yyyy-mm-dd') 

$result= oci_parse($conn, $query);
oci_execute($result);

header('Location:../user/sender/assessment.php');
}
?>