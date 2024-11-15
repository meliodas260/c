<?php
// backend/backo.php

// Assuming you're using a simple POST method to handle form data
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    // Check if the dropped data (student IDs) is set and is an array
    if (isset($_POST['droppedStudents']) && !empty($_POST['droppedStudents'])) {
        // Decode the dropped student data
        $droppedStudents = json_decode($_POST['droppedStudents'], true);

        // Ensure it's an array and contains data
        if (is_array($droppedStudents) && count($droppedStudents) > 0) {
            // Example: Process the dropped student IDs (you can save to a database, or perform some other action)
            // Here we are simply logging the dropped students to a file for demonstration
            $logFile = 'dropped_students_log.txt';

            // Loop through the dropped students and log their UserID
            foreach ($droppedStudents as $studentID) {
                // Log each student ID to the file
                file_put_contents($logFile, "Student with UserID: $studentID dropped\n", FILE_APPEND);
            }

            // Respond with success message
            echo json_encode([
                'status' => 'success',
                'message' => 'Students successfully processed.',
                'droppedStudents' => $droppedStudents
            ]);
        } else {
            // Invalid or empty data
            echo json_encode([
                'status' => 'error',
                'message' => 'No valid students dropped or invalid data format.'
            ]);
        }
    } else {
        // Missing dropped data
        echo json_encode([
            'status' => 'error',
            'message' => 'Dropped data not received.'
        ]);
    }
} else {
    // Invalid request method
    echo json_encode([
        'status' => 'error',
        'message' => 'Invalid request method.'
    ]);
}
?>
