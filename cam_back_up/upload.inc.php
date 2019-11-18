<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require("includes/header.php");
session_start();


if (isset($_POST['img']))
{
    
    $userid = $_SESSION['userId'];
    echo $userid;

    
    if (isset($_POST['img'])) {
        // echo $_POST['img'];
        
        $img = $_POST['img']; 
        $img = str_replace('data:image/png;base64,', '', $img);
        $img = str_replace(' ', '+', $img);
        $data = base64_decode($img);
        $data1 = uniqid('', true).".png";
        //rename($data, $data1);
        $dest = "../temp/".$data1;
        
        file_put_contents($dest, $data);
        //rename($data1, $dest);
        $likes = 1;
        
        
        
        $stmt = $conn->prepare("INSERT INTO `camagru`.`images` (userid, `image`)
                VALUES (:user, :jpg)");
                $stmt->bindParam(':user', $userid);
                $stmt->bindParam(':jpg', $dest);
                $stmt->execute();
                
                echo "success";
        header("Location: ../upload.php?uploadsuccess");

    
    }
}
else { 
    echo "failed";
    header("Location: ../upload.php?clickupload");
}