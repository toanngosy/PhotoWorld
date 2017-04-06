<?php

include_once 'connect.php';

session_start();
$pseudonyme = $_SESSION['pseudonyme'];


    	$titre = $_POST['titre'];
  	$legende = $_POST['legende'];

	$quer = "INSERT INTO album VALUES (DEFAULT, '$titre','$pseudonyme','$legende')";
	$result = $dbPDO->query($quer);

	if (!$result) { echo " <br>Il y a eu une erreur. ";}
	else {echo  "La creation de album s'est bien passée.
	<a href='album.php'>retour</a>";
	}


?>
