<?php

include_once 'connect.php';

session_start();
$pseudonyme = $_SESSION['pseudonyme'];

	$ami = $_GET["ami"];
	
	$result = $dbPDO->query("DELETE FROM ami where (user1 = '$ami' and user2 = '$pseudonyme') or (user1 = '$pseudonyme' and user2 = '$ami')");
	
	if (!$result) {
	  echo "Une erreur s'est produite.\n";
	  exit;
	}else{
		echo "suppression avec success! <BR>";
		echo "<a href='ami.php'>retourner à la liste des amis</a>";
	}
?>
