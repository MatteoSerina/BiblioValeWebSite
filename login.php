<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=2.0, user-scalable=yes" />
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
                        <td><h1>Login</h1></td>                      
                    </tr>
                </table>             
			</div>
      		<div id="content_container">
      		<?php
      			//carico script contenente i parametri di configurazione
                include_once 'config.php';
                //carico script di interfaccia al database
                include_once 'database.php';                   
                
                //recupero username e password inseriti nella form
                $username = nl2br(htmlentities($_POST['username']));
                $password = nl2br(htmlentities($_POST['password']));
                //calcolo hash SHA256 della password inserita
                $hashPsw = hash('sha256', $password);
                //creo una connessione al database
                $conn = database::dbConnect();
                //recupero la password
                $sql = "SELECT `password` FROM `utenti` WHERE `username`=\"$username\"";
                $result = database::qSelect($conn, $sql);
                $record = mysqli_fetch_array($result);
                database::dbClose($conn);
                $dbPsw = $record['password'];
                //verifico matching tra la password inserita e quella salvata nel database
                //e se è giusta attivo la sessione, altrimenti scrivo che il login è fallito
                if(strcasecmp($hashPsw, $dbPsw) == 0){
                    session_start();
                    //inserisco username e password come variabili di sessione
                    $_SESSION['username'] = $_POST['username'];
                    $_SESSION['password'] = $dbPsw;
                    //attivo la sessione
                    $_SESSION[$session_name] = true;                    
                    header("Refresh: 0;url=index.php");
                }
                else{
                    header("Refresh: 0;url=login_form.php?badlogin=true");
                }
            ?>
      	    </div> 		
    	</div>    	
	</body>
</html>

