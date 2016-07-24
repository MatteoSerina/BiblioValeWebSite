<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.1, maximum-scale=1.1, user-scalable=yes" />
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
                        <td><h1>Ricerca</h1></td>
                        <td width="30%"><div style="float: right">
                            <?php
                            session_start();
                            include 'config.php';
                            if(isset($_SESSION[$session_name])){         
                                echo "<br><br><h3>Benvenuta " . $_SESSION['username'] . "!</a></h3><br>";
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
      			<form name="form_ricerca" action="results.php" method="GET">
      			    <label>
      			        <h3>Cognome: </h3> <input type="text" name="cognome_aut" />
      			    </label>
      			    <br>
      			    <label>
                        <h3>Nome:</h3><input type="text" name="nome_aut" />
                    </label>
                    <br>
                    <label>
                        <h3>Titolo: </h3><input type="text" name="titolo" />
                    </label>
                    <br><br>
                    <input type="submit" value="Cerca" />
      			</form>
      	</div> 		
    	</div>
	</body>
</html>

