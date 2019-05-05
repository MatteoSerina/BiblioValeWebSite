<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=0.9, maximum-scale=0.9 user-scalable=yes" />
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link rel="stylesheet" type="text/css" media="only screen and (max-device-width: 480px)" href="css/mobile-device.css" />
        <script type="text/javascript" src="js/update_select.js"></script>
        <script type="text/javascript" src="js/check_form.js"></script>
        <title>Libreria</title>
    </head>    
    <body>
        <div id="container">
            <div id="header_container">
                <table>
                    <tr>
                        <td width="30%"><a href="index.php"><img src="img/home.png" width="20%" height="20%"></a></td>
                        <td><h1>Gestione Autori</h1></td>
                        <td width="30%"><div style="float: right">
                            <?php
                            session_start();
                            include 'config.php';
                            if(isset($_SESSION[$session_name])){         
                                echo "<br><br><h3>Benvenuta " . $_SESSION['username'] . "!</a></h3>";
                                echo "<form method='POST' action='logout.php'>
                                        <input type='submit' value='logout' class='btn_login'>
                                    </form>";  
                            }
                            else{
                                header("Location:login_form.php");                        
                            }             
                            ?>
                        </div></td>
                    </tr>
                </table>                  
            </div>
            <div id="content_container"> 
            <br>
            <fieldset>
                <legend>Inserisci nuovo autore</legend>               
                <table>                        
                    <form action="inserisciAutori.php" method="POST">                        
                        <tr><td>Nome: </td><td><input type="text" name="nome" size=50></td></tr>
                        <tr><td>Cognome: </td><td><input type="text" name="cognome" size=50></td></tr>                
                        <tr><td><br><input type="submit" value="Salva"></td></tr> 
                    </form>
                </table>
            </fieldset>
            <fieldset>
                <legend>Modifica autore esistente</legend>
                <table>
                    <tr>
                        <td>&nbsp;</td>
                        <td>
                        <select id="nuovoAutore" name="nuovoAutore" onchange="mostraAutore()">                            
                            <?php
                            ob_start();
                            //carico script di interfaccia al database
                            include_once 'database.php';
                            
                            //creo una connessione al database
                            $conn = database::dbConnect();                            
                            //eseguo la query per l'estrazione di tutti gli autori
                            $sqlAUT = "SELECT `id`, `cognome`, `nome` FROM `autori` ORDER BY CONVERT(CAST(`cognome` AS BINARY) USING utf8)";
                            $resultAUT = database::qSelect($conn, $sqlAUT);
                            $list = array();
                            while($recordAUT = mysqli_fetch_array($resultAUT)){
                                extract($recordAUT);
                                echo "<option value=\"$cognome - $nome\">$cognome - $nome</option>";
                                $list[$cognome." - ".$nome] = $id;
                            }                            
                            database::dbClose($conn);
                            ?>
                        </select>   
                        </td>
                        <td><a href="#" onclick="confirmDeleteAut()">Elimina</a></td>
                    </tr>                    
                    <form action="update_authors.php" method="POST">
                        <tr><td>Nome: </td><td colspan="2"><input type="text" id="nuovoNome" name="nuovoNome" size=50></td></tr>
                        <tr><td>Cognome: </td><td colspan="2"><input type="text" id="nuovoCognome" name="nuovoCognome" size=50></td></tr>                
                        <tr><td><br><input type="submit" value="Salva"></td></tr>
                        <tr><td><input type="hidden" id="id_aut" name="id_aut"></td></tr> 
                    </form>
                </table>
            </fieldset>
            <?php
                if(isset($_GET['insert']))
					if($_GET['insert']=='OK')
                    	echo "<h4>Inserimento eseguito con successo!</h4>";				
                if(isset($_POST['nome'])){         
                    //carico script contenente i parametri di configurazione
                    include_once 'config.php';
                    //carico script di interfaccia al database
                    include_once 'database.php';
                    
                    $nome = html_entity_decode($_POST['nome']);
                    $cognome = html_entity_decode($_POST['cognome']);
					if(isset($_POST['id_aut']))
                    	$id = html_entity_decode($_POST['id_aut']);
                                   
                    //creo una connessione al database
                    $conn = database::dbConnect();
                    
					//verifico che non esista già l'autore che si sta per inserire
					$sqlCheck = "SELECT * FROM `autori` WHERE `nome` = \"$nome\" AND `cognome` = \"$cognome\"";
					$occorrenzeAutore = mysqli_num_rows(database::qSelect($conn, $sqlCheck));
					
					if($occorrenzeAutore==0){					
	                    //eseguo la query per l'inserimento dell'autore
	                    $sqlInsert = "INSERT INTO `autori`(`cognome`, `nome`) VALUES ('$cognome','$nome')";
	                    database::qInsertInto($conn, $sqlInsert);
	                    database::dbClose($conn);
	                    
	                    header("Location:inserisciAutori.php?insert=OK");
					}
					echo '<h4>Questo autore è già stato inserito!</h4>'; 
                }                
            ?>
        </div>      
        </div>      
    </body>
    <script type="text/javascript">
        function getID(autore){
            var x = <?php echo json_encode($list) ?>;
            var id = x[autore];
            return id;
        }
    </script>
</html>
