<?php

	include_once 'config.php';

	$str = sprintf("pgsql:host=%s;port=%d;dbname=%s;user=%s;password=%s",
	$host,
	$port,
	$database,
	$user,
	$password);

	$dbPDO = new PDO($str);

?>
