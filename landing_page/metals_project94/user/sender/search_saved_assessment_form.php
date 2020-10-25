<?php
session_start();

include "dbh.inc.php";

$ASSESSMENT_NUMBER = $_POST["ASSESSMENT_NUMBER"];

?>
<!DOCTYPE html>
<html lang="en">
<body>



<table class="table table-striped table-dark">
<tr>
            <th>ASSESSMENT NUMBER</th>
            <th>ORGANIZATION_ID</th>
            <th>QUOTE_NUMBER</th>
            <th>QUOTE NAME</th>
            <th>QUOTE DATE</th>
            <th colspan="2">QUOTE STATUS</th>
        </tr>
<?php
error_reporting(0);
$query = "SELECT * FROM XX_QUOTE_HEADERS_ALL WHERE QUOTE_STATUS = 'DRAFT' AND ORG_ID = '".$_SESSION['ORG_ID']."' AND CREATED_BY = '".$_SESSION['u_id']."' AND ASSESSMENT_NUMBER LIKE '%".$ASSESSMENT_NUMBER."%' ";

$result= oci_parse($conn, $query);
oci_execute($result);




            while($row =oci_fetch_array($result,OCI_ASSOC)):

        ?>
        <tr>


        <td><?php echo $row['ASSESSMENT_NUMBER']; ?></td>
        <td><?php echo $row['ORGANIZATION_ID']; ?></td>
        <td><?php echo $row['QUOTE_NUMBER']; ?></td>
        <td><?php echo $row['QUOTE_NAME']; ?></td>
        <td><?php echo $row['QUOTE_DATE']; ?></td>
        <td><?php echo $row['QUOTE_STATUS']; ?></td>
        <td><a href="preview_saved.php?ASSESSMENT_NUMBER=<?php echo $row['ASSESSMENT_NUMBER']; ?>"><button type="button" class="btn btn-success">View</button></a></td>
        </tr>
        <?php endwhile; ?>

</table>

</body>
</html>
