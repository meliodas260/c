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
<style>
        .content {
    display: flex;
    width: 100%;
    flex-wrap: wrap;
}

.sidebar {
    flex: 0 0 20%;
    background-color: #8d2424; /* Optional: Add background color to distinguish */
}

.main-content {
    flex: 0 0 70%;
    background-color: #ffffff; /* Optional: Add background color to distinguish */
}
    </style>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="css/custom2.css" rel="stylesheet">
    <link href="css/sidebar.css" rel="stylesheet">
    <title>Accounts</title>
</head>

<?php include 'modal/header.php'; ?>

<body>
<div class="content">
    <div class="sidebar">
        <?php include 'modal/CapTSidebar.php'; ?>
    </div>
    <div class="main-content">
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
                            echo $emails;
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
