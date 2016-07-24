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
                        <td><h1>Catalogo</h1></td>
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
                
                // imposto quanti risultati x pagina
                $rowsPerPage = 20;
                // impostiamo di default di mostrare x prima la prima pagina
                $pageNum = 1;
                // se $_GET['page'] è definito, lo si usa come page number
                if(isset($_GET['page']))
                    $pageNum = $_GET['page'];
                // calcolo l'offset
                $offset = ($pageNum - 1) * $rowsPerPage;
                
                //creo una connessione al database
                $conn = database::dbConnect();
                //eseguo la query di ricerca
                $sql = "SELECT * FROM `tutti_libri` ORDER BY `titolo` LIMIT $offset, $rowsPerPage";
                $result = database::qSelect($conn, $sql);
                if(mysql_num_rows($result)==0){
                    echo "<h4>Nessun risultato!</h4>";
                }
                else{
                    echo "<div align='center'><table id='myTable' class='tablesorter'><thead><tr><th>Titolo</th><th>Cognome</th><th>Nome</th><th>Stato</th></tr></thead><tbody>";
                    while($record = mysql_fetch_array($result)){
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
                ?>
                <br>
                <div id="pager" align="center">
                <?php
                //calcolo il numero di record				
                $sql = "SELECT * FROM `tutti_libri`";
                $result = database::qSelect($conn, $sql);
                $numrows = mysql_num_rows($result);
                echo "Totale libri: $numrows<br><br>";				
                //quante pagine sono?
                $maxPage = ceil($numrows/$rowsPerPage);
                
                // crea link per accedere ad ogni pagina
                $self = $_SERVER['PHP_SELF'];
                $nav  = "<select onchange=\"window.location.href=this.value\">";
                for($page = 1; $page <= $maxPage; $page++)
                {
                   if ($page == $pageNum)
                   {
                      $nav .= "<option value=\"$self?page=$page\" selected>$page</option>";
                   }
                   else
                   {
                      $nav .= "<option value=$self?page=$page>$page</option>";
                   }
                }
                $nav .= "</select>";
                // Creo i links Previous e Next
                // e quelli First page e Last page
                
                if ($pageNum > 1)
                {
                $page  = $pageNum - 1;
                   $prev  = " <a href=$self?page=$page>[Precedente]</a> ";
                   $first = " <a href=$self?page=1>[Inizio]</a> ";
                }
                else
                {
                   $prev  = '&nbsp;'; // se siamo nella 1° pag non mostriamo Prev
                   $first = '&nbsp;'; // e neanche il link alla 1° pag
                }
                
                if ($pageNum < $maxPage)
                {
                $page = $pageNum + 1;
                   $next = " <a href=$self?page=$page>[Successiva]</a> ";
                   $last = " <a href=$self?page=$maxPage>[Fine]</a> ";
                }
                else
                {
                   $next = '&nbsp;'; // siamo nell' ultima pag, nn mostriamo Next
                   $last = '&nbsp;'; // siamo nell' ultima pag, nn mostriamo il link Last 
                }
                
                // mostra i links di navigazione
                echo $first . $prev . "&nbsp;Vai alla pagina: " . $nav . $next . $last;
                
                
                mysql_close();
                ?>
                </div>
                <br>
        </div>      
        </div>      
    </body>
</html>
