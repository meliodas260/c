<?php
// require_once 'verifier.php';

//     if(!VerifyCApT()){
//         header("Location: homepage.php");
//         exit;
// }
?>
<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css">
    <script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js"></script>
    <link href="css/custom2.css" rel="stylesheet">
    <link href="css/sidebar.css" rel="stylesheet">
    <link href="css/datatable.css" rel="stylesheet">

    <style>

    .card {
            background: #c3d6e9 !important;
            border: 1px solid #ddd;
            border-radius: 20px !important;
            box-shadow: 0 1px 4px rgba(0, 0, 0, 0.1);
            width: 300px;
            padding: 20px;
            text-align: center;
        }
        .card h2 {
            margin: 0;
            font-size: 1.5em;
            color: #333;
        }
        .card p {
            margin: 10px 0 0;
            font-size: 1.2em;
            color: #555;
        }
        .COUNT {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
        }

    </style>
    <title>Accounts</title>
</head>

<?php include 'modal/header.php'; ?>

<body>
<div class="content">
    <div class="sidebar">
        <?php include 'modal/adminSidebar.php'; ?>
    </div>
    <div class="main-content">


    <?php
require 'backend/dblogin.php';

    try {
            // Get UID from cookie
            $UID = isset($_COOKIE['Email']) ? $_COOKIE['Email'] : null;

            if (!$UID) {
                throw new Exception("User is not logged in or UID is missing.");
            }

            // Get the current year
            $currentYear = date('Y');

            // SQL query to count sections created by the teacher in the current year
            $sql = "SELECT COUNT(*) as SectionCount FROM `sectionn&capteachertbl` 
                    WHERE `UID_Teacher` = :UID 
                    AND YEAR(`DateCreacted`) = :currentYear";

            $stmt = $pdo->prepare($sql);
            $stmt->execute(['UID' => $UID, 'currentYear' => $currentYear]);

            // Fetch the count
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            // Prepare data to display
            $sectionCount = $result['SectionCount'] ?? 0;

        } catch (PDOException $e) {
            die("Error: " . $e->getMessage());
        } catch (Exception $e) {
            die("Error: " . $e->getMessage());
        }
    ?>

    <div class="COUNT">
        <div class="card">
            <h2>Current Section :</h2>
            <p> <?php echo htmlspecialchars($sectionCount); ?></p>
        </div>
    </div>


        <h2>Programs & Sections</h2>
        <?php 

        // Database connection
                            $host = 'localhost';
                            $username = 'root';
                            $password = '';
                            $database = 'repo';
                            $dsn = "mysql:host=$host;dbname=$database;charset=utf8mb4";
                            $pdo = new PDO($dsn, $username, $password);
                            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                            $emails = $_COOKIE['Email'];
                            $Sections = $pdo->query("SELECT a.`SectionName` , a.`SectionID`  ,a.`CourseID` FROM `sectionn&capteachertbl` as a WHERE `UID_Teacher` = '$emails' order by a.`DateCreacted` DESC;");

                            while ($higherrows = $Sections->fetch(PDO::FETCH_ASSOC)) {
                            echo   "<div class='SpecDiv'>
                            <h3>". $higherrows['SectionName'] ."</h3>
                            <table class='table'>
                            <thead>
                                <tr>
                                <th scope='col'>Student #</th>
                                <th scope='col'>First</th>
                                <th scope='col'>Middle</th>
                                <th scope='col'>Last</th>
                                </tr>
                            </thead>
                            <tbody>";                
                                    try {
                                        $sectionId = $higherrows['SectionID'];
                                        // Select data from the database
                                        $stmt = $pdo->query("SELECT b.`Fname` , b.`Mname` ,b.`Lname`, b.`UserID` FROM `student&sectiontbl` as a left JOIN `accounttbl` as b on a.UIDStudent = b.userID WHERE `SectionId` = '$sectionId';");
                
                                        // Loop through the result set and display data in table row
                                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                            echo "<tr>";
                                            echo "<th scope='row'>" . $row['UserID'] . "</td>";
                                            echo "<td>" . $row['Fname'] . "</td>";
                                            echo "<td>" . $row['Mname'] . "</td>";
                                            echo "<td>". $row['Lname']."</td>";
                                            echo "</tr>";
                                        }
                                    } catch (PDOException $e) {
                                        echo "Connection failed: " . $e->getMessage();
                                    }
                                
                        echo   " </tbody>
                        </table>
                        <a href='Grouping.php?SecID=" .$higherrows['SectionID'] . "&Secname=". $higherrows['SectionName']."&course=".$higherrows['CourseID']."'><button >more</button></a> 
                </div>";
                            }

        ?>  
    </div>

</div>

</body>
</html>
