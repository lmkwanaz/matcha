<?php
include_once 'config/connection.php';
include_once 'config/session.php';
include_once 'config/database.php';
include_once 'utilities.php';

$server = $server.';dbname=matcha';
$db = new PDO($server, $root, $password);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$headers = isset($_POST['headers']) ? $_POST['headers'] : '';
$ms = isset($_POST['ms']) ? $_POST['ms'] : '';
  
    if (isset( $_GET['username']))
    {

        
        $username = $_GET['username'];
        $date = date('Y-m-d H:i:s');
        
        try{ 
         

                $sqlInsert = "INSERT INTO  reporteduser (id, username, date)
                VALUES (null ,:username, now())";
                $stmt = $db->prepare($sqlInsert);
                $stmt->bindParam(':username', $username);
                $stmt->execute();

  
                $to= "shadobuthelezi@gmail.com";
               
                $subject="www.noreply@matcha.com - User Report";
                $headers .= "MIME-Version: 1.0"."\r\n";
                $headers .= 'Content-type: text/html; charset=iso-8859-1'."\r\n";
                $headers .= 'From: <www.noreply@matcha.com>'."\r\n";
                               
                $ms.="<html></body><div><div>Dear Admin,</div></br></br>";
                $ms.="<div style='padding-top:8px;'> This user has been reported to have a fake account:.</div>
                <br>\n\n(" .$username.").\r\n<br>
             
                    </div>
                    </body></html>";
                mail($to,$subject,$ms,$headers);
                
                echo "<script type='text/javascript'>alert('Your email has been sent to the admin about your report!');window.location = './friends.php';</script>";
   
}
catch (PDOException $e) 
{
    echo "ERROR".$e->getMessage();
}
}

?>