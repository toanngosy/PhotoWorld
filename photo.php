<?php
include_once 'connect.php';

session_start();
$pseudonyme = $_SESSION['pseudonyme'];

?>
<html>

    <head>
		<meta charset="UTF-8">
		<title>photo</title>

		<style>
		table, th, td {
			border: 1px solid black;
			border-collapse: collapse;
		}
		th, td {
			padding: 10px;
		}
		</style>
	</head>


<center>
<h1> Bienvenue sur le nouveau concurrent direct de Instagram! </h1>
</center>
<?php echo "<a href='poser_photo.php'>Posez la photo</a>" ?>
<?php
$result = $dbPDO->query("SELECT titre,legende,url,format,album, id_photo FROM photo,likable_objet WHERE photo.id_photo=likable_objet.id and likable_objet.auteur='$pseudonyme'");
if (!$result) {
  echo "Une erreur s'est produite.\n";
  exit;
}
echo "<BR>Photo que vous avez ajoute:<BR>";
echo "<TABLE>";
echo "<TR><TD>titre</TD><TD>legende</TD><TD>image</TD><TD>album</TD><TD></TD></TR>";
$rows = $result->fetchAll(PDO::FETCH_NUM);
foreach ($rows as $row) {
  $nomAlbum = "";
  if ($row[4]){
	$res = $dbPDO->query("SELECT titre FROM album WHERE album.id_album = $row[4]");
	$nomAlbum = $res->fetchColumn(0);

	//$vignette = $res->fetchColumn(0);
  }
  echo "<TR>
  		<TD>$row[0]</TD>
  		<TD>$row[1]</TD>
  		<TD><a href='afficher_photo.php?id_photo=$row[5]'><img src='$row[2]' alt='$row[1]' height='200' width='200'></a></TD>
  		<TD><a href='afficher_album.php?id_album=$row[4]'> $nomAlbum </a></TD>
  		<TD><a href='supprimer_photo.php?id_photo=$row[5]'>Supprimer</a></TD>
  		</TR>";
  echo "<br/>\n";
}
echo "</TABLE>";
?>

</html>
