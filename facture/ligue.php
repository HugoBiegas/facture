<?php

	include_once('connections.php');
	//scripte pour inserer des valeur dans la BD
	// on fait un !empty pour attendre qu'une valeur soit prise par la case selectionner
	//on regroupe tout dans des variable et on l'envoye as la base
		if ( isset($_POST['verifajou'])) {
			$verif = 1;
		}else{
			$verif = 0;
		} 
	if(!empty($_POST['compte']) && !empty($_POST['intitulerajou']) && !empty($_POST['tresorierajou']) && !empty($_POST['rueajou']) && !empty($_POST['codepoajou']) && !empty($_POST['villeajou'])){
		$compte = htmlentities($_POST['compte']);
		$intituler = htmlentities($_POST['intitulerajou']);
		$tresorier = htmlentities($_POST['tresorierajou']);
		$rue = htmlentities($_POST['rueajou']);
		$codepo = htmlentities($_POST['codepoajou']);
		$ville = htmlentities($_POST['villeajou']);
		try{
			$sql="INSERT INTO ligue(compte,intituler,tresorier,rue,code_postal,ville,verif) VALUES($compte,'$intituler','$tresorier','$rue',$codepo,'$ville',$verif)";
			$dbh->exec($sql);
	    }catch(PDOException $e){
			print "Erreur! :".$e->getMessage()."</br>";
			die();
     	}
		echo '<script language="Javascript"> alert ("Les données ont bien été mise à jour !" )</script>';
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Gérer les Ligues</title>
	<link rel="stylesheet" type="text/css" href="csspresta.css">
		<link rel="stylesheet" type="text/css" href="menus1.css">
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

</head>
<body>
		<hr>
		<!--on mais en place les bouttons utiliser sur cette page--> 
<ul id="menu-demo2">
	<div class="btn-group"  >
	 <a href="accueil.html" class="btn btn-primary" role="button" aria-pressed="true">accueil </a></div>
	 	<div class="btn-group"  >
	 	 <a href="prestation.php" class="btn btn-secondary" role="button" aria-pressed="true">prestation</a></div>
	 	 	<div class="btn-group"  >
	 	 	<li><a class="btn btn-primary" href="#">Facture</a>
		<ul>
			<li><a href="créationsfacture.php" class="btn btn-secondary">Créations facture</a></li>
			<li><a href="recherche.php" class="btn btn-primary">recherche facture</a></li></div>
		</ul>
</div>
</ul>
<hr>
<!--mise en place du tableaux pour les ajoues d'une ligne dans le BD-->
<h2 >Ajouter une Ligue :</h2>

<form method="POST" action="ligue.php">
	<table class="tableau">
		<thead>
			<td class="border">Compte</td>
			<td class="border">Intituler</td>
			<td class="border">Tresorier</td>
			<td class="border">Rue</td>
			<td class="border">Code postal</td>
			<td class="border">Ville</td>
			<td class="border">Envoyer au trésorier</td>
		</thead>
		<tbody>
			<?php
			$sql="SELECT max(compte) FROM ligue";
			$sth=$dbh->query($sql);
			$resultat=$sth->fetch();
			$com = $resultat[0];
			$com= $com +1;
			 ?>
			<td class="border"><input type="text" name="compte" value="<?php echo $com ?>" readonly='readonly' required></td>
			<td class="border text-primary"><input type="text" name="intitulerajou" required></td>
			<td class="border"><input type="text" name="tresorierajou" required></td>
			<td class="border"><input type="text" name="rueajou" required></td>
			<td class="border"><input type="text" name="codepoajou" required></td>
			<td class="border"><input type="text" name="villeajou" required></td>
			<td class="border"><input type="checkbox" name="verifajou" value="1" ></td>
			<td class="empty border "><button class='btn btn-outline-primary'>valider</button></td>	<br>
		</tbody>
	</table>
	<br>
</form>
<h2>Tableau des Ligues existantes :</h2>
</body>
</html>
<?php
	//aller chercher des valeur dans des table de la BD 
	$sql='SELECT * FROM Ligue';
	$sth=$dbh->query($sql);
	$resultat=$sth->fetchall(PDO::FETCH_ASSOC);
	// affichage du tableaux de prestations
		echo"<form method='POST' action='ligue.php'><table><thead>
		<td class='border'>Compte</td><td class='border'>Intituler</td><td class='border'>Trésorier</td><td class='border'>Rue</td>
		<td class='border'>Code postal</td><td class='border'>Ville</td><td class='border'>Envoyer au trésorier</td></thead>";
		$i=1;
		//on afficher les valeur grace a la bd est on rend unique chaque ligne grace as son nom
	foreach ($resultat as $row) {
		echo"<tbody>";
		echo"<td class='border'><input type='text' name='comptemodi".$i."' value='".$row['Compte']."' readonly='readonly' required =></input></td>";
		echo"<td class='border'><input type='text' name='intitulermodi".$i."' value='".$row['Intituler']."'required></input></td>";
		echo"<td class='border'><input type='text' name='tresoriermodi".$i."' value='".$row['Tresorier']."'required></input></td>";
		echo"<td class='border'><input type='text' name='ruemodi".$i."' value='".$row['rue']."'required></input></td>";
		echo"<td class='border'><input type='text' name='codepomodi".$i."' value='".$row['code_postal']."'required></input></td>";
		echo"<td class='border'><input type='text' name='villemodi".$i."' value='".$row['ville']."'required></input></td>";
		if ($row['verif'] == 1) {
				echo"<td class='border'><input type='checkbox' name='verifmodi".$i."' value='1' checked='yes' ></input></td>";
		}else{
				echo"<td class='border'><input type='checkbox' name='verifmodi".$i."' value='1'></input></td>";
		}
		echo"<td class='empty border'><input class='btn btn-outline-primary' type='submit' name='modif".$i."' value='modifier'/></td>";
		//on regarde si  la ligue as dejat est dejat dans une facture existante
		$sql="SELECT Compte_Ligue FROM Facture where Compte_Ligue=".$row['Compte']."";
		$sth=$dbh->query($sql);
		$test=$sth->fetchall(PDO::FETCH_ASSOC);
		$cpt=0;
		foreach ($test as $row) {
			$cpt=$cpt+1;
		}
		if($cpt==0){
			echo"<td class='empty border '><input class='btn btn-outline-primary' type='submit' name='supr".$i."' value='supprimer'/></td>";
		}else{
			echo "<td class='empty border'>*</td>";
		}
		$i=$i+1;
	}
				echo"<h4 align='center'>(les lignes (*) ne peuvent pas être suprimées car elles sont utilisées dans des factures existantes)</h4><br>";
	echo"</tbody></table></from>";
	//comment le $_POST envoye un tableaux arry avec les donnée présent dans le name 
	//on as juste as regarder si les donner envoyer son les bonne est on envoye la requette sql
	//pour modifier la BD en quoncéquence 
	// sit explicatife : https://programmation-web.net/2011/04/plusieurs-submit-dans-formulaire/#comment-1585
	for ($j=0; $j < $i; $j++) { 
		if(isset($_POST['modif'.$j])){
		$compte = htmlentities($_POST['comptemodi'.$j]);
		$intituler = htmlentities($_POST['intitulermodi'.$j]);
		$tresorier = htmlentities($_POST['tresoriermodi'.$j]);
		$rue = htmlentities($_POST['ruemodi'.$j]);
		$codepo = htmlentities($_POST['codepomodi'.$j]);
		$ville = htmlentities($_POST['villemodi'.$j]);
		if ( isset($_POST['verifmodi'.$j])) {
			$verif = 1;
		}else{
			$verif = 0;
		} 
		$sql="UPDATE Ligue SET Intituler='$intituler', Tresorier='$tresorier', Rue='$rue',Code_postal=$codepo,Ville='$ville',verif=$verif where Compte=$compte ";
		$dbh->exec($sql);
		echo '<script language="Javascript"> alert ("les donnée on bien êter mise as jour" )</script>';
     	echo ' <meta http-equiv="refresh" content=" 0; url=ligue.php">';
		}
		if(isset($_POST['supr'.$j])){
		$compte = htmlentities($_POST['comptemodi'.$j]);
		$sql="DELETE FROM Ligue where Compte = $compte";
		$dbh->exec($sql);
		echo '<script language="Javascript"> alert ("Les données on bien été mise à jour !" )</script>';
     	echo ' <meta http-equiv="refresh" content=" 0; url=ligue.php">';
		}
	}
?>