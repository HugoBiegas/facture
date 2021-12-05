<!DOCTYPE html>
<?php
//on vas chercher la connections
include_once("connections.php");
?>
<html>
<head>
	<title>Créations d'une facture</title>
	<link rel="stylesheet" type="text/css" href="csspresta.css">
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
		<link rel="stylesheet" type="text/css" href="menus1.css">
</head>
<body>
		<hr>
		<!-- on mais en place les différent bouton -->
<ul id="menu-demo2">		
	<div class="btn-group"  >
	 <a href="accueil.html" class="btn btn-primary" role="button" aria-pressed="true">Accueil </a></div>
	<div class="btn-group"  >
	 	 <a href="ligue.php" class="btn btn-secondary" role="button" aria-pressed="true">Ligue</a></div>
	 	 <div class="btn-group"  >
	 	 <a href="prestation.php" class="btn btn-primary" role="button" aria-pressed="true">Prestation</a></div>
	 	 <div class="btn-group"  >
	 	 <a class="btn btn-secondary" href="recherche.php">Recherche Facture</a></div>
</ul>
<hr>

	<h2 align="center">Veuiller entrer la/les référence(s), la/les quantité(s) et le nom de la ligue présente dans la facture :</h2>
	<!-- on mais en place le tableaux pour créer la facture-->
	<table>
		<thead>
			<tr>
				<td class="border primary">Référence</td>
				<td class="border primary">Quantité</td>
				<td class='border primary'>Nom de la ligue</td>
			</tr>	
		</thead>
		<tbody>
			<form method='POST' action='facture.php'>
				<?php
				//on vas chercher tout les nom des nom de prestation existante
					try{
					$sql="SELECT Code from Prestation";
					$presta =$dbh->query($sql);
					$presta = $presta->fetchall();
					}catch(PDOEXEPTION $e){
					die($e);
					}
				for ($i=1; $i < 11 ; $i++) { 
					echo"<tr><td class='border '><SELECT name='code".$i."'><OPTION></option>";
					foreach ($presta as $row) {
						echo "<OPTION>".$row['Code']."</option>";
					}
					echo "</SELECT></td>
					<td class='border '><input type='number' name='quanti".$i."' value='0'></td>";
							if($i==1){
								//on vas chercher tout les intituler de ligue existante
							try{
							$sql="SELECT Intituler from Ligue";
								$result =$dbh->query($sql);
								$result = $result->fetchall();
							}catch(PDOEXEPTION $e){
							die($e);
							}
							echo "<td class='border'><SELECT name='codecli'>";
							foreach ($result as $row) {
								echo "<OPTION>".$row['Intituler']."</option>";
							}
								echo "</SELECT></td>";
							}else if($i==2){
								echo"<td class='border'><button class='btn btn-outline-primary' name='modi'>Valider le choix</button></td>";	
							}					 
					}
					echo "</tr>";
				?>
			</from>
		</tbody>
	</table>
</body>
</html>