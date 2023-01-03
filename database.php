<?php
//carico classe logger
include 'logger.php';
         
    /*
    * Classe che si occupa dell'interazione tra l'applicazione php e il database
    */
    class database{
        /*
         * Opzioni logging
         */
        public static $d_DB_log_insert = false;
        public static $d_DB_log_update = false;
        public static $d_DB_log_select = false;
        
        /*
         * Parametri di connessione al database
         */
        //public static $dbHost = "mysql.hostinger.it";
        public static $dbHost = "localhost";
        public static $dbUser = "bibliovale";
        public static $dbPassword = "Sturm1989";
        public static $dbName = "bibliovale";
        
        /*
         * Connessione al database (charset: utf-8)
         */
        public static function dbConnect(){
            //creo una connessione al server
            $conn = mysqli_connect(database::$dbHost, database::$dbUser, database::$dbPassword, database::$dbName)
                or die("Errore nella connessione al DB Server: " . mysqli_error($conn));
            //Imposto charset utf-8
            mysqli_query($conn, "SET character_set_results=utf8");
            mb_language('uni'); 
            mb_internal_encoding('UTF-8');          
            //seleziono il database
            //mysqli_select_db(database::$dbName)
                //or die("Errore nella selezione del database: " . mysqli_error());
            //Imposto charset utf-8
            mysqli_query($conn, "set names 'utf8'");
            return $conn;
        }
        
        /*
         * Esecuzione di query di selezione
         */
        public static function qSelect($conn, $sql){            
            //debug
            if(database::$d_DB_log_select)
                logger::appendRowToFile($sql);
            //eseguo la query di selezione
            $risposta = mysqli_query($conn, $sql)
                or die("Errore nell'esecuzione della query di selezione: " . mysqli_error($conn));            
            //restituisco il risultato della query
            return $risposta; 
        }
        
        /*
         * Esecuzione di query di aggiornamento
         */
        public static function qUpdate($conn, $sql){            
            //debug
            if(database::$d_DB_log_update)
                logger::appendRowToFile($sql);
            //eseguo la query di aggiornamento
            mysqli_query($conn, $sql)
                or die("Errore nell'esecuzione della query di aggiornamento: " . mysqli_error($conn));
            //valore di ritorno in caso di corretto funzionamento
            return 0;
        }
        
        /*
         * Esecuzione di query di accodamento
         */
        public static function qInsertInto($conn, $sql){            
            //debug
            if(database::$d_DB_log_insert)
                logger::appendRowToFile($sql);
            //eseguo la query di accodamento
            mysqli_query($conn, $sql)
                or die("Errore nell'esecuzione della query di accodamento: " . mysqli_error($conn));
            //valore di ritorno in caso di corretto funzionamento
            return 0;
        }
        
        /*
         * Esecuzione di query di eliminazione
         */
        public static function qDelete($conn, $sql){            
            //eseguo la query di eliminazione
            mysqli_query($conn, $sql)
                or die("Errore nell'esecuzione della query di eliminazione: " . mysqli_error($conn));
            //valore di ritorno in caso di corretto funzionamento
            return 0;
        }
        
        /*
            chiusura connessione database
        */
        public static function dbClose($conn)
        {
            mysqli_close($conn);
        }
        
    }
?>
