<?php
require 'dblogin.php';

header('Content-Type: application/json');

try {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        parse_str(file_get_contents('php://input'), $data);

        if (!isset($data['ExpertTypeInput']) || empty(trim($data['ExpertTypeInput'])) ||
            !isset($data['Usertype']) || empty(trim($data['Usertype']))) {
            echo json_encode(['success' => false, 'message' => 'All fields are required.']);
            exit;
        }

        $expertType = trim($data['ExpertTypeInput']);
        $userType = trim($data['Usertype']);

        $stmt = $pdo->prepare("INSERT INTO roletbl (RoleName, Usertype, DateCreated) VALUES (:roleName, :userType, NOW())");
        $stmt->execute([
            ':roleName' => $expertType,
            ':userType' => $userType,
        ]);

        echo json_encode(['success' => true, 'message' => 'ExpertType created successfully.']);
    } elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
        $stmt = $pdo->query("SELECT RoleID, RoleName,b.usertypename as Usertype, DateCreated FROM roletbl as a left join usertypetbl as b on a.Usertype = b.usertype;");
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
