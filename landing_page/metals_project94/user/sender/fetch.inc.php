<?php
session_start();

include "dbh.inc.php";

?>


<table class="table-responsive-md" id="last_table" width="90%">
<tr bgcolor="#F174F7">

<td colspan = "7">Quote Lines</TD>

</TR>
<TR>

<TD style="width: 100px;">Line No.</TD>
<TD>Order Item ID</TD>

<TD>Quantity</TD>
<TD>UOM</TD>
<TD>Unit Selling Price</TD>
<TD>Unit List Price</TD>
</TR>
<?php
$i = 0;
$sql = "select * from XX_QUOTE_LINES_ALL where ASSESSMENT_NUMBER = '".$_SESSION['ASSESSMENT_NUMBER']."' order by LINE_NO ASC";
          $result1= oci_parse($conn, $sql);
          oci_execute($result1);

           while($row =oci_fetch_array($result1,OCI_ASSOC)):
            $i = $i + 1;
             $INVENTORY_ITEM_ID= $row['INVENTORY_ITEM_ID'];


          $sql3="SELECT inventory_item_id,item_code,description,
                 PRIMARY_UOM_CODE FROM (SELECT ORGANIZATION_ID,inventory_item_id,
                 segment1 || '.' || segment2 || '.' || segment3 || '.' || segment4
                    item_code,
                 description,
                 PRIMARY_UOM_CODE
            FROM MTL_SYSTEM_ITEMS_B
           WHERE     INVENTORY_ITEM_FLAG = 'Y'
                 AND ENABLED_FLAG = 'Y'
                 AND CUSTOMER_ORDER_ENABLED_FLAG = 'Y'
                 AND SO_TRANSACTIONS_FLAG = 'Y'
                 AND SHIPPABLE_ITEM_FLAG = 'Y'
                 AND INVOICE_ENABLED_FLAG = 'Y'
          UNION ALL
          SELECT ORGANIZATION_ID,inventory_item_id,
                 segment1 || '.' || segment2 || '.' || segment3 || '.' || segment4
                    item_code,
                 description,
                 PRIMARY_UOM_CODE
            FROM MTL_SYSTEM_ITEMS_B
           WHERE     ENABLED_FLAG = 'Y'
                 AND CUSTOMER_ORDER_ENABLED_FLAG = 'Y'
                 AND INVOICE_ENABLED_FLAG = 'Y'
                 AND segment4 = 'TRACREG')
                 WHERE inventory_item_id = '".$INVENTORY_ITEM_ID."'
                 AND ORGANIZATION_ID = '".$_SESSION["ORGANIZATION_ID"]."'
                 ORDER BY 2";

          $result3= oci_parse($conn, $sql3);
          oci_execute($result3);

           while($row3 =oci_fetch_array($result3,OCI_ASSOC)):

?>

<TR>

  <TD ><INPUT style="width: 60px;" type="text" name="" id="" value="<?php echo $i; ?>" disabled/><INPUT type="hidden" name="LINE_NO" id="LINE_NO" value="<?php echo $row["LINE_NO"]; ?>" disabled/></TD>

  <TD>
    <INPUT style="width: 350px;" type="text" name="" value="<?php echo $row3["ITEM_CODE"]; ?>" disabled/>
  </TD>
  <TD>
    <INPUT type="text" name="QUANTITY" id="QUANTITY" value="<?php echo $row["QUANTITY"]; ?>" disabled/>
  </TD>
  <TD>
    <INPUT type="text" name="UNIT_OF_MEASURE" id="UNIT_OF_MEASURE" value="<?php echo $row["UNIT_OF_MEASURE"]; ?>" disabled/>
  </TD>
  <TD>
    <INPUT type="text" name="UNIT_SELLING_PRICE" id="UNIT_SELLING_PRICE" value="<?php echo $row["UNIT_SELLING_PRICE"]; ?>" disabled/>
  </TD>
  <TD>
    <INPUT type="text" name="UNIT_LIST_PRPICE"  id="" value="<?php echo $row["UNIT_LIST_PRPICE"]; ?>" disabled>
  </TD>

  <td><INPUT type="button" style="margin-left:20px;" onclick="deleteDATA(<?php echo $row['LINE_NO']; ?>)" class="btn btn-danger" value="Delete" /></td>

</TR>
<?php
endwhile;
endwhile;?>


</table>

<script>

function deleteDATA(rowID) {

var LINE_NO = rowID;
$("#DP_PERCENT_SESSION_FIELD").hide();
$("#ACTUAL_DP_AMOUNT_SESSION_FIELD").hide();
$("#interest_amount_field").hide();
  $("#monthly_installment_field").hide();
  $("#total_session_field").hide();
console.log(LINE_NO);
// var dp_amount = document.getElementById('dp_amount').value;
// var no_installment = document.getElementById('NO_OF_INSTALLMENT').value;

if(document.getElementById("dp_amount") && document.getElementById("dp_amount").value)
{
  dp_amount = document.getElementById("dp_amount").value;
}
else{
  dp_amount = 0;
}

if(document.getElementById("NO_OF_INSTALLMENT") && document.getElementById("NO_OF_INSTALLMENT").value)
{
  no_installment = document.getElementById("NO_OF_INSTALLMENT").value;
}
else{
  no_installment = 0;
}

$.ajax({
      url:"quotedelete.inc.php",
      type:"post",
      data:{LINE_NO:LINE_NO,dp_amount,no_installment},
      dataType: "json",
      success:function(r)
      {
        var len = r.length;


        for( var i = 0; i<len; i++){
          var dp_percent = r[i]['Dp_Percent'];
          var actual_dp = r[i]['Actual_Dp_Amount'];


          var total_interest_amount = r[i]['Total_Interest_Amount'];
          var total = r[i]['ToTaL'];
          var monthly_installment_amount = r[i]['Monthly_Installment_Amount'];

          }

        // var dp_percent = r['0'];
        // var actual_dp = r['1'];
        $("#dp_percent").empty();
        $("#dp_percent").append("<input name='DP_PERCENT' id='DP_PERCENT' class='form-control' value='"+dp_percent+"' disabled >" );
        //actual_dp_amount
        $("#actual_dp_amount").empty();
        $("#actual_dp_amount").html("<input name='ACTUAL_DP_AMOUNT' id='ACTUAL_DP_AMOUNT' class='form-control' type='text' value='"+actual_dp+"' disabled>" );



        $("#Interest_Amount").empty();
        $("#Interest_Amount").html("<input name='INTEREST_AMOUNT' class='form-control' type='text' value='"+total_interest_amount+"'  disabled>" );
        $("#Total").empty();
        $("#Total").html("<input name='TOTAL' class='form-control' type='text' value='"+total+"' disabled>" );
        $("#Monthly_Installment").empty();
        $("#Monthly_Installment").html("<input name='MONTHLY_INSTALLMENT_AMOUNT' class='form-control' type='text' value='"+monthly_installment_amount+"' disabled>" );

              }
          });

 }

 function updateDATA() {

var LINE_NO = document.getElementById('LINE_NO').value;
var QUANTITY = document.getElementById('QUANTITY').value;
//var UNIT_SELLING_PRICE = document.getElementById('UNIT_SELLING_PRICE').value;

$.ajax({
    url:"quotelineupdate.inc.php",
    method:"POST",
    data:{LINE_NO:LINE_NO,QUANTITY},
    dataType:"text",
    success:function(data)
    {
        // alert(data);
        // fetch_data();
    }
});

}


</script>
