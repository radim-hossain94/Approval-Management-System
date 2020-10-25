
<?php
session_start();
if (isset($_SESSION['u_id'])) {
    include '../../includes/dbh.inc.php';
     ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>jQuery UI Datepicker - Default functionality</title>
  <link rel="stylesheet" href="jquery-ui/css/bootstrap.css">
  <link rel="stylesheet" href="jquery-ui/jquery-ui.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script>
    $( function() {
      $( "#from" ).datepicker();
    } );
    </script>
    <script>
        $( function() {
            $( "#to" ).datepicker();
        } );
    </script>
    <style>
        label {
            margin: 8px ;
        }
        input {
            margin: 20px 15px;
        }
        div{
            align-content: center;
        }
        .table td, .table th {
        font-size: 15px;
    }
    .btn{
  font-size: 10px;
}
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-md navbar-dark bg-dark">
        <div class="container-fluid">
            <h3 style = "color:white">Assement Form Search</h3>
        </div>
        <div class="navbar-collapse collapse w-50 order-1 dual-collapse2">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <h4 style = "color:white"><a class="nav-link" href="homepage.php">Home</a></h4>
            </li>
        </ul>
    </div>
    </nav>
<br>
<table>
  <tr>
    <td>
      <div class="input-group">
            <label class="col-sm-2 col-form-label">Assessment Number</label>
            <div class="col-sm-2">
            <input id="search" type="text" class="">
            </div>
    </div>
  </td>
  <td>
    <div class="input-group">
          <label class="col-sm-2 col-form-label">Customer Number</label>
          <div class="col-sm-2">
          <input id="search_customer_number" type="text" class="">
          </div>
  </div>
  </td>
  <td>
    <div class="input-group">
          <label class="col-sm-2 col-form-label">Customer Name</label>
          <div class="col-sm-2">
          <input id="search_customer_name" type="text" class="" style="color:white;">
          </div>
  </div>
  </td>
  </tr>
</table>


        <br>
        <br>

        <?php
        error_reporting(0);
        session_start();


if(isset($_POST['search']))
{
    include '../../includes/dbh.inc.php';
//  echo $_POST['ASSESSMENT_NUMBER'];
// // echo  $_POST['QUOTE_NUMBER'];
//  echo $_POST['QUOTE_STATUS'];
// echo $_POST['from_date'];
// echo $_POST['to_date'];
//            <?php }



    }
        ?>


<br>
<table class="table table-striped table-dark" id="searchTable">
         <tr style="color: white; " class="bg-success">
            <th>Assessment Number</th>
            <th>Customer Number</th>
            <th>Customer Name</th>
            <th colspan="2">Quote Status</th>
        </tr>

          <?php
          error_reporting(0);
          $query = "SELECT AD.ASSESSMENT_ID,
                 CUSTOMER_NUMBER,
                 CUSTOMER_NAME,
                 'Not Submitted' QUOTE_STATUS
            FROM XX_ONT_APPLICANT_DETAILS AD,
                 OE_ORDER_HEADERS_ALL OH,
                 AR_CUSTOMERS_ALL_V CUST
           WHERE     AD.ORDER_NUMBER = OH.ORDER_NUMBER
                 AND AD.ORG_ID = OH.ORG_ID
                 AND NOT EXISTS
                        (SELECT 1
                           FROM XX_QUOTE_HEADERS_ALL HA
                          WHERE AD.ASSESSMENT_ID = HA.ASSESSMENT_NUMBER)
                 AND OH.SOLD_TO_ORG_ID = CUST.CUSTOMER_ID
                 AND AD.ORG_ID = '".$_SESSION['ORG_ID']."'
                 AND OH.SHIP_FROM_ORG_ID = '".$_SESSION['ORGANIZATION_ID']."' ";

          $result= oci_parse($conn, $query);
          oci_execute($result);




                      while($row =oci_fetch_array($result,OCI_ASSOC)):

                  ?>
                  <tr>


                      <td><?php echo $row['ASSESSMENT_ID'];?></td>
                      <td><?php echo $row['CUSTOMER_NUMBER'];?></td>
                      <td><?php echo $row['CUSTOMER_NAME'];?></td>


                      <?php
                      if($row['QUOTE_STATUS'] == "PENDING"){ ?>
                          <td><?php echo "IN PROCESS"?></td>
                          <td></td>
                      <?php }
                      elseif($row['QUOTE_STATUS'] == "APPROVED" || $row['QUOTE_STATUS'] == "REJECTED"){ ?>

                          <td><?php echo $row['QUOTE_STATUS']; ?></td>
                          <td></td>
                      <?php }
                      elseif($row['QUOTE_STATUS'] == "DRAFTED"){ ?>

                          <td><?php echo $row['QUOTE_STATUS']; ?></td>
                          <td><a href="page1.php"><button type="button" class="btn btn-success">View</button></a></td>
                      <?php }
                      else{ ?>
                          <td><?php echo "Not Submitted"; ?></td>


                          <td><a href="page1.php?ASSESSMENT_NUMBER=<?php echo $row['ASSESSMENT_ID']; ?>"><button type="button" class="btn btn-success">View</button></a></td>

                      <?php } ?>
                  </tr>

                  <?php
                  endwhile;
                  ?>


        </table>

    </table>

</body>
<script>
    $(document).ready(function(){
        $("#search").on('keyup',function(){
            var ASSESSMENT_ID =  $(this).val();
            console.log(ASSESSMENT_ID);
            $.ajax({
            url: "search_assessment_number.php",
            type: "post",
            data: {ASSESSMENT_ID:ASSESSMENT_ID},
            dataType: "html",
            success: function(response){
                $("#searchTable").html(response);
            }
            });
        })
        $("#search_customer_number").on('keyup',function(){
            var Customer_Number =  $(this).val();
            console.log(Customer_Number);
            $.ajax({
            url: "search_customer_number.php",
            type: "post",
            data: {Customer_Number:Customer_Number},
            dataType: "html",
            success: function(response){
                $("#searchTable").html(response);
            }
            });
        })
        $("#search_customer_name").on('keyup',function(){
            var Customer_Name =  $(this).val();
            //console.log(Customer_Number);
            $.ajax({
            url: "search_customer_name.php",
            type: "post",
            data: {Customer_Name:Customer_Name},
            dataType: "html",
            success: function(response){
                $("#searchTable").html(response);
            }
            });
        })
    });
    </script>
</html>
<?php
}
else{
  header("Location: ../../login.php");
  exit();
}
