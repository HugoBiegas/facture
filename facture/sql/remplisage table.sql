DELETE FROM Ligue;
Insert Into Ligue Values(411007,'Ligue Lorraine Escrime','Valerie LAHEURTE','13 r Jean Moulin','54510','Tomblaine',1);
Insert Into Ligue Values(411008,'Ligue Lorraine de FootBall','Pierre LENOIR','8 r Jean Moulin',' 54510','Tomblaine',0);
Insert Into Ligue Values(411009,'Ligue Lorraine de Basket','Mohamed BOURGARD','10 r Jean Moulin',' 54510','Tomblaine',0);
Insert Into Ligue Values(411010,'Ligue Lorraine de Baby-foot','Sylvain DELAHOUSSE','19 r Jean Moulin','54510','Tomblaine',0);
SELECT * from Ligue; /*  compte, intituler ,tresorier , rue , code ,  verif */

DELETE FROM Prestation;
Insert Into Prestation Values('AFFRAN','Affranchissement',3.33);
Insert Into Prestation Values('PHOTOCOULEUR','Photocopies couleur',0.24);
Insert Into Prestation Values('PHOTON&B','Photocopies Noir et Blanc',0.055);
Insert Into Prestation Values('TRACEUR','Utilisation du traceur',0.356);
SELECT * from Prestation;	/* code,libelle ,Prix unitaire */

DELETE FROM Facture;
Insert Into Facture Values('FC 5174',411007,'2012-12-02','2012-02-29','Ligue Lorraine Escrime','Valerie LAHEURTE','13 r Jean Moulin','54510','Tomblaine',1,92.07); 
Insert Into Facture Values('FC 5175',411010,'2013-01-12','2013-01-31','Ligue Lorraine de Baby-foot','Sylvain DELAHOUSSE','19 r Jean Moulin','54510','Tomblaine',0,101.422);
SELECT * from Facture;	/* numfac,numcompte,date,date échéance, TTC */

DELETE FROM Ligne_Facture;
Insert Into Ligne_Facture Values('FC 5174','AFFRAN','Affranchissement',1,3.33);
Insert Into Ligne_Facture Values('FC 5174','PHOTOCOULEUR','Photocopies couleur',166,0.24);
Insert Into Ligne_Facture Values('FC 5174','PHOTON&B','Photocopies Noir et Blanc',889,0.055);
Insert Into Ligne_Facture Values('FC 5175','PHOTOCOULEUR','Photocopies couleur',300,0.24);
Insert Into Ligne_Facture Values('FC 5175','PHOTON&B','Photocopies Noir et Blanc',522,0.055);
Insert Into Ligne_Facture Values('FC 5175','TRACEUR','Utilisation du traceur',2,0.356);
SELECT * from Ligne_Facture; /*numFac,code_prestation,quantité */