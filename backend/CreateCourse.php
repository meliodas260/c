<?php
require 'dblogin.php'; // Include your database connection file

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Collect input data
    $course = $_POST['Course'] ?? '';
    $acronym = $_POST['Acronym'] ?? '';
    $description = $_POST['desc'] ?? '';

    // Check if any fields are empty
    if (empty($course) || empty($acronym) || empty($description)) {
        echo json_encode([
            'success' => false,
            'message' => 'All fields are required!'
        ]);
        exit;
    }

    try {
        // Insert data into the database
        $stmt = $pdo->prepare("INSERT INTO coursetbl (CourseName, CourseAcronym, Description) VALUES (:course, :acronym, :description)");
        $stmt->bindParam(':course', $course);
        $stmt->bindParam(':acronym', $acronym);
        $stmt->bindParam(':description', $description);
        $stmt->execute();

        echo json_encode([
            'success' => true,
            'message' => 'Course successfully created!'
        ]);
    } catch (PDOException $e) {
        echo json_encode([
            'success' => false,
            'message' => 'Database error: ' . $e->getMessage()
        ]);
    }
} else {
    echo json_encode([
        'success' => false,
        'message' => 'Invalid request method.'
    ]);
}
?>
