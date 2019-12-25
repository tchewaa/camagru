
<?php
    require("includes/header.php");
    if(!isset($_SESSION['user_id']) && !isset($_SESSION['username']) && !isset($_SESSION['password']) && !isset($_SESSION['fullname']) && !isset($_SESSION['profile_pic'])  && !isset($_SESSION['email_address']) && !isset($_SESSION['receive_email']))
    {
        header("Location: signin.php");
    }
    if (isset($_POST['save']))
    {
        $fullname = htmlentities($_POST['fullname'], ENT_QUOTES, 'UTF-8');
        $username = htmlentities($_POST['username'], ENT_QUOTES, 'UTF-8');
        $email_address = htmlentities(strtolower($_POST['email_address']), ENT_QUOTES, 'UTF-8');
        $receive_email = htmlentities($_POST['receive_email'], ENT_QUOTES, 'UTF-8');

        if (empty($fullname) || empty($username) || empty($email_address))
        {
            $error = "Error: Empty fields not allowed.";
        }
        else if (!filter_var($email_address, FILTER_VALIDATE_EMAIL)){
            $error = "Invalid email address.";
        } 
        else {
            if (isset($username)) {
                $_SESSION["username"] = $username;
            }
            try{
                $sql = "UPDATE `users` SET `fullname` = '".$fullname."', `username` = '".$username."', `email_address` = '".$email_address."' , `receive_email` = '".$receive_email."' WHERE `user_id` = '".$_SESSION["user_id"]."'";
                $conn->exec($sql);
                $success = "Updated Successfully.";
            }
            catch(PDOException $e){
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
                        <h4 class="right">Edit Profile</h4>
                       <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                                <br/>

                                                                  
                                 <p><span class="error"><?php if (isset($error)) echo $error ?></span>
                                <span class="success"><?php if (isset($success)) echo $success ?></span></p><br/>
                                Name<br/><input type="text" value = "<?php if(isset($_SESSION['fullname'])){echo $_SESSION['fullname'];}?>" name="fullname" placeholder="Full Name"><br/><br/>
                                Username<br/><input type="text" value = "<?php if(isset($_SESSION['username'])){echo $_SESSION['username'];}?>" name="username" placeholder="Username"><br/><br/>
                                Email Address<br/><input type="text" value = "<?php if(isset($_SESSION['email_address'])){echo $_SESSION['email_address'];}?>" name="email_address" placeholder="Username"><br/><br/>
                                Receive Email Notification ?<br/>
                                Yes <input type="radio" name="receive_email" value="Yes"<? if ($_SESSION['receive_email'] == "Yes") echo " checked"; ?>> <br/>
                                No <input type="radio" name="receive_email" value="No"<? if ($_SESSION['receive_email'] == "No") echo " checked"; ?>><br/><br/>
                                Currently Set to: <?php echo $_SESSION['receive_email']; ?>  <br/><br/><br/>
                                <button class ="primary-button" type="submit" name="save">Save</button><br/><br/>
                               
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