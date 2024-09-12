<?php
require 'dblogin.php';

// Get input values
$input = $_POST['input'] ?? ''; // Default to empty string if not set
$sec = $_POST['secid'] ?? '';   // Default to empty string if not set

// Prepare the query
if (!empty($sec)) {
    // Query for Student & Section
    $stmt = $pdo->prepare("SELECT `SchoolIDStudent` FROM `Student&SectionTBL` WHERE `UIDstudent` LIKE :input AND `SectionId` = :sec");
    $inputParam = "%$input%";
    $stmt->bindValue(':input', $inputParam);
    $stmt->bindValue(':sec', $sec, PDO::PARAM_INT);
} else {
    // Query for AccountTBL
    $stmt = $pdo->prepare("SELECT `UserID` FROM `accounttbl` WHERE `UserID` LIKE :input AND `Usertype` = '3'");
    $inputParam = "$input%";
    $stmt->bindValue(':input', $inputParam);
}

// Execute query
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

$predictions = [];
if ($result) {
    foreach ($result as $row) {
        $predictions[] = $row['SchoolIDStudent'] ?? $row['UserID']; // Handle different column names
    }
}

// Return predictions as JSON
echo json_encode($predictions);

// Close connection
$pdo = null;

?>
