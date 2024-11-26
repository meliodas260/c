<?php 
header('Content-Type: application/json');
require 'dblogin.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $response = ['success' => false, 'message' => '', 'errors' => []];

    // Collect and sanitize inputs
    $SecID = $_POST['SecNumber'] ?? null;
    $course = $_POST['course'] ?? null;
    $title = $_POST['Title'] ?? null;
    $abstract = $_POST['Abstract'] ?? null;
    $LEmail = $_POST['leader'] ?? null;
    $LeaderRole = $_POST['Leader'] ?? 'Leader'; // Default role as 'Leader'
    $members = $_POST['members'] ?? []; // Members array
    $MemberRole = $_POST['MemberRole'] ?? 'Member'; // Default role as 'Member'
    $teacherNames = $_POST['teacherName'] ?? []; // Dynamic teacher names
    $roles = $_POST['role'] ?? []; // Roles for teachers
    $keywords = $_POST['inputField'] ?? []; // Keywords
    $tags = $_POST['tags'] ?? []; // Tags

    // Validate required fields
    if (!$SecID || !$course || !$title || !$abstract || !$LEmail) {
        $response['errors'][] = 'Required fields are missing.';
        echo json_encode($response);
        exit;
    }

    $currentDateTime = new DateTime();
    $Roleconnector = $currentDateTime->format("YmdHis");

    try {
        $pdo->beginTransaction();

        // Insert Keywords
        foreach ($keywords as $keyword) {
            if (!empty($keyword)) {
                $insert_keyword_sql = "INSERT INTO `ReasearchKeyWordsTBL` 
                                       (`ReasearchKeyWordsD`, `RoleConnectorKey`, `Keyword`, `date`) 
                                       VALUES (NULL, :RoleConnectorKey, :keyword, current_timestamp());";
                $stmt = $pdo->prepare($insert_keyword_sql);
                $stmt->execute([
                    ':RoleConnectorKey' => $Roleconnector,
                    ':keyword' => $keyword
                ]);
            }
        }

        // Insert Tags
        foreach ($tags as $tag) {
            if (!empty($tag)) {
                $check_tag_sql = "SELECT * FROM `tagtbl` WHERE `TagName` = :tag";
                $stmt = $pdo->prepare($check_tag_sql);
                $stmt->execute([':tag' => $tag]);
                $check_tag_result = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($check_tag_result) {
                    $tag_id = $check_tag_result['TagId'];
                } else {
                    $insert_tag_sql = "INSERT INTO `tagtbl` (`TagName`, `date`) VALUES (:tag, current_timestamp())";
                    $stmt = $pdo->prepare($insert_tag_sql);
                    $stmt->execute([':tag' => $tag]);
                    $tag_id = $pdo->lastInsertId();
                }

                $insert_tag_bridge_sql = "INSERT INTO `ReasearchTagTBL` 
                                          (`ResearchTagID`, `RoleConnectorKey`, `TagID`, `dateCreated`) 
                                          VALUES (NULL, :RoleConnectorKey, :tag_id, current_timestamp());";
                $stmt = $pdo->prepare($insert_tag_bridge_sql);
                $stmt->execute([
                    ':RoleConnectorKey' => $Roleconnector,
                    ':tag_id' => $tag_id
                ]);
            }
        }

        // Function to insert research roles
        function insertResearchRole($pdo, $Roleconnector, $UID, $role) {
            $sql = "INSERT INTO `researchroletbl` 
                    (`RoleConnectorKey`, `UID`, `Role`) 
                    VALUES (
                        :Roleconnector, 
                        (SELECT `UserID` FROM `accounttbl` 
                         WHERE CONCAT(`Fname`, ' ', `Mname`, ' ', `Lname`, ' ', `Suffix`) 
                         LIKE CONCAT('%', :UID , '%') LIMIT 1), 
                        :role
                    );";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                ':Roleconnector' => $Roleconnector,
                ':UID' => $UID,
                ':role' => $role
            ]);
        }

        // Insert Leader
        insertResearchRole($pdo, $Roleconnector, $LEmail, $LeaderRole);

        // Insert Members
        foreach ($members as $member) {
            if (!empty($member)) {
                insertResearchRole($pdo, $Roleconnector, $member, $MemberRole);
            }
        }

        // Insert dynamic teacher roles
        foreach ($teacherNames as $index => $teacherName) {
            $role = $roles[$index] ?? '';
            if (!empty($teacherName) && !empty($role)) {
                insertResearchRole($pdo, $Roleconnector, $teacherName, $role);
            }
        }

        // Insert Research Info
        $insert_research_sql = "INSERT INTO `ResearchTBL` 
                                (`ResearchID`, `Title`, `Abstract`, `RoleConnectorKey`, `filename`, `YRPublished`, `CourseID`, `SectionID`) 
                                VALUES (default, :title, :abstract, :RoleConnectorKey, null, NULL, :course, :SecID)";
        $stmt = $pdo->prepare($insert_research_sql);
        $stmt->execute([
            ':title' => $title,
            ':abstract' => $abstract,
            ':RoleConnectorKey' => $Roleconnector,
            ':course' => $course,
            ':SecID' => $SecID
        ]);

        $pdo->commit();

        $response['success'] = true;
        $response['message'] = 'Submission successful.';
    } catch (PDOException $e) {
        $pdo->rollBack();
        $response['esssrrors'][] = "Database essrror: " . $e->getMessage();
    }

    echo json_encode($response);
}
$pdo = null;
?>
