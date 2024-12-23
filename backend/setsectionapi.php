<?php

header('Content-Type: application/json');
require 'dblogin.php';

$errors = []; // Initialize an empty errors array

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST['StudentIDField']) && !empty($_POST['StudentIDField']) && isset($_POST['ResearchT']) && isset($_POST['Course']) && isset($_POST['SectionName'])) {
        $TeacherEmail = $_POST['ResearchT'];
        $SectionName = $_POST['SectionName'];
        $Course = $_POST['Course'];
        $secID = null;

        try {
            // Get the max section ID
            $stmt = $pdo->query("SELECT MAX(`SectionID`) as max_id FROM `sectionn&capteachertbl`;");
            $max = $stmt->fetch(PDO::FETCH_ASSOC);
            $secID = $max['max_id'] + 1;

            // Use prepared statements for the section insertion
            $sqlSection = "INSERT INTO `sectionn&capteachertbl` (`SectionID`, `SectionName`, `CourseID`, `UID_Teacher`, `DateCreacted`) VALUES (:secID, :sectionName, :course, (SELECT `UserID` FROM `accounttbl` WHERE CONCAT(`Fname`, ' ', `Mname`, ' ', `Lname`, ' ', `Suffix`) LIKE :teacherEmail LIMIT 1), DEFAULT);";
            $stmtSection = $pdo->prepare($sqlSection);
            $stmtSection->execute([
                ':secID' => $secID,
                ':sectionName' => $SectionName,
                ':course' => $Course,
                ':teacherEmail' => $TeacherEmail
            ]);

            // Insert students into sectionn&capteachertbl
            $sqlStudent = "INSERT INTO `student&sectiontbl` (`StudentNSectionID`, `UIDStudent`, `SectionId`, `date`) 
                           VALUES (default, :studentID, :secID, DEFAULT)";
            $stmtStudent = $pdo->prepare($sqlStudent);

            foreach ($_POST['StudentIDField'] as $studentID) {
                $stmtStudent->execute([
                    ':studentID' => $studentID,
                    ':secID' => $secID
                ]);
            }

            // Return success response
            echo json_encode([
                'success' => true,
                'message' => "Section created successfully."
            ]);

        } catch (PDOException $e) {
            // Handle any PDO-related errors
            $errors[] = "Database error: " . $e->getMessage();
        }

    } else {
        // Handle missing POST fields
        $errors[] = "Required fields are missing.";
    }

}

if ($_SERVER["REQUEST_METHOD"] == "GET") {

    // Fetch the course data from the database
    try {
        $sql = "SELECT CourseID, CourseAcronym FROM coursetbl;";
        $stmt = $pdo->query($sql);
    
        $allcourse = ['CourseTypes' => [], 'CourseValues' => []];
    
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $allcourse['CourseTypes'][] = $row['CourseAcronym'];
            $allcourse['CourseValues'][] = $row['CourseID'];
        }
    
        echo json_encode($allcourse); // Make sure this outputs the correct structure
    
    } catch (PDOException $e) {
        echo json_encode([
            'success' => false,
            'message' => 'Error fetching course data: ' . $e->getMessage()
        ]);
    }
    
}

// Close the PDO connection
$pdo = null;

// If there are any errors, output them
if (!empty($errors)) {
    echo json_encode([
        'success' => false,
        'message' => $errors
    ]);
}

?>
