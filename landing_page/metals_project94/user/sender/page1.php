<?php
error_reporting(0);
session_start();

include '../../includes/dbh.inc.php';

if (isset($_SESSION['u_id'])) {
echo $_POST["REMITTANCE_BRANCE_REALNAME"];
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <title></title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script> -->

<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" /> -->

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
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
  select {
 width:300px;
}
    .input-group-text {
      width: 245px;

    }

    .input-group-test {
      width: 50px;
      color:  	#FFA07A;
    }



    #discount-text {
      width: 62px;
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

    .last-table {
      margin-left: 30px;
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
    #agent{
      font-size: 12px;
    }
    #micr{
      font-size: 12px;
    }


    body {
      background-color: #E1E1E1;
    }

    .form-control {
      line-height: 220px;
      padding: 5px 5px;

    }

    #QUANTITY{
      width: 62px;
    }
    #LINE_NO{
      width: 62px;
    }

    #comments{

      height: 40px;
      width: 510px;

    }






    .modal-confirm {
		color: #636363;
		width: 400px;
	}
	.modal-confirm .modal-content {
		padding: 20px;
		border-radius: 5px;
		border: none;
        text-align: center;
		font-size: 14px;
	}
	.modal-confirm .modal-header {
		border-bottom: none;
        position: relative;
	}
	.modal-confirm h4 {
		text-align: center;
		font-size: 26px;
		margin: 30px 0 -10px;
	}
	.modal-confirm .close {
        position: absolute;
		top: -5px;
		right: -2px;
	}
	.modal-confirm .modal-body {
		color: #999;
	}
	.modal-confirm .modal-footer {
		border: none;
		text-align: center;
		border-radius: 5px;
		font-size: 13px;
		padding: 10px 15px 25px;
	}
	.modal-confirm .modal-footer a {
		color: #999;
	}
	.modal-confirm .icon-box {
		width: 80px;
		height: 80px;
		margin: 0 auto;
		border-radius: 50%;
		z-index: 9;
		text-align: center;
		border: 3px solid #f15e5e;
	}
	.modal-confirm .icon-box i {
		color: #f15e5e;
		font-size: 46px;
		display: inline-block;
		margin-top: 13px;
	}
    .modal-confirm .btn {
        color: #fff;
        border-radius: 4px;
		background: #60c7c1;
		text-decoration: none;
		transition: all 0.4s;
        line-height: normal;
		min-width: 120px;
        border: none;
		min-height: 40px;
		border-radius: 3px;
		margin: 0 5px;
		outline: none !important;
    }
	.modal-confirm .btn-info {
        background: #c1c1c1;
    }
    .modal-confirm .btn-info:hover, .modal-confirm .btn-info:focus {
        background: #a8a8a8;
    }
    .modal-confirm .btn-danger {
        background: #f15e5e;
    }
    .modal-confirm .btn-danger:hover, .modal-confirm .btn-danger:focus {
        background: #ee3535;
    }
	.trigger-btn {
		display: inline-block;
		margin: 100px auto;
	}

  .btn{
  font-size: 10px;
}
  </style>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

</head>
<?php



  if (!empty($_GET['ASSESSMENT_NUMBER'])) {
    $_SESSION['ASSESSMENT_NUMBER'] = $_GET['ASSESSMENT_NUMBER'];
  }

  if (isset($_POST['ASSESSMENT_NUMBER'])) {
    $_SESSION['ASSESSMENT_NUMBER'] = $_POST['ASSESSMENT_NUMBER'];
  }


  include '../../includes/dbh.inc.php';

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
         WHERE AD.FILE_NO = SF.FILE_NO
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
         MONTHLY_INCOME,
         NVL (PARENTS_NO, 0) + NVL (CHILD_NO, 0) + NVL (BROTHER_SISTER_NO, 0) ";

   $result= oci_parse($conn, $sql);
   oci_execute($result);

   $resultCheck = oci_fetch_array($result,OCI_ASSOC);

   ?>



<body>
<nav class="navbar navbar-expand-md navbar-dark bg-dark">
        <div class="container-fluid">
            <h3 style = "color:white">Assement Form</h3>
        </div>
        <div class="navbar-collapse collapse w-50 order-1 dual-collapse2">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <h4 style = "color:white"><a class="nav-link" href="homepage.php">Home</a></h4>
            </li>
        </ul>
    </div>
    </nav>
<form action="preview.php" method="post">
  <br>
  <br>

  <table class="table-responsive-md" border="0" style="" align="" width="68%" id="first_table">

    <tr align="" bgcolor="#7DCEA0 ">
      <h3>
        <th colspan="2">Quote Headers</th>
      </h3>
    </tr>
    <tr>
      <td height="2">
        <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text" id="">Oprerating Unit</span>

          </div>
          <input type="text" class="form-control assis" name="OPERATING_UNIT" placeholder="TMPL Tractor" value="<?php echo $resultCheck['OPERATING_UNIT']; $_SESSION["OPERATING_UNIT"] = $resultCheck['OPERATING_UNIT']; ?>" disabled>
        </div>
      </td>

    </tr>
    <tr>
      <td height="2">
        <div class="input-group">
          <div class="input-group-prepend ">
            <span class="input-group-text" id="">Assessment No.</span>

          </div>
          <input type="text" class="form-control " name="ASSESSMENT_NUMBER" value="<?php echo $resultCheck['ASSESSMENT_ID']; $_SESSION["ASSESSMENT_NUMBER"] = $resultCheck['ASSESSMENT_ID']; ?>">
        </div>
      </td>

    </tr>

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



        <table class="table-responsive-md" border="0" style="" width="100%">
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
                <input type="text" name="APPLICANT_NAME" value="<?php echo $resultCheck['CUSTOMER_APPLICANT_NAME']; ?>" class="form-control">
              </div>
            </td>

            <td>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"  id="">Quote Number</span>
                </div>
                <input type="text" name="" class="form-control" disabled>
              </div>
            </td>

            <td>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"  id="">Price List Name</span>
                </div>
                <select name="PRICE_LIST_NAME" value="<?php echo $_POST['PRICE_LIST_NAME']; ?>" class="custom-select" id="PRICE_LIST_NAME">
                <option value="">Select</option>
                <?php
            $sql90 = "SELECT list_header_id price_list_id,NAME price_list_name FROM qp_list_headers_v
            WHERE AUTOMATIC_FLAG='Y'
            AND CURRENCY_CODE='BDT'
            AND ACTIVE_FLAG='Y'
            AND TRUNC(SYSDATE) BETWEEN START_DATE_ACTIVE AND NVL(END_DATE_ACTIVE,TRUNC(SYSDATE))
            AND ORIG_ORG_ID = '".$_SESSION['ORG_ID']."' ";
            $result90= oci_parse($conn, $sql90);
            oci_execute($result90);
            while($row90 =oci_fetch_array($result90,OCI_ASSOC)):
            ?>

            <option value="<?php echo $row90['PRICE_LIST_NAME']; ?>"> <?php echo $row90['PRICE_LIST_NAME']; ?> </option>
            <?php endwhile; ?>
                </select>
              </div>
            </td>

          </tr>
          <tr>
            <td>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="" >Customer Number</span>
                </div>

                <input type="text"  name="CUSTOMER_ID" value="<?php echo $resultCheck['CUSTOMER_NUMBER']; $_SESSION['CUSTOMER_ID_1'] = $resultCheck['CUSTOMER_ID'];?>" class="form-control">
              </div>
            </td>
            <td>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"  id="">Quote Name</span>
                </div>
                <input type="text" name="QUOTE_NAME" value="<?php echo $_POST['QUOTE_NAME']; ?>" class="form-control">
              </div>
            </td>

            <!-- <td rowspan="7"> -->
            <td>
            <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="">Quote Status
                  </span>
                </div>
                <input type="text" class="form-control" value="<?php echo "NOT SUBMITTED"; ?>"  disabled>
              </div>

            </td>

          </tr>
          <tr>

            <td>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="test">Father Name / Spouse Name</span>
                </div>
                <input type="text" name="FATHERS_NAME" value="<?php echo $resultCheck['FATHERS_NAME']; $_SESSION["FATHERS_NAME"] = $resultCheck['FATHERS_NAME']; ?>" class="form-control"  disabled>
              </div>
            </td>

            <td>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="">Quote Date*</span>
                </div>
                <input type="date" name="QUOTE_DATE" value="<?php echo $_POST['QUOTE_DATE']; ?>" class="form-control" id="quote_date">
              </div>
            </td>

          </tr>
          <tr>
            <td>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="">Village</span>
                </div>
                <input type="text" name="PER_VILLAGE" value="<?php echo $resultCheck['PER_VILLAGE']; $_SESSION["PER_VILLAGE"] = $resultCheck['PER_VILLAGE']; ?>" class="form-control" disabled>
              </div>
            </td>

            <td>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"  id="">Quote Type*</span>
                </div>
                <select name="QUOTE_TYPE" value="<?php echo $_POST['QUOTE_TYPE'];  ?>" class="custom-select" id="TRANSACTION_TYPE_ID">
                <option value="">Select</option>
                <?php
            $sql91 = "SELECT TTT.TRANSACTION_TYPE_ID, NAME, DESCRIPTION
            FROM oe_transaction_types_tl ttt, oe_transaction_types_all tta
           WHERE     ttt.TRANSACTION_TYPE_ID = tta.TRANSACTION_TYPE_ID
                 AND TRANSACTION_TYPE_CODE = 'ORDER'
                 AND NVL (END_DATE_ACTIVE, TRUNC (SYSDATE)) >= TRUNC (SYSDATE)
                 AND tta.org_id = '".$_SESSION['ORG_ID']."'
                 AND WAREHOUSE_ID = '".$_SESSION["ORGANIZATION_ID"]."'";
            $result91= oci_parse($conn, $sql91);
            oci_execute($result91);
            while($row91 =oci_fetch_array($result91,OCI_ASSOC)):
            ?>

            <option value="<?php echo $row91['NAME']; ?>"> <?php echo $row91['NAME']; ?> </option>
            <?php endwhile; ?>
                </select>
              </div>
            </td>
            <td>
              <div class="input-group">
                <!-- <div class="input-group-prepend">
                  <span class="input-group-text" id="">DESCRIPTION</span>
                </div> -->
                <select name="DESCRIPTION1" id="DESCRIPTION1" class="custom-select" >
                <option value="">No Value</option>
                <?php
                if(isset($_POST['QUOTE_TYPE'])){
                  $sql9 = "SELECT TTT.TRANSACTION_TYPE_ID, NAME, DESCRIPTION
                FROM oe_transaction_types_tl ttt, oe_transaction_types_all tta
                WHERE ttt.TRANSACTION_TYPE_ID = tta.TRANSACTION_TYPE_ID
                    AND TRANSACTION_TYPE_CODE = 'ORDER'
                    AND NAME = '".$_POST['QUOTE_TYPE']."'
                    AND NVL (END_DATE_ACTIVE, TRUNC (SYSDATE)) >= TRUNC (SYSDATE)
                    AND tta.org_id = '".$_SESSION['ORG_ID']."'
                    AND WAREHOUSE_ID = '".$_SESSION["ORGANIZATION_ID"]."' ";

                $result9= oci_parse($conn, $sql9);
                oci_execute($result9);
                while($row9 =oci_fetch_array($result9,OCI_ASSOC)){
                  $name = $row9["NAME"];
                  $DESCRIPTION = $row9["DESCRIPTION"];
                  echo "<option value='".$row9['NAME']."' >".$row9['DESCRIPTION']."</option>";

              }
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
                  <span class="input-group-text" id="">Post</span>
                </div>
                <input type="text" name="PER_POST" value="<?php echo $resultCheck['PER_POST']; $_SESSION["PER_POST"] = $resultCheck['PER_POST']; ?>"  class="form-control" disabled>
              </div>
            </td>

            <td>
            <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="">Currency
                </div>
                <input type="text"  name="CURRENCY" value="BDT" class="form-control">
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
                <input type="text" name="PER_THANA" value="<?php echo $resultCheck['PER_THANA']; $_SESSION["PER_THANA"] = $resultCheck['PER_THANA']; ?>"  class="form-control" disabled>
              </div>
            </td>

            <td colspan="2">
            <div class="input-group" >
                <div class="input-group-prepend">
                  <span class="input-group-text" id="">Interest Amount
                </div>
                <span  id="Interest_Amount">
                <?php if(isset($_SESSION["INTEREST_AMOUNT"])){ ?>
                <input type="text" name="" class="form-control" id="interest_amount_field" value="<?php echo $_SESSION["INTEREST_AMOUNT"]; ?>" disabled>
              <?php }
              unset($_SESSION["INTEREST_AMOUNT"]);
               ?>
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
                <input type="text" name="PER_DISTRICT" value="<?php echo $resultCheck['PER_DISTRICT']; $_SESSION["PER_DISTRICT"] = $resultCheck['PER_DISTRICT']; ?>" class="form-control" disabled>
              </div>
            </td>

            <td colspan="2">
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="">Monthly Installment Amount
                </div>
                <span  id="Monthly_Installment">
                <?php if(isset($_SESSION["MONTHLY_INSTALLMENT_AMOUNT"])){ ?>
                  <input type="text" name="" id="monthly_installment_field" class="form-control" value="<?php echo $_SESSION["MONTHLY_INSTALLMENT_AMOUNT"]; ?>" disabled>
              <?php }
              unset($_SESSION["MONTHLY_INSTALLMENT_AMOUNT"]);
               ?>
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
                <input type="text" name="MOBILE" value="<?php echo $resultCheck['MOBILE']; $_SESSION["MOBILE"] = $resultCheck['MOBILE'];  ?>"  class="form-control" disabled>
              </div>
            </td>

            <td colspan="2">
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="">Total
                </div>
                <span id="Total">
                <?php if(isset($_SESSION["TOTAL"])){ ?>
                  <input type="text" name="" id="total_session_field" class="form-control" value="<?php echo $_SESSION["TOTAL"]; ?>" disabled>
              <?php }
              unset($_SESSION["TOTAL"]);
               ?>
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
                  <span class="input-group-text"  id="">DP Amount*</span>
                </div>

                <input type="text" name="DP_AMOUNT" id="dp_amount" value="<?php echo $_POST['DP_AMOUNT']; ?>" class="form-control">
              </div>
            </td>

            <td>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"  id="">Payment Type*</span>
                </div>

                <select name="PAYMENT_TYPE" id="PAYMENT_TYPE" value="<?php echo $_POST['PAYMENT_TYPE']; if(isset($_SESSION["PAYMENT_TYPE"])){ echo $_SESSION["PAYMENT_TYPE"]; }?>" class="custom-select" >
                <option value="">Select</option>
            <?php
            $sql24 = "SELECT MEANING FROM FND_LOOKUP_VALUES_VL
            where LOOKUP_TYPE='METAL_RECEIPT_MODES'
            and trunc(sysdate) between start_date_active and nvl(end_date_active,trunc(sysdate))
            and ENABLED_FLAG='Y' ";
            $result24= oci_parse($conn, $sql24);
            oci_execute($result24);
            while($row24 =oci_fetch_array($result24,OCI_ASSOC)):
              echo "<option value='".$row24['MEANING']."' >".$row24['MEANING']."</option>";
            endwhile;
            ?>
            </select>
              </div>

            </td>

            <td>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="agent">Agent/Dealar Commission payable?</span>
                </div>
                <select class="custom-select" name="AGENT_DEALER_COMM_PAYABLE" value="<?php echo $_POST['AGENT_DEALER_COMM_PAYABLE']; ?>"  id="AGENT_DEALER_COMM_PAYABLE">
                  <option value="">Select</option>
                  <option value="Yes">Yes</option>
                  <option value="No">No</option>

                </select>
              </div>

            </td>



          </tr>
          <tr>
            <td>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"  id="">DP Percent*</span>
                  <span id="dp_percent">
                </div>
                <?php if(isset($_SESSION["DP_PERCENT"])){?>
                <input type="text" name="" id="DP_PERCENT_SESSION_FIELD" class="form-control" value="<?php echo $_SESSION["DP_PERCENT"]; ?>" disabled>
                <?php }
                unset($_SESSION["DP_PERCENT"]);
                ?>
              </div>
            </td>

            <td>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"  id="">Cheque No. / Reference No.</span>
                </div>
                <input type="text" name="CHEQUE_REF_NO" value="<?php echo $_POST['CHEQUE_REF_NO']; ?>" class="form-control">
              </div>
            </td>
            <td>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"  id="">Name of Agent/Dealer</span>
                </div>
                <input type="text" name="NAME_OF_AGENT_DEALER" value="<?php echo $_POST['NAME_OF_AGENT_DEALER']; ?>" class="form-control">
              </div>
            </td>

          </tr>
          <tr>

            <td>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"  id="">Actual DP Amount*</span>
                  <span  id="actual_dp_amount">

                </div>
                <?php if(isset($_SESSION["ACTUAL_DP_AMOUNT"])){?>
                <input type="text" name="" id="ACTUAL_DP_AMOUNT_SESSION_FIELD" class="form-control" value="<?php echo $_SESSION["ACTUAL_DP_AMOUNT"]; ?>" disabled>
                <?php }
                unset($_SESSION["ACTUAL_DP_AMOUNT"]);
                ?>
              </div>
            </td>

            <td>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"  id="">Remittance Bank Name</span>
                </div>
                <select name="REMITTANCE_BANK_NAME" id="BANK_ID" value="" class="custom-select" >
                <option value="">Select</option>
            <?php
            $sql25 = "SELECT DISTINCT BANK_ID,BANK_NAME FROM XX_CE_BANK_BRCH_ACCNTS_V
            WHERE ORG_ID = '".$_SESSION['ORG_ID']."' ";
            $result25 = oci_parse($conn, $sql25);
            oci_execute($result25);
            while($row25 =oci_fetch_array($result25,OCI_ASSOC)):
              echo "<option value='".$row25['BANK_ID']."' >".$row25['BANK_NAME']."</option>";
            endwhile;
            ?>
            </select>
              </div>
            </td>
            <td>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"  id="test">Name of the Promotional Scheme</span>
                </div>
                <input type="text" name="NAME_OF_PROMO_SCHEME" value="<?php echo $_POST['NAME_OF_PROMO_SCHEME']; ?>" class="form-control">
              </div>
            </td>

          </tr>
          <tr>
            <td>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"  id="">No. of Installment*</span>
                </div>
                <select name="NO_OF_INSTALLMENT" id="NO_OF_INSTALLMENT" value="<?php if(isset($_SESSION['NO_OF_INSTALLMENT_S'])){ echo $_SESSION['NO_OF_INSTALLMENT_S']; } ?>" class="custom-select" >
                <option value="">Select</option>
            <?php
            $sql23 = "SELECT TO_NUMBER(FLEX_VALUE) NO_of_Installment
            FROM FND_FLEX_VALUES_VL FVV, FND_FLEX_VALUE_SETS FVS
           WHERE     FVV.FLEX_VALUE_SET_ID = FVS.FLEX_VALUE_SET_ID
                 AND FVS.FLEX_VALUE_SET_NAME = 'Metal Tractor Installment 2 Digits' ORDER BY TO_NUMBER(FLEX_VALUE) ASC ";
            $result23= oci_parse($conn, $sql23);
            oci_execute($result23);
            while($row23 =oci_fetch_array($result23,OCI_ASSOC)):
              echo "<option value='".$row23['NO_OF_INSTALLMENT']."' >".$row23['NO_OF_INSTALLMENT']."</option>";
            endwhile;
            ?>
            </select>
              </div>
            </td>

            <td>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"  id="">Branch Name</span>
                </div>
                <select name="REMITTANCE_BRANCE_NAME" id="REMITTANCE_BRANCE_NAME" class="custom-select" value="">
                <option value="">No Value</option>
                <?php
                if(isset($_POST['REMITTANCE_BRANCE_NAME'])){
                  $sql41 = "SELECT DISTINCT BRANCH_NAME,BRANCH_ID FROM XX_CE_BANK_BRCH_ACCNTS_V
                WHERE ORG_ID= '".$_SESSION["ORG_ID"]."'
                and BRANCH_ID = '".$_POST["REMITTANCE_BRANCE_NAME"]."' ";
                $result41= oci_parse($conn, $sql41);
                oci_execute($result41);
                while($row41 =oci_fetch_array($result41,OCI_ASSOC)){
                  $BRANCH_NAME = $row41["BRANCH_NAME"];
                  echo "<option value='".$row41['BRANCH_ID']."' >".$row41["BRANCH_NAME"]."</option>";
                }
                }
                ?>
                </select>

              </div>

            </td>
            <td>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text Agent" id="">Promotioanl Gift Applicable?</span>
                </div>
                <select class="custom-select"  name="PROMO_GIFT_APPLICABLE" id="PROMO_GIFT_APPLICABLE" value="<?php echo $_POST['PROMO_GIFT_APPLICABLE']; ?>" id="inputGroupSelect01">
                  <option value="">Select</option>
                  <option value="Yes">Yes</option>
                  <option value="No">No</option>

                </select>
              </div>

            </td>


          </tr>
          <tr>
            <td>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="">Discount</span>

                  <input type="text" class="form-control" name="DISCOUNT_VALUE" value="<?php echo $_POST['DISCOUNT_VALUE']; ?>" id="discount-text">
                </div>
                <select name="DISCOUNT_TYPE" value="<?php echo $_POST['DISCOUNT_TYPE']; ?>" class="custom-select" id="DISCOUNT_TYPE_test" width="20px">
                  <option  value="">Select</option>
                  <option value="Percent">Percent</option>
                  <option  value="Amount">Amount</option>
                </select>
            </td>

            <td>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"  id="">Bank Account No.
                  </span>
                </div>
                <select name="BANK_ACCOUNT_NO" id="BANK_ACCOUNT_NO" class="custom-select" >
                <option value="">No Value</option>
                <?php
                if(isset($_POST["BANK_ACCOUNT_NO"])){
                  $sql42 = "SELECT DISTINCT BANK_ACCOUNT_NUM, BANK_ACCOUNT_ID FROM XX_CE_BANK_BRCH_ACCNTS_V
                WHERE ORG_ID= '".$_SESSION["ORG_ID"]."'
                and BANK_ACCOUNT_ID = '".$_POST["BANK_ACCOUNT_NO"]."' ";
                $result42= oci_parse($conn, $sql42);
                oci_execute($result42);
                while($row42 =oci_fetch_array($result42,OCI_ASSOC)){
                  $BANK_ACC_NO = $row42["BANK_ACCOUNT_NUM"];
                  echo "<option value='".$row42['BANK_ACCOUNT_ID']."' >".$row42["BANK_ACCOUNT_NUM"]."</option>";
                }
                }
                ?>
                </select>

              </div>
            </td>
            <td>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"  id="">Name of the Gift
                  </span>
                </div>
                <input type="text" name="NAME_OF_GIFT" value="<?php echo $_POST['NAME_OF_GIFT']; ?>" class="form-control">
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
                <select name="NO_OF_FREE_INSTALLMENT" id="Free_Installment" value="<?php echo $_POST['NO_OF_FREE_INSTALLMENT']; ?>" class="custom-select" >
                <option value="0">0</option>
                <?php
            $sql24 = "SELECT FLEX_VALUE NO_of_Installment
            FROM FND_FLEX_VALUES_VL FVV, FND_FLEX_VALUE_SETS FVS
           WHERE     FVV.FLEX_VALUE_SET_ID = FVS.FLEX_VALUE_SET_ID
                 AND FVS.FLEX_VALUE_SET_NAME = 'Metal Tractor No. of Free Installment 2 Digits'";
            $result24= oci_parse($conn, $sql24);
            oci_execute($result24);
            while($row24 =oci_fetch_array($result24,OCI_ASSOC)):
              echo "<option value='".$row24['NO_OF_INSTALLMENT']."' >".$row24['NO_OF_INSTALLMENT']."</option>";
            endwhile;
            ?>
                </select>

              </div>
            </td>

            <td>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="micr">MICR Cheque will be given during Delivery?</span>
                </div>
                <select name="MICR_CHEQUE_GIVEN_IN_DEL" value="<?php echo $_POST['MICR_CHEQUE_GIVEN_IN_DEL']; ?>" class="custom-select" id="MICR_CHEQUE_GIVEN_IN_DEL">
                  <option value="">Select</option>
                  <option value="Yes">Yes</option>
                  <option value="No">No</option>
                </select>
              </div>
            </td>

            <td>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="">Registration Included ?</span>
                </div>
                <select name="REGISTRATION_INC" value="<?php echo $_POST['REGISTRATION_INC']; ?>" class="custom-select" id="REGISTRATION_INC">

                  <option value="No">No</option>
                  <option value="Yes">Yes</option>

                </select>
              </div>
            </td>


          </tr>
          <tr>
            <td>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="test">Day of the Month to start Installment*
                  </span>
                </div>
                <input type="text" name="INSTALLMENT_START_DAY" value="<?php echo $_POST['INSTALLMENT_START_DAY']; ?>" class="form-control" id="day">
              </div>
            </td>

            <td>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"  id="">Customer Bank Name</span>
                </div>

                <select name="CUSTOMER_BANK_NAME"  value="<?php echo $_POST['CUSTOMER_BANK_NAME']; ?>" class="custom-select" id="CUSTOMER_BANK_NAME">
                <option value="">Select</option>
            <?php
            $sql26 = "SELECT MEANING FROM FND_LOOKUP_VALUES_VL
            where LOOKUP_TYPE='METAL_CUSTOMER_BANK'
            and trunc(sysdate) between start_date_active and nvl(end_date_active,trunc(sysdate))
            and ENABLED_FLAG='Y' ";
            $result26 = oci_parse($conn, $sql26);
            oci_execute($result26);
            while($row26 =oci_fetch_array($result26,OCI_ASSOC)):
              echo "<option value='".$row26['MEANING']."' >".$row26['MEANING']."</option>";
            endwhile;
            ?>
            </select>
              </div>
            </td>

            <td>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text" >Registration Amount
                  </span>
                  <span id="REGISTRATION_AMOUNT"></span>
                  <?php if( isset($_SESSION["REGISTRATION_AMOUNT"])){ ?>
                    <input type="text" name="" id="REGISTRATION_AMOUNT_SESSION" class="form-control" value="<?php echo $_SESSION["REGISTRATION_AMOUNT"]; ?>" disabled>

                  <?php } ?>
                </div>

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
                <input type="text" name="OCCUPATION" value="<?php echo $resultCheck['OCCUPATION']; $_SESSION['OCCUPATION'] = $resultCheck['OCCUPATION']; ?>" class="form-control" disabled>
              </div>

            </td>



          </tr>
          <tr>
            <td>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="">Region</span>
                </div>
                <input type="text" name="REGION" value="<?php echo $resultCheck['REGION']; $_SESSION["REGION"] = $resultCheck['REGION']; ?>" class="form-control" disabled>
              </div>
            </td>

            <td>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="">Monthly Income</span>
                </div>
                <input type="text" name="MONTHLY_INCOME" value="<?php echo $resultCheck['MONTHLY_INCOME']; $_SESSION['MONTHLY_INCOME'] = $resultCheck['MONTHLY_INCOME'];  ?>" class="form-control" disabled>
              </div>
            </td>

          </tr>
          <tr>

            <td>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="">Territory</span>
                </div>
                <input type="text" name="TERRITORY" value="<?php echo $resultCheck['TERRITORY']; $_SESSION["TERRITORY"] = $resultCheck['TERRITORY']; ?>"  class="form-control" disabled>
              </div>
            </td>

            <td>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="">Dependent</span>
                </div>
                <input type="text" name="TOTAL_DEPENDENT" value="<?php echo $resultCheck['TOTAL_DEPENDENT']; $_SESSION["TOTAL_DEPENDENT"] = $resultCheck['TOTAL_DEPENDENT'];?>" class="form-control" disabled>
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
                <input type="text" name="OWN_EQUITY_AMOUNT" value="<?php echo $resultCheck['OWN_EQUITY_AMOUNT']; $_SESSION["OWN_EQUITY_AMOUNT"] = $resultCheck['OWN_EQUITY_AMOUNT'];?>" class="form-control" disabled>
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
                <input type="text" name="BANK_LOAN_AMOUNT" value="<?php echo $resultCheck['BANK_LOAN_AMOUNT']; $_SESSION["BANK_LOAN_AMOUNT"] = $resultCheck['BANK_LOAN_AMOUNT']; ?>"class="form-control" disabled>
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
                <input type="text" class="form-control" name="ORGANIZATION_ID" value="<?php echo $resultCheck['ORGANIZATION_CODE']; $_SESSION["ORGANIZATION_CODE"] = $resultCheck['ORGANIZATION_CODE']; ?>"  disabled>
              </div>
            </td>

            <td>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="">NGO Loan Amount
                  </span>
                </div>
                <input type="text" name="NGO_LOAN_AMOUNT" value="<?php echo $resultCheck['NGO_LOAN_AMOUNT']; $_SESSION["NGO_LOAN_AMOUNT"] = $resultCheck['NGO_LOAN_AMOUNT']; ?>" class="form-control" disabled>
              </div>
            </td>





          </tr>
          <tr>
            <td>

              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"  id="comments">
                  </span>

                </div>

              <!-- <input type="text" style="height:200px" name="REMARKS" value="" class="form-control" > -->
               </div>
            </td>

            <td>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="">Other Loan Amount
                  </span>

                </div>
                <input type="text" name="OTHER_LOAN_AMOUNT" value="<?php echo $resultCheck['OTHER_LOAN_AMOUNT']; $_SESSION["OTHER_LOAN_AMOUNT"] = $resultCheck['OTHER_LOAN_AMOUNT']; ?>" class="form-control" disabled>
              </div>
            </td>
          </tr>
          <tr>
          <td colspan = "2">

          <div class="input-group">
          <div class="input-group-prepend">
                  <span class="input-group-text" >Comments
                  </span>

                </div>

          <input type="text"  name="REMARKS" value="<?php echo $_POST["REMARKS"]; ?>" class="form-control" >
          </div>

          </td>
          </tr>


        </table>




      </div>

    </div>



    <!-- <div id="te"></div> -->

  <br>

<br>

<span id="dp_percents">

<script>

$(document).ready(function(){

setInterval(function(){

load_table();


}, 1000);

function load_table() {

$.ajax({    //create an ajax request to display.php
      type: "GET",
      url: "fetch.inc.php",
      dataType: "html",   //expect html to be returned
      success: function(response){
          $("#responsecontainer").html(response);
          //alert(response);
      }

  });
}

$("#REGISTRATION_INC").change(function(e){
        var REGISTRATION_INC =  $(this).val();

        console.log(REGISTRATION_INC);

        // if(REGISTRATION_INC == 'Yes'){
        //     $("#REGISTRATION_AMOUNT").append("<input value='"+14100+"' disabled >");
        // }
        $("#REGISTRATION_AMOUNT_SESSION").hide();
        $.ajax({
            url:"yes_no.php",
            type:"post",
            data:{REGISTRATION_INC:REGISTRATION_INC},
            dataType: "json",
            success:function(response){
              // alert(response);

              if(response[0] == 'Yes'){
                $("#REGISTRATION_AMOUNT").empty();
                $("#REGISTRATION_AMOUNT").append("<input name='REGISTRATION_AMOUNT' class='form-control' value='"+14100+"' disabled >");
              }
              else{
                $("#REGISTRATION_AMOUNT").empty();
                $("#REGISTRATION_AMOUNT").append("<input name='REGISTRATION_AMOUNT' class='form-control' value='"+ " " +"' disabled >");
              }



            }
        });
    });





$("#INVENTORY_ITEM_ID").change(function(e){
        var INVERTORY_ITEM_ID =  $(this).val();
        var PRICE_LIST_NAME = document.getElementById('PRICE_LIST_NAME').value;
        console.log(PRICE_LIST_NAME);

        $.ajax({
            url:"getvalue.php",
            type:"post",
            data:{INVERTORY_ITEM:INVERTORY_ITEM_ID,PRICE_LIST_NAME},
            dataType: "json",
            success:function(response){
              // alert(data);
                var len = response.length;

                $("#DESCRIPTION").empty();
                $("#PRIMARY_UOM_CODE").empty();
                $("#UNIT_LIST_PRPICE").empty();
                for( var i = 0; i<len; i++){
                    var description = response[i]['DESCRIPTION'];
                    var INVENTORY_ITEM_ID = response[i]['INVENTORY_ITEM_ID'];
                    var PRIMARY_UOM_CODE = response[i]['PRIMARY_UOM_CODE'];
                    var UNIT_LIST_PRPICE = response[i]['OPERAND'];
                    $("#DESCRIPTION").append("<input value='"+description+"' disabled >");
                    $("#PRIMARY_UOM_CODE").append("<input value='"+PRIMARY_UOM_CODE+"' disabled >");
                    $("#UNIT_LIST_PRPICE").append("<input value='"+UNIT_LIST_PRPICE+"' disabled>");

                }
            }
        });
    });

    $("#BANK_ID").change(function(e){
        var BANK_ID =  $(this).val();
        console.log(BANK_ID);

        $.ajax({
            url:"getbankinfo.php",
            type:"post",
            data:{BANK_ID:BANK_ID},
            dataType: "json",
            success:function(response){
              // alert(data);
                var len = response.length;

                $("#REMITTANCE_BRANCE_NAME").empty();
                // $("#PRIMARY_UOM_CODE").empty();
                // $("#UNIT_LIST_PRPICE").empty();
                $("#REMITTANCE_BRANCE_NAME").append("<option value='0'>Select</option>");
                for( var i = 0; i<len; i++){

                    var BRANCH_ID = response[i]['BRANCH_ID'];

                    var BRANCH_NAME = response[i]['BRANCH_NAME'];

                    $("#REMITTANCE_BRANCE_NAME").append("<option value='"+BRANCH_ID+"'>"+BRANCH_NAME+"</option>");

                }
            }
        });
    });


    $("#REMITTANCE_BRANCE_NAME").change(function(e){
        var REMITTANCE_BRANCE_ID =  $(this).val();

        console.log(REMITTANCE_BRANCE_ID);

        $.ajax({
            url:"getbankaccinfo.php",
            type:"post",
            data:{REMITTANCE_BRANCE_ID:REMITTANCE_BRANCE_ID},
            dataType: "json",
            success:function(response){
              // alert(data);
                var len = response.length;

                $("#BANK_ACCOUNT_NO").empty();
                $("#BANK_ACCOUNT_NO").append("<option value='0'>Select</option>");
                // $("#PRIMARY_UOM_CODE").empty();
                // $("#UNIT_LIST_PRPICE").empty();
                for( var i = 0; i<len; i++){

                    var BANK_ACCOUNT_ID = response[i]['BANK_ACCOUNT_ID'];

                    var BANK_ACCOUNT_NUM = response[i]['BANK_ACCOUNT_NUM'];

                    $("#BANK_ACCOUNT_NO").append("<option value='"+BANK_ACCOUNT_ID+"'>"+BANK_ACCOUNT_NUM+"</option>");

                }
            }
        });
    });





    $("#TRANSACTION_TYPE_ID").change(function(e){
        var TRANSACTION_TYPE_NAME =  $(this).val();
        console.log(TRANSACTION_TYPE_NAME);

        $.ajax({
            url:"getquotetypevalue.php",
            type:"post",
            data:{TRANSACTION_TYPE:TRANSACTION_TYPE_NAME},
            dataType: "json",
            success:function(response){

                var len = response.length;

                $("#DESCRIPTION1").empty();

                for( var i = 0; i<len; i++){
                    var description1 = response[i]['DESCRIPTION'];
                    var NAME = response[i]['NAME'];
                    $("#DESCRIPTION1").append("<option value='"+NAME+"'>"+description1+"</option>");


                }
            }
        });
    });

    $("#dp_amount").on('keyup',function(){

      var dp_amount =  $(this).val();
      $("#DP_PERCENT_SESSION_FIELD").hide();
      $("#ACTUAL_DP_AMOUNT_SESSION_FIELD").hide();
      $("#interest_amount_field").hide();
$("#monthly_installment_field").hide();
$("#total_session_field").hide();

      //var result = document.getElementById('result').value;
      // console.log(dp_amount);


if(document.getElementById("NO_OF_INSTALLMENT") && document.getElementById("NO_OF_INSTALLMENT").value)
{
  no_installment = document.getElementById("NO_OF_INSTALLMENT").value;
}
else{
  no_installment = 1;
}

console.log(no_installment);

      $.ajax({    //create an ajax request to display.php
        url: "dp_cal.php",
        type: "post",
        data: {dp_amount:dp_amount,no_installment},
        dataType: "json",   //expect html to be returned
      success: function(r){
        // alert(r);
        // $("#dp_percent").empty();
        // $("#dp_percent").append("<input name='DP_PERCENT' id='DP_PERCENT' class='form-control' value='"+r[0]+"' disabled >" );
        // //actual_dp_amount
        // $("#actual_dp_amount").empty();
        // $("#actual_dp_amount").html("<input name='ACTUAL_DP_AMOUNT' id='ACTUAL_DP_AMOUNT' class='form-control' type='text' value='"+r[1]+"' disabled>" );



       //alternate
       var len = r.length;


        for( var i = 0; i<len; i++){
          var dp_percent = r[i]['Dp_Percent'];
          var actual_dp = r[i]['Actual_Dp_Amount'];

          var total_interest_amount = r[i]['Total_Interest_Amount'];
          var total = r[i]['ToTaL'];
          var monthly_installment_amount = r[i]['Monthly_Installment_Amount'];
          }

        // var dp_percent = r['0'];
        // var actual_dp = r['1'];
        $("#dp_percent").empty();
        $("#dp_percent").append("<input name='DP_PERCENT' id='DP_PERCENT' class='form-control' value='"+dp_percent+"' disabled >" );
        //actual_dp_amount
        $("#actual_dp_amount").empty();
        $("#actual_dp_amount").html("<input name='ACTUAL_DP_AMOUNT' id='ACTUAL_DP_AMOUNT' class='form-control' type='text' value='"+actual_dp+"' disabled>" );



        $("#Interest_Amount").empty();
        $("#Interest_Amount").html("<input name='INTEREST_AMOUNT' class='form-control' type='text' value='"+total_interest_amount+"'  disabled>" );
        $("#Total").empty();
        $("#Total").html("<input name='TOTAL' class='form-control' type='text' value='"+total+"' disabled>" );
        $("#Monthly_Installment").empty();
        $("#Monthly_Installment").html("<input name='MONTHLY_INSTALLMENT_AMOUNT' class='form-control' type='text' value='"+monthly_installment_amount+"' disabled>" );




      }

  });
})
$("#search").on('keyup',function(){
    var description_field =  $(this).val();
    console.log(description_field);
    $.ajax({
    url: "description_search.php",
    type: "post",
    data: {description_field:description_field},
    dataType: "html",
    success: function(response){
        $("#INVENTORY_ITEM_ID").html(response);
    }
    });
})

$("#NO_OF_INSTALLMENT").on('change',function(){

var no_installment =  $(this).val();
var Total_Interest_Amount = 0;
var Total = 0;
// var dp_percent = document.getElementById('DP_PERCENT').value;
// var actual_dp_amount = document.getElementById('ACTUAL_DP_AMOUNT').value;

if(document.getElementById("DP_PERCENT") && document.getElementById("DP_PERCENT").value)
{
  dp_percent = document.getElementById("DP_PERCENT").value;
}
else{
  dp_percent = 0;
}

if(document.getElementById("ACTUAL_DP_AMOUNT") && document.getElementById("ACTUAL_DP_AMOUNT").value)
{
  actual_dp_amount = document.getElementById("ACTUAL_DP_AMOUNT").value;
}
else{
  actual_dp_amount = 0;
}

console.log(dp_percent);
console.log(actual_dp_amount);

$("#interest_amount_field").hide();
$("#monthly_installment_field").hide();
$("#total_session_field").hide();

$.ajax({    //create an ajax request to display.php
        url: "installment_cal.php",
        type: "post",
        data: {dp_percent:dp_percent,no_installment,actual_dp_amount,Total_Interest_Amount,Total},
        dataType: "json",   //expect html to be returned
      success: function(r){

        $("#Interest_Amount").empty();
        $("#Interest_Amount").html("<input name='INTEREST_AMOUNT' class='form-control' type='text' value='"+r[0]+"'  disabled>" );
        $("#Total").empty();
        $("#Total").html("<input name='TOTAL' class='form-control' type='text' value='"+r[1]+"' disabled>" );
        $("#Monthly_Installment").empty();
        $("#Monthly_Installment").html("<input name='MONTHLY_INSTALLMENT_AMOUNT' class='form-control' type='text' value='"+r[2]+"' disabled>" );


      }

  });


})



});




function insert() {

  // var LINE_NO = document.getElementById('LINE_NO').value;
  var QUANTITY = document.getElementById('QUANTITY').value;
  var INVENTORY_ITEM_ID = document.getElementById('INVENTORY_ITEM_ID').value;
  // var dp_amount = document.getElementById('dp_amount').value;
  // var no_installment = document.getElementById('NO_OF_INSTALLMENT').value;

  //var UNIT_SELLING_PRICE = document.getElementById('UNIT_SELLING_PRICE').value;

  if(document.getElementById("dp_amount") && document.getElementById("dp_amount").value)
{
  dp_amount = document.getElementById("dp_amount").value;
}
else{
  dp_amount = 0;
}

if(document.getElementById("NO_OF_INSTALLMENT") && document.getElementById("NO_OF_INSTALLMENT").value)
{
  no_installment = document.getElementById("NO_OF_INSTALLMENT").value;
}
else{
  no_installment = 0;
}


  $("#DP_PERCENT_SESSION_FIELD").hide();
  $("#ACTUAL_DP_AMOUNT_SESSION_FIELD").hide();
  $("#interest_amount_field").hide();
  $("#monthly_installment_field").hide();
  $("#total_session_field").hide();
  console.log(dp_amount);

  $.ajax({
        url:"quotelineinsert.inc.php",
        type:"post",
        data:{INVENTORY_ITEM_ID:INVENTORY_ITEM_ID,QUANTITY,dp_amount,no_installment},
        dataType: "json",
      success: function(r){


        var len = r.length;


        for( var i = 0; i<len; i++){
          var dp_percent = r[i]['Dp_Percent'];
          var actual_dp = r[i]['Actual_Dp_Amount'];

          var total_interest_amount = r[i]['Total_Interest_Amount'];
          var total = r[i]['ToTaL'];
          var monthly_installment_amount = r[i]['Monthly_Installment_Amount'];
          }

        // var dp_percent = r['0'];
        // var actual_dp = r['1'];
        $("#dp_percent").empty();
        $("#dp_percent").append("<input name='DP_PERCENT' id='DP_PERCENT' class='form-control' value='"+dp_percent+"' disabled >" );
        //actual_dp_amount
        $("#actual_dp_amount").empty();
        $("#actual_dp_amount").html("<input name='ACTUAL_DP_AMOUNT' id='ACTUAL_DP_AMOUNT' class='form-control' type='text' value='"+actual_dp+"' disabled>" );



        $("#Interest_Amount").empty();
        $("#Interest_Amount").html("<input name='INTEREST_AMOUNT' class='form-control' type='text' value='"+total_interest_amount+"'  disabled>" );
        $("#Total").empty();
        $("#Total").html("<input name='TOTAL' class='form-control' type='text' value='"+total+"' disabled>" );
        $("#Monthly_Installment").empty();
        $("#Monthly_Installment").html("<input name='MONTHLY_INSTALLMENT_AMOUNT' class='form-control' type='text' value='"+monthly_installment_amount+"' disabled>" );

      }

    });

}





function check() {

  var Installment_Num = document.getElementById('NO_OF_INSTALLMENT').value;
  var Free_Installment = document.getElementById('Free_Installment').value;
  var payment_type = document.getElementById('PAYMENT_TYPE').value;
  var quote_type = document.getElementById('TRANSACTION_TYPE_ID').value;
  var discount_value = document.getElementById('discount-text').value;
  var discount_type = document.getElementById('DISCOUNT_TYPE_test').value;
  var inputText = document.getElementById('quote_date').value;
  var day = document.getElementById('day').value;
  var dateformat = /^(0?[1-9]|[12][0-9]|3[01])[\/\-](0?[1-9]|1[012])[\/\-]\d{4}$/;
  var now = new Date();
  var total_days_in_month = new Date(now.getFullYear(), now.getMonth()+1, 0).getDate();
  var month = new Array();
  month[1] = "January";
  month[2] = "February";
  month[3] = "March";
  month[4] = "April";
  month[5] = "May";
  month[6] = "June";
  month[7] = "July";
  month[8] = "August";
  month[9] = "September";
  month[10] = "October";
  month[11] = "November";
  month[12] = "December";
  if(day == ""){
    alert("Day of the Month to start Installment field is empty");
    return false;

  }else{
    if(day > total_days_in_month){
      var month_name = month[now.getMonth()+1];
      alert(month_name + " month consist of " + total_days_in_month + "days");
      return false;
    }
  }
  if(payment_type == ""){
    alert("Payment Type is not given");
    return false;
  }
if(discount_type == ""){
  alert("Discount Type is not given");
  return false;
}
if(discount_value == ""){
  alert("Discount value is not given");
  return false;
}
if(discount_type == "Percent"){

  if(discount_value > 100){
    alert("Discount value is Invalid");
    return false;
  }
  else if (discount_value > 30) {
    alert("Discount value can't be more than 30%");
    return false;
  }
}

  if(quote_type == ""){
    alert("Quote Type is not given");
    return false;
  }

  //date validation
  if(inputText.value.match(dateformat))
  {
  document.form1.text1.focus();
  //Test which seperator is used '/' or '-'
  var opera1 = inputText.value.split('/');
  var opera2 = inputText.value.split('-');
  lopera1 = opera1.length;
  lopera2 = opera2.length;
  // Extract the string into month, date and year
  if (lopera1>1)
  {
  var pdate = inputText.value.split('/');
  }
  else if (lopera2>1)
  {
  var pdate = inputText.value.split('-');
  }
  var dd = parseInt(pdate[0]);
  var mm  = parseInt(pdate[1]);
  var yy = parseInt(pdate[2]);
  // Create list of days of a month [assume there is no leap year by default]
  var ListofDays = [31,28,31,30,31,30,31,31,30,31,30,31];
  if (mm==1 || mm>2)
  {
  if (dd>ListofDays[mm-1])
  {
  alert('Invalid date format!');
  return false;
  }
  }
  if (mm==2)
  {
  var lyear = false;
  if ( (!(yy % 4) && yy % 100) || !(yy % 400))
  {
  lyear = true;
  }
  if ((lyear==false) && (dd>=29))
  {
  alert('Invalid date format!');
  return false;
  }
  if ((lyear==true) && (dd>29))
  {
  alert('Invalid date format!');
  return false;
  }
  }
  }
  else
  {
  alert("Invalid date format!");
  document.form1.text1.focus();
  return false;
  }

  if(Installment_Num == ""){
    alert("Number of Installment is not given");
    return false;
  }

  var x = parseInt(Installment_Num);
  var y = parseInt(Free_Installment);

    if(x > y){

      return true;
    }
    else{
      alert("No. of Installment must be bigger than No. of Interest Free Installment");
      return false;
    }


  }

  document.getElementById('TRANSACTION_TYPE_ID').value = "<?php echo $_POST['QUOTE_TYPE'];?>";
  document.getElementById('DESCRIPTION1').value = "<?php echo $_POST['QUOTE_TYPE'];?>";
  document.getElementById('PAYMENT_TYPE').value = "<?php echo $_POST['PAYMENT_TYPE'];?>";
  document.getElementById('NO_OF_INSTALLMENT').value = "<?php echo $_POST['NO_OF_INSTALLMENT'];?>";
  document.getElementById('Free_Installment').value = "<?php echo $_POST['NO_OF_FREE_INSTALLMENT'];?>";
  document.getElementById('DISCOUNT_TYPE_test').value = "<?php echo $_POST['DISCOUNT_TYPE'];?>";
  document.getElementById('BANK_ID').value = "<?php echo $_POST['REMITTANCE_BANK_NAME'];?>";
  document.getElementById('PRICE_LIST_NAME').value = "<?php echo $_POST['PRICE_LIST_NAME'];?>";
  document.getElementById('REMITTANCE_BRANCE_NAME').value = "<?php echo $_POST['REMITTANCE_BRANCE_NAME'];?>";
  document.getElementById('BANK_ACCOUNT_NO').value = "<?php echo $_POST['BANK_ACCOUNT_NO'];?>";
  document.getElementById('AGENT_DEALER_COMM_PAYABLE').value = "<?php echo $_POST['AGENT_DEALER_COMM_PAYABLE'];?>";
  document.getElementById('PROMO_GIFT_APPLICABLE').value = "<?php echo $_POST['PROMO_GIFT_APPLICABLE'];?>";
  document.getElementById('MICR_CHEQUE_GIVEN_IN_DEL').value = "<?php echo $_POST['MICR_CHEQUE_GIVEN_IN_DEL'];?>";
  document.getElementById('REGISTRATION_INC').value = "<?php echo $_POST['REGISTRATION_INC'];?>";
  document.getElementById('CUSTOMER_BANK_NAME').value = "<?php echo $_POST['CUSTOMER_BANK_NAME'];?>";





</script>


<table class="table-responsive-lg" id="last_table" width="90%" >
<tr bgcolor="#F174F7">
<td colspan = "5">Quote Lines</TD>
</TR>
<TR>

<td>Search</td>
<TD>Description</TD>
<!-- <TD>Description</TD> -->
<TD>Quantity</TD>
<TD>UOM</TD>
<TD>Unit List Price</TD>
</TR>


<TR>

<td>   <input id="search" type="text" onkeydown="return event.key != 'Enter';" > </td>

  <TD>
  <select name="INVENTORY_ITEM_ID" id="INVENTORY_ITEM_ID">
  <option value="0">Select</option>
            <?php
            $sql = "SELECT ORGANIZATION_ID,inventory_item_id,
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
      and ORGANIZATION_ID = '".$_SESSION['ORGANIZATION_ID']."'
      order by 2";
            $result1= oci_parse($conn, $sql);
            oci_execute($result1);
            while($row1 =oci_fetch_array($result1,OCI_ASSOC)):
              echo "<option value='".$row1['INVENTORY_ITEM_ID']."' >".$row1['DESCRIPTION']."  ---------> ".$row1['ITEM_CODE']."</option>";
            endwhile;
            ?>
            </select>
  </TD>
  <!-- <TD>
  <output type="text" id="DESCRIPTION"> No value </output>

  </TD> -->
  <TD>
    <INPUT type="text" name="QUANTITY" id="QUANTITY" />
  </TD>
  <TD>
  <output type="text" id="PRIMARY_UOM_CODE" value="No value"> No value </output>
  <!-- <select disabled name="PRIMARY_UOM_CODE" id="PRIMARY_UOM_CODE">
  <option value="0">No Value</option>
  </select> -->
  </TD>
  <!-- <TD>
    <INPUT type="text" name="UNIT_SELLING_PRICE" id="UNIT_SELLING_PRICE"/>
  </TD> -->
  <TD>
  <output type="text" id="UNIT_LIST_PRPICE" value="No value"> No value </output>
  <!-- <select disabled name="UNIT_LIST_PRPICE" id="UNIT_LIST_PRPICE">
  <option value="0">No Value</option>
  </select> -->
  </TD>
  <td>
  <INPUT type="button" style="margin-left:20px;" onclick="insert()" class="btn btn-success" value="Insert" />
  </td>


</TR>

</TABLE>
<br>
<hr>


<br>



<table id="responsecontainer" class="table-responsive-md" id="last_table" width="60%" >
<tr bgcolor="#F174F7">
<td colspan = "7">Quote Lines</TD>

</tr>
<TR>

<TD style="width: 100px;">Line No.</TD>
<TD>Order Item ID</TD>
<TD>Quantity</TD>
<TD>UOM</TD>
<TD>Unit Selling Price</TD>
<TD>Unit List Price</TD>
</TR>
</table>


  <br>



<?php

if ($_SESSION["PROCEDURE_STATUS"] == 1) {
  $delete_query = " Delete from XX_QUOTE_DRAFT_APPR_LIST_ALL where QUOTE_HEADER_ID  = '".$_SESSION["P_QUOTE_HEADER_ID"]."' ";
     //mysqli_query($con, $update_query);
     $result_delete= oci_parse($conn, $delete_query);
     oci_execute($result_delete);
  # code...
}

$_SESSION["PROCEDURE_STATUS"] = 0;
//$_SESSION["P_QUOTE_HEADER_ID"] = 9;


if (!isset($_SESSION["P_QUOTE_HEADER_ID"])) {
  $sql_seq1 = "SELECT XX_QUOTE_HEADERS_ALL_SEQ.NEXTVAL FROM DUAL";
$result_seq1 = oci_parse($conn, $sql_seq1);
oci_execute($result_seq1);
while($rows_seq = oci_fetch_array($result_seq1,OCI_RETURN_NULLS + OCI_ASSOC)):
  foreach ($rows_seq as $QUOTE_HEADER_ID);
endwhile;

$_SESSION["P_QUOTE_HEADER_ID"] =  $QUOTE_HEADER_ID;
}


// $sql_seq2 = "ALTER SEQUENCE XX_QUOTE_HEADERS_ALL2_SEQ INCREMENT BY -1";
// $result_seq1 = oci_parse($conn, $sql_seq2);
// oci_execute($result_seq1);

// $sql_seq3 = "SELECT XX_QUOTE_HEADERS_ALL2_SEQ.NEXTVAL FROM DUAL";
// $result_seq3 = oci_parse($conn, $sql_seq3);
// oci_execute($result_seq3);

// $sql_seq4 = "ALTER SEQUENCE XX_QUOTE_HEADERS_ALL2_SEQ INCREMENT BY 1";
// $result_seq4 = oci_parse($conn, $sql_seq4);
// oci_execute($result_seq4);

// $sql_seq5 = "SELECT XX_QUOTE_HEADERS_ALL2_SEQ.CURRVAL FROM DUAL";
// $result_seq5 = oci_parse($conn, $sql_seq5);
// oci_execute($result_seq5);



?>






  <p id="button2"><input  type="submit" name="submit" value="Preview" onclick="return check()" class="btn btn-primary"></p>
  </form>
  <br>




  <!-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script> -->
  <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script> -->
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</body>

</html>

<?php
}
else {

header("Location:login.php?_Please_Login_First");
}
 ?>
