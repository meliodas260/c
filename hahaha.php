<?php
require 'backend/dblogin.php'; // Database connection

// Function to check favorite status
function checkFavoriteStatus($pdo, $studentID, $ID) {
    // Prepare the SQL query
    $sql = "SELECT status FROM favoritetbl WHERE UID = ? AND ResearchID = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$studentID, $ID]);

    // Fetch the result
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    // Check if the favorite exists
    if ($result) {
        return $result['status']; // Return status (1 for active, or 0)
    } else {
        return 0; // No favorite found
    }
}

// Usage example
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $studentID = $_POST['studentId']; // Get from POST request
    $ID = $_POST['id']; // Get from POST request

    $status = checkFavoriteStatus($pdo, $studentID, $ID);
    echo json_encode(['status' => $status]);
}
?>
