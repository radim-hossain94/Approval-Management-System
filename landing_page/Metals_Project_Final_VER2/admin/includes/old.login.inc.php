<?php

session_start();

if (isset($_POST['submit'])) {

  include 'dbh.inc.php';

  $uid = $_POST['uid'];
  $pwd = $_POST['pwd'];
  // $A_NAME = $_POST['A_NAME'];

  if(empty($pwd)||empty($uid))
  {

    header("Location: ../login.php");
    exit();
 }

  else
  {

    $sql="SELECT * FROM  fnd_user WHERE USER_NAME='".$uid."'";

 $result= oci_parse($conn, $sql);
 oci_execute($result);
 $row =oci_fetch_array($result,OCI_ASSOC);

 $username=$row['USER_NAME'];

 $EMPLOYEE_ID=$row['EMPLOYEE_ID'];

 $sql1="SELECT XX_DECRYPT_USER_PASS('".$username."') FROM DUAL";
 $result1= oci_parse($conn, $sql1);
 oci_execute($result1);

 while($row1=oci_fetch_array($result1,OCI_RETURN_NULLS+OCI_ASSOC)):

    foreach($row1 as $Pass);

 endwhile;



  if($uid == $username && $pwd == $Pass)
  {

      $_SESSION['u_id'] = $row['USER_NAME'];
      $_SESSION['A_NAME'] = $row['EMPLOYEE_ID'];

      header("Location:../index1.php");



      exit();

       }

    else
        {

          $Message = "Username Or Password Not Matched! <br> Please Try Again.";
          header("Location: ../login.php?Message={$Message}");
          exit();
         }

    }
    }

  else
  {

    $Message = "Login Error!";
    header("Location: ../login.php?Message={$Message}");
    exit();

  }
