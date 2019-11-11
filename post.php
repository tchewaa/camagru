
<?php

    
    require("includes/header.php");
    if(isset($_POST['addComment']))
    {
        $image_id = $_SESSION["temp_post_id"];
        $comment = $_POST['comment'];
        $timestamp = date("Y-m-d H:i:s");
        $user_id = $_SESSION['user_id'];
        
        if (empty($comment))
        {
            echo "<script language='javascript'>alert('Comment field cannot be empty');</script>"; 
        }
        else{
            try{
                $sql = "INSERT INTO `comments` (`comment_id`, `image_id`, `user_id`, `comment`, `comment_date`) 
                VALUES (NULL,'".$image_id."','".$user_id."', '".$comment."','".$timestamp."')";
                if($conn->exec($sql))
                { 
                    header("refresh:0.1; url=post.php?action=post&id=$image_id");
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
                            $user_id = $_SESSION['user_id'];
                            try{
                                $stmt = $conn->prepare("SELECT * FROM `image` WHERE image_id = '".$image_id."'"); 
                                $stmt->execute();
                                if ($stmt === false){                                            
                                    $error = "Error: Could not fetch data from the database.";
                                }else{ 
                                    foreach ($stmt as $row) {
                                        echo "<div class='post-container'>";
                                        echo    "<img src='".$row['image_name']."' alt='Posts' class='image'>";
                                        echo    "<div class='post-tools'>";
                                        if(!isset($_SESSION['user_id']) && !isset($_SESSION['username']) && !isset($_SESSION['password']) && !isset($_SESSION['fullname']) && !isset($_SESSION['profile_pic'])  && !isset($_SESSION['email_address']) && !isset($_SESSION['receive_email']))
                                        { 
                                            echo '<p></p>';
                                        }else{
                                            
                                            echo        "<div class=''><a href='like.php?action=like&userid=$user_id&postid=$image_id'>Likes</a> | Comments<br/><br/></div>";  
                                        }
                                        echo    "<p style='font-size:18px; font-weight:bold'>".$row['image_caption'].".</p>";
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
                            echo '<p class="error" style="font-weight:bold;padding:16px"> You have to be logged in to comment.</p>';
                        }
                        else{
                                  
                           $image_id = $_SESSION["temp_post_id"];
                           $user_id = $_SESSION['user_id'];
                           $stmt = $conn->prepare("select u.user_id, u.username, i.image_id, c.image_id, c.user_id, c.comment, c.comment_date from comments c, image i, users u where u.user_id = '".$user_id."' AND c.user_id = '".$user_id."' AND i.image_id = '".$image_id."' AND c.image_id = '".$image_id."' ORDER by comment_date DESC");
                            $stmt->execute();
                            if ($stmt === false){                                            
                                $error = "Error: Could not fetch data from the database.";
                            }else{ 
                                foreach ($stmt as $row) {
                                    $time = strtotime(str_replace('/','-',$row["comment_date"]));
                                    $myFormatForView = date("m/d/Y g:i (A)", $time);
                                    echo "<div class='comments-container'>";
                                    echo     "<p>".$row['username']."</p>";
                                    echo    "<div class='post-tools'>";
                                    echo        "<div class=''>";
                                    echo                $row['comment']."<br/><p class='right'>".$myFormatForView.'</p>';
                                    echo            "</div>";            
                                    echo     "</div>";
                                    echo "</div>";
                                }
                            }
                          echo  "<div class='post-comment'>
                                <form method='POST' action='post.php?action=post&id='<?php echo $image_id;?>
                                    <input type='text' style='width:80%; height:200px' name='comment' placeholder='Add Comment' /><br/><br/>
                                    <button style='width: 10%;' class ='primary-button' type='submit' name='addComment'>Comment</button>
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