
<?php
    require("includes/header.php");
    if(!isset($_SESSION['user_id']) && !isset($_SESSION['username']) && !isset($_SESSION['password']) && !isset($_SESSION['fullname']) && !isset($_SESSION['profile_pic'])  && !isset($_SESSION['email_address']) && !isset($_SESSION['receive_email']))
    {
        header("Location: signin.php");
    }
?>
<main>
        <section class="timeline_section">
            <div class="container">
                <div class="row">
                    <div class="profile_container">
                        <h4 class="right">Settings</h4>
                        <h3>Change Password </h3>
                        <?php
                        if(isset($_POST['changePassword']))
                        {
                            $email_address = $_SESSION['email_address'];
                            $oldPassword = $_POST['oldPassword'];
                            $newPassword = $_POST['newPassword'];
                            $confirmPassword = $_POST['confirmPassword'];

                            $o_uppercase = preg_match('@[A-Z]@', $oldPassword);
                            $o_lowercase = preg_match('@[a-z]@', $oldPassword);
                            $o_number    = preg_match('@[0-9]@', $oldPassword);
                            $o_specialChars = preg_match('@[^\w]@', $oldPassword);

                            $n_uppercase = preg_match('@[A-Z]@', $newPassword);
                            $n_lowercase = preg_match('@[a-z]@', $newPassword);
                            $n_number    = preg_match('@[0-9]@', $newPassword);
                            $n_specialChars = preg_match('@[^\w]@', $newPassword);

                            $c_uppercase = preg_match('@[A-Z]@', $confirmPassword);
                            $c_lowercase = preg_match('@[a-z]@', $confirmPassword);
                            $c_number    = preg_match('@[0-9]@', $confirmPassword);
                            $c_specialChars = preg_match('@[^\w]@', $confirmPassword);

                            if(empty($_POST['oldPassword']) || empty($_POST['newPassword']) || empty($_POST['confirmPassword']))
                            {
                                $error = "Error : Empty field are not allowed.";
                            }
                            else if (!$o_uppercase || !$o_lowercase || !$o_number || !$o_specialChars || strlen($oldPassword) < 8)
                            {
                                $error = "Error:<ul class='error' style='margin-left:25px'><li>Password should be at least 8 characters in length.</ll> <li>Password should include at least one upper case letter.</li> <li> Password should have one number, and one special character.</li></ul>";
                            }
                            else if (!$n_uppercase || !$n_lowercase || !$n_number || !$n_specialChars || strlen($newPassword) < 8)
                            {
                                $error = "Error:<ul class='error' style='margin-left:25px'><li>Password should be at least 8 characters in length.</ll> <li>Password should include at least one upper case letter.</li> <li> Password should have one number, and one special character.</li></ul>";
                            }
                            else if (!$c_uppercase || !$c_lowercase || !$c_number || !$c_specialChars || strlen($confirmPassword) < 8)
                            {
                                $error = "Error:<ul class='error' style='margin-left:25px'><li>Password should be at least 8 characters in length.</ll> <li>Password should include at least one upper case letter.</li> <li> Password should have one number, and one special character.</li></ul>";
                            }
                            else if ($newPass !== $confirmedPass)
                            {
                                $error = "Passwords are not the same.";
                            }
                            else{
                                try{
                                        $stmt = $conn->prepare("SELECT `email_address`,`password` FROM `users` WHERE email_address = :email_address;"); 
                                        $stmt->bindValue(':email_address', $email_address);
                                        $stmt->execute();
                                        $user = $stmt->fetch(PDO::FETCH_ASSOC);

                                        if($user === false)
                                        {
                                            $error = "Error : Could not execute the statement";
                                        }
                                        else{
                                            $hashed = $user['password'];
                                            $db_email = $user['email_address'];
                                            $checkPassword = password_verify($oldPassword, $hashed);
                                            if($checkPassword)
                                            {
                                                $hashing = password_hash($newPassword, PASSWORD_DEFAULT);
                                                $stm = $conn->prepare("UPDATE `users` SET `password` = :pass WHERE email_address = :email_address;");
                                                $stm->bindValue(':email_address', $db_email);
                                                $stm->bindValue(':pass', $hashing);
                                                if($stm->execute())
                                                {
                                                    $success = "Password Updated Successfully";
                                                }else{
                                                    $error = "Error: ".$smt->errorInfo();
                                                }
                                            }
                                            else{
                                                $error = "Error: Old Password not the same";
                                            }
                                        }
                                    }catch(PDOException $e){
                                        $error = "Error ".$e->getMessage();
                                    }
                            }
                            
                        }

                        ?>
                            <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                                <br/>
                                 <p><span class="error"><?php if (isset($error)) echo $error ?></span>
                                <span class="success"><?php if (isset($success)) echo $success ?></span></p><br/>
                                Old Password<br/><input type="password" name="oldPassword" placeholder="Old Password"><br/><br/>
                                New Password<br/><input type="password" name="newPassword" placeholder="New Password"><br/><br/>
                                Confirm Password<br/><input type="password" name="confirmPassword" placeholder="Confirm Password"><br/><br/>
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