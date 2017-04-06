<?php

include_once 'connect.php';

$pseudonyme = pg_escape_string($_POST['pseudonyme']);

ini_set('session.gc_maxlifetime', '30000');
ini_set('session.gc_probability', '100');
ini_set('session.gc_divisor', '100');

session_start();
$_SESSION['pseudonyme'] = $pseudonyme;


$result = $dbPDO->query("select * from utilisateur where pseudonyme = '$pseudonyme' ");
if (!$result) {
  echo "Une erreur s'est produite.\n";
  exit;
}

$count = $result->rowCount();

if( $count == 0){
	header('Location:index.php');
}else{
    header('Location:frame.php');
    exit;
}
?>
