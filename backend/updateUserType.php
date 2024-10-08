<?php

header('Content-Type: application/json'); // Ensure correct response type
require 'dblogin.php';
// Get data from the POST request
$userID = isset($_POST['userID']) ? intval($_POST['userID']) : 0;
$newUsertype = isset($_POST['newUsertype']) ? $_POST['newUsertype'] : '';

// Validate the data
if ($userID > 0 && !empty($newUsertype)) {
    // Prepare the SQL statement with placeholders
    $sql = "UPDATE `accounttbl` SET `Usertype` = (SELECT `usertype` from `usertypetbl` WHERE `usertypename` = :newUsertype ) WHERE `accounttbl`.`UserID` = :userID";

    try {
        // Prepare the statement
        $stmt = $pdo->prepare($sql);

        // Bind the parameters
        $stmt->bindParam(':newUsertype', $newUsertype, PDO::PARAM_STR);
        $stmt->bindParam(':userID', $userID, PDO::PARAM_INT);

        // Execute the statement
        if ($stmt->execute()) {
            // Return a success message
            echo json_encode(['success' => true, 'message' => 'User type updated successfully!']);
        } else {
            // Return an error message if the query fails
            echo json_encode(['success' => false, 'message' => 'Error updating record']);
        }
    } catch (PDOException $e) {
        // Log the error for debugging
        error_log($e->getMessage());
        // Return an error message if a PDO exception occurs
        echo json_encode(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
    }
} else {
    // Return an error message if the data is not valid
    echo json_encode(['success' => false, 'message' => 'Invalid data provided']);
}

// Close the PDO connection
$pdo = null;
?>
