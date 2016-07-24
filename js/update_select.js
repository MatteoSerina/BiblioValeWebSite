/**
 * @author Matteo
 */

//Funzione che mostra i dettagli di autore
function mostraAutore(){
	var autore = document.getElementById("nuovoAutore").value;
	var autV = autore.split(" - ");
	document.getElementById("nuovoCognome").value = autV[0];
	document.getElementById("nuovoNome").value = autV[1];
	var id = getID(autore);
	document.getElementById("id_aut").value = id;
		
}

//Funzione che mostra i dettagli di genere
function mostraGenere(){
	var genere = document.getElementById("nuovoGenere").value; 
	document.getElementById("nomeGenere").value = genere;
	var id = getID(genere);
	document.getElementById("id_gen").value = id;		
}
