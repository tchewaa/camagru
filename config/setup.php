<?php
require("database.php");
try {
    $conn = new PDO("mysql:host=$servername", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "CREATE DATABASE IF NOT EXISTS camagru_db";
    $conn->exec($sql);
    }
catch(PDOException $e)
    {
        echo "Connection failed: " . $e->getMessage();
    }
    $conn = NULL;

?>

