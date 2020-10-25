<?php

session_start();

include 'dbh.inc.php';

// header("Content-Type: application/json");

// $_SESSION['LINE_NO'] = $_POST['LINE_NO'];
$_SESSION['QUANTITY'] = $_POST['QUANTITY'];
$_SESSION['INVENTORY_ITEM_ID'] = $_POST['INVENTORY_ITEM_ID'];



$count = 0;
if(isset($_POST['no_installment'])){
  $no_installment = $_POST['no_installment'];
}
else{
  $no_installment = 0;
}

$Total_Interest_Amount = 0;
$Total = 0;


$QUOTE_HEADER_ID = $_SESSION["P_QUOTE_HEADER_ID"];
$LINE_NO = 0;
$QUANTITY = $_POST['QUANTITY'];
$INVENTORY_ITEM_ID = $_POST['INVENTORY_ITEM_ID'];
$UNIT_SELLING_PRICE = 0 ;
$ASSESSMENT_NUMBER = $_SESSION['ASSESSMENT_NUMBER'];

$line_no_sql = "select LINE_NO FROM XX_QUOTE_LINES_ALL WHERE ASSESSMENT_NUMBER = '".$_SESSION['ASSESSMENT_NUMBER']."' ORDER BY LINE_NO ASC ";
$result4 = oci_parse($conn, $line_no_sql);
oci_execute($result4);

          while($row4 =oci_fetch_array($result4,OCI_ASSOC)):
            $LINE_NO = $row4["LINE_NO"];

          endwhile;

          $LINE_NO = $LINE_NO + 1;


$sql =" SELECT inventory_item_id,item_code,description,
       PRIMARY_UOM_CODE FROM (SELECT ORGANIZATION_ID,inventory_item_id,
       segment1 || '.' || segment2 || '.' || segment3 || '.' || segment4
          item_code,
       description,
       PRIMARY_UOM_CODE
  FROM MTL_SYSTEM_ITEMS_B
 WHERE     INVENTORY_ITEM_FLAG = 'Y'
       AND ENABLED_FLAG = 'Y'
       AND CUSTOMER_ORDER_ENABLED_FLAG = 'Y'
       AND SO_TRANSACTIONS_FLAG = 'Y'
       AND SHIPPABLE_ITEM_FLAG = 'Y'
       AND INVOICE_ENABLED_FLAG = 'Y'
UNION ALL
SELECT ORGANIZATION_ID,inventory_item_id,
       segment1 || '.' || segment2 || '.' || segment3 || '.' || segment4
          item_code,
       description,
       PRIMARY_UOM_CODE
  FROM MTL_SYSTEM_ITEMS_B
 WHERE     ENABLED_FLAG = 'Y'
       AND CUSTOMER_ORDER_ENABLED_FLAG = 'Y'
       AND INVOICE_ENABLED_FLAG = 'Y'
       AND segment4 = 'TRACREG')
       WHERE inventory_item_id = '".$_SESSION["INVENTORY_ITEM_ID"]."'
       AND ORGANIZATION_ID = '".$_SESSION["ORGANIZATION_ID"]."'
       ORDER BY 2";

$result2 = oci_parse($conn, $sql);
oci_execute($result2);

          while($row =oci_fetch_array($result2,OCI_ASSOC)):
            $UNIT_OF_MEASURE = $row["PRIMARY_UOM_CODE"];
          endwhile;



$sql3 ="SELECT OPERAND, qp_list_headers_v.LIST_HEADER_ID, PRODUCT_ID
FROM qp_list_lines_v inner join qp_list_headers_v on
qp_list_lines_v.LIST_HEADER_ID = qp_list_headers_v.LIST_HEADER_ID
where LIST_LINE_TYPE_CODE = 'PLL'
AND PRODUCT_ATTRIBUTE = 'PRICING_ATTRIBUTE1'
AND TRUNC (SYSDATE) BETWEEN qp_list_lines_v.START_DATE_ACTIVE
AND NVL (qp_list_lines_v.END_DATE_ACTIVE, TRUNC (SYSDATE))
AND qp_list_headers_v.AUTOMATIC_FLAG='Y'
AND qp_list_headers_v.CURRENCY_CODE='BDT'
AND qp_list_headers_v.ACTIVE_FLAG='Y'
AND TRUNC(SYSDATE) BETWEEN qp_list_headers_v.START_DATE_ACTIVE AND NVL(qp_list_headers_v.END_DATE_ACTIVE,TRUNC(SYSDATE))
AND qp_list_headers_v.ORIG_ORG_ID = '".$_SESSION["ORG_ID"]."'
AND TO_NUMBER (PRODUCT_ID) = '".$_SESSION["INVENTORY_ITEM_ID"]."'
AND qp_list_headers_v.LIST_HEADER_ID = '".$_SESSION['PRICE_LIST_ID']."'  " ;


$result3 = oci_parse($conn, $sql3);
oci_execute($result3);

          while($row3 =oci_fetch_array($result3,OCI_ASSOC)):
            $UNIT_LIST_PRPICE = $row3["OPERAND"];
          endwhile;

          $LINE_TOTAL = $UNIT_LIST_PRPICE * $QUANTITY;


$query = "INSERT INTO XX_QUOTE_LINES_ALL(QUOTE_HEADER_ID,LINE_NO,QUANTITY,INVENTORY_ITEM_ID,UNIT_OF_MEASURE,UNIT_LIST_PRPICE,UNIT_SELLING_PRICE,ASSESSMENT_NUMBER,LINE_TOTAL)
VALUES (:QUOTE_HEADER_ID,:LINE_NO, :QUANTITY, :INVENTORY_ITEM_ID, :UNIT_OF_MEASURE,:UNIT_LIST_PRPICE,:UNIT_SELLING_PRICE,:ASSESSMENT_NUMBER,:LINE_TOTAL)";

$result1 = oci_parse($conn, $query);

oci_bind_by_name($result1, ":QUOTE_HEADER_ID", $QUOTE_HEADER_ID);
oci_bind_by_name($result1, ":LINE_NO", $LINE_NO);
oci_bind_by_name($result1, ":QUANTITY", $QUANTITY);
oci_bind_by_name($result1, ":INVENTORY_ITEM_ID", $INVENTORY_ITEM_ID);
oci_bind_by_name($result1, ":UNIT_OF_MEASURE", $UNIT_OF_MEASURE);
oci_bind_by_name($result1, ":UNIT_LIST_PRPICE", $UNIT_LIST_PRPICE);
oci_bind_by_name($result1, ":UNIT_SELLING_PRICE", $UNIT_SELLING_PRICE);
oci_bind_by_name($result1, ":ASSESSMENT_NUMBER", $ASSESSMENT_NUMBER);
oci_bind_by_name($result1, ":LINE_TOTAL", $LINE_TOTAL);
oci_execute($result1);






if(isset($_POST['dp_amount'])){
  $dp_amount = $_POST['dp_amount'];
}
else{
  $dp_amount = 0;
}





  $sql5 = "select sum(LINE_TOTAL) as TOTAL_UNIT_LIST_PRICE from XX_QUOTE_LINES_ALL
  where ASSESSMENT_NUMBER = '".$_SESSION["ASSESSMENT_NUMBER"]."' ";

  $result5 = oci_parse($conn, $sql5);

  oci_define_by_name($result5, "TOTAL_UNIT_LIST_PRICE", $Line_Total);
  oci_execute($result5);

  while(oci_fetch_array($result5,OCI_ASSOC)):

  endwhile;



if($Line_Total != NULL){
    $dp_percent = ($dp_amount / $Line_Total) * 100;
    $dp_percent_acurate = bcdiv($dp_percent,1,2);
    $actual_dp_amount_acc = ($Line_Total * $dp_percent_acurate) / 100;
    $_SESSION['TEST_DP_PERCENT'] = $dp_percent_acurate;
    $_SESSION['TEST_ACTUAL_DP_AMOUNT'] = $actual_dp_amount_acc;
}
else{
    $dp_percent_acurate = 0;
    $actual_dp_amount_acc = 0;
    $_SESSION['TEST_DP_PERCENT'] = $dp_percent_acurate;
    $_SESSION['TEST_ACTUAL_DP_AMOUNT'] = $actual_dp_amount_acc;
}













//no_of_installment_calculation


$sql65 = "select XX_QP_CUSTOM_API_PKG.Get_INTEREST_RATE('".$_SESSION["ORG_ID"]."') from dual";
$result65 = oci_parse($conn, $sql65);
oci_execute($result65);

    while($rows65 = oci_fetch_array($result65,OCI_RETURN_NULLS + OCI_ASSOC)):
        foreach ($rows65 as $r);
    endwhile;


$sql66 = "select * from XX_QUOTE_LINES_ALL where ASSESSMENT_NUMBER = '".$_SESSION["ASSESSMENT_NUMBER"]."' ";
$result66= oci_parse($conn, $sql66);
          oci_execute($result66);

          while($row66 =oci_fetch_array($result66,OCI_ASSOC)):
            $Inventory_Item_Id = $row66["INVENTORY_ITEM_ID"];
            $Unit_List_Price = $row66["UNIT_LIST_PRPICE"];
            $Quantity = $row66["QUANTITY"];
            $Unit_Interest = ((($r / 100) * ($Unit_List_Price - (($Unit_List_Price * $dp_percent_acurate) / 100))) / 12) * $no_installment;
    $Interest_amount = $Unit_Interest * $Quantity;
    $Total_Interest_Amount = $Total_Interest_Amount + $Interest_amount;
    $Unit_Selling_Price = $Unit_List_Price + $Unit_Interest;

    $sql = "Update XX_QUOTE_LINES_ALL set UNIT_SELLING_PRICE = '".$Unit_Selling_Price."'
    where INVENTORY_ITEM_ID = '".$Inventory_Item_Id."' and UNIT_LIST_PRPICE = '".$Unit_List_Price."'  ";
    $result= oci_parse($conn, $sql);
    oci_execute($result);

    $Extended_Price	= $Unit_Selling_Price * $Quantity;

    $Total = $Total + $Extended_Price;

          endwhile;






$Total_Interest_Amount_accurate = round($Total_Interest_Amount,2);
$Total_accurate = round($Total,2);


$Due_amount = $Line_Total - $actual_dp_amount_acc;
$Total_Installment_Amount = $Due_amount + $Total_Interest_Amount_accurate;
$Monthly_Installment_Amount = $Total_Installment_Amount / $no_installment;

$Monthly_Installment_Amount_accurate = round($Monthly_Installment_Amount,2);

$_SESSION['TEST_INTEREST_AMOUNT']=$Total_Interest_Amount_accurate;
$_SESSION['TEST_TOTAL']=$Total_accurate;
$_SESSION['TEST_MONTHLY_INSTALLMENT_AMOUNT']=$Monthly_Installment_Amount_accurate;
















$result_array[] = array("Dp_Percent" => $dp_percent_acurate, "Actual_Dp_Amount" => $actual_dp_amount_acc, "Total_Interest_Amount" => $Total_Interest_Amount_accurate, "ToTaL" => $Total_accurate, "Monthly_Installment_Amount" => $Monthly_Installment_Amount_accurate);









echo json_encode($result_array);


?>
