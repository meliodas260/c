<?php

// Database connection
$conn = new mysqli("localhost", "mine", "pass", "repo");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get input values
$input = $_POST['input'] ?? ''; // Default to empty string if not set
$sec = $_POST['secid'] ?? '';   // Default to empty string if not set

// Determine which query to run based on the presence of `secid`
if (!empty($sec)) {
    // Query for Student & Section
    $stmt = $conn->prepare("SELECT `SchoolIDStudent` FROM `Student&SectionTBL` WHERE `UIDstudent` LIKE ? AND `SectionId` = ?");
    $inputParam = "%$input%";
    $stmt->bind_param("si", $inputParam, $sec);
} else {
    // Query for AccountTBL
    $stmt = $conn->prepare("SELECT `UserID` FROM `accounttbl` WHERE `UserID` LIKE ? AND `Usertype` = '3'");
    $inputParam = "$input%";
    $stmt->bind_param("s", $inputParam);
}

// Execute query
$stmt->execute();
$result = $stmt->get_result();

$predictions = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $predictions[] = $row['SchoolIDStudent'] ?? $row['UserID']; // Handle different column names
    }
}

// Return predictions as JSON
echo json_encode($predictions);

// Close statement and connection
$stmt->close();
$conn->close();

?>
