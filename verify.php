<?php
    if (isset($_GET['key']) && isset($_GET['email_address']))
    {
        require("includes/header_index.php");
        $email_address = $_GET['email_address'];
        $verify_key = $_GET['key'];
        try{

            $stmt = $conn->prepare("SELECT `email_address`,`active`,`verify_key` FROM `users` WHERE email_address = :email_address AND verify_key = :verify_key"); 
            $stmt->bindValue(':email_address', $email_address);
            $stmt->bindValue(':verify_key', $verify_key);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($user === false)
            {
                echo "Error";
            }
            else{
                $email = $user['email_address'];
                $key = $user['verify_key'];

                $stmt_1 = $conn->prepare("UPDATE `users` SET `active` = '1' WHERE email_address = :email_address AND verify_key = :verify_key");
                $stmt_1->bindParam(':email_address', $email);
                $stmt_1->bindParam(':verify_key', $key);
                $stmt_1->execute();
                echo "<script language='javascript'>alert('Your email address has been verified');</script>"; 
                header("refresh:0.5; url=index.php");                
            }
        }
        catch(PDOException $e){
            echo  $e->getMessage();
        }
    }
?>