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
                        <td><h1>Dettaglio</h1></td>
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
                
                //recupero parametri inseriti nella form
                $id_lib = nl2br(htmlentities($_GET['id']));
                //creo una connessione al database
                $conn = database::dbConnect();
                //eseguo la query di ricerca
                $sql = "SELECT * FROM `tutti_libri` WHERE `id`=$id_lib";
                $result = database::qSelect($conn, $sql);
                $libro = array();
                while($record = mysql_fetch_array($result)){
                    extract($record);      
                }
                //eseguo la query per l'estrazione di tutti gli autori
                $sqlAUT = "SELECT * FROM `autori`";
                $resultAUT = database::qSelect($conn, $sqlAUT);
                //eseguo la query per l'estrazione di tutti i generi
                $sqlGEN = "SELECT * FROM `generi`";
                $resultGEN = database::qSelect($conn, $sqlGEN);
                mysql_close();
                ?>   
                <br>  
                <table>               
                <form action="update_book.php" method="POST">                    
                    <tr><td>Titolo: </td><td><input type="text" name="titolo" size=50 value="<?php echo $titolo ?>"></td></tr>
                    <tr><td>Autore: </td>
                    <td>    
                    <select name="autore" >
                        <option value="<?php echo $cognome." - ".$nome?>" selected="selected"><?php echo $cognome." - ".$nome?>  </option>
                        <?php
                            while($newAut = mysql_fetch_array($resultAUT)){
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
                        <option value="<?php echo $genere?>" selected="selected"><?php echo $genere?>  </option>
                        <?php
                            while($newGen = mysql_fetch_array($resultGEN)){
                                $newGenre = $newGen['nome'];
                                echo "<option value=\"$newGenre\"> $newGenre</option>";
                            }                            
                        ?>
                    </td></tr>    
                    <tr><td>Anno: </td><td><input type="text" name="anno" size=50 value="<?php echo $anno ?>"></td></tr>      
                    <tr><td>Stato: </td>
                    <td>
                    <select name="stato" >
                        <option value="letto" <?php if($stato=="letto") echo 'selected=selected'?>>Letto  </option>
                        <option value="non letto" <?php if($stato=="non letto") echo 'selected=selected'?>>Non Letto  </option>
                        <option value="in lettura" <?php if($stato=="in lettura") echo 'selected=selected'?>>In Lettura  </option>
                        <option value="da consultazione" <?php if($stato=="da consultazione") echo 'selected=selected'?>>Da Consultazione  </option>
                        <option value="abbandonato" <?php if($stato=="abbandonato") echo 'selected=selected'?>>Abbandonato  </option>
                        <option value="wish list" <?php if($stato=="wish list") echo 'selected=selected'?>>Wish List  </option>
                    </select>
                    </td></tr>                    
                    <tr><td>Gradimento: </td><td><input type="text" name="gradimento" size=50 value="<?php echo $gradimento ?>"></td></tr>   
                    <tr><td>Note: </td><td><textarea name="note" rows="8" cols="50"><?php echo $note ?></textarea></td></tr>
                    <tr><td>
                    <br>
                    <input type="hidden" name="id" value="<?php echo $id_lib ?>" />
                    <input type="submit" value="Salva"></td></tr>
                </form>
                <tr><td><input type="button" value="Elimina libro" onclick="if(confirm('Vuoi davvero eliminare questo libro?')) { document.location.href = 'delete_book.php?id=<?php echo $id_lib ?>' }" /></td></tr>
                <tr><td><input type="button" value="Torna alla ricerca" onclick="window.history.back()" /></td></tr>
                </table>                 
        </div>      
        </div>      
    </body>
</html>
