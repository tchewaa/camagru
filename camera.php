
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
                <div class="row" style="width:82% !important">
                    <div class="profile_container">
                        <h4 class="right">Camera Post</h4>
                        <?php
                            if(isset($_POST['UploadImage'])){
                                define('UPLOAD_DIR', 'img/');
                        
                                $img = $_POST['image'];
                        
                                $img = str_replace('data:image/png;base64,', '', $img);
                                $img = str_replace(' ', '+', $img);
                                $data = base64_decode($img);
                                $file = UPLOAD_DIR . uniqid() . '.png';
                                $success = file_put_contents($file, $data);
                        
                                print $success ? $file : 'Unable to save the file.';
                            }		
                        
                        ?>
                        <p><span class="error"><?php if (isset($error)) echo $error ?></span>
                        <span class="success"><?php if (isset($success)) echo $success ?></span></p><br/>
                        <video id="video">No streaming available...</video>
                        <div class="top-container">
                            <button id="photo-button" class="btn btn-dark">Take Photo</button><br/>
                            <button class ="primary-button" name="UploadImage" onclick="myCameraUpload()">Upload A Photo</button>
                            <select id="photo-filter" class="select">
                                <option value="none">Normal</option>
                                <option value="grayscale(100%">Grayscale</option>
                                <option value="sepia(100%)">Sepia</option>
                                <option value="invert(100%)">Invert</option>
                                <option value="hue-rotate(90deg)">Hue</option>
                                <option value="blur(10px)">Blur</option>
                                <option value="contrast(200%)">Contrast</option>
                            </select>
                            <button id="clear-button" class="btn btn-light">Clear</button>
                            
                        </div>
                        
                        <canvas id="canvas"></canvas>
                        <div class="bottom-container">
                            <div id="photos"></div>
                        </div>  
                        <form method="post" accept-charset="utf-8" name="form1">
                            <input name="hidden_data" id='hidden_data' type="hidden" />
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
<script src="./js/camera.js"></script>

</html>