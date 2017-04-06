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
<h1> Accepte d'ami </h1>
</center>
<?php
	$result = $dbPDO->query("SELECT user1 FROM attend_ami WHERE user2 = '$pseudonyme'");
	$rows = $result->fetchAll(PDO::FETCH_NUM);
	foreach ($rows as $row) {
		if (isset($_POST[$row[0]])){
			if ($_POST[$row[0]] == "Accepte"){
				$add_friend = $dbPDO->query("INSERT INTO ami VALUES ('$row[0]', '$pseudonyme')");
				$delete_fr_request = $dbPDO->query("DELETE FROM attend_ami WHERE user1='$row[0]' and user2='$pseudonyme'");
			}
			if ($_POST[$row[0]] == "Refuse"){
				$delete_fr_request = $dbPDO->query("DELETE FROM attend_ami WHERE user1='$row[0]' and user2='$pseudonyme'");
			}
		}
	}
?>



</form>

</html>
