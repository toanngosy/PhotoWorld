<?php

include_once 'connect.php';
isset($_GET['id_album']) ? $id_album = $_GET['id_album'] : $id_album = null;
session_start();
$pseudonyme = $_SESSION['pseudonyme'];
 ?>

<html>

    <head>
		<meta charset="UTF-8">
		<title>Album</title>

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
<?php echo "<a href='creer_album.php'>Creez l'album</a>" ?>
<?php
$result = $dbPDO->query("SELECT titre,legende,id_album FROM album WHERE proprietaire='$pseudonyme'");
if (!$result) {
  echo "Une erreur s'est produite.\n";
  exit;
}
echo "<BR>Album que vous avez cree:<BR>";
echo "<TABLE>";
echo "<TR><TD>titre</TD><TD>legende</TD><TD>vignette</TD><TD></TD></TR>";
$rows = $result->fetchAll(PDO::FETCH_NUM);

foreach ($rows as $row) {
  $vignette = "";
  if ($row[2]){
	$res = $dbPDO->query("SELECT url FROM photo WHERE album = $row[2]");

  	$vignette = $res->fetchColumn(0);
  }
  echo "<TR>
  		<TD>$row[0]</TD>
  		<TD>$row[1]</TD>
  		<TD><a href='afficher_album.php?id_album=$row[2]'><img src='$vignette' alt='$row[1]' height='200' width='200'></a></TD>
  		<TD><a href='supprimer_album.php?id_album=$row[2]'>Supprimer</a></TD>
  		</TR>";
  echo "<br/>\n";
}
echo "</TABLE>";
?>

</html>
