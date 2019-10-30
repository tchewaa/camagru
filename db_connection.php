<?php
require("config/database.php");
try {
    $conn = new PDO("mysql:host=$servername;dbname=camagru_db", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
catch(PDOException $e)
    {
        echo "Connection failed: " . $e->getMessage();
    }
?>
