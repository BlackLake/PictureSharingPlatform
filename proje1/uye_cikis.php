<?php
session_start();
session_destroy();		//oturumu sonlandırmak
header("Location:index.php");
?>