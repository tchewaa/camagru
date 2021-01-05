
<?php
   require("includes/header.php");
    if(isset($_POST['reset-submit']))
    {
        $username_email = htmlentities(strtolower($_POST['user_email']), ENT_QUOTES, 'UTF-8');
        $token = "1234567890aqswedxzcfvbgrtyhnjuikmlopPLOKIMJUYHNBTFVRDEXCSWAQZ";
        $token = str_shuffle($token);
        $token = substr($token, 0, 30);

        if (empty($username_email))
        {
            $error = "Field must not be empty";
        }
        else if (!filter_var($username_email, FILTER_VALIDATE_EMAIL)){
            $error = "Invalid email address.";
        }else{
            
            try
            {
                $stmt = $conn->prepare("UPDATE `users` SET `token` = '".$token."' WHERE `email_address` = :email_address;");
                $stmt->bindValue(':email_address', $username_email);
                if($stmt->execute() && $stmt->rowCount() == 1)
                {
                    $message = '
                            <html>
                            <head>
                            <title>Camagru Email Verification</title>
                            </head>
                            <body>
                            <p>Hello User!!!,</p>
                            <p>Thank you for queries on Camagru, to reset your password, please click on the link below.<br/> 
                            <a href=http://localhost/camagru/reset_password.php?action=exists&email_address='.$username_email.'&token='.$token.'>Click Here</a> to verify your email address.</p>
                            <p>Kind Regards<br/><br/><br/>
                               Camagru Team!<br/></p>
                            </body>
                            </html>
                            ';
                    $from = "Camagru";
                    $headers[] = 'MIME-Version: 1.0';
                    $headers[] = 'Content-type: text/html; charset=iso-8859-1';
                    $headers[] = "From:" . htmlentities(strip_tags($from)); 
                    $headers[] = "Content-type: text/html; charset=iso-8859-1\r\n";       

                    if (!mail($username_email,"Reset Password", $message,implode("\r\n", $headers)))
                    {
                        $error = "Error: Could not send an email address";
                    } else
                    {
                        echo "<script language='javascript'>alert('Check your email to reset your password');</script>"; 
                        header("refresh:0.5; url=signin.php");
                    }
                }else{
                    $error = "Error: The account with ".$username_email." does not exist.<br/> Create an account";
                }
            }catch(PDOException $e){
                echo $e->getMessage();
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
                        <p>Enter your email address and we'll send you a link to get back into your account.</p>
                        <p><span class="error"><?php if (isset($error)) echo $error ?></span>
                        <span class="success"><?php if (isset($success)) echo $success ?></span></p><br/>
                        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                            <input type="text" class= "form-input" name="user_email" placeholder="Email Address"><br><br/>
                            <button class ="btn primary-button" type="submit" name="reset-submit">Reset Password</button><br/><br/>
                            <a href="signin.php">Login</a>
                            <br/><br/>Have an account? <a href="new_account.php">Register</a>
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