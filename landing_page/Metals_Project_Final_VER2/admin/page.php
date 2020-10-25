<?php session_start();
error_reporting(0);


$id=$_SESSION['u_id'];

$A_NAME=$_SESSION['A_NAME'];


if($_SESSION['u_id']==true)

{
$QUOTE_HEADER_ID=$_POST['QUOTE_HEADER_ID'];
$ASSESSMENT_NUMBER=$_POST['ASSESSMENT_NUMBER'];

include 'connect.php';

$dynamic = "SELECT * FROM XX_QUOTE_APPROVAL_LIST_ALL WHERE PERFORM_ACTIVITY_TYPE_CODE='P' AND EMPLOYEE_ID='".$A_NAME."' AND QUOTE_HEADER_ID='".$QUOTE_HEADER_ID."'";

$dyamic1= oci_parse($conn,$dynamic);
 oci_execute($dyamic1);


while($daynamic2 =oci_fetch_array($dyamic1,OCI_ASSOC)):



 if ($daynamic2['SEQUENCE_NO'] == 10)
 {

   header("Location:notification/page3.php?QUOTE_HEADER_ID={$QUOTE_HEADER_ID}&ASSESSMENT_NUMBER={$ASSESSMENT_NUMBER}");

   exit();

  }

elseif ($daynamic2['SEQUENCE_NO'] > 10)
{

  header("Location:notification/page4.php?QUOTE_HEADER_ID={$QUOTE_HEADER_ID}&ASSESSMENT_NUMBER={$ASSESSMENT_NUMBER}");

  exit();
}


else {
  echo "NO Value";

}

endwhile;
}
else {
$Message = "Please Login First !!";
header("Location:login.php?Message={$Message}");
}
 ?>
