<?php
session_start();
include 'dbh.inc.php';
error_reporting(0);
if (isset($_SESSION['u_id'])) {


  if (!empty($_GET['ASSESSMENT_NUMBER'])) {
    $_SESSION['ASSESSMENT_NUMBER'] = $_GET['ASSESSMENT_NUMBER'];
  }

  if (isset($_POST['ASSESSMENT_NUMBER'])) {
    $_SESSION['ASSESSMENT_NUMBER'] = $_POST['ASSESSMENT_NUMBER'];
  }
  ?>



<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <title></title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <style media="screen">
    .input-group-text {
      width: 270px;
      /* height: 25px; */
    }

    .test {
      height: 220px;
      width: 100%;
      margin-left: 150px;
    }

    #discount-text {
      width: 100px;
    }

    ul li {
      padding: 10px 20px;
    }

    table {
      margin-left: 30px
    }

    .x {

      height: 190px;
    }

    .name {
      width: 420px;
    }

    .response {
      width: 150px;
    }

    #button1 {
      margin-left: 30px
    }

    #button2 {
      margin-left: 1010px
    }

    #test {
      font-size: 12px;
    }

    .sl {
      width: 60px;
    }

    p {
      font-size: 12px;
    }

    #space {
      width: 30px;
    }

    body {
      background-color: #E1E1E1;
    }
    .Agent{
      font-size: 15px;
    }
  </style>
</head>

<body>

<?php

$sql1 = "SELECT * FROM XX_QUOTE_HEADERS_ALL QH, XX_ONT_APPLICANT_DETAILS AD
        WHERE QH.ASSESSMENT_NUMBER = AD.ASSESSMENT_ID AND QH.ASSESSMENT_NUMBER = '".$_SESSION['ASSESSMENT_NUMBER']."'";
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
          $QUOTE_HEADER_ID = $row1["QUOTE_HEADER_ID"]; echo $row1["ASSESSMENT_NUMBER"];?>"disabled>
        </div>
      </td>

    </tr>
            <?php endwhile;?>
  </table>

  <br>
  <br>
  <?php

$sql ="  SELECT AD.ORG_ID,
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
RA_TERRITORIES TER
WHERE AD.FILE_NO = SF.FILE_NO
      AND AD.ORDER_NUMBER = OH.ORDER_NUMBER
      AND AD.ORG_ID = OH.ORG_ID
      AND OH.SHIP_FROM_ORG_ID = OOD.ORGANIZATION_ID
      AND OH.SOLD_TO_ORG_ID=CUST.CUSTOMER_ID
      AND OH.SHIP_TO_ORG_ID=CUST.SHIP_TO_ORG_ID
      AND CUST.TERRITORY_ID=TER.TERRITORY_ID(+)
      AND AD.ASSESSMENT_ID = '".$ASSESSMENT_NUMBER."'
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
MONTHLY_INCOME,
NVL (PARENTS_NO, 0) + NVL (CHILD_NO, 0) + NVL (BROTHER_SISTER_NO, 0)";

$result= oci_parse($conn, $sql);
oci_execute($result);
$resultCheck = oci_fetch_array($result,OCI_ASSOC);


// $ffname=" SELECT PAPF.PERSON_ID,
//     PAPF.EMPLOYEE_NUMBER,
//     PAPF.FULL_NAME,
//     PJ.NAME DESIGNATION
// FROM PER_ALL_PEOPLE_F PAPF, PER_ALL_ASSIGNMENTS_F PAAF, PER_JOBS PJ
// WHERE     1 = 1
//     AND PAPF.PERSON_ID = PAAF.PERSON_ID(+)
//     AND TRUNC (SYSDATE) BETWEEN PAPF.EFFECTIVE_START_DATE
//                             AND NVL (PAPF.EFFECTIVE_END_DATE,
//                                      TRUNC (SYSDATE))
//     AND TRUNC (SYSDATE) BETWEEN PAAF.EFFECTIVE_START_DATE(+)
//                             AND NVL (PAAF.EFFECTIVE_END_DATE(+),
//                                      TRUNC (SYSDATE))
//     AND PAAF.JOB_ID = PJ.JOB_ID(+)
//     AND PAAF.BUSINESS_GROUP_ID = PJ.BUSINESS_GROUP_ID(+)
//     AND PAAF.ASSIGNMENT_TYPE(+) = 'E'
//     and papf.person_id ='".$A_NAME."'";

//     $ffname1= oci_parse($conn, $ffname);
//      oci_execute($ffname1);
//      $ffname2 = oci_fetch_array($ffname1,OCI_ASSOC);



     $sql1="SELECT * FROM XX_QUOTE_HEADERS_ALL WHERE  QUOTE_HEADER_ID = '".$QUOTE_HEADER_ID."' ";

     $result1= oci_parse($conn, $sql1);
     oci_execute($result1);

     $resultCheck1 = oci_fetch_array($result1,OCI_ASSOC);



     $sql2="SELECT * FROM XX_QUOTE_LINES_ALL WHERE  QUOTE_HEADER_ID = '".$QUOTE_HEADER_ID."' ORDER BY LINE_NO ASC ";

     $result2= oci_parse($conn, $sql2);
     oci_execute($result2);



     $sql5="SELECT TTT.TRANSACTION_TYPE_ID, NAME, DESCRIPTION
        FROM oe_transaction_types_tl ttt, oe_transaction_types_all tta
       WHERE ttt.TRANSACTION_TYPE_ID = tta.TRANSACTION_TYPE_ID
        AND TRANSACTION_TYPE_CODE = 'ORDER'
        AND NVL (END_DATE_ACTIVE, TRUNC (SYSDATE)) >= TRUNC (SYSDATE)
        AND tta.org_id = '".$resultCheck1['ORG_ID']."'
        AND tta.TRANSACTION_TYPE_ID = '".$resultCheck1['QUOTE_TYPE_ID']."'";

     $result6= oci_parse($conn, $sql5);
     oci_execute( $result6);
     $resultCheck3 = oci_fetch_array($result6,OCI_ASSOC);
  ?>

  <table border="0" style="" width="96%">
    <tr align="" bgcolor="#6bd1e7" >
      <h3>
        <th colspan="3">Summary Informations</th>
      </h3>
    </tr>
    <tr >
      <td>
        <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text" id="">Customer Name</span>
          </div>
          <input type="text" value="<?php echo $resultCheck['CUSTOMER_APPLICANT_NAME']; ?>" class="form-control" disabled>
        </div>
      </td>


  <?php  $QUOTE_TYPE_ID=$resultCheck1['QUOTE_TYPE_ID'];
         $ORG_ID=$resultCheck1['ORG_ID'];
      $qt="SELECT XX_GET_QUOTE_NUM('".$ORG_ID."','".$QUOTE_TYPE_ID."') FROM DUAL";

      $qtr= oci_parse($conn, $qt);
      oci_execute($qtr);

       while($qtro=oci_fetch_array($qtr,OCI_RETURN_NULLS+OCI_ASSOC)):

        foreach($qtro as $qtn);

        endwhile;


      ?>

      <td>
        <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text" id="">Quote Number</span>
          </div>

          <input type="text" class="form-control" value="<?php echo $qtn; ?>" disabled>
        </div>
      </td>

    <?php


    $PRICE_LIST_ID=$resultCheck1['PRICE_LIST_ID'];

   $sql6=  "SELECT list_header_id price_list_id,NAME price_list_name FROM qp_list_headers_v
       WHERE AUTOMATIC_FLAG='Y'
       AND CURRENCY_CODE='BDT'
       AND ACTIVE_FLAG='Y'
       AND TRUNC(SYSDATE) BETWEEN START_DATE_ACTIVE AND NVL(END_DATE_ACTIVE,TRUNC(SYSDATE))
       AND ORIG_ORG_ID =  '".$ORG_ID."'
       AND list_header_id = '".$PRICE_LIST_ID."'
       ";

                 $result7= oci_parse($conn, $sql6);
                 oci_execute($result7);
                  $row6 =oci_fetch_array($result7,OCI_RETURN_NULLS+OCI_ASSOC);
     ?>

     <td >
      <div class="input-group">
       <div width="30%"  class="input-group-prepend">
        <span  class="input-group-text" id="">Price List Name</span>

      <input type="text" value="<?php echo $row6['PRICE_LIST_NAME']; ?>" class="form-control" disabled>
     </div>
     </div>
     </td>

      <!-- <td>
        <div class="input-group" id="space">
          <input type="text" class="form-control" disabled>
        </div>
      </td> -->

    </tr>
    <tr>
      <td>
        <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text" id="">Customer Number</span>
          </div>
          <input type="text" value="<?php echo $resultCheck['CUSTOMER_NUMBER']; ?>" class="form-control" disabled>
        </div>
      </td>

      <td>
        <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text" id="">Quote Name</span>
          </div>
          <input type="text" value="<?php echo $resultCheck1['QUOTE_NAME']; ?>" class="form-control" disabled>
        </div>
      </td>



       <td>
        <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text" id="">Quote Status
            </span>


          <input type="text" value="<?php echo $resultCheck1['QUOTE_STATUS']; ?>" class="form-control" disabled>


        </div>
        </div>
     </td>


    </tr>
    <tr>

      <td>
        <div class="input-group">
          <div class="input-group-prepend">
            <span  class="input-group-text" id="">Father Name / Spouse Name</span>
          </div>
          <input type="text" value="<?php echo $resultCheck['FATHERS_NAME']; ?>" class="form-control" disabled>
        </div>
      </td>

      <td>
        <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text" id="">Quote Date</span>
          </div>
          <input type="text" value="<?php echo $resultCheck1['QUOTE_DATE']; ?>" class="form-control" disabled>
        </div>
      </td>





    </tr>
    <tr>
      <td>
        <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text" id="">Village</span>
          </div>
          <input type="text" value="<?php echo $resultCheck['PER_VILLAGE']; ?>" class="form-control" disabled>
        </div>
      </td>

      <td>
        <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text" id="">Quote Type</span>
          </div>
          <input type="text" value="<?php echo $resultCheck3['NAME']; ?>" class="form-control" disabled>
        </div>

      </td>

    <td>
      <div class="input-group">

        <input type="text" value="<?php echo $resultCheck3['DESCRIPTION']; ?>" class="form-control" disabled>
      </div>
   </td>

    </tr>

    <tr>
      <td>
        <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text" id="">Post</span>
          </div>
          <input type="text" value="<?php echo $resultCheck['PER_POST']; ?>" class="form-control" disabled>
        </div>
      </td>

      <td>
        <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text" id="">Currency
          </div>
          <input type="text" value="<?php echo $resultCheck1['CURRENCY']; ?>" class="form-control" disabled>
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
          <input type="text" value="<?php echo $resultCheck['PER_THANA']; ?>" class="form-control" disabled>
        </div>
      </td>

      <td>
        <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text" >Interest Amount
          </div>
          <input type="text" id="Interest_Amount3" class="form-control" disabled>
        </div>
      </td>


    </tr>
    <tr>
      <td>
        <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text" id="">District
            </span>
          </div>
          <input type="text" value="<?php echo $resultCheck['PER_DISTRICT']; ?>" class="form-control" disabled>
        </div>
      </td>

      <td>
        <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text" >Monthly Installment Amount
          </div>
          <input type="text" id="monthly_installment_amount3" class="form-control" disabled>
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
          <input type="text" value="<?php echo $resultCheck['MOBILE']; ?>" class="form-control" disabled>
        </div>
      </td>

      <td>
        <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text" >Total
          </div>
          <input type="text" class="form-control" id="Total3" disabled>
        </div>
      </td>
    </tr>
  </table>
  <br>

  <table border="0" style="" width="96%">
    <tr align="" bgcolor="#F4D03F">
      <h3>
        <th colspan="3">Payment Terms Information</th>
      </h3>
    </tr>
    <tr>
      <td>
        <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text" id="">DP Amount</span>
          </div>
          <input type="text" value="<?php echo $resultCheck1['DP_AMOUNT']; ?>" class="form-control" disabled>
        </div>
      </td>

      <td>
        <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text"  id="">Payment Type</span>
          </div>
          <input type="text" class="form-control" value="<?php echo $resultCheck1['PAYMENT_TYPE']; ?>" placeholder="" disabled>
        </div>

      </td>
      <td>
        <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text Agent" id="">Agent/Dealar Commission payable?</span>
          </div>
          <input type="text" class="form-control" value="<?php echo $resultCheck1['AGENT_DEALER_COMM_PAYABLE']; ?>" placeholder="" disabled>
        </div>

      </td>


    </tr>
    <tr>



      <td>
        <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text" id="">DP Percent</span>
          </div>
          <?php  ?>
            <input type="text" value="" id="DP_Parcent3" class="form-control" disabled>
        </div>
      </td>

      <td>
        <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text" id="">Cheque No. / Reference No.</span>
          </div>
          <input type="text" value="<?php echo $resultCheck1['CHEQUE_REF_NO']; ?>" class="form-control" disabled>
        </div>
      </td>
      <td>
        <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text" id="">Name of Agent/Dealer</span>
          </div>
          <input type="text" value="<?php echo $resultCheck1['NAME_OF_AGENT_DEALER']; ?>" class="form-control" disabled>
        </div>
      </td>

    </tr>
    <tr>

      <td>
        <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text" id="">Actual DP Amount</span>
          </div>
          <input type="text" value=""  id="Actual_DP_Amount3" class="form-control" disabled>
        </div>
      </td>


  <?php

// change-able

$REMITTANCE_BANK_ID=$resultCheck1['REMITTANCE_BANK_ID'];


    $qry="SELECT DISTINCT BANK_ID,BANK_NAME FROM XX_CE_BANK_BRCH_ACCNTS_V
       WHERE ORG_ID='".$ORG_ID."'
       AND BANK_ID='".$REMITTANCE_BANK_ID."' ";


    $qryrst= oci_parse($conn, $qry);
    oci_execute($qryrst);
    $remi=oci_fetch_array($qryrst,OCI_RETURN_NULLS+OCI_ASSOC);



  $qry1= "SELECT DISTINCT BRANCH_ID,BRANCH_NAME FROM XX_CE_BANK_BRCH_ACCNTS_V
         WHERE ORG_ID='".$ORG_ID."'
         AND BANK_ID ='".$REMITTANCE_BANK_ID."' ";

     $qryrst1= oci_parse($conn, $qry1);
     oci_execute($qryrst1);
     $remi_b=oci_fetch_array($qryrst1,OCI_RETURN_NULLS+OCI_ASSOC);


     $BRANCH_ID=$remi_b['BRANCH_ID'];

    $qry2="SELECT distinct BANK_ACCOUNT_ID,BANK_ACCOUNT_NUM FROM XX_CE_BANK_BRCH_ACCNTS_V
     WHERE ORG_ID='".$ORG_ID."'
     AND BANK_ID='".$REMITTANCE_BANK_ID."'
     AND BRANCH_ID='".$BRANCH_ID."' ";

     $qryrst2= oci_parse($conn, $qry2);
     oci_execute($qryrst2);
     $Bank_A=oci_fetch_array($qryrst2,OCI_RETURN_NULLS+OCI_ASSOC);


  ?>

      <td>
        <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text" id="">Remittance Bank Name</span>
          </div>
          <input type="text" value="<?php echo $remi['BANK_NAME']; ?>" class="form-control" disabled>
        </div>
      </td>
      <td>
        <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text" id="">Name of the Promotional Scheme</span>
          </div>
          <input type="text" value="<?php echo $resultCheck1['NAME_OF_PROMO_SCHEME']; ?>" class="form-control" disabled>
        </div>
      </td>

    </tr>
    <tr>
      <td>
        <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text" id="">No. of Installment</span>
          </div>
          <input type="text" value="<?php echo $resultCheck1['NO_OF_INSTALLMENT']; ?>" class="form-control" disabled>
        </div>
      </td>

      <td>
        <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text" id="">Brance Name</span>
          </div>
          <input type="text" value="<?php echo  $remi_b['BRANCH_NAME']; ?>" class="form-control" disabled>
        </div>
      </td>
      <td>
        <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text Agent" id="">Promotioanl Gift Applicable?</span>
          </div>
          <input type="text" value="<?php echo $resultCheck1['PROMO_GIFT_APPLICABLE']; ?>" class="form-control" placeholder="" disabled>
        </div>

      </td>


    </tr>
    <tr>
      <td>
        <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text" id="">Discount</span>
             </div>
             <!-- Start % TK -->
                           <?php

                             $DIS_TYPE=$resultCheck1['DISCOUNT_TYPE'] ;


                               function get_dis($DIS_TYPE)
                               {

                                 if($DIS_TYPE == 'Percent')
                                 {
                                   $DIS_TYPE1='%';
                                 }

                                 else
                                 {
                                     $DIS_TYPE1='TK';
                                 }

                               return  $DIS_TYPE1; }

                        ?>

             <!-- End % TK -->

               <input type="text"  value="<?php echo $resultCheck1['DISCOUNT_VALUE']; echo "&nbsp;"; echo  get_dis($DIS_TYPE); ?>" class="form-control" placeholder="" disabled>


          </div>
      </td>

      <td>
        <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text" id="">Bank Account No.
            </span>
          </div>
          <input type="text" value="<?php echo $Bank_A['BANK_ACCOUNT_NUM']; ?>" class="form-control" disabled>
        </div>
      </td>
      <td>
        <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text"  id="">Name of the Gift
            </span>
          </div>
          <input type="text" value="<?php echo $resultCheck1['NAME_OF_GIFT']; ?>" class="form-control" disabled>
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
          <input type="text" value="<?php echo $resultCheck1['NO_OF_FREE_INSTALLMENT']; ?>" class="form-control" disabled>
        </div>
      </td>

      <td>
        <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text" id="test">MICR Cheque will be given during Delivery?</span>
          </div>
          <input type="text" value="<?php echo $resultCheck1['MICR_CHEQUE_GIVEN_IN_DEL']; ?>" class="form-control" placeholder="" disabled>
        </div>
      </td>

      <td>
        <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text" id="test">Registration Included ?</span>
          </div>
          <input type="text" value="<?php echo $resultCheck1['REGISTRATION_INC']; ?>" class="form-control" placeholder="" disabled>
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
          <input type="text" value="<?php echo $resultCheck1['INSTALLMENT_START_DAY']; ?>" class="form-control" disabled>
        </div>
      </td>

      <td>
        <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text" id="">Customer Bank Name</span>
          </div>
          <input type="text" value="<?php echo $resultCheck1['CUSTOMER_BANK_NAME']; ?>" class="form-control" disabled>
        </div>
      </td>

      <td>
        <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text" id="">Registration Amount</span>
          </div>
          <input type="text" value="<?php echo $resultCheck1['REGISTRATION_AMOUNT']; ?>" class="form-control" disabled>
        </div>
      </td>
    </tr>

  </table>
  <br>

  <table border="0" style="" width="70%">
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
          <input type="text" class="form-control"   value="<?php echo $resultCheck['ZONE']; ?>"  disabled>
        </div>
      </td>

      <td>
        <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text" id="">Profession</span>
          </div>
          <input type="text" value="<?php echo $resultCheck['OCCUPATION']; ?>" class="form-control" disabled>
        </div>

      </td>



    </tr>
    <tr>
      <td>
        <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text" id="">Region</span>
          </div>
          <input type="text" value="<?php echo $resultCheck['REGION']; ?>" class="form-control" disabled>
        </div>
      </td>

      <td>
        <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text" id="">Monthly Income</span>
          </div>
          <input type="text" value="<?php echo $resultCheck['MONTHLY_INCOME']; ?>" class="form-control" disabled>
        </div>
      </td>

    </tr>
    <tr>

      <td>
        <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text" id="">Territory</span>
          </div>
          <input type="text" value="<?php echo $resultCheck['TERRITORY']; ?>" class="form-control" disabled>
        </div>
      </td>

      <td>
        <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text" id="">Dependent</span>
          </div>
          <input type="text" value="<?php echo $resultCheck['TOTAL_DEPENDENT']; ?>" class="form-control" disabled>
        </div>
      </td>





    </tr>
    <tr>
      <td>
        <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text" id=""> Territory Incharge Name</span>
          </div>
          <input type="text" class="form-control"  value="<?php echo $resultCheck['TERRITORY_INCHARGE_NAME']; ?>"  disabled>
        </div>
      </td>

      <td>
        <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text" id="">Own Equity Amount</span>
          </div>
          <input type="text" value="<?php echo $resultCheck['OWN_EQUITY_AMOUNT']; ?>"class="form-control" disabled>
        </div>
      </td>


    </tr>



    <tr>
      <td>
        <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text" id="">Regional Incharge Name</span>
          </div>
          <input type="text" class="form-control" value="<?php echo $resultCheck[' REGIONAL_INCHARGE_NAME']; ?>" disabled>
        </div>
      </td>

      <td>
        <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text" id="">Bank Loan Amount
            </span>

          </div>
          <input type="text" value="<?php echo $resultCheck['BANK_LOAN_AMOUNT']; ?>" class="form-control" disabled>
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
          <input type="text" value="<?php echo $resultCheck['ORGANIZATION_CODE']; ?>" class="form-control" disabled>
        </div>

        <td>
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text" id="">NGO Loan Amount
              </span>

            </div>
            <input type="text" value="<?php echo $resultCheck['NGO_LOAN_AMOUNT']; ?>" class="form-control" disabled>
          </div>
        </td>
      </td>
     </tr>


    <tr>
      <td>
        <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text" id="">Comments
            </span>

          </div>
          <input type="text" value="<?php echo $resultCheck1['REMARKS']; ?>" class="form-control" disabled>
        </div>
      </td>

      <td>
        <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text" id="">Other Loan Amount
            </span>

          </div>
          <input type="text" value="<?php echo $resultCheck['OTHER_LOAN_AMOUNT']; ?>" class="form-control" disabled>
        </div>
      </td>

    </tr>



  </table>

  <br>
  <br>


  <table border="0" style="max-width:97%;" align="center">
    <tr bgcolor="#F174F7">
      <h3>
        <th colspan="7">Quote Lines</th>
      </h3>

    </tr>
    <tr>
      <td align="" style="width:6%;" ><input type="text" class="form-control" placeholder="Line No" disabled></td>
      <td align="" style="width:22%;"><input type="text" class="form-control" placeholder="Order Item" disabled></td>
      <td align=""><input type="text" class="form-control" placeholder="Description" disabled></td>

      <td align="" style="width:5%;" ><input type="text" class="form-control" placeholder="UOM" disabled></td>
      <td align="" style="width:7%;"><input type="text" class="form-control" placeholder="Quantity" disabled></td>

      <!-- <td align="" style="width:11%;"><input type="text" class="form-control"  placeholder="Unit Selling Price" disabled></td>
      <td align="" style="width:10%;"><input type="text" class="form-control"  placeholder="Unit List Price" disabled></td> -->

      <td align="" style="width:11%;"><input type="text" class="form-control"  placeholder="Unit List Price " disabled></td>
      <td align="" style="width:10%;"><input type="text" class="form-control"  placeholder="Unit Selling Price" disabled></td>

    </tr>



    <?php

        $Final_Line_Total=0;
        $Interest_Amount_Total=0;
        $Total=0;



     while($row =oci_fetch_array($result2,OCI_RETURN_NULLS+OCI_ASSOC)):

      $INVENTORY_ITEM_ID= $row['INVENTORY_ITEM_ID'];
      $ORGANIZATION_ID= $row['ORGANIZATION_ID'];


    $sql3="SELECT inventory_item_id,
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
        AND ORGANIZATION_ID = '".$ORGANIZATION_ID."'
        AND  INVENTORY_ITEM_ID = '".$INVENTORY_ITEM_ID."'

  ORDER BY 2  ";

    $result3= oci_parse($conn, $sql3);
    oci_execute($result3);

      ?>


    <tr>
      <td align="" > <input type="text" class="form-control" value="<?php echo $row['LINE_NO']; ?>"  disabled> </td>

      <?php

      while($row4 =oci_fetch_array($result3,OCI_RETURN_NULLS+OCI_ASSOC)):

        $PRODUCT_ID=$row4['INVENTORY_ITEM_ID'];
        $PRODUCT_UOM_CODE=$row4['PRIMARY_UOM_CODE'];


?>

      <td > <input type="text" class="form-control" value="<?php echo $row4['ITEM_CODE']; ?>"disabled> </td>
      <td align=""> <input type="text" class="form-control" value="<?php echo $row4['DESCRIPTION']; ?>"disabled> </td>
      <td align=""> <input type="text" class="form-control" value="<?php echo $row4['PRIMARY_UOM_CODE']; ?>" disabled> </td>



      <td align=""> <input type="text" class="form-control" value="<?php echo $row['QUANTITY']; ?>" disabled> </td>



<!--
      <td align=""> <input type="text" class="form-control" value="<?php echo $row['UNIT_SELLING_PRICE']; ?>" disabled> </td> -->


<?php

      // $sql5 ="SELECT OPERAND UNIT_LIST_PRICE
      //   FROM qp_list_lines_v
      //  WHERE     LIST_LINE_TYPE_CODE = 'PLL'
      //        AND PRODUCT_ATTRIBUTE = 'PRICING_ATTRIBUTE1'
      //        AND TRUNC (SYSDATE) BETWEEN START_DATE_ACTIVE
      //                                AND NVL (END_DATE_ACTIVE, TRUNC (SYSDATE))
      //        AND LIST_HEADER_ID = 9673
      //        AND PRODUCT_ID = '".$PRODUCT_ID."'
      //        AND PRODUCT_UOM_CODE = '".$PRODUCT_UOM_CODE."' ";

        $INVENTORY_ITEM_ID=$row4['INVENTORY_ITEM_ID'];

       $sql5 ="SELECT * FROM XX_QUOTE_LINES_ALL WHERE
             ORGANIZATION_ID = '".$ORGANIZATION_ID."'
             AND INVENTORY_ITEM_ID = '".$INVENTORY_ITEM_ID."'
             AND ASSESSMENT_NUMBER = '".$ASSESSMENT_NUMBER."' ";



          $result5= oci_parse($conn, $sql5);
          oci_execute($result5);
           while($row5 =oci_fetch_array($result5,OCI_RETURN_NULLS+OCI_ASSOC)):

        ?>
   <td align=""> <input type="text" class="form-control" value="<?php echo $row5['UNIT_LIST_PRPICE']; ?>"  disabled> </td>



    <?php


    $quantiy=$row['QUANTITY'];
    $UNIT_LIST_PRPICE=$row5['UNIT_LIST_PRPICE'];
    $NO_OF_INSTALLMENT=$resultCheck1['NO_OF_INSTALLMENT'];
    $DP_PERCENT_DB=$resultCheck1['DP_PERCENT'];

    $LINE_TOTAL=($quantiy * $UNIT_LIST_PRPICE);
    $Final_Line_Total=$Final_Line_Total+$LINE_TOTAL;



    $ok=$resultCheck1['ORG_ID'];
    $sqljava ="SELECT XX_QP_CUSTOM_API_PKG.Get_INTEREST_RATE('".$ok."') from dual";

     $java= oci_parse($conn, $sqljava);
     oci_execute($java);

   while($java1 =oci_fetch_array($java,OCI_RETURN_NULLS+OCI_ASSOC)):

    foreach($java1 as $column);

    endwhile;


  $Unit_Interest=((($column/100)*($UNIT_LIST_PRPICE-(($UNIT_LIST_PRPICE*$DP_PERCENT_DB)/100)))/12)*$NO_OF_INSTALLMENT;

  $Interest_Amount=($Unit_Interest*$quantiy);
  $Interest_Amount_Total=$Interest_Amount_Total+$Interest_Amount;

  $Unit_Selling_Price=($UNIT_LIST_PRPICE+$Unit_Interest);

  ?>

  <td align=""> <input type="text" class="form-control" value="<?php echo $Unit_Selling_Price ?>"  disabled> </td>

  <?php

  $Extended_Price=($Unit_Selling_Price*$quantiy);
  $Total=($Total+$Extended_Price);



  endwhile;


 endwhile; ?>

  </tr>

  <?php endwhile;

  $Interest_Amount_Total1=round($Interest_Amount_Total,2);

 // echo "$Final_Line_Total";

  $Total1=round($Total,2);


    $NO_OF_INSTALLMENT=$resultCheck1['NO_OF_INSTALLMENT'];
    $DP_AMOUNT= $resultCheck1['DP_AMOUNT'];
    $DP_Parcent= (($DP_AMOUNT/$Final_Line_Total)*100);
    $DP_Parcent2= bcdiv($DP_Parcent,1,2);
    $Actual_DP_Amount=(($Final_Line_Total*$DP_Parcent2)/100);


    $due_amount=($Final_Line_Total-$Actual_DP_Amount);
    $Total_installment_amount=($due_amount+$Interest_Amount_Total);
    $monthly_installment_amount=round(($Total_installment_amount/$NO_OF_INSTALLMENT),2);



 ?>

<input type="hidden" name="" id="DP_Parcent2" value="<?php echo $DP_Parcent2 ?>" onclick="sync()">

<input type="hidden" name="" id="Actual_DP_Amount2" value="<?php echo $Actual_DP_Amount ?>" onclick="sync1()">

<input type="hidden" name="" id="Interest_Amount2" value="<?php echo $Interest_Amount_Total1 ?>" onclick="sync2()">

<input type="hidden" name="" id="Total2" value="<?php echo $Total1 ?>" onclick="sync3()">

<input type="hidden" name="" id="monthly_installment_amount2" value="<?php echo $monthly_installment_amount ?>" onclick="sync4()">

<script>
function sync()
{

  document.getElementById("DP_Parcent3").value = document.getElementById("DP_Parcent2").value;

}
document.querySelector("#DP_Parcent2").click();

function sync1()
{

  document.getElementById("Actual_DP_Amount3").value = document.getElementById("Actual_DP_Amount2").value;



}
document.querySelector("#Actual_DP_Amount2").click();

function sync2()
{

  document.getElementById("Interest_Amount3").value = document.getElementById("Interest_Amount2").value;

}
document.querySelector("#Interest_Amount2").click();

function sync3()
{

  document.getElementById("Total3").value = document.getElementById("Total2").value;

}
document.querySelector("#Total2").click();

function sync4()
{

  document.getElementById("monthly_installment_amount3").value = document.getElementById("monthly_installment_amount2").value;

}
document.querySelector("#monthly_installment_amount2").click();

</script>

<input type="hidden" name="" id="Final_Line_Total" value="<?php echo $Final_Line_Total; ?>">
  </table>
  <br>
  <br>


  <br>

  <br>
  <br>

  <table align="center" border="0" width="40%">
    <tr align="" bgcolor="#6bd1e7">
      <h3>
        <th colspan="3">Approvers</th>
      </h3>

    </tr>
    <tr>
      <td><input type="text" class="form-control sl" placeholder="SL" disabled></td>
      <td><input type="text" class="form-control name" placeholder="Name" disabled></td>
      <td><input type="text" class="form-control response" placeholder="Response" disabled></td>
    </tr>

    <?php

    $list=" SELECT * FROM XX_QUOTE_APPROVAL_LIST_ALL WHERE QUOTE_HEADER_ID = '".$QUOTE_HEADER_ID."' ORDER BY SEQUENCE_NO ASC ";

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
       $A_ffname_full = oci_fetch_array($A_ffname,OCI_ASSOC);


     ?>
    <tr>
      <td><input type="text" class="form-control sl" placeholder="<?php echo $i; ?>" disabled></td>
      <td><input type="text" class="form-control " placeholder="<?php  echo $A_ffname_full['FULL_NAME'];?> (<?php echo $A_list_full['LIST_MEMBER']; ?>)" disabled></td>

      <?php

      $FULL_NAME[$i-1]=$A_ffname_full['FULL_NAME'];

      $EMPLOYEE_IDA[$i-1]=$A_list_full['EMPLOYEE_ID'];

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

else if ($A_list_full['PERFORM_ACTIVITY_TYPE_CODE'] == 'A')
{
  ?>
<td><input type="text" class="form-control" placeholder="Approved" disabled></td>

<?php }

    else {
      echo "";
    }?>


    </tr>

<?php endwhile; ?>

  </table>



  <br>


  <table border="0" align="center" width="90%">
    <tr align="" bgcolor="#00E6FF">
      <h3>
        <th colspan="3">Actions History </th>
      </h3>
    </tr>
    <?php
  $sql_action = "select * from ACTIONS WHERE QUOTE_HEADER_ID = '".$QUOTE_HEADER_ID."' order by SEQUENCE_NO ASC";

  $Employee_id_result= oci_parse($conn,$sql_action);
     oci_execute($Employee_id_result);

    while($row_emplyee_id = oci_fetch_array($Employee_id_result,OCI_ASSOC)):

      $sql_find_name = "SELECT PAPF.PERSON_ID,
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
      and papf.person_id ='".$row_emplyee_id['NAME']."'";

$Employee_name_result= oci_parse($conn,$sql_find_name);
oci_execute($Employee_name_result);

$employee_name = oci_fetch_array($Employee_name_result,OCI_ASSOC);

  ?>
    <tr>
      <td rowspan="5">


        <span align="" class=" test"><input id="" type="text" class="form-control x" value="<?php echo $employee_name['FULL_NAME']  ?>" disabled></span>



      </td>



      <td>
        <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text" id="">DP</span>
          </div>
          <input type="text" class="form-control" value="<?php echo $row_emplyee_id['DP_AMOUNT'] ; ?>" disabled>
        </div>
      </td>

    </tr>
    <tr>




      <td>
        <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text" id="">Installment</span>
          </div>
          <input type="text" class="form-control" value="<?php echo $row_emplyee_id['NO_OF_INSTALLMENT'] ; ?>" disabled>
        </div>
      </td>

    </tr>
    <tr>





      <td>
        <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text" id="">Discount</span>
          </div>
          <input type="text" class="form-control" value="<?php echo $row_emplyee_id['DISCOUNT_VALUE'] ; ?>" disabled>
        </div>
      </td>

    </tr>
    <tr>




      <td>
        <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text" id="">No. of Interest Free Installment</span>
          </div>
          <input type="text" class="form-control" value="<?php echo $row_emplyee_id['NO_OF_FREE_INSTALLMENT'] ; ?>" disabled>
        </div>

      </td>

    </tr>
    <tr>




      <td>
        <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text" id="">Comments
            </span>
          </div>
          <input type="text" class="form-control" value="<?php echo $row_emplyee_id['REMARKS'] ; ?>" disabled>
        </div>
      </td>

    </tr>
    <?php endwhile; ?>



  </table>
  <br>
  <br>







  <br>



  <br>
  <br>
  <p>
  <a href="Saved_Assessment_Form.php"><button align="" type="button" class="btn btn-primary" id="button1">Back</button></a>

  </p>

  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</body>

</html>
<?php
}
else{
    header("Location: ../../login.php");
}
?>
