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
                        <td><h1>Statistiche</h1></td>
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
				<div id="statistics" style="font-size:22px">
				<?php
					//carico script contenente i parametri di configurazione
					include_once 'config.php';
					//carico script di interfaccia al database
					include_once 'database.php';
					
					//creo una connessione al database
					$conn = database::dbConnect();
					
					//calcolo il numero di record				
					$sql = "SELECT * FROM `tutti_libri`";
					$tot_libri = mysql_num_rows(database::qSelect($conn, $sql));
					$sql = "SELECT * FROM `tutti_libri` WHERE `stato` = \"letto\"";
					$letti = mysql_num_rows(database::qSelect($conn, $sql));
					$sql = "SELECT * FROM `tutti_libri` WHERE `stato` = \"non letto\"";
					$non_letti = mysql_num_rows(database::qSelect($conn, $sql));
					$sql = "SELECT * FROM `tutti_libri` WHERE `stato` = \"in lettura\"";
					$in_lettura = mysql_num_rows(database::qSelect($conn, $sql));
					$sql = "SELECT * FROM `tutti_libri` WHERE `stato` = \"da consultazione\"";
					$consultazione = mysql_num_rows(database::qSelect($conn, $sql));
					$sql = "SELECT * FROM `tutti_libri` WHERE `stato` = \"abbandonato\"";
					$abbandonati = mysql_num_rows(database::qSelect($conn, $sql));
					$sql = "SELECT * FROM `tutti_libri` WHERE `stato` = \"wish list\"";
					$wish_list = mysql_num_rows(database::qSelect($conn, $sql));
					$libri_posseduti = $tot_libri - $wish_list;
					//scrivo la tabella con le statistiche
					echo "
						<table cellspacing=10>							
							<tr>
								<td>Letti:</td><td>$letti</td>
							</tr>
							<tr>
								<td>Non letti:</td><td>$non_letti</td>
							</tr>
							<tr>
								<td>In lettura:</td><td>$in_lettura</td>
							</tr>
							<tr>
								<td>Abbandonati:</td><td>$abbandonati</td>
							</tr>
							<tr>
								<td>Da consultazione:</td><td>$consultazione</td>
							</tr>
							<tr>
								<td>Wish list:</td><td>$wish_list</td>
							</tr>
							<tr>
								<td><b>Totale libri:</b></td><td><b>$libri_posseduti</b></td>
							</tr>
						</table>";
					
					mysql_close();
                ?>				
				</div>
			</div>
                <br>
        </div>      
        </div>      
    </body>
</html>
