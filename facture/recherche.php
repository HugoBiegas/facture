   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <style type="text/css">       
      div {  
         margin: 0 auto;
         text-align:center;
         } 
   </style>
<link rel="stylesheet" type="text/css" href="menus1.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <hr>
<ul id="menu-demo2">    
  <div class="btn-group"  >
   <a href="accueil.html" class="btn btn-primary" role="button" aria-pressed="true">Accueil </a></div>
  <div class="btn-group"  >
     <a href="ligue.php" class="btn btn-secondary" role="button" aria-pressed="true">Ligue</a></div>
     <div class="btn-group"  >
     <a href="ligue.php" class="btn btn-primary" role="button" aria-pressed="true">Prestation</a></div>
     <div class="btn-group"  >
     <a class="btn btn-secondary" href="créationsfacture.php">Création Facture</a></div>
</ul>

<hr>
<table></table>
   <div>
      <form method="GET" >

<div class="col-md-4 offset-md-4">
<div class="input-group mb-3">
  <input type="text" name="q" class="form-control" placeholder="Recherche ......" aria-label="Recipient's username">
  <div class="input-group-append">
             <input align="center" class="btn btn-outline-primary" align="center" type="submit" value="Valider" />

  </div>
  </div>
      </form>
   </div>
<hr>
<?php
include_once("connections.php");
if(isset($_GET['q']) AND !empty($_GET['q'])) {
   $q = htmlspecialchars($_GET['q']);
          $articles = $dbh->query("SELECT Quantite_Prestation FROM Ligne_Facture WHERE Quantite_Prestation LIKE '%".$q."%'");
            $cpt=0;
            $a=$articles->fetchall();
          foreach ($a as $row) {
      $cpt=$cpt+1;}
    if($cpt > 0) { 
   $articles = $dbh->query("SELECT Num_Facture FROM Ligne_Facture WHERE Quantite_Prestation LIKE ".$q."");
   $a=$articles->fetchall();
   echo "<p align='center'>Voici les factures trouvées : <p>";
   $cpt=1;
   foreach ($a as $row) {
      $envoi=$dbh->query("SELECT * FROM Facture WHERE Num_facture = '".$row['Num_Facture']."'");
      $envoi=$envoi->fetchall();
      foreach ($envoi as $row) {
        echo "<form method='POST' action='FactureRetrouve.php'>
         <table align='center'>
         <tr>
            <td><p name='cc'> Num facture :</p></td>
            <td><input type='text' name='numfac' value='".$row['Num_facture']."' readonly='readonly'></input></td>
            <td><p>code client :</p></td>
            <td><input type='text' name='codecli' value='".$row['Compte_Ligue']."' readonly='readonly'></input></td>
         <td> <input class='btn btn-outline-primary' align='center' type='submit' value='Facture n°".$cpt."' /></td>
          </tr>
          </table>
      </form>";
      }
      $cpt=$cpt+1;
   }
    }
    if($cpt==0){
      $articles = $dbh->query("SELECT * FROM Ligne_Facture WHERE PU_Prestation LIKE '%".$q."%'");
            $cpt=0;
            $a=$articles->fetchall();
    foreach ($a as $row) {
      $cpt=$cpt+1;
   }
    if($cpt > 0) { 
      foreach ($a as $row) {
   $ar = $dbh->query("SELECT * FROM Facture where Num_facture LIKE '".$row['Num_Facture']."'");
   $ar=$ar->fetchall();
 }
    echo "<p align='center'>Voici les factures trouvées : <p>";
    $cpt=1;
   foreach ($ar as $row) {
    echo "<form method='POST' action='FactureRetrouve.php'>
         <table align='center'>
         <tr>
            <td><p name='cc'> Num facture :</p></td>
            <td><input type='text' name='numfac' value='".$row['Num_facture']."' readonly='readonly'></input></td>";
   echo"<td><p>code client :</p></td>
            <td><input type='text' name='codecli' value='".$row['Compte_Ligue']."' readonly='readonly'></input></td>
         <td> <input class='btn btn-outline-primary' align='center' type='submit' value='Facture n°".$cpt."' /></td>
          </tr>
          </table>
      </form>";  


         $cpt=$cpt+1;     
   }
    }
              if($cpt==0){
       $articles = $dbh->query("SELECT * FROM Facture WHERE TTC LIKE '%".$q."%'");
            $cpt=0;
            $a=$articles->fetchall();
          foreach ($a as $row) {
      $cpt=$cpt+1;
   }
    if($cpt > 0) { 
   echo "<p align='center'>Voici les factures trouvées  : <p>";
   $cpt=1;
   foreach ($a as $row) {
   echo "<form method='POST' action='FactureRetrouve.php'>
         <table align='center'>
         <tr>
            <td><p name='cc'> Num facture :</p></td>
            <td><input type='text' name='numfac' value='".$row['Num_facture']."' readonly='readonly'></input></td>
            <td><p>code client :</p></td>
            <td><input type='text' name='codecli' value='".$row['Compte_Ligue']."' readonly='readonly'></input></td>
         <td> <input class='btn btn-outline-primary' align='center' type='submit' value='Facture n°".$cpt."' /></td>
          </tr>
          </table>
      </form>";
      $cpt=$cpt+1;
   }
    } 
          if($cpt==0){
      $articles = $dbh->query("SELECT * FROM Facture WHERE code_postal_Facture LIKE '%".$q."%'");
            $cpt=0;
            $a=$articles->fetchall();
    foreach ($a as $row) {
      $cpt=$cpt+1;
   }
    if($cpt > 0) { 
      echo "<p align='center'>Voici les factures trouvées : <p>";
      $cpt=1;
      foreach ($a as $row) {
    echo "<form method='POST' action='FactureRetrouve.php'>
         <table align='center'>
         <tr>
            <td><p name='cc'> Num facture :</p></td>
            <td><input type='text' name='numfac' value='".$row['Num_facture']."' readonly='readonly'></input></td>
            <td><p>code client :</p></td>
            <td><input type='text' name='codecli' value='".$row['Compte_Ligue']."' readonly='readonly'></input></td>
         <td> <input class='btn btn-outline-primary' align='center' type='submit' value='Facture n°".$cpt."' /></td>
          </tr>
          </table>
      </form>";  

         $cpt=$cpt+1;     
   }
 }
    if($cpt==0){
   $articles = $dbh->query("SELECT Num_Facture FROM Ligne_Facture WHERE Num_Facture LIKE '%".$q."%' ORDER BY Num_Facture desc");
      $cpt=0;
   foreach ($a=$articles->fetchall() as $row) {
      $cpt=$cpt+1;
   }   
   if($cpt > 0) { 
   $articles = $dbh->query("SELECT * FROM Facture where Num_facture LIKE '%".$q."%' order by Num_Facture desc");
   $a=$articles->fetchall();
   echo "<p align='center'>Voici les factures trouvées : <p>";
   $cpt=1;
   foreach ($a as $row) {
   echo "<form method='POST' action='FactureRetrouve.php'>
         <table align='center'>
         <tr>
            <td><p name='cc'> Num facture :</p></td>
            <td><input type='text' name='numfac' value='".$row['Num_facture']."' readonly='readonly'></input></td>
            <td><p>code client :</p></td>
            <td><input type='text' name='codecli' value='".$row['Compte_Ligue']."' readonly='readonly'></input></td>
         <td> <input class='btn btn-outline-primary' align='center' type='submit' value='Facture n°".$cpt."'/></td>
         </form>
          </tr>    
          </table>
";
      $cpt=$cpt+1;
   }
    }
      if($cpt==0){
      $articles = $dbh->query("SELECT * FROM Facture WHERE Intituler_Facture LIKE '%".$q."%'");
            $cpt=0;
            $a=$articles->fetchall();
    foreach ($a as $row) {
      $cpt=$cpt+1;
   }
    if($cpt > 0) {
    echo "<p align='center'>Voici les factures trouvées : <p>";
    $cpt=1;
      foreach ($a as $row) {
    echo "<form method='POST' action='FactureRetrouve.php'>
         <table align='center'>
         <tr>
            <td><p name='cc'> Num facture :</p></td>
            <td><input type='text' name='numfac' value='".$row['Num_facture']."' readonly='readonly'></input></td>
            <td><p>code client :</p></td>
            <td><input type='text' name='codecli' value='".$row['Compte_Ligue']."' readonly='readonly'></input></td>
         <td> <input class='btn btn-outline-primary' align='center' type='submit' value='Facture n°".$cpt."' /></td>
          </tr>
          </table>
      </form>";  


         $cpt=$cpt+1;     
   }
 }

      if($cpt==0){
      $articles = $dbh->query("SELECT Code_Prestation FROM Ligne_Facture WHERE Code_Prestation LIKE '%".$q."%'");
            $cpt=0;
   foreach ($a=$articles->fetchall() as $row) {
      $cpt=$cpt+1;
   }
    if($cpt > 0) { 
   $articles = $dbh->query("SELECT Num_Facture FROM Ligne_Facture WHERE Code_Prestation LIKE '%".$q."%'");
   $a=$articles->fetchall();
   echo "<p align='center'>Voici les factures trouvées : <p>";
   $cpt=1;
   foreach ($a as $row) {
      $envoi=$dbh->query("SELECT * FROM Facture WHERE Num_facture = '".$row['Num_Facture']."'");
      $envoi=$envoi->fetchall();
      foreach ($envoi as $row) {
        echo "<form method='POST' action='FactureRetrouve.php'>
         <table align='center'>
         <tr>
            <td><p name='cc'> Num facture :</p></td>
            <td><input type='text' name='numfac' value='".$row['Num_facture']."' readonly='readonly'></input></td>
            <td><p>code client :</p></td>
            <td><input type='text' name='codecli' value='".$row['Compte_Ligue']."' readonly='readonly'></input></td>
         <td> <input class='btn btn-outline-primary' align='center' type='submit' value='Facture n°".$cpt."' /></td>
          </tr>
          </table>
      </form>";
      }
      $cpt=$cpt+1;
   }
    }
   if($cpt==0){
       $articles = $dbh->query("SELECT * FROM Facture WHERE Compte_Ligue LIKE '%".$q."%'");
            $cpt=0;
          $a=$articles->fetchall();
          foreach ($a as $row) {
      $cpt=$cpt+1;
   }
    if($cpt > 0) { 
   echo "<p align='center'>Voici les factures trouvées : <p>";
   $cpt=1;
   foreach ($a as $row) {
   echo "<form method='POST' action='FactureRetrouve.php'>
         <table align='center'>
         <tr>
            <td><p name='cc'> Num facture :</p></td>
            <td><input type='text' name='numfac' value='".$row['Num_facture']."' readonly='readonly'></input></td>
            <td><p>code client :</p></td>
            <td><input type='text' name='codecli' value='".$row['Compte_Ligue']."' readonly='readonly'></input></td>
         <td> <input class='btn btn-outline-primary' align='center' type='submit' value='Facture n°".$cpt."' /></td>
          </tr>
          </table>
      </form>";
      $cpt=$cpt+1;
   }
    } 
      if($cpt==0){
       $articles = $dbh->query("SELECT * FROM Facture WHERE Ndate LIKE '%".$q."%'");
            $cpt=0;
            $a=$articles->fetchall();
        foreach ($a as $row) {
      $cpt=$cpt+1;
   }
    if($cpt > 0) { 
   echo "<p align='center'>Voici les factures trouvées : <p>";
   $cpt=1;
   foreach ($a as $row) {
   echo "<form method='POST' action='FactureRetrouve.php'>
         <table align='center'>
         <tr>
            <td><p name='cc'> Num facture :</p></td>
            <td><input type='text' name='numfac' value='".$row['Num_facture']."' readonly='readonly'></input></td>
            <td><p>code client :</p></td>
            <td><input type='text' name='codecli' value='".$row['Compte_Ligue']."' readonly='readonly'></input></td>
         <td> <input class='btn btn-outline-primary' align='center' type='submit' value='Facture n°".$cpt."' /></td>
          </tr>
          </table>
      </form>";
      $cpt=$cpt+1;
   }
    }
          if($cpt==0){
       $articles = $dbh->query("SELECT * FROM Facture WHERE Echeance LIKE '%".$q."%'");
            $cpt=0;
            $a=$articles->fetchall();
          foreach ($a as $row) {
      $cpt=$cpt+1;
   }
    if($cpt > 0) { 
   echo "<p align='center'>Voici les factures trouvées : <p>";
   $cpt=1;
   foreach ($a as $row) {
   echo "<form method='POST' action='FactureRetrouve.php'>
         <table align='center'>
         <tr>
            <td><p name='cc'> Num facture :</p></td>
            <td><input type='text' name='numfac' value='".$row['Num_facture']."' readonly='readonly'></input></td>
            <td><p>code client :</p></td>
            <td><input type='text' name='codecli' value='".$row['Compte_Ligue']."' readonly='readonly'></input></td>
         <td> <input class='btn btn-outline-primary' align='center' type='submit' value='Facture n°".$cpt."' /></td>
          </tr>
          </table>
      </form>";
      $cpt=$cpt+1;
   }
    }
    if($cpt==0){
       $articles = $dbh->query("SELECT * FROM Ligne_Facture WHERE Libelle_Prestation LIKE '%".$q."%'");
            $cpt=0;
            $a=$articles->fetchall();
    foreach ($a as $row) {
      $cpt=$cpt+1;
   }
    if($cpt > 0) { 
      foreach ($a as $row) {
   $ar = $dbh->query("SELECT * FROM Facture where Num_facture LIKE '".$row['Num_Facture']."'");
   $ar=$ar->fetchall();
 }
     echo "<p align='center'>voici les factures trouvées : <p>";
         $cpt=1;
   foreach ($ar as $row) {
    echo "<form method='POST' action='FactureRetrouve.php'>
         <table align='center'>
         <tr>
            <td><p name='cc'> Num facture :</p></td>
            <td><input type='text' name='numfac' value='".$row['Num_facture']."' readonly='readonly'></input></td>";
   echo"<td><p>code client :</p></td>
            <td><input type='text' name='codecli' value='".$row['Compte_Ligue']."' readonly='readonly'></input></td>
         <td> <input class='btn btn-outline-primary' align='center' type='submit' value='Facture n°".$cpt."' /></td>
          </tr>
          </table>
      </form>";  


         $cpt=$cpt+1;     
   }
    }    

          if($cpt==0){
      $articles = $dbh->query("SELECT * FROM Facture WHERE Tresorier_Facture LIKE '%".$q."%'");
            $cpt=0;
            $a=$articles->fetchall();
    foreach ($a as $row) {
      $cpt=$cpt+1;
   }
    if($cpt > 0) { 
   echo "<p align='center'>Voici les factures trouvées : <p>";
    $cpt=1;
      foreach ($a as $row) {
    echo "<form method='POST' action='FactureRetrouve.php'>
         <table align='center'>
         <tr>
            <td><p name='cc'> Num facture :</p></td>
            <td><input type='text' name='numfac' value='".$row['Num_facture']."' readonly='readonly'></input></td>
            <td><p>code client :</p></td>
            <td><input type='text' name='codecli' value='".$row['Compte_Ligue']."' readonly='readonly'></input></td>
         <td> <input class='btn btn-outline-primary' align='center' type='submit' value='Facture n°".$cpt."' /></td>
          </tr>
          </table>
      </form>";  

         $cpt=$cpt+1;     
   }
 }
          if($cpt==0){
      $articles = $dbh->query("SELECT * FROM Facture WHERE rue_Facture LIKE '%".$q."%'");
            $cpt=0;
            $a=$articles->fetchall();
    foreach ($a as $row) {
      $cpt=$cpt+1;
   }
    if($cpt > 0) { 
   echo "<p align='center'>Voici les factures trouvées : <p>";
   $cpt=1;
      foreach ($a as $row) {
    echo "<form method='POST' action='FactureRetrouve.php'>
         <table align='center'>
         <tr>
            <td><p name='cc'> Num facture :</p></td>
            <td><input type='text' name='numfac' value='".$row['Num_facture']."' readonly='readonly'></input></td>
            <td><p>code client :</p></td>
            <td><input type='text' name='codecli' value='".$row['Compte_Ligue']."' readonly='readonly'></input></td>
         <td> <input class='btn btn-outline-primary' align='center' type='submit' value='Facture n°".$cpt."' /></td>
          </tr>
          </table>
      </form>";  


         $cpt=$cpt+1;     
   }
 }
          if($cpt==0){
      $articles = $dbh->query("SELECT * FROM Facture WHERE ville_Facture LIKE '%".$q."%'");
            $cpt=0;
            $a=$articles->fetchall();
    foreach ($a as $row) {
      $cpt=$cpt+1;
   }
    if($cpt > 0) {
   echo "<p align='center'>Voici les factures trouvées : <p>";
   $cpt=1;
      foreach ($a as $row) {
    echo "<form method='POST' action='FactureRetrouve.php'>
         <table align='center'>
         <tr>
            <td><p name='cc'> Num facture :</p></td>
            <td><input type='text' name='numfac' value='".$row['Num_facture']."' readonly='readonly'></input></td>
            <td><p>code client :</p></td>
            <td><input type='text' name='codecli' value='".$row['Compte_Ligue']."' readonly='readonly'></input></td>
         <td> <input class='btn btn-outline-primary' align='center' type='submit' value='Facture n°".$cpt."' /></td>
          </tr>
          </table>
      </form>";  

         $cpt=$cpt+1;     
   }
 }
          if($cpt==0){
      $articles = $dbh->query("SELECT * FROM Facture WHERE rue_Facture LIKE '%".$q."%'");
            $cpt=0;
            $a=$articles->fetchall();
    foreach ($a as $row) {
      $cpt=$cpt+1;
   }
    if($cpt > 0) {
    echo "<p align='center'>Voici les factures trouvées : <p>";
    $cpt=1;
      foreach ($a as $row) {
    echo "<form method='POST' action='FactureRetrouve.php'>
         <table align='center'>
         <tr>
            <td><p name='cc'> Num facture :</p></td>
            <td><input type='text' name='numfac' value='".$row['Num_facture']."' readonly='readonly'></input></td>
            <td><p>code client :</p></td>
            <td><input type='text' name='codecli' value='".$row['Compte_Ligue']."' readonly='readonly'></input></td>
         <td> <input class='btn btn-outline-primary' align='center' type='submit' value='Facture n°".$cpt."' /></td>
          </tr>
          </table>
      </form>";  

         $cpt=$cpt+1;     
   }
 }else{echo "Aucun élément trouvé pour :".$q;} 
   }
   }  
   }  
   } 
   }  
   } 
   }  
   }
   }
   }  
   }
   } 
   } 
}}
?>