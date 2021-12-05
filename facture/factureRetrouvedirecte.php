<?php
//on vas utiliser composer pour pouvoir télécharger la 
//blibliotéque html2pdf
require("connections.php");
require "vendor/autoload.php";
use Spipu\Html2Pdf\Html2Pdf;
//on démare la récolte d'info
ob_start()
?>
<!-- style de la facture-->
<style type="text/css">
	table{border-collapse: collapse; margin: auto;}
	td{border: 10px solid black ;border: none;}
	td.empty {background-color: royalblue;border: 1px solid black ;border : rgba(0,5);padding: 10px;}
	td.border {border: 1px solid black ;border : rgba(0,5);padding: 10px;}
	td.raf{border-right: 1px solid black;border-left : rgba(0,5);padding: 10px;}
</style>
<!-- la facture elle même-->
<page backtop="20mm" backleft="10mm" backright="10mm" backbottom="30mm">
	<page_footer>
		<hr/>
			<h4><?php echo "CROSL" ?></h4>
			<h4 align="center">page [[page_cu]]/[[page_nb]]</h4>
	</page_footer>		
	<!-- le haut de la page-->
	<table>
		<tr>
			<td style="width: 100%;">
			<br/><br/>
			<?php
				$sql="SELECT * FROM Facture where Num_facture='".$_POST['numfac']."'";
				$info=$dbh->query($sql);
				$info = $info->fetchall();
				foreach ($info as $row) {
					echo $row['Intituler_Facture']."<br/>";
					echo $row['Tresorier_Facture']."<br/>";
					echo "Maison Régionale des Sports de Lorraine<br/>";
					echo $row['rue_Facture']."<br/>";
					echo $row['code_postal_Facture']."<br/>";
				}
			?>
			<br/>
			</td>
		</tr>
	</table>
	<!-- la desiéme ligne de la page-->
	<table>
		<tr>
			<td style="width: 60%;">
			<?php echo "Siret : 31740105700029";?><br/>
			<?php echo "Tél : 03.83.18.87.02"; ?><br/>
			<?php echo "Fax : 03.83.18.87.03"; ?><br/>	
			</td>
			<?php 
			foreach ($info as $row) {
			if ($row['verif_Facture']==0) {
				echo"<td style='width: 40%;'>";
				echo "<br/><br/>";
				echo "M2L<br/>";
				echo "Maison Régionale des Sports de Loraine<br/>";
				echo "13 Rue Jean Moulin<br/>";
				echo "54510<br/>";
			}else{
			 echo"<td style='width: 40%;'>";
			echo "<br/><br/>";
					echo $row['Intituler_Facture']."<br/>";
					echo "a l'attention de ".$row['Tresorier_Facture']."<br/>";
					echo "Maison Régionale des Sports de Lorraine <br/> ";
					echo $row['rue_Facture']."<br/>";
					echo $row['code_postal_Facture']."<br/>";
				}
			}
			 ?>
			</td>
		</tr>
	</table>
	<!-- la mot en gras-->
	<table>
		<tr>
			<td style="width: 20%;"><?php echo "<h1>Facture</h1>";?><br/></td>
		</tr>
	</table>
	<!-- le tableaux -->
	<table>
		<tr>
			<td style="width: 30%;" class="empty"><?php echo "date" ?></td>
			<td style="width: 30%;" class="empty"><?php echo "Numero" ?></td><!-- chercher dans la BD la bonne donnée-->
			<td style="width: 20%;" class="empty"><?php echo "Code Client" ?></td>
			<td style="width: 20%;" class="empty"><?php echo "échéance" ?></td><!-- à calculer-->
		</tr>
		<tr>
			<td style="width: 20%;" class="border"><?php
			foreach ($info as $row) {
						 $datej=$row['Ndate'];
						 $Y=substr($datej, 0,4);
						 $n=substr($datej, 5,2);
						 $j=substr($datej, 8,8);
						 $datej= $j."/".$n."/".$Y;
						 echo $datej;
						 }?></td>
			<td style="width: 20%;" class="border"><?php 
	
			echo $_POST['numfac']; ?></td><!-- chercher dans la BD la bonne donnée-->
			<td style="width: 20%;" class="border"><?php echo $_POST['codecli']; ?></td><!-- chercher dans la BD la bonne donnée-->
			<td style="width: 20%;" class="border"><?php 
				foreach ($info as $row) {
						 $datej=$row['Echeance'];
						 $Y=substr($datej, 0,4);
						 $n=substr($datej, 5,2);
						 $j=substr($datej, 8,8);
						 $datej= $j."/".$n."/".$Y;
						 echo $datej;
						 }?></td>
		</tr>
	</table>
	<table>
		<tr>
			<td style="width: 20%;" class="empty"><?php echo "Référence" ?></td>
			<td style="width: 20%;" class="empty"><?php echo "QTé" ?></td>
			<td style="width: 20%;" class="empty"><?php echo "Désignation" ?></td><!-- chercher dans la BD la bonne donnée-->

			<td style="width: 20%;" class="empty"><?php echo "PU HT" ?></td><!-- à calculer-->
			<td style="width: 20%;" class="empty"><?php echo "Montant TTC" ?></td>
		</tr>
		<!-- faire un foreache pour afficher tout les valeurs envoyer par la page facture présédente-->

	<?php
			$sql="SELECT * FROM Ligne_Facture where Num_Facture= '".$_POST['numfac']."'";
			$result=$dbh->query($sql);
			$result = $result->fetchall();
			foreach ($result as $row) {
				echo"<tr><td style='width: 20%;' class='border'>".$row['Code_Prestation']."</td>";
				echo "<td style='width: 20%;' class='border'>".$row['Quantite_Prestation']."</td>";
					echo"<td style='width: 20%;' class='border'>".$row['Libelle_Prestation']."</td>";
					echo"<td style='width: 20%;' class='border'>".$row['PU_Prestation']."</td>";
					$ttc=($row['PU_Prestation']*$row['Quantite_Prestation']);
					echo "<td style='width: 20%;' class='border'>".$ttc."</td></tr>";
					}

			echo "<tr>
			<td style='width: 20%;'></td>
			<td style='width: 20%;'></td>
			<td style='width: 20%;' class='raf'></td>
			<td style='width: 20%;' class='empty'> TTC TOTAL :</td>
			<td style='width: 20%;' class='border'>".$ttc."</td>
		</tr>";
		?>
	</table>



	<table>
		<tr>
			<td style="width: 100%;"><?php echo "date de réglage :" ?><br/><br/></td>
			<br/>
		</tr>
		<tr>
			<td style="width: 100%;"><?php echo "facture a réglée :" ?><br/></td>
		</tr>
		<tr>
			<td style="width: 50%;"><?php echo "- Par chèque à l’ordre de ( préciser)" ?><br/></td>
		</tr>
		<tr>
			<td style="width: 50%;"><?php echo "- Par virement sur le compte" ?><br/><br/><br/><br/></td>
		</tr>
	</table>
	<table>
		<tr>
			<td style="width: 20%;"><?php echo "nom et qualité :" ?><br/><br/></td>
		</tr>
		<tr>
			<td style="width: 20%;"><?php echo "Signature et cachet :" ?></td>
		</tr>
	</table>
</page>
<?php
//on récupére tout les info dans une variable ici $content
$content = ob_get_clean();
//on défini comment vas aitre le pdf et on incorpore le comptenut
try{
	$pdf = new Html2Pdf('P','A4','fr');
	$pdf->pdf->SetDisplaymode('fullpage');
	$pdf->writeHTML($content);
	$pdf->output("facture.pdf","D");
}catch(HTML2PDF_exeption $e){
	die($e);
}
?>