<?php
session_start();
$A_NAME=$_SESSION['A_NAME'];

include('connect.php');


$query2 = "SELECT * FROM XX_QUOTE_APPROVAL_LIST_ALL WHERE PERFORM_ACTIVITY_TYPE_CODE='P' AND EMPLOYEE_ID='".$A_NAME."' ORDER BY CREATION_DATE DESC";

     $result2= oci_parse($conn, $query2);
      oci_execute($result2);


if(isset($_POST['view'])){



  while($rowr =oci_fetch_array($result2,OCI_ASSOC))

  {

    if ($rowr['SEQUENCE_NO'] == 10 && $_POST["view"] != '' )
    {

    $actionsview = "UPDATE XX_QUOTE_HEADERS_ALL set NOTIFI_STATUS = 1 WHERE QUOTE_HEADER_ID='".$rowr['QUOTE_HEADER_ID']."' AND NOTIFI_STATUS = 0 ";

    $actionsview1 = oci_parse($conn,$actionsview);

    oci_execute($actionsview1);

  }

  else if ($rowr['SEQUENCE_NO'] > 10 && $_POST["view"] != '' )
  {

  $actionsview = "UPDATE actions set COMMENT_STATUS = 1 WHERE  SEQUENCE_NO < '".$rowr['SEQUENCE_NO']."'  AND QUOTE_HEADER_ID='".$rowr['QUOTE_HEADER_ID']."' AND COMMENT_STATUS = 0";

  $actionsview1 = oci_parse($conn,$actionsview);

  oci_execute($actionsview1);

  }

  else {
    echo "";
  }


  }



$query1 = "SELECT * FROM XX_QUOTE_APPROVAL_LIST_ALL WHERE PERFORM_ACTIVITY_TYPE_CODE='P' AND EMPLOYEE_ID='".$A_NAME."' ORDER BY LAST_UPDATE_DATE DESC";

     $result1= oci_parse($conn, $query1);
      oci_execute($result1);


  $output = '';


while($row1 =oci_fetch_array($result1,OCI_ASSOC)):


  $new = "SELECT * FROM XX_QUOTE_HEADERS_ALL WHERE QUOTE_HEADER_ID='".$row1['QUOTE_HEADER_ID']."'";

      $new2= oci_parse($conn, $new);
      oci_execute($new2);
      $row2 =oci_fetch_array($new2,OCI_RETURN_NULLS+OCI_ASSOC);

if ($row1['SEQUENCE_NO'] == 10 )
{
  $output .= '


  <li>

  <a href=../admin/notification/page3.php?compna='.$row2["ASSESSMENT_NUMBER"].'&compna2='.$row1["QUOTE_HEADER_ID"].'>

 <strong><em>'.$row2["ASSESSMENT_NUMBER"].'</em></strong> <?php  echo "&nbsp;&nbsp;"; ?> <br> WAITING FOR YOUR APPROVAL.

  </a>

  </li>

<br>

  ';
}

else if ($row1['SEQUENCE_NO'] > 10 )
{
  $output .= '


  <li>

  <a href=../admin/notification/page4.php?compna='.$row2["ASSESSMENT_NUMBER"].'&compna2='.$row1["QUOTE_HEADER_ID"].'>

 <strong><em>'.$row2["ASSESSMENT_NUMBER"].'</em></strong> <?php  echo "&nbsp;&nbsp;"; ?> <br> WAITING FOR YOUR APPROVAL.

  </a>

  </li>

<br>

  ';
}


else {

  $output .= '


  <li>

  No Notificantion !!!

  </li>

<br>

  ';

}

endwhile;



$status_query = "SELECT * FROM XX_QUOTE_APPROVAL_LIST_ALL WHERE PERFORM_ACTIVITY_TYPE_CODE='P' AND EMPLOYEE_ID='".$A_NAME."' ORDER BY CREATION_DATE DESC";


$result_query  = oci_parse($conn, $status_query);
oci_execute($result_query);

$count =0;

while($row =oci_fetch_array($result_query,OCI_ASSOC))

{
  if ($row['SEQUENCE_NO'] == 10)

  {

  $actions = "SELECT * FROM XX_QUOTE_HEADERS_ALL WHERE QUOTE_HEADER_ID='".$row['QUOTE_HEADER_ID']."' AND NOTIFI_STATUS = 0 ";

  $actions1 = oci_parse($conn,$actions);

  oci_execute($actions1);

  while($actions12 =oci_fetch_array($actions1,OCI_ASSOC))
  {
    $count++;
  }

}


else {

  $actions = "SELECT * FROM actions WHERE  SEQUENCE_NO < '".$row['SEQUENCE_NO']."'  AND QUOTE_HEADER_ID='".$row['QUOTE_HEADER_ID']."' AND COMMENT_STATUS = 0 ";

  $actions1 = oci_parse($conn,$actions);

  oci_execute($actions1);

  while($actions12 =oci_fetch_array($actions1,OCI_ASSOC))
  {
    $count++;
  }
}

}


$data = array(
   'notification' => $output,
   'unseen_notification'  => $count
);

echo json_encode($data);
}
?>
