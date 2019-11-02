
<?php
    require "includes/header.php";
?>
<main>
        <section class="timeline_section">
            <div class="container">
                <div class="row">
                    <div class="profile_container">
                        <h4 class="right">Settings</h4>

                        <div class="profile_edit_button">
                            <a onclick="mySecurity()" class="btn profile_buttons outline" type="button" href='#'><i class="fa fa-lock" aria-hidden="true"></i> Security</a>
                            <a onclick="myNotification()"class="btn profile_buttons outline" type="button" href='#'><i class="fa fa-bell" aria-hidden="true"></i> Notifications</a>
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