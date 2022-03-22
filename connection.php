<?php
	$conn=mysql_connect("127.0.0.1", "root", "") or die(mysql_error());
	mysql_select_db("scolariteweb", $conn) or die(mysql_error());
?>