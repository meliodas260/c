<?php 
header('Content-Type: application/json');
require 'dblogin.php';

if (isset($_POST['Leader'])) {
    $SecID = $_POST['SecNumber'];
    $course = $_POST['course'];
    $Members = [ $_POST['Member1'], $_POST['Member2'], $_POST['Member3'] ];
    $panels = [ $_POST['Panel1'], $_POST['Panel2'], $_POST['Panel3'] ];
    $LEmail = $_POST['Leader'];
    $Advicer = $_POST['Advicer'];
    $Expert = $_POST['Expert'];
    $title = $_POST['Title'];
    $abstract = $_POST['Abstract'];
    $errors = []; // Array to collect errors

    // Get the current date and time
    $currentDateTime = new DateTime(); 
    $Roleconnector = $currentDateTime->format("YmdHs"); 

    foreach ($_POST['inputField'] as $key => $keyword) {
        if (!empty($keyword)) {
        // Insert keyword ID and research ID into the bridge table
        $insert_bridge_sql = "INSERT INTO `ReasearchKeyWordsTBL` (`ReasearchKeyWordsD`, `KeywordConnectorKey`, `Keyword`, `date`) VALUES (NULL, :KeywordConnectorKey, :keyword, current_timestamp());";
        $stmt = $pdo->prepare($insert_bridge_sql);
        $stmt->execute([
            ':KeywordConnectorKey' => $Roleconnector,
            ':keyword' => $keyword
        ]);
    }
    }

    // // Insert tags

    foreach ($_POST['tags'] as $key => $tag) {
            if (!empty($tag)) {
            // Check if tag exists
        // Check if the tag already exists
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
            $insert_tag_bridge_sql = "INSERT INTO `ReasearchTagTBL` (`ResearchTagID`, `TagConnectorKey`, `TagID`, `dateCreated`) VALUES (NULL, :TagConnectorKey, :tag_id, current_timestamp());";
            $stmt = $pdo->prepare($insert_tag_bridge_sql);
            $stmt->execute([
                ':TagConnectorKey' => $Roleconnector,
                ':tag_id' => $tag_id
            ]);
        }
    }

    // Function to insert a research role
    function insertResearchRole($pdo,$SecID, $Roleconnector, $UID, $role) {
        $sql = "INSERT INTO `researchroletbl` (`RoleConnectorKey`,`UID`, `Role`) VALUES (:Roleconnector, :UID, :role)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':Roleconnector' => $Roleconnector,
            ':UID' => $UID,
            ':role' => $role
        ]);
    }

    try {
        // Insert Leader
        insertResearchRole($pdo,$SecID, $Roleconnector, $LEmail, 'Leader');

        // Insert Adviser
        insertResearchRole($pdo,$SecID, $Roleconnector, $Advicer, 'Adviser');

        // Insert Expert
        insertResearchRole($pdo,$SecID, $Roleconnector, $Expert, 'Expert');

        // Insert Members
        foreach ($Members as $member) {
            if (!empty($member)) {
                insertResearchRole($pdo,$SecID, $Roleconnector, $member, 'Member');
            }
        }

        // Insert Panels
        foreach ($panels as $key => $panel) {
            if (!empty($panel)) {
                $panelRole = 'Panel' . ($key + 1); // Create panel role like 'Panel1', 'Panel2', 'Panel3'
                insertResearchRole($pdo,$SecID, $Roleconnector, $panel, $panelRole);
            }
        }
        
    
    $sql = "INSERT INTO `ResearchTBL` ( `ResearchID`, `Title`, `Abstract`,`RoleConnectorKey`,`filename`, `YRPublished`, `CourseID`, `SectionID`) VALUES (default, :title, :abstract, :RoleConnectorKey ,null, NULL, :course,:SecID)";
    $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':title' => $title,
            ':abstract' => $abstract,
            ':RoleConnectorKey' => $Roleconnector,
            ':course' => $course,
            ':SecID' => $SecID
        ]);
        if (empty($errors)) {
            echo json_encode([
                'success' => true,
                'message' => "Hello, your form was successfully submitted."
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'errors' => $errors
            ]);
        }
    } catch (PDOException $e) {
        $errors[] = "Database error: " . $e->getMessage();
    }
} else {

}

$pdo = null;

?>
