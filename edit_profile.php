
<?php
    require("includes/header.php");
    if (isset($_POST['save']))
    {
        $fullname = $_POST['fullname'];
        $username = $_POST['username'];
        $email_address = $_POST['email_address'];

        if (empty($fullname) || empty($username) || empty($email_address))
        {
            $error = "Error: Empty fields not allowed.";
        }
        else if (!filter_var($email_address, FILTER_VALIDATE_EMAIL)){
            $error = "Invalid email address.";
        } 
        else {
            
            try{
                $sql = "UPDATE `users` SET `fullname` = '".$fullname."', `username` = '".$username."', `email_address` = '".$email_address."' WHERE `user_id` = '".$_SESSION["user_id"]."'";
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
                                Username<br/><input readonly type="text" value = "<?php if(isset($_SESSION['username'])){echo $_SESSION['username'];}?>" name="username" placeholder="Username"><br/><br/>
                                Email Address<br/><input type="text" value = "<?php if(isset($_SESSION['email_address'])){echo $_SESSION['email_address'];}?>" name="email_address" placeholder="Username"><br/><br/>
                                Receive Email Notification ?<br/>
                                <select name="receive_mail">
                                    <option value="">Make Your Choice</option>
                                    <?php
                                        //$sql = "SELECT * FROM `categories`";
                                        $res = $conn->query($sql);
                                        while ($rows = mysqli_fetch_assoc($res)){ 
                                        ?>
                                        <option value="<?php echo $rows['category_id'];?>"><?php echo $rows['category_name'];?></option>

                                        <?php
                                        } 
                                        ?>
                                    </select> <br/><br/>
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