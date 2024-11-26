<?php
require 'dblogin.php';
try {
    // Initialize an empty array to hold the final data
    $data = [];

    // First Query: Select research data within specified years
    $ResearchSql = $pdo->query("SELECT `ResearchID`, `Title`, YEAR(`date`) AS date, `Abstract`, `ImageName`, `RoleConnectorKey`
                                FROM `researchtbl` 
                                WHERE YEAR(`date`) IN (2020, 2024)");

    // Loop through the result set and build an array
    while ($row = $ResearchSql->fetch(PDO::FETCH_ASSOC)) {
        $connector = $row['RoleConnectorKey'];

        // Second Query: Fetch tags related to the research based on RoleConnectorKey
        $tags = $pdo->query("SELECT `TagName` 
                             FROM `tagtbl` a 
                             LEFT JOIN `reasearchtagtbl` b ON a.TagId = b.TagID 
                             WHERE b.RoleConnectorKey = $connector");

        // Collect tags into an array
        $tagsArray = [];
        while ($tagRow = $tags->fetch(PDO::FETCH_ASSOC)) {
            $tagsArray[] = $tagRow['TagName'];
        }

        // Append this research entry into the main data array
        $data[] = [
            'ID' => $row['ResearchID'],
            'Title' => $row['Title'],
            'Date' => $row['date'], // Year of publication
            'Description' => $row['Abstract'], // Research abstract/description
            'ImageUrl' => $row['ImageName'], // Image name/url if available
            'Tags' => $tagsArray
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
