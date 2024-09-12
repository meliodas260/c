<?php
require 'dblogin.php';
try {


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