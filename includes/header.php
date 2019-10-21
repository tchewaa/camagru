<?php
include_once 'config/config.php';
session_start();
/*if(!isset($_SESSION['user_id']))
{
    header("Location: timeline.php");
}*/
?>
<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/main.css" />
    <script src="./js/functions.js"></script>  
    <title>Camagru | Social</title>
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
                            <li><a class="link" href="#">Explore</a></li>
                            <li><button class="link" id ="myBtn">Activity</button></li>
                            <li><a class="link" href="#">Profile</a></li>
                            <li><a class="link" href="#"><?php if(isset($_SESSION['username'])){echo $_SESSION["username"];}?></a></li>
                            <li><a class="link" href="logout.php">Sign Out</a></li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
    </header>