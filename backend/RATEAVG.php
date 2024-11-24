<?php
header('Content-Type: application/json');
require 'dblogin.php';

$errors = [];

// Check if ResearchID is passed in the query parameters
if (isset($_GET['researchID'])) {
    $researchID = $_GET['researchID'];
    
    try {
        // Query to get count and average
        $query = "SELECT COUNT(*) AS count, AVG(`Rate`) AS ratercount FROM `studentresearchratetbl` WHERE `ResearchID` = :researchID";
        $stmt = $pdo->prepare($query);
        $stmt->execute([':researchID' => $researchID]);

        // Fetch result
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $totalRatings = $result['count'];
        $averageRating = round($result['ratercount'], 1); // Round to 1 decimal place
        $exactRatingPercentage = ($result['ratercount'] / 5) * 100; // Calculate exact percentage

        // Prepare the response data
        $response = [
            'researchID' => $researchID,
            'totalRatings' => $totalRatings,
            'averageRating' => $averageRating,
            'exactRatingPercentage' => $exactRatingPercentage
        ];

        echo json_encode($response);

    } catch (PDOException $e) {
        $errors[] = "Database connection failed: " . $e->getMessage();
        echo json_encode(['success' => false, 'errors' => $errors]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'ResearchID parameter missing']);
}

$pdo = null;
?>
