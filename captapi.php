<?php
header('Content-Type: application/json'); // Set content type to JSON

$host = 'localhost';
$username = 'mine';
$password = 'pass';
$database = 'repo';
$dsn = "mysql:host=$host;dbname=$database;charset=utf8mb4";

try {
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $emails = $_COOKIE['Email'];
    
    // Sanitize $emails to prevent SQL injection (ensure you trust the source of the cookie)
    $emails = htmlspecialchars($emails, ENT_QUOTES, 'UTF-8');

    // Query the database
    $query = "SELECT a.`SectionName`, a.`SectionID`, a.`SchoolYR`, a.`CourseID`
              FROM `sectionn&capteachertbl` as a
              WHERE `UID_Teacher` = :email
              ORDER BY a.`DateCreacted` DESC";
    
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':email', $emails, PDO::PARAM_STR);
    $stmt->execute();

    // Initialize an empty array to hold the results
    $sections = array();

    // Fetch data and populate the array
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $sections[] = $row;
    }

    // Output the results as JSON
    echo json_encode($sections);

} catch (PDOException $e) {
    // Handle any database connection errors
    echo json_encode(['error' => $e->getMessage()]);
}
?>
