<?php
require 'dblogin.php';
try {


    // Select data from the database
    $stmt = $pdo->query("SELECT a.SectionID, a.SectionName , CONCAT(`Fname`, ' ', `Mname`, ' ', `Lname`, ' ', `Suffix`) as FUllname FROM `sectionn&capteachertbl` as a left join `accounttbl` as b on a.UID_Teacher = b.UserID;");
    
    // Prepare data for DataTables
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Return JSON response
    echo json_encode($data);
} catch (PDOException $e) {
    echo json_encode(["error" => $e->getMessage()]);
}

$pdo = null;
?>