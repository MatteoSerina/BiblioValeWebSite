<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=0.8, maximum-scale=0.8, user-scalable=yes" />
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link rel="stylesheet" type="text/css" media="only screen and (max-device-width: 480px)" href="css/mobile-device.css" />
        <title>Libreria</title>
    </head>
    <body>
        <div id="container">
            <div id="header_container"> 
                <table>
                    <tr>
                        <td width="30%"><a href="index.php"><img src="img/home.png" width="20%" height="20%"></a></td>
                        <td><h1>Inserisci Libri</h1></td>
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
            <?php            
                //carico script contenente i parametri di configurazione
                include_once 'config.php';
                //carico script di interfaccia al database
                include_once 'database.php';
                                
                //creo una connessione al database
                $conn = database::dbConnect();
                
                //eseguo la query per l'estrazione di tutti gli autori
                $sqlAUT = "SELECT `id`, `nome`, `cognome` FROM `autori` ORDER BY `cognome`";
                $resultAUT = database::qSelect($conn, $sqlAUT);
                
                //eseguo la query per l'estrazione di tutti i generi
                $sqlGEN = "SELECT `id`, `nome` FROM `generi` ORDER BY `nome`";
                $resultGEN = database::qSelect($conn, $sqlGEN);
                database::dbClose($conn);
                ?>   
                <br>  
                <table>               
                <form action="update_book.php" method="POST">                    
                    <tr><td>Titolo: </td><td><input type="text" name="titolo" size=50></td></tr>
                    <tr><td>Autore: </td>
                    <td>    
                    <select name="autore" >
                        <?php
                            while($newAut = mysqli_fetch_array($resultAUT)){
                                $newName = $newAut['nome'];
                                $newSurname = $newAut['cognome'];
                                echo "<option value=\"$newSurname - $newName\"> $newSurname - $newName</option>";
                            }                            
                        ?>
                    </select>
                    </td></tr>
                    <tr><td>Genere: </td>
                    <td>
                        <select name="genere" >
                        <?php
                            while($newGen = mysqli_fetch_array($resultGEN)){
                                $newGenre = $newGen['nome'];
                                echo "<option value=\"$newGenre\"> $newGenre</option>";
                            }                            
                        ?>
                    </td></tr>    
                    <tr><td>Anno: </td><td><input type="text" name="anno" size=50></td></tr>      
                    <tr><td>Stato: </td>
                    <td>
                    <select name="stato" >
                        <option value="letto">Letto  </option>
                        <option value="non letto">Non Letto  </option>
                        <option value="in lettura">In Lettura  </option>
                        <option value="da consultazione">Da Consultazione  </option>
                        <option value="abbandonato">Abbandonato  </option>
                        <option value="wish list">Wish List  </option>
                    </select>
                    </td></tr>                    
                    <tr><td>Gradimento: </td><td><input type="text" name="gradimento" size=50></td></tr>   
                    <tr><td>Note: </td><td><textarea name="note" rows="8" cols="50"></textarea></td></tr>
                    <tr><td>
                    <br>
                    
                    <input type="submit" value="Salva"></td></tr>
                </form>
                </table>
                <?php
                    if(isset($_GET['insert'])){
                    	if($_GET['insert']=='OK')
                        	echo "<h4>Inserimento eseguito con successo!</h4>";
						else 
							echo "<h4>Questo libro è già stato inserito!</h4>";
                    }
                ?>
        </div>      
        </div>      
    </body>
</html>
