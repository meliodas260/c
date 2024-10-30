<?php
require 'dblogin.php';

// Get UserID from query parameters
$userID = $_GET['userid'] ?? '';

if ($userID) {
    // Prepare the query to fetch research roles from researchroletbl and researchtbl
    $stmt = $pdo->prepare("
        SELECT 
            a.Role, 
            b.Title, 
            b.ImageName
        FROM 
            `researchroletbl` a 
        LEFT JOIN 
            `researchtbl` b 
        ON 
            a.`RoleConnectorKey` = b.RoleConnectorKey
        WHERE 
            a.UID = :userID
    ");
    
    // Bind the UserID parameter
    $stmt->bindValue(':userID', $userID);
    $stmt->execute();
    
    // Fetch all research roles associated with this teacher
    $researchRoles = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Return research roles as JSON
    echo json_encode($researchRoles);
} else {
    // Return error if UserID is not provided
    echo json_encode(['error' => 'User ID not provided.']);
}

// Close connection
$pdo = null;
?>
