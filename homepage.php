<?php
// require_once 'verifier.php';

//     if(!Verifyuser()){
//         header("Location: homepage.php");
//         exit;
// }
?>
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="css/custom2.css" rel="stylesheet"> 
    <title>homepage page</title>
</head>
<style>        /* Modal background */
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

/* Main container for the sidebars */
.rightbar-container {
    display: flex;
    flex-wrap: wrap; /* Wrap sidebars for smaller screens */
    gap: 20px; /* Space between sidebars */
    padding: 10px;
}

/* Each sidebar */
.research-sidebar {
    flex: 1 1 300px; /* Minimum width of 300px, but flexible */
    max-width: 300px; /* Limit maximum width for a consistent layout */
    background-color: #c7ccce;
    padding: 15px;
    border: 1px solid #ccc;
    border-radius: 8px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    overflow-y: auto;
    max-height: 600px; /* Ensure it doesn’t grow too tall */
}

/* Course Title */
.course-title {
    font-size: 16px;
    font-weight: bold;
    margin-bottom: 10px;
    color: #333;
    text-align: center;
}

/* Items Container */
.course-research-items {
    display: flex;
    flex-direction: column;
    gap: 15px;
}

/* No Research Found Message */
.no-research-msg {
    font-size: 14px;
    color: #888;
    text-align: center;
}

/* Research Item */
.research-item {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 10px;
    padding: 10px;
    background-color: #ffffff;
    border: 1px solid #ddd;
    border-radius: 5px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
    text-decoration: none;
}

.research-item img {
    width: 100%;
    height: 120px;
    object-fit: cover;
    border-radius: 5px;
}

.research-item h5 {
    font-size: 14px;
    font-weight: bold;
    text-align: center;
    margin: 0;
    color: #333;
}

.research-item p {
    font-size: 12px;
    text-align: center;
    margin: 0;
    color: #555;
}

.research-item:hover {
    background-color: #b5e9ec;
}

    #research-container {
            display: flex;
            flex-wrap: wrap;
        }
        .research-card {
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 15px;
            margin: 10px;
            width: 200px;
            text-align: center;
        }
        .research-image {
            width: 100%;
            height: auto;
            border-radius: 5px;
        }
        .read-more {
            color: blue;
            text-decoration: underline;
            cursor: pointer;
        }
        .read-more {
            display: inline-block;
            padding: 8px 12px;
            margin-top: 10px;
            background-color: #6795c9;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            font-weight: bold;
        }

        .read-more:hover {
            background-color: #1060c9;
            color:white;
        }  
        .flexer {
            padding-top:2rem;
            display: flex;
            flex-wrap: wrap;
        }

        .half {
    padding: 10px;
    box-sizing: border-box; /* Include padding in the width */
}

.left {
    flex: 8; /* Takes 80% of the available space */
}

.right {
    flex: 2; /* Takes 20% of the available space */
}


        /* Responsive adjustments */
        @media screen and (max-width: 600px) {
            
            .half {
        flex-direction: column; /* Stack items vertically */
    }

    .left, .right {
        flex: 1; /* Equal width when stacked vertically */
        width: 100%; /* Ensure full width */
    }
            #research-container {
                flex-direction: column;
                align-items: center;
            }
            
            .research-card {
                width: 100%;
                max-width: 500px;
            }
        }

</style>
<?php
include 'modal/header.php';
?>


<body>
<div class="contentor">

</div>

    <div class="flexer">
        <div class="half left"> 
                <br>
            <h1>Research Suggestions</h1>
            <div id="research-container"></div>
                </div>

                <div class="half right">   
                <div class="rightbar-container">
            <?php foreach ($courses as $course) : ?>
                <?php
                $courseID = $course['CourseID'];
                $courseAcronym = htmlspecialchars($course['CourseAcronym']);

                // Fetch top 10 research for this course
                $researchQuery = "
                    SELECT 
                        A.ResearchID, 
                        ROUND(AVG(A.Rate), 1) AS Rates, 
                        B.Title, 
                        B.ImageName 
                    FROM 
                        studentresearchratetbl AS A 
                    LEFT JOIN 
                        researchtbl AS B ON A.ResearchID = B.ResearchID 
                    WHERE 
                        B.CourseID = :courseID 
                        AND YEAR(B.date) BETWEEN :lastYear AND :currentYear
                    GROUP BY 
                        A.ResearchID 
                    ORDER BY 
                        Rates DESC 
                    LIMIT 10";
                $researchStmt = $pdo->prepare($researchQuery);
                $researchStmt->execute([
                    'courseID' => $courseID,
                    'lastYear' => $lastYear,
                    'currentYear' => $currentYear
                ]);
                $researchItems = $researchStmt->fetchAll();
                ?>

                <!-- Sidebar for Each Course -->
                <div class="research-sidebar">
                    <h2 class="course-title"><?= htmlspecialchars($courseAcronym) ?> - Top Rate Research</h2>
                    <div class="course-research-items">
                        <?php if (!empty($researchItems)) : ?>
                            <?php foreach ($researchItems as $research) : ?>
                                <?php
                                $title = htmlspecialchars($research['Title']);
                                $imageUrl = !empty($research['ImageName']) ? "UploadIMG/" . htmlspecialchars($research['ImageName']) : "img/neust_logo.png";
                                $averageRating = $research['Rates'];
                                $researchID = $research['ResearchID'];
                                ?>
                                <a href="ResearchView?researchID=<?= $researchID ?>" class="research-item">
                                    <img src="<?= $imageUrl ?>" alt="<?= $title ?>">
                                    <h5><?= $title ?></h5>
                                    <p>Average Rating: <?= empty($averageRating) ? 0 : $averageRating ?> / 5</p>

                                    <div class="starsDiv">
                                        <?= renderRatingStars($averageRating) ?>
                                    </div>
                                </a>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <p class="no-research-msg">No research found for this course.</p>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>


        </div>
    </div>
    <script>
    // Add a research card to the container
// Add a research card to the container
function addResearchCard(researchID, title, date, abstract, imageUrl, rate) {
    const container = document.getElementById('research-container');
    const card = document.createElement('div');

    // Set a default image if `imageUrl` is empty
    const imageSrc = imageUrl ? imageUrl : '../img/neust_logo.png';

    card.className = 'research-card';
    card.innerHTML = `
        <img src="UploadIMG/${imageSrc}" alt="Research Image" class="research-image">
        <h2>${title}</h2>
        <p><strong>Year:</strong> ${date}</p>
        <p>${abstract}</p>
        <div class="rating">
           <strong>Average Rating:</strong> ${rate === null || rate === "null" ? 0 : rate} / 5
            <div class="stars">${generateStars(rate)}</div>
        </div>
        <a href="ResearchView?researchID=${researchID}" class="read-more">Read More</a>
    `;
    container.appendChild(card);
}

// Generate stars for rating display
function generateStars(rate) {
    const totalStars = 5;
    const wholeStars = Math.floor(rate);
    const fraction = rate - wholeStars;
    let starsHTML = '';

    // Add full stars
    for (let i = 0; i < wholeStars; i++) {
        starsHTML += '<svg class="starRATE filled" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>';
    }

    // Add a partial star (if applicable)
    if (fraction > 0) {
        const percentage = fraction * 100;
        starsHTML += `
            <svg class="starRATE partial" style="--percent: ${percentage}%" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/>
            </svg>`;
    }

    // Add empty stars
    for (let i = wholeStars + (fraction > 0 ? 1 : 0); i < totalStars; i++) {
        starsHTML += '<svg class="starRATE" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>';
    }

    return starsHTML;
}

// Suggest research papers based on a query
function suggestResearchPapers(researchPapers, query, desiredCount) {
    const suggestions = researchPapers.filter(paper =>
        paper.Title && paper.Title.toLowerCase().includes(query.toLowerCase())
    );

    if (suggestions.length < desiredCount) {
        const remainingCount = desiredCount - suggestions.length;
        const randomPapers = researchPapers
            .filter(paper => !suggestions.includes(paper))
            .sort(() => Math.random() - 0.5)
            .slice(0, remainingCount);
        suggestions.push(...randomPapers);
    }

    return suggestions.slice(0, desiredCount);
}

// Fetch and display research suggestions from the API
function fetchResearchSuggestions() {
    fetch('backend/Suggestresearch.php')
        .then(response => response.json())
        .then(researchPapers => {
            const searchQuery = 'dynamic'; // Set query based on requirements
            const desiredCount = 10; // Number of papers to display
            const suggestedPapers = suggestResearchPapers(researchPapers, searchQuery, desiredCount);

            const container = document.getElementById('research-container');
            container.innerHTML = ''; // Clear previous content

            suggestedPapers.forEach(paper => {
                addResearchCard(
                    paper.ResearchID,
                    paper.Title,
                    paper.date,
                    paper.Abstract,
                    paper.ImageName,
                    paper.RATES
                );
            });

            if (suggestedPapers.length === 0) {
                container.innerHTML = '<p>No research papers found for your query.</p>';
            }
        })
        .catch(error => console.error('Error fetching research papers:', error));
}

// Fetch research suggestions on page load
fetchResearchSuggestions();

</script>
</body>
</html>