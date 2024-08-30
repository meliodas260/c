<?php
$host = 'localhost';
$username = 'mine';
$password = 'pass';
$database = 'repo';
$dsn = "mysql:host=$host;dbname=$database;charset=utf8mb4";

try {
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Select data from the database
    $stmt = $pdo->query("SELECT * FROM `sectionn&capteachertbl`");
    
    // Prepare data for DataTables
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Return JSON response
    echo json_encode($data);
} catch (PDOException $e) {
    echo json_encode(["error" => $e->getMessage()]);
}

$pdo = null;
?>