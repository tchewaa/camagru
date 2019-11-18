
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
                        
                     <div style="text-align:center">
                        <div>
                            <div style="margin-bottom: 15px">
                                <img id="kya"  src="stickers/kya.png" alt="kya" width=100 height=100>
                                <img id="light" src="stickers/light.png" alt="light" width=100 height=100>
                                <img id="nerd" src="stickers/nerd.png" alt="nerd" width=100 height=100>
                                <img id="skull" src="stickers/skull.png" alt="skull" width=100 height=100>
                            </div>


                            <div style="margin-bottom: 15px">
                                <video id="video" autoplay></video><br/>
                            </div>
                            <div style="margin-bottom: 15px">
                                <button class="btn profile_buttons outline" id="snap">Capture</button>
                                <select id="stickers" style="font-size: 20px;height: 40px;">
                                    <option value="none">none</option>
                                    <option value="kya">kya</option>
                                    <option value="light">light</option>
                                    <option value="nerd">nerd</option>
                                    <option value="skull">skull</option>
                                </select>
                                <button class="btn profile_buttons outline" id="apply">Apply</button>
                                <button class="btn profile_buttons blue" id="save" name="img">Upload</button>
                            </div>
                            <div style="margin-bottom: 15px">
                                    <canvas id="edit" width=416 height=300></canvas>
                            </div>
                    </div>
                           
                            <br>
                        </div>
                    <div>
                </div>  

                       
                            
                </div>              
            </div>
        </div>
    </section>
</main>
<?php
    require "includes/footer.php";
?>
</body>
<script src="camera.js"></script>

</html>