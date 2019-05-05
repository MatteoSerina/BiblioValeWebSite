<?php
    //carico script contenente i parametri di configurazione
    include_once 'config.php';
    //carico script di interfaccia al database
    include_once 'database.php';
    
     if(!isset($_POST['id_aut'])){
         header("Location: inserisciAutori.php");
     }
    //creo una connessione al database
    $conn = database::dbConnect();  
                                  
    //recupero parametri inseriti nella form               
    $id = html_entity_decode($_POST['id_aut']);
    $cognome = mysql_real_escape_string(html_entity_decode($conn, $_POST['nuovoCognome']));
    $nome = mysql_real_escape_string(html_entity_decode($conn, $_POST['nuovoNome'])); 
    
    //eseguo le query di aggiornamento                
    
    //Aggiorno l'autore
    $sqlUpdate = "UPDATE `autori` SET `cognome`=\"$cognome\",`nome`=\"$nome\"WHERE `id`=\"$id\"";
    database::qUpdate($conn, $sqlUpdate);
    //Torno alla pagina precedente
    header("Location: inserisciAutori.php?insert=OK");
    die();    
?>
