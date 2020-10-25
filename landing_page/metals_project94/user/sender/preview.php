<?php

session_start();
// echo $_SESSION["P_QUOTE_HEADER_ID"];
// echo '<br>';
// echo $_SESSION['CUSTOMER_ID_1'];
error_reporting(0);
// echo $_SESSION["OPERATING_UNIT"]."</br>";
// echo $_POST["ASSESSMENT_NUMBER"]."</br>";
// echo $_POST["APPLICANT_NAME"]."</br>";
// echo $_POST["CUSTOMER_ID"]."</br>";
// echo $_POST["QUOTE_NAME"]."</br>";
// echo $_SESSION["FATHERS_NAME"]."</br>";
// echo $_SESSION["PER_THANA"]."</br>";
// echo $_POST["CURRENCY"]."</br>";
// echo $_SESSION["PER_DISTRICT"]."</br>";
// echo $_SESSION["MOBILE"]."</br>";
// echo $_POST["DP_AMOUNT"]."</br>";
// echo $_POST["PAYMENT_TYPE"]."</br>";
// echo $_POST["AGENT_DEALER_COMM_PAYABLE"]."</br>";
// echo $_POST["CHEQUE_REF_NO"]."</br>";
// echo $_POST["NAME_OF_AGENT_DEALER"]."</br>";

// echo $_POST["REMITTANCE_BANK_NAME"]."</br>";
// echo $_POST["NAME_OF_PROMO_SCHEME"]."</br>";
// echo $_POST["NO_OF_INSTALLMENT"]."</br>";
// echo $_POST["REMITTANCE_BRANCE_NAME"]."</br>";
// echo $_POST["PROMO_GIFT_APPLICABLE"]."</br>";
// echo $_POST["DISCOUNT_VALUE"]."</br>";
// echo $_POST["DISCOUNT_TYPE"]."</br>";

// echo $_POST["BANK_ACCOUNT_NO"]."</br>";
// echo $_POST["NAME_OF_GIFT"]."</br>";
// echo $_POST["NO_OF_FREE_INSTALLMENT"]."</br>";
// echo $_POST["MICR_CHEQUE_GIVEN_IN_DEL"]."</br>";
// echo $_POST["INSTALLMENT_START_DAY"]."</br>";
// echo $_POST["CUSTOMER_BANK_NAME"]."</br>";
// echo $_POST["OCCUPATION"]."</br>";
// echo $_SESSION["REGION"]."</br>";
// echo $_POST["MONTHLY_INCOME"]."</br>";
// echo $_SESSION["TERRITORY"]."</br>";
// echo $_POST["TOTAL_DEPENDENT"]."</br>";
// echo $_POST["SOURCE_OF_MONEY"]."</br>";
// echo $_POST["OWN_EQUITY_AMOUNT"]."</br>";
// echo $_SESSION["ORG_ID"]."</br>";
// echo $_POST["BORROWED_EQUITY_AMOUNT"]."</br>";
// echo $_POST["REMARKS"]."</br>";

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
    .sl {
      width: 60px;
    }
    .name {
      width: 420px;
    }

    .response {
      width: 150px;
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
          <input type="text" class="form-control assis" name="OPERATING_UNIT" placeholder="TMPL Tractor" value="<?php echo $_SESSION["OPERATING_UNIT"]; ?>" disabled>
        </div>
      </td>

    </tr>
    <tr>
      <td height="2">
        <div class="input-group">
          <div class="input-group-prepend ">
            <span class="input-group-text" id="">Assessment No.</span>

          </div>
          <input type="text" class="form-control " name="ASSESSMENT_NUMBER" value="<?php echo  $_POST["ASSESSMENT_NUMBER"]; $_SESSION["ASSESSMENT_NUMBER"] = $_POST["ASSESSMENT_NUMBER"]; ?>" disabled>
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
                <input type="text" name="APPLICANT_NAME" value="<?php echo $_POST['APPLICANT_NAME']; $_SESSION['APPLICANT_NAME'] = $_POST['APPLICANT_NAME']; ?>" class="form-control" disabled>
              </div>
            </td>

            <td>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"  id="">Quote Number</span>
                </div>
                <?php
                include 'dbh.inc.php';

$sql91 = "SELECT TTT.TRANSACTION_TYPE_ID, NAME, DESCRIPTION
FROM oe_transaction_types_tl ttt, oe_transaction_types_all tta
WHERE     ttt.TRANSACTION_TYPE_ID = tta.TRANSACTION_TYPE_ID
     AND TRANSACTION_TYPE_CODE = 'ORDER'
     AND NAME = '".$_POST['QUOTE_TYPE']."'
     AND NVL (END_DATE_ACTIVE, TRUNC (SYSDATE)) >= TRUNC (SYSDATE)
     AND tta.org_id = '".$_SESSION['ORG_ID']."' ";

$result91 = oci_parse($conn, $sql91);
oci_execute($result91);
while($row91 =oci_fetch_array($result91,OCI_ASSOC)):
  $QUOTE_TYPE_ID = $row91["TRANSACTION_TYPE_ID"];
endwhile;



                      $sql65 = "SELECT XX_GET_QUOTE_NUM('".$_SESSION["ORG_ID"]."',$QUOTE_TYPE_ID) FROM DUAL";
                      $result65 = oci_parse($conn, $sql65);
                      oci_execute($result65);

                          while($rows65 = oci_fetch_array($result65,OCI_RETURN_NULLS + OCI_ASSOC)):
                              foreach ($rows65 as $QUOTE_NUMBER);
                          endwhile;
                ?>
                <input type="text" name="" class="form-control" value="<?php echo $QUOTE_NUMBER; $_SESSION["QUOTE_NUMBER"] = $QUOTE_NUMBER; ?>" disabled>
              </div>
            </td>

            <td>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"  id="">Price List Name</span>
                </div>
                 <input type="text" class="form-control" disabled value="<?php echo $_POST["PRICE_LIST_NAME"]; $_SESSION["PRICE_LIST_NAME"] = $_POST["PRICE_LIST_NAME"]; ?>" >
              </div>

            </td>

          </tr>
          <tr>
            <td>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="" >Customer Number</span>
                </div>

                <input type="text"  name="CUSTOMER_ID" value="<?php echo $_POST['CUSTOMER_ID']; $_SESSION['CUSTOMER_ID'] = $_SESSION['CUSTOMER_ID_1'];?>" class="form-control" disabled>
              </div>
            </td>
            <td>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"  id="">Quote Name</span>
                </div>
                <input disabled type="text" name="QUOTE_NAME" value="<?php echo $_POST['QUOTE_NAME']; $_SESSION['QUOTE_NAME'] = $_POST['QUOTE_NAME'];?>" class="form-control">
              </div>
            </td>

            <!-- <td rowspan="7"> -->

            <td>
            <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="">Quote Status
                  </span>
                </div>
                <input type="text" class="form-control" value="<?php echo "NOT SUBMITTED"; $_SESSION['QUOTE_STATUS'] = "PENDING";  ?>"  disabled>
              </div>
            </td>

          </tr>
          <tr>

            <td>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="">Father Name / Spouse Name</span>
                </div>
                <input disabled  type="text" name="FATHERS_NAME" value="<?php echo $_SESSION["FATHERS_NAME"]; ?>" class="form-control"  disabled>
              </div>
            </td>

            <td>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="">Quote Date</span>
                </div>
                <input disabled type="date" name="QUOTE_DATE" value="<?php echo $_POST["QUOTE_DATE"]; $_SESSION["QUOTE_DATE"] = $_POST["QUOTE_DATE"];?>" class="form-control">
              </div>
            </td>





          </tr>
          <tr>
            <td>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="">Village</span>
                </div>
                <input type="text" name="PER_VILLAGE" value="<?php echo $_SESSION['PER_VILLAGE']; ?>" class="form-control" disabled>
              </div>
            </td>

            <td>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"  id="">Quote Type</span>
                </div>
                <input disabled type="text" name="QUOTE_TYPE" value="<?php echo $_POST['QUOTE_TYPE']; $_SESSION["QUOTE_TYPE"] = $_POST["QUOTE_TYPE"];?>" class="form-control">
              </div>
            </td>
            <td>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="">DESCRIPTION</span>
                </div>
                <?php

                include "dbh.inc.php";
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
              }

                ?>
                <input disabled type="text" name="DESCRIPTION1" value="<?php echo $DESCRIPTION;?>" class="form-control">
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

                <input type="text" name="PER_POST" value="<?php echo $_SESSION['PER_POST']; ?>"  class="form-control" disabled>
              </div>
            </td>

            <td>
            <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="">Currency
                </div>
                <input disabled type="text"  name="CURRENCY" value="<?php echo $_POST["CURRENCY"]; $_SESSION["CURRENCY"] = $_POST["CURRENCY"]; ?>" class="form-control">
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
                <input type="text" name="PER_THANA" value="<?php echo $_SESSION["PER_THANA"]; ?>"  class="form-control" disabled>
              </div>
            </td>

            <td>
            <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="">Interest Amount
                </div>
                <input type="text" name="" class="form-control" value="<?php echo $_SESSION["TEST_INTEREST_AMOUNT"];  $_SESSION["INTEREST_AMOUNT"] = $_SESSION["TEST_INTEREST_AMOUNT"];?>" disabled>
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
                <input type="text" name="PER_DISTRICT" value="<?php echo $_SESSION["PER_DISTRICT"]; ?>" class="form-control" disabled>
              </div>
            </td>

            <td>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="">Monthly Installment Amount
                </div>
                <input type="text" name="" class="form-control" value="<?php echo $_SESSION["TEST_MONTHLY_INSTALLMENT_AMOUNT"]; $_SESSION["MONTHLY_INSTALLMENT_AMOUNT"] = $_SESSION["TEST_MONTHLY_INSTALLMENT_AMOUNT"]; ?>" disabled>
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
                <input type="text" name="MOBILE" value="<?php echo $_SESSION["MOBILE"];  ?>"  class="form-control" disabled>
              </div>
            </td>

            <td>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="">Total
                </div>
                <input type="text" name="" class="form-control" value="<?php echo $_SESSION["TEST_TOTAL"]; $_SESSION["TOTAL"] = $_SESSION["TEST_TOTAL"];?>" disabled>
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
                <input disabled type="text" name="DP_AMOUNT" value="<?php echo $_POST["DP_AMOUNT"]; $_SESSION["DP_AMOUNT"] = $_POST["DP_AMOUNT"]; ?>" class="form-control">
              </div>
            </td>

            <td>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"  id="">Payment Type</span>
                </div>
                 <input type="text" class="form-control" disabled value="<?php echo $_POST["PAYMENT_TYPE"]; $_SESSION["PAYMENT_TYPE"] = $_POST["PAYMENT_TYPE"]; ?>" >
              </div>

            </td>

            <td>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text Agent" id="">Agent/Dealar Commission payable?</span>
                </div>
                <input type="text" disabled class="form-control" name="AGENT_DEALER_COMM_PAYABLE" value="<?php echo $_POST["AGENT_DEALER_COMM_PAYABLE"]; $_SESSION["AGENT_DEALER_COMM_PAYABLE"] = $_POST["AGENT_DEALER_COMM_PAYABLE"];  ?>">

              </div>

            </td>



          </tr>
          <tr>
            <td>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"  id="">DP Percent</span>
                </div>
                <input type="text" name="" class="form-control" value="<?php echo $_SESSION['TEST_DP_PERCENT']; $_SESSION["DP_PERCENT"] = $_SESSION['TEST_DP_PERCENT']; ?>" disabled>
              </div>
            </td>

            <td>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"  id="">Cheque No. / Reference No.</span>
                </div>
                <input disabled type="text" name="CHEQUE_REF_NO" value="<?php echo $_POST["CHEQUE_REF_NO"]; $_SESSION["CHEQUE_REF_NO"] = $_POST["CHEQUE_REF_NO"];  ?>"  class="form-control">
              </div>
            </td>
            <td>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"  id="">Name of Agent/Dealer</span>
                </div>
                <input disabled type="text" name="NAME_OF_AGENT_DEALER" value="<?php echo $_POST["NAME_OF_AGENT_DEALER"]; $_SESSION["NAME_OF_AGENT_DEALER"] = $_POST["NAME_OF_AGENT_DEALER"];  ?>" class="form-control">
              </div>
            </td>

          </tr>
          <tr>

            <td>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"  id="">Actual DP Amount</span>
                </div>
                <input type="text" name="" class="form-control" value="<?php echo $_SESSION['TEST_ACTUAL_DP_AMOUNT']; $_SESSION["ACTUAL_DP_AMOUNT"] = $_SESSION['TEST_ACTUAL_DP_AMOUNT']; ?>" disabled>
              </div>
            </td>

            <td>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"  id="">Remittance Bank Name</span>
                </div>
                <?php
                $sql40 = "SELECT DISTINCT BANK_NAME FROM XX_CE_BANK_BRCH_ACCNTS_V
                WHERE ORG_ID= '".$_SESSION["ORG_ID"]."'
                and BANK_ID = '".$_POST["REMITTANCE_BANK_NAME"]."' ";
                $result40= oci_parse($conn, $sql40);
                oci_execute($result40);
                while($row40 =oci_fetch_array($result40,OCI_ASSOC)){
                  $BANK_NAME = $row40["BANK_NAME"];

                }
                ?>
                <input disabled type="text" name="REMITTANCE_BANK_NAME" value="<?php echo $BANK_NAME; $_SESSION["REMITTANCE_BANK_NAME"] = $_POST["REMITTANCE_BANK_NAME"]; ?>" class="form-control">
              </div>
            </td>
            <td>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"  id="">Name of the Promotional Scheme</span>
                </div>
                <input disabled type="text" name="NAME_OF_PROMO_SCHEME" value="<?php echo $_POST["NAME_OF_PROMO_SCHEME"]; $_SESSION["NAME_OF_PROMO_SCHEME"] = $_POST["NAME_OF_PROMO_SCHEME"]; ?>" class="form-control">
              </div>
            </td>




          </tr>
          <tr>
            <td>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"  id="">No. of Installment</span>
                </div>
                <input disabled type="text" name="NO_OF_INSTALLMENT" value="<?php echo $_POST["NO_OF_INSTALLMENT"]; $_SESSION["NO_OF_INSTALLMENT"] = $_POST["NO_OF_INSTALLMENT"]; $_SESSION["NO_OF_INSTALLMENT_S"] = $_POST["NO_OF_INSTALLMENT"]; ?>" class="form-control">
              </div>
            </td>

            <td>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"  id="">Branch Name</span>
                </div>
                <?php
                $sql41 = "SELECT DISTINCT BRANCH_NAME FROM XX_CE_BANK_BRCH_ACCNTS_V
                WHERE ORG_ID= '".$_SESSION["ORG_ID"]."'
                and BRANCH_ID = '".$_POST["REMITTANCE_BRANCE_NAME"]."' ";
                $result41= oci_parse($conn, $sql41);
                oci_execute($result41);
                while($row41 =oci_fetch_array($result41,OCI_ASSOC)){
                  $BRANCH_NAME = $row41["BRANCH_NAME"];

                }
                ?>
                <input disabled type="text" name="REMITTANCE_BRANCE_NAME" value="<?php echo $BRANCH_NAME; $_SESSION["REMITTANCE_BRANCE_NAME"] = $_POST["REMITTANCE_BRANCE_NAME"]; ?>" class="form-control">
              </div>
            </td>
            <td>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text Agent" id="">Promotioanl Gift Applicable?</span>
                </div>
                <input type="text" class="form-control" disabled name="PROMO_GIFT_APPLICABLE" value="<?php echo $_POST["PROMO_GIFT_APPLICABLE"]; $_SESSION["PROMO_GIFT_APPLICABLE"] = $_POST["PROMO_GIFT_APPLICABLE"];  ?>">
              </div>
            </td>

          </tr>
          <tr>
            <td>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="">Discount</span>

                  <input disabled type="text" class="form-control" name="DISCOUNT_VALUE" value="<?php echo $_POST["DISCOUNT_VALUE"]; $_SESSION["DISCOUNT_VALUE"] = $_POST["DISCOUNT_VALUE"];?>" id="discount-text">
                </div>
                <input class="form-control" type="text" name="DISCOUNT_TYPE" value="<?php echo $_POST["DISCOUNT_TYPE"]; $_SESSION["DISCOUNT_TYPE"] = $_POST["DISCOUNT_TYPE"];?>" disabled >
            </td>

            <td>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"  id="">Bank Account No.
                  </span>
                </div>
                <?php
                $sql42 = "SELECT DISTINCT BANK_ACCOUNT_NUM FROM XX_CE_BANK_BRCH_ACCNTS_V
                WHERE ORG_ID= '".$_SESSION["ORG_ID"]."'
                and BANK_ACCOUNT_ID = '".$_POST["BANK_ACCOUNT_NO"]."' ";
                $result42= oci_parse($conn, $sql42);
                oci_execute($result42);
                while($row42 =oci_fetch_array($result42,OCI_ASSOC)){
                  $BANK_ACC_NO = $row42["BANK_ACCOUNT_NUM"];

                }
                ?>
                <input disabled type="text" name="BANK_ACCOUNT_NO" value="<?php echo $BANK_ACC_NO; $_SESSION["BANK_ACCOUNT_NO"] = $BANK_ACC_NO;?>" class="form-control">
              </div>
            </td>
            <td>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"  id="">Name of the Gift
                  </span>
                </div>
                <input disabled type="text" name="NAME_OF_GIFT" value="<?php echo $_POST["NAME_OF_GIFT"]; $_SESSION["NAME_OF_GIFT"] = $_POST["NAME_OF_GIFT"];?>" class="form-control">
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
                <input disabled type="text" name="NO_OF_FREE_INSTALLMENT" value="<?php echo $_POST["NO_OF_FREE_INSTALLMENT"]; $_SESSION["NO_OF_FREE_INSTALLMENT"] = $_POST["NO_OF_FREE_INSTALLMENT"];?>"  class="form-control">
              </div>
            </td>

            <td>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="test">MICR Cheque will be given during Delivery?</span>
                </div>
                <input type="text" class="form-control" disabled name="MICR_CHEQUE_GIVEN_IN_DEL" value="<?php echo $_POST["MICR_CHEQUE_GIVEN_IN_DEL"]; $_SESSION["MICR_CHEQUE_GIVEN_IN_DEL"] = $_POST["MICR_CHEQUE_GIVEN_IN_DEL"];?>">
              </div>
            </td>

            <td>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="test">Registration Included ?</span>
                </div>
                <input type="text" class="form-control" disabled name="REGISTRATION_INC" value="<?php echo $_POST["REGISTRATION_INC"]; $_SESSION["REGISTRATION_INC"] = $_POST["REGISTRATION_INC"];?>">
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
                <input disabled type="text" name="INSTALLMENT_START_DAY" value="<?php echo $_POST["INSTALLMENT_START_DAY"]; $_SESSION["INSTALLMENT_START_DAY"] = $_POST["INSTALLMENT_START_DAY"];?>" class="form-control">
              </div>
            </td>

            <td>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"  id="">Customer Bank Name</span>
                </div>
                <input disabled type="text" name="CUSTOMER_BANK_NAME" value="<?php echo $_POST["CUSTOMER_BANK_NAME"]; $_SESSION["CUSTOMER_BANK_NAME"] = $_POST["CUSTOMER_BANK_NAME"];?>" class="form-control">
              </div>

              <td>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text"  id="">Registration Amount</span>
                  </div>
                  <input disabled type="text" name="REGISTRATION_AMOUNT" value="<?php if($_POST['REGISTRATION_INC'] == "Yes" ){ $_SESSION["REGISTRATION_AMOUNT"] = 14100; } else{ $_SESSION["REGISTRATION_AMOUNT"] = '';} echo $_SESSION["REGISTRATION_AMOUNT"];?>" class="form-control">
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
                <input disabled type="text" name="OCCUPATION" value="<?php echo $_SESSION["OCCUPATION"];?>" class="form-control">
              </div>

            </td>



          </tr>
          <tr>
            <td>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="">Region</span>
                </div>
                <input type="text" name="REGION" value="<?php echo  $_SESSION["REGION"];?>" class="form-control" disabled>
              </div>
            </td>

            <td>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="">Monthly Income</span>
                </div>
                <input disabled type="text" name="MONTHLY_INCOME" value="<?php echo $_SESSION["MONTHLY_INCOME"] ;?>" class="form-control">
              </div>
            </td>

          </tr>
          <tr>

            <td>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="">Territory</span>
                </div>
                <input type="text" name="TERRITORY" value="<?php echo $_SESSION["TERRITORY"]; ?>"  class="form-control" disabled>
              </div>
            </td>

            <td>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="">Dependent</span>
                </div>
                <input disabled type="text" name="TOTAL_DEPENDENT" value="<?php echo $_SESSION["TOTAL_DEPENDENT"];?>" class="form-control">
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
                <input disabled type="text" name="OWN_EQUITY_AMOUNT" value="<?php echo $_SESSION["OWN_EQUITY_AMOUNT"]; ?>" class="form-control">
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
                <input disabled type="text" name="BANK_LOAN_AMOUNT" value="<?php echo $_SESSION["BANK_LOAN_AMOUNT"]; ?>"class="form-control">
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
                <input type="text" class="form-control" name="ORGANIZATION_CODE" value="<?php echo $_SESSION["ORGANIZATION_CODE"];?>"  disabled>
              </div>
            </td>

            <td>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="">NGO Loan Amount
                  </span>

                </div>
                <input disabled type="text" name="NGO_LOAN_AMOUNT" value="<?php echo $_SESSION["NGO_LOAN_AMOUNT"];?>" class="form-control">
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
                <input disabled type="text" name="REMARKS" value="<?php echo $_POST['REMARKS']; $_SESSION["REMARKS"] = $_POST["REMARKS"];?>"  class="form-control">
              </div>
            </td>

            <td>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="">Other Loan Amount
                  </span>

                </div>
                <input disabled type="text" name="OTHER_LOAN_AMOUNT" value="<?php echo $_SESSION["OTHER_LOAN_AMOUNT"];?>" class="form-control">
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
    $i = 0;
$sql = "select * from XX_QUOTE_LINES_ALL WHERE ASSESSMENT_NUMBER = '".$_POST["ASSESSMENT_NUMBER"]."' order by LINE_NO ASC";
          $result1= oci_parse($conn, $sql);
          oci_execute($result1);
          while($row =oci_fetch_array($result1,OCI_ASSOC)):
            $i = $i + 1;
            $INVENTORY_ITEM_ID= $row['INVENTORY_ITEM_ID'];

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
              AND ORGANIZATION_ID = '".$_SESSION['ORGANIZATION_ID']."'
              AND  INVENTORY_ITEM_ID = '".$INVENTORY_ITEM_ID."'

        ORDER BY 2  ";

          $result3= oci_parse($conn, $sql3);
          oci_execute($result3);

           while($row3 =oci_fetch_array($result3,OCI_ASSOC)):
?>
    <tr>
      <td><input type="text" class="form-control" value="<?php echo $i ?>" disabled><input type="hidden" class="form-control" value="<?php echo $row["LINE_NO"]; ?>" disabled></td>
      <td><input type="text" class="form-control" value="<?php echo $row3["ITEM_CODE"]; ?>" disabled></td>
      <td><input type="text" class="form-control" value="<?php echo $row["QUANTITY"]; ?>" disabled></td>
      <td><input type="text" class="form-control" value="<?php echo $row["UNIT_OF_MEASURE"]; ?>" disabled></td>
      <td><input type="text" class="form-control" value="<?php echo $row["UNIT_SELLING_PRICE"]; ?>" disabled></td>
      <td><input type="text" class="form-control" value="<?php echo $row["UNIT_LIST_PRPICE"]; ?>" disabled ></td>
    </tr>

    <?php
    endwhile;
  endwhile; ?>














<?php
// $custome_id = "select CUSTOMER_ID FROM XX_AR_CUSTOMER_SITE_V WHERE CUSTOMER_NUMBER = '".$_POST["CUSTOMER_NUMBER"]."' ";
// $result_custome_id = oci_parse($conn, $custome_id);
//    oci_execute($result_custome_id);

//    $CUSTOMER_ID = oci_fetch_array($result_custome_id,OCI_ASSOC);


if ($_SESSION["PROCEDURE_STATUS"] == 0) {
  $sql_procedure = 'BEGIN xx_get_apprv_list(:P_ORG_ID, :P_QUOTE_HEADER_ID, :P_CUSTOMER_ID,:P_DP_PCT, :P_DISCOUNT, :P_DISCOUNT_TYPE, :P_NO_OF_FREE_INST,:v_status,:v_msg); END;';


  $stmt = oci_parse($conn,$sql_procedure);
  oci_bind_by_name($stmt,':P_ORG_ID',$P_ORG_ID,32);
  oci_bind_by_name($stmt,':P_QUOTE_HEADER_ID',$P_QUOTE_HEADER_ID,32);
  oci_bind_by_name($stmt,':P_CUSTOMER_ID',$P_CUSTOMER_ID,32);
  oci_bind_by_name($stmt,':P_DP_PCT',$P_DP_PCT,32);
  oci_bind_by_name($stmt,':P_DISCOUNT',$P_DISCOUNT,32);
  oci_bind_by_name($stmt,':P_DISCOUNT_TYPE',$P_DISCOUNT_TYPE,32);
  oci_bind_by_name($stmt,':P_NO_OF_FREE_INST',$P_NO_OF_FREE_INST,32);
  oci_bind_by_name($stmt,':v_status',$v_status,32);
  oci_bind_by_name($stmt,':v_msg',$v_msg,32);

  if($_POST["DISCOUNT_TYPE"] == "Percent"){
    $DISCOUNT_TYPE = "P";
  }
  elseif($_POST["DISCOUNT_TYPE"] == "Amount"){
    $DISCOUNT_TYPE = "A";
  }
  else{
    $DISCOUNT_TYPE = NULL;
  }
  if (!isset($_SESSION['TEST_DP_PERCENT'])) {
    $_SESSION['TEST_DP_PERCENT'] = 0;
  }


   $P_ORG_ID = $_SESSION["ORG_ID"];
   $P_QUOTE_HEADER_ID = $_SESSION["P_QUOTE_HEADER_ID"];
   $P_CUSTOMER_ID = $_SESSION['CUSTOMER_ID_1'];
   $P_DP_PCT = $_SESSION['TEST_DP_PERCENT'];
   $P_DISCOUNT = $_POST["DISCOUNT_VALUE"];
   $P_DISCOUNT_TYPE = $DISCOUNT_TYPE;
   $P_NO_OF_FREE_INST = $_POST["NO_OF_FREE_INSTALLMENT"];

  //But BEFORE statement, Create your cursor
  oci_execute($stmt);

  // $message is now populated with the output value
  // print "$v_status\n";
  // print "$v_msg\n";
  $_SESSION["PROCEDURE_STATUS"] = 1;
}


// if($v_status='S')
// {
// $sql="SELECT * FROM XX_QUOTE_APPROVAL_LIST_ALL
//
// WHERE QUOTE_HEADER_ID=$P_QUOTE_HEADER_ID";
//    }


?>

<table align="center" border="0" width="40%">
    <tr align="" bgcolor="#6bd1e7">
      <h3>
        <th colspan="3">Approvers</th>
      </h3>

    </tr>
    <tr>
      <td><input type="text" class="form-control sl" placeholder="SL" disabled></td>
      <td><input type="text" class="form-control name" placeholder="Name" disabled></td>
      <td><input type="text" class="form-control response" placeholder="Activity Type" disabled></td>
    </tr>

    <?php

    $list=" SELECT * FROM XX_QUOTE_DRAFT_APPR_LIST_ALL WHERE QUOTE_HEADER_ID = '".$_SESSION["P_QUOTE_HEADER_ID"]."' ORDER BY SEQUENCE_NO ASC ";

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
      <td><input type="text" class="form-control sl" value="<?php echo $i; ?>" disabled></td>
      <td><input type="text" class="form-control " value="<?php  echo $A_ffname_full['FULL_NAME'];?> (<?php echo $A_list_full['LIST_MEMBER']; ?>)" disabled></td>
      <td><input type="text" class="form-control " value="<?php  echo $A_list_full['ACTIVITY_TYPE'];?>" disabled></td>
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

  <!-- <input id=""  type="submit" name="save" value="Save" class="btn btn-success"> -->
  <input id="button2"  type="submit" name="submit1" value="Initiate Approval" class="btn btn-primary">
  </p>
  </form>


  <form action="page1.php" method="post">
    <!-- <input type="hidden" name="CUSTOMER_ID" value=""> -->
    <input type="hidden" name="QUOTE_NAME" value="<?php echo $_POST["QUOTE_NAME"] ?>">
    <input type="hidden" name="QUOTE_DATE" value="<?php echo $_POST["QUOTE_DATE"] ?>">
    <input type="hidden" name="QUOTE_TYPE" value="<?php echo $_POST["QUOTE_TYPE"] ?>">
    <input type="hidden" name="PRICE_LIST_NAME" value="<?php echo $_POST["PRICE_LIST_NAME"] ?>">
    <input type="hidden" name="CURRENCY" value="<?php echo $_POST["CURRENCY"] ?>">
    <input type="hidden" name="DP_AMOUNT" value="<?php echo $_POST["DP_AMOUNT"] ?>">
    <input type="hidden" name="PAYMENT_TYPE" value="<?php echo $_POST["PAYMENT_TYPE"] ?>">
    <input type="hidden" name="AGENT_DEALER_COMM_PAYABLE" value="<?php echo $_POST["AGENT_DEALER_COMM_PAYABLE"] ?>">
    <input type="hidden" name="CHEQUE_REF_NO" value="<?php echo $_POST["CHEQUE_REF_NO"] ?>">
    <input type="hidden" name="NAME_OF_AGENT_DEALER" value="<?php echo $_POST["NAME_OF_AGENT_DEALER"] ?>">
    <input type="hidden" name="REMITTANCE_BANK_NAME" value="<?php echo $_POST["REMITTANCE_BANK_NAME"] ?>">
    <input type="hidden" name="NAME_OF_PROMO_SCHEME" value="<?php echo $_POST["NAME_OF_PROMO_SCHEME"] ?>">
    <input type="hidden" name="NO_OF_INSTALLMENT" value="<?php echo $_POST["NO_OF_INSTALLMENT"] ?>">

    <input type="hidden" name="REMITTANCE_BRANCE_NAME" value="<?php echo $_POST["REMITTANCE_BRANCE_NAME"]; ?>">

    <input type="hidden" name="PROMO_GIFT_APPLICABLE" value="<?php echo $_POST["PROMO_GIFT_APPLICABLE"] ?>">

    <input type="hidden" name="DISCOUNT_VALUE" value="<?php echo $_POST["DISCOUNT_VALUE"] ?>">
    <input type="hidden" name="DISCOUNT_TYPE" value="<?php echo $_POST["DISCOUNT_TYPE"] ?>">
    <input type="hidden" name="BANK_ACCOUNT_NO" value="<?php echo $_POST["BANK_ACCOUNT_NO"] ?>">
    <input type="hidden" name="NAME_OF_GIFT" value="<?php echo $_POST["NAME_OF_GIFT"] ?>">
    <input type="hidden" name="NO_OF_FREE_INSTALLMENT" value="<?php echo $_POST["NO_OF_FREE_INSTALLMENT"] ?>">
    <input type="hidden" name="MICR_CHEQUE_GIVEN_IN_DEL" value="<?php echo $_POST["MICR_CHEQUE_GIVEN_IN_DEL"] ?>">
    <input type="hidden" name="REGISTRATION_INC" value="<?php echo $_POST["REGISTRATION_INC"] ?>">
    <input type="hidden" name="INSTALLMENT_START_DAY" value="<?php echo $_POST["INSTALLMENT_START_DAY"] ?>">
    <input type="hidden" name="CUSTOMER_BANK_NAME" value="<?php echo $_POST["CUSTOMER_BANK_NAME"] ?>">
    <input type="hidden" name="REMARKS" value="<?php echo $_POST["REMARKS"] ?>">

    <input style="margin: 1px 30px;" id="button2"  type="submit" name="submit2" value="Update" class="btn btn-primary">
  </form>
  <br>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</body>

</html>
