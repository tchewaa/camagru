<?php
    require("includes/header.php");
    if (isset($_GET["action"]) && $_GET["action"] === "like"){
        if (isset($_GET['userid']) && isset($_GET['postid'])){
            $userid = $_GET['userid'];
            $postid = $_GET['postid'];
            try{
                
                $sql = "INSERT INTO `likes` (`image_id`, `liker_id`, `like_status`) VALUES ('".$postid."', '".$userid."', 1) ON DUPLICATE KEY UPDATE like_status=IF(like_status=1, 0, 1)";
                $conn->exec($sql);

                // $stmt = $conn->prepare("SELECT `image_id`,`liker_id`,`date` FROM `likes` WHERE `image_id`=:image_id AND `liker_id`=:like_id;"); 
                // $stmt->bindValue(':image_id', $postid);
                // $stmt->bindValue(':like_id', $userid);
                // $stmt->execute();
                // $user = $stmt->fetch(PDO::FETCH_ASSOC);
                // if ($user === false)
                // {
                
                

                header("refresh:0.1; url=post.php?action=post&id=$postid");
                // }
                // else{
                //     echo "<script language='javascript'>alert('You cannot like twice');</script>"; 
                //     header("refresh:0.1; url=post.php?action=post&id=$postid");               
                // }
            }


            catch(PDOException $e){
                echo  $e->getMessage();
            }
        }
    }
?>