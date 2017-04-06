<?php
include_once 'connect.php';

session_start();
$pseudonyme = $_SESSION['pseudonyme'];

?>
<html>
<title> soi</title>

<center>
<h1> Bienvenue sur le nouveau concurrent direct de Instagram! </h1>
</center>
<form action="soi_modifier.php" method="post">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
	$result = $dbPDO->query("SELECT pseudonyme, nom, prenom, email, age(dateNais), sex, pays, titre, statut_profil FROM utilisateur WHERE utilisateur.pseudonyme = '$pseudonyme'");
	$row = $result->fetch();
?>

	<div>
		<label for="nom">Nom :</label>
		<?php echo"$row[1] <BR>"; ?>
	</div>
	<div>
		<label for="prenom">Prénom :</label>
		<?php echo"$row[2] <BR>"; ?>
	</div>
	<div>
		<label for="email">Courriel :</label>
		<?php echo"$row[3] <BR>"; ?>
	</div>
	<div>
		<label for="age">Age :</label>
		<?php echo"$row[4] <BR>"; ?>
	</div>
	<div>
		<label for="sex">Genre:</label>
		<?php echo"$row[5] <BR>"; ?>
	</div>

	<div>
		<label for="pays">Pays :</label>
		<?php echo"$row[6] <BR>"; ?>
	</div>

	<div>
		<label for="titre">Titre :</label>
		<?php echo"$row[7] <BR>"; ?>
	</div>

	<div>
		<label for="statut">statut :</label>
		<?php echo"$row[8] <BR>"; ?>
	</div>

	<div class="button">
		<button type="submit">Modifier</button>
	</div>




</form>

</html>
