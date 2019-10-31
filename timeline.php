
<?php
    require("includes/header.php");
?>
<main>
        <section class="timeline_section">
            <div class="container">
                <div class="row">
                    <div class="timeline_feeds">
                       The Feeds

                            
                        
                    </div>
                    <div class="sidebar_feeds">
                       <div class="small_profile_no_icon">
                       <?php
                        if(isset($_SESSION['profile_pic'])){
                                echo $_SESSION["profile_pic"];
                        }
                        else{
                                echo '<img src="images/no-profile-pic-icon-5.jpg"/>';
                        }
                        ?>
                       </div>
                       <div class="timeline_profile_name">
                       <?php 
                        if(isset($_SESSION['username']) || isset($_SESSION['fullname']))
                        {
                           echo "<p>".$_SESSION["username"] . "<br/>" .$_SESSION['fullname']. "</p>";
                        }
                        ?>
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

</html>