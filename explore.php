
<?php
    require("includes/header.php");
?>
<main>
        <section class="timeline_section">
            <div class="container">
                <div class="row">
                    <div class="timeline_feeds" style="width:100% !important; text-align:left">
                    <h4 class="right">Explore</h4>

                    <?php
                            try{
                                $user_id = $_SESSION['user_id'];
                                //$stmt = $conn->prepare("SELECT  *  FROM `image` WHERE `user_id` = 45");
                                $stmt = $conn->prepare("SELECT u.user_id,  i.image_id, i.user_id, i.image_caption, i.image_name, i.image_time
FROM users u, `image` i WHERE u.user_id = i.user_id AND u.user_id = $user_id AND i.user_id = $user_id ORDER BY i.image_time DESC LIMIT 1"); 
                                $stmt->execute();
                                //$data = $stmt->fetch(PDO::FETCH_ASSOC);
                                if ($stmt === false){                                            
                                    $error = "NO POSTS YET...ADD SOMETHING.";
                                }else{ 
                                    foreach ($stmt as $row) {
                                        echo "<div class='image-container'>";
                                        echo "<img src='".$row['image_name']."' width='250px' height='250px' alt='Posts' class='image'>";
                                        //echo    <img src="img_avatar.png" alt="Avatar" class="image">;
                                        echo    "<div class='overlay'>";
                                        echo        "<div class='text'>'".$row['image_caption']."'</div>";
                                        echo    "</div>";
                                        echo "</div>";
                                        
                                    }
                                }
                                   
                            }catch(PDOException $e){
                                    $error = "Error: ".$e->getMessage();
                            }
                       ?> 
                    </div>
                </div>
            </div>
        </section>
</main>
<?php
    require("includes/footer.php");
?>
</body>

</html>