<?php
require("database.php");
try {
    $conn = new PDO($DB_D, $DB_USER, $DB_PASSWORD);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql =  "CREATE DATABASE IF NOT EXISTS camagru_db;";
       $conn->exec($sql);
    }
catch(PDOException $e)
    {
        echo "Connection failed: " . $e->getMessage();
    }

    try {
        $conn = new PDO($DB_DNS, $DB_USER, $DB_PASSWORD);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "CREATE TABLE IF NOT EXISTS `comments` (`comment_id` int(11) AUTO_INCREMENT NOT NULL,`image_id` int(11) NOT NULL,`user_id` int(11) NOT NULL,`comment` varchar(300) NOT NULL,`comment_date` datetime NOT NULL DEFAULT current_timestamp(),PRIMARY KEY (`comment_id`)) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";
        $sql .= "CREATE TABLE IF NOT EXISTS `images` (`image_id` int(11) AUTO_INCREMENT NOT NULL,`user_id` int(11) NOT NULL,`image_caption` varchar(300) DEFAULT NULL,`image_name` varchar(200) NOT NULL,`image_path` varchar(300) NOT NULL,`image_time` datetime NOT NULL DEFAULT current_timestamp(), PRIMARY KEY (`image_id`)) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";
        $sql .= "CREATE TABLE IF NOT EXISTS `likes` (`id` int(11) AUTO_INCREMENT NOT NULL,`image_id` int(11) NOT NULL,`liker_id` int(11) NOT NULL,`date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP, `like_status` int(11) NOT NULL, PRIMARY KEY (`id`) ) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
        $sql .= "CREATE TABLE IF NOT EXISTS `users` ( `user_id` int(11) AUTO_INCREMENT NOT NULL,`username` varchar(30) NOT NULL,`password` varchar(100) NOT NULL,`email_address` varchar(40) NOT NULL,`fullname` varchar(30) NOT NULL,`active` int(10) NOT NULL,`token` varchar(255) DEFAULT NULL,`profile_pic_url` varchar(100) DEFAULT NULL,`privacy_level` tinyint(1) DEFAULT NULL,`receive_email` varchar(10) NOT NULL, PRIMARY KEY (`user_id`)) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";
        $sql .= "ALTER TABLE `users` ADD UNIQUE(`username`);";
        $sql .= "ALTER TABLE `users` ADD UNIQUE(`email_address`);";
        $sql .= "ALTER TABLE `images` ADD CONSTRAINT fk_images_users FOREIGN KEY (`user_id`) REFERENCES `users`(`user_id`) ON DELETE CASCADE;";
        $sql .= "ALTER TABLE `likes` ADD CONSTRAINT fk_likes_images FOREIGN KEY (`image_id`) REFERENCES `images`(`image_id`) ON DELETE CASCADE;";
        $sql .= "ALTER TABLE `likes` ADD CONSTRAINT fk_likes_users FOREIGN KEY (`liker_id`) REFERENCES `users`(`user_id`) ON DELETE CASCADE;";
        $sql .= "ALTER TABLE `comments` ADD CONSTRAINT fk_comments_images FOREIGN KEY (`image_id`) REFERENCES `images`(`image_id`) ON DELETE CASCADE;";
        $sql .= "ALTER TABLE `comments` ADD CONSTRAINT fk_comments_users FOREIGN KEY (`user_id`) REFERENCES `users`(`user_id`) ON DELETE CASCADE;";        
        
        $conn->exec($sql);
        header("Location: ../signin.php");
    }
    catch(PDOException $e)
    {
        echo "Connection failed: " . $e->getMessage();
    }
    
    
?>

