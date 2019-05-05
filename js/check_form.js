/**
 * @author Matteo
 */
function confirmDeleteAut(){
	var autore = document.getElementById("nuovoAutore").value;
	var id = getID(autore);
	if(confirm("Vuoi davvero eliminare questo autore?"))
		window.open("delete_author.php?id="+id,"_self");
}
function confirmDeleteGen(){
	var genere = document.getElementById("nuovoGenere").value;
	var id = getID(genere);
	if(confirm("Vuoi davvero eliminare questo genere?"))
		window.open("delete_genre.php?id="+id,"_self");
}
