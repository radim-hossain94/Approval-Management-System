<?php
session_start();

include "dbh.inc.php";

$quote_status = $_POST["quote_status"];

?>
<!DOCTYPE html>
<html lang="en">
<body>



<table class="table table-striped table-dark">
<tr>
            <th>ASSESSMENT NUMBER</th>

            <th>APPLICANT NAME</th>
            <th>QUOTE NUMBER</th>
            <th>QUOTE NAME</th>
            <th>QUOTE DATE</th>
            <th colspan="2">QUOTE STATUS</th>

        </tr>
<?php
error_reporting(0);
$query = "select HA.ASSESSMENT_NUMBER,
  CUSTOMER_ID,
  APPLICANT_NAME,
  QUOTE_NUMBER,
  QUOTE_NAME,
  QUOTE_DATE,
  QUOTE_STATUS
  from
  XX_ONT_APPLICANT_DETAILS AD
  INNER JOIN
  XX_QUOTE_HEADERS_ALL HA ON
  AD.ASSESSMENT_ID = HA.ASSESSMENT_NUMBER
  WHERE HA.CREATED_BY = '".$_SESSION['u_id']."' AND QUOTE_STATUS= '".$quote_status."'  ";

$result= oci_parse($conn, $query);
oci_execute($result);




            while($row1 =oci_fetch_array($result,OCI_ASSOC)):

        ?>
        <tr>

        <td><?php echo $row1['ASSESSMENT_NUMBER'];?></td>

        <td><?php echo $row1['APPLICANT_NAME'];?></td>
        <td><?php echo $row1['QUOTE_NUMBER'];?></td>
        <td><?php echo $row1['QUOTE_NAME'];?></td>
        <td><?php echo $row1['QUOTE_DATE'];?></td>
        <td><?php if ($row1['QUOTE_STATUS']=="PENDING") {
          echo "In Process";

        }
        else {
          echo $row1['QUOTE_STATUS'];
          } ?></td>
        <?php if($row1['QUOTE_STATUS']=="PENDING"){ ?>
        <form action="view_track_form.php" method="post">
        <input type="hidden" name="ASSESSMENT_NUMBER" value="<?php $ASSESSMENT_NUMBER = $row1['ASSESSMENT_NUMBER']; echo $ASSESSMENT_NUMBER;  ?>">
        <td> <a href="view_track_form.php?ASSESSMENT_NUMBER=<?php echo $row1['ASSESSMENT_NUMBER'];  ?>"><button type="submit" class="btn btn-success">Show Status</button></a> </td>
        </form>
        <?php } ?>
        <?php if($row1['QUOTE_STATUS']=="APPROVED") {?>
        <form action="placeorder.php" method="post">
        <input type="hidden" name="ASSESSMENT_NUMBER" value="<?php $ASSESSMENT_NUMBER = $row1['ASSESSMENT_NUMBER']; echo $ASSESSMENT_NUMBER;  ?>">
        <td> <a href="placeorder.php?ASSESSMENT_NUMBER=<?php echo $row1['ASSESSMENT_NUMBER'];  ?>"><button type="submit" class="btn btn-success">Show Status</button></a> </td>

        </form>
      <?php } ?>
        <?php if($row1['QUOTE_STATUS']=="DRAFT") {?>
        <form action="preview_saved.php" method="post">
        <input type="hidden" name="ASSESSMENT_NUMBER" value="<?php $ASSESSMENT_NUMBER = $row1['ASSESSMENT_NUMBER']; echo $ASSESSMENT_NUMBER;  ?>">
        <td> <a href="preview_saved.php?ASSESSMENT_NUMBER=<?php echo $row1['ASSESSMENT_NUMBER'];  ?>"><button type="submit" class="btn btn-success">View Saved Assessment Form</button></a> </td>

        </form>
        <?php }
        elseif($row1['QUOTE_STATUS']=="REJECTED"){?>
        <form action="#" method="post">
        <input type="hidden" name="ASSESSMENT_NUMBER" value="<?php $ASSESSMENT_NUMBER = $row1['ASSESSMENT_NUMBER']; echo $ASSESSMENT_NUMBER;  ?>">
        <td> <a href="view_track_form.php?ASSESSMENT_NUMBER=<?php echo $row1['ASSESSMENT_NUMBER'];  ?>"><button type="submit" class="btn btn-success">Show Status</button></a> </td>

        </form>
      <?php  } ?>

    </tr>
        <?php endwhile; ?>

</table>

</body>
</html>
