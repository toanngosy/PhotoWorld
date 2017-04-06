<?php

include_once 'connect.php';

session_start();
$pseudonyme = $_SESSION['pseudonyme'];

	$id_photo = $_GET["id_photo"];
	//check if photo is vignette of album
	$id_album = 0;
	$result = $dbPDO->query("SELECT id_album FROM album WHERE (vignette = '$id_photo' ) ");
	if ($result->rowCount()>0){
		$row = pg_fetch_row($result);
		$id_album=$row[0];
		$result = $dbPDO->query("UPDATE album SET vignette = 'NULL' WHERE (vignette = '$id_photo' ) ");
	}
	//delete photo
	$result1 = $dbPDO->query("DELETE FROM photo where (id_photo = '$id_photo' ) ");
	$result2 = $dbPDO->query("DELETE FROM likable_objet where (id = '$id_photo' ) ");
	//update vignette
	if ($id_album != 0){
		$result = $dbPDO->query("SELECT id_photo FROM photo where (album = '$id_album' ) ");
		$row = pg_fetch_row($result);
		if ($row){
			$result = $dbPDO->query("UPDATE album SET vignette ='$row[0]' WHERE (album = '$id_album' ) ");}
	}
	//
	if (!$result1&!$result2) {
	  echo "Une erreur s'est produite.\n";
	  exit;
	}else{
		echo "suppression avec success! <BR>";
		echo "<a href='photo.php'>retourner à la page photo</a>";
	}
	
	$id_photo = $_GET['id_photo'];
?>
