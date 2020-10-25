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


$DESIGNATION = "SELECT EMPLOYEE_NUMBER,
      EMPLOYEE_NUMBER,
      DESIGNATION,
      EMPLOYEE_ID
 FROM XX_APPROVAL_MEMBER_V
WHERE     ORG_ID = '".$ORG_ID."' AND EMPLOYEE_ID = '".$EMPLOYEE_ID."'";

$DESIGNATION1 = oci_parse($conn,$DESIGNATION);
oci_execute($DESIGNATION1);
$DESIGNATION12 =oci_fetch_array($DESIGNATION1,OCI_ASSOC);

$DESIGNATION_MAIN=$DESIGNATION12['DESIGNATION'];

$new="SELECT * FROM XX_QUOTE_APPROVAL_LIST_ALL WHERE EMPLOYEE_ID = '".$NAME."' AND QUOTE_HEADER_ID = '".$QUOTE_HEADER_ID."' ORDER BY SEQUENCE_NO DESC";
 $new1 = oci_parse($conn,$new);
 oci_execute($new1);

$new12 =oci_fetch_array($new1,OCI_ASSOC);


$previous_per="SELECT * FROM XX_QUOTE_APPROVAL_LIST_ALL WHERE QUOTE_HEADER_ID = '".$QUOTE_HEADER_ID."' AND SEQUENCE_NO <'".$new12['SEQUENCE_NO']."' ORDER BY SEQUENCE_NO DESC";
 $previous_per1 = oci_parse($conn,$previous_per);
 oci_execute($previous_per1);

$previous_per12 =oci_fetch_array($previous_per1,OCI_ASSOC);


$updatenotifi ="UPDATE actions SET COMMENT_STATUS=1 WHERE QUOTE_HEADER_ID = '".$QUOTE_HEADER_ID."' AND SEQUENCE_NO <'".$new12['SEQUENCE_NO']."'";
$updatenotifi1 = oci_parse($conn, $updatenotifi );
oci_execute($updatenotifi1);



if($new12['ACTIVITY_TYPE_CODE'] == 'S')
{
$SEQUENCE_NO=(.1+$new12['SEQUENCE_NO']);

$forwardfilter="SELECT distinct(b.EMPLOYEE_ID),b.DESIGNATION,b.FULL_NAME from XX_APPROVAL_MEMBER_V b
                                WHERE b.EMPLOYEE_ID IN
                                (SELECT a.EMPLOYEE_ID FROM XX_QUOTE_APPROVAL_LIST_ALL a  WHERE  a.QUOTE_HEADER_ID='".$QUOTE_HEADER_ID."' AND SEQUENCE_NO=10
                                  OR a.QUOTE_HEADER_ID='".$QUOTE_HEADER_ID."' AND SEQUENCE_NO=20
                                  OR a.QUOTE_HEADER_ID='".$QUOTE_HEADER_ID."' AND SEQUENCE_NO=30
                                  OR a.QUOTE_HEADER_ID='".$QUOTE_HEADER_ID."' AND SEQUENCE_NO=40
                                  OR a.QUOTE_HEADER_ID='".$QUOTE_HEADER_ID."' AND SEQUENCE_NO=50
                                  OR a.QUOTE_HEADER_ID='".$QUOTE_HEADER_ID."' AND SEQUENCE_NO=60
                                  OR a.QUOTE_HEADER_ID='".$QUOTE_HEADER_ID."' AND SEQUENCE_NO=70) ORDER BY b.EMPLOYEE_ID ASC";
      $forwardfilter1= oci_parse($conn, $forwardfilter);
       oci_execute($forwardfilter1);

       $pera=0;
            while($forwardfilter12=oci_fetch_array($forwardfilter1,OCI_RETURN_NULLS+OCI_ASSOC))

            {

            if($forwardfilter12['EMPLOYEE_ID'] == $EMPLOYEE_ID)
                {

                $ACTIVITY_TYPE_CODE="S";

                 $pera++;

                }
                else{
                  echo "";
                }
           }

           if($pera == 0)
           {

             $ACTIVITY_TYPE_CODE="F";

           }

 $PERFORM_ACTIVITY_TYPE_CODE="P";

 $CURRENT_RECORD_FLAG="Y";




$query = "INSERT INTO XX_QUOTE_APPROVAL_LIST_ALL (EMPLOYEE_ID,SEQUENCE_NO,QUOTE_HEADER_ID,PERFORM_ACTIVITY_TYPE_CODE,CURRENT_RECORD_FLAG,ACTIVITY_TYPE_CODE,LIST_MEMBER,LAST_UPDATED_BY,LAST_UPDATE_DATE) VALUES (:EMPLOYEE_ID, :SEQUENCE_NO, :QUOTE_HEADER_ID, :PERFORM_ACTIVITY_TYPE_CODE, :CURRENT_RECORD_FLAG, :ACTIVITY_TYPE_CODE, :LIST_MEMBER, :LAST_UPDATED_BY, sysdate)";

$result= oci_parse($conn, $query);

oci_bind_by_name($result, ":EMPLOYEE_ID", $EMPLOYEE_ID);
oci_bind_by_name($result, ":SEQUENCE_NO", $SEQUENCE_NO);
oci_bind_by_name($result, ":QUOTE_HEADER_ID", $QUOTE_HEADER_ID);
oci_bind_by_name($result, ":PERFORM_ACTIVITY_TYPE_CODE", $PERFORM_ACTIVITY_TYPE_CODE);
oci_bind_by_name($result, ":CURRENT_RECORD_FLAG", $CURRENT_RECORD_FLAG);
oci_bind_by_name($result, ":ACTIVITY_TYPE_CODE", $ACTIVITY_TYPE_CODE);
oci_bind_by_name($result, ":LIST_MEMBER", $DESIGNATION_MAIN);
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



$Message = "You Just Forwarded <strong>$ASSESSMENT_NUMBER</strong>";
 header("Location: ../index1.php?Message={$Message}");
 die();
}


else if($new12['ACTIVITY_TYPE_CODE'] == 'F')
{
$SEQUENCE_NO=(.1+$new12['SEQUENCE_NO']);


$ACTIVITY_TYPE_CODE=$previous_per12['ACTIVITY_TYPE_CODE'];

 $PERFORM_ACTIVITY_TYPE_CODE="P";

 $CURRENT_RECORD_FLAG="Y";




$query = "INSERT INTO XX_QUOTE_APPROVAL_LIST_ALL (EMPLOYEE_ID,SEQUENCE_NO,QUOTE_HEADER_ID,PERFORM_ACTIVITY_TYPE_CODE,CURRENT_RECORD_FLAG,ACTIVITY_TYPE_CODE,LIST_MEMBER,LAST_UPDATED_BY,LAST_UPDATE_DATE) VALUES (:EMPLOYEE_ID, :SEQUENCE_NO, :QUOTE_HEADER_ID, :PERFORM_ACTIVITY_TYPE_CODE, :CURRENT_RECORD_FLAG, :ACTIVITY_TYPE_CODE, :LIST_MEMBER, :LAST_UPDATED_BY, sysdate)";

$result= oci_parse($conn, $query);

oci_bind_by_name($result, ":EMPLOYEE_ID", $EMPLOYEE_ID);
oci_bind_by_name($result, ":SEQUENCE_NO", $SEQUENCE_NO);
oci_bind_by_name($result, ":QUOTE_HEADER_ID", $QUOTE_HEADER_ID);
oci_bind_by_name($result, ":PERFORM_ACTIVITY_TYPE_CODE", $PERFORM_ACTIVITY_TYPE_CODE);
oci_bind_by_name($result, ":CURRENT_RECORD_FLAG", $CURRENT_RECORD_FLAG);
oci_bind_by_name($result, ":ACTIVITY_TYPE_CODE", $ACTIVITY_TYPE_CODE);
oci_bind_by_name($result, ":LIST_MEMBER", $DESIGNATION_MAIN);
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



$Message = "You Just Forwarded <strong>$ASSESSMENT_NUMBER</strong>";
 header("Location: ../index1.php?Message={$Message}");
 die();
}


else if ($new12['ACTIVITY_TYPE_CODE'] == 'A')

{

  $SEQUENCE_NO=(.1+$new12['SEQUENCE_NO']);
  $forwardfilter="SELECT distinct(b.EMPLOYEE_ID),b.DESIGNATION,b.FULL_NAME from XX_APPROVAL_MEMBER_V b
                                  WHERE b.EMPLOYEE_ID IN
                                  (SELECT a.EMPLOYEE_ID FROM XX_QUOTE_APPROVAL_LIST_ALL a  WHERE  a.QUOTE_HEADER_ID='".$QUOTE_HEADER_ID."' AND SEQUENCE_NO=10
                                    OR a.QUOTE_HEADER_ID='".$QUOTE_HEADER_ID."' AND SEQUENCE_NO=20
                                    OR a.QUOTE_HEADER_ID='".$QUOTE_HEADER_ID."' AND SEQUENCE_NO=30
                                    OR a.QUOTE_HEADER_ID='".$QUOTE_HEADER_ID."' AND SEQUENCE_NO=40
                                    OR a.QUOTE_HEADER_ID='".$QUOTE_HEADER_ID."' AND SEQUENCE_NO=50
                                    OR a.QUOTE_HEADER_ID='".$QUOTE_HEADER_ID."' AND SEQUENCE_NO=60
                                    OR a.QUOTE_HEADER_ID='".$QUOTE_HEADER_ID."' AND SEQUENCE_NO=70) ORDER BY b.EMPLOYEE_ID ASC";
        $forwardfilter1= oci_parse($conn, $forwardfilter);
         oci_execute($forwardfilter1);

    $pera=0;
         while($forwardfilter12=oci_fetch_array($forwardfilter1,OCI_RETURN_NULLS+OCI_ASSOC))

         {

         if($forwardfilter12['EMPLOYEE_ID'] == $EMPLOYEE_ID)
             {

             $ACTIVITY_TYPE_CODE="S";

              $pera++;

             }
             else{
               echo "";
             }
        }

        if($pera == 0)
        {

          $ACTIVITY_TYPE_CODE="F";

        }

   $PERFORM_ACTIVITY_TYPE_CODE="P";
   $CURRENT_RECORD_FLAG="Y";



   $query = "INSERT INTO XX_QUOTE_APPROVAL_LIST_ALL (EMPLOYEE_ID,SEQUENCE_NO,QUOTE_HEADER_ID,PERFORM_ACTIVITY_TYPE_CODE,CURRENT_RECORD_FLAG,ACTIVITY_TYPE_CODE,LIST_MEMBER,LAST_UPDATED_BY,LAST_UPDATE_DATE) VALUES (:EMPLOYEE_ID, :SEQUENCE_NO, :QUOTE_HEADER_ID, :PERFORM_ACTIVITY_TYPE_CODE, :CURRENT_RECORD_FLAG, :ACTIVITY_TYPE_CODE, :LIST_MEMBER, :LAST_UPDATED_BY, sysdate)";

   $result= oci_parse($conn, $query);

   oci_bind_by_name($result, ":EMPLOYEE_ID", $EMPLOYEE_ID);
   oci_bind_by_name($result, ":SEQUENCE_NO", $SEQUENCE_NO);
   oci_bind_by_name($result, ":QUOTE_HEADER_ID", $QUOTE_HEADER_ID);
   oci_bind_by_name($result, ":PERFORM_ACTIVITY_TYPE_CODE", $PERFORM_ACTIVITY_TYPE_CODE);
   oci_bind_by_name($result, ":CURRENT_RECORD_FLAG", $CURRENT_RECORD_FLAG);
   oci_bind_by_name($result, ":ACTIVITY_TYPE_CODE", $ACTIVITY_TYPE_CODE);
   oci_bind_by_name($result, ":LIST_MEMBER", $DESIGNATION_MAIN);
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


  $Message = "You Just Forwarded <strong>$ASSESSMENT_NUMBER</strong>";
   header("Location: ../index1.php?Message={$Message}");
   die();


}

else
{
   header("Location: ../index1.php");

}


}


?>
