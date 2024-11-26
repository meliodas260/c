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

// Retrieve all entries from the best_research table
$bestResearchList = [];
try {
    $query = "SELECT br.ResearchID, r.Title, r.YRPublished, r.Abstract, r.ImageName, . C.CourseAcronym FROM `best_research` br left JOIN researchtbl r ON br.ResearchID = r.ResearchID left join coursetbl as C on C.CourseID = r.CourseID;";
    $stmt = $pdo->query($query);
    $bestResearchList = $stmt->fetchAll(PDO::FETCH_ASSOC);
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

        .search-container {
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

        #predict {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container search-container">
        <h1 class="text-center">Research Search</h1>
        <div id="predict" class="alert alert-info text-center">
            <p>This is a predictive div. It will be hidden when you click on a research title.</p>
        </div>
        <div class="mb-4">
            <input type="text" id="title" class="form-control" placeholder="Enter Research Title" autocomplete="off">
        </div>
        <div id="results" class="row gy-4"></div>
        <div id="research-details" class="mt-5 p-3 border rounded d-none bg-light"></div>
    </div>

    <!-- Section to display the Best Research -->
    <div class="container mt-5">
        <h2 class="text-center">Best Research</h2>
        <div id="best-research" class="row gy-4">
            <?php if (!empty($bestResearchList)) : ?>
                <?php foreach ($bestResearchList as $research) : ?>
                    <div class="col-md-4">
                        <div class="research-item p-3">
                            <h3 class="research-title"><?= htmlspecialchars($research['Title']) ?></h3>
                            <p><strong>Year:</strong> <?= htmlspecialchars($research['YRPublished']) ?></p>
                            <p><?= htmlspecialchars($research['Abstract']) ?></p>
                            <img src="UploadIMG/<?= htmlspecialchars($research['ImageName']) ?>" alt="<?= htmlspecialchars($research['Title']) ?>" class="img-fluid mt-2">
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else : ?>
                <p class="text-center">No best research added yet.</p>
            <?php endif; ?>
        </div>
    </div>

    <!-- Include Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        let researchData = [];

        // Fetch research based on the title
        function searchResearch() {
            const title = document.getElementById('title').value.trim();

            if (title.length >= 3) {
                const xhr = new XMLHttpRequest();
                xhr.open('POST', 'backend/SearchAPI.php', true);
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                xhr.onreadystatechange = function () {
                    if (xhr.readyState === 4) {
                        if (xhr.status === 200) {
                            try {
                                const data = JSON.parse(xhr.responseText);
                                researchData = data;
                                displayResearch(data);
                            } catch (e) {
                                console.error('Invalid JSON response:', xhr.responseText);
                            }
                        } else {
                            console.error('HTTP Error:', xhr.status, xhr.statusText);
                        }
                    }
                };
                const params = `Title=${encodeURIComponent(title)}`;
                xhr.send(params);
            } else {
                document.getElementById('results').innerHTML = '<p class="text-center">Please enter at least 3 characters.</p>';
            }
        }

        // Display research results
        function displayResearch(data) {
            const resultsDiv = document.getElementById('results');
            resultsDiv.innerHTML = '';

            if (data.length === 0) {
                resultsDiv.innerHTML = '<p class="text-center">No research found.</p>';
                return;
            }

            data.forEach((research) => {
                const colDiv = document.createElement('div');
                colDiv.className = 'col-md-4';

                colDiv.innerHTML = `
                    <div class="research-item p-3">
                        <h3 class="research-title" onclick="showDetails(${research.ID})">${research.Title}</h3>
                        <p><strong>Year:</strong> ${research.Year}</p>
                        <p>${research.Description}</p>
                        <img src="UploadIMG/${research.ImageUrl}" alt="${research.Title}" class="img-fluid mt-2">
                        <button class="btn btn-success mt-2" onclick="confirmAdd(${research.ID})">Add to Best Research</button>
                    </div>
                `;

                resultsDiv.appendChild(colDiv);
            });
        }

        // Confirm and add to the "Best Research" table
        function confirmAdd(researchId) {
            Swal.fire({
                title: 'Are you sure?',
                text: 'Do you want to add this research to Best Research?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, add it!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    addToBestResearch(researchId);
                }
            });
        }

        // Add to "Best Research" table (handled directly in the same file)
        function addToBestResearch(researchId) {
            const xhr = new XMLHttpRequest();
            xhr.open('POST', '', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4) {
                    if (xhr.status === 200) {
                        const response = JSON.parse(xhr.responseText);
                        if (response.success) {
                            Swal.fire('Success', 'The research has been added to Best Research!', 'success');
                        } else {
                            Swal.fire('Error', response.message || 'Failed to add research to Best Research.', 'error');
                        }
                    }
                }
            };
            xhr.send(`ResearchID=${researchId}`);
        }

        // Event listener for search input
        document.getElementById('title').addEventListener('input', searchResearch);
    </script>
</body>
</html>
