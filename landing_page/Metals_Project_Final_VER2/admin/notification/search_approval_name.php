<?php
session_start();
$A_NAME=$_SESSION['A_NAME'];

include '../includes/dbh.inc.php';

$APPROVAL_NAME = $_POST["APPROVAL_NAME"];
$QUOTE_HEADER_ID = $_POST["QUOTE_HEADER_ID"];

?>
<!DOCTYPE html>
<html lang="en">
<body>


            <!-- Forward -->
           <select class="form-control" name="forwardname" id="forwardname">

                 <?php

                 $listseque=" SELECT * FROM XX_QUOTE_APPROVAL_LIST_ALL WHERE QUOTE_HEADER_ID ='".$QUOTE_HEADER_ID."' AND EMPLOYEE_ID='".$A_NAME."' ORDER BY SEQUENCE_NO DESC ";

                    $listseque1 = oci_parse($conn,$listseque);
                    oci_execute($listseque1);
                    $listseque12 =oci_fetch_array($listseque1,OCI_RETURN_NULLS+OCI_ASSOC);


                    $forward="SELECT distinct(EMPLOYEE_ID),
                           EMPLOYEE_NUMBER,
                           DESIGNATION,
                           FULL_NAME
                           from XX_APPROVAL_MEMBER_V AM
                           WHERE EXISTS (SELECT 1 FROM XX_QOT_APPRV_USER_ACCESS_ALL AUA
                    where trunc(sysdate) between START_DATE and nvl(END_DATE,trunc(sysdate))
                    AND AUA.USER_ID=AM.USER_ID
                    AND ROLE_NAME='Admin')
                    AND FULL_NAME LIKE '%".$APPROVAL_NAME."%'
                    AND EMPLOYEE_ID NOT IN (SELECT a.EMPLOYEE_ID FROM XX_QUOTE_APPROVAL_LIST_ALL a  WHERE  a.QUOTE_HEADER_ID='".$listseque12['QUOTE_HEADER_ID']."' AND a.SEQUENCE_NO >='".$listseque12['SEQUENCE_NO']."')
                    ORDER BY EMPLOYEE_ID ASC";


                // $forward="SELECT distinct(b.EMPLOYEE_ID),b.DESIGNATION,b.FULL_NAME from XX_APPROVAL_MEMBER_V b
                //                 WHERE FULL_NAME LIKE '%".$APPROVAL_NAME."%' AND b.EMPLOYEE_ID NOT IN (SELECT a.EMPLOYEE_ID FROM XX_QUOTE_APPROVAL_LIST_ALL a  WHERE  a.QUOTE_HEADER_ID='".$listseque12['QUOTE_HEADER_ID']."' AND a.SEQUENCE_NO >='".$listseque12['SEQUENCE_NO']."') ORDER BY b.EMPLOYEE_ID ASC";

                    $forward1 = oci_parse($conn,$forward);
                    oci_execute($forward1);


                    while($forward12 =oci_fetch_array($forward1,OCI_RETURN_NULLS+OCI_ASSOC))
                    {
                      if($forward12['DESIGNATION'] == NULL){
                        ?>

                             <option value="<?php echo $forward12['EMPLOYEE_ID']; ?>"><?php echo $forward12['FULL_NAME'];?> </option>

                       <?php
                      }
                      else{
                     ?>

                        <option value="<?php echo $forward12['EMPLOYEE_ID']; ?>"><?php echo $forward12['FULL_NAME'];?> [<?php echo $forward12['DESIGNATION'];?>] </option>

                    <?php
                    }
                  }

                    ?>
              </select>


</body>
</html>
