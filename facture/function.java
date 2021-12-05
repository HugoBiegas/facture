function ajouterLigne()
{
	var tableau = document.getElementById("tableau");

	var ligne = tableau.insertRow(-1);//on a ajouté une ligne

	var colonne1 = ligne.insertCell(0);//on a une ajouté une cellule
	colonne1.innerHTML += document.getElementById("titre").value;//on y met le contenu de titre

	var colonne2 = ligne.insertCell(1);//on ajoute la seconde cellule
	colonne2.innerHTML += document.getElementById("auteur").value;

	var date = new Date();
	var colonne3 = ligne.insertCell(2);
	colonne3.innerHTML += date.getDate();//on ajoute le jour du mois

	var colonne4 = ligne.insertCell(3);
	colonne4.innerHTML += date.getMonth()+1;//les mois commencent par 0

	var colonne5 = ligne.insertCell(4);
	colonne5.innerHTML += date.getFullYear();
}
