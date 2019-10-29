
<?php
    require "includes/header.php";
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
                            <h3><?php if (isset($_SESSION['username'])) echo $_SESSION['username'];?></h3>
                        </div>
                        <div class="profile_edit_button">
                            <a class="btn profile_buttons outline" type="button" href="#"><i class="fa fa-pencil" aria-hidden="true"></i> Edit Profile</a>
                        </div>
                        <div class="settings_icon">
                            <a class="btn profile_buttons blue" type="button" href="#"><i class="fa fa-wrench fa-2" aria-hidden="true"></i> Settings</a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="posts_followers_following">
                            <p>244 Posts</p>
                        </div>
                        <div class="posts_followers_following">
                            <p>1052 Followers</p>
                        </div>
                        <div class="posts_followers_following">
                            <p>2 Following</p>
                        </div>
                    </div>
                 </div>
                 <div class="row">
                        <div class="profile_bio">
                            <h4><?php if (isset($_SESSION['fullname'])) echo $_SESSION['fullname'];?> </h4>
                        </div>
                    </div>
                 </div>
            </div>


                <div class="row">
                    <div class="timeline_feeds">
                       The Feeds

                            
                        
                    </div>
                    <div class="sidebar_feeds">
                       Side Feeds

                            
                        
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