<?php
require 'dblogin.php';

// Get input values
$input = trim($_POST['input'] ?? ''); // Trim whitespace from input
$sec = $_POST['secid'] ?? '';   // Default to empty string if not set

// Prepare the query
if (!empty($sec)) {
    // Query for Student & Section
    $stmt = $pdo->prepare(" SELECT CONCAT(`Fname`, ' ', `Mname`, ' ', `Lname`, ' ', `Suffix`) AS UserID FROM `student&sectiontbl` as a left join `accounttbl` as b on a.UIDStudent = b.UserID 
    WHERE CONCAT(`Fname`, ' ', `Mname`, ' ', `Lname`, ' ', `Suffix`) LIKE :input AND `SectionId` = :sec");
    $inputParam = "%$input%";
    $stmt->bindValue(':input', $inputParam);
    $stmt->bindValue(':sec', $sec, PDO::PARAM_INT);
} else {
    // Check if input is empty to fetch all names
    if ($input === '') {
        // Query for all names when input is empty, including imageName
        $stmt = $pdo->prepare("SELECT `UserID`, CONCAT(`Fname`, ' ', `Mname`, ' ', `Lname`, ' ', `Suffix`) AS Fullname, `imageName` 
FROM `accounttbl` 
WHERE `Usertype` = '3';");
    } else {
        // Query based on input, including imageName
        $stmt = $pdo->prepare("SELECT `UserID`, CONCAT(`Fname`, ' ', `Mname`, ' ', `Lname`, ' ', `Suffix`) AS Fullname, `imageName` 
FROM `accounttbl` 
WHERE CONCAT(`Fname`, ' ', `Mname`, ' ', `Lname`, ' ', `Suffix`) LIKE CONCAT('%', :input, '%') 
AND `Usertype` = '3';");
        $inputParam = "$input%";
        $stmt->bindValue(':input', $inputParam);
    }
}

// Execute query
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

$predictions = [];
if ($result) {
    foreach ($result as $row) {
        $predictions[] = [
            'Fullname' => $row['Fullname'] ?? null,
            'UserID' => $row['UserID'] ?? $row['SchoolIDStudent'],
            'imageName' => $row['imageName'] ?? null
        ];
    }
}

// Return predictions as JSON
echo json_encode($predictions);

// Close connection
$pdo = null;
?>
