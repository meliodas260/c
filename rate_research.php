<?php
// Connect to the database
require 'backend/dblogin.php'; // Adjust path as needed for your database connection

// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Collect the data from the request
    $UID = $_POST['UID'];
    $ResearchID = $_POST['ResearchID'];
    $Rate = $_POST['rate'];

    $cookie_value = $_COOKIE["RepSesID"];
        $lastChar = substr($cookie_value, -1);

        if ($lastChar === '1') {
            $RaterUserType ='1';
        } else if ($lastChar === '9') {
            $RaterUserType ='3';
        }else{
            $RaterUserType ='2';
        }

    // Check if the user has already rated this research
    $check_sql = "SELECT * FROM studentresearchratetbl WHERE UID = ? AND ResearchID = ?";
    $check_stmt = $pdo->prepare($check_sql);
    $check_stmt->execute([$UID, $ResearchID]);
    $existingRating = $check_stmt->fetch();

    if ($existingRating) {
        // If the rating already exists, update it
        $update_sql = "UPDATE studentresearchratetbl 
                       SET Rate = ?, Date = NOW() 
                       WHERE UID = ? AND ResearchID = ?";
        $update_stmt = $pdo->prepare($update_sql);

        try {
            // Execute the update statement
            $update_stmt->execute([$Rate, $UID, $ResearchID]);

            // Provide feedback to the user
            echo "Rating updated successfully!";
        } catch (PDOException $e) {
            // Handle any errors
            echo "Error updating rating: " . $e->getMessage();
        }
    } else {
        // If no previous rating exists, insert a new one
        $insert_sql = "INSERT INTO studentresearchratetbl (UID, ResearchID, RaterUserType, Rate, Date) 
                       VALUES (?, ?, ?, ?, NOW())"; // NOW() inserts the current date and time
        $insert_stmt = $pdo->prepare($insert_sql);

        try {
            // Execute the insert statement
            $insert_stmt->execute([$UID, $ResearchID, $RaterUserType, $Rate]);

            // Provide feedback to the user
            echo "Rating submitted successfully!";
        } catch (PDOException $e) {
            // Handle any errors
            echo "Error inserting rating: " . $e->getMessage();
        }
    }
} else {
    echo "Invalid request method.";
}

// Close the database connection
$pdo = null;
?>
