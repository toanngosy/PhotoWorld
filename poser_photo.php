
<?php
include_once 'connect.php';

session_start();
$pseudonyme = $_SESSION['pseudonyme'];

?>
<html>

   	 <head>
		<meta charset="UTF-8">
		<title>poser photo</title>
	</head>

 <form action="poser_photo_realiser.php" method="post">
<center>
<h1> Allez posez la photo </h1>
</center>
<div>
	<label for="titre">Titre :</label>
	<input type="text"  name="titre" />
</div>
<div>
	<label for="legende">Légende :</label>
	<input type="text"  name="legende" />
</div>
<div>
	<label for="url">Url :</label>
	<input type="text"  name="url" />
</div>
<div>
	<label for="format">Format :</label>
	<input type="text"  name="format" />
</div>


<?php
$result = $dbPDO->query("SELECT id_album ,titre FROM album WHERE proprietaire ='$pseudonyme'");
if (!$result) {
  echo "Une erreur s'est produite.\n";
  exit;
}
echo " Album : ";
echo " <select name='album'> ";
$rows = $result->fetchAll(PDO::FETCH_NUM);
foreach ($rows as $row) {
	echo"<option value = $row[0]>$row[1] </option>";
echo "<br />\n";
}
echo "<option value = NULL >Pas d'album</option>";
echo "</select>";
?>
<input type="submit" name="Envoyer">


</form>
</html>
