<?php session_start();
error_reporting(0);
 // header('Content-Type: text/html; charset=ISO-8859-1');
$id=$_SESSION['u_id'];
$A_NAME=$_SESSION['A_NAME'];
$QUOTE_HEADER_ID=$_GET['QUOTE_HEADER_ID'];
$ASSESSMENT_NUMBER=$_GET['ASSESSMENT_NUMBER'];
$ASSESSMENT_NUMBER2 = $_GET['compna'];
$QUOTE_HEADER_ID2 = $_GET['compna2'];


?>



<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Metal</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>

  <script>var $j = jQuery.noConflict(true);</script>
   <script>
     $(document).ready(function(){
      console.log($().jquery);
      console.log($j().jquery);
     });
  </script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <style media="screen">


    #myDIV1 {

     display: none;
     }

     #myDIV2 {

  display: none;
   }


   #myDIV3 {

   display: none;
   }

     #myDIV {

        display: none;
         }


    .input-group-text {
      width: 270px;

      /* height: 25px; */
    }
    input.form-control.x
    {

        min-width: 280px;
    }
    /* navbr start */

    output.form-control
    {
      max-width:255px;
      min-width:255px;
    }

    input.form-control.y
    {
      min-width:255px;
    }

    input.formy
    {
      background-color:#e9ecef;
      min-width:127px;

      border:none;
      border-left:ridge;
    }

       .navbar {
      margin-bottom: 1rem;
      overflow: hidden;
      background-color: #333;
      position: fixed;
      top: 0;
      width: 100%;
      z-index: 999;

        }

      .main {
      margin-top: 40px;
      position: relative;
      z-index: 99;

      }

    /* navbar end */


    .test {
      height: 220px;
      width: 100%;
      margin-left: 150px;
    }

    #discount-text {
      width: 100px;
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

    ul li {
      padding: 10px 20px;
    }

    table {
      margin-left: 30px;

    }

    #button2 {
      margin-left: 635px;
    }

    #test {
      font-size: 13px;
    }

    p {
      font-size: 12px;
    }

    #space {
      width: 30px;
    }

    .sl {
      width: 60px;
    }

    body {
    background-color: #E1E1E1;
    margin-top: 40px;
    }
    .Agent{
      font-size: 15px;
    }
    .supported{
      margin-left: 190px;
    }
    .reject{
      margin-left: 150px;
    }
    .forward{
      margin-left: 150px;
    }
  </style>

</head>

<?php include '../includes/navbar.inc.php'; ?>

<body>


  <?php  if($_SESSION['u_id']==true)

   {

  include '../includes/dbh.inc.php';


         $sql ="SELECT AD.ORG_ID,
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
         WHERE     AD.FILE_NO = SF.FILE_NO
               AND AD.ORDER_NUMBER = OH.ORDER_NUMBER
               AND AD.ORG_ID = OH.ORG_ID
               AND OH.SHIP_FROM_ORG_ID = OOD.ORGANIZATION_ID
               AND OH.SOLD_TO_ORG_ID=CUST.CUSTOMER_ID
               AND OH.SHIP_TO_ORG_ID=CUST.SHIP_TO_ORG_ID
               AND CUST.TERRITORY_ID=TER.TERRITORY_ID(+)
               AND  AD.ASSESSMENT_ID = '".$ASSESSMENT_NUMBER."'
              OR
              AD.FILE_NO = SF.FILE_NO
                   AND AD.ORDER_NUMBER = OH.ORDER_NUMBER
                   AND AD.ORG_ID = OH.ORG_ID
                   AND OH.SHIP_FROM_ORG_ID = OOD.ORGANIZATION_ID
                   AND OH.SOLD_TO_ORG_ID=CUST.CUSTOMER_ID
                   AND OH.SHIP_TO_ORG_ID=CUST.SHIP_TO_ORG_ID
                   AND CUST.TERRITORY_ID=TER.TERRITORY_ID(+)
                   AND  AD.ASSESSMENT_ID = '".$ASSESSMENT_NUMBER2."'
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



     $ffname=" SELECT PAPF.PERSON_ID,
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
       and papf.person_id ='".$A_NAME."'";

       $ffname1= oci_parse($conn, $ffname);
        oci_execute($ffname1);
        $ffname2 = oci_fetch_array($ffname1,OCI_ASSOC);


     $sql1="SELECT * FROM XX_QUOTE_HEADERS_ALL WHERE  QUOTE_HEADER_ID = '".$QUOTE_HEADER_ID."' OR QUOTE_HEADER_ID = '".$QUOTE_HEADER_ID2."'  ";

     $result1= oci_parse($conn, $sql1);
     oci_execute($result1);

     $resultCheck1 = oci_fetch_array($result1,OCI_ASSOC);


     $sql2="SELECT * FROM XX_QUOTE_LINES_ALL WHERE  QUOTE_HEADER_ID = '".$QUOTE_HEADER_ID."' OR QUOTE_HEADER_ID = '".$QUOTE_HEADER_ID2."' ORDER BY LINE_NO ASC ";

     $result2= oci_parse($conn, $sql2);
     oci_execute($result2);

     $sql5="SELECT TTT.TRANSACTION_TYPE_ID, NAME, DESCRIPTION
        FROM oe_transaction_types_tl ttt, oe_transaction_types_all tta
       WHERE     ttt.TRANSACTION_TYPE_ID = tta.TRANSACTION_TYPE_ID
        AND TRANSACTION_TYPE_CODE = 'ORDER'
        AND NVL (END_DATE_ACTIVE, TRUNC (SYSDATE)) >= TRUNC (SYSDATE)
        AND tta.org_id = '".$resultCheck1['ORG_ID']."'
        AND tta.TRANSACTION_TYPE_ID = '".$resultCheck1['QUOTE_TYPE_ID']."'";

     $result6= oci_parse($conn, $sql5);
     oci_execute( $result6);
     $resultCheck3 = oci_fetch_array($result6,OCI_ASSOC);



     $initiator_name=" SELECT PAPF.PERSON_ID,
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
       and papf.EMPLOYEE_NUMBER ='".$resultCheck1['CREATED_BY']."' ";
       $initiator_name1= oci_parse($conn, $initiator_name);
       oci_execute($initiator_name1);
       $initiator_name12 = oci_fetch_array($initiator_name1,OCI_ASSOC);
     ?>

  <br>

  <table border="0" style="" align="" width="50%">
    <tr align="" bgcolor="#F4FF00">
      <h3>
        <th colspan="2">Quote for ABC Customer Submitted for Approval</th>
      </h3>
    </tr>
    <tr>
      <td>
        <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text" id="">Oprerating Unit</span>

          </div>
          <input type="text" class="form-control" value="<?php echo $resultCheck['OPERATING_UNIT']; ?>" disabled>
        </div>
      </td>


    </tr>
    <tr>
      <td>
        <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text" id="">From</span>
          </div>
          <input type="text" class="form-control" value="<?php echo $initiator_name12['FULL_NAME']; ?>" disabled>
        </div>
      </td>

    </tr>
    <tr>
      <td>
        <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text" id="">To</span>
          </div>
          <input type="text" class="form-control" value="<?php echo $ffname2['FULL_NAME']; ?>" disabled>
        </div>
      </td>
    <?php

      // date format change
          $orgDate = $resultCheck1['CREATION_DATE'];
          $newDate = date("d-M-Y", strtotime($orgDate));

      // next date
          $datetime = new DateTime($newDate);
          $datetime->modify('+1 day');

  ?>

    </tr>
    <tr>
      <td>
        <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text" id="">Submission Date</span>
          </div>
          <input type="text" class="form-control" value="<?php echo $newDate; ?>" disabled>
        </div>
      </td>

    </tr>
    <tr>
      <td>
        <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text" id="" value="">Due Date</span>
          </div>
          <input type="text" class="form-control" value="<?php echo $datetime->format('d-M-Y'); ?>" disabled>

        </div>
      </td>

    </tr>
  </table>
  <br>
  <br>

  <table border="0" style="" width="96%">
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

    $ORG_ID=$resultCheck1['ORG_ID'];
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


          <!-- <input type="text" value="<?php echo $resultCheck1['QUOTE_STATUS']; ?>" class="form-control" disabled> -->

          <input type="text"  class="form-control" value="IN PROCESS" disabled>
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


      <?php
      // date format change
          $orgDate_QUOTE = $resultCheck1['QUOTE_DATE'];
          $newDate_QUOTE = date("d-M-Y", strtotime($orgDate_QUOTE));

       ?>

      <td>
        <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text" id="">Quote Date</span>
          </div>
          <input type="text" value="<?php echo $newDate_QUOTE ?>" class="form-control" disabled>
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
          <input type="text" value="" id="dp_amount_script" class="form-control" disabled>
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
            <input type="text" value="" id="dp_percent_script" class="form-control" disabled>
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
              <input type="text" value="" id="no_of_intallment_script" class="form-control" disabled>
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

                <input type="text"  id="discount_value_script" value="<?php echo  get_dis($DIS_TYPE); ?>" class="form-control" placeholder="" disabled>
                <input type="text" style="width:10px;" id="" value="<?php echo  get_dis($DIS_TYPE); ?>" class="form-control" placeholder="" disabled>





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
              <input type="text" id="no_of_free_installment_script" value="" class="form-control" disabled>
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
                <span class="input-group-text" id=""> Registration Included ?</span>
              </div>
              <input type="text" value="<?php echo $resultCheck1['REGISTRATION_INC']; ?>" class="form-control" disabled>
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
              <input type="text" value="<?php echo $resultCheck1['REGISTRATION_AMOUNT']; ?>" class="form-control" placeholder="" disabled>
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
          <input type="text" id="remarks_script" value="" class="form-control" disabled>
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
      <!-- <td align="" style="width:10%;"><input type="text" class="form-control"  placeholder="Unit Selling Price" disabled></td> -->

    </tr>



    <?php

        $Final_Line_Total=0;
        $Interest_Amount_Total=0;
        $Total=0;
        $val=0;


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


 // echo "TT2W.TT.LOC.1404 10-00×20"

?>

      <td > <input type="text" class="form-control" value="<?php echo $row4['ITEM_CODE'];?>"disabled> </td>
      <td align=""> <input type="text" class="form-control" value="<?php echo $row4['DESCRIPTION']; ?>"disabled> </td>
      <td align=""> <input type="text" class="form-control" value="<?php echo $row4['PRIMARY_UOM_CODE']; ?>" disabled> </td>



      <td align=""> <input type="text" style="text-align:center" class="form-control" value="<?php echo $row['QUANTITY']; ?>" disabled> </td>



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
             AND ASSESSMENT_NUMBER = '".$ASSESSMENT_NUMBER."'
             OR
             ORGANIZATION_ID = '".$ORGANIZATION_ID."'
             AND INVENTORY_ITEM_ID = '".$INVENTORY_ITEM_ID."'
             AND ASSESSMENT_NUMBER = '".$ASSESSMENT_NUMBER2."' ";



          $result5= oci_parse($conn, $sql5);
          oci_execute($result5);
           while($row5 =oci_fetch_array($result5,OCI_RETURN_NULLS+OCI_ASSOC)):

        ?>

  <td align=""> <input type="text" style="text-align:right" class="form-control" value="<?php echo $row5['UNIT_LIST_PRPICE']; ?>"  disabled> </td>



    <?php


    $quantiy=$row['QUANTITY'];
    $UNIT_LIST_PRPICE=$row5['UNIT_LIST_PRPICE'];

    $LINE_TOTAL=($quantiy * $UNIT_LIST_PRPICE);
    $Final_Line_Total=$Final_Line_Total+$LINE_TOTAL;

    $val=$val+$quantiy;

  endwhile;


 endwhile; ?>

  </tr>

  <?php endwhile;



    class dp_percent1 {

    public $DP_AMOUNT1;

    public function set_dp($DP_AMOUNT1) {
         $this->DP_AMOUNT1 = $DP_AMOUNT1;
       }

    function get_dp($Final_Line_Total)
    {
      $this->Final_Line_Total =$Final_Line_Total;
      $DP_Parcent2= (($this->DP_AMOUNT1/$this->Final_Line_Total)*100);
      $DP_Parcent= bcdiv($DP_Parcent2,1,2);

    return  $DP_Parcent; }

    function get_dp1($Final_Line_Total,$DP_Parcentk)
    {
      $this->Final_Line_Total =$Final_Line_Total;
      $DP_Parcentk->DP_Parcentk=$DP_Parcentk;
      $Actual_DP_Amount=(($Final_Line_Total*$DP_Parcentk)/100);

    return  $Actual_DP_Amount;
   }

    }

 ?>

<tr>
  <td> </td>
  <td> </td>
  <td> </td>
  <td> </td>
  <td align=""> <input type="text" style="font-weight: bold;text-align:center; background-color:#cdf7cd; " class="form-control" value="<?php echo $val; ?>" disabled> </td>
</tr>

<input type="hidden" name="" id="Final_Line_Total" value="<?php echo $Final_Line_Total; ?>">
  </table>

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

    $list=" SELECT * FROM XX_QUOTE_APPROVAL_LIST_ALL WHERE QUOTE_HEADER_ID = '".$QUOTE_HEADER_ID."' OR QUOTE_HEADER_ID = '".$QUOTE_HEADER_ID2."' ORDER BY SEQUENCE_NO ASC  ";

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


       $designation_name=" SELECT * FROM XX_APPROVAL_MEMBER_V WHERE EMPLOYEE_ID='".$A_list_full['EMPLOYEE_ID']."' ";
       $designation_name1= oci_parse($conn,$designation_name);
       oci_execute($designation_name1);
       $designation_name12 = oci_fetch_array($designation_name1,OCI_ASSOC);
      ?>
     <tr>
       <td><input type="text" class="form-control sl" placeholder="<?php echo $i; ?>" disabled></td>
       <?php
       if($designation_name12['DESIGNATION'] != NULL)
       {
        ?>
       <td><input type="text" class="form-control " value="<?php  echo $A_ffname_full['FULL_NAME'];?> (<?php echo $designation_name12['DESIGNATION']?>)" disabled></td>
      <?php
       }
        else {
        ?>

            <td><input type="text" class="form-control " value="<?php  echo $A_ffname_full['FULL_NAME'];?>" disabled></td>

       <?php
        }

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

          else {
            echo "";
          }?>
    </tr>

<?php endwhile; ?>


  </table>


  <br>

<?php

  $list2=" SELECT * FROM XX_QUOTE_APPROVAL_LIST_ALL WHERE QUOTE_HEADER_ID = '".$QUOTE_HEADER_ID."'  OR QUOTE_HEADER_ID = '".$QUOTE_HEADER_ID2."' ORDER BY SEQUENCE_NO ASC  ";

  $A_list2= oci_parse($conn,$list2);
   oci_execute($A_list2);
 $i=0;
  while($A_list_full2 = oci_fetch_array($A_list2,OCI_ASSOC)):
$i++;
$ffname2="SELECT PAPF.PERSON_ID,
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
     and papf.person_id ='".$A_list_full2['EMPLOYEE_ID']."' ";

     $A_ffname2= oci_parse($conn,$ffname2);
     oci_execute($A_ffname2);
     $A_ffname_full2 = oci_fetch_array($A_ffname2,OCI_ASSOC);


     $FULL_NAME2[$i-1]=$A_ffname_full2['FULL_NAME'];

     $EMPLOYEE_IDA2[$i-1]=$A_list_full2['EMPLOYEE_ID'];

   endwhile;

   ?>

        <table border="0" style="" align="center" width="61%">
           <tr align="" bgcolor="#00E6FF">
           <h3>
            <th colspan="3">Actions History</th>
           </h3>
          </tr>
       </table>

        <table border="0" style="" align="center" width="75%">
            <col width="35%">
          <tr>
            <td rowspan="5">

                <!-- <span align="" class=" test"><input id="" type="text" class="form-control x" placeholder="Initiator (Mr. Mizan)" name="NAME" id="NAME" disabled></span> -->

                <span><input id="" type="text" class="form-control x"  value="Initiator (<?php echo $initiator_name12['FULL_NAME']; ?>)" name="NAME" id="NAME" disabled></span>



              </td>
                   <td>
                     <div class="input-group ">
                       <div class="input-group-prepend">
                         <span class="input-group-text" >DP</span>
                       </div>
                       <?php $DPPERCENT = $resultCheck1['DP_PERCENT']; ?>
                        <!-- <input type="text" class="form-control" name="DP_AMOUNT" id="DP_AMOUNT" placeholder="25" disabled>  -->
                        <output name="result" class="form-control " readonly><?php echo $resultCheck1['DP_AMOUNT']; echo "&nbsp;"; echo "($DPPERCENT%)"; ?></output>

                     </div>
                   </td>

                 </tr>
                 <tr>




                   <td>
                     <div class="input-group">
                       <div class="input-group-prepend">
                         <span class="input-group-text" >No. of Installment</span>
                       </div>
                       <!-- <input type="text" class="form-control" name="NO_OF_INSTALLMENT" id="NO_OF_INSTALLMENT" placeholder="36" disabled> -->

                        <output name="result" class="form-control" readonly><?php echo $resultCheck1['NO_OF_INSTALLMENT']; ?></output>

                     </div>
                   </td>

                 </tr>
                 <tr>





                   <td>
                     <div class="input-group">
                       <div class="input-group-prepend">
                         <span class="input-group-text" >Discount</span>
                       </div>
                       <!-- <input type="text" class="form-control" name="DISCOUNT_VALUE" id="DISCOUNT_VALUE" placeholder="5000 Tk." disabled> -->
                       <output name="result" class="form-control" readonly><?php echo $resultCheck1['DISCOUNT_VALUE']; echo "&nbsp;"; echo  get_dis($DIS_TYPE); ?></output>

                   </td>

                 </tr>
                 <tr>


              <!-- <input type="hidden" name="NAME" id="NAME" value="Shahjahan Mia"> -->



                   <td>
                     <div class="input-group">
                       <div class="input-group-prepend">
                         <span class="input-group-text" >No. of Interest Free Installment</span>
                       </div>
                       <!-- <input type="text" class="form-control" name="NO_OF_FREE_INSTALLMENT" id="NO_OF_FREE_INSTALLMENT" placeholder="3" disabled> -->
                       <output name="result" class="form-control" readonly><?php echo $resultCheck1['NO_OF_FREE_INSTALLMENT']; ?></output>


                   </td>

                 </tr>
                 <tr>




                   <td>
                     <div class="input-group">
                       <div class="input-group-prepend">
                         <span class="input-group-text" >Comments
                         </span>
                       </div>
                       <!-- <input type="text" class="form-control" name="REMARKS" id="REMARKS" placeholder="" disabled> -->
                       <output><input class="form-control y" name="result" value="<?php echo $resultCheck1['REMARKS']; ?>" disabled></input></output>


                     </div>
                   </td>

                 </tr>


               </table>




<script>

function Validate1(){

    var dp_amount = document.getElementById("DP_AMOUNT").value;
    var no_of_installment = document.getElementById("NO_OF_INSTALLMENT").value;
    var discount_value = document.getElementById("DISCOUNT_VALUE").value;
    var no_of_freeinstallment = document.getElementById("NO_OF_FREE_INSTALLMENT").value;


    var dp_amount_error = document.getElementById("dp_amount_error");
    var no_of_installment_error = document.getElementById("no_of_installment_error");
    var discount_value_error = document.getElementById("discount_value_error");
    var no_of_freeinstallment_error = document.getElementById("no_of_freeinstallment_error");


    dp_amount_error.innerHTML=" ";
    no_of_installment_error.innerHTML=" ";
    discount_value_error.innerHTML=" ";
    no_of_freeinstallment_error.innerHTML=" ";


       if(dp_amount ==""){

       dp_amount_error.textContent="INFO: 'DP' value cannot be NULL !";

       return false;
       }

       if(no_of_installment ==""){

      no_of_installment_error.textContent="INFO: 'NO OF INSTALLMENT' value cannot be NULL !";

       return false;
       }

       if(discount_value ==""){

       discount_value_error.textContent="INFO: 'DISCOUNT' value cannot be NULL !";

       return false;
       }

       if(no_of_freeinstallment ==""){

       no_of_freeinstallment_error.textContent="INFO: 'NO OF FREE INSTALLMENT' value cannot be NULL !";

       return false;
       }

       return true;
}


function Validate(){

    var forwardname = document.getElementById("forwardname").value;


    var forward_error = document.getElementById("forward_error");


    forward_error.innerHTML=" ";

       if(forwardname ==""){

       forward_error.textContent="INFO: Select a Name first to Forward !";

       return false;
       }

       return true;
}

function myFunction3() {
  var x = document.getElementById("myDIV2");
  if (x.style.display = "block") {
    x.style.display === "none";
    var y = document.getElementById("myDIV");
        y.style.display = "none";
    var z = document.getElementById("myDIV3");
        z.style.display = "none";
  } else {
    x.style.display = "none";
  }
}

function hide2()
{
  var x = document.getElementById("myDIV3");
  var y = document.getElementById("myDIV");
  var z = document.getElementById("myDIV2");
  x.style.display = "none";
  y.style.display = "none";
  z.style.display = "none";
}


function myFunction4() {
  var x = document.getElementById("myDIV3");
  if (x.style.display = "block") {
    x.style.display === "none";
    var y = document.getElementById("myDIV");
        y.style.display = "none";
    var z = document.getElementById("myDIV2");
        z.style.display = "none";
  } else {
    x.style.display = "none";
  }
}

function myFunction1() {
  var x = document.getElementById("myDIV");
  if (x.style.display = "block") {
    x.style.display === "none";
    var y = document.getElementById("myDIV2");
        y.style.display = "none";
    var z = document.getElementById("myDIV3");
        z.style.display = "none";
  } else {
    x.style.display = "none";
  }

  var dp_amount = document.getElementById('DP_AMOUNT1');
  var Final_Line_Total = document.getElementById('Final_Line_Total');
  var no_of_intallment = document.getElementById('NO_OF_INSTALLMENT1');
  var discount_value = document.getElementById('DISCOUNT_VALUE1');
  var no_of_free_installment = document.getElementById('NO_OF_FREE_INSTALLMENT1');
  var comments = document.getElementById('REMARKS1');
  var Column1 = document.getElementById('Column1');



  dp_amount.addEventListener("input", cal);
  no_of_intallment.addEventListener("input", cal);
  discount_value.addEventListener("input", cal);
  no_of_free_installment.addEventListener("input", cal);
  comments.addEventListener("input", cal);
  Column1.addEventListener("input", cal);


  Final_Line_Total.addEventListener("input", cal);

  function cal() {

   var dp_amount1 = parseFloat(dp_amount.value);
   var no_of_intallment1 = parseFloat(no_of_intallment.value);
   var discount_value1 = parseFloat(discount_value.value);
   var no_of_free_installment1 = parseFloat(no_of_free_installment.value);
   var comments1 = comments.value;
   var Final_Line_Total1 = parseFloat(Final_Line_Total.value);
   var Column12 = parseFloat(Column1.value);
   var dp_amount3=((dp_amount1/Final_Line_Total1)*100);


   var with2Decimals = dp_amount3.toString().match(/^-?\d+(?:\.\d{0,2})?/)[0];
   var actual_dp_amountk =(Final_Line_Total1*with2Decimals/100);

   var elements = document.getElementsByClassName("Unit_list_Price_indiM");
   var amount = document.getElementsByClassName("$quantiy_indiM");
   var Interest_Amount_Total=0;
   var Total=0;

 for (var i = 0, length = elements.length; i < length; i++)
   {

    var Unit_Interest=(((Column12/100)*(elements[i].value-((elements[i].value*with2Decimals/100)))/12)*no_of_intallment1);
    var Interest_Amount=(Unit_Interest*amount[i].value);
        Interest_Amount_Total +=Interest_Amount;
    var Unit_Selling_Price=Number(elements[i].value)+Number(Unit_Interest);
    var Extended_Price=(Unit_Selling_Price*amount[i].value);
        Total +=Extended_Price;

  }

    var due_amount=(Final_Line_Total1-actual_dp_amountk);
    var Total_installment_amount=(due_amount+Interest_Amount_Total);
    var monthly_installment_amount=(Total_installment_amount/no_of_intallment1);

  document.getElementById('dp_percent3').value="  "+parseFloat(with2Decimals)+"%" ;
  document.getElementById('dp_percent_script').value=+parseFloat(with2Decimals)+"%";
  document.getElementById('Actual_DP_Amount3').value=parseFloat(Final_Line_Total1*with2Decimals/100);
  document.getElementById('dp_amount_script').value= dp_amount1 ;
  document.getElementById('no_of_intallment_script').value=no_of_intallment1  ;
  document.getElementById('discount_value_script').value=discount_value1 ;
  document.getElementById('no_of_free_installment_script').value=no_of_free_installment1 ;
  document.getElementById('remarks_script').value=comments1 ;


  document.getElementById("Interest_Amount3").value =Interest_Amount_Total.toFixed(2);
  document.getElementById("monthly_installment_amount3").value =monthly_installment_amount.toFixed(2);
  document.getElementById("Total3").value =Total.toFixed(2);

  document.form1.submit();
}

}


function myFunction2() {

  var x = document.getElementById("myDIV1");
   if (window.getComputedStyle(x).display === "none") {
     x.style.display = "block";
     var y = document.getElementById("myDIV");
         y.style.display = "none";
   }

   var x = document.getElementById("lol");
   if (x.style.display === "none") {
     x.style.display = "none";
     var y = document.getElementById("myDIV");
         y.style.display = "none";
   } else {
     x.style.display = "none";
   }
  var dp_percent3 = document.getElementById("dp_percent3").value;
  document.getElementById("DP_AMOUNT").value = document.getElementById("DP_AMOUNT1").value;
  document.getElementById("NO_OF_INSTALLMENT").value = document.getElementById("NO_OF_INSTALLMENT1").value;
  document.getElementById("DISCOUNT_VALUE").value = document.getElementById("DISCOUNT_VALUE1").value;
  document.getElementById("NO_OF_FREE_INSTALLMENT").value = document.getElementById("NO_OF_FREE_INSTALLMENT1").value;
  document.getElementById("REMARKS").value = document.getElementById("REMARKS1").value;

// for forward

  document.getElementById("DP_AMOUNT_FORWARD_INPUT").value = document.getElementById("DP_AMOUNT1").value;
  document.getElementById("NO_OF_INSTALLMENT_FORWARD_INPUT").value = document.getElementById("NO_OF_INSTALLMENT1").value;
  document.getElementById("DISCOUNT_VALUE_FORWARD_INPUT").value = document.getElementById("DISCOUNT_VALUE1").value;
  document.getElementById("NO_OF_FREE_INSTALLMENT_FORWARD_INPUT").value = document.getElementById("NO_OF_FREE_INSTALLMENT1").value;
  document.getElementById("REMARKS_FORWARD_INPUT").value = document.getElementById("REMARKS1").value;


  document.getElementById("DP_AMOUNT2").value = document.getElementById("DP_AMOUNT1").value+" ("+dp_percent3+")";
  document.getElementById("NO_OF_INSTALLMENT2").value = document.getElementById("NO_OF_INSTALLMENT1").value;
  document.getElementById("DISCOUNT_VALUE2").value =" "+document.getElementById("DISCOUNT_VALUE1").value;
  document.getElementById("NO_OF_FREE_INSTALLMENT2").value = document.getElementById("NO_OF_FREE_INSTALLMENT1").value;
  document.getElementById("REMARKS2").value = document.getElementById("REMARKS1").value;

}
</script>




<!-- start masakar -->

<?php

$C=0;
 $last="SELECT * FROM XX_QUOTE_APPROVAL_LIST_ALL WHERE QUOTE_HEADER_ID = '".$QUOTE_HEADER_ID."' AND PERFORM_ACTIVITY_TYPE_CODE !='N' AND PERFORM_ACTIVITY_TYPE_CODE !='P' OR QUOTE_HEADER_ID = '".$QUOTE_HEADER_ID2."' AND PERFORM_ACTIVITY_TYPE_CODE !='N' AND PERFORM_ACTIVITY_TYPE_CODE !='P' ORDER BY SEQUENCE_NO ASC   ";

    $last1= oci_parse($conn, $last);
    oci_execute($last1);

  while($last12 = oci_fetch_array($last1,OCI_ASSOC))
    {

      $sql2="SELECT * FROM ACTIONS WHERE  QUOTE_HEADER_ID = '".$QUOTE_HEADER_ID."' AND SEQUENCE_NO='".$last12['SEQUENCE_NO']."' OR QUOTE_HEADER_ID = '".$QUOTE_HEADER_ID2."' AND SEQUENCE_NO='".$last12['SEQUENCE_NO']."' ORDER BY SEQUENCE_NO ASC ";

     $result2= oci_parse($conn, $sql2);
     oci_execute($result2);

   $resultCheck2 = oci_fetch_array($result2,OCI_ASSOC);

   $dp_percent2=new dp_percent1();

  $dp_percent2->set_dp($resultCheck2['DP_AMOUNT']);

  $DP_FOR_DAYNAMIC[$C]=$resultCheck2['DP_AMOUNT'];
  $NO_OF_INSTALLMENT_FOR_DAYNAMIC[$C]=$resultCheck2['NO_OF_INSTALLMENT'];
  $DISCOUNT_VALUE_FOR_DAYNAMIC[$C]=$resultCheck2['DISCOUNT_VALUE'];
  $NO_OF_FREE_INSTALLMENT_FOR_DAYNAMIC[$C]=$resultCheck2['NO_OF_FREE_INSTALLMENT'];
  $REMARKS_FOR_DAYNAMIC[$C]=$resultCheck2['REMARKS'];



   ?>


<hr>

<?php

$DP_Parcentk=$dp_percent2->get_dp($Final_Line_Total);

$DP_Parcent_array[$C]=$DP_Parcentk;

$Actual_DP_Amount_array[$C]= $dp_percent2->get_dp1($Final_Line_Total,$DP_Parcentk);


$DP_PERCENT_FOR_DAYNAMIC[$C] = $dp_percent2->get_dp($Final_Line_Total);

?>


         <table border="0" style="" align="center" width="75%">

         <tr>
          <td rowspan="5">

<?php if($C+1==1) { ?>

       <span><input id="" type="text" class="form-control x"  value="<?php echo $C+1 ;?>st Approver (<?php echo $FULL_NAME2[$C]; ?>)" name="NAME" id="NAME" disabled></span>
<?php }
else if($C+1==2)
{?>
          <span><input id="" type="text" class="form-control x"  value="<?php echo $C+1 ;?>nd Approver (<?php echo $FULL_NAME2[$C]; ?>)" name="NAME" id="NAME" disabled></span>

 <?php
}
 else if($C+1==3)
 {?>
           <span><input id="" type="text" class="form-control x"  value="<?php echo $C+1 ;?>rd Approver (<?php echo $FULL_NAME2[$C]; ?>)" name="NAME" id="NAME" disabled></span>

  <?php
}
  else
  {?>
            <span><input id="" type="text" class="form-control x"  value="<?php echo $C+1 ;?>th Approver (<?php echo $FULL_NAME2[$C]; ?>)" name="NAME" id="NAME" disabled></span>

   <?php
 }

  ?>
          </td>



     <td>
       <div class="input-group ">
         <div class="input-group-prepend">
           <span class="input-group-text" >DP</span>
         </div>
          <output name="result" class="form-control " readonly><?php echo $resultCheck2['DP_AMOUNT']; echo "&nbsp;("; echo $dp_percent2->get_dp($Final_Line_Total); echo "%)"; ?></output>

       </div>
     </td>

   </tr>
   <tr>




     <td>
       <div class="input-group">
         <div class="input-group-prepend">
           <span class="input-group-text" >No. of Installment</span>
         </div>
          <output name="result" class="form-control" readonly><?php echo $resultCheck2['NO_OF_INSTALLMENT']; ?></output>
       </div>
     </td>

   </tr>
   <tr>



     <td>
       <div class="input-group">
         <div class="input-group-prepend">
           <span class="input-group-text" >Discount</span>
         </div>
         <output name="result" class="form-control" readonly><?php echo $resultCheck2['DISCOUNT_VALUE']; echo "&nbsp;"; echo  get_dis($DIS_TYPE); ?></output>

       </div>
     </td>

   </tr>
   <tr>


     <td>
       <div class="input-group">
         <div class="input-group-prepend">
           <span class="input-group-text" >No. of Interest Free Installment</span>
         </div>
         <output name="result" class="form-control" readonly><?php echo $resultCheck2['NO_OF_FREE_INSTALLMENT']; ?></output>

       </div>

     </td>

   </tr>
   <tr>


     <td>
       <div class="input-group">
         <div class="input-group-prepend">
           <span class="input-group-text" >Comments
           </span>
         </div>
         <output> <input class="form-control y" name="result" disabled value="<?php echo $resultCheck2['REMARKS']; ?>"></output>

         <!-- <output class="form-control" name="result" readonly><?php echo $resultCheck2['REMARKS']; ?></output> -->

       </div>
     </td>

   </tr>


 </table>


 <?php

$C++;
}
?>


<!-- endmasakar -->









    <?php


    $calculationPP="SELECT * FROM XX_QUOTE_LINES_ALL WHERE  QUOTE_HEADER_ID = '".$QUOTE_HEADER_ID."' OR QUOTE_HEADER_ID = '".$QUOTE_HEADER_ID2."' ORDER BY LINE_NO ASC ";

  $calculationPP1= oci_parse($conn,$calculationPP);
    oci_execute($calculationPP1);

        $Final_Line_Total4=0;
        $Interest_Amount_Total4=0;
        $Total4=0;



     while($calculationPP12 =oci_fetch_array($calculationPP1,OCI_RETURN_NULLS+OCI_ASSOC)):

  $INVENTORY_ITEM_ID4= $calculationPP12['INVENTORY_ITEM_ID'];
  $ORGANIZATION_ID4= $calculationPP12['ORGANIZATION_ID'];


    $calculationQQ="SELECT inventory_item_id,
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
        AND ORGANIZATION_ID = '".$ORGANIZATION_ID4."'
        AND  INVENTORY_ITEM_ID = '".$INVENTORY_ITEM_ID4."'

  ORDER BY 2  ";

    $calculationQQ1= oci_parse($conn, $calculationQQ);
    oci_execute($calculationQQ1);

      while($calculationQQ12 =oci_fetch_array($calculationQQ1,OCI_RETURN_NULLS+OCI_ASSOC)):

      $PRODUCT_ID4=$calculationQQ12['INVENTORY_ITEM_ID'];
      $PRODUCT_UOM_CODE4=$calculationQQ12['PRIMARY_UOM_CODE'];

       $INVENTORY_ITEM_ID4=$calculationQQ12['INVENTORY_ITEM_ID'];

       $calculationRR ="SELECT * FROM XX_QUOTE_LINES_ALL WHERE
             ORGANIZATION_ID = '".$ORGANIZATION_ID4."'
             AND INVENTORY_ITEM_ID = '".$INVENTORY_ITEM_ID4."'
             AND ASSESSMENT_NUMBER = '".$ASSESSMENT_NUMBER."'
             OR
             ORGANIZATION_ID = '".$ORGANIZATION_ID4."'
             AND INVENTORY_ITEM_ID = '".$INVENTORY_ITEM_ID4."'
             AND ASSESSMENT_NUMBER = '".$ASSESSMENT_NUMBER2."' ";



          $calculationRR1= oci_parse($conn, $calculationRR);
          oci_execute($calculationRR1);
           while($calculationRR12 =oci_fetch_array($calculationRR1,OCI_RETURN_NULLS+OCI_ASSOC)):


   $quantiy4=$calculationRR12['QUANTITY'];
   $UNIT_LIST_PRPICE4=$calculationRR12['UNIT_LIST_PRPICE'];
   $NO_OF_INSTALLMENT4=$NO_OF_INSTALLMENT_FOR_DAYNAMIC[$C-1];
    $LINE_TOTAL4=($quantiy4 * $UNIT_LIST_PRPICE4);
    $Final_Line_Total4=$Final_Line_Total4+$LINE_TOTAL4;



    $ok4=$resultCheck1['ORG_ID'];
    $sqljava1 ="SELECT XX_QP_CUSTOM_API_PKG.Get_INTEREST_RATE('".$ok4."') from dual";

     $java12= oci_parse($conn, $sqljava1);
     oci_execute($java12);

   while($java123 =oci_fetch_array($java12,OCI_RETURN_NULLS+OCI_ASSOC)):

    foreach($java123 as $column1);

    endwhile;



  $Unit_Interest4=((($column1/100)*($UNIT_LIST_PRPICE4-(($UNIT_LIST_PRPICE4*$DP_PERCENT_FOR_DAYNAMIC[$C-1]/100)))/12)*$NO_OF_INSTALLMENT4);

  $Interest_Amount4=($Unit_Interest4*$quantiy4);
  $Interest_Amount_Total4=$Interest_Amount_Total4+$Interest_Amount4;

  $Unit_Selling_Price4=($UNIT_LIST_PRPICE4+$Unit_Interest4);


?>

         <input type="hidden" class="Unit_list_Price_indiM" value="<?php echo $UNIT_LIST_PRPICE4; ?>">
         <input type="hidden" class="$quantiy_indiM" value="<?php echo $quantiy4; ?>">

<?php

  $Extended_Price4=($Unit_Selling_Price4*$quantiy4);

  $Total4=($Total4+$Extended_Price4);



endwhile;


 endwhile;

 endwhile;

 $Interest_Amount_Total14=round($Interest_Amount_Total4,2);

  // echo "$Final_Line_Total";

 $Total14=round($Total4,2);


 $NO_OF_INSTALLMENT4=$NO_OF_INSTALLMENT_FOR_DAYNAMIC[$C-1];
 $DP_AMOUNT4= $DP_FOR_DAYNAMIC[$C-1];
 $DP_Parcen4t= (($DP_AMOUNT4/$Final_Line_Total4)*100);
 $DP_Parcent24= bcdiv($DP_Parcen4t,1,2);
 $Actual_DP_Amount4=(($Final_Line_Total4*$DP_Parcent24)/100);


 $due_amount4=($Final_Line_Total4-$Actual_DP_Amount4);


 $Total_installment_amount4=($due_amount4+$Interest_Amount_Total4);
 $monthly_installment_amount4=round(($Total_installment_amount4/$NO_OF_INSTALLMENT4),2);


?>











<input type="hidden" name="" id="DP_Parcent2" value="<?php echo $DP_Parcent_array[$C-1] ?>%" onclick="sync()">

<input type="hidden" name="" id="Actual_DP_Amount2" value="<?php echo $Actual_DP_Amount_array[$C-1]; ?>" onclick="sync1()">

<input type="hidden" name="" id="Interest_Amount2" value="<?php echo $Interest_Amount_Total14 ?>" onclick="sync2()">

<input type="hidden" name="" id="Total2" value="<?php echo $Total14 ?>" onclick="sync3()">

<input type="hidden" name="" id="monthly_installment_amount2" value="<?php echo $monthly_installment_amount4 ?>" onclick="sync4()">


<input type="hidden" name="" id="DP_PASS_LAST_VALUE" value="<?php echo $DP_FOR_DAYNAMIC[$C-1] ?>" onclick="sync5()">
<input type="hidden" name="" id="NO_OF_INSTALLMENT_PASS_LAST_VALUE" value="<?php echo $NO_OF_INSTALLMENT_FOR_DAYNAMIC[$C-1] ?>" onclick="sync6()">
<input type="hidden" name="" id="DISCOUNT_PASS_LAST_VALUE" value="<?php echo $DISCOUNT_VALUE_FOR_DAYNAMIC[$C-1] ?>" onclick="sync7()">
<input type="hidden" name="" id="NO_OF_FREE_INSTALLMENT_PASS_LAST_VALUE" value="<?php echo $NO_OF_FREE_INSTALLMENT_FOR_DAYNAMIC[$C-1] ?>" onclick="sync8()">
<input type="hidden" name="" id="REMARKS_PASS_LAST_VALUE" value="<?php echo $REMARKS_FOR_DAYNAMIC[$C-1] ?>" onclick="sync9()">




<input type="hidden" name="" id="Column1" value="<?php echo $column1; ?>">








<script>
function sync()
{
   var p1 = document.getElementById("DP_Parcent2").value;
  document.getElementById("dp_percent_script").value = document.getElementById("DP_Parcent2").value;

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

function sync5()
{

  document.getElementById("dp_amount_script").value = document.getElementById("DP_PASS_LAST_VALUE").value;

}
document.querySelector("#DP_PASS_LAST_VALUE").click();


function sync6()
{

  document.getElementById("no_of_intallment_script").value = document.getElementById("NO_OF_INSTALLMENT_PASS_LAST_VALUE").value;

}
document.querySelector("#NO_OF_INSTALLMENT_PASS_LAST_VALUE").click();

function sync7()
{

  document.getElementById("discount_value_script").value = document.getElementById("DISCOUNT_PASS_LAST_VALUE").value;

}
document.querySelector("#DISCOUNT_PASS_LAST_VALUE").click();

function sync8()
{

  document.getElementById("no_of_free_installment_script").value = document.getElementById("NO_OF_FREE_INSTALLMENT_PASS_LAST_VALUE").value;

}
document.querySelector("#NO_OF_FREE_INSTALLMENT_PASS_LAST_VALUE").click();

function sync9()
{

  document.getElementById("remarks_script").value = document.getElementById("REMARKS_PASS_LAST_VALUE").value;

}
document.querySelector("#REMARKS_PASS_LAST_VALUE").click();

</script>







<?php



$button_desc="SELECT * FROM XX_QUOTE_APPROVAL_LIST_ALL WHERE EMPLOYEE_ID = '".$A_NAME."' AND QUOTE_HEADER_ID = '".$QUOTE_HEADER_ID."' OR EMPLOYEE_ID = '".$A_NAME."' AND QUOTE_HEADER_ID = '".$QUOTE_HEADER_ID2."'";


   $button_desc1 = oci_parse($conn,$button_desc);

   oci_execute($button_desc1);

   $button_desc12 =oci_fetch_array($button_desc1,OCI_ASSOC);

 ?>

<form method="post" action="insert.php">

<input type="hidden" class="form-control" value="<?php echo $DP_FOR_DAYNAMIC[$C-1]; ?>" name="DP_AMOUNT"  >
<input type="hidden" class="form-control" value="<?php echo $NO_OF_INSTALLMENT_FOR_DAYNAMIC[$C-1] ?>" name="NO_OF_INSTALLMENT"  >
<input type="hidden" class="form-control" value="<?php echo $DISCOUNT_VALUE_FOR_DAYNAMIC[$C-1] ?>" name="DISCOUNT_VALUE"  >
<input type="hidden" class="form-control" value="<?php echo $NO_OF_FREE_INSTALLMENT_FOR_DAYNAMIC[$C-1] ?>"name="NO_OF_FREE_INSTALLMENT">
<!-- <input type="hidden" class="form-control" name="REMARKS" value="<?php echo $REMARKS_FOR_DAYNAMIC[$C-1] ?>" > -->
<input type="hidden" class="form-control" name="REMARKS" value="" >
<input type="hidden" name="NAME" id="NAME" value="<?php echo $A_NAME; ?>">

 <?php if($QUOTE_HEADER_ID2 != NULL) { ?>

   <input type="hidden" name="QUOTE_HEADER_ID" value="<?php echo "$QUOTE_HEADER_ID2"; ?>">

 <?php }
 else
     {
 ?>
   <input type="hidden" name="QUOTE_HEADER_ID" value="<?php echo "$QUOTE_HEADER_ID"; ?>">
 <?php
 }
 ?>
  <br>
  <?php

  if($button_desc12['ACTIVITY_TYPE_CODE'] == 'A')
  {
  ?>
    <div id=lol>
       <button width="100%" style="margin-left:60%;" type="submit"  name="Suppfinal" id="post" value="Suppfinal" class="btn  btn-primary ">Approved</button>
    </div>

  <?php
  }
  else if($button_desc12['ACTIVITY_TYPE_CODE'] == 'S' || $button_desc12['ACTIVITY_TYPE_CODE'] == NULL)

  {
  ?>

  <div id=lol>
     <button width="100%" style="margin-left:60%;" type="submit"  name="Suppfinal" id="post" value="Suppfinal" class="btn  btn-primary ">Supported</button>
  </div>

  <?php
  }
  else {
    ?>  <div id=lol>

      </div
  <?php
  }

  ?>


</form>





<div class="" id="myDIV1">

  <table border="0" style="" align="center" width="61%" >
    <tr bgcolor="#ff4073">
      <h3>
       <th colspan="2">Updated Quote Terms</th>
      </h3>
    </tr>
  </table>

  <table border="0" style="" align="center" width="75%" >

    <form method="post" action="insert.php" onsubmit="return Validate1()">
    <tr>
       <col width="35%">
      <td rowspan="5">


        <!-- <span align="" class=" test"><input id="" type="text" class="form-control x" placeholder="Initiator (Mr. Mizan)" name="NAME" id="NAME" disabled></span> -->

        <span><input id="" type="text" style="Color:maroon;" class="form-control x"  value="YOU-> (<?php echo $FULL_NAME[$C]; ?>)" name="NAME" id="NAME" disabled></span>



      </td>

      <td>

               <div class="input-group">
                 <div class="input-group-prepend">
                   <span class="input-group-text" >DP</span>
                 </div>
                  <!-- <input type="text" class="form-control" name="DP_AMOUNT" id="DP_AMOUNT" placeholder="25" disabled>  -->
               <output name="result" class="form-control" value="<?php echo $DP_FOR_DAYNAMIC[$C-1];?>" id="DP_AMOUNT2" readonly></output>
               <input type="hidden" class="form-control" value="<?php echo $DP_FOR_DAYNAMIC[$C-1]; ?>" name="DP_AMOUNT" id="DP_AMOUNT" >
               </div>
             </td>

           </tr>
           <tr>


             <td>
               <div class="input-group">
                 <div class="input-group-prepend">
                   <span class="input-group-text" >No. of Installment</span>
                 </div>
                 <!-- <input type="text" class="form-control" name="NO_OF_INSTALLMENT" id="NO_OF_INSTALLMENT" placeholder="36" disabled> -->

                 <output name="result" class="form-control"  value="<?php echo   $NO_OF_INSTALLMENT_FOR_DAYNAMIC[$C-1]; ?>" id="NO_OF_INSTALLMENT2" readonly></output>
                 <input type="hidden" class="form-control" value="<?php echo   $NO_OF_INSTALLMENT_FOR_DAYNAMIC[$C-1]; ?>" name="NO_OF_INSTALLMENT" id="NO_OF_INSTALLMENT" >
               </div>
             </td>

           </tr>
           <tr>


             <td>
               <div class="input-group">
                 <div class="input-group-prepend">
                   <span class="input-group-text" >Discount</span>
                 </div>

                <input type="text"  name="result" class="formy" value="<?php echo $DISCOUNT_VALUE_FOR_DAYNAMIC[$C-1];?>" id="DISCOUNT_VALUE2" disabled>
                <input type="text"  style="width:69px; text-align:center; background-color:#e9ecef; border:none; border-left:ridge;" value="<?php  echo  get_dis($DIS_TYPE); ?>" disabled>
               <input type="hidden" class="form-control" value="<?php echo   $DISCOUNT_VALUE_FOR_DAYNAMIC[$C-1]; ?>" name="DISCOUNT_VALUE" id="DISCOUNT_VALUE" >
               </div>
             </td>

           </tr>
           <tr>

      <input type="hidden" name="NAME" id="NAME" value="<?php echo $A_NAME; ?>">

             <td>
               <div class="input-group">
                 <div class="input-group-prepend">
                   <span class="input-group-text" >No. of Interest Free Installment</span>
                 </div>
                 <!-- <input type="text" class="form-control" name="NO_OF_FREE_INSTALLMENT" id="NO_OF_FREE_INSTALLMENT" placeholder="3" disabled> -->
                  <output name="result" class="form-control" value="<?php echo   $NO_OF_FREE_INSTALLMENT_FOR_DAYNAMIC[$C-1]; ?>" id="NO_OF_FREE_INSTALLMENT2" readonly></output>
                 <input type="hidden" class="form-control" value="<?php echo   $NO_OF_FREE_INSTALLMENT_FOR_DAYNAMIC[$C-1]; ?>" name="NO_OF_FREE_INSTALLMENT" id="NO_OF_FREE_INSTALLMENT">
               </div>

             </td>

           </tr>
           <tr>


              <td>
               <div class="input-group">
                 <div class="input-group-prepend">
                   <span class="input-group-text" >Comments
                   </span>
                 </div>
                 <!-- <input type="text" class="form-control" name="REMARKS" id="REMARKS" placeholder="" disabled> -->
                        <output name="result"  class="form-control" value="<?php echo  $REMARKS_FOR_DAYNAMIC[$C-1]; ?>" id="REMARKS2" readonly></output>
                 <input type="hidden" class="form-control" value="<?php echo  $REMARKS_FOR_DAYNAMIC[$C-1]; ?>" name="REMARKS" value=""id="REMARKS" >
               </div>
             </td>

           </tr>


           </table>

           <br>
                      <div class=""  style="color:Red;margin-left:30%" id="dp_amount_error"></div>
                      <div class=""  style="color:Red;margin-left:30%" id="no_of_installment_error"></div>
                      <div class=""  style="color:Red;margin-left:30%" id="discount_value_error"></div>
                      <div class=""  style="color:Red;margin-left:30%" id="no_of_freeinstallment_error"></div>

           <?php if($QUOTE_HEADER_ID2 != NULL) { ?>

             <input type="hidden" name="QUOTE_HEADER_ID" value="<?php echo "$QUOTE_HEADER_ID2"; ?>">

           <?php }
           else
               {
           ?>
             <input type="hidden" name="QUOTE_HEADER_ID" value="<?php echo "$QUOTE_HEADER_ID"; ?>">
           <?php
           }
           ?>
<br>

<?php

if($button_desc12['ACTIVITY_TYPE_CODE'] == 'A')
{
?>
  <div id=lol>
     <button width="100%" style="margin-left:60%;" type="submit"  name="Suppfinal" id="post" value="Suppfinal" class="btn  btn-primary ">Approved</button>
  </div>

<?php
}
else if($button_desc12['ACTIVITY_TYPE_CODE'] == 'S' || $button_desc12['ACTIVITY_TYPE_CODE'] == NULL)

{
?>

<div id=lol>
   <button width="100%" style="margin-left:60%;" type="submit"  name="Suppfinal" id="post" value="Suppfinal" class="btn  btn-primary ">Supported</button>
</div>

<?php
}
else {
  echo "";
}

?>

</form>

</div>



<div class="col-lg">
  <div class="panel with-nav-tabs panel-primary">
    <div class="panel-heading">
      <ul class="nav nav-tabs">
<li > <a href="#down"><button onclick="myFunction1()" width="100%" type="button" class="btn btn-danger btn-primary">Modify</button></a></li>

<?php

$random_emp="SELECT * FROM XX_QUOTE_APPROVAL_LIST_ALL WHERE QUOTE_HEADER_ID='".$QUOTE_HEADER_ID."'AND EMPLOYEE_ID='".$A_NAME."' AND ACTIVITY_TYPE_CODE='F' AND PERFORM_ACTIVITY_TYPE_CODE ='P' OR QUOTE_HEADER_ID='".$QUOTE_HEADER_ID2."' AND EMPLOYEE_ID='".$A_NAME."' AND ACTIVITY_TYPE_CODE='F' AND PERFORM_ACTIVITY_TYPE_CODE ='P' ORDER BY SEQUENCE_NO DESC";

$random_emp1= oci_parse($conn, $random_emp);
 oci_execute($random_emp1);
$random_emp12=oci_fetch_array($random_emp1,OCI_RETURN_NULLS+OCI_ASSOC);


if($random_emp12['EMPLOYEE_ID'] == $A_NAME)
{
  echo "";
}

else{

?>
        <li>  <a href="#down"><button style="margin-left:150px" onclick="myFunction3()" width="100%" type="button" class="btn btn-danger btn-primary">Reject</button></a></li>
<?php } ?>
        <li><a href="#down"><button style="margin-left:150px" width="100%" onclick="myFunction4()" type="button" class="btn btn-success btn-primary forward">Forward</button></a></li>
        <!-- <li><a href="page4.html"><button width="100%" type="button" class="btn  btn-primary supported">Supported</button></a></li> -->

      </ul>
    </div>


    <br>







    <div class="panel-body" id="myDIV">
    <div class="tab-content">

        <table border="0" style="" align="center" width="50%">
          <tr bgcolor="#6bd1e7">
            <h3>
              <th colspan="2">Update Quote Terms</th>
            </h3>
          </tr>


          <tr>
            <td>

                     <div class="input-group">
                       <div class="input-group-prepend">
                         <span class="input-group-text" >DP</span>
                       </div>
                        <!-- <input type="text" class="form-control" name="DP_AMOUNT" id="DP_AMOUNT" placeholder="25" disabled>  -->

                     <input type="text" class="form-control" value="<?php echo $DP_FOR_DAYNAMIC[$C-1];?>"  id="DP_AMOUNT1" >
                         <input type="text" id="dp_percent3" value="" disabled>
                     </div>
                   </td>

                 </tr>
                 <tr>


                   <?php
                        $noof_installment=" SELECT FLEX_VALUE NO_of_Installment
                                    FROM FND_FLEX_VALUES_VL FVV, FND_FLEX_VALUE_SETS FVS
                                    WHERE     FVV.FLEX_VALUE_SET_ID = FVS.FLEX_VALUE_SET_ID
                                    AND FVS.FLEX_VALUE_SET_NAME = 'Metal Tractor Installment 2 Digits' ";
                        $noof_installment1= oci_parse($conn,$noof_installment);
                            oci_execute($noof_installment1);

                   ?>

                   <td>
                     <div class="input-group">
                       <div class="input-group-prepend">
                         <span class="input-group-text" >No. of Installment</span>
                       </div>
                       <!-- <input type="text" class="form-control" value="<?php echo $resultCheck1['NO_OF_INSTALLMENT']; ?>"  id="NO_OF_INSTALLMENT1" > -->

                       <select name="cars" class="form-control" id="NO_OF_INSTALLMENT1">

                           <option style="background-color:white;color:white;" value="<?php echo $NO_OF_INSTALLMENT_FOR_DAYNAMIC[$C-1]; ?>"><?php echo $NO_OF_INSTALLMENT_FOR_DAYNAMIC[$C-1]; ?></option>
                           <?php
                             while($noof_installment12= oci_fetch_array($noof_installment1,OCI_RETURN_NULLS+OCI_ASSOC))
                             {
                               ?>
                                 <option value="<?php echo $noof_installment12['NO_OF_INSTALLMENT']; ?>"><?php echo $noof_installment12['NO_OF_INSTALLMENT']; ?></option>

                              <?php
                             }
                            ?>
                      </select>

                     </div>
                   </td>

                 </tr>
                 <tr>





                   <td>
                     <div class="input-group">
                       <div class="input-group-prepend">
                         <span class="input-group-text" >Discount</span>
                       </div>
                       <!-- <input type="text" class="form-control" name="DISCOUNT_VALUE" id="DISCOUNT_VALUE" placeholder="5000 Tk." disabled> -->

                       <input type="text" class="form-control" value="<?php echo $DISCOUNT_VALUE_FOR_DAYNAMIC[$C-1]?>"  id="DISCOUNT_VALUE1" >
                       <input type="text"  value="<?php echo "&nbsp;"; echo  get_dis($DIS_TYPE); ?>" disabled>

                     </div>
                   </td>

                 </tr>
                 <tr>

                   <?php
                        $noof_free_installment="SELECT FLEX_VALUE NO_of_Free_Installment
                         FROM FND_FLEX_VALUES_VL FVV, FND_FLEX_VALUE_SETS FVS
                          WHERE     FVV.FLEX_VALUE_SET_ID = FVS.FLEX_VALUE_SET_ID
                         AND FVS.FLEX_VALUE_SET_NAME = 'Metal Tractor No. of Free Installment 2 Digits'";
                          $noof_free_installment1= oci_parse($conn,  $noof_free_installment);
                       oci_execute($noof_free_installment1);

                      ?>

                   <td>
                     <div class="input-group">
                       <div class="input-group-prepend">
                         <span class="input-group-text" >No. of Interest Free Installment</span>
                       </div>

                       <!-- <input type="text" class="form-control" value="<?php echo $resultCheck1['NO_OF_FREE_INSTALLMENT']; ?>"  id="NO_OF_FREE_INSTALLMENT1"> -->

                       <select name="cars" class="form-control" id="NO_OF_FREE_INSTALLMENT1">

                           <option style="background-color:white;color:white;" value="<?php echo $NO_OF_FREE_INSTALLMENT_FOR_DAYNAMIC[$C-1] ; ?>"><?php echo $NO_OF_FREE_INSTALLMENT_FOR_DAYNAMIC[$C-1]; ?></option>
                           <?php
                             while($noof_free_installment12= oci_fetch_array($noof_free_installment1,OCI_RETURN_NULLS+OCI_ASSOC))
                             {
                               ?>
                                 <option value="<?php echo $noof_free_installment12['NO_OF_FREE_INSTALLMENT']; ?>"><?php echo $noof_free_installment12['NO_OF_FREE_INSTALLMENT']; ?></option>

                              <?php
                             }
                            ?>
                      </select>

                     </div>

                   </td>


                 </tr>
                 <tr>


                   <td>
                     <div class="input-group">
                       <div class="input-group-prepend">
                         <span class="input-group-text" >Comments
                         </span>
                       </div>
                       <!-- <input type="text" class="form-control" name="REMARKS" id="REMARKS" placeholder="" disabled> -->

                       <!-- <input type="text" class="form-control" value="<?php echo   $REMARKS_FOR_DAYNAMIC[$C-1]; ?>" id="REMARKS1" > -->
                     <input type="text" class="form-control" value="" id="REMARKS1" >
                     </div>
                   </td>

                 </tr>


                 </table>

<br>




<p>
  <button type="button" id="hide" onclick="hide2()" class="btn btn-secondary">Hide</button>

  <a href="#hello1" data-toggle="tab"><button style="margin-left:46%" width="100%"  onclick="myFunction2()"   type="button" class="btn btn-danger btn-primary">Apply</button></a>

</p>
</div>
</div>




<?php

$find_perform="SELECT * FROM XX_QUOTE_APPROVAL_LIST_ALL WHERE QUOTE_HEADER_ID='".$QUOTE_HEADER_ID."' OR QUOTE_HEADER_ID='".$QUOTE_HEADER_ID2."' WHERE PERFORM_ACTIVITY_TYPE_CODE != 'N'";
$find_perform1 = oci_parse($conn,$find_perform);
oci_execute($find_perform1);
$T=0;
while($find_perform12 =oci_fetch_array($find_perform1,OCI_RETURN_NULLS+OCI_ASSOC))
{
$PERFORM_ACTIVITY_TYPE_CODE_PROOF[$T]=$find_perform12['PERFORM_ACTIVITY_TYPE_CODE'];
$T++;
}




if ($PERFORM_ACTIVITY_TYPE_CODE_PROOF[$T-1]=='F' && $random_emp12['EMPLOYEE_ID']!= $A_NAME )
{
  if($QUOTE_HEADER_ID != NULL)
  {
    ?>
    <script>
      $(document).ready(function(){
          $("#search").on('keyup',function(){
              var APPROVAL_NAME =  $(this).val();
              var QUOTE_HEADER_ID=<?php echo $QUOTE_HEADER_ID?>;
              console.log(APPROVAL_NAME);
              $.ajax({
              url: "search_approval_name1.php",
              type: "post",
              data: {APPROVAL_NAME:APPROVAL_NAME,QUOTE_HEADER_ID:QUOTE_HEADER_ID},
              dataType: "html",
              success: function(response){
                  $("#searchTable").html(response);
              }
              });
          })
      });
      </script>
    <?php
  }
   else
  {
  ?>
  <script>
    $(document).ready(function(){
        $("#search").on('keyup',function(){
            var APPROVAL_NAME =  $(this).val();
            var QUOTE_HEADER_ID=<?php echo $QUOTE_HEADER_ID2?>;
            console.log(APPROVAL_NAME);
            $.ajax({
            url: "search_approval_name1.php",
            type: "post",
            data: {APPROVAL_NAME:APPROVAL_NAME,QUOTE_HEADER_ID:QUOTE_HEADER_ID},
            dataType: "html",
            success: function(response){
                $("#searchTable").html(response);
            }
            });
        })
    });
    </script>
  <?php
  }
}

else if($random_emp12['EMPLOYEE_ID']!= $A_NAME)
{
  if($QUOTE_HEADER_ID != NULL)
  {
    ?>
    <script>
      $(document).ready(function(){
          $("#search").on('keyup',function(){
              var APPROVAL_NAME =  $(this).val();
              var QUOTE_HEADER_ID=<?php echo $QUOTE_HEADER_ID?>;
              console.log(APPROVAL_NAME);
              $.ajax({
              url: "search_approval_name.php",
              type: "post",
              data: {APPROVAL_NAME:APPROVAL_NAME,QUOTE_HEADER_ID:QUOTE_HEADER_ID},
              dataType: "html",
              success: function(response){
                  $("#searchTable").html(response);
              }
              });
          })
      });
      </script>
    <?php
  }
   else
  {
  ?>
  <script>
    $(document).ready(function(){
        $("#search").on('keyup',function(){
            var APPROVAL_NAME =  $(this).val();
            var QUOTE_HEADER_ID=<?php echo $QUOTE_HEADER_ID2?>;
            console.log(APPROVAL_NAME);
            $.ajax({
            url: "search_approval_name.php",
            type: "post",
            data: {APPROVAL_NAME:APPROVAL_NAME,QUOTE_HEADER_ID:QUOTE_HEADER_ID},
            dataType: "html",
            success: function(response){
                $("#searchTable").html(response);
            }
            });
        })
    });
    </script>
  <?php
}
}
else {
  echo "";
}
// $random_emp12 reject button er upore ase
// random employee er jonno forward
if($random_emp12['EMPLOYEE_ID']== $A_NAME)
{

?>

<form class="" style="margin-top:12px;" onsubmit="return Validate()" action="forward.php" method="post">
<div class="panel-body" id="myDIV3">
<div class="tab-content">
<br>
    <table border="0" style="" class="side" width="50%">
      <tr bgcolor="#6bd1e7">
        <h3>
          <th colspan="2">Forward To:</th>
        </h3>
      </tr>


      <input type="hidden" class="form-control" id="DP_AMOUNT_FORWARD_INPUT" value="<?php echo $DP_FOR_DAYNAMIC[$C-1]; ?>" name="DP_AMOUNT"  >
      <input type="hidden" class="form-control" id="NO_OF_INSTALLMENT_FORWARD_INPUT" value="<?php echo $NO_OF_INSTALLMENT_FOR_DAYNAMIC[$C-1]?>" name="NO_OF_INSTALLMENT"  >
      <input type="hidden" class="form-control" id="DISCOUNT_VALUE_FORWARD_INPUT" value="<?php echo $DISCOUNT_VALUE_FOR_DAYNAMIC[$C-1] ?>" name="DISCOUNT_VALUE"  >
      <input type="hidden" class="form-control" id="NO_OF_FREE_INSTALLMENT_FORWARD_INPUT" value="<?php echo $NO_OF_FREE_INSTALLMENT_FOR_DAYNAMIC[$C-1] ?>"name="NO_OF_FREE_INSTALLMENT">


       <input type="hidden" name="NAME" id="NAME" value="<?php echo $A_NAME; ?>">


                  <?php if($QUOTE_HEADER_ID2 != NULL && $ASSESSMENT_NUMBER2 != NULL) { ?>

                    <input type="hidden" name="QUOTE_HEADER_ID" value="<?php echo "$QUOTE_HEADER_ID2"; ?>">
                    <input type="hidden" name="ASSESSMENT_NUMBER" value="<?php echo "$ASSESSMENT_NUMBER2"; ?>">

                  <?php }
                  else
                      {
                  ?>
                    <input type="hidden" name="QUOTE_HEADER_ID" value="<?php echo "$QUOTE_HEADER_ID"; ?>">
                    <input type="hidden" name="ASSESSMENT_NUMBER" value="<?php echo "$ASSESSMENT_NUMBER"; ?>">
                  <?php
                      }
                  ?>

      <tr>
        <td>
          <div class="form-group">
            <div class="input-group-prepend">
              <span class="input-group-text" >  APPROVAL NAME:
              </span>

<?php
      $previousperson="SELECT * FROM XX_QUOTE_APPROVAL_LIST_ALL WHERE QUOTE_HEADER_ID='".$QUOTE_HEADER_ID."' AND PERFORM_ACTIVITY_TYPE_CODE='F' OR QUOTE_HEADER_ID='".$QUOTE_HEADER_ID2."' AND PERFORM_ACTIVITY_TYPE_CODE='F' ORDER BY SEQUENCE_NO ASC";

      $previousperson1= oci_parse($conn, $previousperson);
      oci_execute($previousperson1);
      $q=0;
    while( $previousperson12 =oci_fetch_array($previousperson1,OCI_RETURN_NULLS+OCI_ASSOC))
    {
    $previousperson12_array[$q]= $previousperson12['EMPLOYEE_ID'];
    $q++;
    }

 ?>

    <select class="form-control"  style="width:60%" id="" name="forwardname" >
         <option  value="<?php echo $previousperson12_array[$q-1]; ?>"><?php echo $FULL_NAME2[$C-1];; ?></option>
      </select>

</div>
<br>
<div class="input-group-prepend">
<span class="input-group-text" >Comments :
</span>
<input type="text" class="form-control" value="" name="REMARKS" id="REMARKS_FORWARD_INPUT" >
</div>


  </div>
     </td>
       </tr>
        </table>
         <div class=""  style="color:Red; margin-left:25%" id="forward_error"></div>

            <input type="hidden" name="ORG_ID" value="<?php echo $resultCheck1['ORG_ID']; ?>">

             <input type="hidden" name="NAME" id="NAME" value="<?php echo $A_NAME; ?>">
             <?php if($QUOTE_HEADER_ID2 != NULL) { ?>

               <input type="hidden" name="QUOTE_HEADER_ID" value="<?php echo "$QUOTE_HEADER_ID2"; ?>">

             <?php }
             else
                 {
             ?>
               <input type="hidden" name="QUOTE_HEADER_ID" value="<?php echo "$QUOTE_HEADER_ID"; ?>">
             <?php
             }
             ?>

             <button type="button" id="hide" onclick="hide2()" class="btn btn-secondary">Hide</button>
         <button style="margin-left:45%;" width="100%" type="submit" value="forward" name="forward" class="btn btn-success">Submit</button>
         <br>
       </form>
   </div>
     </div>

<?php

}

else{
 ?>

    <!-- Forward Start -->

      <form class="" style="margin-top:12px;" onsubmit="return Validate()" action="forward.php" method="post">
      <div class="panel-body" id="myDIV3">
      <div class="tab-content">
      <br>
          <table border="0" style="" class="side" width="50%">
            <tr bgcolor="#6bd1e7">
              <h3>
                <th colspan="2">Forward To:</th>
              </h3>
            </tr>


            <input type="hidden" class="form-control" id="DP_AMOUNT_FORWARD_INPUT" value="<?php echo $DP_FOR_DAYNAMIC[$C-1]; ?>" name="DP_AMOUNT"  >
            <input type="hidden" class="form-control" id="NO_OF_INSTALLMENT_FORWARD_INPUT" value="<?php echo $NO_OF_INSTALLMENT_FOR_DAYNAMIC[$C-1]?>" name="NO_OF_INSTALLMENT"  >
            <input type="hidden" class="form-control" id="DISCOUNT_VALUE_FORWARD_INPUT" value="<?php echo $DISCOUNT_VALUE_FOR_DAYNAMIC[$C-1] ?>" name="DISCOUNT_VALUE"  >
            <input type="hidden" class="form-control" id="NO_OF_FREE_INSTALLMENT_FORWARD_INPUT" value="<?php echo $NO_OF_FREE_INSTALLMENT_FOR_DAYNAMIC[$C-1] ?>"name="NO_OF_FREE_INSTALLMENT">


             <input type="hidden" name="NAME" id="NAME" value="<?php echo $A_NAME; ?>">


                        <?php if($QUOTE_HEADER_ID2 != NULL && $ASSESSMENT_NUMBER2 != NULL) { ?>

                          <input type="hidden" name="QUOTE_HEADER_ID" value="<?php echo "$QUOTE_HEADER_ID2"; ?>">
                          <input type="hidden" name="ASSESSMENT_NUMBER" value="<?php echo "$ASSESSMENT_NUMBER2"; ?>">

                        <?php }
                        else
                            {
                        ?>
                          <input type="hidden" name="QUOTE_HEADER_ID" value="<?php echo "$QUOTE_HEADER_ID"; ?>">
                          <input type="hidden" name="ASSESSMENT_NUMBER" value="<?php echo "$ASSESSMENT_NUMBER"; ?>">
                        <?php
                        }
                        ?>

            <tr>
              <td>
                <div class="form-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text" >  APPROVAL NAME:
                    </span>


                    <input id="search" type="text" onkeydown="return event.key != 'Enter';" style="width:30%;background-color:#d6ff84;color:brown;" class="form-control" placeholder="Search Name Here">

                   <select class="form-control"  style="width:60%" name="forwardname" id="searchTable">

                 <option  value=""> --------------------NONE---------------------</option>
                    </select>

      </div>
  <br>
      <div class="input-group-prepend">
      <span class="input-group-text" >Comments :
      </span>
      <input type="text" class="form-control" value="" name="REMARKS" id="REMARKS_FORWARD_INPUT" >
      </div>


        </div>
           </td>
             </tr>
              </table>
               <div class=""  style="color:Red; margin-left:25%" id="forward_error"></div>

                  <input type="hidden" name="ORG_ID" value="<?php echo $resultCheck1['ORG_ID']; ?>">

                   <input type="hidden" name="NAME" id="NAME" value="<?php echo $A_NAME; ?>">
                   <?php if($QUOTE_HEADER_ID2 != NULL) { ?>

                     <input type="hidden" name="QUOTE_HEADER_ID" value="<?php echo "$QUOTE_HEADER_ID2"; ?>">

                   <?php }
                   else
                       {
                   ?>
                     <input type="hidden" name="QUOTE_HEADER_ID" value="<?php echo "$QUOTE_HEADER_ID"; ?>">
                   <?php
                   }
                   ?>

                   <button type="button" id="hide" onclick="hide2()" class="btn btn-secondary">Hide</button>
               <button style="margin-left:45%;" width="100%" type="submit" value="forward" name="forward" class="btn btn-success">Submit</button>
               <br>
             </form>
         </div>
           </div>

    <!-- END_FORWARD -->
<?php } ?>

<!-- Reject -->

    <form class="" style="margin-top:12px;" action="reject.php" method="post">
    <div class="panel-body" id="myDIV2">
    <div class="tab-content">

        <table border="0" style="" align="center" width="50%">
          <tr bgcolor="#6bd1e7">
            <h3>
              <th colspan="2">Reason</th>
            </h3>
          </tr>


                    <tr>
                      <td>
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text" >Comments
                            </span>
                          </div>

                          <input type="text" class="form-control" value="" name="REMARKS" id="" >
                        </div>
                      </td>
                       </tr>


           </table>
  <br>
                 <input type="hidden" name="NAME" id="NAME" value="<?php echo $A_NAME; ?>">
                 <?php if($QUOTE_HEADER_ID2 != NULL) { ?>

                   <input type="hidden" name="QUOTE_HEADER_ID" value="<?php echo "$QUOTE_HEADER_ID2"; ?>">

                 <?php }
                 else
                     {
                 ?>
                   <input type="hidden" name="QUOTE_HEADER_ID" value="<?php echo "$QUOTE_HEADER_ID"; ?>">
                 <?php
                 }
                 ?>

                 <button type="button" id="hide" onclick="hide2()" class="btn btn-secondary">Hide</button>
             <button style="margin-left:45%;" width="100%" type="submit" value="submit" name="submit" class="btn btn-danger btn-primary reject">Submit</button>
           </form>
       </div>
         </div>

<!-- END REJECT -->

  <br>
  <br>



  <div id="down">

  </div>

</body>

</html>



<?php
}
else {
  $Message = "Please Login First !!";
  header("Location:../login.php?Message={$Message}");
}
 ?>
