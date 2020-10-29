<?php

    include_once 'connection.php';
    include_once 'database.php';

    try
    {
       

        $db = new PDO($server, $root, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


        $database = "DROP DATABASE IF EXISTS `matcha`";
        echo "Database dropped successfully.<br>";
        $create_dbs = $db->prepare($database);

        $create_dbs->execute();

        $database = "CREATE DATABASE IF NOT EXISTS `matcha`";
        echo "Database created successfully.<br>";
        $create_dbs = $db->prepare($database);

        $create_dbs->execute();

        $db->query("USE matcha");
        $db->query("CREATE TABLE IF NOT EXISTS `blockeduser` (
           `id` int(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
           `username` varchar(255) NOT NULL,
           `who_blocked` varchar(255) NOT NULL,
           `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE
           CURRENT_TIMESTAMP
            ) ENGINE=InnoDB DEFAULT CHARSET=latin1;
        ");
        echo "Table BLOCKED created successfully.<br>";

        $db->query("USE matcha");
        $db->query("CREATE TABLE IF NOT EXISTS `chats` (
           `id` int(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
           `from` varchar(225) NOT NULL,
            `to` varchar(255) NOT NULL,
            `text` MEDIUMTEXT NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=latin1;
        ");
        echo "Table CHATS created successfully.<br>";

        $db->query("USE matcha");
        $db->query("CREATE TABLE IF NOT EXISTS `geolocation` (
           `id` int(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
           `username` varchar(255) NOT NULL,
           `lati` double NOT NULL,
            `long` double NOT NULL,
            `show` int(11) NOT NULL DEFAULT '0'
            ) ENGINE=InnoDB DEFAULT CHARSET=latin1;
        ");
        echo "Table GEO created successfully.<br>";

       
        $db->query("USE matcha");
        $db->query("CREATE TABLE IF NOT EXISTS `likes` (
            `id` int(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            `username` varchar(255) NOT NULL,
            `who_liked` varchar(255) NOT NULL,
            `liked` int(11) NOT NULL DEFAULT '0',
            `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE
           CURRENT_TIMESTAMP
            ) ENGINE=InnoDB DEFAULT CHARSET=latin1;
        ");
        echo "Table LIKES created successfully.<br>";
       
        $db->query("USE matcha");
        $db->query("CREATE TABLE IF NOT EXISTS `pictures` (
             `id` int(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
             `username` varchar(30) NOT NULL,
             `image_name` varchar(255) NOT NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=latin1;
        ");
        echo "Table PICTURES created successfully.<br>";

        $db->query("USE matcha");
        $db->query("CREATE TABLE IF NOT EXISTS `interests` (
             `id` int(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
             `username` varchar(30) NOT NULL,
             `interest` varchar(255) NOT NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=latin1;
        ");
        echo "Table INTERESTS created successfully.<br>";
   
        $db->query("USE matcha");
        $db->query("CREATE TABLE IF NOT EXISTS `user` (
            `id` int(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            `firstname` varchar(30) DEFAULT NULL,
            `lastname` varchar(30) DEFAULT NULL,
            `username` varchar(30) DEFAULT NULL,
            `email` varchar(255) DEFAULT NULL,
            `password` varchar(255) DEFAULT NULL,
            `join_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            `lastseen` int(11) NOT NULL DEFAULT '0',
            `token` int(11) NOT NULL DEFAULT '0',
            `noti` int(5) not null DEFAULT '0',
            `no_of_pictures` int(11) NOT NULL DEFAULT '0'
            ) ENGINE=InnoDB DEFAULT CHARSET=latin1;
        ");
        echo "Table USER created successfully.<br>";
       
        $db->query("USE matcha");
        $db->query("CREATE TABLE IF NOT EXISTS `user_profile` (
            `user_id` int(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            `gender` varchar(6) NOT NULL,
            `biography` MEDIUMTEXT NULL,
            `age` int(3) NOT NULL,
            `sexuality` varchar(255) NOT NULL,
            `city` varchar(255) NOT NULL,
            `Status` varchar(500) NOT NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=latin1;
        ");
        echo "Table USER_PROFILE created successfully.<br>";

        
        $db->query("USE matcha");
        $db->query("CREATE TABLE IF NOT EXISTS `reporteduser` (
            `id` int(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            `username` varchar(255) NOT NULL,
            `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE
            CURRENT_TIMESTAMP
            ) ENGINE=InnoDB DEFAULT CHARSET=latin1;
        ");
       echo "Table REPORTED created successfully.<br>";
       
        $db->query("USE matcha");
        $db->query("CREATE TABLE IF NOT EXISTS `views` (
            `id` int(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            `username` varchar(255) NOT NULL,
            `fame_rating` int(11) NOT NULL DEFAULT '0',
            `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE
            CURRENT_TIMESTAMP
            ) ENGINE=InnoDB DEFAULT CHARSET=latin1;
        ");
        echo "Table VIEWS created successfully.<br>";

        $db->query("USE matcha");
        $db->query("CREATE TABLE IF NOT EXISTS `profile_pic` (
            `id` int(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            `username` varchar(255) NOT NULL,
            `post_id` int(11) NOT NULL,
            `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE
            CURRENT_TIMESTAMP
            ) ENGINE=InnoDB DEFAULT CHARSET=latin1;
        ");

        $db->query("USE matcha");
        $db->query("CREATE TABLE IF NOT EXISTS `notifications` (
            `id` int(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            `user_to` varchar(255) NOT NULL,
            `user_from` varchar(255) NOT NULL,
            `Description` varchar(1000) NOT NULL,
            `status` int(11) NOT NULL,
            `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE
            CURRENT_TIMESTAMP
            ) ENGINE=InnoDB DEFAULT CHARSET=latin1;
        ");
        echo "Table Notifications created successfully.<br>";

         
    }
    catch (PDOException $e) 
    {
        echo "Database failed".'<br>'.$e->getMessage();
    }

    $e_username = 'lmkwanaz';
    $e_profilepic = 'images/efemale.jpeg';
    $e_postId = 1;
    $e_firstname = 'Lwandile';
    $e_lastname = 'Mkwanazi';
    $e_email = 'lrmkwanazi38@gmail.com';
    $e_passwd = 'Password@1';
    $e_hashed = password_hash($e_passwd, PASSWORD_DEFAULT);
    $e_token = '1';
    $e_gender = 'Male';
    $e_age = 21;
    $e_sexuality = 'women';
    $e_biography = 'I am a developer';
    $e_interests = 'music';
    $e_status = 'greatness of god';
    $e_lastseen = '0';
    $e_latitude = '-27.862744';
    $e_longitude = '27.831237';
    $e_no_of_pictures = '2';
    $e_show = '1';
    $e_city = 'johannesburg';
    $e_fame_rating= '20';

    $sql = $db->prepare('INSERT IGNORE INTO user (firstname, lastname, username, email, password, lastseen, token, no_of_pictures) VALUES (?, ?, ?, ?, ?, ?, ?, ?);');
     $sql->execute([$e_firstname, $e_lastname, $e_username, $e_email, $e_hashed, $e_lastseen, $e_token, $e_no_of_pictures]);
     $sql = $db->prepare('INSERT IGNORE INTO user_profile (gender, biography, age, sexuality, city, status) VALUES (?, ?, ?, ?, ?, ?);');
     $sql->execute([$e_gender, $e_biography, $e_age, $e_sexuality, $e_city, $e_status]);
     $sql = $db->prepare('INSERT IGNORE INTO views (username, fame_rating) VALUES (?, ?);');
     $sql->execute([$e_username, $e_fame_rating]);
     $sql = $db->prepare('INSERT IGNORE INTO interests (username, interest) VALUES (?, ?);');
     $sql->execute([$e_username, $e_interests]);
     $sql = $db->prepare('INSERT IGNORE INTO pictures (username, image_name) VALUES (?, ?);');
     $sql->execute([$e_username, $e_profilepic]);
     $sql = $db->prepare('INSERT IGNORE INTO profile_pic (username, post_id) VALUES (?, ?);');
     $sql->execute([$e_username, $e_postId]);
     $sql = $db->prepare('INSERT IGNORE INTO geolocation (username, lati, `long`, `show`) VALUES (?, ?, ?, ?);');
     $sql->execute([$e_username, $e_latitude, $e_longitude, $e_show]);


     $e_username = 'nngwenya';
    $e_profilepic = 'images/dog.webp';
    $e_postId = 1;
    $e_firstname = 'Gwen';
    $e_lastname = 'Ngwenya';
    $e_email = 'gwen@gmail.com';
    $e_passwd = 'Password@1';
    $e_hashed = password_hash($e_passwd, PASSWORD_DEFAULT);
    $e_token = '1';
    $e_gender = 'Female';
    $e_age = 21;
    $e_sexuality = 'man';
    $e_biography = 'I am a developer';
    $e_interests = 'actress';
    $e_status = 'greatness of god';
    $e_lastseen = '0';
    $e_latitude = '-28.862744';
    $e_longitude = '28.831237';
    $e_no_of_pictures = '2';
    $e_show = '1';
    $e_city = 'johannesburg';
    $e_fame_rating= '20';

    $sql = $db->prepare('INSERT IGNORE INTO user (firstname, lastname, username, email, password, lastseen, token, no_of_pictures) VALUES (?, ?, ?, ?, ?, ?, ?, ?);');
     $sql->execute([$e_firstname, $e_lastname, $e_username, $e_email, $e_hashed, $e_lastseen, $e_token, $e_no_of_pictures]);
     $sql = $db->prepare('INSERT IGNORE INTO user_profile (gender, biography, age, sexuality, city, status) VALUES (?, ?, ?, ?, ?, ?);');
     $sql->execute([$e_gender, $e_biography, $e_age, $e_sexuality, $e_city, $e_status]);
     $sql = $db->prepare('INSERT IGNORE INTO views (username, fame_rating) VALUES (?, ?);');
     $sql->execute([$e_username, $e_fame_rating]);
     $sql = $db->prepare('INSERT IGNORE INTO interests (username, interest) VALUES (?, ?);');
     $sql->execute([$e_username, $e_interests]);
     $sql = $db->prepare('INSERT IGNORE INTO pictures (username, image_name) VALUES (?, ?);');
     $sql->execute([$e_username, $e_profilepic]);
     $sql = $db->prepare('INSERT IGNORE INTO profile_pic (username, post_id) VALUES (?, ?);');
     $sql->execute([$e_username, $e_postId]);
     $sql = $db->prepare('INSERT IGNORE INTO geolocation (username, lati, `long`, `show`) VALUES (?, ?, ?, ?);');
     $sql->execute([$e_username, $e_latitude, $e_longitude, $e_show]);

     $e_username = 'ssibeko';
    $e_profilepic = 'images/dog.webp';
    $e_postId = 1;
    $e_firstname = 'siyabonga';
    $e_lastname = 'sibeko';
    $e_email = 'sya@gmail.com';
    $e_passwd = 'Password@1';
    $e_hashed = password_hash($e_passwd, PASSWORD_DEFAULT);
    $e_token = '1';
    $e_gender = 'Male';
    $e_age = 20;
    $e_sexuality = 'female';
    $e_biography = 'I am a developer';
    $e_interests = 'soccer player';
    $e_status = 'greatness of god';
    $e_lastseen = '0';
    $e_latitude = '-28.862744';
    $e_longitude = '28.831237';
    $e_no_of_pictures = '2';
    $e_show = '1';
    $e_city = 'johannesburg';
    $e_fame_rating= '20';

    $sql = $db->prepare('INSERT IGNORE INTO user (firstname, lastname, username, email, password, lastseen, token, no_of_pictures) VALUES (?, ?, ?, ?, ?, ?, ?, ?);');
     $sql->execute([$e_firstname, $e_lastname, $e_username, $e_email, $e_hashed, $e_lastseen, $e_token, $e_no_of_pictures]);
     $sql = $db->prepare('INSERT IGNORE INTO user_profile (gender, biography, age, sexuality, city, status) VALUES (?, ?, ?, ?, ?, ?);');
     $sql->execute([$e_gender, $e_biography, $e_age, $e_sexuality, $e_city, $e_status]);
     $sql = $db->prepare('INSERT IGNORE INTO views (username, fame_rating) VALUES (?, ?);');
     $sql->execute([$e_username, $e_fame_rating]);
     $sql = $db->prepare('INSERT IGNORE INTO interests (username, interest) VALUES (?, ?);');
     $sql->execute([$e_username, $e_interests]);
     $sql = $db->prepare('INSERT IGNORE INTO pictures (username, image_name) VALUES (?, ?);');
     $sql->execute([$e_username, $e_profilepic]);
     $sql = $db->prepare('INSERT IGNORE INTO profile_pic (username, post_id) VALUES (?, ?);');
     $sql->execute([$e_username, $e_postId]);
     $sql = $db->prepare('INSERT IGNORE INTO geolocation (username, lati, `long`, `show`) VALUES (?, ?, ?, ?);');
     $sql->execute([$e_username, $e_latitude, $e_longitude, $e_show]);

     
     
?>