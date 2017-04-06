<?php

include_once 'connect.php';

session_start();
$pseudonyme = $_SESSION['pseudonyme'];

	$id_album = $_GET["id_album"];

	$result1 = $dbPDO->query("UPDATE photo SET album = NULL WHERE (album = '$id_album')"); 
	$result2 = $dbPDO->query("DELETE FROM album WHERE (id_album = '$id_album')");
	if (!$result2 & !$result1) {
	  echo "Une erreur s'est produite.\n";
	  exit;
	}else{
		echo "suppression avec success! <BR>";
		echo "<a href='album.php'>retourner à la page album</a>";
	}
?>
