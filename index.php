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
                        <td><h1>Home</h1></td>
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
				<ul>
					<li><h3><a href=ricerca.php>Ricerca</a></h3></li>
					<li><h3><a href=inserisciLibri.php>Inserisci Libro</a></h3></li>
					<li><h3><a href=inserisciAutori.php>Gestione Autori</a></h3></li>
					<li><h3><a href=inserisciGeneri.php>Gestione Generi</a></h3></li>
					<li><h3><a href=wishlist.php>Wish List</a></h3></li>
					<li><h3><a href=catalogo.php>Catalogo</a></h3></li>										<li><h3><a href=statistiche.php>Statistiche</a></h3></li>
				</ul>								
        	</div>   					
        </div>      
    </body>
</html>
