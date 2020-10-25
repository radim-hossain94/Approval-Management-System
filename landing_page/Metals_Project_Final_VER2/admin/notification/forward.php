<?php

if(isset($_POST["forward"]))

{

include 'connect.php';

 $ORG_ID =  $_POST['ORG_ID'];

 $NAME =  $_POST['NAME'];

 $DP_AMOUNT = $_POST['DP_AMOUNT'];

 $DISCOUNT_VALUE = $_POST['DISCOUNT_VALUE'];

 $NO_OF_INSTALLMENT =  $_POST['NO_OF_INSTALLMENT'];

 $NO_OF_FREE_INSTALLMENT = $_POST['NO_OF_FREE_INSTALLMENT'];

 $REMARKS = $_POST['REMARKS'];

$QUOTE_HEADER_ID=  $_POST['QUOTE_HEADER_ID'];

$ASSESSMENT_NUMBER=  $_POST['ASSESSMENT_NUMBER'];

$EMPLOYEE_ID= $_POST['forwardname'];

$COMMENT_STATUS =  0;


$new="SELECT * FROM XX_QUOTE_APPROVAL_LIST_ALL WHERE EMPLOYEE_ID = '".$NAME."' AND QUOTE_HEADER_ID = '".$QUOTE_HEADER_ID."' ORDER BY SEQUENCE_NO DESC";
 $new1 = oci_parse($conn,$new);
 oci_execute($new1);

$new12 =oci_fetch_array($new1,OCI_ASSOC);


$updatenotifi ="UPDATE actions SET COMMENT_STATUS=1 WHERE QUOTE_HEADER_ID = '".$QUOTE_HEADER_ID."' AND SEQUENCE_NO <'".$new12['SEQUENCE_NO']."'";
$updatenotifi1 = oci_parse($conn, $updatenotifi );
oci_execute($updatenotifi1);

$forwared_person_previous_rec="SELECT * FROM XX_QUOTE_APPROVAL_LIST_ALL WHERE EMPLOYEE_ID = '".$EMPLOYEE_ID."' AND QUOTE_HEADER_ID = '".$QUOTE_HEADER_ID."' ORDER BY SEQUENCE_NO DESC";
$forwared_person_previous_rec1 = oci_parse($conn,$forwared_person_previous_rec);
 oci_execute($forwared_person_previous_rec1);
$forwared_person_previous_rec12 =oci_fetch_array($new1,OCI_ASSOC);

$forwardmatch="SELECT * FROM XX_QUOTE_APPROVAL_LIST_ALL
                              WHERE  QUOTE_HEADER_ID='".$QUOTE_HEADER_ID."' AND SEQUENCE_NO=10
                                  OR QUOTE_HEADER_ID='".$QUOTE_HEADER_ID."' AND SEQUENCE_NO=20
                                  OR QUOTE_HEADER_ID='".$QUOTE_HEADER_ID."' AND SEQUENCE_NO=30
                                  OR QUOTE_HEADER_ID='".$QUOTE_HEADER_ID."' AND SEQUENCE_NO=40
                                  OR QUOTE_HEADER_ID='".$QUOTE_HEADER_ID."' AND SEQUENCE_NO=50
                                  OR QUOTE_HEADER_ID='".$QUOTE_HEADER_ID."' AND SEQUENCE_NO=60
                                  OR QUOTE_HEADER_ID='".$QUOTE_HEADER_ID."' AND SEQUENCE_NO=70
                             ORDER BY SEQUENCE_NO ASC";
      $forwardmatch1= oci_parse($conn, $forwardmatch);
       oci_execute($forwardmatch1);
       $pera=0;
    while($forwardmatch12=oci_fetch_array($forwardmatch1,OCI_RETURN_NULLS+OCI_ASSOC))
    {


      if($EMPLOYEE_ID == $forwardmatch12['EMPLOYEE_ID'])
      {

        if($forwardmatch12['ACTIVITY_TYPE_CODE'] == 'A')
        {
              $ACTIVITY_TYPE_CODE="A";
        }
        else
        {
              $ACTIVITY_TYPE_CODE="S";
        }

              $SEQUENCE_NO=(.1+$new12['SEQUENCE_NO']);
              $PERFORM_ACTIVITY_TYPE_CODE="P";
              $CURRENT_RECORD_FLAG="Y";

              $query = "INSERT INTO XX_QUOTE_APPROVAL_LIST_ALL (EMPLOYEE_ID,SEQUENCE_NO,QUOTE_HEADER_ID,PERFORM_ACTIVITY_TYPE_CODE,CURRENT_RECORD_FLAG,ACTIVITY_TYPE_CODE,LAST_UPDATED_BY,LAST_UPDATE_DATE) VALUES (:EMPLOYEE_ID, :SEQUENCE_NO, :QUOTE_HEADER_ID, :PERFORM_ACTIVITY_TYPE_CODE, :CURRENT_RECORD_FLAG, :ACTIVITY_TYPE_CODE, :LAST_UPDATED_BY, sysdate)";

              $result= oci_parse($conn, $query);

              oci_bind_by_name($result, ":EMPLOYEE_ID", $EMPLOYEE_ID);
              oci_bind_by_name($result, ":SEQUENCE_NO", $SEQUENCE_NO);
              oci_bind_by_name($result, ":QUOTE_HEADER_ID", $QUOTE_HEADER_ID);
              oci_bind_by_name($result, ":PERFORM_ACTIVITY_TYPE_CODE", $PERFORM_ACTIVITY_TYPE_CODE);
              oci_bind_by_name($result, ":CURRENT_RECORD_FLAG", $CURRENT_RECORD_FLAG);
              oci_bind_by_name($result, ":ACTIVITY_TYPE_CODE", $ACTIVITY_TYPE_CODE);
              oci_bind_by_name($result, ":LAST_UPDATED_BY", $NAME);


              oci_execute($result);



               $PERFORM_ACTIVITY_TYPE_CODE2="F";
               $CURRENT_RECORD_FLAG2="N";
               $FORWARED_FLAG="Y";


              $forwardbeja= "UPDATE XX_QUOTE_APPROVAL_LIST_ALL SET FORWARED_FLAG='".$FORWARED_FLAG."' , PERFORM_ACTIVITY_TYPE_CODE='".$PERFORM_ACTIVITY_TYPE_CODE2."',CURRENT_RECORD_FLAG='".$CURRENT_RECORD_FLAG2."',LAST_UPDATED_BY='".$NAME."',LAST_UPDATE_DATE=sysdate WHERE EMPLOYEE_ID = '".$NAME."' AND QUOTE_HEADER_ID = '".$QUOTE_HEADER_ID."' AND SEQUENCE_NO='".$new12['SEQUENCE_NO']."'";

              $forwardbeja1= oci_parse($conn,$forwardbeja);
              oci_execute($forwardbeja1);



              $COMMENT_STATUS =  0;

              $own_sequence_no =$new12['SEQUENCE_NO'];

              $actions = "INSERT INTO ACTIONS (DP_AMOUNT,DISCOUNT_VALUE,NO_OF_INSTALLMENT,NO_OF_FREE_INSTALLMENT,REMARKS,NAME,COMMENT_STATUS,QUOTE_HEADER_ID,U_DATE,SEQUENCE_NO) VALUES (:DP_AMOUNT, :DISCOUNT_VALUE, :NO_OF_INSTALLMENT, :NO_OF_FREE_INSTALLMENT, :REMARKS, :NAME, :COMMENT_STATUS, :QUOTE_HEADER_ID, sysdate, :SEQUENCE_NO)";

              $actions1= oci_parse($conn, $actions);


              oci_bind_by_name($actions1, ":NAME", $NAME);
              oci_bind_by_name($actions1, ":COMMENT_STATUS", $COMMENT_STATUS);
              oci_bind_by_name($actions1, ":QUOTE_HEADER_ID", $QUOTE_HEADER_ID);
              oci_bind_by_name($actions1, ":SEQUENCE_NO", $own_sequence_no);
              oci_bind_by_name($actions1, ":DP_AMOUNT", $DP_AMOUNT);
              oci_bind_by_name($actions1, ":DISCOUNT_VALUE", $DISCOUNT_VALUE);
              oci_bind_by_name($actions1, ":NO_OF_INSTALLMENT", $NO_OF_INSTALLMENT);
              oci_bind_by_name($actions1, ":NO_OF_FREE_INSTALLMENT", $NO_OF_FREE_INSTALLMENT);
              oci_bind_by_name($actions1, ":REMARKS", $REMARKS);

              oci_execute($actions1);

              $pera++;

              $Message = "You Just Forwarded <strong>$ASSESSMENT_NUMBER</strong>";
               header("Location: ../index1.php?Message={$Message}");
               die();

        }


      }


      if($pera == 0)
      {
             $ACTIVITY_TYPE_CODE="F";

              $SEQUENCE_NO=(.1+$new12['SEQUENCE_NO']);
              $PERFORM_ACTIVITY_TYPE_CODE="P";
              $CURRENT_RECORD_FLAG="Y";

              $query = "INSERT INTO XX_QUOTE_APPROVAL_LIST_ALL (EMPLOYEE_ID,SEQUENCE_NO,QUOTE_HEADER_ID,PERFORM_ACTIVITY_TYPE_CODE,CURRENT_RECORD_FLAG,ACTIVITY_TYPE_CODE,LAST_UPDATED_BY,LAST_UPDATE_DATE) VALUES (:EMPLOYEE_ID, :SEQUENCE_NO, :QUOTE_HEADER_ID, :PERFORM_ACTIVITY_TYPE_CODE, :CURRENT_RECORD_FLAG, :ACTIVITY_TYPE_CODE, :LAST_UPDATED_BY, sysdate)";

              $result= oci_parse($conn, $query);

              oci_bind_by_name($result, ":EMPLOYEE_ID", $EMPLOYEE_ID);
              oci_bind_by_name($result, ":SEQUENCE_NO", $SEQUENCE_NO);
              oci_bind_by_name($result, ":QUOTE_HEADER_ID", $QUOTE_HEADER_ID);
              oci_bind_by_name($result, ":PERFORM_ACTIVITY_TYPE_CODE", $PERFORM_ACTIVITY_TYPE_CODE);
              oci_bind_by_name($result, ":CURRENT_RECORD_FLAG", $CURRENT_RECORD_FLAG);
              oci_bind_by_name($result, ":ACTIVITY_TYPE_CODE", $ACTIVITY_TYPE_CODE);
              oci_bind_by_name($result, ":LAST_UPDATED_BY", $NAME);


              oci_execute($result);



               $PERFORM_ACTIVITY_TYPE_CODE2="F";
               $CURRENT_RECORD_FLAG2="N";
               $FORWARED_FLAG="Y";


              $forwardbeja= "UPDATE XX_QUOTE_APPROVAL_LIST_ALL SET FORWARED_FLAG='".$FORWARED_FLAG."' , PERFORM_ACTIVITY_TYPE_CODE='".$PERFORM_ACTIVITY_TYPE_CODE2."',CURRENT_RECORD_FLAG='".$CURRENT_RECORD_FLAG2."',LAST_UPDATED_BY='".$NAME."',LAST_UPDATE_DATE=sysdate WHERE EMPLOYEE_ID = '".$NAME."' AND QUOTE_HEADER_ID = '".$QUOTE_HEADER_ID."' AND SEQUENCE_NO='".$new12['SEQUENCE_NO']."'";

              $forwardbeja1= oci_parse($conn,$forwardbeja);
              oci_execute($forwardbeja1);



              $COMMENT_STATUS =  0;

              $own_sequence_no =$new12['SEQUENCE_NO'];

              $actions = "INSERT INTO ACTIONS (DP_AMOUNT,DISCOUNT_VALUE,NO_OF_INSTALLMENT,NO_OF_FREE_INSTALLMENT,REMARKS,NAME,COMMENT_STATUS,QUOTE_HEADER_ID,U_DATE,SEQUENCE_NO) VALUES (:DP_AMOUNT, :DISCOUNT_VALUE, :NO_OF_INSTALLMENT, :NO_OF_FREE_INSTALLMENT, :REMARKS, :NAME, :COMMENT_STATUS, :QUOTE_HEADER_ID, sysdate, :SEQUENCE_NO)";

              $actions1= oci_parse($conn, $actions);


              oci_bind_by_name($actions1, ":NAME", $NAME);
              oci_bind_by_name($actions1, ":COMMENT_STATUS", $COMMENT_STATUS);
              oci_bind_by_name($actions1, ":QUOTE_HEADER_ID", $QUOTE_HEADER_ID);
              oci_bind_by_name($actions1, ":SEQUENCE_NO", $own_sequence_no);
              oci_bind_by_name($actions1, ":DP_AMOUNT", $DP_AMOUNT);
              oci_bind_by_name($actions1, ":DISCOUNT_VALUE", $DISCOUNT_VALUE);
              oci_bind_by_name($actions1, ":NO_OF_INSTALLMENT", $NO_OF_INSTALLMENT);
              oci_bind_by_name($actions1, ":NO_OF_FREE_INSTALLMENT", $NO_OF_FREE_INSTALLMENT);
              oci_bind_by_name($actions1, ":REMARKS", $REMARKS);

              oci_execute($actions1);

              $pera++;

              $Message = "You Just Forwarded <strong>$ASSESSMENT_NUMBER</strong>";
               header("Location: ../index1.php?Message={$Message}");
               die();
      }


    }

else
{
   header("Location: ../index1.php");

}


?>
