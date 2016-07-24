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

 if(!isset($_POST['id_gen'])){
     header("Location: inserisciGeneri.php");
 }
 
//creo una connessione al database
$conn = database::dbConnect();   
                             
//recupero parametri inseriti nella form               
$id = html_entity_decode($_POST['id_gen']);
$genere = mysql_real_escape_string(html_entity_decode($_POST['nomeGenere']));

//eseguo le query di aggiornamento                

//Aggiorno l'autore
$sqlUpdate = "UPDATE `generi` SET `nome`=\"$genere\"WHERE `id`=\"$id\"";
database::qUpdate($conn, $sqlUpdate);
//Torno alla pagina precedente
header("Location: inserisciGeneri.php?insert=OK");
die();    
?>