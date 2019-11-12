<?php
require("database.php");
try {
    $conn = new PDO($DB_D, $DB_USER, $DB_PASSWORD);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql =  "CREATE DATABASE IF NOT EXISTS camagru_db;";
    // $sql .= "CREATE TABLE IF NOT EXISTS `comments` (`comment_id` int(11) NOT NULL,`image_id` int(11) NOT NULL,`user_id` int(11) NOT NULL,`comment` varchar(300) NOT NULL,`comment_date` datetime NOT NULL DEFAULT current_timestamp()) ENGINE=InnoDB DEFAULT CHARSET=latin1;";
    // $sql .= "CREATE TABLE IF NOT EXISTS `image` (`image_id` int(11) NOT NULL,`user_id` int(11) NOT NULL,`image_caption` varchar(300) DEFAULT NULL,`image_name` varchar(200) NOT NULL,`image_path` varchar(300) NOT NULL,`image_time` datetime NOT NULL DEFAULT current_timestamp()) ENGINE=InnoDB DEFAULT CHARSET=latin1;";
    // $sql .= "CREATE TABLE IF NOT EXISTS `likes` (`image_id` int(11) NOT NULL,`liker_id` int(11) NOT NULL,`date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()) ENGINE=InnoDB DEFAULT CHARSET=latin1;";
    // $sql .= "CREATE TABLE IF NOT EXISTS `users` ( `user_id` int(11) NOT NULL,`username` varchar(30) NOT NULL,`password` varchar(100) NOT NULL,`email_address` varchar(40) NOT NULL,`fullname` varchar(30) NOT NULL,`active` int(10) NOT NULL,`token` varchar(255) DEFAULT NULL,`profile_pic_url` varchar(100) DEFAULT NULL,`privacy_level` tinyint(1) DEFAULT NULL,`receive_email` varchar(10) NOT NULL) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
    // $sql .= "ALTER TABLE `comments` ADD PRIMARY KEY (`comment_id`);";
    // $sql .= "ALTER TABLE `image` ADD PRIMARY KEY (`image_id`);";
    // $sql .= "ALTER TABLE `likes` ADD PRIMARY KEY (`image_id`);";
    // $sql .= "ALTER TABLE `users` ADD PRIMARY KEY (`user_id`,`username`), ADD UNIQUE KEY `email_add` (`email_address`);";
    $conn->exec($sql);
    }
catch(PDOException $e)
    {
        echo "Connection failed: " . $e->getMessage();
    }

    try {
        $conn = new PDO($DB_DNS, $DB_USER, $DB_PASSWORD);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "CREATE TABLE IF NOT EXISTS `comments` (`comment_id` int(11) NOT NULL,`image_id` int(11) NOT NULL,`user_id` int(11) NOT NULL,`comment` varchar(300) NOT NULL,`comment_date` datetime NOT NULL DEFAULT current_timestamp()) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";
        $sql .= "CREATE TABLE IF NOT EXISTS `image` (`image_id` int(11) NOT NULL,`user_id` int(11) NOT NULL,`image_caption` varchar(300) DEFAULT NULL,`image_name` varchar(200) NOT NULL,`image_path` varchar(300) NOT NULL,`image_time` datetime NOT NULL DEFAULT current_timestamp()) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";
        $sql .= "CREATE TABLE IF NOT EXISTS `likes` (`image_id` int(11) NOT NULL,`liker_id` int(11) NOT NULL,`date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";
        $sql .= "CREATE TABLE IF NOT EXISTS `users` ( `user_id` int(11) NOT NULL,`username` varchar(30) NOT NULL,`password` varchar(100) NOT NULL,`email_address` varchar(40) NOT NULL,`fullname` varchar(30) NOT NULL,`active` int(10) NOT NULL,`token` varchar(255) DEFAULT NULL,`profile_pic_url` varchar(100) DEFAULT NULL,`privacy_level` tinyint(1) DEFAULT NULL,`receive_email` varchar(10) NOT NULL) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";
        $sql .= "ALTER TABLE `comments` ADD PRIMARY KEY (`comment_id`);";
        $sql .= "ALTER TABLE `image` ADD PRIMARY KEY (`image_id`);";
        $sql .= "ALTER TABLE `likes` ADD PRIMARY KEY (`image_id`);";
        $sql .= "ALTER TABLE `users` ADD PRIMARY KEY (`user_id`,`username`), ADD UNIQUE KEY `email_add` (`email_address`);";
        $sql .= "ALTER TABLE `users` ADD UNIQUE(`username`);";
        $sql .= "ALTER TABLE `users` CHANGE `user_id` `user_id` INT(11) NOT NULL AUTO_INCREMENT;";
        $sql .= "ALTER TABLE `image` CHANGE `image_id` `image_id` INT(11) NOT NULL AUTO_INCREMENT;";
        $sql .= "ALTER TABLE `comments` CHANGE `comment_id` `comment_id` INT(11) NOT NULL AUTO_INCREMENT;";
        $sql .= "ALTER TABLE `likes` CHANGE `image_id` `image_id` INT(11) NOT NULL AUTO_INCREMENT;";
        $conn->exec($sql);
        header("Location: ../signin.php");
    }
    catch(PDOException $e)
    {
        echo "Connection failed: " . $e->getMessage();
    }
    
    
?>

