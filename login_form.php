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
                            ?>
                        </div></td>
                    </tr>
                </table>              
			</div>
      		<div id="content_container">
                <form method="POST" action="login.php">
                <table>
                    <tr>
                        <td colspan='2'><h3>Login:</h3></td>    
                    </tr>
                    <tr>
                        <td class="td_left">Username:</td><td><input type="text" name="username"></td>
                    </tr>
                    <tr>
                        <td class="td_left">Password:</td><td><input type="password" name="password"></td>
                    </tr>
                    <tr>
                        <td colspan="2"><input class="btn_login" type="submit" value="Entra"></td>
                    </tr>
                    <?php
                        if(isset($_GET['badlogin']))
                            echo "<tr><td>&nbsp</td><td><b>Credenziali errate!</b></td></tr>";
                    ?>
                </table>
                </form>
            </div> 		
    	</div>    	
	</body>
</html>

