<?php

session_start();

if (isset($_POST['submit'])) {

  include 'dbh.inc.php';

  $uid = $_POST['uid'];
  $pwd = $_POST['pwd'];

  if(empty($uid)||empty($pwd))
  {
    header("Location: ../login.php?login=empty");
    exit();
 }

  else
  {
    $sql ="SELECT * FROM USERS,XX_USER_VS_ORG WHERE XX_USER_VS_ORG.USER_ID = USERS.USER_ID AND USER_UID='$uid' AND USER_PWD='$pwd'";
    $result= oci_parse($conn, $sql);
    oci_execute($result);

    $resultCheck = oci_fetch_array($result,OCI_ASSOC);

    if($resultCheck < 1)
    {
      $sql1 = "SELECT * FROM admin WHERE A_NAME ='$uid' AND USER_PWD='$pwd'";
      $result1= oci_parse($conn, $sql1);
      oci_execute($result1);

      $resultCheck1 = oci_fetch_array($result1,OCI_ASSOC);

      if($resultCheck1 < 1){
        header("Location: ../login.php?login=not_matched");
        exit();
      }
      else{

        $adminpass = $resultCheck1['USER_PWD'];
        
        if($pwd == $adminpass){
          // $_SESSION['u_id'] = $resultCheck['USER_UID'];
          $_SESSION['A_NAME'] = $resultCheck1['A_NAME'];

          header("Location: ../admin/index1.php?login=Success");
          exit();
        }
        else{

        }

      }


      
    }
      else
      {

  if($resultCheck)
  {

      $dbpass=$resultCheck['USER_PWD'];

       if ($pwd == $dbpass)
       {
      $_SESSION['u_id'] = $resultCheck['USER_UID'];
      $_SESSION['p_id'] = $resultCheck['USER_PWD'];
      $_SESSION['ORG_ID'] = $resultCheck['ORG_ID'];
      $_SESSION['u_assno'] = $resultCheck['ASSESSMENT_NUMBER'];


      header("Location: ../user/sender/homepage.php?login=Success");

      exit();

       }
    }
    else
        {
      echo "";
         }

    }
    }
  }
  else
  {

    header("Location: ../login.php?login=error");
    exit();

  }
