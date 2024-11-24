<?php
require 'backend/dblogin.php'; // Include the database connection

// Fetch all courses
$coursesQuery = "SELECT CourseID, CourseAcronym FROM coursetbl"; // Replace with your table name
$coursesStmt = $pdo->prepare($coursesQuery);
$coursesStmt->execute();
$courses = $coursesStmt->fetchAll();

// Get the current and last year dynamically
$currentYear = date('Y');
$lastYear = $currentYear - 1;

// Function to render star ratings
function renderRatingStars($averageRating) {
    $wholeStars = floor($averageRating); // Number of full stars
    $fraction = $averageRating - $wholeStars; // Remaining fraction of the last star
    $totalStars = 5; // Total stars to display

    $output = '';

    // Render full stars
    for ($i = 1; $i <= $wholeStars; $i++) {
        $output .= '<svg class="starRATE filled" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                        <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/>
                    </svg>';
    }

    // Render partial star (if applicable)
    if ($fraction > 0) {
        $percentage = $fraction * 100; // Convert fraction to percentage
        $output .= '<svg class="starRATE partial" style="--percent: ' . $percentage . '%;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                        <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/>
                    </svg>';
    }

    // Render empty stars
    for ($i = $wholeStars + ($fraction > 0 ? 1 : 0); $i < $totalStars; $i++) {
        $output .= '<svg class="starRATE" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                        <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/>
                    </svg>';
    }

    return $output;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Top Research by Course</title>
    <style>
        .starRATE {
            width: 20px;
            height: 20px;
            fill: #ccc;
        }

        .starRATE.filled {
            fill: #FFD700;
        }

        .starRATE.partial {
            position: relative;
        }

        .starRATE.partial path {
            fill: #FFD700;
            clip-path: polygon(0 0, var(--percent, 0%) 0, var(--percent, 0%) 100%, 0% 100%);
        }

        .research-sidebar {
            position: fixed; /* Fix the sidebar to the right side */
            top: 100px;
            right: 20px;
            width: 250px;
            max-height: 600px;
            overflow-y: auto;
            background-color: #f8f9fa;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .course-section {
            margin-bottom: 30px;
        }

        .research-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 10px;
            margin-bottom: 15px;
            padding: 10px;
            background-color: #ffffff;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
            width: 100%;
            cursor: pointer;
            text-decoration: none; /* Remove underline */
        }

        .research-item img {
            width: 100%;
            height: 120px; /* Smaller image height */
            object-fit: cover;
            border-radius: 5px;
        }

        .research-item h5 {
            font-size: 14px;
            font-weight: bold;
            text-align: center;
            margin: 0;
        }

        .research-item p {
            text-align: center;
            font-size: 12px;
            margin: 0;
        }

        .research-item:hover {
            background-color: #f0f0f0; /* Light hover effect */
        }
    </style>
</head>
<body>
    <h1>Top 10 Research by Course</h1>
    <div class="research-sidebar">
        <?php
        foreach ($courses as $course) {
            $courseID = $course['CourseID'];
            $courseAcronym = htmlspecialchars($course['CourseAcronym']);

            // Fetch top 10 research for this course
            $researchQuery = "
                SELECT A.ResearchID, ROUND(AVG(A.Rate), 1) AS Rates, B.Title, B.ImageName 
                FROM studentresearchratetbl AS A 
                LEFT JOIN researchtbl AS B ON A.ResearchID = B.ResearchID 
                WHERE B.CourseID = :courseID 
                  AND YEAR(B.date) BETWEEN :lastYear AND :currentYear
                GROUP BY A.ResearchID 
                ORDER BY Rates DESC 
                LIMIT 10";
            $researchStmt = $pdo->prepare($researchQuery);
            $researchStmt->execute([
                'courseID' => $courseID,
                'lastYear' => $lastYear,
                'currentYear' => $currentYear
            ]);
            $researchItems = $researchStmt->fetchAll();

            echo "<div class='course-section'>";
            echo "<h2>Top Research for $courseAcronym</h2>";

            if (count($researchItems) > 0) {
                foreach ($researchItems as $research) {
                    $title = htmlspecialchars($research['Title']);
                    $imageUrl = !empty($research['ImageName']) ? "UploadIMG/" . htmlspecialchars($research['ImageName']) : "img/neust_logo.png";
                    $averageRating = $research['Rates'];
                    $researchID = $research['ResearchID'];
                    ?>

                    <a href="ResearchView?researchID=<?= $researchID ?>" class="research-item">
                        <img src="<?= $imageUrl ?>" alt="Research Image">
                        <h5><?= $title ?></h5>
                        <p>Average Rating: <?= $averageRating ?> / 5</p>
                        <div class="starsDiv">
                            <?= renderRatingStars($averageRating) ?>
                        </div>
                    </a>

                    <?php
                }
            } else {
                echo "<p>No research found for this course.</p>";
            }

            echo "</div>";
        }
        ?>
    </div>
</body>
</html>
