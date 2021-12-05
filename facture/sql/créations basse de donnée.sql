drop database facturem2l;
create database facturem2l;
use facturem2l;
drop table if exists ligue;
drop table if exists prestation;
drop table if exists facture;
drop table if exists ligne_facture;

CREATE TABLE Ligue 
	(
	Compte integer(6) NOT NULL,
	Intituler Varchar(30) NOT NULL,
	Tresorier Varchar(30) NOT NULL,
	rue Varchar(50) NOT NULL,
	code_postal integer NOT NULL,
	ville varchar(20) NOT NULL,
	verif boolean NOT NULL,
	Constraint PK_ligue PRIMARY KEY (Compte)
	)Engine = Innodb;

CREATE TABLE Prestation
	(
	Code Varchar(30) NOT NULL,
	Libelle Varchar(30) NOT NULL,
	PU decimal(5,3) NOT NULL,
	Constraint PK_prestation PRIMARY KEY (Code)
	)Engine = Innodb;

CREATE TABLE Facture
	(
	Num_facture char(7) NOT NULL,
	Compte_Ligue integer(6) NOT NULL,
	Ndate Date NOT NULL,
	Echeance Date NOT NULL,
	Intituler_Facture Varchar(30) NOT NULL,
	Tresorier_Facture Varchar(30) NOT NULL,
	rue_Facture Varchar(50) NOT NULL,
	code_postal_Facture integer NOT NULL,
	ville_Facture varchar(20) NOT NULL,
	verif_Facture boolean NOT NULL,
	TTC decimal(9,3)NOT NULL,
	Constraint PK_facture PRIMARY KEY (Num_facture)
	)Engine = Innodb;

CREATE TABLE Ligne_Facture
	(
	Num_Facture char(9) NOT NULL,
	Code_Prestation Varchar(30) NOT NULL,
	Libelle_Prestation Varchar(30) NOT NULL,
	Quantite_Prestation integer(10) NOT NULL,
	PU_Prestation decimal(5,3) NOT NULL,
	Constraint PK_lignefacture PRIMARY KEY (Num_Facture,Code_Prestation)
	)Engine = Innodb;