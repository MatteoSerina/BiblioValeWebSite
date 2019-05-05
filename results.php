<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=0.6, maximum-scale=0.6, user-scalable=yes" />
        <script type="text/javascript" src="js/jquery-latest.js"></script> 
        <script type="text/javascript" src="js/jquery.tablesorter.js"></script> 
        <script type="text/javascript" src="js/execTablesorter.js"></script>
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
                        <td><h1>Risultati</h1></td>
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
                $surname = html_entity_decode($_GET['cognome_aut']);
                $name = html_entity_decode($_GET['nome_aut']);
                $title = html_entity_decode($_GET['titolo']);
                
                //creo una connessione al database
                $conn = database::dbConnect();
                //eseguo la query di ricerca
                $sql = "SELECT * FROM `tutti_libri` WHERE `titolo` LIKE \"%$title%\" AND `cognome` LIKE \"%$surname%\" AND `nome` LIKE \"%$name%\"";
                $result = database::qSelect($conn, $sql);
                if(mysqli_num_rows($result)==0){
                    echo "<h4>Nessun risultato!</h4>";
                }
                else{
                    echo "<div align='center'><table id='myTable' class='tablesorter'><thead><tr><th>Titolo</th><th>Cognome</th><th>Nome</th><th>Stato</th></tr></thead><tbody>";
                    while($record = mysqli_fetch_array($result)){
                        extract($record);
                        $html_row = "<tr onclick=\"document.location = 'modifica.php?id=$id';\">
                                    <td>$titolo</td>
                                    <td>$cognome</td>
                                    <td>$nome</td>
                                    <td>$stato</td>
                                    ";
                        echo $html_row;
                    }
                    echo "</tbody></table></div>";
                }
                database::dbClose($conn);
                ?>
        </div>      
        </div>      
    </body>
</html>
