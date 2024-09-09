<?php
if (isset($_GET['secID'])) {
    $secID = $_GET['secID'];

    try {
        $host = 'localhost';
        $username = 'mine';
        $password = 'pass';
        $database = 'repo';
        $dsn = "mysql:host=$host;dbname=$database;charset=utf8mb4";

        $pdo = new PDO($dsn, $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Prepare the SQL query with a placeholder to prevent SQL injection
        $stmt = $pdo->prepare("
            SELECT b.UserID, b.Fname, b.Mname, b.Lname, b.suffix
            FROM `Student&SectionTBL` a
            INNER JOIN `AccountTBL` b ON a.schoolIDStudent = b.SchoolId
            WHERE `SectionId` = :secID
        ");

        // Bind the secID parameter to the query
        $stmt->bindParam(':secID', $secID, PDO::PARAM_STR);

        // Execute the query
        $stmt->execute();

        // Fetch all results as an associative array
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Return the results as a JSON response
        echo json_encode($data);

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
