<?php
	include_once('connections.php');
	//scripte pour inserer des valeur dans la BD
	// on fait un !empty pour attendre qu'une valeur soit prise par la case selectionner
	//on regroupe tout dans des variable et on l'envoye as la base 
	if(!empty($_POST['codeajou']) && !empty($_POST['libelleajou']) && !empty($_POST['PUajou'])){
		$code = htmlentities($_POST['codeajou']);
		$libelle = htmlentities($_POST['libelleajou']);
		$PU = htmlentities($_POST['PUajou']);
		try{

			$sql="INSERT INTO Prestation(code,libelle,PU) VALUES('$code','$libelle',$PU)";
			$dbh->exec($sql);
	    }catch(PDOException $e){
			print "Erreur! :".$e->getMessage()."</br>";
			die();
     	}
		echo '<script language="Javascript"> alert ("les donnée on bien êter mise as jour" )</script>';
		echo ' <meta http-equiv="refresh" content=" 0; url=prestation.php">';
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Gérer les prestations</title>
	<link rel="stylesheet" type="text/css" href="csspresta.css">
	<link rel="stylesheet" type="text/css" href="menus1.css">
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
</head>
<body>
		<hr>
<ul id="menu-demo2">
	<div class="btn-group"  >
	 <a href="accueil.html" class="btn btn-primary" role="button" aria-pressed="true">accueil </a></div>
	 	<div class="btn-group"  >
	 	 <a href="ligue.php" class="btn btn-secondary" role="button" aria-pressed="true">ligue</a></div></div>
	 	 	<div class="btn-group"  >
	 	 	<li><a class="btn btn-primary" href="#">Facture</a>
		<ul>
			<li><a href="créationsfacture.php" class="btn btn-secondary">Créations facture</a></li>
			<li><a href="recherche.php" class="btn btn-primary">recherche facture</a></li></div>
		</ul>
</div>
<hr>

<!--mise en place du tableaux pour les ajoues d'une ligne dans le BD-->
<h2 >Ajouter une prestation :</h2>
<form method="POST" action="prestation.php">
	<table class="tableau">
		<thead>
			<td class="border">Code</td>
			<td class="border">Libelle</td>
			<td class="border">PU</td>
		</thead>
		<tbody>
			<td class="border"><input type="text" name="codeajou" required></td>
			<td class="border"><input type="text" name="libelleajou" required></td>
			<td class="border"><input type="number" step="any" name="PUajou" required></td>
			<td class="empty border"><button class='btn btn-outline-primary'>valider</button></td>
		</tbody><br>
	</table><br>
</form>
<h2>Tableaux des prestations existantes :</h2>
</body>
</html>
<?php
	//aller chercher des valeur dans des table de la BD 
	$sql='SELECT * FROM Prestation';
	$sth=$dbh->query($sql);
	$resultat=$sth->fetchall(PDO::FETCH_ASSOC);
	// affichage du tableaux de prestations
		echo"<form method='POST' action='prestation.php'><table><thead>
		<td class='border'>Code</td><td class='border'>Libelle</td><td class='border'>PU</td></thead>";
		$i=1;
	foreach ($resultat as $row) {
		echo"<tbody>";
		echo"<td class='border'><input type='text' name='codemodi".$i."' value='".$row['Code']."' readonly='readonly' required></input></td>";
		echo"<td class='border'><input type='text' name='libellemodi".$i."' value='".$row['Libelle']."'required></input></td>";
		echo"<td class='border'><input type='text' name='PUmodi".$i."' value='".$row['PU']."'required></input></td>";
		echo"<td class='empty border'><input class='btn btn-outline-primary' type='submit' name='modif".$i."' value='modifier'/></td>";
		$sql="SELECT * FROM Ligne_Facture where Code_Prestation='".$row['Code']."'";
		$sth=$dbh->query($sql);
		$test=$sth->fetchall();
		$cpt=0;
		foreach ($test as $row) {
			$cpt=$cpt+1;
		}
		if($cpt==0){
			echo"<td class='empty border'><input class='btn btn-outline-primary' type='submit' name='supr".$i."' value='supprimer'/></td>";
		}else{
			echo "<td class='empty border'>*</td>";
		}
		$i=$i+1;
	}
	echo"<h4 align='center'>(les lignes (*) ne peuvent pas être suprimées car elles sont utiliser par des factures existantes)</h4><br>";
	echo"</tbody></table></from>";
	//comment le $_POST envoye un tableaux arry avec les donnée présent dans le name 
	//on as juste as regarder si les donner envoyer son les bonne est on envoye la requette sql
	//pour modifier la BD en quoncéquence 
	// sit explicatife : https://programmation-web.net/2011/04/plusieurs-submit-dans-formulaire/#comment-1585
	for ($j=0; $j < $i; $j++) { 
		//mettre a jour les élément
		if(isset($_POST['modif'.$j])){
		$code = htmlentities($_POST['codemodi'.$j]);
		$libelle = htmlentities($_POST['libellemodi'.$j]);
		$PU = htmlentities($_POST['PUmodi'.$j]);
		try{
		$sql="UPDATE Prestation SET code = '$code', libelle = '$libelle', PU = $PU where libelle ='$libelle' or code = '$code' or PU = $PU";
		$dbh->exec($sql);
		}catch(PDOException $e){
			print "Erreur! :".$e->getMessage()."</br>";
			die();
     	}
     	echo '<script language="Javascript"> alert ("Les données ont bien été mise à jour !" )</script>';
     	echo ' <meta http-equiv="refresh" content=" 0; url=prestation.php">';
		}
		if(isset($_POST['supr'.$j])){
		//suppriemer les éléments
		$code = htmlentities($_POST['codemodi'.$j]);
		$libelle = htmlentities($_POST['libellemodi'.$j]);
		$PU = htmlentities($_POST['PUmodi'.$j]);
		try{
		$sql="DELETE FROM Prestation where Code = '$code'";
		$dbh->exec($sql);
		}catch(PDOException $e){
			print "Erreur! :".$e->getMessage()."</br>";
			die();
     	}
     	echo '<script language="Javascript"> alert ("les donnée on bien êter mise as jour" )</script>';
     	echo ' <meta http-equiv="refresh" content=" 0; url=prestation.php">';
		}
	}
?>