<?php
include_once 'config/connection.php';
include_once 'config/session.php';
include_once 'config/database.php';
include_once 'utilities.php';


try
{
    $server = $server.';dbname=matcha';
    $db = new PDO($server, $root, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    if (!isset($_POST['login']))
    {
        
        if (empty($_POST['email']) || empty($_POST['password']))
        {
            $result = "<p style='padding: 20px; color: blue;'>Please fill in the information!</p>";
        }
    }
    else
    {
        
        $email = htmlEntities($_POST['email']);
        $password = htmlEntities($_POST["password"]);
        

        $query = "SELECT * FROM user WHERE email = :email OR username = :email";
       
        $stmt = $db->prepare($query);
        $stmt->execute(array(':email' => $email, ':email' => $email));
        
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
        {
           
            $mail = $row['email'];
            $hashedPassword = $row['password'];
            $token = $row['token'];
            if (password_verify($password,  $hashedPassword) && $token == '1')
            {
                $_SESSION["id"] = $row['id'];
                $_SESSION["username"] = $row['username'];
                $_SESSION["password"] =  $hashedPassword;


                header("location: friends.php");
            
        }else if(password_verify($password,  $hashedPassword) && $token != '1'){
            $result = "<p style='padding: 20px; color: red; border: 1px solid gray'>Account has not been activated</p>";
        }
            else
            {
                $result = "<p style='padding: 20px; color: red;'>Invalid email or password</p>";
                echo "<script type='text/javascript'>alert('Please verify data');</script>";
            }
        }
    }
        
}
catch (PDOException $e) 
{
    echo "Error".$e->getMessage();
}

?>

<!DOCTYPE html>

<HTML>
    <HEAD>
        <TITLE>login</TITLE>
        <link rel="stylesheet" type="text/css" href="style.css"/>
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    </HEAD>
    <BODY class="bgi">

    <h2><div class="header"><img src="heart.png" height="50vh" width="60vw" >MATCHA</div></h2><br></br>
          
            <center><div class="container">
            
                <div class="head"><h2>Login</h2></div>
                <div class="head"><p>with Email</p></div>
                <?php if(isset($result)) echo $result ?>
            <form method="post" action="login.php">
                <div>
                <p>Email address / Username</p>
                <input type="text" name="email" class="inputText" required>
                <br />
                <p>Password</p>
                <input type="password" name="password" class="inputText" required>
                <br />
                <!-- <button type="submit" name="login"  value="Submit" >Submit</button> -->
                <input type="submit" value="Submit" name="login">
                <br>
                <a href="./signup.php" >Signup</a>
                <div><a href="./forgot_password.php">forgot my password ?</a></div>
                </div>
                
            </form>
            </div>
            
    </BODY>

</HTML>