<?php
include_once 'connect.php';
session_start();
$pseudonyme = $_SESSION['pseudonyme'];
$ami=$_GET['ami'];

$qry1 = "SELECT  *	FROM ami WHERE (user1 = '$pseudonyme' and user2 = '$ami' )or (user2 = '$pseudonyme' and user1 = '$ami');";
$result1 = $dbPDO->query($qry1);
$count1 = $result1->rowCount();
$qry2 = "SELECT  *	FROM attend_ami WHERE (user1 = '$pseudonyme' and user2 = '$ami' )or (user2 = '$pseudonyme' and user1 = '$ami');";
$result2 = $dbPDO->query($qry2);
$count2 = $result2->rowCount();

if($count1!=0){
	echo "vous etes deja amis";
	exit;
} 
if($count2!=0){
    echo "la demande est en cours de traiter, qui ne peut se faire qu'une fois";
	exit;
}
$qry3 = "INSERT INTO attend_ami VALUES ('$pseudonyme','$ami')";
$result3 = $dbPDO->query($qry3);
if (!$result3) {
	 print_r($qry3);
	 echo "Une erreur s'est produite.\n";
	 exit;
}else{
	echo "demande envoyée";
}


 ?>
 <html>
 <meta charset="UTF-8">
 <a href="recherche.php"> retour </a>
 </html>