
<?php
session_start();
include "dbh.inc.php";

$TRANSACTION_TYPE =  $_POST['TRANSACTION_TYPE'];

$sql9 = "SELECT TTT.TRANSACTION_TYPE_ID, NAME, DESCRIPTION
FROM oe_transaction_types_tl ttt, oe_transaction_types_all tta
WHERE ttt.TRANSACTION_TYPE_ID = tta.TRANSACTION_TYPE_ID
     AND TRANSACTION_TYPE_CODE = 'ORDER'
     AND NAME = '".$TRANSACTION_TYPE."'
     AND NVL (END_DATE_ACTIVE, TRUNC (SYSDATE)) >= TRUNC (SYSDATE)
     AND tta.org_id = '".$_SESSION['ORG_ID']."' ";

$result9= oci_parse($conn, $sql9);
oci_execute($result9);

$arr = array();


while($row9 =oci_fetch_array($result9,OCI_ASSOC)){
    $name = $row9["NAME"];
    $DESCRIPTION = $row9["DESCRIPTION"];

$arr[] = array("NAME" => $name, "DESCRIPTION" => $DESCRIPTION);
}
echo json_encode($arr);
?>