function myFunction() {
    var x = document.getElementById("myDIVPost");
    if (x.style.display === "none") {
        x.style.display = "block";
    } else {
        x.style.display = "none";
    }
}

function mySecurity() {
    var x = document.getElementById("myDIVSecurity");
    if (x.style.display === "none") {
        x.style.display = "block";
    } else {
        x.style.display = "none";
    }
}


function myNotification() {
    var x = document.getElementById("myDIVNotify");
    if (x.style.display === "none") {
        x.style.display = "block";
    } else {
        x.style.display = "none";
    }
}

/*function getTotalLike($postid,$user_id)
                            {
                                $sql = "SELECT count(*) FROM `likes` WHERE `image_id` = :image_id AND `liker_id` = :like_id;"; 
                                $stmt->bindValue(':image_id', $postid);
                                $stmt->bindValue(':like_id', $user_id);
                                $stmt->execute();
                                $no_of_likes = $stmt->fetchColumn();
                                if($no_of_likes > 0)
                                {
                                    echo $no_of_likes;
                                } 
                            }*/



                            echo "<div class='post-container'>";
