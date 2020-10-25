<?php
error_reporting(0);
session_start();
$id=$_SESSION['u_id'];
$A_NAME=$_SESSION['A_NAME'];

?>

<!doctype html>
<html lang="en">
  <head>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>


    <script>var $j = jQuery.noConflict(true);</script>
     <script>
       $(document).ready(function(){
        console.log($().jquery);
        console.log($j().jquery);
       });
    </script>


    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script> -->


     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />

      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->

    <link rel="stylesheet" href="style.css">


    <title>METAL</title>

 <style>
 @media only screen and (max-width: 800px) {

  /* Force table to not be like tables anymore */
#no-more-tables table,
#no-more-tables thead,
#no-more-tables tbody,
#no-more-tables th,
#no-more-tables td,
#no-more-tables tr {
  display: block;
}

/* Hide table headers (but not display: none;, for accessibility) */
#no-more-tables thead tr {
  position: absolute;
  top: -9999px;
  left: -9999px;
}

#no-more-tables tr { border: 1px solid #ccc; }

#no-more-tables td {
  /* Behave  like a "row" */
  border: none;
  border-bottom: 1px solid #eee;
  position: relative;
  padding-left: 50%;
  white-space: normal;
  text-align:left;
}

#no-more-tables td:before {
  /* Now like a table header */
  position: absolute;
  /* Top/left values mimic padding */
  top: 6px;
  left: 6px;
  width: 45%;
  padding-right: 10px;
  white-space: nowrap;
  text-align:left;
  font-weight: bold;
}

/*
Label the data
*/
#no-more-tables td:before { content: attr(data-title); }
}

/* ul.dropdown-menu
{

} */

 </style>


  </head>


  <body>

    <?php  if($_SESSION['u_id']==true)

     {
   include 'includes/dbh.inc.php';

       class EMPLOYEE_ID {

       public $EMPLOYEE_ID;

       var $conn;
 // database connenction rony
    function __construct(){

      $this->db = "(DESCRIPTION=(ADDRESS_LIST = (ADDRESS = (PROTOCOL = TCP)(HOST = 27.147.134.3)(PORT = 1542)))(CONNECT_DATA=(Service_Name=TEST2)))" ;

        $this->$conn = OCILogon('APPS', 'ProdMet56', $this->db);

      }


       public function set_id($EMPLOYEE_ID) {
            $this->$EMPLOYEE_ID = $EMPLOYEE_ID;
          }

       function get_id($A_NAME)
       {
         $Idfull=$this->$A_NAME;

         $name = " SELECT PAPF.PERSON_ID,
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
         and papf.person_id ='".$Idfull."'";

         $fullname= oci_parse($this->$conn, $name);
          oci_execute($fullname);
          $fullname1 = oci_fetch_array($fullname,OCI_ASSOC);

         $Fullname23=$fullname1['FULL_NAME'];

       return  $Fullname23; }

       }
       $EMPLOYEE_IDA=new EMPLOYEE_ID();

       $EMPLOYEE_IDA->set_id($A_NAME);

       ?>


   <div class="wrapper">
   	<nav id="sidebar">
   		<div class="sidebar-header">
   			<h3> WELCOME <br><br> <?php echo $EMPLOYEE_IDA->get_id($A_NAME); ?></h3>
   		</div>


   		<!-- <ul class="list-unstyled components">

   					<li>
   						<a href="#">PAGE1</a>
   					</li>
   					<li>
   						<a href="#">PAGE2</a>
   					</li>
   					<li>
   						<a href="#">PAGE3</a>
   					</li>
   				</ul> -->



   		<ul class="list-unstyled CTAs">
   			<li>
   			  <form style=" margin-top:180px;" action="includes/logout.inc.php"  method="post">


                <button type="submit" name="submit" class="btn btn-danger center-block">LOGOUT</button>

          </form>

   			</li>
   		</ul>
   	</nav>

   	<div class="content">

   		<nav class="navbar navbar-expand-lg navbar-light bg-light">

   		<button type="button" id="sidebarCollapse" class="btn btn-info">
   			<i class="fa fa-align-justify"></i> <span>toggle sidebar</span>


   		</button>
      <output style="float:right;color:blue;" ><strong style="color:black;">USER ID:</strong> <?php echo $_SESSION['u_id']; echo "&nbsp;";echo "&nbsp;";?></output>


  <script>

  $(document).ready(function(){

  // updating the view with notifications using ajax
  //New page start

  setInterval(function(){

// // Auto Refresh Blincking Off (STOP Flickering)
//
//     if(json.status ==  "ACTIVE" && $('#ajaxStatus').html() !== "ACTIVE")
//     {
//         $('#ajaxStatus').html(jason.status);
//     }
//
// // end
// $( '#ajaxStatus' ).replaceWith( jason.status );


  load_unseen_notification();;

}, 1000);

  function load_unseen_notification(view = '')

  {

   $.ajax({

    url:"fetch.php",
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

  //new page

  $(document).on('click', '.dropdown-toggle', function(){

  $('.count').html('');

  load_unseen_notification('yes');

  });


  $('#actions').on('submit', function(event){
   event.preventDefault();

   if($('#DP_AMOUNT').val() != '' && $('#DISCOUNT_VALUE').val() != ''  && $('#NO_OF_INSTALLMENT').val() != ''
   && $('#NO_OF_FREE_INSTALLMENT').val() != '' && $('#REMARKS').val() != '' && $('#NAME').val() != '' )

   {

    var form_data = $("form").serialize();

    $.ajax({

     url:"insert.php",
     method:"POST",
     data:form_data,
     success:function(data)

     {

     }

    });

   }

   else

   {
    alert(" Fields are Required");
   }

  });

  });

  </script>


<br>
<br>
<nav class="navbar navbar-inverse ">

<div class="container-fluid ">

    <div class="navbar-header ">

     <a class="navbar-brand" href="#">NOTIFICATION BAR</a>

   </div>

<ul class="nav navbar-nav navbar-right">

   <li class="dropdown">

     <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="label label-pill label-danger count" style="border-radius:10px;"></span> <span class="glyphicon glyphicon-bell" style="font-size:18px;"></span></a>

   <ul class="dropdown-menu"></ul>

   </li>

  </ul>

</div>

</nav>

<?php if( !empty( $_REQUEST['Message'] ) )
{
?>
  <div class="alert alert-success">
  <strong>Success!</strong> <?php echo sprintf($_REQUEST['Message']) ?>
 </div>

<?php
}

 if( !empty( $_REQUEST['reject'] ) )
{
?>
  <div class="alert alert-danger">
   <?php  echo sprintf($_REQUEST['reject']) ?>
 </div>
<?php

} ?>

<div id="no-more-tables">


<table class="col-md-12 table-bordered table-striped table-condensed cf" >
  <thead class="cf">

<!-- for getting max screen width -->
   <col width="800px">
    <col width="1300px">
      <col width="800px">
      <col width="700px">

       <col width="1500px">
        <col width="1500px">
         <!-- <col width="600px"> -->
          <col width="1500px">
          <col width="800px">


         <tr>
           <th  height="45px" scope="col">Assessment Number</th>
           <th  height="45px" scope="col">Quote Number</th>
           <th  height="45px" scope="col">Quote Name</th>
           <th  height="45px" scope="col">Quote Date</th>
           <th  height="45px" scope="col">Customer Name</th>
           <th  height="45px" scope="col">Created By</th>
           <!-- <th  height="45px" scope="col">CREATION DATE</th> -->
           <th  height="45px" scope="col">Last Updated By</th>
           <th  height="45px" scope="col">Quote Status</th>
         </tr>
       </thead>
  <tbody>

<?php


   // $query = "SELECT * FROM  XX_QUOTE_HEADERS_ALL QH ,XX_QUOTE_APPROVAL_LIST_ALL AL WHERE QH.QUOTE_HEADER_ID=AL.QUOTE_HEADER_ID AND AL.PERFORM_ACTIVITY_TYPE_CODE='P' AND AL.EMPLOYEE_ID='".$A_NAME."'";


       $query = "SELECT * FROM XX_QUOTE_APPROVAL_LIST_ALL WHERE PERFORM_ACTIVITY_TYPE_CODE='P' AND EMPLOYEE_ID='".$A_NAME."' ORDER BY LAST_UPDATE_DATE DESC";

       $result1= oci_parse($conn, $query);
        oci_execute($result1);


  while($row1 =oci_fetch_array($result1,OCI_RETURN_NULLS+OCI_ASSOC)):

// Created by
          $created_by_query = "SELECT * FROM XX_QUOTE_APPROVAL_LIST_ALL WHERE QUOTE_HEADER_ID='".$row1['QUOTE_HEADER_ID']."' ORDER BY SEQUENCE_NO ASC";
          $created_by_query1= oci_parse($conn, $created_by_query);
          oci_execute($created_by_query1);
          $created_by_query12 =oci_fetch_array($created_by_query1,OCI_RETURN_NULLS+OCI_ASSOC);
// END Created by


          $query1 = "SELECT * FROM XX_QUOTE_HEADERS_ALL WHERE QUOTE_HEADER_ID='".$row1['QUOTE_HEADER_ID']."'";

              $result2= oci_parse($conn, $query1);
              oci_execute($result2);
              $row2 =oci_fetch_array($result2,OCI_RETURN_NULLS+OCI_ASSOC);

        $customer_name="SELECT APPLICANT_NAME FROM XX_ONT_APPLICANT_DETAILS WHERE ASSESSMENT_ID ='".$row2['ASSESSMENT_NUMBER']."'";
             $customer_name1=oci_parse($conn,$customer_name);
             oci_execute( $customer_name1);
             $row3=oci_fetch_array($customer_name1,OCI_RETURN_NULLS+OCI_ASSOC);

           $Created_by=$created_by_query12['CREATED_BY'];
           $Updated_by=$row1['LAST_UPDATED_BY'];

           $EMPLOYEE_IDA1=new EMPLOYEE_ID();
           $EMPLOYEE_IDA1->set_id($Created_by);

           $EMPLOYEE_IDA2=new EMPLOYEE_ID();
           $EMPLOYEE_IDA2->set_id($Updated_by);
      ?>

      <tr>
        <td height="60px"><?php echo $row2['ASSESSMENT_NUMBER'];?></td>
        <td height="60px"><?php echo $row2['QUOTE_NUMBER'];?></td>
        <td height="60px"><?php echo $row2['QUOTE_NAME'];?></td>
        <td height="60px"><?php echo $row2['QUOTE_DATE'];?></td>

        <td height="60px"><?php echo $row3['APPLICANT_NAME'];?></td>


        <!-- can do -->
      <td height="60px"><?php echo  $EMPLOYEE_IDA1->get_id($Created_by);?></td>

        <!-- //need change -->
        <!-- <td height="60px"><?php echo $row2['CREATED_BY']; ?></td> -->


        <!-- <td height="60px"><?php echo $row1['CREATION_DATE'];?></td> -->


        <td height="60px"><?php echo $EMPLOYEE_IDA2->get_id($Updated_by);?></td>


        <td height="60px">In Process</td>

        <form class="" action="page.php" method="post">
          <?php   $QUOTE_HEADER_ID=$row1['QUOTE_HEADER_ID'];  ?>
          <?php   $ASSESSMENT_NUMBER=$row2['ASSESSMENT_NUMBER'];  ?>
         <input type="hidden" name="QUOTE_HEADER_ID" value="<?php echo $QUOTE_HEADER_ID ?>">
         <input type="hidden" name="ASSESSMENT_NUMBER" value="<?php echo $ASSESSMENT_NUMBER ?>">
      <td style="width:200px;" ><button type="submit" name="search1" style="width:100px;" class="btn btn-primary "> VIEW </button> </td>
        </form>

      </tr>

  <?php endwhile;?>

  </tbody>
</table>

</div>
   	</div>





   </div>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->

    <script>
	    $(document).ready(function(){
			$('#sidebarCollapse').on('click',function(){
				$('#sidebar').toggleClass('active');
			});
		});
	 </script>





  </body>
</html>

<?php
}
else {
  $Message = "Please Login First !!";
  header("Location:login.php?Message={$Message}");
}
 ?>
