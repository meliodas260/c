<?php
    $host = 'localhost';
    $username = 'mine';
    $password = 'pass';
    $database = 'repo';
    $dsn = "mysql:host=$host;dbname=$database;charset=utf8mb4";

    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    ?>