<?php
require("includes/header.php");

if (isset($_POST['signup']))
{
    $fullname = $_POST['fullname'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $email_address = $_POST['email_address'];
    $uppercase = preg_match('@[A-Z]@', $password);
    $lowercase = preg_match('@[a-z]@', $password);
    $number    = preg_match('@[0-9]@', $password);
    $specialChars = preg_match('@[^\w]@', $password);
    $error = "";
    $success = "";
    $token = "1234567890aqswedxzcfvbgrtyhnjuikmlopPLOKIMJUYHNBTFVRDEXCSWAQZ";
    $token = str_shuffle($token);
    $token = substr($token, 0, 30);

    if (empty($fullname) || empty($username) || empty($password) || empty($email_address)){
        $error = "Fill all the fields.";
    }
    else if (!filter_var($email_address, FILTER_VALIDATE_EMAIL)){
        $error = "Invalid email address.";
    } 
    else if ($password !== $confirm_password){
        $error = "Password is not the same.";
    } 
    else if(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password) < 8)
    {
        $error = "Password should be at least 8 characters in length <br/> and should include at least one upper case letter, <br/> one number, and one special character.";
    }
    else{
            $hashing = password_hash($password,PASSWORD_DEFAULT);
            $profile_pic_url = NULL;
            $privacy_level = 0;
            $active = 0;
            $receive_email = "Yes";
            try{
                $sql = "INSERT INTO `users` (`user_id`, `username`, `password`, `email_address`, `fullname`,`active`,`token`,`profile_pic_url`, `privacy_level`, `receive_email`) 
                VALUES (NULL, '".$username."', '".$hashing."', '".$email_address."', '".$fullname."', '".$active."','".$token."','".$profile_pic_url."', '".$privacy_level."','".$receive_email."')";
                $conn->exec($sql);
                $message = "
                        Hi $username, <br/><br/>
                        Thank you for registering on Camagru, to access Camagru, please click on the link below and verify your email address.<br/><br/>
                        <a href='http://127.0.0.1:8080/camagru/verify.php?action=verify&email_address=$email_address&token=$token'>
                        http://127.0.0.1:8080/camagru/verify.php?action=verify&email_address=$email_address&token=$token</a><br/><br/>
                        Kind Regards<br/><br/><br/>
                        Camagru Team!<br/>
                        ";
                $from = "Camagru";
                $headers = "From:" . $from; 
                if(!mail($email_address,"Camagru Email Verification", $message,$headers))
                {
                    $error = "Error: Could not send an email address";
                } else{
                    echo "<script language='javascript'>alert('Your account has been registered successfully');</script>"; 
                    header("refresh:0.5; url=signin.php");
                }
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
                                <input type="text" value = "<?php if(isset($_POST['email_address'])){echo $_POST['email_address'];}?>" name="email_address" placeholder="Email Address"><br/><br/>
                                <input type="password" name="password" placeholder="Password"><br/><br/>
                                <input type="password" name="confirm_password" placeholder="Confirm Password"><br/><br/>
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