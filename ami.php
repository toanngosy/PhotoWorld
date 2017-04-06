<?php
include_once 'connect.php';

session_start();
$pseudonyme = $_SESSION['pseudonyme'];

?>
<html>
<head>
		<meta charset="UTF-8">
		<title>ami</title>

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
<body>
<?php
$result1 = $dbPDO->query("SELECT user1 FROM ami WHERE user2= '$pseudonyme'");
if (!$result1) {
  echo "Une erreur s'est produite.\n";
  exit;
}
$result2 = $dbPDO->query("SELECT user2 FROM ami WHERE user1= '$pseudonyme'");
if (!$result2) {
  echo "Une erreur s'est produite.\n";
  exit;
}

$rows1 = $result1->fetchAll(PDO::FETCH_ASSOC);
$rows2 = $result2->fetchAll(PDO::FETCH_ASSOC);


echo "<BR>Amis:<BR>";
echo "<TABLE>";
echo "<TR><TD>pseudonyme</TD><TD></TD></TR>";
foreach ($rows1 as $row) {
  echo "<TR><TD><a href='ami_photo.php?ami=$row[user1]'>$row[user1]</a></TD><TD><a href='supprimer_ami.php?ami=$row[user1]'>Supprimer</a></TD></TR>";
  echo "<br />\n";
}
foreach ($rows2 as $row) {
  echo "<TR><TD><a href='ami_photo.php?ami=$row[user2]'>$row[user2]</a></TD><TD><a href='supprimer_ami.php?ami=$row[user2]'>Supprimer</a></TD></TR>";
  echo "<br />\n";
}
echo "</TABLE>";
?>
</body>
</html>
