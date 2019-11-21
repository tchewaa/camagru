<?php
/*require 'header.php';
if (!isset($_POST['Edit_page']))
    header("Location: profile.php");*/

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
</head>

<body>
    <div style="display: flex">
        <div style="display: flex">
            <div style="display: grid">
                <video id="video" autoplay></video>
                <button id="snap">Capture</button>

            </div>
            <div style="display: grid">
                <canvas id="canvas" width=300 height=300></canvas>
                <button id="apply">Apply</button>
                <button id="save" name="img">Save</button>
                <select id="stickers">
                    <option value="none">none</option>
                    <option value="kya">kya</option>
                    <option value="light">light</option>
                    <option value="nerd">nerd</option>
                    <option value="skull">skull</option>
                </select>

                 </div>
                     <canvas id="edit" width=300 height=300></canvas>
            </div>
            <div>
                <form action="includes/upload.inc.php" method="post" enctype="multipart/form-data">
                    <input type="file" name="file">
                    <button type="submit" name="upload">Upload</button>
                </form>
        
                <img id="kya"  src="stickers/kya.png" alt="kya" width=100 height=100><br/>
                <img id="light" src="stickers/light.png" alt="light" width=100 height=100><br/>
                <img id="nerd" src="stickers/nerd.png" alt="nerd" width=100 height=100><br/>
                <img id="skull" src="stickers/skull.png" alt="skull" width=100 height=100><br/>

            </div>
            <br>
        </div>
    <div>
</div>
        <script src="camera.js">
        </script>
      
</body>

</html>