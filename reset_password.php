
<?php
    require("includes/header_index.php");
    //echo "Printing 1";
    if (isset($_GET["action"]) && $_GET["action"] == "exists"){
        //echo "Printing 2";
        if (isset($_GET['token']) && isset($_GET['email_address']))
        {
            $email_address = $_GET['email_address'];
            $token = $_GET['token'];
            try{
                $conn = new PDO("mysql:host=$servername;dbname=camagru_db", $username, $password);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $stmt = $conn->prepare("SELECT `password`,`email_address`,`token` FROM `users` WHERE email_address = :email_address AND token = :token;"); 
                $stmt->bindValue(':email_address', $email_address);
                $stmt->bindValue(':token', $token);
                $stmt->execute();
                $user = $stmt->fetch(PDO::FETCH_ASSOC);
                //Redirect if  token and email dont exist in the table
                if($user === false){
                    header("Location: index.php");
                }
                //echo "Printing";
                $_SESSION["temp_mails"] = $_GET['email_address'];

            }catch(PDOException $e){
                $error = "Error ".$e->getMessage();
            }
        }else{
            header("Location: index.php");
        }
    }else if(isset($_POST['changePassword'])){
        $newPass = $_POST['newPassword'];
        $confirmedPass = $_POST['confirmPassword'];
        $email = $_SESSION['temp_mails'];
        try{

            $hashing = password_hash($newPass, PASSWORD_DEFAULT);
            $conn = new PDO("mysql:host=$servername;dbname=camagru_db", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stm = $conn->prepare("UPDATE `users` SET `password` = :pass WHERE email_address = :email_address;");
            $stm->bindValue(':email_address', $email);
            $stm->bindValue(':pass', $hashing );
            if($stm->execute())
            {
                header("refresh:2; url=index.php");
            }else{
                $error = "Error: Something went wrong, try again later";
            }
        }catch(PDOException $e){
                $error = "Error: ".$e->getMessage();
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
                                New Password<br/><input type="password" name="newPassword" placeholder="New Password"><br/><br/>
                                Confirm Password<br/><input type="password" name="confirmPassword" placeholder="Confirm Password"><br/><br/>
                                <button class ="primary-button" type="submit" name="changePassword">Reset Password</button><br/><br/>
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