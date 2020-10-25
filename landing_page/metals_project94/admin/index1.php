<?php
session_start();

if (isset($_SESSION['A_NAME'])) {


?>


<!DOCTYPE html>

<html>

<head>

 <title>Notification using PHP Ajax Bootstrap</title>

 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>

 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />

 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<style>
.dropdown-menu {
    min-width:520px;
    
}
<style>
    body {
  font-family: "Lato", sans-serif;
}
ul {
  list-style-type: none;
  margin: 10;
  padding: 110;
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



</head>


<body>

  <script>
  $(document).ready(function(){

    setInterval(function(){

load_unseen_notification();;

}, 5000);



function load_unseen_notification(view = '')

{

 $.ajax({

  url:"admin.inc.php",
  method:"Post",
  data:{view:view},
  dataType:"json",
  success:function(data)

  {

   $('.dropdown-menu').html(data.notification);

   if(data.unseen_notification >= 0)
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


  </script>


 <!-- <div  class="container"> -->

  <nav style="padding: 8px;" class="navbar navbar-inverse">

   <div  class="container-fluid">

    <div  class="navbar-header">

     <!-- <a  class="navbar-brand" href="#">PHP Notification Tutorial</a> -->

    </div>

    <ul class="nav navbar-nav navbar-right">

     <li class="dropdown">

      <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="label label-pill label-danger count" style="border-radius:10px;"></span> <span class="glyphicon glyphicon-bell" style="font-size:18px;"></span></a>

      <ul class="dropdown-menu" ></ul>
      

     </li>
    </ul>
    <ul>
      <ul><form action="logout.php" method = "post">
  <input style="margin: 1px -60px;" type="submit" name="logout" value="Logout" class="btn btn-primary">
  </form></ul>
    </ul>

   </div>
   
  </nav>
  <!-- </div> -->

  <br />
  
  <div class="main">
  <h2 style = "margin: 10px; padding:-10px">Submitted Assessment Form</h2>
  
  <!-- <p>Click on the dropdown button to open the dropdown menu inside the side navigation.</p>
  <p>This sidebar is of full height (100%) and always shown.</p>
  <p>Some random text..</p> -->
  <table align="center" class="table table-striped table-dark">
         <tr>
            <th>ASSESSMENT NUMBER</th>
            <th>CUSTOMER ID</th>
            <th>APPLICANT NAME</th>
            <th>SUBMITTED BY</th>
            <th></th>
            
        </tr>
  <?php
  include 'dbh.inc.php';

  $sql = "select HA.ASSESSMENT_NUMBER,
  CUSTOMER_ID,
  APPLICANT_NAME,
  USERS.USER_UID
  from 
  XX_ONT_APPLICANT_DETAILS AD
  INNER JOIN
  XX_QUOTE_HEADERS_ALL2 HA ON
  AD.ASSESSMENT_ID = HA.ASSESSMENT_NUMBER
  INNER JOIN
  ADMIN ON
  HA.APPROVERS1 =  ADMIN.A_NAME
  INNER JOIN
  USERS ON
  HA.ASSESSMENT_NUMBER =  USERS.ASSESSMENT_NUMBER
  WHERE A_NAME = '".$_SESSION['A_NAME']."' ";
            $result1= oci_parse($conn, $sql);
            oci_execute($result1);
            while($row1 =oci_fetch_array($result1,OCI_ASSOC)):
  ?>
  

        <tr>
        
            <td><?php echo $row1['ASSESSMENT_NUMBER']; ?></td>
            <td><?php echo $row1['CUSTOMER_ID'];?></td>
            <td><?php echo $row1['APPLICANT_NAME'];?></td>
            <td><?php echo $row1['USER_UID'];?></td>
            <form class="" action="#" method="post">
       <?php   $ASSESSMENT_NUMBER=$row1['ASSESSMENT_NUMBER'];  ?>
      <input type="hidden" name="ASSESSMENT_NUMBER" value="<?php echo $ASSESSMENT_NUMBER ?>">
      <td style="width:200px;" ><button type="submit" name="search1" style="width:100px;" class="btn btn-primary "> VIEW </button> </td>
        </form>
            <!--  -->
           
        </tr>
            <?php endwhile; ?>
      </table>
      
</div>

 

</body>

</html>

<?php } ?>