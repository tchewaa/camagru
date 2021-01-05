
<?php
    require("includes/header.php"); 
?>
<main>
        <section class="timeline_section">
            <div class="container">

            <div class="row">
                 <div class="profile_pic">
                    <img src="upload/no_profile.png">
                 </div>

                 <div class="profile_info">
                    <div class="row">
                        <div class="display_username">
                            
                        </div>
                    </div>
                    <div class="row">
                        <h2 class="display_username"><?php if (isset($_SESSION['username'])) echo $_SESSION['username'];?></h2>
                        <div class="profile_edit_button">
                            <a class="btn profile_buttons outline" type="button" href='camera.php'><i class="fa fa-plus" aria-hidden="true"></i> Camera Post</a>
                            <a class="btn profile_buttons outline" type="button" href='add_post.php'><i class="fa fa-plus" aria-hidden="true"></i> Image Post</a>
                            <a class="btn profile_buttons outline" type="button" href='edit_profile.php'><i class="fa fa-pencil" aria-hidden="true"></i> Edit Profile</a>
                            <a class="btn profile_buttons blue" type="button" href="settings.php"><i class="fa fa-wrench fa-2" aria-hidden="true"></i> Settings</a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="profile_bio">
                            <h4><?php if (isset($_SESSION['fullname'])) echo $_SESSION['fullname'];?> </h4><br/>
                            <p><?php if (isset($_SESSION['bio'])) echo " - ".$_SESSION['bio'];?> </p>
                        </div>
                    </div>
                 </div>
                 
                 </div>
            </div>

                <div class="row">
                    <div class="timeline_feeds" style="width:100% !important; text-align:center">
                       <?php
                       if(!isset($_SESSION['user_id']) && !isset($_SESSION['username']) && !isset($_SESSION['password']) && !isset($_SESSION['fullname']) && !isset($_SESSION['profile_pic'])  && !isset($_SESSION['email_address']) && !isset($_SESSION['receive_email']))
                       {
                           header("Location: signin.php");
                       }else{
                            try{
                                $user_id = $_SESSION['user_id'];

                                $limit = 6;
                                $sql = "SELECT u.user_id,  i.image_id, i.user_id, i.image_caption, i.image_name, i.image_time
                                FROM users u, `images` i WHERE u.user_id = i.user_id AND u.user_id = $user_id AND i.user_id = $user_id ORDER BY i.image_time DESC";
                                $s = $conn->prepare($sql);
                                $s->execute();
                                $total_results = $s->rowCount();
                                $total_pages = ceil($total_results/$limit);

                                if (!isset($_GET['page'])) {
                                    $page = 1;
                                } else{
                                    $page = $_GET['page'];
                                }

                                $starting_limit = ($page-1)*$limit;


                                //$stmt = $conn->prepare("SELECT  *  FROM `image` WHERE `user_id` = 45");
                                $stmt = $conn->prepare("SELECT u.user_id,  i.image_id, i.user_id, i.image_caption, i.image_name, i.image_time
FROM users u, `images` i WHERE u.user_id = i.user_id AND u.user_id = $user_id AND i.user_id = $user_id ORDER BY i.image_time DESC LIMIT $starting_limit, $limit"); 
                                $stmt->execute();
                                //$data = $stmt->fetch(PDO::FETCH_ASSOC);
                                if ($stmt === false){                                            
                                    $error = "NO POSTS YET...ADD SOMETHING.";
                                }else{ 
                                    foreach ($stmt as $row) {
                                        echo "<a class='link' href='post.php?action=post&id=$row[image_id]'><div class='image-container'>";
                                        echo "<img src='".$row['image_name']."' width='250px' height='250px' alt='Posts' class='image'>";
                                        echo    "<div class='overlay'>";
                                        echo        "<div class='text'>".$row['image_caption']."</div>";
                                        echo        "<a class='btn profile_buttons blue' style='width: 100%' href='delete.php?action=delete&id=$row[image_id]'>Delete</a>";
                                        echo    "</div>";
                                        echo "</div></a>";
                                        
                                    }
                                }
                                   
                            }catch(PDOException $e){
                                    $error = "Error: ".$e->getMessage();
                            }
                       }
                       ?>
                       <?php if (isset($error)) echo $error ?>
                       <?php
                       echo '<br/><br/><br/>';
                        for ($page=1; $page <= $total_pages ; $page++):?>
                            <ul class="pagination">
                                 <li><a href='<?php echo "?page=$page"; ?>' class="links"><?php  echo $page; ?> </a></li>
                            </ul>
                        <?php endfor; echo '<br/><br/><br/>';?>
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