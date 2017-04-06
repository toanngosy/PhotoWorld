<?php

include_once 'connect.php';

session_start();
$pseudonyme = $_SESSION['pseudonyme'];


    $titre = $_POST['titre'];
    $url = $_POST['url'];
  	$legende = $_POST['legende'];
 	$format = $_POST['format'];

	$album = $_POST['album'];

$quer = "insert into likable_objet values (default, '$pseudonyme')";
$result = $dbPDO->query($quer);




$nb = $dbPDO->query("SELECT id FROM likable_objet ORDER BY id DESC");

$row = $nb->fetchColumn();

echo $album;
//echo "$row";
if($album== 'NULL'){
	
	$query = "insert into photo values ('$row', '$titre', '$legende', '$url','$format','' )";
	$resu = $dbPDO->query($query);
}
else{

	$query = "insert into photo values ('$row', '$titre', '$legende', '$url','$format', '$album')";
	$resu =$dbPDO->query($query);
	$quer_album = "SELECT vignette FROM album WHERE id_album = '$album'";
	$result = $dbPDO->query($quer_album);


	if ($result->fetchColumn(0) == "NULL"){
		$quer_album = "UPDATE album SET vignette = '$row' WHERE id_album = '$album'";
		$result =$dbPDO->query($quer_album);
	}
}



if (!$resu) { echo " <br>Il y a eu une erreur. ";}
else {echo  "L'insertion d'image s'est bien passée.
	<a href='poser_photo.php'>retour</a>";
}


?>
