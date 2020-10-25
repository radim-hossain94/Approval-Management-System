<?php
session_start();
$id=$_SESSION['u_id'];
$A_NAME=$_SESSION['A_NAME'];
$QUOTE_HEADER_ID=$_POST['QUOTE_HEADER_ID'];


if(isset($_POST["submit"]))

{
include 'connect.php';

$QUOTE_HEADER_ID=  $_POST['QUOTE_HEADER_ID'];
$NAME =  $_POST['NAME'];
$REMARKS = $_POST['REMARKS'];

$query = "INSERT INTO ACTIONS (NAME,REMARKS,QUOTE_HEADER_ID,U_DATE) VALUES ( :NAME, :REMARKS, :QUOTE_HEADER_ID, sysdate)";

$result= oci_parse($conn, $query);

oci_bind_by_name($result, ":REMARKS", $REMARKS);
oci_bind_by_name($result, ":QUOTE_HEADER_ID", $QUOTE_HEADER_ID);
oci_bind_by_name($result, ":NAME", $NAME);
oci_execute($result);



 $sql = "UPDATE XX_QUOTE_APPROVAL_LIST_ALL  SET PERFORM_ACTIVITY_TYPE_CODE = 'R',CURRENT_RECORD_FLAG='N', LAST_UPDATED_BY='".$NAME."',LAST_UPDATE_DATE=sysdate WHERE QUOTE_HEADER_ID = '".$QUOTE_HEADER_ID."' AND EMPLOYEE_ID= '$A_NAME'";

  $result1= oci_parse($conn, $sql);
  oci_execute($result1);

  $userstatus = "UPDATE XX_QUOTE_HEADERS_ALL SET USER_STATUS1=0,QUOTE_STATUS='REJECTED' WHERE QUOTE_HEADER_ID = '".$QUOTE_HEADER_ID."'";
  $userstatus1= oci_parse($conn, $userstatus);
  oci_execute($userstatus1);

  $msg="SELECT * FROM XX_QUOTE_HEADERS_ALL WHERE QUOTE_HEADER_ID= '".$QUOTE_HEADER_ID."' ";
  $msgs= oci_parse($conn,$msg);
  oci_execute($msgs);
  $msgsuccess=oci_fetch_array($msgs,OCI_ASSOC);
  $msge=$msgsuccess['ASSESSMENT_NUMBER'];
  $Message = "You Just Rejected <strong>$msge</strong>";
  header("Location: ../index1.php?reject={$Message}");
  exit();

}

 ?>
