
<?php
    require("includes/header.php"); 
?>
<main>
        <section class="timeline_section">
            <div class="container">

            <div class="row">
                 <div class="profile_pic">
                    <img src="upload/no-profile-pic-icon-5.jpg">
                 </div>

                 <div class="profile_info">
                    <div class="row">
                        <div class="display_username">
                            
                        </div>
                    </div>
                    <div class="row">
                        <h2 class="display_username"><?php if (isset($_SESSION['username'])) echo $_SESSION['username'];?></h2>
                        <div class="profile_edit_button">
                            <a class="btn profile_buttons outline" type="button" href='add_post.php'><i class="fa fa-plus" aria-hidden="true"></i> Add Post</a>
                            <a class="btn profile_buttons outline" type="button" href='edit_profile.php'><i class="fa fa-pencil" aria-hidden="true"></i> Edit Profile</a>
                            <a class="btn profile_buttons blue" type="button" href="settings.php"><i class="fa fa-wrench fa-2" aria-hidden="true"></i> Settings</a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="posts_followers_following">
                            <p>-<br/> Posts</p>
                        </div>
                        <div class="posts_followers_following">
                            <p>-<br/> Followers</p>
                        </div>
                        <div class="posts_followers_following">
                            <p>-<br/> Following</p>
                        </div>
                        <div class="profile_bio">
                            <h4><?php if (isset($_SESSION['fullname'])) echo $_SESSION['fullname'];?> </h4><br/>
                            <p><?php if (isset($_SESSION['bio'])) echo " - ".$_SESSION['bio'];?> </p>
                        </div>
                    </div>
                 </div>
                 
                 </div>
            </div>

                <div class="row">
                    <div class="timeline_feeds" style="width:100% !important; text-align:left">
                       <?php
                            try{
                                $user_id = $_SESSION['user_id'];
                                //$stmt = $conn->prepare("SELECT  *  FROM `image` WHERE `user_id` = 45");
                                $stmt = $conn->prepare("SELECT u.user_id,  i.image_id, i.user_id, i.image_caption, i.image_name, i.image_time
FROM users u, `image` i WHERE u.user_id = i.user_id AND u.user_id = $user_id AND i.user_id = $user_id ORDER BY i.image_time DESC"); 
                                $stmt->execute();
                                //$data = $stmt->fetch(PDO::FETCH_ASSOC);
                                if ($stmt === false){                                            
                                    $error = "NO POSTS YET...ADD SOMETHING.";
                                }else{ 
                                    foreach ($stmt as $row) {
                                        echo "<div class='image-container'>";
                                        echo "<img src='".$row['image_name']."' width='250px' height='250px' alt='Posts' class='image'>";
                                        //echo    <img src="img_avatar.png" alt="Avatar" class="image">;
                                        echo    "<div class='overlay'>";
                                        echo        "<div class='text'>'".$row['image_caption']."'</div>";
                                        echo    "</div>";
                                        echo "</div>";
                                        
                                    }
                                }
                                   
                            }catch(PDOException $e){
                                    $error = "Error: ".$e->getMessage();
                            }
                        
                       ?>
                       <?php if (isset($error)) echo $error ?>
                    </div>
                </div>
            </div>
        </section>
</main>
<?php
    require "includes/footer.php";
?>
</body>

</html>