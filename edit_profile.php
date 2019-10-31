
<?php
    require "includes/header.php";
?>
<main>
        <section class="timeline_section">
            <div class="container">
                <div class="row">
                    <div class="timeline_feeds">
                       The Feeds
                            
                       <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                                <input type="text" value = "<?php if(isset($_SESSION['fullname'])){echo $_SESSION['fullname'];}?>" name="fullname" placeholder="Full Name"><br/><br/>
                                <input type="text" value = "<?php if(isset($_SESSION['username'])){echo $_SESSION['username'];}?>" name="username" placeholder="Username"><br/><br/>
                                <input type="text" value = "<?php if(isset($_SESSION['email_address'])){echo $_SESSION['email_address'];}?>" name="email_address" placeholder="Email Address"><br/><br/>
                                <input type="password" name="password" placeholder="Password"><br/><br/>
                                <input type="password" name="confirm_password" placeholder="Confirm Password"><br/><br/>
                                 <button class ="primary-button" type="submit" name="signup">Save</button><br/><br/>
                               
                            </form>
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