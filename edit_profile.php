
<?php
    require "includes/header.php";
?>
<main>
        <section class="timeline_section">
            <div class="container">
                <div class="row">
                    <div class="profile_container">
                        <h4 class="right">Edit Profile</h4>
                       <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                                <?php
                                    if (isset($_SESSION['username']))
                                        echo $_SESSION['username'];
                                    else if(isset($_SESSION['profile_pic']))
                                            echo $_SESSION["profile_pic"];
                                    else
                                            echo '<img src="images/no-profile-pic-icon-5.jpg"/>';
                                ?>
                                 <p><span class="error"><?php if (isset($error)) echo $error ?></span>
                                <span class="success"><?php if (isset($success)) echo $success ?></span></p><br/>
                                Name<br/><input type="text" value = "<?php if(isset($_SESSION['fullname'])){echo $_SESSION['fullname'];}?>" name="fullname" placeholder="Full Name"><br/><br/>
                                Username<br/><input type="text" value = "<?php if(isset($_SESSION['username'])){echo $_SESSION['username'];}?>" name="username" placeholder="Username"><br/><br/>
                                Website<br/><input type="text" value = "<?php if(isset($_SESSION['website'])){echo $_SESSION['website'];}?>" name="website" placeholder="website"><br/><br/>
                                Bio<br/><textarea rows="6" placeholder="Bio"><?php if(isset($_SESSION['bio'])){echo $_SESSION['bio'];}?></textarea><br/><br/>
                                Email Address<br/><input type="text" value = "<?php if(isset($_SESSION['email_address'])){echo $_SESSION['email_address'];}?>" name="email_address" placeholder="Username"><br/><br/>
                                Phone Number<br/><input type="text" value = "<?php if(isset($_SESSION['phone'])){echo $_SESSION['phone'];}?>" name="phone" placeholder="Phone Number"><br/><br/>
                                Gender<br/><input type="text" value = "<?php if(isset($_SESSION['gender'])){echo $_SESSION['gender'];}?>" name="gender" placeholder="Gender"><br/><br/>
                                <button class ="primary-button" type="submit" name="save">Save</button><br/><br/>
                               
                            </form>
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