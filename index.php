<?php
require("includes/header_index.php");
?>

<main>

        <section class="register-class">
            <div class="container">
                <div class="row">
                    <div style="text-align:center" class="reg-form login-box">
                        <p><span style="border: 2px solid #000 !important" class="icon">C</span><br/><br/><a style="color:#000; font-size:30px" class="link" href="index.php">Camagru</a></p>
                        <br/><br/>
                        <?php
                            if (isset($_POST['sign_in']))
                            {
                                $email_address = $_POST['email_address'];
                                $password = $_POST['password'];
                                $uppercase = preg_match('@[A-Z]@', $password);
                                $lowercase = preg_match('@[a-z]@', $password);
                                $number    = preg_match('@[0-9]@', $password);
                                $specialChars = preg_match('@[^\w]@', $password);
                                $error = "";
                                $success = "";
                            
                                
                                
                                if (empty($email_address) || empty($password)){
                                    $error = "Error: Empty fields not allowed.";
                                }
                                else if (!filter_var($email_address, FILTER_VALIDATE_EMAIL)){
                                    $error = "Error: Invalid email address.";
                                } 
                                else if (!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password) < 8)
                                {
                                    $error = "Error: Password should be at least 8 characters in length <br/> and should include at least one upper case letter, <br/> one number, and one special character.";
                                }
                                else{
                                       
                                        $active = '1';
                                        $stmt = $conn->prepare("SELECT `user_id`,`username`,`password`,`email_address`,`password`,`fullname`,`profile_pic_url` FROM `users` WHERE email_address = :email_address AND active = :active;"); 
                                        $stmt->bindValue(':email_address', $email_address);
                                        $stmt->bindValue(':active', $active);

                                        $stmt->execute();

                                        $user = $stmt->fetch(PDO::FETCH_ASSOC);

                                        if ($user === false)
                                        {
                                            $error = "Error: Incorrect credentials / Account not active.";
                                        }else{
                                            $hashed = $user['password'];
                                            
                                            $checkPassword = password_verify($password, $hashed);
                                           
                                            if($checkPassword)
                                            {
                                                $_SESSION['user_id'] = $user["user_id"];
                                                $_SESSION['username'] = $user["username"];
                                                $_SESSION['password'] = $user["password"];
                                                $_SESSION['email_address'] = $user["email_address"];
                                                $_SESSION['fullname'] = $user["fullname"];
                                                $_SESSION['profile_pic'] = $user["profile_pic_url"];
                                                $_SESSION['privacy_level'] = $user["privacy_level"];
                                                $_SESSION['receive_email'] = $user["receive_email"];
                                                
                                                header("Location: timeline.php");
                                                exit;
                                            }else{
                                                $error = "Error: Incorrect email address / password combination.";
                                            }
                                        }
                                }
                            }
                        ?>
                        <p><span class="error"><?php if (isset($error)) echo $error ?></span>
                        <span class="success"><?php if (isset($success)) echo $success ?></span></p><br/>
                        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                            <input type="text" value = "<?php if (isset($_POST['email_address'])) echo $_POST['email_address'];?>" name="email_address" placeholder="Email Address"><br><br/>
                            <input type="password" name="password" placeholder="Password"><br/><br/>
                            <button class ="primary-button" type="submit" name="sign_in">Sign In</button><br/><br/>
                            <a href="forgot_password.php">Forgot Password?</a>
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