<?php
// Database connection (assuming you have a db.php or a connection file)
require 'backend/dblogin.php';

// Handle adding to the "Best Research" functionality
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['ResearchID'])) {
    $researchID = intval($_POST['ResearchID']); // Sanitize input

    try {
        // Check if research already exists in the best_research table
        $checkStmt = $pdo->prepare("SELECT COUNT(*) FROM `best_research` WHERE ResearchID = :ResearchID");
        $checkStmt->execute(['ResearchID' => $researchID]);
        $count = $checkStmt->fetchColumn();

        // If not exists, insert it into the best_research table
        if ($count == 0) {
            $query = "INSERT INTO `best_research` (ResearchID) VALUES (:ResearchID)";
            $stmt = $pdo->prepare($query);
            $stmt->execute(['ResearchID' => $researchID]);
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'This research is already in the best research list.']);
        }
    } catch (PDOException $e) {
        echo json_encode(['success' => false, 'error' => $e->getMessage()]);
    }
    exit;
}

// Retrieve all entries from the best_research table grouped by Course
$bestResearchByCourse = [];
try {
    $query = "SELECT 
                  br.ResearchID, 
                  r.Title, 
                  r.YRPublished, 
                  r.Abstract, 
                  r.ImageName, 
                  C.CourseAcronym 
              FROM 
                  `best_research` br 
              LEFT JOIN 
                  researchtbl r ON br.ResearchID = r.ResearchID 
              LEFT JOIN 
                  coursetbl C ON C.CourseID = r.CourseID 
              ORDER BY 
                  C.CourseAcronym, r.Title";
    $stmt = $pdo->query($query);
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Group by CourseAcronym
    foreach ($results as $research) {
        $bestResearchByCourse[$research['CourseAcronym']][] = $research;
    }
} catch (PDOException $e) {
    echo "Error fetching best research: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Research Search with Selection</title>
    <!-- Include Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Include SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Arial', sans-serif;
        }

        .course-section {
            margin-top: 50px;
        }

        .research-item img {
            max-width: 100%;
            height: auto;
            border-radius: 5px;
        }

        .research-item {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            background-color: #ffffff;
            padding: 20px;
        }

        .research-title {
            cursor: pointer;
            color: #007BFF;
        }

        .research-title:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Best Research</h1>

        <!-- Display the Best Research grouped by course -->
        <?php if (!empty($bestResearchByCourse)) : ?>
            <?php foreach ($bestResearchByCourse as $course => $researchList) : ?>
                <div class="course-section">
                    <h2><?= htmlspecialchars($course) ?></h2>
                    <div class="row gy-4">
                        <?php foreach ($researchList as $research) : ?>
                            <div class="col-md-4">
                                <div class="research-item p-3">
                                    <h3 class="research-title"><?= htmlspecialchars($research['Title']) ?></h3>
                                    <p><strong>Year:</strong> <?= htmlspecialchars($research['YRPublished']) ?></p>
                                    <p><?= htmlspecialchars($research['Abstract']) ?></p>
                                    <img src="UploadIMG/<?= htmlspecialchars($research['ImageName']) ?>" alt="<?= htmlspecialchars($research['Title']) ?>" class="img-fluid mt-2">
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else : ?>
            <p class="text-center">No best research added yet.</p>
        <?php endif; ?>
    </div>

    <!-- Include Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
