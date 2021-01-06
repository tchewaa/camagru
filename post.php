
<?php

    
    require("includes/header.php");
    if(isset($_POST['addComment']))
    {
        $image_id = $_SESSION["temp_post_id"];
        $comment = htmlentities($_POST['comment'],ENT_QUOTES, 'UTF-8');
        $user_id = $_SESSION['user_id'];
        
        if (empty($comment))
        {
            echo "<script language='javascript'>alert('Comment field cannot be empty');</script>"; 
        }
        else{
            try{
                $sql = "INSERT INTO `comments` (`comment_id`, `image_id`, `user_id`, `comment`) 
                VALUES (NULL,'".$image_id."','".$_SESSION['user_id']."', '".$comment."')";
                if($conn->exec($sql))
                { 
                    //sql statement for the getting the username of the person commenting on the post
                    $stmt = $conn->prepare("select c.user_id, u.user_id, u.username from comments c, users u where u.user_id = '".$_SESSION['user_id']."' and c.user_id = '".$_SESSION['user_id']."' LIMIT 1");
                    $stmt->execute();
                    $user = $stmt->fetch(PDO::FETCH_ASSOC);

                    //sql statement for the username receiving the email
                    $stmt2 = $conn->prepare("select i.user_id, u.user_id, u.username, u.email_address, u.receive_email from images i, users u where u.user_id = i.user_id  LIMIT 1");
                    $stmt2->execute();
                    $receiver = $stmt2->fetch(PDO::FETCH_ASSOC);

                    if($receiver['receive_email'] === "Yes")
                    {
                        $message = '
                        <html>
                        <head>
                        <title>Notification</title>
                        </head>
                        <body>
                        <p>Hi '. $receiver['username'].',</p>
                        <p><strong>'.$user['username'].'</strong> has commented on your post.</p>
                        <p>Kind Regards<br/><br/><br/>
                           Camagru Team!<br/></p>
                        </body>
                        </html>
                        ';
                        $from = "Camagru";
                        $headers[] = 'MIME-Version: 1.0';
                        $headers[] = 'Content-type: text/html; charset=iso-8859-1';
                        $headers[] = "From:" . htmlentities(strip_tags($from)); 
                        $headers[] = "Content-type: text/html; charset=iso-8859-1\r\n";
                        if(!mail($receiver['email_address'],"Notification", $message,implode("\r\n", $headers)))
                        {
                            $error = "Error: Could not a notification message";
                        } else{
                           header("refresh:0.1; url=post.php?action=post&id=$image_id");
                       }

                    }else{
                         header("refresh:0.1; url=post.php?action=post&id=$image_id");
                    }
                    
                }else{
                    echo "<script language='javascript'>alert('Could not add a comment');</script>"; 
                }
            }catch(PDOException $e){
                $error = "Error ".$e->getMessage();
            }
        }
    }
 
?>
<main>
        <section class="timeline_section">
            <div class="container">
                <div class="row">
                    <div class="timeline_feeds" style="width:100% !important; text-align:center">
                    <h4 class="right">Post</h4>

<?php
                    if (isset($_GET["action"]) && $_GET["action"] == "post"){
                        if (isset($_GET['id']))
                        {

                            $image_id = $_GET['id'];
                            try{
                                $like = $conn->prepare("SELECT * FROM `likes` WHERE image_id = '".$image_id."'AND like_status = 1");
                                $like->execute();
                                $count = $like->rowCount();
                                

                                $stmt = $conn->prepare("SELECT * FROM `images` WHERE image_id = '".$image_id."'"); 
                                $stmt->execute();
                                if ($stmt === false){                                            
                                    $error = "Error: Could not fetch data from the database.";
                                }else{ 
                                    foreach ($stmt as $row) {
                                        echo "<div class='post-container'>";
                                        echo    "<p><img src='".$row['image_name']."' alt='Posts' class='post-image'></p>";
                                        echo    "<div class='post-tools'>";
                                        if(!isset($_SESSION['user_id']) && !isset($_SESSION['username']) && !isset($_SESSION['password']) && !isset($_SESSION['fullname']) && !isset($_SESSION['profile_pic'])  && !isset($_SESSION['email_address']) && !isset($_SESSION['receive_email']))
                                        {
                                            echo    "<p></p>";
                                        }else{
                                        $user_id = $_SESSION['user_id'];
                                        echo    "<a style='text-decoration:none' class = 'btn primary-button' href='like.php?action=like&userid=$user_id&postid=$image_id'>$count  Like</a> <br/><br/>";
                                        }
                                        echo    "<p></p>";
                                        echo     "<p style='font-size:18px; font-weight:bold'>".$row['image_caption'].".</p>";
                                        echo     "</div>";
                                        echo "</div>";
                                    }
                                }
                             $_SESSION["temp_post_id"] = $_GET['id'];
                            }catch(PDOException $e){
                                    $error = "Error: ".$e->getMessage();
                            }
                        }
                    }  
    ?> 
                        <?php 
                        if(!isset($_SESSION['user_id']) && !isset($_SESSION['username']) && !isset($_SESSION['password']) && !isset($_SESSION['fullname']) && !isset($_SESSION['profile_pic'])  && !isset($_SESSION['email_address']) && !isset($_SESSION['receive_email']))
                        { 
                            header("Location: signin.php");
                            //echo '<p class="error" style="font-weight:bold;padding:16px"> You have to be logged in to comment.</p>';
                        }
                        else{
                                  
                           $image_id = $_SESSION["temp_post_id"];
                           $stmt = $conn->prepare("select u.user_id, u.username, i.image_id, c.image_id, c.user_id, c.comment, c.comment_date from comments c, images i, users u where u.user_id = c.user_id AND i.image_id = '".$image_id."' AND c.image_id = '".$image_id."' ORDER by comment_date DESC");
                            $stmt->execute();
                            if ($stmt === false){                                            
                                $error = "Error: Could not fetch data from the database.";
                            }else{ 
                                foreach ($stmt as $row) {
                                    $time = strtotime(str_replace('/','-',$row["comment_date"]));
                                    $myFormatForView = date("m/d/Y g:i (A)", $time);
                                    echo "<div class='comments-container'>";
                                    echo     "<p title='$myFormatForView'><strong>".$row['username']."</strong>"." ".$row['comment']."</p>";
                                    echo "</div>";
                                }
                            }
                          echo  "<div class='post-comment'>
                                <form method='POST' action='post.php?action=post&id='<?php echo $image_id;?>
                                    <input class='form-input' type='text' style='width:80%; height:200px' name='comment' placeholder='Add Comment' /><br/><br/>
                                    <button style='width: 10%;' class ='btn primary-button' type='submit' name='addComment'>Comment</button>
                                </form>
                            </div>"; 
                        }
                        ?>

                        
                    </div>
                </div>
            </div>
        </section>
</main>
<?php
    require("includes/footer.php");
?>
</body>

</html>
