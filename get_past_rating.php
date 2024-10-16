<?php
// get_past_rating.php

// Simulating database connection
// Replace with actual database connection code
require 'backend/dblogin.php'; // Your DB connection

if (isset($_POST['UID']) && isset($_POST['ResearchID'])) {
    $UID = $_POST['UID'];
    $ResearchID = $_POST['ResearchID'];

    // Query to fetch past rating
    $query = "SELECT Rate FROM studentresearchratetbl WHERE UID = ? AND ResearchID = ?";
    $stmt = $pdo->prepare($query);

    // Execute the statement with the UID and ResearchID as parameters
    $stmt->execute([$UID, $ResearchID]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC); // Fetch the result as an associative array

    if ($result) {
        // If a rating was found, return it as a JSON response
        echo json_encode(['success' => true, 'rating' => $result['Rate']]);
    } else {
        // No rating found for this user and research
        echo json_encode(['success' => false]);
    }
} else {
    echo json_encode(['success' => false, 'error' => 'Missing parameters']);
}

// Close the database connection
$pdo = null;
?>
