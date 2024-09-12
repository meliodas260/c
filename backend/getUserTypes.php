<?php
header('Content-Type: application/json');
require 'dblogin.php';
$pdo = new mysqli("localhost", "mine", "pass", "repo");

// Check connection
if ($pdo->connect_error) {
    echo json_encode(['error' => 'Database connection failed']);
    exit;
}

// SQL query to fetch data
$sql = "SELECT usertypetbl.`usertypename`, `usertype` FROM `usertypetbl`;";
$result = $pdo->query($sql);

$response = ['userTypes' => [], 'userValues' => []];

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $response['userTypes'][] = $row['usertypename'];
        $response['userValues'][] = $row['usertype'];
    }
} else {
    $response['error'] = 'No user types found';
}

echo json_encode($response);

$pdo->close();
?>
