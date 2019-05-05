<?php
         
    /*
    * Classe che si occupa dell'interazione tra l'applicazione php e il database
    */
    class logger{
        /*
         * Parametri di logging
         */
        public static $log_file = 'log/log.txt'; 
        
        /*
         * Append text row to file log
         */
        public static function appendRowToFile($row){
            $handle = fopen(logger::$log_file, 'a') or die('Cannot open file:  '.logger::$log_file);
            $data = date("Y-m-d h:i:sa") . " - " . $row ."\n";        
            fwrite($handle, $data);
            fclose($handle);
        }      
        
    }
?>

