<?php
session_start();

include "dbh.inc.php";


$delete_query = " Delete from XX_QUOTE_LINES_ALL where LINE_NO  = '".$_POST['LINE_NO']."' AND ASSESSMENT_NUMBER = '".$_SESSION['ASSESSMENT_NUMBER']."'";
   //mysqli_query($con, $update_query);
   $result_delete= oci_parse($conn, $delete_query);
   oci_execute($result_delete);






   $no_installment = $_POST['no_installment'];
   $Total_Interest_Amount = 0;
   $Total = 0;




   

$dp_amount = $_POST['dp_amount'];


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

