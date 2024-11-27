<?php
// Database connection (replace with your actual database connection details)
require 'backend/dblogin.php';

// Fetch all sections count per course
$query_all_sections = "SELECT b.CourseAcronym, COUNT(*) 
                       FROM `sectionn&capteachertbl` a 
                       LEFT JOIN coursetbl b ON a.CourseID = b.CourseID 
                       GROUP BY b.CourseID";
$all_sections_result = $pdo->query($query_all_sections);

// Fetch sections count per course for the current year (2024)
$query_current_year_sections = "SELECT b.CourseAcronym, COUNT(*)
                                FROM `sectionn&capteachertbl` a 
                                LEFT JOIN coursetbl b ON a.CourseID = b.CourseID  
                                GROUP BY b.CourseID,YEAR(a.DateCreacted)";
$current_year_sections_result = $pdo->query($query_current_year_sections);

// Fetch login number for the month of November
$query_login_number = "SELECT COUNT(*) AS LoginNumber, MONTH(`datelogin`) AS months, YEAR(`datelogin`)
 AS years FROM `logtbl` GROUP BY YEAR(`datelogin`), MONTH(`datelogin`) 
 ORDER BY YEAR(`datelogin`) ASC, MONTH(`datelogin`) ASC";
$login_number_result = $pdo->query($query_login_number);
$login_number = $login_number_result->fetch(PDO::FETCH_ASSOC)['LoginNumber'];

// Fetch all-time research count per course
$query_all_research = "SELECT b.CourseAcronym, COUNT(*) 
                       FROM `researchtbl` a 
                       LEFT JOIN coursetbl b ON a.CourseID = b.CourseID";
$all_research_result = $pdo->query($query_all_research);

// Fetch research count per course per year
$query_research_per_year = "SELECT b.CourseAcronym, COUNT(*) AS research_count, YEAR(a.date) AS year 
                            FROM `researchtbl` a 
                            LEFT JOIN coursetbl b ON a.CourseID = b.CourseID 
                            GROUP BY b.CourseAcronym, YEAR(a.date) 
                            ORDER BY YEAR(a.date) DESC";
$research_per_year_result = $pdo->query($query_research_per_year);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course and Research Report with Google Charts</title>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/custom2.css" rel="stylesheet">
    <link href="css/sidebar.css" rel="stylesheet">

    <script type="text/javascript">
        google.charts.load('current', {'packages':['corechart', 'bar', 'line']});
        
        google.charts.setOnLoadCallback(drawCharts);

        function drawCharts() {
            // Pie Chart: Research Count Per Course (All-time)
            var researchData = new google.visualization.DataTable();
            researchData.addColumn('string', 'Course Acronym');
            researchData.addColumn('number', 'Research Count');
            <?php
            $research_data = [];
            while ($row = $all_research_result->fetch(PDO::FETCH_ASSOC)) {
                $research_data[] = "['" . addslashes($row['CourseAcronym']) . "', " . $row['COUNT(*)'] . "]";
            }
            ?>
            researchData.addRows([<?php echo implode(", ", $research_data); ?>]);

            var researchOptions = {
                title: 'Research Count Per Course (All-time)',
                is3D: true,
                animation: {
                    startup: true,
                    easing: 'out',
                    duration: 1500
                }
            };
            var researchChart = new google.visualization.PieChart(document.getElementById('researchChart'));
            researchChart.draw(researchData, researchOptions);

            // Bar Chart: Sections Count Per Course in 2024
            var sectionsData = new google.visualization.DataTable();
            sectionsData.addColumn('string', 'Course Acronym');
            sectionsData.addColumn('number', 'Section Count (2024)');
            <?php
            $sections_data = [];
            while ($row = $current_year_sections_result->fetch(PDO::FETCH_ASSOC)) {
                $sections_data[] = "['" . addslashes($row['CourseAcronym']) . "', " . $row['COUNT(*)'] . "]";
            }
            ?>
            sectionsData.addRows([<?php echo implode(", ", $sections_data); ?>]);

            var sectionsOptions = {
                title: 'Sections Count Per Course in 2024',
                chartArea: {width: '50%'},
                hAxis: {
                    title: 'Section Count',
                    minValue: 0
                },
                vAxis: {
                    title: 'Course Acronym'
                },
                animation: {
                    startup: true,
                    easing: 'out',
                    duration: 1500
                }
            };
            var sectionsChart = new google.visualization.BarChart(document.getElementById('sectionsChart'));
            sectionsChart.draw(sectionsData, sectionsOptions);

            // Line Chart: Login Count by Month and Year
            var loginData = new google.visualization.DataTable();
            loginData.addColumn('string', 'Month-Year');
            loginData.addColumn('number', 'Login Count');
            <?php
            $login_data = [];
            while ($row = $login_number_result->fetch(PDO::FETCH_ASSOC)) {
                $monthYear = date('F Y', mktime(0, 0, 0, $row['months'], 1, $row['years'])); // Format: "Month Year"
                $login_data[] = "['" . addslashes($monthYear) . "', " . $row['LoginNumber'] . "]";
            }
            ?>
            loginData.addRows([<?php echo implode(", ", $login_data); ?>]);

            var loginOptions = {
                title: 'Login Count by Month and Year',
                curveType: 'function',
                legend: { position: 'bottom' },
                animation: {
                    startup: true,
                    easing: 'out',
                    duration: 1500
                }
            };

            var loginChart = new google.visualization.LineChart(document.getElementById('loginChart'));
            loginChart.draw(loginData, loginOptions);
        }
    </script>
</head>
<body>
<?php include 'modal/header.php'; ?>


<div class="content">
    <div class="sidebar">
        <?php include 'modal/adminSidebar.php'; ?>
    </div>
    <div class="main-content">

        <div class="container mt-5">
            <h1 class="text-center mb-4">Course and Research Report with Google Charts</h1>

            <!-- Pie Chart: Research Count Per Course (All-time) -->
            <div id="researchChart" style="width: 100%; height: 400px;"></div>
            <br>

            <!-- Bar Chart: Sections Count Per Course in 2024 -->
            <div id="sectionsChart" style="width: 100%; height: 400px;"></div>
            <br>

            <!-- Line Chart: Login Count by Month and Year -->
            <div id="loginChart" style="width: 100%; height: 400px;"></div>
            <br>

            <h3>Sections Count Per Course (All-time)</h3>
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Course Acronym</th>
                        <th>Section Count</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $all_sections_result->fetch(PDO::FETCH_ASSOC)): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['CourseAcronym']); ?></td>
                            <td><?php echo $row['COUNT(*)']; ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
            <br>

            <br>
            <!-- Research Count Per Course Per Year -->
            <h3>Research Count Per Course Per Year</h3>
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Course Acronym</th>
                        <th>Year</th>
                        <th>Research Count</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $research_per_year_result->fetch(PDO::FETCH_ASSOC)): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['CourseAcronym']); ?></td>
                            <td><?php echo $row['year']; ?></td>
                            <td><?php echo $row['research_count']; ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

</body>
</html>
