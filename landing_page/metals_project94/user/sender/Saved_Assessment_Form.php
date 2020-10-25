<?php
include '../../includes/dbh.inc.php';
// error_reporting(E_ERROR | E_WARNING | E_PARSE);
session_start();


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

  <h2 style = "margin: 10px; padding:-10px">Quote Information</h2>

  <br>
  <p>
  <table>
  <tr>
  <td>
  <div class="input-group">
            <label class="col-sm-2 col-form-label">Assessment Number</label>
            <div class="col-sm-2">
            <input id="search_assessment_number" type="text" class="input-group-text">
  </div>
    </div>
    </td>
  <td>
  <div class="input-group">
            <label class="col-sm-2 col-form-label">Quote Number</label>
            <div class="col-sm-2">
            <input id="search_quote_number" type="text" class="input-group-text">
            </div>
    </div>
  </td>
  <td>
  <div class="input-group">
            <label class="col-sm-2 col-form-label">Quote Name</label>
            <div class="col-sm-2">
            <input id="search_quote_name" type="text" class="input-group-text">
            </div>
    </div>
  </td>
  <td>
  <div class="input-group">
            <label class="col-sm-2 col-form-label">Quote Status</label>
            <div class="col-sm-2">
            <select  id="quote_status">
            <option value="">Select</option>
            <option value="APPROVED">Approved</option>
            <option value="PENDING">In process</option>
            <option value="REJECTED">Rejected</option>
            <option value="DRAFT">Draft</option>
            </select>
            </div>
    </div>

  </td>
  </tr>
  </table>



  </p>
  <!-- <p>Click on the dropdown button to open the dropdown menu inside the side navigation.</p>
  <p>This sidebar is of full height (100%) and always shown.</p>
  <p>Some random text..</p> -->
  <table id="searchTable"  class="table table-striped table-dark">
         <tr>
            <th>ASSESSMENT NUMBER</th>

            <th>APPLICANT NAME</th>
            <th>QUOTE NUMBER</th>
            <th>QUOTE NAME</th>
            <th>QUOTE DATE</th>
            <th colspan="2">QUOTE STATUS</th>

        </tr>
  <?php


  $sql = "select HA.ASSESSMENT_NUMBER,
  CUSTOMER_ID,
  APPLICANT_NAME,
  QUOTE_NUMBER,
  QUOTE_NAME,
  QUOTE_DATE,
  QUOTE_STATUS
  from
  XX_ONT_APPLICANT_DETAILS AD
  INNER JOIN
  XX_QUOTE_HEADERS_ALL HA ON
  AD.ASSESSMENT_ID = HA.ASSESSMENT_NUMBER
  WHERE HA.CREATED_BY = '".$_SESSION['u_id']."' AND QUOTE_STATUS= 'APPROVED' OR
  HA.CREATED_BY = '".$_SESSION['u_id']."' AND QUOTE_STATUS= 'REJECTED' OR
    HA.CREATED_BY = '".$_SESSION['u_id']."' AND QUOTE_STATUS= 'DRAFT' OR
  HA.CREATED_BY = '".$_SESSION['u_id']."' AND QUOTE_STATUS = 'PENDING' order by HA.quote_date DESC ";
            $result1= oci_parse($conn, $sql);
            oci_execute($result1);
            while($row1 =oci_fetch_array($result1,OCI_ASSOC)):
  ?>


        <tr>

            <td><?php echo $row1['ASSESSMENT_NUMBER'];?></td>

            <td><?php echo $row1['APPLICANT_NAME'];?></td>
            <td><?php echo $row1['QUOTE_NUMBER'];?></td>
            <td><?php echo $row1['QUOTE_NAME'];?></td>
            <td><?php echo $row1['QUOTE_DATE'];?></td>
            <td><?php if ($row1['QUOTE_STATUS']=="PENDING") {
              echo "In Process";

            }
            else {
              echo $row1['QUOTE_STATUS'];
              } ?></td>
            <?php if($row1['QUOTE_STATUS']=="PENDING"){ ?>
              <form action="view_track_form.php" method="post">
        <input type="hidden" name="ASSESSMENT_NUMBER" value="<?php $ASSESSMENT_NUMBER = $row1['ASSESSMENT_NUMBER']; echo $ASSESSMENT_NUMBER;  ?>">
        <td><button type="submit" class="btn btn-success">Show Status</button></td>
        </form>
            <?php } ?>
            <?php if($row1['QUOTE_STATUS']=="APPROVED") {?>
            <form action="placeorder.php" method="post">
            <input type="hidden" name="ASSESSMENT_NUMBER" value="<?php $ASSESSMENT_NUMBER = $row1['ASSESSMENT_NUMBER']; echo $ASSESSMENT_NUMBER;  ?>">
            <td><button type="submit" class="btn btn-success">View</button></td>
            </form>
          <?php } ?>
            <?php if($row1['QUOTE_STATUS']=="DRAFT") {?>
            <form action="preview_saved.php" method="post">
            <input type="hidden" name="ASSESSMENT_NUMBER" value="<?php $ASSESSMENT_NUMBER = $row1['ASSESSMENT_NUMBER']; echo $ASSESSMENT_NUMBER;  ?>">
            <td><button type="submit" class="btn btn-success">View Saved Assessment Form</button></td>
            </form>
            <?php }
            elseif($row1['QUOTE_STATUS']=="REJECTED"){?>
            <form action="#" method="post">
            <input type="hidden" name="ASSESSMENT_NUMBER" value="<?php $ASSESSMENT_NUMBER = $row1['ASSESSMENT_NUMBER']; echo $ASSESSMENT_NUMBER;  ?>">
            <td><button type="submit" class="btn btn-danger">Under development</button></td>
            </form>
          <?php  } ?>

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
