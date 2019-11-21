
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
                        <h4 class="right">Image Post</h4>
                        <?php
                            if(isset($_POST['UploadImage']))
                            {
                                $caption = $_POST['caption'];
                                $target_dir = "upload/";
                                $target_file = $target_dir . basename($_FILES["image"]["name"]);
                               

                                if(empty($caption) || empty($target_file)){
                                    $error = "Please attach an image and write a caption";
                                }
                                else{
                                    try{
                                        $timestamp = date("Y-m-d H:i:s");
                                        $user_id = $_SESSION['user_id'];
                                        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
                                        $check = getimagesize($_FILES["image"]["tmp_name"]);
                                        //Check if the file is really an image
                                        if ($check)
                                        {
                                            // Check if the file exist
                                            //if (file_exists($target_file)) {
                                                // Check file size does not exceed 50MB
                                                //if ($_FILES["image"]["size"] > 1000000) {
                                                    //check if the file is an allowed file extension
                                                    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ){
                                                        $error = "Error: only JPG, JPEG, PNG & GIF files are allowed.";
                                                    }
                                                    else{
                                                        if(move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)){
                                                            $sql = "INSERT INTO `image` (`image_id`, `user_id`, `image_caption`, `image_name`, `image_path`,`image_time`) 
                                                            VALUES (NULL, '".$user_id."', '".$caption."', '".$target_file."', '".$target_dir."', '".$timestamp."')";
                                                            $res = $conn->exec($sql);
                                                            if($res)
                                                                $success = "Post added successful";
                                                            else
                                                                $error = "Failed to add a post";
                                                        }else{
                                                            $error = "Error: File could not be moved";
                                                        }
                                                    }
                                               /* }
                                                else{
                                                    $error = "Error: File exceeds 50MB";
                                                }*/
                                           /* }
                                            else{
                                                $error = "Error: File already exist";
                                            }*/
                                        }
                                        else{
                                            $error = "File is not an image";
                                        }
                                    }catch(PDOException $e)
                                    {
                                        $error = "Error: ".$e->getMessage()."<br/> ".$image;
                                    }
                                }
                            }
                           
                        ?>
                        <p><span class="error"><?php if (isset($error)) echo $error ?></span>
                        <span class="success"><?php if (isset($success)) echo $success ?></span></p><br/>
                        <form enctype="multipart/form-data" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                            <label>Upload an Image:</label><br/><br/>
                            <input type='file' name='image' /><br/><br/>
                            <textarea rows="6" name = "caption" placeholder="Caption"></textarea><br/><br/>
                            
                            <button style="width: 10%" class ="primary-button" type="submit" name="UploadImage">Post</button>
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