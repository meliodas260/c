<?php 
header('Content-Type: application/json');
require 'dblogin.php';

if (isset($_POST['Leader'])) {
    $SecID = $_POST['SecNumber'];
    $course = $_POST['course'];
    $Members = [$_POST['Member1'], $_POST['Member2'], $_POST['Member3']];
    $LEmail = $_POST['Leader'];
    $title = $_POST['Title'];
    $abstract = $_POST['Abstract'];
    $teacherNames = isset($_POST['teacherName']) ? $_POST['teacherName'] : [];  // Handle dynamic rows
    $roles = isset($_POST['role']) ? $_POST['role'] : [];  // Handle dynamic rows
    $keywords = isset($_POST['inputField']) ? $_POST['inputField'] : []; // Keywords
    $tags = isset($_POST['tags']) ? $_POST['tags'] : []; // Tags
    $errors = []; // Array to collect errors

    // Get the current date and time
    $currentDateTime = new DateTime(); 
    $Roleconnector = $currentDateTime->format("YmdHs"); 

    // Insert Keywords
    foreach ($keywords as $keyword) {
        if (!empty($keyword)) {
            // Insert keyword ID and research ID into the bridge table
            $insert_bridge_sql = "INSERT INTO `ReasearchKeyWordsTBL` (`ReasearchKeyWordsD`, `KeywordConnectorKey`, `Keyword`, `date`) 
                                  VALUES (NULL, :KeywordConnectorKey, :keyword, current_timestamp());";
            $stmt = $pdo->prepare($insert_bridge_sql);
            $stmt->execute([
                ':KeywordConnectorKey' => $Roleconnector,
                ':keyword' => $keyword
            ]);
        }
    }

    // Insert Tags
    foreach ($tags as $tag) {
        if (!empty($tag)) {
            // Check if tag exists
            $check_tag_sql = "SELECT * FROM `tagtbl` WHERE `TagName` = :tag";
            $stmt = $pdo->prepare($check_tag_sql);
            $stmt->execute([':tag' => $tag]);
            $check_tag_result = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($check_tag_result) {
                // Tag exists, get the TagId
                $tag_id = $check_tag_result['TagId'];
            } else {
                // Tag doesn't exist, insert it
                $insert_tag_sql = "INSERT INTO `tagtbl` (`TagName`, `date`) VALUES (:tag, current_timestamp())";
                $stmt = $pdo->prepare($insert_tag_sql);
                $stmt->execute([':tag' => $tag]);
                
                // Get the last inserted TagId
                $tag_id = $pdo->lastInsertId();
            }

            // Insert tag ID and research ID into the bridge table
            $insert_tag_bridge_sql = "INSERT INTO `ReasearchTagTBL` (`ResearchTagID`, `TagConnectorKey`, `TagID`, `dateCreated`) 
                                      VALUES (NULL, :TagConnectorKey, :tag_id, current_timestamp());";
            $stmt = $pdo->prepare($insert_tag_bridge_sql);
            $stmt->execute([
                ':TagConnectorKey' => $Roleconnector,
                ':tag_id' => $tag_id
            ]);
        }
    }

    // Function to insert a research role
    function insertResearchRole($pdo, $SecID, $Roleconnector, $UID, $role) {
        $sql = "INSERT INTO `researchroletbl` (`RoleConnectorKey`, `UID`, `Role`)
VALUES (
    :Roleconnector, 
    (SELECT `UserID` FROM `accounttbl` WHERE CONCAT(`Fname`, ' ', `Mname`, ' ', `Lname`, ' ', `Suffix`) LIKE CONCAT('%', :UID , '%') LIMIT 1), 
    :role
);
";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':Roleconnector' => $Roleconnector,
            ':UID' => $UID,
            ':role' => $role
        ]);
    }

    try {
        // Insert Leader, Adviser, Expert, Members, Panels
        insertResearchRole($pdo, $SecID, $Roleconnector, $LEmail, 'Leader');


        foreach ($Members as $member) {
            if (!empty($member)) {
                insertResearchRole($pdo, $SecID, $Roleconnector, $member, 'Member');
            }
        }

        // Insert dynamic rows for teachers and roles
        foreach ($teacherNames as $index => $teacherName) {
            $role = isset($roles[$index]) ? $roles[$index] : '';
            if (!empty($teacherName) && !empty($role)) {
                insertResearchRole($pdo, $SecID, $Roleconnector, $teacherName, $role);
            }
        }

        // Insert Research Info
        $sql = "INSERT INTO `ResearchTBL` (`ResearchID`, `Title`, `Abstract`, `RoleConnectorKey`, `filename`, `YRPublished`, `CourseID`, `SectionID`) 
                VALUES (default, :title, :abstract, :RoleConnectorKey, null, NULL, :course, :SecID)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':title' => $title,
            ':abstract' => $abstract,
            ':RoleConnectorKey' => $Roleconnector,
            ':course' => $course,
            ':SecID' => $SecID
        ]);

        // Return success message
        echo json_encode([
            'success' => true,
            'message' => "Hello, your form was successfully submitted."
        ]);
    } catch (PDOException $e) {
        $errors[] = "Database error: " . $e->getMessage();
        echo json_encode([
            'success' => false,
            'errors' => $errors 
        ]);
    }
}

$pdo = null;
?>
