<?php
require 'dblogin.php'; // Include your database connection file

header('Content-Type: application/json');

try {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Handle creating a new role
        $data = json_decode(file_get_contents('php://input'), true);
        
        if (!isset($data['roleName']) || empty(trim($data['roleName']))) {
            echo json_encode(['success' => false, 'message' => 'Role name is required.']);
            exit;
        }

        $roleName = trim($data['roleName']);

        // Insert the new role
        $stmt = $pdo->prepare("INSERT INTO roletbl (RoleName, DateCreated) VALUES (:roleName, current_timestamp())");
        $stmt->execute([':roleName' => $roleName]);

        echo json_encode(['success' => true, 'message' => 'Role created successfully.']);
    } elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
        // Handle fetching all roles
        $stmt = $pdo->query("SELECT RoleID, RoleName, DateCreated FROM roletbl");
        $roles = $stmt->fetchAll(PDO::FETCH_ASSOC);

        echo json_encode(['success' => true, 'data' => $roles]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
    }
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'Database error: ' . $e->getMessage()]);
}

$pdo = null;
?>
