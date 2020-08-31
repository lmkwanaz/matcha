<?php
include_once 'config/dbection.php';
include_once 'utilities.php';
include_once 'config/database.php';
include_once 'config/session.php';

$server = $server.';dbname=matcha';
$db = new PDO($server, $root, $password);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$hash = isset($_GET['q']) ? $_GET['q'] : '';
$confirmpassword= isset($_POST['confirmpassword']) ? $_POST['confirmpassword'] : '';

try {


if (isset($_POST["q"]))
{
    $email = htmlEntities($_POST["email"]);
    $password = htmlEntities($_POST["password"]);
    $confirmpassword = htmlEntities($_POST["confirmpassword"]);
    $hash = htmlEntities($_POST["q"]);

        if ($password == $confirmpassword)
        {
            $password = password_hash($password, PASSWORD_BCRYPT);

                $query = $db->prepare('UPDATE user SET password = :password WHERE email = :email');
                $query->bindParam(':password', $password);
                $query->bindParam(':email', $email);
                $query->execute();
                $db = null;

                $result = "<p style='padding: 15px; color: green;'>Your password has been successsfully reset!</p>";
        }
        else
            $result = "<p style='padding: 15px; color: red;'>Your password's do not match.</p>";
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
            <center><div class="forgot">
            <?php echo $result ?>
            <div class="head1"><h1>Yeeeyi !!</h1></div>
            <img src="giphy.gif"/>
        
               <form method="POST" action="">
                <input type="text" name="email" placeholder="Email Address" required><br>
                <input type="password" name="password" value="" placeholder="new password" required><br>
                <input type="password" name="confirmpassword"  value=""placeholder="confirm password" required><br><br>
                <button type="hidden" value="" name="q" >Submit</button><br>
                <button type="signup" value="Submit"  onclick="window.location.href='login.php'">Login</button>
            
                <p>RESET PASSWORD</p>
               
            </BODY>

</HTML>