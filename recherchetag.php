<?php
include_once 'connect.php';

session_start();

if (isset($_GET['tag'])){
	//$qry = "SELECT tag from tag where lower(tag) LIKE lower('%".$_GET['tag']."%')";
	$qry = "SELECT t.tag, t.commentaire, c.texte, c.photo FROM tag t JOIN Commentaire c ON t.commentaire = c.id_commentaire WHERE lower(tag) LIKE lower('%".$_GET['tag']."%')";
	$result = $dbPDO->query($qry);
	if (!$result) {
	  print_r($qry);
	  echo "Une erreur s'est produite.\n";
	  exit;
	}
	$rows = $result->fetchAll(PDO::FETCH_ASSOC);
	foreach ($rows as $row){
		echo "Commentaires taggés ".$row['tag']." :<br/>";
		echo '    <a href="afficher_photo.php?id_photo='.$row['photo'].'">'.$row['texte'].'</a><br/>';
	}
}
 ?>
 <html>
 <form action="recherchetag.php" method="get">
 <meta charset="UTF-8">
 <div>
         <label for="tag">tag:</label>
         <input type="text" name="tag" />
 </div>
  	<div class="button">
         <button type="submit">Rechercher</button>
     </div>
 </form>
</html>
