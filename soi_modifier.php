<?php
include_once 'connect.php';

session_start();
$pseudonyme = $_SESSION['pseudonyme'];

?>
<html>
<title>soi modifier</title>

<center>
<h1> Bienvenue sur le nouveau concurrent direct de Instagram! </h1>
</center>
<form action="soi_poser_realiser.php" method="post">
<center>
<h1> Allez posez la photo </h1>
</center>
<div>
	<label for="titre">Titre :</label>
	<input type="text"  name="titre" />
</div>

<input type="radio" name="statut" value="Public"> Public<br>
<input type="radio" name="statut" value="Prive" checked> Prive<br>
<input type="submit" name="envoyer">


</form>

</html>
