<?php

session_start();
include "dbh.inc.php";

$BANK_ID = $_POST["BANK_ID"];

$sql = "SELECT DISTINCT BRANCH_ID,BRANCH_NAME,BANK_ID,BANK_NAME FROM XX_CE_BANK_BRCH_ACCNTS_V
WHERE ORG_ID = '".$_SESSION["ORG_ID"]."'
AND BANK_ID = '".$BANK_ID."' ";

$result= oci_parse($conn, $sql);
oci_execute($result);

$arr10 = array();



while( $row = oci_fetch_array($result,OCI_ASSOC) ){

    //$bank_id = $row['BANK_ID'];
    $branch_id = $row['BRANCH_ID'];
    $branch_name = $row['BRANCH_NAME'];
    
    
    $arr10[] = array("BRANCH_ID" => $branch_id, "BRANCH_NAME" => $branch_name);
}

// encoding array to json format
echo json_encode($arr10);



?>