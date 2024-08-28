<?php
// require_once 'backend/verifier.php';

//     if(!Verifyadmin()){
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
    <link href="css/custom2.css" rel="stylesheet">
    <link href="css/sidebar.css" rel="stylesheet">
    <title>Accounts</title>
</head>

<?php include 'modal/header.php'; ?>
<?php include 'modal/adminSidebar.php'; ?>

<div class="content">
<h2>Programs & Sections</h2>
<div class="SpecDiv">
   <h3> BSIT</h3>
   <table class="table">
            <thead>
                <tr>
                <th scope="col">UserID</th>
                <th scope="col">name</th>
                <th scope="col">Usertype</th>
                
                </tr>
            </thead>
            <tbody>
                <?php
                    // Database connection
                    $host = 'localhost';
                    $username = 'mine';
                    $password = 'pass';
                    $database = 'repository';
                    $dsn = "mysql:host=$host;dbname=$database;charset=utf8mb4";

                    try {
                        $pdo = new PDO($dsn, $username, $password);
                        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                        // Select data from the database
                        $stmt = $pdo->query("SELECT `Fname`,`Lname`,`Mname`,`Usertype`,`UserID` FROM AccountTBL ORDER BY `AccountTBL`.`Fname` ASC limit 15;");

                        // Loop through the result set and display data in table rows
                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            echo "<tr>";
                            echo "<th scope='row'>" . $row['UserID'] . "</td>";
                            echo "<td>" . $row['Fname'] . " " . $row['Mname'] . " " . $row['Lname']."</td>";
                            echo "<td>" . $row['Usertype'] . "</td>";
                            echo "<td> <a href='SEctioncontent.php'> More</a></td>";
                            echo "</tr>";
                        }
                    } catch (PDOException $e) {
                        echo "Connection failed: " . $e->getMessage();
                    }
                ?>  
            </tbody>
        </table>
</div>


</div>
<div class="norDiv  ">
  <a href="MakeStudent.php">
    <button class="btn btn-primary buttonclean">Add Account</button>
  </a>
  </div>

</div>
<body>
    


   
</body>
</html>
