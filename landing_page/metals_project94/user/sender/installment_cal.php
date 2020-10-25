<?php

session_start();
include 'dbh.inc.php';


$dp_percent = $_POST['dp_percent'];
$no_installment = $_POST['no_installment'];
$actual_dp_amount = $_POST['actual_dp_amount'];
$Total_Interest_Amount = $_POST['Total_Interest_Amount'];
$Total = $_POST['Total'];
$ar = array();


if($_POST['dp_percent'] == 0){
    $dp_percent = $_SESSION['TEST_DP_PERCENT'];
}

if($_POST['actual_dp_amount'] == 0){
    $actual_dp_amount = $_SESSION['TEST_ACTUAL_DP_AMOUNT'];
}

$sql5 = "select sum(LINE_TOTAL) as TOTAL_UNIT_LIST_PRICE from XX_QUOTE_LINES_ALL
    where ASSESSMENT_NUMBER = '".$_SESSION["ASSESSMENT_NUMBER"]."' ";

    $result5 = oci_parse($conn, $sql5);

    oci_define_by_name($result5, "TOTAL_UNIT_LIST_PRICE", $Line_Total);
    oci_execute($result5);

    while(oci_fetch_array($result5,OCI_ASSOC)):
    
    endwhile;







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
            $Unit_Interest = ((($r / 100) * ($Unit_List_Price - (($Unit_List_Price * $dp_percent) / 100))) / 12) * $no_installment;
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



    


$ar[0] = round($Total_Interest_Amount,2);
$ar[1] = round($Total,2);


$Due_amount = $Line_Total - $actual_dp_amount;
$Total_Installment_Amount = $Due_amount + $ar[0];
$Monthly_Installment_Amount = $Total_Installment_Amount / $no_installment;

$ar[2] = round($Monthly_Installment_Amount,2);

$_SESSION['TEST_INTEREST_AMOUNT']=$ar[0] ;
$_SESSION['TEST_TOTAL']=$ar[1];
$_SESSION['TEST_MONTHLY_INSTALLMENT_AMOUNT']=$ar[2];

echo json_encode($ar);