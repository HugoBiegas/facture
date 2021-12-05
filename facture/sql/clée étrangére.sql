ALTER Table Facture
ADD CONSTRAINT FK_FAC_TYP FOREIGN KEY (Compte_Ligue) REFERENCES Ligue (Compte);

ALTER Table Ligne_Facture 
ADD CONSTRAINT FK_LFAC1_TYP FOREIGN KEY (Num_Facture) REFERENCES Facture (Num_Facture);

ALTER Table Ligne_Facture
ADD CONSTRAINT FK_LFAC2_TYP FOREIGN KEY (Code_Prestation) REFERENCES Prestation (Code);