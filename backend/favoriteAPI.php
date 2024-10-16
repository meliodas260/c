<?php
// Connect to the database
require 'dblogin.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $studentId = $_POST['studentId']; // Get the user ID from the POST request
    $id = $_POST['id']; // Get the Research ID from the POST request

    // Check if the record exists in favoritetbl
    $sql = "SELECT status FROM favoritetbl WHERE UID = :studentId AND ResearchID = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['studentId' => $studentId, 'id' => $id]);

    if ($stmt->rowCount() > 0) {
        // Record exists, toggle the status
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $newStatus = $row['status'] == 1 ? 0 : 1;

        // Update the status
        $updateSql = "UPDATE favoritetbl SET status = :newStatus WHERE UID = :studentId AND ResearchID = :id";
        $updateStmt = $pdo->prepare($updateSql);
        $updateStmt->execute(['newStatus' => $newStatus, 'studentId' => $studentId, 'id' => $id]);

        if ($newStatus == 1) {
            echo json_encode(['status' => 'added']);
        } else {
            echo json_encode(['status' => 'removed']);
        }
    } else {
        // No record exists, insert a new one with status = 1
        $insertSql = "INSERT INTO favoritetbl (UID, ResearchID, status) VALUES (:studentId, :id, 1)";
        $insertStmt = $pdo->prepare($insertSql);
        $insertStmt->execute(['studentId' => $studentId, 'id' => $id]);

        echo json_encode(['status' => 'added']);
    }
}
?>
