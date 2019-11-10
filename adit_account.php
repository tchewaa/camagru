<?php
require("includes/header.php");
?>
<main>

    <section class="register-class">
            <div class="container">
                <div class="row">
                    <h1 class="register-header">-Sign Up-</h1>
                    <div class="row">
                        <div class="reg-form">
                            <?php
                                if (isset($_POST["signup-submit"]))
                                {
                                    $firstname = $_POST['name'];
                                    $lastname = $_POST['surname'];
                                    $email_address = $_POST['email_address'];
                                    $confirm_email = $_POST['confirm_email'];
                                    $password = $_POST['password'];
                                    $confirm_password = $_POST['confirm_password'];
                                    $address = $_POST["address"];
                                    $contact = $_POST['contact'];

                                    if(empty($firstname) || empty($lastname) || empty($email_address) || empty($confirm_email) || empty($password) 
                                    || empty($confirm_password) || empty($contact))
                                    {
                                        echo '<p class="error">Fields must not be empty.</p>';
                                    }
                                    else if (!filter_var($email_address, FILTER_VALIDATE_EMAIL))
                                    {
                                        echo '<p class="error">Invalid email address.</p>';
                                    }
                                    else if (!filter_var($confirm_email, FILTER_VALIDATE_EMAIL))
                                    {
                                        echo '<p class="error">Invalid email address.</p>';
                                    }
                                    else if (!preg_match("/^[0-9]*$/", $contact))
                                    {
                                        echo '<p class="error">Invalid phone number.</p>';
                                        
                                    }
                                    else if ($email_address !== $confirm_email){
                                        echo '<p class="error">Email address not the same.</p>';
                                    }
                                    else if ($password !== $confirm_password){
                                        echo '<p class="error">Passwords not the same.</p>';
                                    }
                                    else{
                                      
                                        $hashing = password_hash($password,PASSWORD_DEFAULT);
                                        $sql = "INSERT INTO `customers` (`id`, `first_name`, `last_name`, `email_address`, `password`, `address`, `contact`) VALUES (NULL, '".$firstname."', '".$lastname."', '".$email_address."', '".$hashing."', '".$address."', '".$contact."')";
                                      
                                       
                                        if(!$conn->query($sql))
                                        {
                                            echo "<p class='error'>ERROR: ".$sql."<br/>".$conn->error."</p>";
                                        }else{
                                            echo '<p class="success">Registered Success</p>';
                                        }
                                    }
                                }
                            ?>
                            <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                                <input type="text" value = "<?php if(isset($_POST['name'])){echo $_POST['name'];}?>" name="name" placeholder="First Name"><br/><br/>
                                <input type="text" value = "<?php if(isset($_POST['surname'])){echo $_POST['surname'];}?>" name="surname" placeholder="Last Name"><br/><br/>
                                <input type="text" value = "<?php if(isset($_POST['email_address'])){echo $_POST['email_address'];}?>" name="email_address" placeholder="Email"><br/><br/>
                                <input type="text" value = "<?php if(isset($_POST['confirm_email'])){echo $_POST['confirm_email'];}?>" name="confirm_email" placeholder="Confirm Email"><br/><br/>
                                <input type="password" value = "<?php if(isset($_POST['password'])){echo $_POST['password'];}?>" name="password" placeholder="Password"><br/><br/>
                                <input type="password" value = "<?php if(isset($_POST['confirm_password'])){echo $_POST['confirm_password'];}?>" name="confirm_password" placeholder="Confirm Password"><br/><br/>
                                <textarea name="address" rows="5" cols="40" placholder="Postal Address"></textarea><br/><br/>
                                <input maxlength = "10" type="text" value = "<?php if(isset($_POST['contact'])){echo $_POST['contact'];}?>" name="contact" placeholder="Mobile / Phone Number"><br/><br/>
                                <button class ="primary-button" type="submit" name="signup-submit">Sign Up</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    
</main>
<?php
    require "footer.php";
?>