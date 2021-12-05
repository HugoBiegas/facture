<!DOCTYPE html>
<?php
include_once("connections.php");
?>
<html>
<head>
	<title>créations d'une facture</title>
	<link rel="stylesheet" type="text/css" href="csspresta.css">
</head>
<body>
<link rel="stylesheet" type="text/css" href="menus.css">
		<hr>
<ul id="menu-demo2">
	<li><a href="accueil.html">accueil</a></li>
	<li><a href="ligue.php">ligue</a></li>
	<li><a href="prestation.php">prestations</a></li>
	<li><a href="recherche.php">recherche facture</a></li>
</ul>
<hr>
<script type="text/javascript">
	function ajouterLigne()
{
	var tableau = document.getElementById("tableau");

	var ligne = tableau.insertRow(-1);//on a ajouté une ligne

	var colonne1 = ligne.insertCell(0);//on a une ajouté une cellule
	c="";
	d=document.getElementById("titre").value;
	c="<td name='code1'>"+d+" </td>";
	colonne1.innerHTML += c;//on y met le contenu de titre

	var colonne2 = ligne.insertCell(1);//on ajoute la seconde cellule
	colonne2.innerHTML += document.getElementById("auteur").value;

}

</script>
	<h2 align="center">veuiller rentrer la/les référence, la/les quantité et le nom de la ligue présent dans la facture :</h2>
	<table id="tableau">
		<thead>
			<tr>
				<td>référence</td>
				<td>quantité</td>
				<td>Nom ligue</td>
			</tr>	
		</thead>
		<tbody>
			<form method='POST' action='facture.php'>
				<?php
					try{
					$sql="SELECT * from Prestation";
					$presta =$dbh->query($sql);
					$presta = $presta->fetchall();
					}catch(PDOEXEPTION $e){
					die($e);
					}
					echo"<tr><td><SELECT id='titre' name='code1'><OPTION></option>";
					foreach ($presta as $row) {
						echo "<OPTION>".$row['Code']."</option>";
					}
					echo "</SELECT></td>
					<td><input id='auteur' type='number' name='quanti1' value='0'></td>";

							try{
							$sql="SELECT * from Ligue";
								$result =$dbh->query($sql);
								$result = $result->fetchall();
							}catch(PDOEXEPTION $e){
							die($e);
							}
							echo "<td><SELECT name='codecli'>";
							foreach ($result as $row) {
								echo "<OPTION>".$row['Intituler']."</option>";
							}
								echo "</SELECT></td>";
								echo"<td><button name='modi'>valider le choix</button></td>";					 
					echo "</tr>";
				?>
				<input type="button" onclick="ajouterLigne();" value="Enregistrer"/>
			</from>
		</tbody>
	</table>
</body>
</html>