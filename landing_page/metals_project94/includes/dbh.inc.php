<?php


$db = "(DESCRIPTION=(ADDRESS_LIST = (ADDRESS = (PROTOCOL = TCP)(HOST = 27.147.134.3)(PORT = 1542)))(CONNECT_DATA=(Service_Name=TEST2)))" ;

   $conn = OCILogon('APPS', 'ProdMet56', $db, 'AL32UTF8');

  ?>
