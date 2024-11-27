<?php
header('Content-Type: application/json');
require 'dblogin.php';
// Check if the query parameter is set and not empty
if (isset($_GET['query']) && !empty($_GET['query'])) {
    $query = $_GET['query'];

    try {
        // Prepare and execute the query to fetch matching tags from the database
        $stmt = $pdo->prepare("SELECT TagName FROM tagtbl WHERE TagName LIKE :query LIMIT 5");
        $stmt->bindValue(':query', '%' . $query . '%', PDO::PARAM_STR);
        $stmt->execute();

        // Fetch the results
        $predictions = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Return the result as JSON
        header('Content-Type: application/json');
        echo json_encode($predictions); // Ensure valid JSON format
    } catch (PDOException $e) {
        // Handle any errors that occur during the query
        echo json_encode(['error' => 'Database error: ' . $e->getMessage()]);
    }
} else {
    // If no query is provided, return an empty array
    echo json_encode([]);
}

?>
