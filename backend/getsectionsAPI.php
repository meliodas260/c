<?php
require 'dblogin.php';

try {
    // Validate and retrieve CourseID
    if (!isset($_GET['CourseID'])) {
        throw new Exception("CourseID parameter is required.");
    }

    $courseID = filter_input(INPUT_GET, 'CourseID', FILTER_VALIDATE_INT);
    if (!$courseID) {
        throw new Exception("Invalid CourseID parameter.");
    }

    // Fetch sections for the given CourseID
    $stmt = $pdo->prepare("SELECT a.SectionID,CONCAT(a.SectionName, '-',YEAR(a.DateCreacted)) as SectionName, CONCAT(`Fname`, ' ', `Mname`, ' ', `Lname`, ' ', `Suffix`) AS Fullname FROM `sectionn&capteachertbl` AS a LEFT JOIN `accounttbl` AS b ON a.UID_Teacher = b.UserID
                           WHERE a.CourseID = :courseID");
    $stmt->bindParam(':courseID', $courseID, PDO::PARAM_INT);
    $stmt->execute();

    $sections = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Return as JSON
    echo json_encode($sections);
} catch (PDOException $e) {
    echo json_encode(["error" => $e->getMessage()]);
}
$pdo = null;
?>
