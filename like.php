<?php
include_once 'connect.php';
session_start();
$pseudonyme = $_SESSION['pseudonyme'];
$choix = $_GET['choix'];
$id_commentaire = $_GET['id_commentaire'];
$result = $dbPDO->query("SELECT choix FROM likes WHERE objet='$id_commentaire' AND liker ='$pseudonyme'");

$count = $result->rowCount();

echo $count;

	if($count==0){
		echo"sf";
		$resultlike = $dbPDO->query("INSERT INTO likes VALUES ('$id_commentaire','$pseudonyme','$choix')");
		if (!$resultlike) {
		  echo "Une erreur s'est produite.\n";
		  exit;
		}
	}else{
		echo "sip";
		$resultsup = $dbPDO->query("DELETE FROM likes WHERE objet='$id_commentaire' AND liker ='$pseudonyme'");//s'il a fait déjà like ou dislike, la deuxième fois prise comme l'annulation.		
	}

header('Location:afficher_photo.php?id_photo= '.$_GET['id_photo'].' ');
?>
