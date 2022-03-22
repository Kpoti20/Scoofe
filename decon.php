<?php
session_start();
$_SESSION = array();
session_destroy();
header("Location:index_connexion_parent.php");

?>