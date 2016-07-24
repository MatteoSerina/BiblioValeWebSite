<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=0.6, maximum-scale=0.6, user-scalable=yes" />
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
                        <td><h1>Gestione Generi</h1></td>
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
                <legend>Inserisci nuovo genere</legend>       
                <table>               
                <form action="inserisciGeneri.php" method="POST">                    
                    <tr><td>Genere: </td><td><input type="text" name="genere" size=50></td></tr>              
                    <tr><td><br><input type="submit" value="Salva"></td></tr>
                </form>
                </table>
            </fieldset> 
            <fieldset>
                <legend>Modifica genere esistente</legend>
                <table>
                    <tr>
                        <td>&nbsp;</td>
                        <td>
                            <select id="nuovoGenere" name="nuovoGenere" onchange="mostraGenere()">                            
                                <?php
                                //carico script di interfaccia al database
                                include_once 'database.php';
                                
                                //creo una connessione al database
                                $conn = database::dbConnect();                            
                                //eseguo la query per l'estrazione di tutti gli autori
                                $sqlAUT = "SELECT `id`, `nome` FROM `generi` ORDER BY `nome`";
                                $resultAUT = database::qSelect($conn, $sqlAUT);
                                $list = array();
                                while($recordAUT = mysql_fetch_array($resultAUT)){
                                    extract($recordAUT);
                                    echo "<option value=\"$nome\">$nome</option>";
                                    $list[$nome] = $id;
                                }                            
                                mysql_close();
                                ?>
                            </select>   
                        </td>
                        <td><a href="#" onclick="confirmDeleteGen()">Elimina</a></td>
                    </tr>
                    <form action="update_genres.php" method="POST">
                        <tr><td>Nome: </td><td colspan="2"><input type="text" id="nomeGenere" name="nomeGenere" size=50></td></tr>              
                        <tr><td><br><input type="submit" value="Salva"></td></tr>
                        <tr><td><input type="hidden" id="id_gen" name="id_gen"></td></tr> 
                    </form>                    
                </table>
            </fieldset>
            <?php
                if(isset($_GET['insert']))
					if($_GET['insert']=='OK')
                    	echo "<h4>Inserimento eseguito con successo!</h4>";
					else
						echo "<h4>Questo genere è già stato inserito!</h4>";
                if(isset($_POST['genere'])){         
                    //carico script contenente i parametri di configurazione
                    include_once 'config.php';
                    //carico script di interfaccia al database
                    include_once 'database.php';
                    
                    $genere = html_entity_decode($_POST['genere']);
                                   
                    //creo una connessione al database
                    $conn = database::dbConnect();
                    
                    //verifico che non esista già il genere che si sta per inserire
					$sqlCheck = "SELECT * FROM `generi` WHERE `nome` = \"$genere\"";
					$occorrenzeGenere = mysql_num_rows(database::qSelect($conn, $sqlCheck));
					
					if($occorrenzeGenere==0){
	                    //eseguo la query per l'inserimento del genere
	                    $sqlInsert = "INSERT INTO `generi`(`nome`) VALUES ('$genere')";
	                    database::qInsertInto($conn, $sqlInsert);
	                    mysql_close();
	                    
	                    header("Location:inserisciGeneri.php?insert=OK");
					}
					else{
						mysql_close();	                    
	                	header("Location:inserisciGeneri.php?insert=$occorrenzeGenere");
					}                  
                }
            ?>
        </div>      
        </div>      
    </body>
    <script type="text/javascript">
        function getID(genere){
            var x = <?php echo json_encode($list) ?>;
            var id = x[genere];
            return id;
        }
    </script>
</html>
