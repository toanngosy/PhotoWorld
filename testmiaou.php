<?php
include_once 'connect.php';

 ?>
<html>

    <head>
		<meta charset="UTF-8">
		<title>MIAOU</title>

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

<title> MIAOU</title>


<?php
$result = $dbPDO->query("SELECT * from photo");
if (!$result) {
  echo "Une erreur s'est produite.\n";
  exit;
}
$rows = $result->fetchAll(PDO::FETCH_ASSOC);
echo "<BR>Photos:<BR>";
echo "<TABLE>";
echo "<TR><TD>titre</TD><TD>legende</TD><TD>url</TD><TD>format</TD><TD>album</TD><TD></TD></TR>";
foreach ($rows as $row) {
  echo "<TR><TD>$row[titre]</TD><TD>$row[legende]</TD><TD>$row[url]</TD><TD>$row[format]</TD><TD>$row[album]</TD><TD><a href='supprimer_photo.php?idseance=$row[id_photo]'>Supprimer</a></TD></TR>";
  echo "<br />\n";
}
echo "</TABLE>";
?>


<?php echo "<a href='poser_photo.php'>Posez la photo</a>" ?>
</html>
