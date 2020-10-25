<?php
error_reporting(0);
if(isset($_POST["Suppfinal"]))

{

include 'connect.php';

$DP_AMOUNT = $_POST['DP_AMOUNT'];

$DISCOUNT_VALUE = $_POST['DISCOUNT_VALUE'];

$NO_OF_INSTALLMENT =  $_POST['NO_OF_INSTALLMENT'];

$NO_OF_FREE_INSTALLMENT = $_POST['NO_OF_FREE_INSTALLMENT'];

$REMARKS = $_POST['REMARKS'];

$NAME =  $_POST['NAME'];

$QUOTE_HEADER_ID=  $_POST['QUOTE_HEADER_ID'];

$COMMENT_STATUS =  0;

// Ses er jon er sequence no

$last_person_pending_SEQ="SELECT * FROM XX_QUOTE_APPROVAL_LIST_ALL WHERE EMPLOYEE_ID = '".$NAME."' AND QUOTE_HEADER_ID = '".$QUOTE_HEADER_ID."'  AND PERFORM_ACTIVITY_TYPE_CODE='P' ORDER BY SEQUENCE_NO DESC" ;
$last_person_pending_SEQ1 = oci_parse($conn,$last_person_pending_SEQ);
oci_execute($last_person_pending_SEQ1);

$last_person_pending_SEQ12 =oci_fetch_array($last_person_pending_SEQ1,OCI_RETURN_NULLS+OCI_ASSOC);


$last_person_pending_SEQ_main=$last_person_pending_SEQ12['SEQUENCE_NO'];

// sobar sequece no ++
$check="SELECT * FROM XX_QUOTE_APPROVAL_LIST_ALL WHERE EMPLOYEE_ID = '".$NAME."' AND QUOTE_HEADER_ID = '".$QUOTE_HEADER_ID."' ORDER BY SEQUENCE_NO ASC" ;
$check1 = oci_parse($conn,$check);
oci_execute($check1);

$i=0;
$n=0;
while($check12 =oci_fetch_array($check1,OCI_RETURN_NULLS+OCI_ASSOC))
{
  $ACTIVITY_TYPE_CODE_array[$i]=$check12['ACTIVITY_TYPE_CODE'];
  $SEQUENCE_NO_ok_array[$i]=$check12['SEQUENCE_NO'];
  $PERFORM_ACTIVITY_TYPE_CODE_array[$i]=$check12['PERFORM_ACTIVITY_TYPE_CODE'];

$i++;
$n++;
}

$value=$SEQUENCE_NO_ok_array[$i-1];

// sequence no er agerjon er 'F'
$previousperson="SELECT * FROM XX_QUOTE_APPROVAL_LIST_ALL WHERE QUOTE_HEADER_ID = '".$QUOTE_HEADER_ID."' AND SEQUENCE_NO < '".$value."' AND EMPLOYEE_ID != '".$NAME."' ORDER BY SEQUENCE_NO DESC" ;
$previousperson1 = oci_parse($conn,$previousperson);
oci_execute($previousperson1);
$previousperson12=oci_fetch_array($previousperson1,OCI_RETURN_NULLS+OCI_ASSOC);


if($i>1 && $ACTIVITY_TYPE_CODE_array[0] == 'S' && $previousperson12['PERFORM_ACTIVITY_TYPE_CODE']=='F')
{

  $query1 = "INSERT INTO ACTIONS (DP_AMOUNT,DISCOUNT_VALUE,NO_OF_INSTALLMENT,NO_OF_FREE_INSTALLMENT,REMARKS,NAME,COMMENT_STATUS,QUOTE_HEADER_ID,U_DATE,SEQUENCE_NO) VALUES (:DP_AMOUNT, :DISCOUNT_VALUE, :NO_OF_INSTALLMENT, :NO_OF_FREE_INSTALLMENT, :REMARKS, :NAME, :COMMENT_STATUS, :QUOTE_HEADER_ID, sysdate, :SEQUENCE_NO)";

  $result2= oci_parse($conn, $query1);

  oci_bind_by_name($result2, ":DP_AMOUNT", $DP_AMOUNT);
  oci_bind_by_name($result2, ":DISCOUNT_VALUE", $DISCOUNT_VALUE);
  oci_bind_by_name($result2, ":NO_OF_INSTALLMENT", $NO_OF_INSTALLMENT);
  oci_bind_by_name($result2, ":NO_OF_FREE_INSTALLMENT", $NO_OF_FREE_INSTALLMENT);
  oci_bind_by_name($result2, ":REMARKS", $REMARKS);
  oci_bind_by_name($result2, ":NAME", $NAME);
  oci_bind_by_name($result2, ":COMMENT_STATUS", $COMMENT_STATUS);
  oci_bind_by_name($result2, ":QUOTE_HEADER_ID", $QUOTE_HEADER_ID);
  oci_bind_by_name($result2, ":SEQUENCE_NO", $last_person_pending_SEQ_main);

  oci_execute($result2);


  // current person er status update
    $updatequery="UPDATE XX_QUOTE_APPROVAL_LIST_ALL set LAST_UPDATED_BY='".$NAME."',LAST_UPDATE_DATE=sysdate,PERFORM_ACTIVITY_TYPE_CODE = 'S' , CURRENT_RECORD_FLAG ='N', FORWARED_FLAG='N' where QUOTE_HEADER_ID='".$QUOTE_HEADER_ID."' AND SEQUENCE_NO='".$last_person_pending_SEQ_main."' AND EMPLOYEE_ID='".$NAME."' ";
    $updatequery1= oci_parse($conn,$updatequery);
    oci_execute($updatequery1);


$insertdupli="SELECT * FROM XX_QUOTE_APPROVAL_LIST_ALL
                              WHERE  QUOTE_HEADER_ID='".$QUOTE_HEADER_ID."' AND SEQUENCE_NO=10
                                  OR QUOTE_HEADER_ID='".$QUOTE_HEADER_ID."' AND SEQUENCE_NO=20
                                  OR QUOTE_HEADER_ID='".$QUOTE_HEADER_ID."' AND SEQUENCE_NO=30
                                  OR QUOTE_HEADER_ID='".$QUOTE_HEADER_ID."' AND SEQUENCE_NO=40
                                  OR QUOTE_HEADER_ID='".$QUOTE_HEADER_ID."' AND SEQUENCE_NO=50
                                  OR QUOTE_HEADER_ID='".$QUOTE_HEADER_ID."' AND SEQUENCE_NO=60
                                  OR QUOTE_HEADER_ID='".$QUOTE_HEADER_ID."' AND SEQUENCE_NO=70
                             ORDER BY SEQUENCE_NO ASC";
      $insertdupli1= oci_parse($conn, $insertdupli);
       oci_execute($insertdupli1);

    while($insertdupli12=oci_fetch_array($insertdupli1,OCI_RETURN_NULLS+OCI_ASSOC))

{
  if($NAME == $insertdupli12['EMPLOYEE_ID'])
  {
    $Orginal_SEQ_currnet_person=$insertdupli12['SEQUENCE_NO'];
    $Orginal_EMPLOYEE_ID_currnet_person=$insertdupli12['EMPLOYEE_ID'];
  }

}


$insertdupli_main="SELECT * FROM XX_QUOTE_APPROVAL_LIST_ALL
                              WHERE  QUOTE_HEADER_ID='".$QUOTE_HEADER_ID."' AND SEQUENCE_NO=10
                                  OR QUOTE_HEADER_ID='".$QUOTE_HEADER_ID."' AND SEQUENCE_NO=20
                                  OR QUOTE_HEADER_ID='".$QUOTE_HEADER_ID."' AND SEQUENCE_NO=30
                                  OR QUOTE_HEADER_ID='".$QUOTE_HEADER_ID."' AND SEQUENCE_NO=40
                                  OR QUOTE_HEADER_ID='".$QUOTE_HEADER_ID."' AND SEQUENCE_NO=50
                                  OR QUOTE_HEADER_ID='".$QUOTE_HEADER_ID."' AND SEQUENCE_NO=60
                                  OR QUOTE_HEADER_ID='".$QUOTE_HEADER_ID."' AND SEQUENCE_NO=70
                             ORDER BY SEQUENCE_NO ASC";
      $insertdupli_main1= oci_parse($conn, $insertdupli_main);
       oci_execute($insertdupli_main1);

 $y=0;



    while($insertdupli_main12=oci_fetch_array($insertdupli_main1,OCI_RETURN_NULLS+OCI_ASSOC))

{
  if($Orginal_SEQ_currnet_person < $insertdupli_main12['SEQUENCE_NO'])
  {

    $f=0;

       $not_supported_public = "SELECT * FROM XX_QUOTE_APPROVAL_LIST_ALL WHERE PERFORM_ACTIVITY_TYPE_CODE='N' AND CURRENT_RECORD_FLAG='N' AND QUOTE_HEADER_ID='".$QUOTE_HEADER_ID."' ORDER BY SEQUENCE_NO ASC";
       $not_supported_public1= oci_parse($conn,$not_supported_public);
        oci_execute($not_supported_public1);


    while($not_supported_public12=oci_fetch_array($not_supported_public1,OCI_RETURN_NULLS+OCI_ASSOC))
    {
      $not_supported_public_array[$f]=$not_supported_public12['EMPLOYEE_ID'];
      $f++;
    }


    if(    $not_supported_public_array[0]!= $insertdupli_main12['EMPLOYEE_ID']
        && $not_supported_public_array[1]!= $insertdupli_main12['EMPLOYEE_ID']
        && $not_supported_public_array[2]!= $insertdupli_main12['EMPLOYEE_ID']
        && $not_supported_public_array[3]!= $insertdupli_main12['EMPLOYEE_ID']
        && $not_supported_public_array[4]!= $insertdupli_main12['EMPLOYEE_ID']
        && $not_supported_public_array[5]!= $insertdupli_main12['EMPLOYEE_ID']
        && $not_supported_public_array[6]!= $insertdupli_main12['EMPLOYEE_ID']  )
    {

    $insertdupli_main_array[$y] = $insertdupli_main12['EMPLOYEE_ID'];

       if($insertdupli_main_array[$y] == $insertdupli_main_array[0])
        {
          $PERFORM_ACTIVITY_TYPE_CODE='P';
          $CURRENT_RECORD_FLAG='Y';
        }
      else
       {
        $PERFORM_ACTIVITY_TYPE_CODE='N';
        $CURRENT_RECORD_FLAG='N';
       }


      if($insertdupli_main12['ACTIVITY_TYPE_CODE'] == 'A')
      {
         $ACTIVITY_TYPE_CODE='A';
      }
      else
      {
       $ACTIVITY_TYPE_CODE='S';
      }

      $l=$y+1;

      $SEQUENCE_NO_ARRAY=$last_person_pending_SEQ_main+$l;

       $Appinsert = "INSERT INTO XX_QUOTE_APPROVAL_LIST_ALL (EMPLOYEE_ID,SEQUENCE_NO,QUOTE_HEADER_ID,PERFORM_ACTIVITY_TYPE_CODE,CURRENT_RECORD_FLAG,ACTIVITY_TYPE_CODE,LAST_UPDATED_BY,LAST_UPDATE_DATE) VALUES (:EMPLOYEE_ID, :SEQUENCE_NO, :QUOTE_HEADER_ID, :PERFORM_ACTIVITY_TYPE_CODE, :CURRENT_RECORD_FLAG, :ACTIVITY_TYPE_CODE, :LAST_UPDATED_BY, sysdate)";
       $Appinsert1= oci_parse($conn, $Appinsert);

       oci_bind_by_name($Appinsert1, ":EMPLOYEE_ID", $insertdupli_main12['EMPLOYEE_ID']);
       oci_bind_by_name($Appinsert1, ":SEQUENCE_NO", $SEQUENCE_NO_ARRAY);
       oci_bind_by_name($Appinsert1, ":QUOTE_HEADER_ID", $QUOTE_HEADER_ID);
       oci_bind_by_name($Appinsert1, ":PERFORM_ACTIVITY_TYPE_CODE", $PERFORM_ACTIVITY_TYPE_CODE);
       oci_bind_by_name($Appinsert1, ":CURRENT_RECORD_FLAG", $CURRENT_RECORD_FLAG);
       oci_bind_by_name($Appinsert1, ":ACTIVITY_TYPE_CODE", $ACTIVITY_TYPE_CODE);
       oci_bind_by_name($Appinsert1, ":LAST_UPDATED_BY",   $NAME);
       oci_execute($Appinsert1);


     $y++;


    }

    else
    {
      echo "";
    }


  }

}

// jodi kawk na pay loop er jonno tahole next person 'P'
if( $y == 0)
{
  $Next_person="SELECT * FROM XX_QUOTE_APPROVAL_LIST_ALL WHERE SEQUENCE_NO >'".$last_person_pending_SEQ_main."' AND QUOTE_HEADER_ID='".$QUOTE_HEADER_ID."' ORDER BY SEQUENCE_NO ASC";
  $Next_person1= oci_parse($conn,$Next_person);
  oci_execute($Next_person1);
  $Next_person12=oci_fetch_array($Next_person1,OCI_RETURN_NULLS+OCI_ASSOC);

  $next_person_outta_loop=$Next_person12['SEQUENCE_NO'];

  $next_person_pending="UPDATE XX_QUOTE_APPROVAL_LIST_ALL SET PERFORM_ACTIVITY_TYPE_CODE='P', CURRENT_RECORD_FLAG='Y',LAST_UPDATED_BY='".$NAME."',LAST_UPDATE_DATE=sysdate WHERE SEQUENCE_NO='".$next_person_outta_loop."' AND QUOTE_HEADER_ID='".$QUOTE_HEADER_ID."' ";
  $next_person_pending1 = oci_parse($conn, $next_person_pending);
  oci_execute($next_person_pending1);
}

// notification er problem solved
$updatenotifi ="UPDATE actions SET COMMENT_STATUS=1 WHERE QUOTE_HEADER_ID = '".$QUOTE_HEADER_ID."' AND SEQUENCE_NO <'".$value."'";
$updatenotifi1 = oci_parse($conn, $updatenotifi );
oci_execute($updatenotifi1);




// header message
$msg="SELECT * FROM XX_QUOTE_HEADERS_ALL WHERE QUOTE_HEADER_ID= '".$QUOTE_HEADER_ID."' ";
$msgs= oci_parse($conn,$msg);
oci_execute($msgs);
$msgsuccess=oci_fetch_array($msgs,OCI_ASSOC);
$msge=$msgsuccess['ASSESSMENT_NUMBER'];
$Message = "You Just Supported <strong>$msge</strong>";
header("Location: ../index1.php?Message={$Message}");
die();
}


// else case active

else
{
     $new="SELECT * FROM XX_QUOTE_APPROVAL_LIST_ALL WHERE EMPLOYEE_ID = '".$NAME."' AND QUOTE_HEADER_ID = '".$QUOTE_HEADER_ID."' ORDER BY SEQUENCE_NO DESC" ;
        $new1 = oci_parse($conn,$new);
        oci_execute($new1);

       $new12 =oci_fetch_array($new1,OCI_ASSOC);

       $SEQUENCE_NO=$new12['SEQUENCE_NO'];

$query = "INSERT INTO ACTIONS (DP_AMOUNT,DISCOUNT_VALUE,NO_OF_INSTALLMENT,NO_OF_FREE_INSTALLMENT,REMARKS,NAME,COMMENT_STATUS,QUOTE_HEADER_ID,U_DATE,SEQUENCE_NO) VALUES (:DP_AMOUNT, :DISCOUNT_VALUE, :NO_OF_INSTALLMENT, :NO_OF_FREE_INSTALLMENT, :REMARKS, :NAME, :COMMENT_STATUS, :QUOTE_HEADER_ID, sysdate, :SEQUENCE_NO)";

$result= oci_parse($conn, $query);

oci_bind_by_name($result, ":DP_AMOUNT", $DP_AMOUNT);
oci_bind_by_name($result, ":DISCOUNT_VALUE", $DISCOUNT_VALUE);
oci_bind_by_name($result, ":NO_OF_INSTALLMENT", $NO_OF_INSTALLMENT);
oci_bind_by_name($result, ":NO_OF_FREE_INSTALLMENT", $NO_OF_FREE_INSTALLMENT);
oci_bind_by_name($result, ":REMARKS", $REMARKS);
oci_bind_by_name($result, ":NAME", $NAME);
oci_bind_by_name($result, ":COMMENT_STATUS", $COMMENT_STATUS);
oci_bind_by_name($result, ":QUOTE_HEADER_ID", $QUOTE_HEADER_ID);
oci_bind_by_name($result, ":SEQUENCE_NO", $SEQUENCE_NO);

oci_execute($result);




if(isset($_POST["Suppfinal"]))

{
include 'connect.php';
$QUOTE_HEADER_ID=  $_POST['QUOTE_HEADER_ID'];
$NAME =  $_POST['NAME'];

  $sql = "UPDATE XX_QUOTE_APPROVAL_LIST_ALL  SET PERFORM_ACTIVITY_TYPE_CODE = 'S' , CURRENT_RECORD_FLAG='N' WHERE QUOTE_HEADER_ID = '".$QUOTE_HEADER_ID."' AND EMPLOYEE_ID='".$NAME."' AND SEQUENCE_NO='".$SEQUENCE_NO."'";

  $result1= oci_parse($conn, $sql);
  oci_execute($result1);
}

if(isset($_POST["Suppfinal"]))

{
$NAME =  $_POST['NAME'];
$QUOTE_HEADER_ID=  $_POST['QUOTE_HEADER_ID'];

$sql5="SELECT * FROM XX_QUOTE_APPROVAL_LIST_ALL WHERE  QUOTE_HEADER_ID = '".$QUOTE_HEADER_ID."' AND EMPLOYEE_ID = '".$NAME."' AND SEQUENCE_NO='".$SEQUENCE_NO."' ";

$result5= oci_parse($conn, $sql5);

oci_execute($result5);

$result55 =oci_fetch_array($result5,OCI_ASSOC);



//Both query Needed..Dont delete

$sql1="SELECT * FROM XX_QUOTE_APPROVAL_LIST_ALL WHERE  QUOTE_HEADER_ID = '".$QUOTE_HEADER_ID."' ORDER BY SEQUENCE_NO ASC";

$result2= oci_parse($conn, $sql1);

oci_execute($result2);

$sq="SELECT * FROM XX_QUOTE_APPROVAL_LIST_ALL WHERE  QUOTE_HEADER_ID = '".$QUOTE_HEADER_ID."' ORDER BY SEQUENCE_NO ASC";

$res= oci_parse($conn, $sq);

oci_execute($res);

//OK



if ($result55['ACTIVITY_TYPE_CODE'] == 'A')
{

  $sql = "UPDATE XX_QUOTE_APPROVAL_LIST_ALL  SET PERFORM_ACTIVITY_TYPE_CODE='A', LAST_UPDATED_BY='".$NAME."',LAST_UPDATE_DATE=sysdate WHERE QUOTE_HEADER_ID = '".$QUOTE_HEADER_ID."' AND EMPLOYEE_ID = '".$NAME."' AND SEQUENCE_NO='".$SEQUENCE_NO."' ";

  $result1= oci_parse($conn, $sql);
  oci_execute($result1);

  $userstatus = "UPDATE XX_QUOTE_HEADERS_ALL SET USER_STATUS1=0,QUOTE_STATUS='APPROVED' WHERE QUOTE_HEADER_ID = '".$QUOTE_HEADER_ID."'";
  $userstatus1= oci_parse($conn, $userstatus);
  oci_execute($userstatus1);

  $msg="SELECT * FROM XX_QUOTE_HEADERS_ALL WHERE QUOTE_HEADER_ID= '".$QUOTE_HEADER_ID."' ";
  $msgs= oci_parse($conn,$msg);
  oci_execute($msgs);
  $msgsuccess=oci_fetch_array($msgs,OCI_ASSOC);
  $msge=$msgsuccess['ASSESSMENT_NUMBER'];
  $Message = "You Just Approved <strong>$msge</strong>";
  header("Location: ../index1.php?Message={$Message}");
  die();

}

else
{

  $j=0;

   while($resultCheck1 = oci_fetch_array($result2,OCI_ASSOC)):

   $SEQ_NO[$j]=$resultCheck1['SEQUENCE_NO'];
   $j++;

   endwhile;

 $k=0;
 $l=-1;
  while($resCheck2 = oci_fetch_array($res,OCI_ASSOC)):

    $k++;

   if ($resCheck2['SEQUENCE_NO'] == $result55['SEQUENCE_NO'] )
   {



    $sql = "UPDATE XX_QUOTE_APPROVAL_LIST_ALL  SET PERFORM_ACTIVITY_TYPE_CODE='P', CURRENT_RECORD_FLAG='Y',FORWARED_FLAG='N',LAST_UPDATED_BY='".$NAME."',LAST_UPDATE_DATE=sysdate WHERE QUOTE_HEADER_ID = '".$QUOTE_HEADER_ID."' AND SEQUENCE_NO ='".$SEQ_NO[$k]."' ";

    $result1= oci_parse($conn, $sql);
    oci_execute($result1);


    $updatedby="UPDATE XX_QUOTE_APPROVAL_LIST_ALL  SET LAST_UPDATED_BY='".$NAME."',LAST_UPDATE_DATE=sysdate WHERE QUOTE_HEADER_ID = '".$QUOTE_HEADER_ID."' AND EMPLOYEE_ID='".$NAME."' AND SEQUENCE_NO='".$SEQUENCE_NO."'";
    $updatedby1= oci_parse($conn,$updatedby);
    oci_execute($updatedby1);

    $updatenotifi ="UPDATE actions SET COMMENT_STATUS=1 WHERE QUOTE_HEADER_ID = '".$QUOTE_HEADER_ID."' AND SEQUENCE_NO ='".$SEQ_NO[$l]."'";
    $updatenotifi1 = oci_parse($conn, $updatenotifi );
    oci_execute($updatenotifi1);


  }
  $l++;

  endwhile;


  $msg="SELECT * FROM XX_QUOTE_HEADERS_ALL WHERE QUOTE_HEADER_ID= '".$QUOTE_HEADER_ID."' ";
  $msgs= oci_parse($conn,$msg);
  oci_execute($msgs);
  $msgsuccess=oci_fetch_array($msgs,OCI_ASSOC);
  $msge=$msgsuccess['ASSESSMENT_NUMBER'];
  $Message = "You Just Supported <strong>$msge</strong>";
  header("Location: ../index1.php?Message={$Message}");
  die();

     }
   }
  }
}


?>
