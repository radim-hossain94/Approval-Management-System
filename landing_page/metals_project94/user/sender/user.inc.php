<?php

session_start();

include 'dbh.inc.php';
if(isset($_POST['view'])){


if($_POST["view"] != ''){

  // $update_query = "Update XX_QUOTE_HEADERS_ALL  SET USER_STATUS3 = 1 WHERE 
  // AND USER_STATUS3 = 0 AND CREATED_BY = '".$_SESSION['u_id']."' OR  QUOTE_STATUS = 'REJECTED'
  // AND USER_STATUS3 = 0 AND CREATED_BY = '".$_SESSION['u_id']."' ";

  $update_query = "Update XX_QUOTE_HEADERS_ALL  SET USER_STATUS1 = 1 WHERE QUOTE_STATUS = 'APPROVED' 
  AND USER_STATUS1 = 0 AND CREATED_BY = '".$_SESSION['u_id']."' OR  QUOTE_STATUS = 'REJECTED'
  AND USER_STATUS1 = 0 AND CREATED_BY = '".$_SESSION['u_id']."' ";
  //mysqli_query($con, $update_query);
  $result= oci_parse($conn, $update_query);
  oci_execute($result);

}

$query = "select * FROM XX_QUOTE_HEADERS_ALL WHERE QUOTE_STATUS = 'APPROVED' AND 
CREATED_BY = '".$_SESSION['u_id']."'
OR QUOTE_STATUS = 'REJECTED' AND CREATED_BY = '".$_SESSION['u_id']."'  ";
// $result = mysqli_query($con, $query);
$result1= oci_parse($conn, $query);
oci_execute($result1);
$output = '';
//$check = oci_num_rows($result1);
//echo $check;

// if(oci_fetch_array($result1,OCI_ASSOC)==0){
//   $output .= '
//   <li>
//    <a href="test.php">
//    <strong>No Notification</strong><br />
//    </a>
   
//    </li>
//   ';
// }


while($row = oci_fetch_array($result1,OCI_ASSOC)):

 if ($row['QUOTE_STATUS'] == "REJECTED")  {
  $output .= '
  <li>
   <a href="test.php">
   <strong>'.$row['ASSESSMENT_NUMBER'].'</strong><br />
   <small><em>'.$row['QUOTE_STATUS'].'</em></small>
   </a>
   
   </li>
  ';
 }
 elseif ($row['QUOTE_STATUS'] == "APPROVED") {
  $output .= '
  <li>
   <a href="test.php">
   <strong>'.$row['ASSESSMENT_NUMBER'].'</strong><br />
   <small><em>'.$row['QUOTE_STATUS'].'</em></small>
   </a>
   
   </li>
  ';
 }
//  elseif ($row['QS_APPROVERS3'] == "REJECTED") {
//   $output .= '
//   <li>
//    <a href="test.php">
//    <strong>'.$row['ASSESSMENT_NUMBER'].'</strong><br />
//    <small><em>'.$row['APPROVERS3'].'</em></small><br />
//    <small><em>'.$row['QUOTE_STATUS'].'</em></small>
//    </a>
   
//    </li>
//   ';
//  }
 
//  elseif ($row['QS_APPROVERS3'] == "SUPPORTED") {
//   $output .= '
//   <li>
//    <a href="test.php">
//    <strong>'.$row['ASSESSMENT_NUMBER'].'</strong><br />
//    <small><em>'.$row['APPROVERS3'].'</em></small><br />
//    <small><em>'.$row['QUOTE_STATUS'].'</em></small>
//    </a>
   
//    </li>
//   ';
//  }


endwhile;


$status_query = "Select * FROM XX_QUOTE_HEADERS_ALL WHERE USER_STATUS1 = 0 AND QUOTE_STATUS = 'APPROVED'
AND CREATED_BY = '".$_SESSION['u_id']."'
OR USER_STATUS1 = 0 AND QUOTE_STATUS = 'REJECTED'
AND CREATED_BY = '".$_SESSION['u_id']."' ";

$result_query = oci_parse($conn, $status_query);
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