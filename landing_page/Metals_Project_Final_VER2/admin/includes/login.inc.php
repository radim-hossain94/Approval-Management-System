<?php

session_start();

if (isset($_POST['submit'])) {

  include 'dbh.inc.php';

  $uid = $_POST['uid'];
  $pwd = $_POST['pwd'];

//   select * from XX_QOT_APPRV_USER_ACCESS_ALL
// where trunc(sysdate) between START_DATE and nvl(END_DATE,trunc(sysdate))

  $login_check_rolename="SELECT * FROM XX_QOT_APPRV_USER_ACCESS_ALL UA, FND_USER FU
                         WHERE     UA.USER_ID = FU.USER_ID
                         AND TRUNC (SYSDATE) BETWEEN UA.START_DATE
                         AND NVL (UA.END_DATE, TRUNC (SYSDATE)) AND FU.USER_NAME='".$uid."'";

                         $login_check_rolename1= oci_parse($conn, $login_check_rolename);
                         oci_execute($login_check_rolename1);
    $count=0;

    while($login_check_rolename12 =oci_fetch_array($login_check_rolename1,OCI_RETURN_NULLS+OCI_ASSOC))

    {
      $ROLE_NAME[0]=$login_check_rolename12['ROLE_NAME'];
      $count++;
    }

  if($count>0)
  {

     if ($ROLE_NAME[0] == 'Admin')

    {

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

  else if($ROLE_NAME[0] == 'User')
  {
    if(empty($pwd)||empty($uid))
     {
       header("Location: ../login.php");
      exit();
     }


     else
     {

      $sql="SELECT * FROM XX_QOT_APPRV_USER_ACCESS_ALL UA, FND_USER FU
                             WHERE  UA.USER_ID = FU.USER_ID
                             AND TRUNC (SYSDATE) BETWEEN UA.START_DATE
                             AND NVL (UA.END_DATE, TRUNC (SYSDATE)) AND FU.USER_NAME='".$uid."'";

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
            $_SESSION['ORG_ID'] = $row['ORG_ID'];
            $_SESSION['ORGANIZATION_ID'] = $row['ORGANIZATION_ID'];
            $_SESSION['A_NAME'] = $row['EMPLOYEE_ID'];

             header("Location:../../../metals_project94/user/sender/homepage.php");

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
    $Message = "System Error";
    header("Location: ../login.php?Message={$Message}");
    exit();
  }

 }
 else
 {

     $Message = "You Do not have Access of This System";
     header("Location: ../login.php?Message={$Message}");
     exit();

 }
}


  else
  {

    $Message = "Login Error!";
    header("Location: ../login.php?Message={$Message}");
    exit();

  }
