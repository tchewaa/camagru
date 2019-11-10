<?php

require("includes/header.php");
if(!isset($_SESSION['user_id']) && !isset($_SESSION['username']) && !isset($_SESSION['password']) && !isset($_SESSION['fullname']) && !isset($_SESSION['profile_pic'])  && !isset($_SESSION['email_address']) && !isset($_SESSION['receive_email']))
{
    header("Location: index.php");
}else{

    $timestamp = date("Y-m-d H:i:s");
    $timestamp_caption = date("Y-m-d H:i:s");

    $user_id = $_SESSION['user_id'];
    $caption = "Selfie Time ".$timestamp_caption;
    $upload_dir = "upload/";
    $img = $_POST['hidden_data'];
    $img = str_replace('data:image/png;base64,', '', $img);
    $img = str_replace(' ', '+', $img);
    $data = base64_decode($img);
    $file = $upload_dir . mktime() . ".png";
    if($success = file_put_contents($file, $data)){
        $sql = "INSERT INTO `image` (`image_id`, `user_id`, `image_caption`, `image_name`, `image_path`,`image_time`) 
        VALUES (NULL, '".$user_id."', '".$caption."', '".$file."', '".$upload_dir."', '".$timestamp."')";
        $res = $conn->exec($sql);
        if($res)
            echo "Post added successful";
        else
            echo "Failed to add a post";
    }
    
}





//print $success ? $file : 'Unable to save the file.';
?>