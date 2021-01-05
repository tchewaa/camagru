
<?php
    require("includes/header.php");
    if (isset($_GET["action"]) && $_GET["action"] == "exists"){
        if (isset($_GET['token']) && isset($_GET['email_address']))
        {
            $email_address = $_GET['email_address'];
            $token = $_GET['token'];
            try{
                $stmt = $conn->prepare("SELECT `password`,`email_address`,`token` FROM `users` WHERE email_address = :email_address AND token = :token;"); 
                $stmt->bindValue(':email_address', $email_address);
                $stmt->bindValue(':token', $token);
                $stmt->execute();
                $user = $stmt->fetch(PDO::FETCH_ASSOC);
                //Redirect if  token and email dont exist in the table
                if($user === false){
                    header("Location: signin.php");
                }
                $_SESSION["temp_mail"] = $_GET['email_address'];

            }catch(PDOException $e){
                $error = "Error ".$e->getMessage();
            }
        }else{
            header("Location: signin.php");
        }
    }else if(isset($_POST['changePassword'])){

        $newPass = htmlentities($_POST['newPassword'], ENT_QUOTES, 'UTF-8');
        $confirmedPass = htmlentities($_POST['confirmPassword'], ENT_QUOTES, 'UTF-8');
        $email = htmlentities($_SESSION['temp_mail'], ENT_QUOTES, 'UTF-8');


        $n_uppercase = htmlentities(preg_match('@[A-Z]@', $newPass), ENT_QUOTES, 'UTF-8');
        $n_lowercase = htmlentities(preg_match('@[a-z]@', $newPass), ENT_QUOTES, 'UTF-8');
        $n_number    = htmlentities(preg_match('@[0-9]@', $newPass), ENT_QUOTES, 'UTF-8');
        $n_specialChars = htmlentities(preg_match('@[^\w]@', $newPass), ENT_QUOTES, 'UTF-8');

        $c_uppercase = htmlentities(preg_match('@[A-Z]@', $confirmedPass), ENT_QUOTES, 'UTF-8');
        $c_lowercase = htmlentities(preg_match('@[a-z]@', $confirmedPass), ENT_QUOTES, 'UTF-8');
        $c_number    = htmlentities(preg_match('@[0-9]@', $confirmedPass), ENT_QUOTES, 'UTF-8');
        $c_specialChars = htmlentities(preg_match('@[^\w]@', $confirmedPass), ENT_QUOTES, 'UTF-8');

        if(empty($newPass) || empty($confirmedPass))
        {
            $error = "Error : Empty field are not allowed.";
        }
        else if (!$n_uppercase || !$n_lowercase || !$n_number || !$n_specialChars || strlen($newPass) < 8)
        {
            $error = "Error:<ul class='error' style='margin-left:25px'><li>Password should be at least 8 characters in length.</ll> <li>Password should include at least one upper case letter.</li> <li> Password should have one number, and one special character.</li></ul>";
        }
        else if (!$c_uppercase || !$c_lowercase || !$c_number || !$c_specialChars || strlen($confirmedPass) < 8)
        {
            $error = "Error:<ul class='error' style='margin-left:25px'><li>Password should be at least 8 characters in length.</ll> <li>Password should include at least one upper case letter.</li> <li> Password should have one number, and one special character.</li></ul>";
        }
        else if ($newPass !== $confirmedPass)
        {
            $error = "Passwords are not the same.";
        }
        else{
            try{
                $token = NULL;
                $hashing = password_hash($newPass, PASSWORD_DEFAULT);
                $stm = $conn->prepare("UPDATE `users` SET `password` = :pass WHERE email_address = :email_address;");
                $stm->bindValue(':email_address', $email);
                $stm->bindValue(':pass', $hashing );
                if($stm->execute())
                {
                    echo "<script language='javascript'>alert('Your password has been reset');</script>"; 
                    header("refresh:0.5;url=signin.php");
                }else{
                    $error = "Error: Something went wrong, try again later";
                }
            }catch(PDOException $e){
                    $error = "Error: ".$e->getMessage();
            }
        }

    }
?>
<main>
        <section class="timeline_section">
            <div class="container">
                <div class="row">
                    <div class="profile_container">
                        <h4 class="right">Reset</h4>
                        <h3>Reset Password</h3>
                            <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                                <br/>
                                 <p><span class="error"><?php if (isset($error)) echo $error ?></span>
                                <span class="success"><?php if (isset($success)) echo $success ?></span></p><br/>
                                New Password<br/><input class= "form-input" type="password" name="newPassword" placeholder="New Password"><br/><br/>
                                Confirm Password<br/><input class= "form-input" type="password" name="confirmPassword" placeholder="Confirm Password"><br/><br/>
                                <button class ="btn primary-button" type="submit" name="changePassword">Reset Password</button><br/><br/>
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