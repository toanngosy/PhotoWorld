<?php
include_once 'connect.php';
session_start();
$pseudonyme = $_SESSION['pseudonyme'];
$id_photo = $_GET['id_photo'];
$choix_photo=$_POST['choix_photo'];
$resultat=$dbPDO->query("SELECT * FROM likes WHERE objet='$id_photo' AND liker='$pseudonyme'");
$count = $resultat->rowCount();
if($count==0){
		
		$resultlike = $dbPDO->query("INSERT INTO likes VALUES ('$id_photo','$pseudonyme','$choix_photo')");
		if (!$resultlike) {
		  echo "Une erreur s'est produite.\n";
		  exit;
		}
	}else{
		
		$resultsup = $dbPDO->query("DELETE FROM likes WHERE objet='$id_photo' AND liker ='$pseudonyme'");
	}




header('Location:afficher_photo.php?id_photo= '.$_GET['id_photo'].' ');

?>
