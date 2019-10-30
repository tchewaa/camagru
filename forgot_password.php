
<?php
    require("includes/header_index.php");
    if(isset($_POST['reset-submit']))
    {
        $username_email = $_POST['user_email'];

        if (empty($username_email))
        {
            $error = "Field must not be empty";
        }
        else if (!filter_var($username_email, FILTER_VALIDATE_EMAIL)){
            $error = "Invalid email address.";
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
                        <p>Enter your username or email and we'll send you a link to get back into your account.</p>
                        <br/>
                        <p><span class="error"><?php if (isset($error)) echo $error ?></span>
                        <span class="success"><?php if (isset($success)) echo $success ?></span></p><br/>
                        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                            <input type="text" name="user_email" placeholder="Email Address"><br><br/>
                            <button class ="primary-button" type="submit" name="reset-submit">Reset Password</button><br/><br/>
                            <a href="index.php">Sign In</a>
                            <br/><br/>Have an account? <a href="new_account.php">Sign Up</a>
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