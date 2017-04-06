<?php
include_once 'connect.php';

session_start();
$pseudonyme = $_SESSION['pseudonyme'];


        $titre = $_POST['titre'];
        $statut = $_POST['statut'];

$quer = "UPDATE utilisateur SET titre ='$titre', statut_profil='$statut' WHERE pseudonyme = '$pseudonyme'";
$result =$dbPDO->query($quer);

if (!$result) { echo "<br>pas bon";}
else{
	echo "modifie!<br>";
	echo "<a href='soi.php'>Retour</a>";
}

?>
