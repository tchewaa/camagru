<?php
require("./config/db_connect.php");
session_start();
/*if(!isset($_SESSION['user_id']) && !isset($_SESSION['username']) && !isset($_SESSION['password']) && !isset($_SESSION['fullname']) && !isset($_SESSION['profile_pic'])  && !isset($_SESSION['email_address']) && !isset($_SESSION['receive_email']))
{
    header("Location: index.php");
}*/
?>
<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/main.css" />
    <link rel="stylesheet" href="css/font-awesome/css/font-awesome.min.css">
    <title>Camagru</title>
</head>
<body>
    <header>
        <div class="container">
            <nav>
                <div class="row">
                    <div class="menu">
                        <div class="logo">
                            <p><span class="icon">C</span><a class="link" href="#">Camagru</a></p>
                            <p></p>
                        </div>
                        <ul>
                            <?php
                               if(!isset($_SESSION['user_id']) && !isset($_SESSION['username']) && !isset($_SESSION['password']) && !isset($_SESSION['fullname']) && !isset($_SESSION['profile_pic'])  && !isset($_SESSION['email_address']) && !isset($_SESSION['receive_email']))
                               {   
                                    echo '<li><a class="link" href="explore.php"><i class="fa fa-indent" aria-hidden="true"></i> Explore</a></li>';
                                    echo '<li><a class="link" href="index.php">Sign in</a></li>';

                                }else if(isset($_SESSION['user_id']) && isset($_SESSION['username']) && isset($_SESSION['password']) && isset($_SESSION['fullname']) && isset($_SESSION['profile_pic'])  && isset($_SESSION['email_address']) && isset($_SESSION['receive_email']))
                               {
                                     echo '<li><a class="link" href="explore.php"><i class="fa fa-indent" aria-hidden="true"></i> Explore</a></li>';
                                     echo '<li><a class="link" href="profile.php"><i class="fa fa-user" aria-hidden="true"></i> Profile</a></li>';
                                     echo '<li><a class="link" href="logout.php">Sign Out</a></li>';
                               }else{
                                    header("Location: index.php");
                               }
                             ?>       
                            
                            
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
    </header>