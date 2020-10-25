<?php

session_start();
include 'dbh.inc.php';
//echo "string";
 if(isset($_POST['view'])){

 if($_POST["view"] != '')

 {
   $update_query = " UPDATE XX_QUOTE_HEADERS_ALL2  SET NOTIFI_STATUS = 1 WHERE NOTIFI_STATUS = 0 AND APPROVERS1 = '".$_SESSION['A_NAME']."' ";
   //mysqli_query($con, $update_query);
   $result= oci_parse($conn, $update_query);
   oci_execute($result);
 }

$query = "SELECT * FROM XX_QUOTE_HEADERS_ALL2 WHERE APPROVERS1 = '".$_SESSION['A_NAME']."' ";
// $result = mysqli_query($con, $query);
$result1= oci_parse($conn, $query);
oci_execute($result1);
$output = '';
//$check = oci_num_rows($result1);
//echo $check;


if(oci_fetch_array($result1,OCI_ASSOC) > 0)
{

while($row = oci_fetch_array($result1,OCI_ASSOC)){
  
  $output .= '
  <style>
  .table-noti
    {
    border-collapse:separate;
    border-spacing:20px 0px;
    }
  </style>
  <table class="table-noti">
  <tr>
  <td> <font size="2"> <b>'.$row["ASSESSMENT_NUMBER"].'</b> </font></td>
  <td> <font size="1">  '.$row["CUSTOMER_ID"].' </font></td>
  <td> <font size="1">  '.$row["QUOTE_STATUS"].' </font></td>
  <td> <font size="1">  '.$row["QUOTE_NAME"].' </font></td>
  </tr>
  </table>
  ';
}

}

else{
    $output .= '<li><a href="#" class="text-bold text-italic">No Noti Found</a></li>';
}

$status_query = "SELECT * FROM XX_QUOTE_HEADERS_ALL2 WHERE NOTIFI_STATUS = 0 AND APPROVERS1 = '".$_SESSION['A_NAME']."'";
//$result_query = mysqli_query($con, $status_query);
$result_query = oci_parse($conn, $status_query);
// $count = mysqli_num_rows($result_query);
oci_execute($result_query);
$count = 0;

while(oci_fetch_array($result_query,OCI_ASSOC)){
  $count = $count + 1;
}

$data = array(
   'notification' => $output,
   'unseen_notification'  => $count
);

echo json_encode($data);
}
?>
