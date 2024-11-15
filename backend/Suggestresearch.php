<?php
require 'dblogin.php';

// Get the current year and last year
$currentYear = date('Y');
$lastYear = date('Y', strtotime('-1 year'));

// Prepare the query to fetch research papers for the current year and last year
$stmt = $pdo->prepare("

SELECT `ResearchID`,`Title`, year(`date`) as date, `Abstract`, `ImageName` FROM `researchtbl` WHERE Year(date) IN (:currentYear, :lastYear)
");

// Bind the parameters
$stmt->bindValue(':currentYear', $currentYear);
$stmt->bindValue(':lastYear', $lastYear);
$stmt->execute();

// Fetch all research papers
$researchPapers = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Return research papers as JSON
echo json_encode($researchPapers);

// Close connection
$pdo = null;
?>
