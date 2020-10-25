<?php
include '../../includes/dbh.inc.php';
// error_reporting(E_ERROR | E_WARNING | E_PARSE);
session_start();

unset($_SESSION["P_QUOTE_HEADER_ID"]);
unset($_SESSION["REGISTRATION_AMOUNT"]);
unset($_SESSION["interest_amount_field"]);
unset($_SESSION["monthly_installment_field"]);
unset($_SESSION["total_session_field"]);

unset($_SESSION["TOTAL"]);
unset($_SESSION["MONTHLY_INSTALLMENT_AMOUNT"]);
unset($_SESSION["INTEREST_AMOUNT"]);

unset($_SESSION["DP_PERCENT"]);
unset($_SESSION["ACTUAL_DP_AMOUNT"]);

unset($_SESSION["ACTUAL_DP_AMOUNT_SESSION_FIELD"]);
unset($_SESSION["DP_PERCENT_SESSION_FIELD"]);

unset($_SESSION['TEST_DP_PERCENT']);
unset($_SESSION['TEST_ACTUAL_DP_AMOUNT']);

$query_USER_ID = "Select EMPLOYEE_ID from FND_USER where USER_NAME = '".$_SESSION['u_id']."' ";

  $result4 = oci_parse($conn, $query_USER_ID);
  oci_execute($result4);

  $ROW = oci_fetch_array($result4,OCI_ASSOC);
  $_SESSION["USER_ID"] =  $ROW["EMPLOYEE_ID"];

if (isset($_SESSION['u_id'])) { ?>



<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
  <title>Side Navigation Bar</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <!-- <link rel="stylesheet" href="jquery-ui/css/bootstrap.css">
    <link rel="stylesheet" href="../../assets/css/styles.css"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<!-- <script src="https://kit.fontawesome.com/b99e675b6e.js"></script> -->
</head>
<style>
    body {
  font-family: "Lato", sans-serif;
}


    .table td, .table th {
        font-size: 15px;
    }

    label {
            margin: 5px ;
            font-size: 15px;
        }
        input {
            margin: 10px 40px;
            width :150px;
        }
        select {
          margin: 10px 40px;
        }

/* Fixed sidenav, full height */
.sidenav {
  height: 100%;
  width: 200px;
  position: fixed;
  z-index: 1;
  top: 0;
  left: 0;
  background-color: #111;
  overflow-x: hidden;
  padding-top: 20px;
}

/* Style the sidenav links and the dropdown button */
.sidenav a, .dropdown-btn {
  padding: 6px 8px 6px 16px;
  text-decoration: none;
  font-size: 20px;
  color: #818181;
  display: block;
  border: none;
  background: none;
  width: 100%;
  text-align: left;
  cursor: pointer;
  outline: none;
}

.btn{
  font-size: 10px;
}
/* On mouse-over */
.sidenav a:hover, .dropdown-btn:hover {
  color: #f1f1f1;
}

/* Main content */
.main {
  margin-left: 200px; /* Same as the width of the sidenav */
  font-size: 20px; /* Increased text to enable scrolling */
  padding: 0px 10px;
}

/* Add an active class to the active dropdown button */
.active {
  background-color: green;
  color: white;
}

/* Dropdown container (hidden by default). Optional: add a lighter background color and some left padding to change the design of the dropdown content */
.dropdown-container {
  display: none;
  background-color: #262626;
  padding-left: 8px;
}

/* Optional: Style the caret down icon */
.fa-caret-down {
  float: right;
  padding-right: 8px;
}

/* Some media queries for responsiveness */
@media screen and (max-height: 450px) {
  .sidenav {padding-top: 15px;}
  .sidenav a {font-size: 18px;}
}
</style>
<body>


<script>
  $(document).ready(function(){

    setInterval(function(){

load_unseen_notification();;

}, 2000);



function load_unseen_notification(view = '')

{

 $.ajax({

  url:"user.inc.php",
  method:"Post",
  data:{view:view},
  dataType:"json",
  success:function(data)

  {

   $('.dropdown-menu').html(data.notification);

   if(data.unseen_notification > 0)
   {
    $('.count').html(data.unseen_notification);
   }

  }

 });

}


$(document).on('click', '.dropdown-toggle', function(){

$('.count').html('');

load_unseen_notification('yes');

});

});

$(document).ready(function(){
        $("#search_assessment_number").on('keyup',function(){
            var ASSESSMENT_NUMBER =  $(this).val();
            console.log(ASSESSMENT_NUMBER);
            $.ajax({
            url: "assessment_number_homepage_search.php",
            type: "post",
            data: {ASSESSMENT_NUMBER:ASSESSMENT_NUMBER},
            dataType: "html",
            success: function(response){
                $("#searchTable").html(response);
            }
            });
        });

        $("#search_quote_number").on('keyup',function(){
            var QUOTE_NUMBER =  $(this).val();
            console.log(QUOTE_NUMBER);
            $.ajax({
            url: "quote_number_homepage_search.php",
            type: "post",
            data: {QUOTE_NUMBER:QUOTE_NUMBER},
            dataType: "html",
            success: function(response){
                $("#searchTable").html(response);
            }
            });
        });

        $("#search_quote_name").on('keyup',function(){
            var QUOTE_NAME =  $(this).val();
            console.log(QUOTE_NAME);
            $.ajax({
            url: "quote_name_homepage_search.php",
            type: "post",
            data: {QUOTE_NAME:QUOTE_NAME},
            dataType: "html",
            success: function(response){
                $("#searchTable").html(response);
            }
            });
        });


        $("#quote_status").on('change',function(){

          var quote_status =  $(this).val();

          console.log(quote_status);
          $.ajax({    //create an ajax request to display.php
          url: "quote_status_homepage_search.php",
          type: "post",
          data: {quote_status:quote_status},
          dataType: "html",   //expect html to be returned
        success: function(r){
            $("#searchTable").html(r);

            }

  });


})
    });

  </script>


 <!-- <div  class="container"> -->

  <nav style="margin: -1px 0px;" class="navbar navbar-inverse">

   <div  class="container-fluid">

   <div  class="navbar-header">

    <h1  class="navbar-brand" style="color:white;  margin: 5px 180px">Welcome <?php echo $_SESSION['u_id'];?></h1>

    </div>
    <ul class="nav navbar-nav navbar-right">

     <li class="dropdown">

      <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="label label-pill label-danger count" style="border-radius:10px;"></span> <span class="glyphicon glyphicon-bell" style="font-size:18px; "></span></a>

      <ul class="dropdown-menu" ></ul>



     </li>
    </ul>

   </div>

  </nav>




<br>
<br>
<div class="sidenav">
    <h3 style = "color:white; margin: -1px 10px; padding:-10px">Responsibilties</h3>
    <br>

  <button class="dropdown-btn">Task List
    <i class="fa fa-caret-down"></i>
  </button>
  <div class="dropdown-container">
    <a href="homepage.php">Homepage</a>
    <a href="assessment.php"> Search Assessment </a>
    <a href="Saved_Assessment_Form.php">Search Quote</a>


    <a href="#"><form action="../../../Metals_Project_Final_VER2/admin/includes/logout.inc.php" method = "post">
  <input style="margin : 20px; width:100px;" type="submit" name="submit" class="btn btn-danger" value="Logout">
  </form></a>

  </div>

</div>





<div class="main">

  <h2 style = "margin: 10px; padding:-10px; color:Red; ">Notification Information</h2>

  <br>
  <p>




  </p>
  <!-- <p>Click on the dropdown button to open the dropdown menu inside the side navigation.</p>
  <p>This sidebar is of full height (100%) and always shown.</p>
  <p>Some random text..</p> -->
  <table id="searchTable"  class="table table-striped table-dark" width="40%">
         <tr>
            <!-- <th>ASSESSMENT NUMBER</th>

            <th>APPLICANT NAME</th>
            <th>QUOTE NUMBER</th>
            <th>QUOTE NAME</th>
            <th>QUOTE DATE</th>
            <th colspan="2">QUOTE STATUS</th> -->

        </tr>
  <?php


  $sql = "select HA.ASSESSMENT_NUMBER,
  EMPLOYEE_ID,
  QA.LAST_UPDATE_DATE,
  HA.QUOTE_STATUS
  from
  XX_QUOTE_APPROVAL_LIST_ALL QA
  INNER JOIN
  XX_QUOTE_HEADERS_ALL HA ON
  QA.QUOTE_HEADER_ID = HA.QUOTE_HEADER_ID
  WHERE HA.CREATED_BY = '".$_SESSION['u_id']."' AND QUOTE_STATUS= 'APPROVED' AND PERFORM_ACTIVITY_TYPE_CODE = 'A' OR
  HA.CREATED_BY = '".$_SESSION['u_id']."' AND QUOTE_STATUS= 'REJECTED' AND PERFORM_ACTIVITY_TYPE_CODE = 'R' order by QA.LAST_UPDATE_DATE DESC ";
            $result1= oci_parse($conn, $sql);
            oci_execute($result1);
            while($row1 =oci_fetch_array($result1,OCI_ASSOC)):

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
              and papf.person_id ='".$row1['EMPLOYEE_ID']."'";

        $Employee_name_result= oci_parse($conn,$sql_find_name);
        oci_execute($Employee_name_result);

        $employee_name = oci_fetch_array($Employee_name_result,OCI_ASSOC);
  ?>
<tr  style="color: black; " class="bg-success">
  <td><?php echo "Assessment Number"; ?></td>
  <td><?php echo $row1['ASSESSMENT_NUMBER']; ?></td>
  <td><?php echo "is  "; ?></td>
  <td><?php if($row1['QUOTE_STATUS']=="APPROVED") {echo "Approved";}
  elseif ($row1['QUOTE_STATUS']=="REJECTED") {
    echo "Rejected";
  }
  else{
    echo "";
  }
   ?></td>
  <td><?php echo " by "; ?></td>
  <td><?php echo $employee_name['FULL_NAME']; ?></td>
  <td><?php echo " on "; ?></td>
  <td><?php echo $row1['LAST_UPDATE_DATE']; ?></td>
  <td> <a href="view_track_form.php?ASSESSMENT_NUMBER=<?php echo $row1['ASSESSMENT_NUMBER'];  ?>"><button type="submit" class="btn btn-primary">Show Status</button></a> </td>



</tr>



            <?php endwhile; ?>
      </table>
</div>

<script>
/* Loop through all dropdown buttons to toggle between hiding and showing its dropdown content - This allows the user to have multiple dropdowns without any conflict */
var dropdown = document.getElementsByClassName("dropdown-btn");
var i;

for (i = 0; i < dropdown.length; i++) {
  dropdown[i].addEventListener("click", function() {
  this.classList.toggle("active");
  var dropdownContent = this.nextElementSibling;
  if (dropdownContent.style.display === "block") {
  dropdownContent.style.display = "none";
  } else {
  dropdownContent.style.display = "block";
  }
  });
}
</script>
</body>
</html>

<?php
}
else{
  header("Location: ../../login.php");
  exit();
}
