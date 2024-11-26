<?php
require 'dblogin.php';

header('Content-Type: application/json');
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Get search parameters from POST request
$title = isset($_POST['Title']) ? $_POST['Title'] : '';
$tag = isset($_POST['Tag']) ? $_POST['Tag'] : '';
$course = isset($_POST['Course']) ? $_POST['Course'] : '';
$keyword = isset($_POST['Keyword']) ? $_POST['Keyword'] : '';

try {
    $data = [];
    $query = "SELECT * FROM `researchtbl` WHERE 1=1";
    $params = [];

    if ($title) {
        $query .= " AND `Title` LIKE :title";
        $params['title'] = "%$title%";
    }
    if ($tag) {
        $query .= " AND `RoleConnectorKey` IN (SELECT RoleConnectorKey FROM `reasearchtagtbl` WHERE TagID IN (SELECT TagId FROM `tagtbl` WHERE TagName LIKE :tag))";
        $params['tag'] = "%$tag%";
    }
    if ($course) { 
        $query .= "  AND `CourseID` IN (SELECT CourseID FROM `coursetbl` WHERE CourseAcronym LIKE :course)";
        $params['course'] = "%$course%";
    }
    if ($keyword) {
        $query .= " AND `RoleConnectorKey` IN (SELECT RoleConnectorKey FROM `reasearchkeywordstbl` WHERE Keyword LIKE :keyword)";
        $params['keyword'] = "%$keyword%";
    }

    $ResearchSql = $pdo->prepare($query);
    $ResearchSql->execute($params);

    while ($row = $ResearchSql->fetch(PDO::FETCH_ASSOC)) {
        $connector = $row['RoleConnectorKey'];

        try {
            // Fetch researchers related to the research
            $ResearcherSql = $pdo->prepare("SELECT b.Fname, b.Mname, b.Lname, b.suffix, a.role FROM researchroletbl a 
                                             LEFT JOIN accounttbl b ON b.UserID = a.UID 
                                             WHERE a.RoleConnectorKey = :connector");
            $ResearcherSql->execute(['connector' => $connector]);

            // Fetch tags related to the research
            $tags = $pdo->prepare("SELECT b.TagName FROM `reasearchtagtbl` a 
                                    LEFT JOIN tagtbl b ON a.TagID = b.TagId 
                                    WHERE a.RoleConnectorKey = :connector");
            $tags->execute(['connector' => $connector]);

            // Fetch keywords related to the research
            $keyws = $pdo->prepare("SELECT Keyword FROM `reasearchkeywordstbl` 
                                    WHERE `RoleConnectorKey` = :connector");
            $keyws->execute(['connector' => $connector]);

            // Separate researchers and panels based on role
            $researchers = [];
            $panels = [];
            while ($rowlower = $ResearcherSql->fetch(PDO::FETCH_ASSOC)) {
                $fullName = trim($rowlower['Fname'] . ' ' . $rowlower['Mname'] . ' ' . $rowlower['Lname'] . ' ' . $rowlower['suffix']);
                $role = $rowlower['role'];

                if (in_array($role, ['Leader', 'Member'])) {
                    $researchers[] = [
                        'name' => $fullName,
                        'role' => $role
                    ];
                } elseif (in_array($role, ['Adviser', 'Panel0', 'Panel1', 'Panel2'])) {
                    $panels[] = [
                        'name' => $fullName,
                        'role' => $role
                    ];
                }
            }

            // Collect tags into an array
            $tagsArray = [];
            while ($rowlower = $tags->fetch(PDO::FETCH_ASSOC)) {
                $tagsArray[] = $rowlower['TagName'];
            }

            // Collect keywords into an array
            $keywordsArray = [];
            while ($rowlower = $keyws->fetch(PDO::FETCH_ASSOC)) {
                $keywordsArray[] = $rowlower['Keyword'];
            }

            // Append this research entry into the main data array
            $data[] = [
                'ID' => $row['ResearchID'],
                'Title' => $row['Title'],
                'Year' => $row['YRPublished'], // Ensure this is present in the database
                'Description' => $row['Abstract'], // Ensure this is present in the database
                'ImageUrl' => $row['ImageName'], // Ensure this is present in the database
                'FileName' => $row['FileName'], // Add the 'FileName' field
                'Researchers' => $researchers,
                'Panels' => $panels,
                'Tags' => $tagsArray,
                'Keywords' => $keywordsArray
            ];
        } catch (PDOException $e) {
            echo json_encode(['error' => 'Error fetching related data: ' . $e->getMessage()]);
            exit; // Stop further execution if there's an error
        }
    }

    echo json_encode($data);

} catch (PDOException $e) {
    echo json_encode(['error' => 'Database error: ' . $e->getMessage()]);
} catch (Exception $e) {
    echo json_encode(['error' => 'General error: ' . $e->getMessage()]);
}
