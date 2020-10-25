<?php
session_start();

include "dbh.inc.php";

$description_field = $_POST["description_field"];

?>
<body>

  <select name="INVENTORY_ITEM_ID" id="INVENTORY_ITEM_ID">

    <option value="">Select</option>
  <?php
  $sql = "SELECT ORGANIZATION_ID,inventory_item_id,
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
and ORGANIZATION_ID = '".$_SESSION['ORGANIZATION_ID']."'
AND description LIKE '%".$description_field."%'
order by 2";

  $result1= oci_parse($conn, $sql);
  oci_execute($result1);
  while($row1 =oci_fetch_array($result1,OCI_ASSOC)): ?>
  <option value=" <?php echo  $row1['INVENTORY_ITEM_ID'];  ?>"> <?php echo $row1['DESCRIPTION']; ?>  ---------> <?php echo $row1['ITEM_CODE']; ?> </option>
  <?php

  endwhile;
  ?>

  </select>
</body>
