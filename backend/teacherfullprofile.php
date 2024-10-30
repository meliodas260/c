<?php
require 'dblogin.php';

// Get UserID from query parameters
$userID = $_GET['userid'] ?? '';

if ($userID) {
    // Prepare the query to fetch teacher details
    $stmt = $pdo->prepare("
        SELECT 
            `UserID`, 
            CONCAT(`Fname`, ' ', `Mname`, ' ', `Lname`, ' ', `Suffix`) AS Fullname, 
            `Email`,  
            `imageName`
        FROM 
            `accounttbl` 
        WHERE 
            `UserID` = :userID AND `Usertype` = '3'
    ");
    
    // Bind the UserID parameter
    $stmt->bindValue(':userID', $userID);
    $stmt->execute();
    
    // Fetch the profile data
    $profile = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($profile) {
        // Return profile as JSON
        echo json_encode($profile);
    } else {
        // Return error if teacher not found
        echo json_encode(['error' => 'Teacher not found.']);
    }
} else {
    // Return error if UserID is not provided
    echo json_encode(['error' => 'User ID not provided.']);
}

// Close connection
$pdo = null;
?>
