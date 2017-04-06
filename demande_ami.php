<?php
include_once 'connect.php';

session_start();
$pseudonyme = $_SESSION['pseudonyme'];

?>
<html>
<title>Demande d'ami</title>

<center>
<h1> Bienvenue sur le nouveau concurrent direct de Instagram! </h1>
</center>
<form action="demande_ami_realiser.php" method="post">
<center>
<h1> Demande d'ami en attente </h1>
</center>
<?php
	$result = $dbPDO->query("SELECT user1 FROM attend_ami WHERE user2 = '$pseudonyme'");

	$rows = $result->fetchAll(PDO::FETCH_NUM);
	if ($rows == 0){
	echo "Il n'y a pas de demande d'ami";
	}
	else{
		//create a table of request with 2 button accept and resuse
		echo "<TABLE>";
		echo "<TR><TD>Utilisateur</TD><TD>Accepte</TD><TD>Refuse</TD></TR>";
		foreach ($rows as $row) {
  		echo "<TR>
  		<TD>$row[0]</TD>
  		<TD><input type='radio' name='$row[0]' value='Accepte'></TD>
  		<TD><input type='radio' name='$row[0]' value='Refuse'></TD>
  		</TR>";
  		echo "<br/>\n";
		}
	echo "</TABLE>";
	echo "<input type='submit' name='envoyer'>";
	}

?>



</form>

</html>
