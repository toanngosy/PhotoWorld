<?php

include_once 'connect.php';
$id_photo = $_GET['id_photo'];
session_start();
$pseudonyme = $_SESSION['pseudonyme'];


if (isset($_POST['commentaire'])){
	$dbPDO->query("INSERT INTO likable_objet (auteur) VALUES ('$pseudonyme')");
	$res = $dbPDO->query("SELECT id FROM likable_objet ORDER BY id DESC ");
	$dbPDO->query("INSERT INTO commentaire (id_commentaire, texte, auteur, photo) VALUES (".$res->fetchColumn(0).",'".$_POST['commentaire']."','".$pseudonyme."',".$id_photo.")");
}

if (isset($_POST['tag'])){
	$dbPDO->query("INSERT INTO tag (commentaire, tag) VALUES (".$_POST['com'].",'".$_POST['tag']."')");
}

if (isset($_POST['choix1'])){


	$dbPDO->query("INSERT INTO likes  VALUES ('$id_photo','$pseudonyme',1)");

}
if (isset($_POST['choix2'])){


	$dbPDO->query("INSERT INTO likes  VALUES ('$id_photo','$pseudonyme',1)");

}



$result = $dbPDO->query("SELECT statut_profil, pseudonyme FROM utilisateur u JOIN likable_objet p ON p.auteur = u.pseudonyme WHERE p.id = ".$id_photo);
if (!$result) {
  echo "Une erreur s'est produite.\n";
  exit;
}
$res = $result->fetch(PDO::FETCH_ASSOC);
$statut_profil = $res['statut_profil'];
$user = $res['pseudonyme'];
$friendres = $dbPDO->query("SELECT COUNT(*) as nb_ami FROM ami WHERE (user1='".$pseudonyme."' AND user2='".$user."') OR (user1='".$user."' AND user2='".$pseudonyme."')");
$friend = $friendres->fetch(PDO::FETCH_ASSOC)['nb_ami'];
if ($statut_profil != "Public" && ($friend ==0 && $pseudonyme != $user)){
	header('HTTP/1.1 401 Unauthorized', true, 401);

	echo 'Vous n\'avez pas accès à cette page. <a href="acceuil.php">Retour</a>';
	exit;
}else {
	$result = $dbPDO->query("SELECT titre, url FROM photo WHERE id_photo=".$id_photo);
	if (!$result) {
	  echo "Une erreur s'est produite.\n";
	  exit;
	}
	else {
		$rows = $result->fetchAll(PDO::FETCH_ASSOC);
		foreach ($rows as $row) {
			echo '<h2>'.$row['titre'].'</h2>';
			echo '<img src="'.$row['url'].'" height="750" width="750">';
		}
	}
$result_like_photo = $dbPDO->query("SELECT * FROM likes WHERE objet='$id_photo' AND choix=1");
$result_dlike_photo = $dbPDO->query("SELECT * FROM likes WHERE objet='$id_photo' AND choix=-1");
$countl = $result_like_photo->rowCount();
$countd = $result_dlike_photo->rowCount();
if($countl!=0 |$countd!=0 ){
echo "\n the photo est liked par$countl personnes \n disliked par $countd personnes  ";}






	$resultcom = $dbPDO->query("SELECT c.id_commentaire, c.texte, o.auteur FROM commentaire c JOIN likable_objet o ON c.id_commentaire = o.id WHERE  c.photo = '$id_photo'");

	if (!$resultcom) {
	  echo "Une erreur s'est produite.\n";
	  exit;
	}
	else {
		$rows = $resultcom->fetchAll(PDO::FETCH_ASSOC);
		foreach ($rows as $row) {

			$result = $dbPDO->query("SELECT * FROM ami WHERE (user1 = '$pseudonyme' AND user2 = '".$row['auteur']."') OR (user2 = '$pseudonyme' AND user1 = '".$row['auteur']."')");
$count = $result->rowCount();
			$result2 = $dbPDO->query("SELECT statut_profil FROM utilisateur WHERE utilisateur.pseudonyme='".$row['auteur']."'");
			$rows2 = $result2->fetchAll(PDO::FETCH_ASSOC);
			foreach ($rows2 as $row2){
				if ($count != 0){
					echo '<p>Commentaire de <a href="ami_photo.php?ami='.$row['auteur'].'">'.$row['auteur'].'</a> : <br/>';
				}
				else{
					if ($row2['statut_profil'] == "Prive"){
						echo '<p>Commentaire de '.$row['auteur'].' : <br/>';
					}
					else{
						echo '<p>Commentaire de <a href="ami_photo.php?ami='.$row['auteur'].'">'.$row['auteur'].'</a> : <br/>';
					}
				}
			}
			echo $row['texte'].'</p>';
			$resultc_like = $dbPDO->query("SELECT choix FROM likes WHERE objet =".$row['id_commentaire']." AND choix = 1");
			$resultc_dislike = $dbPDO->query("SELECT choix FROM likes WHERE objet =".$row['id_commentaire']." AND choix = -1");
			$count_like = $resultc_like->rowCount();
			$count_dislike = $resultc_dislike->rowCount();
			echo $count_like." <a href='like.php?id_photo=".$id_photo."& choix=1& id_commentaire=".$row['id_commentaire']."'>like</a>";
			echo ' '.$count_dislike." <a href='like.php?id_photo=".$id_photo."&choix=-1&id_commentaire=".$row['id_commentaire']."'>dislike</a>";
			$resulttag = $dbPDO->query("SELECT t.tag FROM tag t JOIN commentaire c ON c.id_commentaire = t.commentaire WHERE t.commentaire =".$row['id_commentaire']);
			$tags = $resulttag->fetchAll(PDO::FETCH_ASSOC);
			foreach ($tags as $tag) {
				echo '<a href="recherchetag.php?tag='.$tag['tag'].'"<em>#'.$tag['tag'].'</em>';
			}
			echo '<form action="afficher_photo.php?id_photo='.$_GET['id_photo'].'" method="post">';
			echo '<input type="text" name="tag" />
				<input type="hidden" name="com" value="'.$row['id_commentaire'].'"/>
				<button type="submit">tag</button>
				</form>';

		}
	}
}
echo '<form action="afficher_photo.php?id_photo='.$_GET['id_photo'].'" method="post">';

?>
<meta charset="UTF-8">
		<input type="text" name="commentaire" />
		<button type="submit">Commenter</button>
</form>

<?php
echo '<form action="like_photo.php?id_photo='.$_GET['id_photo'].'" method="post">';
echo '<input type="radio" name="choix_photo" value=1 checked> like the photo<br>';
echo '<input type="radio" name="choix_photo" value=-1> dislike the photo<br>';
echo '<button type="submit">Pose ton like !</button>';
echo '</form>';
?>
