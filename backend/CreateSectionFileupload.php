<?php
header('Content-Type: application/json');
require 'dblogin.php'; // Ensure you include your database login script

$errors = []; // Initialize an empty errors array

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['excel_file'])) {
    // Check for file upload errors
    if ($_FILES['excel_file']['error'] !== UPLOAD_ERR_OK) {
        echo json_encode(["error" => "File upload error: " . $_FILES['excel_file']['error']]);
        exit;
    }

    // Get the temporary file path
    $tmpFilePath = $_FILES['excel_file']['tmp_name'];

    // Ensure the file is an Excel file
    $allowedExtensions = ['xls', 'xlsx'];
    $fileExtension = pathinfo($_FILES['excel_file']['name'], PATHINFO_EXTENSION);

    if (!in_array(strtolower($fileExtension), $allowedExtensions)) {
        echo json_encode(["error" => "Invalid file type. Only .xls and .xlsx are allowed."]);
        exit;
    }

    // Generate a random name for the file
    $randomFileName = uniqid('uploaded_', true) . '.' . $fileExtension;
    $newFilePath = '../uploads/' . $randomFileName;

    // Move the uploaded file to the existing uploads directory
    if (!move_uploaded_file($tmpFilePath, $newFilePath)) {
        echo json_encode(["error" => "Failed to move uploaded file."]);
        exit;
    }

    // Prepare and execute the Python command
    $command = escapeshellcmd("python ../backend/CreateSections.py " . escapeshellarg($newFilePath) . " 2>&1");
    $output = shell_exec($command);

    // Log output for debugging
    error_log("Command: " . $command);
    error_log("Output: " . $output);

    // Decode the output from Python (JSON)
    $data = json_decode($output, true);

    // Check if the data is valid JSON and contains the required information
    if (isset($data['metadata']) && isset($data['students'])) {
        $metadata = $data['metadata'];
        $students = $data['students'];

        $Course = $metadata['Course'];
        $SectionName = $metadata['Section Name'];
        $TeacherName = $metadata["Teacher's Name"];
        // Get the teacher's user ID from the name (assuming full name match)
        $stmtTeacher = $pdo->prepare("SELECT `UserID` FROM `accounttbl` WHERE CONCAT(' ',`Fname`, ' ', `Mname`, ' ', `Lname`, ' ', `Suffix`, ' ') LIKE concat('%',:teacherName ,'%') LIMIT 1");
        $stmtTeacher->execute([':teacherName' => $TeacherName]);
        $teacher = $stmtTeacher->fetch(PDO::FETCH_ASSOC);

        if ($teacher) {
            $TeacherID = $teacher['UserID'];
            // Create section entry and get the new SectionID
            $stmtSection = $pdo->prepare("INSERT INTO `sectionn&capteachertbl` (`SectionName`, `CourseID`, `UID_Teacher`, `DateCreacted`) 
                                          VALUES (:sectionName, (SELECT `CourseID` FROM `coursetbl` WHERE `CourseAcronym` = :course), :teacherID, DEFAULT)");
            $stmtSection->execute([
                ':sectionName' => $SectionName,
                ':course' => $Course,
                ':teacherID' => $TeacherID
            ]);
            
            // Get the last inserted SectionID
            $secID = $pdo->lastInsertId();

            // Insert students into student&sectiontbl
            $stmtStudent = $pdo->prepare("INSERT INTO `student&sectiontbl` (`StudentNSectionID`, `UIDStudent`, `SectionId`, `date`) 
                                         VALUES (DEFAULT, :studentID, :secID, DEFAULT)");

            foreach ($students as $studentFullName) {
                // Find student ID by full name
                $stmtStudentID = $pdo->prepare("SELECT `UserID` FROM `accounttbl` WHERE CONCAT(`Fname`, ' ', `Mname`, ' ', `Lname`, ' ', `Suffix`) LIKE concat('%',:studentFullName,'%') LIMIT 1");
                $stmtStudentID->execute([':studentFullName' => $studentFullName]);
                $student = $stmtStudentID->fetch(PDO::FETCH_ASSOC);

                if ($student) {
                    $stmtStudent->execute([
                        ':studentID' => $student['UserID'],
                        ':secID' => $secID
                    ]);
                } else {
                    // If the student doesn't exist in the system, you can handle that here (e.g., skip, log, or insert)
                    $errors[] = "Student '$studentFullName' not found in the system.";
                }
            }

            // If no errors, return success response
            if (empty($errors)) {
                echo json_encode([
                    'success' => true,
                    'message' => 'Section and students created successfully.'
                ]);
            } else {
                echo json_encode([
                    'success' => false,
                    'message' => $errors
                ]);
            }

        } else {
            echo json_encode([
                'success' => false,
                'message' => "Teacher '$TeacherName' not found in the system."
            ]);
        }
    } else {
        // Handle missing or malformed data5
        echo json_encode([
            'success' => false,
            'message' => 'Invalid data received from the Python script.'
        ]);
    }

    // Optional: Uncomment the line below to delete the file after processing
    // unlink($newFilePath);
} else {
    echo json_encode(["error" => "No file uploaded or invalid request method."]);
}
?>
