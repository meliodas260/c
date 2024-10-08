<?php
require 'dblogin.php';
$secID = $_POST['SecID'];
try {
    // Initialize an empty array to hold the final data
    $data = [];

    // Select data from the database
    $ResearchSql = $pdo->query("SELECT * FROM `researchtbl` WHERE `SectionID` = $secID");

    // Loop through the result set and build an array
    while ($row = $ResearchSql->fetch(PDO::FETCH_ASSOC)) {
        $connector = $row['RoleConnectorKey'];

        // Fetch researchers related to the research
        $ResearcherSql = $pdo->query("SELECT * FROM researchroletbl a 
                                       LEFT JOIN accounttbl b ON b.UserID = a.UID 
                                       WHERE a.RoleConnectorKey = $connector");

        // Fetch tags related to the research
        $tags = $pdo->query("SELECT * FROM `reasearchtagtbl` a 
                             LEFT JOIN tagtbl b ON a.TagID = b.TagId 
                             WHERE a.TagConnectorKey = $connector");

        // Fetch keywords related to the research
        $keyws = $pdo->query("SELECT * FROM `reasearchkeywordstbl` 
                              WHERE `KeywordConnectorKey` = $connector");

        // Collect researchers, tags, and keywords into arrays
        $researchers = [];
        $Panels = [];
        while ($rowlower = $ResearcherSql->fetch(PDO::FETCH_ASSOC)) {
            if ($rowlower['Role'] === 'Leader'  || $rowlower['Role'] === 'Member') {
            $fullName = trim($rowlower['Fname'] . ' ' . $rowlower['Mname'] . ' ' . $rowlower['Lname'] . ' ' . $rowlower['Suffix']);
    
            $researchers[] = [
                'name' => $fullName,
                'role' => $rowlower['Role']
            ];
        }
        if ($rowlower['Role'] === 'Adviser'  || $rowlower['Role'] === 'Panel0' || $rowlower['Role'] === 'Panel1' || $rowlower['Role'] === 'Panel2') {
            $fullName = trim($rowlower['Fname'] . ' ' . $rowlower['Mname'] . ' ' . $rowlower['Lname'] . ' ' . $rowlower['Suffix']);
    
            $Panels[] = [
                'name' => $fullName,
                'role' => $rowlower['Role']
            ];
        }       
    }

        $tagsArray = [];
        while ($rowlower = $tags->fetch(PDO::FETCH_ASSOC)) {
            $tagsArray[] = $rowlower['TagName'];
        }

        $keywordsArray = [];
        while ($rowlower = $keyws->fetch(PDO::FETCH_ASSOC)) {
            $keywordsArray[] = $rowlower['Keyword'];
        }

        // Append this research entry into the main data array
        $data[] = [
            'ID' => $row['ResearchID'],
            'Title' => $row['Title'],
            'FILE' => $row['FileName'],
            'Year' => $row['YRPublished'], // Ensure this is present in the database
            'Description' => $row['Abstract'], // Ensure this is present in the database
            'ImageUrl' => $row['ImageName'], // Ensure this is present in the database
            'Researchers' => $researchers,
            'Panels' => $Panels,
            'Tags' => $tagsArray,
            'Keywords' => $keywordsArray
        ];
    }

    // Output the data as JSON
    header('Content-Type: application/json');
    echo json_encode($data);

} catch (PDOException $e) {
    // Return an error message if a PDO exception occurs
    echo json_encode(['error' => 'Error: ' . $e->getMessage()]);
}
?>
