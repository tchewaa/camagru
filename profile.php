
<?php
    require "includes/header.php";
    if (isset($_POST['post']))
    {
        $filename = $_FILES['file']['name'];
        $target_dir = "upload/";
        $target_file = $target_dir . basename($_FILES["file"]["name"]);
        // Select file type
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        // Valid file extensions
        $extensions_arr = array("jpg","jpeg","png","gif");
        if(empty($filename)){
            echo '<p class="error">Please attach an image to your post.</p>';
        }
    }
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
                    <div class="timeline_feeds" style="width:100% !important">
                       The Feeds

                            
                       

                        



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