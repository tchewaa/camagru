<?php
require "includes/header_index.php";
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
                                //$hash = password_hash($password,PASSWORD_DEFAULT);

                                $sql = "SELECT * FROM `users` WHERE email_address = '".$email_address."' AND password = '".$password."';";
                                $res = $conn->query($sql);

                                if (mysqli_num_rows($res) > 0) {
                                    while($row = mysqli_fetch_assoc($res)) {
                                        //if(password_verify($password, $row["password"]))
                                        //{
                                            $_SESSION['user_id'] = $row["user_id"];
                                            $_SESSION['username'] = $row["username"];
                                            header("Location: timeline.php");
                                       // }else{
                                         //   echo "Invalid Credentials";
                                        //}
                                    }
                                } else {
                                    echo "0 results";
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