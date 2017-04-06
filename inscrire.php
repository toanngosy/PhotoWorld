<?php

include_once 'connect.php';

$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$pseudonyme = $_POST['pseudonyme'];
$sex = $_POST['sex'];
$titre = $_POST['titre'];
$email = $_POST['email'];
$dateNaiss = $_POST['dateNaiss'];
$pays = $_POST['pays'];


$query = "insert into utilisateur values ('$pseudonyme', '$nom', '$prenom', '$email','$dateNaiss', '$sex','$pays','$titre','Public')";
$result = $dbPDO->query($query);
if (!$result) {
	echo "Une erreur s'est produite.\n";
	exit;
}else{
	echo "Inscription avec success";
	echo "<a href ='index.php'>retour</a>";
}
?>
<html>
<meta charset="UTF-8">


<title> Inscrire</title>

 <?php

 ?>

</form>

</html>
