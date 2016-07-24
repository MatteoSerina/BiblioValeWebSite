<?php
session_start();
include 'config.php';
if(isset($_SESSION[$session_name])){         
    
}
else{
    header("Location:login_form.php");                        
}             

//carico script contenente i parametri di configurazione
include_once 'config.php';
//carico script di interfaccia al database
include_once 'database.php';

//creo una connessione al database
$conn = database::dbConnect();    
                           
//recupero parametri inseriti nella form
if(isset($_POST['id']))
    $id_lib = mysql_real_escape_string(html_entity_decode($_POST['id']));
$titolo = mysql_real_escape_string(html_entity_decode($_POST['titolo']));
$autore = mysql_real_escape_string(html_entity_decode($_POST['autore'])); //da esplodere con ' - '
$genere = mysql_real_escape_string(html_entity_decode($_POST['genere']));
$anno = mysql_real_escape_string(html_entity_decode($_POST['anno']));
$stato = mysql_real_escape_string(html_entity_decode($_POST['stato']));
$gradimento = mysql_real_escape_string(html_entity_decode($_POST['gradimento']));
$note = mysql_real_escape_string(html_entity_decode($_POST['note']));                
$autV = explode(" - ",$autore);


//eseguo le query di aggiornamento

//recupero id autore            
$sqlAUT = "SELECT * FROM `autori` WHERE `cognome` = '".trim($autV[0])."' AND `nome` = '".trim($autV[1])."'";
$resultAUT = database::qSelect($conn, $sqlAUT);
$recordAUT = mysql_fetch_assoc($resultAUT);
$id_aut = $recordAUT['id'];
//recupero id genere                
$sqlGEN = "SELECT id FROM generi WHERE nome = \"$genere\"";
$resultGEN = database::qSelect($conn, $sqlGEN);
$recordGEN = mysql_fetch_assoc($resultGEN);
$id_gen = $recordGEN['id'];

if(isset($_POST['id'])){	
    //Aggiorno il libro
    $sqlUpdate = "UPDATE `libri` SET `titolo`=\"$titolo\",`id_autore`=\"$id_aut\",`id_genere`=\"$id_gen\",`anno`=\"$anno\",`stato`=\"$stato\",`gradimento`=\"$gradimento\",`note`=\"$note\" WHERE `id`=\"$id_lib\"";
    database::qUpdate($conn, $sqlUpdate);
    //Torno alla pagina precedente
    header("Location: modifica.php?id=$id_lib");
    die();
}
else{
	//verifico che non esista già il libro che si sta per inserire
	$nome = trim($autV[1]);
	$cognome = trim($autV[0]);
	$sqlCheck = "SELECT * FROM `tutti_libri` WHERE `nome` = \"$nome\" AND `cognome` = \"$cognome\" AND `titolo` = \"$titolo\"";
	$occorrenzeLibro = mysql_num_rows(database::qSelect($conn, $sqlCheck));
	
	if($occorrenzeLibro==0){
	    //Inserisco il libro
	    $sqlInsert = "INSERT INTO `libri`(`titolo`, `id_autore`, `id_genere`, `anno`, `stato`, `gradimento`, `note`) VALUES ('$titolo','$id_aut','$id_gen','$anno','$stato','$gradimento','$note')";
	    database::qInsertInto($conn, $sqlInsert);
	    //Torno alla pagina precedente
	    header("Location: inserisciLibri.php?insert=OK");
	    die();
	}
	header("Location: inserisciLibri.php?insert=$occorrenzeLibro");
	die();
}


?>