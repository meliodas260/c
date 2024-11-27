<?php
if (isset($_GET['secID'])) {
    $secID = $_GET['secID'];

    try {
        require 'backend/dblogin.php';

        // Single query to join all three tables
        $stmt = $pdo->prepare("
            SELECT b.UserID, b.Fname, b.Mname, b.Lname, c.RoleConnectorKey, d.RoleName 
            FROM `student&sectiontbl` as a
            LEFT JOIN `accounttbl` as b ON a.UIDStudent = b.UserID
            LEFT JOIN `researchroletbl` as c ON b.UserID = c.UID
            LEFT JOIN `roletbl` as d ON c.Role = d.RoleID
            WHERE a.SectionId = :secID
        ");

        // Bind the secID parameter to the query
        $stmt->bindParam(':secID', $secID, PDO::PARAM_STR);

        // Execute the query
        $stmt->execute();

        // Fetch all the results as an associative array
        $finalResults = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Return the results as a JSON response
        echo json_encode($finalResults);

    } catch (PDOException $e) {
        // Return an error message in case of an exception
        echo json_encode(["error" => $e->getMessage()]);
    }

    // Close the database connection
    $pdo = null;

} else {
    echo json_encode(["error" => "No secID provided."]);
}
?>
