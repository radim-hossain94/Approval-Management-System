<?php
session_start();

session_unset();

header("Location: ../../../Metals_Project_Final_VER2/admin/includes/logout.inc.php");
