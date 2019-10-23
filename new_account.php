<?php
require "includes/header_index.php";

if (isset($_POST['signup']))
{
    $fullname = $_POST['fullname'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email_address = $_POST['email_address'];
    $error = "";
    $success = "";

    if (empty($fullname) || empty($username) || empty($password) || empty($email_address)){
        $error = "Error: Fill all the fields.";
    }
    else if (!filter_var($email_address, FILTER_VALIDATE_EMAIL)){
        $error = "Error: Invalid email address.";
    } 
    else{
            $hashing = password_hash($password,PASSWORD_DEFAULT);
            $profile_pic_url = NULL;
            $privacy_level = 0;
            $active = 0;
            try{
                $sql = "INSERT INTO `users` (`user_id`, `username`, `password`, `email_address`, `fullname`,`active`,`profile_pic_url`, `privacy_level`) 
                VALUES (NULL, '".$username."', '".$hashing."', '".$email_address."', '".$fullname."', '".$active."','".$profile_pic_url."', '".$privacy_level."')";
                $conn->exec($sql);
                $success = "Registered Successfully!!!";
            }catch(PDOException $e)
            {
                $error = "Error: ".$e->getMessage();
            }
   }
}
?>
<main>
        <section class="register-class">
            <div class="container">
                <div class="row">
                    <div style="text-align:center" class="reg-form login-box">
                        <p><span style="border: 2px solid #000 !important" class="icon">C</span><br/><br/><a style="color:#000; font-size:30px" class="link" href="index.php">Camagru</a></p>
                        <br/>
                        <p><span class="error"><?php if (isset($error)) echo $error ?></span>
                        <span class="success"><?php if (isset($success)) echo $success ?></span></p><br/>
                        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                                <input type="text" value = "<?php if(isset($_POST['fullname'])){echo $_POST['fullname'];}?>" name="fullname" placeholder="Full Name"><br/><br/>
                                <input type="text" value = "<?php if(isset($_POST['username'])){echo $_POST['username'];}?>" name="username" placeholder="Username"><br/><br/>
                                <input type="password" value = "<?php if(isset($_POST['password'])){echo $_POST['password'];}?>" name="password" placeholder="Password"><br/><br/>
                                <input type="text" value = "<?php if(isset($_POST['email_address'])){echo $_POST['email_address'];}?>" name="email_address" placeholder="Email Address"><br/><br/>
                                <button class ="primary-button" type="submit" name="signup">Sign Up</button><br/><br/>
                                <a href="forgot_password.php">Forgot Password?</a>
                                <br/><br/>Have an account? <a href="index.php">Sign In</a>
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