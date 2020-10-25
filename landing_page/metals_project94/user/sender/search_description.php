<?php
session_start();

include "dbh.inc.php";

$DESCRIPTION = $_POST["description"];


?>

<table class="table table-striped table-dark">
         <tr>
            <th>Inventory Item Id</th>
            <th>Description</th>
            <th>UOM</th>
            <th>Action</th>
        </tr>
<?php
error_reporting(0);

$query = "SELECT inventory_item_id,
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
AND ORGANIZATION_ID = '".$_SESSION['ORGANIZATION_ID']."'
AND DESCRIPTION LIKE '%".$DESCRIPTION."%'
ORDER BY 2 ";

$result= oci_parse($conn, $query);
oci_execute($result);



       
            while($row =oci_fetch_array($result,OCI_ASSOC)):

        ?>