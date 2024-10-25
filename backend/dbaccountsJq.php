<?php
header('Content-Type: application/json');
require 'dblogin.php';
try {


    // Select data from the database
    $stmt = $pdo->query("SELECT `Fname`, `Mname`, `Lname`, a.`Usertype`,b.`usertypename`, `UserID` FROM accounttbl a left JOIN usertypetbl b on a.Usertype = b.usertype ORDER BY `Fname` ASC");
    
    // Prepare data for DataTables
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Return JSON response
    echo json_encode($data);
} catch (PDOException $e) {
    echo json_encode(["error" => $e->getMessage()]);
}

$pdo = null;
?>
