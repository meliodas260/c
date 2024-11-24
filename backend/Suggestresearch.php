<?php
require 'dblogin.php';

// Get the current year and last year
$currentYear = date('Y');
$lastYear = date('Y', strtotime('-1 year'));

// Prepare the query to fetch research papers for the current year and last year
$stmt = $pdo->prepare("
SELECT A.`ResearchID`,`Title`, year(A.`date`) as date, `Abstract`, `ImageName` ,round(AVG(b.Rate), 1) as RATES FROM `researchtbl` as A 
left join `studentresearchratetbl` as b on A.ResearchID = b.ResearchID WHERE Year(A.date) IN(:currentYear, :lastYear) group by `Title`;
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
