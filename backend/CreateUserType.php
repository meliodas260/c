<?php
require 'dblogin.php';
// Initialize response array
$response = ['success' => false, 'error' => ''];

try {
    // Check if the necessary POST data is available
    if (isset($_POST['USERTYPENAME']) && isset($_POST['Access'])) {
        // Sanitize and retrieve input
        $usertypeName = htmlspecialchars(trim($_POST['USERTYPENAME']));
        $access = (int) $_POST['Access'];

        // Validate inputs
        if (empty($usertypeName)) {
            throw new Exception('User Type Name cannot be empty');
        }
        if (!in_array($access, [1, 2, 3])) {
            throw new Exception('Invalid Access Type');
        }

        // Prepare the SQL query to insert the data
        $sql = "INSERT INTO usertypetbl (usertypename, UserStatus) VALUES (:usertypeName, :access)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':usertypeName', $usertypeName);
        $stmt->bindParam(':access', $access);

        // Execute the query
        if ($stmt->execute()) {
            // If successful, set response success to true
            $response['success'] = true;
        } else {
            throw new Exception('Failed to insert UserType');
        }
    } else {
        throw new Exception('Missing required fields');
    }
} catch (Exception $e) {
    // Catch any errors and set the error message in the response
    $response['error'] = $e->getMessage();
}

// Return JSON response
header('Content-Type: application/json');
echo json_encode($response);

?>
