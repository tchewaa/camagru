<?php
require_once("database.php");
try {
    $conn = new PDO("mysql:host=$servername;dbname=camagru_db", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "CREATE DATABASE IF NOT EXISTS camagru_db";
    $conn->exec($sql);
    }
catch(PDOException $e)
    {
        echo "Connection failed: " . $e->getMessage();
    }

?>

