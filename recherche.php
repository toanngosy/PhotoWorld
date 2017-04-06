<?php
include_once 'connect.php';

session_start();
$pseudonyme = $_SESSION['pseudonyme'];

if (isset($_POST['pseudonyme'])){
	if($_POST['pseudonyme']==$pseudonyme){
		echo "coucou, c'est vous meme~~ <BR>";
		echo "<a href='recherche.php'> retour </a>";
		exit;
	}
	$qry = "SELECT pseudonyme,statut_profil from utilisateur where lower(pseudonyme) LIKE lower('%".$_POST['pseudonyme']."%')";
	$result = $dbPDO->query($qry);
	if (!$result) {
	  print_r($qry);
	  echo "Une erreur s'est produite.\n";
	  exit;
	}
	$rows = $result->fetchAll(PDO::FETCH_ASSOC);
	foreach ($rows as $row){
		if($row['statut_profil']=='Public'){
	
				echo '<a href=ami_photo.php?ami='.$row['pseudonyme'].' target="acceuil">'.$row['pseudonyme'].'</a>';
				echo "  ";
				echo '<a href=ami_demander.php?ami='.$row['pseudonyme'].'> Ajouter </a>';
				echo '<br/>';
			
		}else{
			
				echo "" . $row['pseudonyme'] . " est privé";
				echo '<a href=ami_demander.php?ami='.$row['pseudonyme'].'> Ajouter </a>';
				echo '<br/>';
			
		}
	}
}
 ?>
 <html>
 <form action="recherche.php" method="post">
 <meta charset="UTF-8">
 <div>
         <label for="pseudonyme">pseudo:</label>
         <input type="text" name="pseudonyme" />
 </div>
  	<div class="button">
         <button type="submit">Rechercher</button>
     </div>
 </form>
 <a href="recherche.php"> retour </a>
</html>