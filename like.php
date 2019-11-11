<?php
    require("includes/header.php");
    if (isset($_GET["action"]) && $_GET["action"] == "like"){
        if (isset($_GET['userid']) && isset($_GET['postid']))
        {
            $user_id = $_GET['userid'];
            $postid = $_GET['postid'];
            try{

                $stmt = $conn->prepare("SELECT `image_id`,`liker_id`,`date` FROM `likes` WHERE `image_id` = :image_id AND `liker_id` = :like_id;"); 
                $stmt->bindValue(':image_id', $postid);
                $stmt->bindValue(':like_id', $user_id);
                $stmt->execute();
                $user = $stmt->fetch(PDO::FETCH_ASSOC);
                if ($user === false)
                {
                    $timestamp = date("Y-m-d H:i:s");
                    $sql = "INSERT INTO `likes` (`image_id`, `liker_id`, `date`)VALUES ('".$postid."', '".$user_id."', '".$timestamp."')";
                    $conn->exec($sql);
                    echo "<script language='javascript'>alert(YOU...LIKED);</script>"; 
                    header("refresh:0.1; url=post.php?action=post&id=$postid");
                }
                else{
                    echo "<script language='javascript'>alert('You cannot like twice');</script>"; 
                    header("refresh:0.1; url=post.php?action=post&id=$postid");               
                }
            }
            catch(PDOException $e){
                echo  $e->getMessage();
            }
        }
    }
?>