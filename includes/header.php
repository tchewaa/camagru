<?php
require("./db_connection.php");
session_start();
if(!isset($_SESSION['user_id']) && !isset($_SESSION['username']) && !isset($_SESSION['fullname']) && !isset($_SESSION['profile_pic']))
{
    header("Location: index.php");
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/main.css" />
    <link rel="stylesheet" href="css/font-awesome/css/font-awesome.min.css">
    <script src="./js/functions.js"></script>  
    <title>Camagru</title>
</head>
<body>
    <header>
        <div class="container">
            <nav>
                <div class="row">
                    <div class="menu">
                        <div class="logo">
                            <p><span class="icon">C</span><a class="link" href="timeline.php">Camagru</a></p>
                            <p></p>
                        </div>
                        <ul>
                            <li><a class="link" href="#"><i class="fa fa-indent" aria-hidden="true"></i> Explore</a></li>
                            <li><a class="link" id ="myBtn"><i class="fa fa-list-alt" aria-hidden="true"></i>  Activity</a></li>
                            <li><a class="link" href="profile.php"><i class="fa fa-user" aria-hidden="true"></i> Profile</a></li>
                            <li><a class="link" href="logout.php">Sign Out</a></li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
    </header>