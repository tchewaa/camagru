<?php
    require("includes/header.php");
    if (isset($_GET["action"]) && $_GET["action"] == "verify"){
        if (isset($_GET['token']) && isset($_GET['email_address']))
        {
            $email_address = $_GET['email_address'];
            $token = $_GET['token'];
            try{

                $stmt = $conn->prepare("SELECT `email_address`,`active`,`token` FROM `users` WHERE email_address = :email_address AND token = :token"); 
                $stmt->bindValue(':email_address', $email_address);
                $stmt->bindValue(':token', $token);
                $stmt->execute();
                $user = $stmt->fetch(PDO::FETCH_ASSOC);
                if ($user === false)
                {
                    echo "Error : Could not verify your credentials";
                }
                else{
                    $email = $user['email_address'];
                    $key = $user['token'];

                    $stmt_1 = $conn->prepare("UPDATE `users` SET `active` = '1' WHERE email_address = :email_address AND token = :token");
                    $stmt_1->bindParam(':email_address', $email);
                    $stmt_1->bindParam(':token', $token);
                    $stmt_1->execute();

                    $stmt_2 = $conn->prepare("UPDATE `users` SET `token` = NULL WHERE email_address = :email_address");
                    $stmt_2->bindParam(':email_address', $email);
                    $stmt_2->execute();

                    echo "<script language='javascript'>alert('Your email address has been verified');</script>"; 
                    header("refresh:0.5; url=signin.php");                
                }
            }
            catch(PDOException $e){
                echo  $e->getMessage();
            }
        }
        else{
            echo "<script language='javascript'>alert('Could not verify your account.  Contact Camagru Team!');</script>"; 
            header("refresh:0.5; url=signin.php");  
        }
    }
?>