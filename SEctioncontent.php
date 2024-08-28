<?php
require_once 'verifier.php';

    if(!Verifyadmin()){
        header("Location: homepage.php");
        exit;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="css/custom2.css" rel="stylesheet">
    <link href="css/sidebar.css" rel="stylesheet">
    <title>Accounts</title>
</head>
<body>
<?php include 'modal/header.php'; ?>
<?php include 'modal/adminSidebar.php'; ?>
<div class="content">
    <div class="norDiv">
    <?php
                    $host = 'localhost';
                    $username = 'mine';
                    $password = 'pass';
                    $database = 'repository';
                    $dsn = "mysql:host=$host;dbname=$database;charset=utf8mb4";
                    $pdo = new PDO($dsn, $username, $password);
                        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Retrieve the value of 'data' from the URL parameter
$receivedSection = $_GET['section'];
$section = $pdo->query("SELECT * FROM `Sectionn&CapTeacherTBL` WHERE `SectionID` = $receivedSection;");
$secN = $section->fetch();
echo "<h1> " . $secN['SectionName'] ."</h1>";
?>

        <table class="table">
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">First</th>
                <th scope="col">Middle</th>
                <th scope="col">Last</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    // Database connection
                    

                    try {
                        

                        // Select data from the database
                        $stmt = $pdo->query("SELECT B.Fname,B.Mname,B.Lname,B.suffix FROM `Student&SectionTBL` AS A INNER JOIN AccountTBL AS B ON A.`UID` = B.UserID WHERE A.SectionId = $receivedSection;");
$number = 1;
                        // Loop through the result set and display data in table rows
                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            echo "<tr>";
                            echo "<th scope='row'>" . $number . "</td>";
                            echo "<td>" . $row['Fname'] . "</td>";
                            echo "<td>" . $row['Mname'] . "</td>";
                            echo "<td>" . $row['Lname'] . "</td>";
                            echo "</tr>";
                            $number++;
                        }
                    } catch (PDOException $e) {
                        echo "Connection failed: " . $e->getMessage();
                    }
                ?>
            </tbody>
        </table>
    </div>
    <h3>Add Student</h3>
    <form action="onestudent.php" method="post">
        
        <div class="input-group"><h6></h6>
        <input type="hidden" name="secID" value="<?php echo $receivedSection; ?>">
        <div class="form-floating mb-3 w-75">
            <input class="border border-primary form-control "type="text" id="UID" name="UID" placeholder="juan@gmail.com" required>
            <label for="UID">Student #</label>
        </div> 
        <h6></h6>
        </div>
        <button type="submit" class="btn btn-primary buttonclean" name="submit">Go</button>
    </form>

    <?php
    if (isset($_GET['error'])) {
        echo "<p style='color: red;'>Login failed. Please try again.</p>";
    }
    if (isset($_GET['tama'])) {
        echo "<p style='color: green;'>nasend</p>";
    }
    ?>
</div>
</body>
</html>
