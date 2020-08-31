<?php
include_once 'config/connection.php';
include_once 'config/session.php';
include_once 'config/database.php';
include_once 'utilities.php';


$server = $server.';dbname=matcha';
$db = new PDO($server, $root, $password);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$email = isset($_POST['email']) ? $_POST['email'] : '';
$headers = isset($_POST['headers']) ? $_POST['headers'] : '';
$ms = isset($_POST['ms']) ? $_POST['ms'] : '';


$str = "/matcha/reset_password.php";
$us = explode("?", $_SERVER['REQUEST_URI']);
$us[0] = $str;
$us = implode("?", $us);
$url = "//{$_SERVER['HTTP_HOST']}{$us}";
try {

if (isset($_POST['submit'])) {

    
 if (filter_var($email , FILTER_VALIDATE_EMAIL)) {

    $result = "<p style='padding: 15px; color: green;'>An email has been sent to you!</p>";
    }else{

        $result = "<p style='padding: 15px; color: red;'>An error occured!</p>";


    }

    $username = $_SESSION['username'];
   
    $query = ('SELECT email FROM user WHERE email = :email ');
    $stmt = $db->prepare($query);
    $stmt->bindParam(':email', $email); 
    
    $stmt->execute();
    
    if($userExists = $stmt->fetch(PDO::FETCH_ASSOC))
    {

    $email = $_POST['email'];
    
    if ($userExists["email"])

    {
$token = mt_rand();
         $password = "";
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        
         for($i = 0; $i < 8; $i++)
         {
            $random_int = mt_rand();
             $password .= $chars[$random_int % strlen($chars)];
     
       
         }
         
        $to=$email;   
        $subject="www.noreply@matcha.com - RESET PASSWORD";
        $headers .= "MIME-Version: 1.0"."\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1'."\r\n";
        $headers .= 'From:matcha <www.noreply@matcha.com>'."\r\n";
                       
        $ms.="<html></body><div><div>Dear user,</div></br></br>";
        $ms.="<div style='padding-top:8px;'>If this e-mail does not apply to you please ignore it. It appears that you have requested a password reset, Please click the following link For verifying and reset your password,.</div>
        <br>
        \n\nNew password : ".$password.".<br><br>\r\n
        Click Here:\r\n 
        
         <a href='http:" . $url . "?token=" . $token . "&email=" . $email . "'>Go to link</a>
       <br>Thank you.<br>
          
            </div>
            </body></html>";
        mail($to,$subject,$ms,$headers);    


    $result = "<p style='padding: 15px; color: green;'>An email has been sent to you!</p>";
    }
    else
    {

    $result =  "<p style='padding: 15px; color: red;'>Opps !Your email does not exist!</p>";
    }
}
}
}

catch(PDOException $ex)

    {
        $result = "<p style='padding: 15px; color: red'>An error occurred: ".$ex->getMessage()." </p>";
    }


?>

                    
                   
<!DOCTYPE html>

<HTML>
    <HEAD>
        <TITLE>forgot password</TITLE>
        <link rel="stylesheet" type="text/css" href="style.css"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    </HEAD>
    <BODY class="bgi">
    <h2><div class="header"><img src="heart.png" height="50vh" width="60vw" >MATCHA</div></h2><br></br>

            <center><div class="container"
            <?php if(isset($result)) echo "$result" ?>
            <div class="head1"><h2>Oops !!</h2>
           
            <img src="https://i.pinimg.com/originals/ca/54/e0/ca54e0a12f6bd7dfd467ce59648c17eb.gif"/>
           
               <form method="post" action="">
                <input type="text" name="email" value"email" placeholder="Email Address" required><br>
                <button type="submit" value="Submit" name="submit" >Submit</button><br>
                <p>RESET PASSWORD</p></div>

     
            </BODY>

</HTML>