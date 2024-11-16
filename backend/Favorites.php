<?php
header('Content-Type: application/json');
require 'dblogin.php';

// Handle different request methods
$method = $_SERVER['REQUEST_METHOD'];
$UID = $_COOKIE["Email"]; // Use the cookie to get the user's ID

if ($method === 'GET') {
    // Fetch all favorites
    $stmt = $pdo->prepare("SELECT a.ResearchID, b.ImageName, b.Title FROM `favoritetbl` as a 
                           LEFT JOIN `researchtbl` as b ON b.ResearchID = a.ResearchID 
                           WHERE UID = :UID AND a.status = 1");
    $stmt->bindParam(':UID', $UID);
    $stmt->execute();
    $favorites = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($favorites);

} elseif ($method === 'DELETE') {
    // Get the ResearchID from the query string
    parse_str(file_get_contents("php://input"), $_DELETE);  // This is to capture the DELETE body content, but we will use query parameters
    $id = $_GET['ResearchID'] ?? null; // Get ResearchID from query string

    if ($id) {
        // Prepare and execute the SQL query
        $stmt = $pdo->prepare("UPDATE favoritetbl SET status = 0 WHERE ResearchID = :id AND UID = :UID");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':UID', $UID, PDO::PARAM_STR);
        
        // Execute the query and check if it was successful
        $success = $stmt->execute();

        // Return the result as a JSON response
        echo json_encode(['success' => $success]);
    } else {
        // No ID provided in the request
        echo json_encode(['success' => false, 'error' => 'No ResearchID provided']);
    }

} else {
    // Invalid request method (not GET or DELETE)
    echo json_encode(['error' => 'Invalid request method']);
}
