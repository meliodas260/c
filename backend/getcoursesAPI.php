<?php
require 'dblogin.php';

try {
    // Fetch all courses
    $stmt = $pdo->query("SELECT CourseID, CourseAcronym FROM coursetbl");
    $courses = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Return as JSON
    echo json_encode($courses);
} catch (PDOException $e) {
    echo json_encode(["error" => $e->getMessage()]);
}
$pdo = null;
?>
