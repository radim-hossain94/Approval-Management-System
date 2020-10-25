<?php

include 'dbh.inc.php';

echo $_GET['ASSESSMENT_NUMBER'];


$sql1="UPDATE XX_QUOTE_HEADERS_ALL SET QUOTE_STATUS = 'ENTERED' WHERE  ASSESSMENT_NUMBER = '".$_GET['ASSESSMENT_NUMBER']."' ";

$result1= oci_parse($conn, $sql1);
oci_execute($result1);

  header("Location: Saved_Assessment_Form.php");

?>
