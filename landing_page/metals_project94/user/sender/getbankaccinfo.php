<?php

session_start();
include "dbh.inc.php";

$REMITTANCE_BRANCE_ID = $_POST["REMITTANCE_BRANCE_ID"];

$sql = "SELECT DISTINCT BANK_ACCOUNT_ID,BANK_ACCOUNT_NUM FROM XX_CE_BANK_BRCH_ACCNTS_V
WHERE ORG_ID= '".$_SESSION["ORG_ID"]."'
AND BRANCH_ID = '".$REMITTANCE_BRANCE_ID."' ";

$result= oci_parse($conn, $sql);
oci_execute($result);

$arr11 = array();



while( $row = oci_fetch_array($result,OCI_ASSOC) ){

    
    $acc_id = $row['BANK_ACCOUNT_ID'];
    $acc_no = $row['BANK_ACCOUNT_NUM'];
    
    
    $arr11[] = array("BANK_ACCOUNT_ID" => $acc_id, "BANK_ACCOUNT_NUM" => $acc_no);
}

// encoding array to json format
echo json_encode($arr11);



?>