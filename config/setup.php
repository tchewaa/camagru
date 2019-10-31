<?php
require("database.php");
try {
    $conn = new PDO($DB_DNS_LIGHT, $DB_USER, $DB_PASSWORD);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "CREATE DATABASE IF NOT EXISTS $DB_NAME";
    $conn->exec($sql);

    $sql = "USE $DB_NAME ;
            CREATE TABLE IF NOT EXISTS `admin` (`admin_id` int(11) NOT NULL,`admin_name` varchar(30) NOT NULL,`admin_password` int(100) NOT NULL,`date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()) ENGINE=InnoDB DEFAULT CHARSET=latin1;
            CREATE TABLE IF NOT EXISTS `followers` (`follower_id` int(11) NOT NULL,`user_id` int(11) NOT NULL,`timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(), `reject_deny_option` tinyint(4) DEFAULT NULL) ENGINE=InnoDB DEFAULT CHARSET=utf8;
            CREATE TABLE IF NOT EXISTS `following` (`following_id` int(11) NOT NULL,`user_id` int(11) NOT NULL,`timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),`reject_deny_option` tinyint(4) NOT NULL) ENGINE=InnoDB DEFAULT CHARSET=utf8; 
            CREATE TABLE IF NOT EXISTS `image` (`image_id` int(11) NOT NULL,`user_id` int(11) NOT NULL,`caption` varchar(300) NOT NULL) ENGINE=InnoDB DEFAULT CHARSET=latin1;
            CREATE TABLE IF NOT EXISTS `likes` (`image_id` int(11) NOT NULL,`liker_id` int(11) NOT NULL,`date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()) ENGINE=InnoDB DEFAULT CHARSET=latin1;
            CREATE TABLE IF NOT EXISTS `users` (`user_id` int(11) NOT NULL,`username` varchar(30) NOT NULL,`password` varchar(100) NOT NULL,`email_address` varchar(40) NOT NULL,`fullname` varchar(30) NOT NULL,`active` int(10) NOT NULL,`token` varchar(255) DEFAULT NULL,`website` varchar(100) DEFAULT NULL,`bio` varchar(200) DEFAULT NULL,`phone` int(11) DEFAULT NULL,`gender` varchar(20) DEFAULT NULL,`profile_pic_url` varchar(100) DEFAULT NULL,`privacy_level` tinyint(1) DEFAULT NULL) ENGINE=InnoDB DEFAULT CHARSET=latin1;
            ALTER TABLE `admin` ADD PRIMARY KEY (`admin_id`);
            ALTER TABLE `image` ADD PRIMARY KEY (`image_id`);
            ALTER TABLE `likes` ADD PRIMARY KEY (`image_id`);
            ALTER TABLE `users` ADD PRIMARY KEY (`user_id`,`username`), ADD UNIQUE KEY `email_add` (`email_address`);
            ALTER TABLE `users` CHANGE `user_id` `user_id` INT(11) NOT NULL AUTO_INCREMENT;
            ALTER TABLE `admin` CHANGE `admin_id` `admin_id` INT(11) NOT NULL AUTO_INCREMENT;
            ALTER TABLE `image` CHANGE `image_id` `image_id` INT(11) NOT NULL AUTO_INCREMENT;";            
    $conn->exec($sql);
    
    
    }
catch(PDOException $e)
    {
        echo "Connection failed: " . $e->getMessage();
    }
    //$conn = NULL;

?>

