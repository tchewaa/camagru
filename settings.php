
<?php
    require "includes/header.php";
?>
<main>
        <section class="timeline_section">
            <div class="container">
                <div class="row">
                    <div class="profile_container">
                        <h4 class="right">Settings</h4>
                        <h3>Change Password</h3>
                            <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                                <br/>
                                 <p><span class="error"><?php if (isset($error)) echo $error ?></span>
                                <span class="success"><?php if (isset($success)) echo $success ?></span></p><br/>
                                Old Password<br/><input type="text" name="oldPassword" placeholder="Old Password"><br/><br/>
                                New Password<br/><input type="text" name="newPassword" placeholder="New Password"><br/><br/>
                                Confirm Password<br/><input type="text" name="confirmPassword" placeholder="Confirm Password"><br/><br/>
                                <button class ="primary-button" type="submit" name="changePassword">Change Password</button><br/><br/>
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