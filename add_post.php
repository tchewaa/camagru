
<?php
    require "includes/header.php";
?>
<main>
        <section class="timeline_section">
            <div class="container">
                <div class="row">
                    <div class="profile_container">
                        <h4 class="right">Add a Post</h4>

                        <h3 class="center"> ----------------image--------------------</h3>
                        <p><span class="error"><?php if (isset($error)) echo $error ?></span>
                        <span class="success"><?php if (isset($success)) echo $success ?></span></p><br/>
                        <form enctype="multipart/form-data" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                            <label>Upload an Image:</label><br/><br/>
                            <input type='file' name='file' /><br/><br/>
                            <textarea rows="6" placeholder="Caption"></textarea><br/><br/>
                            
                            <button style="width: 10%" class ="primary-button" type="submit" name="">Post</button>
                        </form>

                        <br/><br/><h3 class="center"> ----------------Camera--------------------</h3>
                        <p><span class="error"><?php if (isset($error)) echo $error ?></span>
                        <span class="success"><?php if (isset($success)) echo $success ?></span></p><br/>
                        <form enctype="multipart/form-data" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                            <label>Upload an Image:</label><br/><br/>
                            <input type='file' name='file' /><br/><br/>
                            <textarea rows="6" placeholder="Caption"></textarea><br/><br/>
                            
                            <button style="width: 10%" class ="primary-button" type="submit" name="">Post</button>
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