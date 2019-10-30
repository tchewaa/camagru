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
                                
                                
                                if (empty($email_address) || empty($password)){
                                    echo "<span class='error'>Error: Empty fields not allowed.</span>";
                                }
                                else if (!filter_var($email_address, FILTER_VALIDATE_EMAIL)){
                                    echo "<span class='error'>Error: Invalid email address.</span>";
                                } 
                                /*else if(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password) < 8)
                                {
                                    $error = "Password should be at least 8 characters in length <br/> and should include at least one upper case letter, <br/> one number, and one special character.";
                                }*/
                                else{
                                       
                                        $active = '1';
                                        $stmt = $conn->prepare("SELECT `user_id`,`username`,`password`,`fullname`,`profile_pic_url` 
                                        FROM `users` WHERE email_address = :email_address AND active = :active;"); 

                                        $stmt->bindValue(':email_address', $email_address);
                                        $stmt->bindValue(':active', $active);

                                        $stmt->execute();

                                        $user = $stmt->fetch(PDO::FETCH_ASSOC);

                                        if ($user === false)
                                        {
                                            echo "<span class='error'>Incorrect credentials / Account not active.</span>";
                                        }else{
                                            $hashed = $user['password'];
                                            
                                            $checkPassword = password_verify($password, $hashed);
                                           
                                            if($checkPassword)
                                            {
                                                $_SESSION['user_id'] = $user["user_id"];
                                                $_SESSION['username'] = $user["username"];
                                                $_SESSION['fullname'] = $user["fullname"];
                                                $_SESSION['profile_pic'] = $user["profile_pic_url"];
                                                header("Location: timeline.php");
                                                exit;
                                            }else{
                                                echo "<span class='error'>Incorrect email address / password combination.</span>";
                                            }
                                        }
                                }
                            }
                        ?>
                        <br/><br/>
                        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                            <input type="text" name="email_address" placeholder="Email Address"><br><br/>
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