<?php
require 'dblogin.php';

// Get input values
$input = $_POST['input'] ?? ''; // Default to empty string if not set
$sec = $_POST['secid'] ?? '';   // Default to empty string if not set

// Prepare the query
if (!empty($sec)) {
    // Query for Student & Section
    $stmt = $pdo->prepare("SELECT `SchoolIDStudent` FROM `sectionn&capteachertbl` WHERE `UID_Teacher` LIKE :input AND `SectionId` = :sec");
    $inputParam = "%$input%";
    $stmt->bindValue(':input', $inputParam);
    $stmt->bindValue(':sec', $sec, PDO::PARAM_INT);
} else {
    // Query for accounttbl
    $stmt = $pdo->prepare("SELECT CONCAT(`Fname`, ' ', `Mname`, ' ', `Lname`, ' ', `Suffix`) AS Fullname 
FROM `accounttbl` 
WHERE CONCAT(`Fname`, ' ', `Mname`, ' ', `Lname`, ' ', `Suffix`) LIKE CONCAT('%', :input, '%') 
AND `Usertype` = '3';
");
    $inputParam = "$input%";
    $stmt->bindValue(':input', $inputParam);
}

// Execute query
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

$predictions = [];
if ($result) {
    foreach ($result as $row) {
        $predictions[] = $row['SchoolIDStudent'] ?? $row['Fullname']; // Handle different column names
    }
}

// Return predictions as JSON
echo json_encode($predictions);

// Close connection
$pdo = null;

?>
