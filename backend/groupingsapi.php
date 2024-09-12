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
    $errors = []; // Array to collect errors

    // Get the current date and time
    $currentDateTime = new DateTime(); 
    $Roleconnector = $currentDateTime->format("YmdHis"); 

    // Function to insert a research role
    function insertResearchRole($pdo,$SecID, $Roleconnector, $UID, $role) {
        $sql = "INSERT INTO `ResearchRoleTBL` (`RoleConnectorKey`, `SectionID`,`UID`, `Role`) VALUES (:Roleconnector,:SecID, :UID, :role)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':Roleconnector' => $Roleconnector,
            ':SecID' => $SecID,
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

        echo json_encode(['success' => true, 'message' => 'Data inserted successfully']);
        
    } catch (PDOException $e) {
        $errors[] = "Database error: " . $e->getMessage();
    }

} else {
    // Handle other scenarios
    // Example: Querying ResearchTBL
    // $sql = "INSERT INTO `ResearchTBL` ( `ResearchID`, `Title`, `Abstract`, `filename`, `fileSize`, `YRPublished`, `CourseID`, `Status`, `TeacherComment`, `Section`) VALUES (default, NULL, NULL, NULL, NULL, NULL, '$course', NULL, NULL, '$SecID')";
    // if ($pdo->query($sql) !== TRUE) {
    //     $errors[] = "Error: " . $sql . "<br>" . $pdo->error;
    // }
}

// Handle errors
if (!empty($errors)) {
    echo json_encode(['success' => false, 'errors' => $errors]);
}

// Close PDO connection
$pdo = null;

?>
