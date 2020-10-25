<?php

session_start();

error_reporting(0);

include 'dbh.inc.php';

if (!empty($_POST['ASSESSMENT_NUMBER'])) {
    $_SESSION['ASSESSMENT_NUMBER'] = $_POST['ASSESSMENT_NUMBER'];
  }

  if (!empty($_GET['ASSESSMENT_NUMBER'])) {
    $_SESSION['ASSESSMENT_NUMBER'] = $_GET['ASSESSMENT_NUMBER'];
  }

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <title></title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script>
    $(document).ready(function() {
      $("#hide1").click(function() {
        $("#hide_table").hide();
      });

    });
    $(document).ready(function() {
      $("#hide2").click(function() {
        $("#hide_table").hide();
      });

    });
    $(document).ready(function() {
      $("#hide3").click(function() {
        $("#hide_table").hide();
      });

    });
  </script>

  <style media="screen">
    .input-group-text {
      width: 260px;

    }

    .input-group-test {
      width: 50px;
      color:  	#FFA07A;
    }



    #discount-text {
      width: 75px;
    }

    ul li {
      padding: 2px 20px;

    }

    table {
      padding: 5px 20px;
      margin-left: 22px;
    }

    #first_table {
      margin-left: 40px;
    }

    #last_table {
      margin-left: 38px;
    }

    #button1 {
      margin-left: 30px;
    }

    #button2 {
      margin-left: 890px;
    }

    #test {
      font-size: 12px;
    }

    body {
      background-color: #E1E1E1;
    }

    .form-control {
      line-height: 220px;
      padding: 5px 5px;

    }
    .Agent{
      font-size: 15px;
    }
  </style>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

</head>
<body>
<form action="page1.inc.php" method="post">
  <br>
  <br>


<?php

$sql1 = "SELECT * FROM XX_QUOTE_HEADERS_ALL QH, XX_ONT_APPLICANT_DETAILS AD
        WHERE QH.ASSESSMENT_NUMBER = AD.ASSESSMENT_ID AND QH.ASSESSMENT_NUMBER = '".$_SESSION["ASSESSMENT_NUMBER"]."'";
            $result1= oci_parse($conn, $sql1);
            oci_execute($result1);
            while($row1 =oci_fetch_array($result1,OCI_ASSOC)):?>
  <br>
  <br>
  <table border="0" style="" align="" width="70%">
    <tr align="" bgcolor="#7DCEA0 ">
      <h3>
        <th colspan="2">Quote Headers</th>
      </h3>
    </tr>
    <tr>
      <td>
        <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text" id="">Oprerating Unit</span>

          </div>
          <input type="text" class="form-control" placeholder="TMPL Tractor" value="<?php echo $row1["OPERATING_UNIT"]; ?>"disabled>
        </div>
      </td>

    </tr>
    <tr>
      <td height="2">
        <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text" id="">Assessment No.</span>

          </div>
          <input type="text" class="form-control" placeholder="1" value="<?php $ASSESSMENT_NUMBER = $row1["ASSESSMENT_NUMBER"];
          $QUOTE_HEADER_ID = $row1["QUOTE_HEADER_ID"]; echo $row1["ASSESSMENT_NUMBER"];?>" disabled>
        </div>
      </td>

    </tr>
            <?php endwhile;?>
  </table>

  <br>
  <br>

  <nav>
      <div class="nav nav-tabs" id="nav-tab" role="tablist">
        <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Summary Information</a>
        <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Payment Information</a>
        <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Other Information</a>
      </div>
    </nav>
    <div class="tab-content" id="nav-tabContent">
      <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">

<?php

$sql_all_table = "
SELECT AD.ORG_ID,
         ASSESSMENT_ID,
         AD.OPERATING_UNIT,
         OOD.ORGANIZATION_ID,
         OOD.ORGANIZATION_CODE,
         CUST.CUSTOMER_ID,
         CUST.CUSTOMER_NUMBER,
         APPLICANT_NAME CUSTOMER_APPLICANT_NAME,
         FATHERS_NAME,
         PER_VILLAGE,
         PER_POST,
         PER_THANA,
         PER_DISTRICT,
         MOBILE,
         TER.SEGMENT1 ZONE,
         TER.SEGMENT2 REGION,
         TER.SEGMENT3 TERRITORY,
         NULL TERRITORY_INCHARGE_NAME,
         NULL REGIONAL_INCHARGE_NAME,
         OCCUPATION,
         QUOTE_HEADER_ID,
         QH.QUOTE_NUMBER,
         QH.QUOTE_NAME,
         QH.QUOTE_DATE,
         QH.QUOTE_STATUS,
         QH.CURRENCY,
         QH.DP_AMOUNT,
         QH.DP_PERCENT,
         QH.QUOTE_TYPE_ID,
         QH.PRICE_LIST_ID,
         QH.REMITTANCE_BANK_ID,
         ACTUAL_DP_AMOUNT,
         NO_OF_INSTALLMENT,
         DISCOUNT_TYPE,
         DISCOUNT_VALUE,
         NO_OF_FREE_INSTALLMENT,
         INSTALLMENT_START_DAY,
         PAYMENT_TYPE,
         CHEQUE_REF_NO,
         BANK_ACCOUNT_NO,
         MICR_CHEQUE_GIVEN_IN_DEL,
         CUSTOMER_BANK_NAME,
         AGENT_DEALER_COMM_PAYABLE,
         NAME_OF_AGENT_DEALER,
         NAME_OF_PROMO_SCHEME,
         PROMO_GIFT_APPLICABLE,
         NAME_OF_GIFT,
         REMARKS,
         MONTHLY_INCOME,
         NVL (PARENTS_NO, 0) + NVL (CHILD_NO, 0) + NVL (BROTHER_SISTER_NO, 0)
            TOTAL_DEPENDENT,
         NVL (
            SUM (CASE WHEN SOURCE_TYPE = 'Own Saving' THEN AMOUNT ELSE 0 END),
            0)
            OWN_EQUITY_AMOUNT,
         NVL (SUM (CASE WHEN SOURCE_TYPE = 'Bank Loan' THEN AMOUNT ELSE 0 END),
              0)
            BANK_LOAN_AMOUNT,
         NVL (SUM (CASE WHEN SOURCE_TYPE = 'Ngo Loan' THEN AMOUNT ELSE 0 END),
              0)
            NGO_LOAN_AMOUNT,
         NVL (SUM (CASE WHEN SOURCE_TYPE = 'Others' THEN AMOUNT ELSE 0 END), 0)
            OTHER_LOAN_AMOUNT
    FROM XX_ONT_APPLICANT_DETAILS AD,
         XX_ONT_SOURCE_FUND SF,
         OE_ORDER_HEADERS_ALL OH,
         ORG_ORGANIZATION_DEFINITIONS OOD,
         XX_AR_CUSTOMER_SITE_V CUST,
         RA_TERRITORIES TER,
         XX_QUOTE_HEADERS_ALL QH
         WHERE AD.FILE_NO = SF.FILE_NO
               AND AD.ASSESSMENT_ID = QH.ASSESSMENT_NUMBER
               AND AD.ORDER_NUMBER = OH.ORDER_NUMBER
               AND AD.ORG_ID = OH.ORG_ID
               AND OH.SHIP_FROM_ORG_ID = OOD.ORGANIZATION_ID
               AND OH.SOLD_TO_ORG_ID=CUST.CUSTOMER_ID
               AND OH.SHIP_TO_ORG_ID=CUST.SHIP_TO_ORG_ID
               AND CUST.TERRITORY_ID=TER.TERRITORY_ID(+)
               AND AD.ASSESSMENT_ID = '".$_SESSION['ASSESSMENT_NUMBER']."'
GROUP BY AD.ORG_ID,
         ASSESSMENT_ID,
         AD.OPERATING_UNIT,
         OOD.ORGANIZATION_ID,
         OOD.ORGANIZATION_CODE,
         CUST.CUSTOMER_ID,
         CUST.CUSTOMER_NUMBER,
         APPLICANT_NAME,
         FATHERS_NAME,
         PER_VILLAGE,
         PER_POST,
         PER_THANA,
         PER_DISTRICT,
         MOBILE,
         TER.SEGMENT1,
         TER.SEGMENT2,
         TER.SEGMENT3,
         OCCUPATION,
         QUOTE_HEADER_ID,
         QH.QUOTE_NUMBER,
         QH.QUOTE_NAME,
         QH.QUOTE_DATE,
         QH.QUOTE_STATUS,
         QH.CURRENCY,
         QH.DP_AMOUNT,
         QH.DP_PERCENT,
         QH.QUOTE_TYPE_ID,
         QH.PRICE_LIST_ID,
         QH.REMITTANCE_BANK_ID,
         ACTUAL_DP_AMOUNT,
         NO_OF_INSTALLMENT,
         DISCOUNT_TYPE,
         DISCOUNT_VALUE,
         NO_OF_FREE_INSTALLMENT,
         INSTALLMENT_START_DAY,
         PAYMENT_TYPE,
         CHEQUE_REF_NO,
         BANK_ACCOUNT_NO,
         MICR_CHEQUE_GIVEN_IN_DEL,
         CUSTOMER_BANK_NAME,
         AGENT_DEALER_COMM_PAYABLE,
         NAME_OF_AGENT_DEALER,
         NAME_OF_PROMO_SCHEME,
         PROMO_GIFT_APPLICABLE,
         NAME_OF_GIFT,
         REMARKS,
         MONTHLY_INCOME,
         NVL (PARENTS_NO, 0) + NVL (CHILD_NO, 0) + NVL (BROTHER_SISTER_NO, 0)
";
$result_all_table= oci_parse($conn, $sql_all_table);
   oci_execute($result_all_table);

   $resultCheck = oci_fetch_array($result_all_table,OCI_ASSOC);
?>


        <table class="table-responsive-md" border="0" style="" width="110%">
          <tr align="" bgcolor="#6bd1e7">
            <h3>
              <th colspan="3">Summary Informations</th>
            </h3>
          </tr>
          <tr>
            <td>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="">Customer Name</span>
                </div>
                <input type="text" name="APPLICANT_NAME" value="<?php echo $resultCheck['CUSTOMER_APPLICANT_NAME']; $_SESSION['APPLICANT_NAME'] = $resultCheck['APPLICANT_NAME']; ?>" class="form-control" disabled>
              </div>
            </td>

            <td>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"  id="">Quote Number</span>
                </div>

                <input type="text" name="" class="form-control" value="<?php echo $resultCheck['QUOTE_NUMBER']; $_SESSION["QUOTE_NUMBER"] = $resultCheck['QUOTE_NUMBER'];  ?>" disabled>
              </div>
            </td>
            <?php
            $_SESSION["ORG_ID"] = $resultCheck['ORG_ID'];
            $SQL_PRICE_LIST_NAME=  "SELECT list_header_id price_list_id,NAME price_list_name FROM qp_list_headers_v
            WHERE AUTOMATIC_FLAG='Y'
            AND CURRENCY_CODE='BDT'
            AND ACTIVE_FLAG='Y'
            AND TRUNC(SYSDATE) BETWEEN START_DATE_ACTIVE AND NVL(END_DATE_ACTIVE,TRUNC(SYSDATE))
            AND ORIG_ORG_ID =  '".$resultCheck['ORG_ID']."'
            AND list_header_id = '".$resultCheck['PRICE_LIST_ID']."' ";

            $result_SQL_PRICE_LIST_NAME= oci_parse($conn, $SQL_PRICE_LIST_NAME);
            oci_execute($result_SQL_PRICE_LIST_NAME);
            $row_SQL_PRICE_LIST_NAME =oci_fetch_array($result_SQL_PRICE_LIST_NAME,OCI_RETURN_NULLS+OCI_ASSOC);
 ?>
            <td>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"  id="">Price List Name</span>
                </div>
                 <input type="text" class="form-control" disabled value="<?php echo $row_SQL_PRICE_LIST_NAME["PRICE_LIST_NAME"]; ?>" >
              </div>

            </td>

          </tr>
          <tr>
            <td>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="" >Customer Number</span>
                </div>

                <input type="text"  name="CUSTOMER_ID" value="<?php echo $resultCheck['CUSTOMER_NUMBER']; $_SESSION["CUSTOMER_ID"] = $resultCheck['CUSTOMER_ID'];?>" class="form-control" disabled>
              </div>
            </td>
            <td>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"  id="">Quote Name</span>
                </div>
                <input disabled type="text" name="QUOTE_NAME" value="<?php echo $resultCheck['QUOTE_NAME']; $_SESSION["QUOTE_NAME"] = $resultCheck['QUOTE_NAME']; ?>" class="form-control">
              </div>
            </td>

            <!-- <td rowspan="7"> -->

            <td>
            <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="">Quote Status
                  </span>
                </div>
                <input type="text" class="form-control" value="<?php echo "DRAFT"; $_SESSION['QUOTE_STATUS'] = "PENDING"; ?>"  disabled>
              </div>
            </td>

          </tr>
          <tr>

            <td>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="">Father Name / Spouse Name</span>
                </div>
                <input disabled  type="text" name="FATHERS_NAME" value="<?php echo $resultCheck["FATHERS_NAME"]; ?>" class="form-control"  disabled>
              </div>
            </td>

            <td>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="">Quote Date</span>
                </div>
                <input disabled type="date" name="QUOTE_DATE" value="<?php echo $resultCheck["QUOTE_DATE"]; $_SESSION['QUOTE_DATE'] = $resultCheck["QUOTE_DATE"]; ?>" class="form-control">
              </div>
            </td>





          </tr>
          <tr>
            <td>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="">Village</span>
                </div>
                <input type="text" name="PER_VILLAGE" value="<?php echo $resultCheck['PER_VILLAGE']; ?>" class="form-control" disabled>
              </div>
            </td>
<?php
$sql_QUOTE_TYPE="SELECT TTT.TRANSACTION_TYPE_ID, NAME, DESCRIPTION
FROM oe_transaction_types_tl ttt, oe_transaction_types_all tta
WHERE ttt.TRANSACTION_TYPE_ID = tta.TRANSACTION_TYPE_ID
AND TRANSACTION_TYPE_CODE = 'ORDER'
AND NVL (END_DATE_ACTIVE, TRUNC (SYSDATE)) >= TRUNC (SYSDATE)
AND tta.org_id = '".$resultCheck['ORG_ID']."'
AND tta.TRANSACTION_TYPE_ID = '".$resultCheck['QUOTE_TYPE_ID']."'";

$result_QUOTE_TYPE= oci_parse($conn, $sql_QUOTE_TYPE);
oci_execute($result_QUOTE_TYPE);
$row_QUOTE_TYPE = oci_fetch_array($result_QUOTE_TYPE,OCI_ASSOC);
?>
            <td>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"  id="">Quote Type</span>
                </div>
                <input disabled type="text" name="QUOTE_TYPE" value="<?php echo $row_QUOTE_TYPE['NAME']; $_SESSION['QUOTE_TYPE'] = $row_QUOTE_TYPE['NAME']; ?>" class="form-control">
              </div>
            </td>
            <td>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="">DESCRIPTION</span>
                </div>
                <input disabled type="text" name="DESCRIPTION1" value="<?php echo $row_QUOTE_TYPE['DESCRIPTION'];?>" class="form-control">
                <!-- <select disabled name="DESCRIPTION1" id="DESCRIPTION1" class="custom-select" >
                <option value="0">No Value</option>
                </select> -->
                </div>
            </td>

          </tr>
          <tr>
            <td>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="">Post</span>
                </div>

                <input type="text" name="PER_POST" value="<?php echo $resultCheck['PER_POST']; ?>"  class="form-control" disabled>
              </div>
            </td>

            <td>
            <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="">Currency
                </div>
                <input disabled type="text"  name="CURRENCY" value="<?php echo $resultCheck["CURRENCY"]; $_SESSION['CURRENCY'] = $resultCheck["CURRENCY"]; ?>" class="form-control">
              </div>
            </td>


          </tr>
          <tr>
            <td>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="">Thana
                  </span>
                </div>
                <input type="text" name="PER_THANA" value="<?php echo $resultCheck["PER_THANA"]; ?>"  class="form-control" disabled>
              </div>
            </td>


<?php


$dp_percent = $resultCheck['DP_PERCENT'];
$no_installment = $resultCheck['NO_OF_INSTALLMENT'];
$actual_dp_amount = $resultCheck['ACTUAL_DP_AMOUNT'];
$Total_Interest_Amount = 0;
$Total = 0;
$ar = array();



$sql_line_total = "select sum(LINE_TOTAL) as TOTAL_UNIT_LIST_PRICE from XX_QUOTE_LINES_ALL
    where ASSESSMENT_NUMBER = '".$_SESSION["ASSESSMENT_NUMBER"]."' ";

    $result_line_total = oci_parse($conn, $sql_line_total);

    oci_define_by_name($result_line_total, "TOTAL_UNIT_LIST_PRICE", $Line_Total);
    oci_execute($result_line_total);

    while(oci_fetch_array($result_line_total,OCI_ASSOC)):

    endwhile;







$sql65 = "select XX_QP_CUSTOM_API_PKG.Get_INTEREST_RATE('".$resultCheck["ORG_ID"]."') from dual";
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

    $sql000 = "Update XX_QUOTE_LINES_ALL set UNIT_SELLING_PRICE = '".$Unit_Selling_Price."'
    where INVENTORY_ITEM_ID = '".$Inventory_Item_Id."' and UNIT_LIST_PRPICE = '".$Unit_List_Price."'  ";
    $result000= oci_parse($conn, $sql000);
    oci_execute($result000);

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

?>







            <td>
            <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="">Interest Amount
                </div>
                <input type="text" name="" class="form-control" value="<?php echo $_SESSION["TEST_INTEREST_AMOUNT"]; $_SESSION["INTEREST_AMOUNT"] = $_SESSION["TEST_INTEREST_AMOUNT"];?>" disabled>
              </div>
            </td>


          </tr>
          <tr>
            <td>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"  id="">District
                  </span>
                </div>
                <input type="text" name="PER_DISTRICT" value="<?php echo $resultCheck["PER_DISTRICT"]; ?>" class="form-control" disabled>
              </div>
            </td>

            <td>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="">Monthly Installment Amount
                </div>
                <input type="text" name="" class="form-control" value="<?php echo $_SESSION["TEST_MONTHLY_INSTALLMENT_AMOUNT"]; $_SESSION["MONTHLY_INSTALLMENT_AMOUNT"] = $_SESSION["TEST_MONTHLY_INSTALLMENT_AMOUNT"];?>" disabled>
              </div>
            </td>
          </tr>
          <tr>
            <td>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="">Mobile Number
                  </span>
                </div>
                <input type="text" name="MOBILE" value="<?php echo $resultCheck["MOBILE"];  ?>"  class="form-control" disabled>
              </div>
            </td>

            <td>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="">Total
                </div>
                <input type="text" name="" class="form-control" value="<?php echo $_SESSION["TEST_TOTAL"]; $_SESSION["TOTAL"] = $_SESSION["TEST_TOTAL"]; ?>" disabled>
              </div>
            </td>
          </tr>
        </table>






      </div>

      <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">




        <table class="table-responsive-md" border="0" style="" width="98%">
          <tr align="" bgcolor="#F4D03F">
            <h3>
              <th colspan="3">Payment Terms Information</th>
            </h3>
          </tr>
          <tr>
            <td>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"  id="">DP Amount</span>
                </div>
                <input disabled type="text" name="DP_AMOUNT" value="<?php echo $resultCheck["DP_AMOUNT"]; $_SESSION['DP_AMOUNT'] = $resultCheck["DP_AMOUNT"]; ?>" class="form-control">
              </div>
            </td>

            <td>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"  id="">Payment Type</span>
                </div>
                 <input type="text" class="form-control" disabled value="<?php echo $resultCheck["PAYMENT_TYPE"]; $_SESSION['PAYMENT_TYPE'] = $resultCheck["PAYMENT_TYPE"]; ?>" >
              </div>

            </td>

            <td>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text Agent" id="">Agent/Dealar Commission payable?</span>
                </div>
                <input type="text" disabled class="form-control" name="AGENT_DEALER_COMM_PAYABLE" value="<?php echo $resultCheck["AGENT_DEALER_COMM_PAYABLE"]; $_SESSION["AGENT_DEALER_COMM_PAYABLE"] = $resultCheck["AGENT_DEALER_COMM_PAYABLE"];  ?>">

              </div>

            </td>



          </tr>
          <tr>
            <td>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"  id="">DP Percent</span>
                </div>
                <input type="text" name="" class="form-control" value="<?php echo $resultCheck['DP_PERCENT']; $_SESSION['DP_PERCENT'] = $resultCheck['DP_PERCENT']; ?>" disabled>
              </div>
            </td>

            <td>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"  id="">Cheque No. / Reference No.</span>
                </div>
                <input disabled type="text" name="CHEQUE_REF_NO" value="<?php echo $resultCheck["CHEQUE_REF_NO"]; $_SESSION['CHEQUE_REF_NO'] = $resultCheck["CHEQUE_REF_NO"]; ?>"  class="form-control">
              </div>
            </td>
            <td>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"  id="">Name of Agent/Dealer</span>
                </div>
                <input disabled type="text" name="NAME_OF_AGENT_DEALER" value="<?php echo $resultCheck["NAME_OF_AGENT_DEALER"]; $_SESSION['NAME_OF_AGENT_DEALER'] = $resultCheck["NAME_OF_AGENT_DEALER"];?>" class="form-control">
              </div>
            </td>

          </tr>
          <tr>

            <td>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"  id="">Actual DP Amount</span>
                </div>
                <input type="text" name="" class="form-control" value="<?php echo $resultCheck['ACTUAL_DP_AMOUNT']; $_SESSION['ACTUAL_DP_AMOUNT'] = $resultCheck['ACTUAL_DP_AMOUNT']; ?>" disabled>
              </div>
            </td>

<?php
$REMITTANCE_BANK_ID=$resultCheck['REMITTANCE_BANK_ID'];


    $qry="SELECT DISTINCT BANK_ID,BANK_NAME FROM XX_CE_BANK_BRCH_ACCNTS_V
       WHERE ORG_ID='".$resultCheck['ORG_ID']."'
       AND BANK_ID='".$REMITTANCE_BANK_ID."' ";


    $qryrst= oci_parse($conn, $qry);
    oci_execute($qryrst);
    $remi=oci_fetch_array($qryrst,OCI_ASSOC);



  $qry1= "SELECT DISTINCT BRANCH_ID,BRANCH_NAME FROM XX_CE_BANK_BRCH_ACCNTS_V
         WHERE ORG_ID='".$resultCheck['ORG_ID']."'
         AND BANK_ID ='".$REMITTANCE_BANK_ID."' ";

     $qryrst1= oci_parse($conn, $qry1);
     oci_execute($qryrst1);
     $remi_b=oci_fetch_array($qryrst1,OCI_RETURN_NULLS+OCI_ASSOC);


     $BRANCH_ID=$remi_b['BRANCH_ID'];

    $qry2="SELECT distinct BANK_ACCOUNT_ID,BANK_ACCOUNT_NUM FROM XX_CE_BANK_BRCH_ACCNTS_V
     WHERE ORG_ID='".$resultCheck['ORG_ID']."'
     AND BANK_ID='".$REMITTANCE_BANK_ID."'
     AND BRANCH_ID='".$BRANCH_ID."' ";

     $qryrst2= oci_parse($conn, $qry2);
     oci_execute($qryrst2);
     $Bank_A=oci_fetch_array($qryrst2,OCI_RETURN_NULLS+OCI_ASSOC);


?>
            <td>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"  id="">Remittance Bank Name</span>
                </div>
                <input disabled type="text" name="REMITTANCE_BANK_NAME" value="<?php echo $remi['BANK_NAME']; $_SESSION['REMITTANCE_BANK_NAME'] = $REMITTANCE_BANK_ID; ?>" class="form-control">
              </div>
            </td>
            <td>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"  id="">Name of the Promotional Scheme</span>
                </div>
                <input disabled type="text" name="NAME_OF_PROMO_SCHEME" value="<?php echo $resultCheck["NAME_OF_PROMO_SCHEME"]; $_SESSION["NAME_OF_PROMO_SCHEME"] = $resultCheck["NAME_OF_PROMO_SCHEME"]; ?>" class="form-control">
              </div>
            </td>




          </tr>
          <tr>
            <td>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"  id="">No. of Installment</span>
                </div>
                <input disabled type="text" name="NO_OF_INSTALLMENT" value="<?php echo $resultCheck["NO_OF_INSTALLMENT"]; $_SESSION['NO_OF_INSTALLMENT'] = $resultCheck["NO_OF_INSTALLMENT"]; ?>" class="form-control">
              </div>
            </td>

            <td>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"  id="">Branch Name</span>
                </div>
                <input disabled type="text" name="REMITTANCE_BRANCE_NAME" value="<?php echo $remi_b['BRANCH_NAME']; $_SESSION['REMITTANCE_BRANCE_NAME'] = $BRANCH_ID; ?>" class="form-control">
              </div>
            </td>
            <td>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text Agent" id="">Promotioanl Gift Applicable?</span>
                </div>
                <input type="text" class="form-control" disabled name="PROMO_GIFT_APPLICABLE" value="<?php echo $resultCheck["PROMO_GIFT_APPLICABLE"]; $_SESSION['PROMO_GIFT_APPLICABLE'] = $resultCheck["PROMO_GIFT_APPLICABLE"]; ?>">
              </div>
            </td>

          </tr>
          <tr>
            <td>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="">Discount</span>

                  <input disabled type="text" class="form-control" name="DISCOUNT_VALUE" value="<?php echo $resultCheck["DISCOUNT_VALUE"]; $_SESSION['DISCOUNT_VALUE'] = $resultCheck["DISCOUNT_VALUE"]; ?>" id="discount-text">
                </div>
                <input class="form-control" type="text" name="DISCOUNT_TYPE" value="<?php echo $resultCheck["DISCOUNT_TYPE"]; $_SESSION['DISCOUNT_TYPE'] = $resultCheck["DISCOUNT_TYPE"]; ?>" disabled >
            </td>

            <td>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"  id="">Bank Account No.
                  </span>
                </div>

                <input disabled type="text" name="BANK_ACCOUNT_NO" value="<?php echo $Bank_A['BANK_ACCOUNT_NUM']; $_SESSION['BANK_ACCOUNT_NO'] = $Bank_A['BANK_ACCOUNT_NUM']; $_SESSION['BANK_ACCOUNT_ID'] = $Bank_A['BANK_ACCOUNT_ID']; ?>" class="form-control">
              </div>
            </td>
            <td>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"  id="">Name of the Gift
                  </span>
                </div>
                <input disabled type="text" name="NAME_OF_GIFT" value="<?php echo $resultCheck["NAME_OF_GIFT"]; $_SESSION["NAME_OF_GIFT"] = $resultCheck["NAME_OF_GIFT"];?>" class="form-control">
              </div>
            </td>


          </tr>
          <tr>
            <td>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="">No. of Interest Free Installment
                  </span>
                </div>
                <input disabled type="text" name="NO_OF_FREE_INSTALLMENT" value="<?php echo $resultCheck["NO_OF_FREE_INSTALLMENT"]; $_SESSION['NO_OF_FREE_INSTALLMENT'] = $resultCheck["NO_OF_FREE_INSTALLMENT"]; ?>"  class="form-control">
              </div>
            </td>

            <td>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="test">MICR Cheque will be given during Delivery?</span>
                </div>
                <input type="text" class="form-control" disabled name="MICR_CHEQUE_GIVEN_IN_DEL" value="<?php echo $resultCheck["MICR_CHEQUE_GIVEN_IN_DEL"]; $_SESSION['MICR_CHEQUE_GIVEN_IN_DEL'] = $resultCheck["MICR_CHEQUE_GIVEN_IN_DEL"]; ?>">
              </div>
            </td>

            <td>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text" > Registration Included ?</span>
                </div>
                <input type="text" class="form-control" disabled name="REGISTRATION_INC" value="<?php echo $resultCheck["REGISTRATION_INC"]; $_SESSION['REGISTRATION_INC'] = $resultCheck["REGISTRATION_INC"]; ?>">
              </div>
            </td>

          </tr>
          <tr>
            <td>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="test">Day of the Month to start Installment
                  </span>
                </div>
                <input disabled type="text" name="INSTALLMENT_START_DAY" value="<?php echo $resultCheck["INSTALLMENT_START_DAY"]; $_SESSION['INSTALLMENT_START_DAY'] = $resultCheck["INSTALLMENT_START_DAY"]; ?>" class="form-control">
              </div>
            </td>

            <td>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"  id="">Customer Bank Name</span>
                </div>
                <input disabled type="text" name="CUSTOMER_BANK_NAME" value="<?php echo $resultCheck["CUSTOMER_BANK_NAME"]; $_SESSION['CUSTOMER_BANK_NAME'] = $resultCheck["CUSTOMER_BANK_NAME"]; ?>" class="form-control">
              </div>
            </td>

            <td>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"  id="">Customer Bank Name</span>
                </div>
                <input disabled type="text" name="REGISTRATION_INC" value="<?php echo $resultCheck["REGISTRATION_INC"]; $_SESSION['REGISTRATION_INC'] = $resultCheck["REGISTRATION_INC"]; ?>" class="form-control">
              </div>
            </td>
          </tr>

        </table>







      </div>





      <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">




        <table class="table-responsive-md" border="0" style="" width="70%">
          <tr align="" bgcolor="#3CE7BC">
            <h3>
              <th colspan="2">Other Informations</th>
            </h3>
          </tr>
          <tr>
            <td>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="">Zone</span>
                </div>
                <input type="text" name="" class="form-control" disabled>
              </div>
            </td>

            <td>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="">Profession</span>
                </div>
                <input disabled type="text" name="OCCUPATION" value="<?php echo $resultCheck["OCCUPATION"];?>" class="form-control">
              </div>

            </td>



          </tr>
          <tr>
            <td>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="">Region</span>
                </div>
                <input type="text" name="REGION" value="<?php echo  $resultCheck["REGION"];?>" class="form-control" disabled>
              </div>
            </td>

            <td>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="">Monthly Income</span>
                </div>
                <input disabled type="text" name="MONTHLY_INCOME" value="<?php echo $resultCheck["MONTHLY_INCOME"] ;?>" class="form-control">
              </div>
            </td>

          </tr>
          <tr>

            <td>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="">Territory</span>
                </div>
                <input type="text" name="TERRITORY" value="<?php echo $resultCheck["TERRITORY"]; ?>"  class="form-control" disabled>
              </div>
            </td>

            <td>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="">Dependent</span>
                </div>
                <input disabled type="text" name="TOTAL_DEPENDENT" value="<?php echo $resultCheck["TOTAL_DEPENDENT"];?>" class="form-control">
              </div>
            </td>





          </tr>
          <tr>
            <td>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text" id=""> Territory Incharge Name</span>
                </div>
                <input type="text" name="" class="form-control" disabled>
              </div>
            </td>


            <td>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="">Own Equity Amount</span>
                </div>
                <input disabled type="text" name="OWN_EQUITY_AMOUNT" value="<?php echo $resultCheck["OWN_EQUITY_AMOUNT"]; ?>" class="form-control">
              </div>
            </td>

          </tr>
          <tr>
            <td>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="">Regional Incharge Name</span>
                </div>
                <input type="text" name="" class="form-control" disabled>
              </div>
            </td>

            <td>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="">Bank Loan Amount</span>
                </div>
                <input disabled type="text" name="BANK_LOAN_AMOUNT" value="<?php echo $resultCheck["BANK_LOAN_AMOUNT"]; ?>"class="form-control">
              </div>
            </td>


          </tr>
          <tr>
            <td>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="">Warehouse Code
                  </span>

                </div>
                <input type="text" class="form-control" name="ORGANIZATION_CODE" value="<?php echo $resultCheck["ORGANIZATION_CODE"]; $_SESSION["ORGANIZATION_ID"] = $resultCheck["ORGANIZATION_ID"];?>"  disabled>
              </div>
            </td>

            <td>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="">NGO Loan Amount
                  </span>

                </div>
                <input disabled type="text" name="NGO_LOAN_AMOUNT" value="<?php echo $resultCheck["NGO_LOAN_AMOUNT"];?>" class="form-control">
              </div>
            </td>



          </tr>
          <tr>
            <td>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"  id="">Comments
                  </span>

                </div>
                <input disabled type="text" name="REMARKS" value="<?php echo $resultCheck['REMARKS']; $_SESSION['REMARKS'] = $resultCheck['REMARKS'];?>"  class="form-control">
              </div>
            </td>

            <td>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="">Other Loan Amount
                  </span>

                </div>
                <input disabled type="text" name="OTHER_LOAN_AMOUNT" value="<?php echo $resultCheck["OTHER_LOAN_AMOUNT"];?>" class="form-control">
              </div>
            </td>
          </tr>


        </table>




      </div>
    </div>

  <br>
  <br>

  <table class="table-responsive-md" border="0" style="width:69%" align="center" id="last_table">
    <tr bgcolor="#F174F7">
      <h3>
        <th colspan="7">Quote Lines</th>
      </h3>

    </tr>
    <tr>
      <td align="">Line No.</td>
      <td align="">Order Item ID</td>

      <td align="">Quantity</td>
      <td align="">UOM</td>
      <td align="">Unit Selling Price</td>
      <td align="">Unit List Price</td>
    </tr>
    <?php


$sql = "select * from XX_QUOTE_LINES_ALL WHERE ASSESSMENT_NUMBER = '".$_SESSION["ASSESSMENT_NUMBER"]."' order by LINE_NO ASC";
          $result1= oci_parse($conn, $sql);
          oci_execute($result1);
          while($row =oci_fetch_array($result1,OCI_ASSOC)):
?>
    <tr>
      <td><input type="text" class="form-control" value="<?php echo $row["LINE_NO"]; ?>" disabled></td>
      <td><input type="text" class="form-control" value="<?php echo $row["INVENTORY_ITEM_ID"]; ?>" disabled></td>
      <td><input type="text" class="form-control" value="<?php echo $row["QUANTITY"]; ?>" disabled></td>
      <td><input type="text" class="form-control" value="<?php echo $row["UNIT_OF_MEASURE"]; ?>" disabled></td>
      <td><input type="text" class="form-control" value="<?php echo $row["UNIT_SELLING_PRICE"]; ?>" disabled></td>
      <td><input type="text" class="form-control" value="<?php echo $row["UNIT_LIST_PRPICE"]; ?>" disabled ></td>
    </tr>

    <?php endwhile; ?>








    <table align="center" border="0" width="70%">
    <tr align="" bgcolor="#6bd1e7">
      <h3>
        <th colspan="3">Approvers</th>
      </h3>

    </tr>
    <tr>
      <td style="width: 50px;"><input type="text" class="form-control sl" placeholder="SL" disabled></td>
      <td><input type="text" class="form-control name" placeholder="Name" disabled></td>
      <td style="width: 300px;"><input type="text" class="form-control response" placeholder="Response" disabled></td>
    </tr>

    <?php
    $_SESSION["PROCEDURE_STATUS"] = 1;
    $_SESSION["P_QUOTE_HEADER_ID"] = $resultCheck['QUOTE_HEADER_ID'];
    $list=" SELECT * FROM XX_QUOTE_DRAFT_APPR_LIST_ALL WHERE QUOTE_HEADER_ID = '".$resultCheck['QUOTE_HEADER_ID']."' ORDER BY SEQUENCE_NO ASC ";

    $A_list= oci_parse($conn,$list);
     oci_execute($A_list);
   $i=0;
    while($A_list_full = oci_fetch_array($A_list,OCI_ASSOC)):
  $i++;
 $ffname="SELECT PAPF.PERSON_ID,
       PAPF.EMPLOYEE_NUMBER,
       PAPF.FULL_NAME,
       PJ.NAME DESIGNATION
  FROM PER_ALL_PEOPLE_F PAPF, PER_ALL_ASSIGNMENTS_F PAAF, PER_JOBS PJ
 WHERE     1 = 1
       AND PAPF.PERSON_ID = PAAF.PERSON_ID(+)
       AND TRUNC (SYSDATE) BETWEEN PAPF.EFFECTIVE_START_DATE
                               AND NVL (PAPF.EFFECTIVE_END_DATE,
                                        TRUNC (SYSDATE))
       AND TRUNC (SYSDATE) BETWEEN PAAF.EFFECTIVE_START_DATE(+)
                               AND NVL (PAAF.EFFECTIVE_END_DATE(+),
                                        TRUNC (SYSDATE))
       AND PAAF.JOB_ID = PJ.JOB_ID(+)
       AND PAAF.BUSINESS_GROUP_ID = PJ.BUSINESS_GROUP_ID(+)
       AND PAAF.ASSIGNMENT_TYPE(+) = 'E'
       and papf.person_id ='".$A_list_full['EMPLOYEE_ID']."' ";

       $A_ffname= oci_parse($conn,$ffname);
       oci_execute($A_ffname);
       $A_ffname_full = oci_fetch_array($A_ffname,OCI_ASSOC)


     ?>
    <tr>
      <td><input type="text" class="form-control sl" placeholder="<?php echo $i; ?>" disabled></td>
      <td><input type="text" class="form-control " placeholder="<?php  echo $A_ffname_full['FULL_NAME'];?> (<?php echo $A_list_full['LIST_MEMBER']; ?>)" disabled></td>
      <td><input type="text" class="form-control " placeholder="<?php  echo $A_list_full['ACTIVITY_TYPE'];?>" disabled></td>
      <?php

      // $FULL_NAME[$i-1]=$A_ffname_full['FULL_NAME'];

      // $EMPLOYEE_IDA[$i-1]=$A_list_full['EMPLOYEE_ID'];

      if($A_list_full['PERFORM_ACTIVITY_TYPE_CODE'] == 'P')
      { ?>

      <td><input type="text" class="form-control" placeholder="Pending" disabled></td>

    <?php
    }
    else if ($A_list_full['PERFORM_ACTIVITY_TYPE_CODE'] == 'N')
    {
      ?>
    <td><input type="text" class="form-control" placeholder="Not Submitted" disabled></td>

    <?php }


    else if ($A_list_full['PERFORM_ACTIVITY_TYPE_CODE'] == 'F')
    {
      ?>
    <td><input type="text" class="form-control" placeholder="Forwarded" disabled></td>

    <?php }


    else if ($A_list_full['PERFORM_ACTIVITY_TYPE_CODE'] == 'S')
    {
      ?>
    <td><input type="text" class="form-control" placeholder="Supported" disabled></td>

    <?php }

    else {
      echo "";
    }?>


    </tr>

<?php endwhile; ?>

  </table>



  <br>
  <br>

  <p>


  <input id="button2"  type="submit" name="submit1" value="Initiate Approval" class="btn btn-primary">
  </p>
  </form>


  <form action="page1.php" method="post">
    <!-- <input type="hidden" name="CUSTOMER_ID" value=""> -->
    <input type="hidden" name="QUOTE_NAME" value="<?php echo $resultCheck["QUOTE_NAME"] ?>">
    <input type="hidden" name="QUOTE_DATE" value="<?php echo $resultCheck["QUOTE_DATE"] ?>">
    <input type="hidden" name="QUOTE_TYPE" value="<?php echo $_SESSION['QUOTE_TYPE'] ?>">
    <input type="hidden" name="CURRENCY" value="<?php echo $resultCheck["CURRENCY"] ?>">
    <input type="hidden" name="PRICE_LIST_NAME" value="<?php echo $row_SQL_PRICE_LIST_NAME["PRICE_LIST_NAME"] ?>">
    <input type="hidden" name="DP_AMOUNT" value="<?php echo $resultCheck["DP_AMOUNT"] ?>">
    <input type="hidden" name="PAYMENT_TYPE" value="<?php echo $resultCheck["PAYMENT_TYPE"] ?>">
    <input type="hidden" name="AGENT_DEALER_COMM_PAYABLE" value="<?php echo $resultCheck["AGENT_DEALER_COMM_PAYABLE"] ?>">
    <input type="hidden" name="CHEQUE_REF_NO" value="<?php echo $resultCheck["CHEQUE_REF_NO"] ?>">
    <input type="hidden" name="NAME_OF_AGENT_DEALER" value="<?php echo $resultCheck["NAME_OF_AGENT_DEALER"] ?>">
    <input type="hidden" name="REMITTANCE_BANK_NAME" value="<?php echo $_SESSION['REMITTANCE_BANK_NAME']; ?>">
    <input type="hidden" name="REMITTANCE_BRANCE_NAME" value="<?php echo $_SESSION['REMITTANCE_BRANCE_NAME']; ?>">

    <input type="hidden" name="REGISTRATION_INC" value="<?php echo $resultCheck["REGISTRATION_INC"] ?>">
    <input type="hidden" name="NAME_OF_PROMO_SCHEME" value="<?php echo $resultCheck["NAME_OF_PROMO_SCHEME"] ?>">
    <input type="hidden" name="NO_OF_INSTALLMENT" value="<?php echo $resultCheck["NO_OF_INSTALLMENT"] ?>">
    <input type="hidden" name="PROMO_GIFT_APPLICABLE" value="<?php echo $resultCheck["PROMO_GIFT_APPLICABLE"] ?>">

    <input type="hidden" name="DISCOUNT_VALUE" value="<?php echo $resultCheck["DISCOUNT_VALUE"] ?>">
    <input type="hidden" name="DISCOUNT_TYPE" value="<?php echo $resultCheck["DISCOUNT_TYPE"] ?>">
    <input type="hidden" name="BANK_ACCOUNT_NO" value="<?php echo $_SESSION['BANK_ACCOUNT_ID'] ?>">

    <input type="hidden" name="NAME_OF_GIFT" value="<?php echo $resultCheck["NAME_OF_GIFT"] ?>">
    <input type="hidden" name="NO_OF_FREE_INSTALLMENT" value="<?php echo $resultCheck["NO_OF_FREE_INSTALLMENT"] ?>">
    <input type="hidden" name="MICR_CHEQUE_GIVEN_IN_DEL" value="<?php echo $resultCheck["MICR_CHEQUE_GIVEN_IN_DEL"] ?>">
    <input type="hidden" name="INSTALLMENT_START_DAY" value="<?php echo $resultCheck["INSTALLMENT_START_DAY"] ?>">
    <input type="hidden" name="CUSTOMER_BANK_NAME" value="<?php echo $resultCheck["CUSTOMER_BANK_NAME"] ?>">
    <input type="hidden" name="REMARKS" value="<?php echo $resultCheck["REMARKS"] ?>">

    <input style="margin: 1px 30px;" id="button2"  type="submit" name="submit2" value="Update" class="btn btn-primary">
  </form>
  <br>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</body>

</html>
