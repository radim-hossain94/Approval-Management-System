<?php

session_start();
include "dbh.inc.php";

$INVERTORY_ITEM = $_POST['INVERTORY_ITEM'];
$PRICE_LIST_NAME = $_POST['PRICE_LIST_NAME'];


$sql90 = "SELECT list_header_id price_list_id,NAME price_list_name FROM qp_list_headers_v
WHERE AUTOMATIC_FLAG='Y'
AND CURRENCY_CODE='BDT'
AND ACTIVE_FLAG='Y'
AND NAME = '".$PRICE_LIST_NAME."'
AND TRUNC(SYSDATE) BETWEEN START_DATE_ACTIVE AND NVL(END_DATE_ACTIVE,TRUNC(SYSDATE))
AND ORIG_ORG_ID = '".$_SESSION['ORG_ID']."' ";

$result90= oci_parse($conn, $sql90);
oci_execute($result90);
while($row90 =oci_fetch_array($result90,OCI_ASSOC)):
  $PRICE_LIST_ID = $row90["PRICE_LIST_ID"];
endwhile;
$_SESSION['PRICE_LIST_ID'] = $PRICE_LIST_ID;

$sql = "select inventory_item_id,DESCRIPTION,PRIMARY_UOM_CODE FROM MTL_SYSTEM_ITEMS_B WHERE inventory_item_id = '".$INVERTORY_ITEM."' 
and ORGANIZATION_ID = '".$_SESSION["ORGANIZATION_ID"]."' ";

$sql1 ="SELECT OPERAND, qp_list_headers_v.LIST_HEADER_ID, PRODUCT_ID
FROM qp_list_lines_v inner join qp_list_headers_v on
qp_list_lines_v.LIST_HEADER_ID = qp_list_headers_v.LIST_HEADER_ID
where LIST_LINE_TYPE_CODE = 'PLL'
     AND PRODUCT_ATTRIBUTE = 'PRICING_ATTRIBUTE1'
     AND TRUNC (SYSDATE) BETWEEN qp_list_lines_v.START_DATE_ACTIVE
     AND NVL (qp_list_lines_v.END_DATE_ACTIVE, TRUNC (SYSDATE))
  and qp_list_headers_v.AUTOMATIC_FLAG='Y'
AND qp_list_headers_v.CURRENCY_CODE='BDT'
AND qp_list_headers_v.ACTIVE_FLAG='Y'
AND TRUNC(SYSDATE) BETWEEN qp_list_headers_v.START_DATE_ACTIVE AND NVL(qp_list_headers_v.END_DATE_ACTIVE,TRUNC(SYSDATE))
AND qp_list_headers_v.ORIG_ORG_ID = '".$_SESSION["ORG_ID"]."'
AND TO_NUMBER (PRODUCT_ID) = '".$INVERTORY_ITEM."' 
and qp_list_headers_v.LIST_HEADER_ID = '".$PRICE_LIST_ID."' " ;



$result= oci_parse($conn, $sql);
oci_execute($result);

$result1= oci_parse($conn, $sql1);
oci_execute($result1);



$arr = array();

while( $row = oci_fetch_array($result,OCI_ASSOC) ){

    while( $row1 = oci_fetch_array($result1,OCI_ASSOC) ){
        $unit_list_price = $row1['OPERAND'];
        
    }
    $inventory_item_id = $row['INVENTORY_ITEM_ID'];
    $description = $row['DESCRIPTION'];
    $uom = $row['PRIMARY_UOM_CODE'];
    if(empty($unit_list_price)){
        $unit_list_price = "No Price Available";
    }
    $arr[] = array("INVENTORY_ITEM_ID" => $inventory_item_id, "DESCRIPTION" => $description, "PRIMARY_UOM_CODE" => $uom, "OPERAND" => $unit_list_price);
}

// encoding array to json format
echo json_encode($arr);

?>