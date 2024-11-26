<?php
require 'backend/dblogin.php'; // Replace with your database connection file

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $researchID = isset($_POST['ResearchID']) ? intval($_POST['ResearchID']) : 0;

    if ($researchID) {
        try {
            $query = "INSERT INTO `best_research` (ResearchID) SELECT :ResearchID WHERE NOT EXISTS 
                     (SELECT 1 FROM `best_research` WHERE ResearchID = :ResearchID)";
            $stmt = $pdo->prepare($query);
            $stmt->execute(['ResearchID' => $researchID]);
            echo json_encode(['success' => true]);
        } catch (PDOException $e) {
            echo json_encode(['success' => false, 'error' => $e->getMessage()]);
        }
    } else {
        echo json_encode(['success' => false, 'error' => 'Invalid Research ID']);
    }
} else {
    echo json_encode(['success' => false, 'error' => 'Invalid request method']);
}
?>
