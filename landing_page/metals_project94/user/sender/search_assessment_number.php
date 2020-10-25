<?php
session_start();

include "dbh.inc.php";

$ASSESSMENT_ID = $_POST["ASSESSMENT_ID"];

?>
<!DOCTYPE html>
<html lang="en">

<body>



<table class="table table-striped table-dark">
         <tr style="color: white; " class="bg-success">
            <th>Assessment Number</th>
            <th>Customer Number</th>
            <th>Customer Name</th>
            <th colspan="2">Quote Status</th>
        </tr>
<?php
error_reporting(0);
$query = "SELECT AD.ASSESSMENT_ID,
       CUSTOMER_NUMBER,
       CUSTOMER_NAME,
       'Not Submitted' QUOTE_STATUS
  FROM XX_ONT_APPLICANT_DETAILS AD,
       OE_ORDER_HEADERS_ALL OH,
       AR_CUSTOMERS_ALL_V CUST
 WHERE     AD.ORDER_NUMBER = OH.ORDER_NUMBER
       AND AD.ORG_ID = OH.ORG_ID
       AND NOT EXISTS
              (SELECT 1
                 FROM XX_QUOTE_HEADERS_ALL HA
                WHERE AD.ASSESSMENT_ID = HA.ASSESSMENT_NUMBER)
       AND OH.SOLD_TO_ORG_ID = CUST.CUSTOMER_ID
       AND AD.ORG_ID = '".$_SESSION['ORG_ID']."'
       AND OH.SHIP_FROM_ORG_ID = '".$_SESSION['ORGANIZATION_ID']."'
       AND ASSESSMENT_ID LIKE '%".$ASSESSMENT_ID."%' ";

$result= oci_parse($conn, $query);
oci_execute($result);




            while($row =oci_fetch_array($result,OCI_ASSOC)):

        ?>
        <tr>


            <td><?php echo $row['ASSESSMENT_ID'];?></td>
            <td><?php echo $row['CUSTOMER_NUMBER'];?></td>
            <td><?php echo $row['CUSTOMER_NAME'];?></td>


            <?php
            if($row['QUOTE_STATUS'] == "PENDING"){ ?>
                <td><?php echo "IN PROCESS"?></td>
                <td></td>
            <?php }
            elseif($row['QUOTE_STATUS'] == "APPROVED" || $row['QUOTE_STATUS'] == "REJECTED"){ ?>

                <td><?php echo $row['QUOTE_STATUS']; ?></td>
                <td></td>
            <?php }
            elseif($row['QUOTE_STATUS'] == "DRAFTED"){ ?>

                <td><?php echo $row['QUOTE_STATUS']; ?></td>
                <td><a href="page1.php"><button type="button" class="btn btn-success">View</button></a></td>
            <?php }
            else{ ?>
                <td><?php echo "Not Submitted"; ?></td>


                <td><a href="page1.php?ASSESSMENT_NUMBER=<?php echo $row['ASSESSMENT_ID']; ?>"><button type="button" class="btn btn-success">View</button></a></td>

            <?php } ?>
        </tr>

        <?php
        endwhile;
        ?>

</table>

</body>
</html>
