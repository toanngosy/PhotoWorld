
<?php
include_once 'connect.php';

session_start();
$pseudonyme = $_SESSION['pseudonyme'];

?>
<html>

    <head>
		<meta charset="UTF-8">
		<title>Creer de album</title>
	</head>

 <form action="creer_album_realiser.php" method="post">
<center>
<h1> Allez creez l'album </h1>
</center>
<div>
	<label for="titre">Titre :</label>
	<input type="text"  name="titre" />
</div>
<div>
	<label for="legende">Légende :</label>
	<input type="text"  name="legende" />
</div>

<input type="submit" name="envoyer">


</form>
</html>
