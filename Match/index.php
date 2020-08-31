<?php 

include_once 'config/connection.php';
include_once 'config/database.php';

$server = $server.';dbname=matcha';
$db = new PDO($server, $root, $password);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>
<!DOCTYPE html>

<HTML>
    <HEAD>
    <TITLE>matcha.com</TITLE>
    <link rel="stylesheet" type="text/css" href="style.css"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
 
    </HEAD>
    <BODY>
    
    <h2><div class="header"><img src="heart.png" height="50vh" width="60vw" >MATCHA</div></h2><br></br>
    <header>
    <p>FIND LOVE WITH MATCHA</p>
    
            
    

    <p>You are currently not registered <a href="login.php">login</a>  Not yet a member? <a href="signup.php">Signup</a> </p>
    </header>
        <br>
        <BODY class="indexb">

        <center><img src="couple.png" width="700" height="350"></center><br/>
        
    </div><br>
            
</BODY>
</HTML>