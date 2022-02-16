<?php
    $servername = "localhost";
    $username = "u863218974_kanai";
    $password = "Muchona37#";
    $dbname = "u863218974_kanaitech";

    // $servername = "localhost";
    // $username = "u863218974_root";
    // $password = "Rootadmin247";
    // $dbname = "u863218974_mango";
    
    try {
        //database_connection.php
        $connect = new PDO("mysql:host=$servername; dbname=$dbname", $username, $password);
        // set the PDO error mode to exception
        $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    } catch(PDOException $e) {
        echo "Database connection failed: " . $e->getMessage();
    }
    
?>