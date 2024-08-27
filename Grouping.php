<?php
require_once 'verifier.php';

    if(!VerifyCApT()){
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
<?php include 'header.php'; 
    include 'CapTSidebar.php'; 
    $secID = $_GET['SecID'];
    $secname = $_GET['Secname'];
    $course = $_GET['course'];
    
    ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        function setupPrediction(inputFieldID, predictionContainerID) {
            const inputField = $('#' + inputFieldID);
            const predictionContainer = $('#' + predictionContainerID);

            inputField.on('input', function() {
                const inputValue = inputField.val().toLowerCase();

                $.ajax({
                    url: 'fetch_predictions1.php',
                    method: 'POST',
                    data: { input: inputValue , secid : <?php echo $secID; ?>},
                    dataType: 'json',
                    success: function(predictions) {
                        if (predictions.length > 0) {
                            predictionContainer.html('');
                            predictions.forEach(prediction => {
                                const predictionElement = $('<div>').text(prediction);
                                predictionElement.on('click', function() {
                                    inputField.val(prediction);
                                    predictionContainer.hide();
                                });
                                predictionContainer.append(predictionElement);
                            });
                            predictionContainer.show();
                        } else {
                            predictionContainer.hide();
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error fetching predictions:', error);
                    }
                });
            });

            $(document).on('click', function(event) {
                if (!inputField.is(event.target) && !predictionContainer.is(event.target) && predictionContainer.has(event.target).length === 0) {
                    predictionContainer.hide();
                }
            });
        }
        function teacher(inputFieldID, predictionContainerID) {
            const inputField = $('#' + inputFieldID);
            const predictionContainer = $('#' + predictionContainerID);

            inputField.on('input', function() {
                const inputValue = inputField.val().toLowerCase();

                $.ajax({
                    url: 'fetch_predictions.php',
                    method: 'POST',
                    data: { input: inputValue},
                    dataType: 'json',
                    success: function(predictions) {
                        if (predictions.length > 0) {
                            predictionContainer.html('');
                            predictions.forEach(prediction => {
                                const predictionElement = $('<div>').text(prediction);
                                predictionElement.on('click', function() {
                                    inputField.val(prediction);
                                    predictionContainer.hide();
                                });
                                predictionContainer.append(predictionElement);
                            });
                            predictionContainer.show();
                        } else {
                            predictionContainer.hide();
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error fetching predictions:', error);
                    }
                });
            });

            $(document).on('click', function(event) {
                if (!inputField.is(event.target) && !predictionContainer.is(event.target) && predictionContainer.has(event.target).length === 0) {
                    predictionContainer.hide();
                }
            });
        }

        $(document).ready(function() {
            
            
            teacher('Advicer', 'Advicer_pre');
            teacher('Expert', 'Expert_pre');
            teacher('Panel1', 'Panel1_pre');
            teacher('Panel2', 'Panel2_pre');
            teacher('Panel3', 'Panel3_pre');
            // Call the function for the first input field and prediction container
            setupPrediction('Leader', 'prediction1');

            // Call the function for the second input field and prediction container
            setupPrediction('Member1', 'Member1_pre');
            setupPrediction('Member2', 'Member2_pre');
            setupPrediction('Member3', 'Member3_pre');
        });
    </script>

<body>
<div class="content">
<h2>Sections</h2>


<div class="SpecDiv">
   <h3><?php echo $secname;?></h3>
   <table class="table">
            <thead>
                <tr>
                <th scope="col">Student #</th>
                <th scope="col">First</th>
                <th scope="col">Middle</th>
                <th scope="col">Last</th>
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
                        $stmt = $pdo->query("SELECT b.UserID, b.Fname, b.Mname ,b.Lname ,b.suffix FROM `Student&SectionTBL` a INNER JOIN `AccountTBL` b on a.UID = b.UserID WHERE `SectionId` = '$secID';");

                        // Loop through the result set and display data in table rows
                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) { 
                            echo "<tr>";
                            echo "<th scope='row'>" . $row['UserID'] . "</td>";
                            echo "<td>" . $row['Fname'] . "</td>";
                            echo "<td>" . $row['Mname'] . "</td>";
                            echo "<td> ". $row['Lname']."</td>";
                            echo "</tr>";
                        }
                    } catch (PDOException $e) {
                        echo "Connection failed: " . $e->getMessage();
                    }
                ?>
            </tbody>
        </table>
        </div>
       
        

        <form  action="groupingsapi.php" method="post">
        <input type="hidden" id="SecNumber" name="SecNumber" value="<?php echo $secID; ?>">
        <input type="hidden" id="course"  name="course" value="<?php echo $course; ?>">
        <h2>Research roles</h2>
        <div class="input-group">
            <h3></h3>
        <div class="form-floating mb-3 w-50">
             <input class="border border-primary form-control"type="text" autocomplete="off" id="Leader" name="Leader" placeholder="Sr./Jr." > <!--suffix -->
            <label for="Leader">Leader</label>
            <div id="prediction1" class="prediction-container"  style="display: none;"></></div>
        </div>
        
        <h3></h3>
        </div>
        <div class="input-group">
            <h3></h3>
        <div class="form-floating mb-3 w-50">
             <input class="border border-primary form-control"type="text" autocomplete="off" id="Member1" name="Member1" placeholder="Sr./Jr." > <!--suffix -->
            <label for="Member1">Member1</label>
            <div id="Member1_pre" class="prediction-container"  style="display: none;"></></div>
        </div>  
        
        <h3></h3>
        </div>
        <div class="input-group">
            <h3></h3>
        <div class="form-floating mb-3 w-50">
             <input class="border border-primary form-control"type="text" autocomplete="off" id="Member2" name="Member2" placeholder="Sr./Jr." > <!--suffix -->
            <label for="Member2">Member2</label>
            <div id="Member2_pre" class="prediction-container"  style="display: none;"></></div>
        </div>  
        <h3></h3>
        </div>
        <div class="input-group">
            <h3></h3>
        <div class="form-floating mb-3 w-50">
             <input class="border border-primary form-control"type="text" autocomplete="off" id="Member3" name="Member3" placeholder="Sr./Jr." > <!--suffix -->
            <label for="Member3">Member3</label>
            <div id="Member3_pre" class="prediction-container"  style="display: none;"></></div>
        </div>  
        <h3></h3>
        </div>
        <div class="input-group">
        
            <div class="form-floating mb-3">
                <input class="border border-primary form-control"type="text" autocomplete="off" id="Advicer" name="Advicer" placeholder="Sr./Jr." > <!--suffix -->
                <label for="Advicer">Adviser</label>
                <div id="Advicer_pre" class="prediction-container"  style="display: none;"></></div>
            </div>  
            <div class="form-floating mb-3 ">
                <input class="border border-primary form-control"type="text" autocomplete="off" id="Expert" name="Expert" placeholder="Sr./Jr." > <!--suffix -->
                <label for="Expert">Expert</label>
                <div id="Expert_pre" class="prediction-container"  style="display: none;"></></div>
                </div>
                
        </div>
        <div class="input-group">
        <div class="form-floating mb-3">
                <input class="border border-primary form-control"type="text" autocomplete="off" id="Panel1" name="Panel1" placeholder="Sr./Jr." > <!--suffix -->
                <label for="Panel1">Panel 1</label>
                <div id="Panel1_pre" class="prediction-container"  style="display: none;"></></div>
            </div>  
            <div class="form-floating mb-3">
                <input class="border border-primary form-control"type="text" autocomplete="off" id="Panel2" name="Panel2" placeholder="Sr./Jr." > <!--suffix -->
                <label for="Panel2">Panel 2</label>
                <div id="Panel2_pre" class="prediction-container"  style="display: none;"></></div>
            </div>
                <div class="form-floating mb-3">
                    <input class="border border-primary form-control"type="text" autocomplete="off" id="Panel3" name="Panel3" placeholder="Sr./Jr." > <!--suffix -->
                    <label for="Panel3">Panel 3</label>
                    <div id="Panel3_pre" class="prediction-container"  style="display: none;"></></div>
                </div>  
              
            </div>
            <br>
        <button type="submit" class="btn btn-primary buttonclean">Submit</button>
    </form>


    <div class="norDiv">
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
                        $ResearchSql = $pdo->query("SELECT a.`ResearchID` FROM `ResearchTBL` a WHERE `Section` = '7';");
                        // Loop through the result set and display data in table rows
                        while ($row = $ResearchSql->fetch(PDO::FETCH_ASSOC)) { 
                            echo "<div class='norDiv'>";
                            echo "<h3>" .$row['ResearchID'] ."</h3>";
                           $ResID = $row['ResearchID'];
                           $ResearcherSql = $pdo->query("SELECT * FROM `ResearchTBL` a LEFT JOIN `ResearchRoleTBL` b on a.ResearchID = b.ResearchID left JOIN `AccountTBL` c on b.UID = c.UserID WHERE `Section` = '$secID' and b.ResearchID ='$ResID';");
                        
                        while ($rowlower = $ResearcherSql->fetch(PDO::FETCH_ASSOC)) { 
                            echo " <h4>".$rowlower['Email']."\n".$rowlower['Role']."</h4>";

                        }
                        echo "</div>";
                        }
                    } catch (PDOException $e) {
                        echo "Connection failed: " . $e->getMessage();
                    }
                ?>

        </div>
<?php 
$sqlsection = $pdo->query("SELECT * FROM `ResearchTBL` WHERE `Section` = '$secID'");

                        // Loop through the result set and display data in table rows
                        while ($higherRow = $sqlsection->fetch(PDO::FETCH_ASSOC)) {
                            
                            $ResearchID = $higherRow['ResearchID'];
                            $ResearchName = $higherRow['Title'];


                            echo  '<div class="SpecDiv">
                            <h3> '.$ResearchName.'</h3>
                                <h4> '.$ResearchID.'</h4>
                                
                                <table class="table table-borderless">
                                            <thead>
                                                <tr>
                                                <th scope="col">Student #</th>
                                                <th scope="col">Name</th>
                                                <th scope="col">Role</th>
                                                
                                                </tr>
                                            </thead>
                                            <tbody>';
                                
                                                    

                                                        // Select data from the database
                                                        $stmt = $pdo->query("SELECT a.*, b.Fname, b.Lname ,b.Mname, b.suffix ,b.UserID FROM `ResearchRoleTBL` a INNER JOIN AccountTBL b on a.`UID` = b.UserID WHERE `ResearchID` ='$ResearchID'");

                                                        // Loop through the result set and display data in table rows
                                                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                                            echo "<tr>";
                                                            echo "<th scope='row'>" . $row['UserID'] . "</td>";
                                                            echo "<td>" . $row['Fname'] . " " . $row['Mname'] . " " . $row['Lname'] . " " . $row['suffix'] . "</td>";
                                                            echo "<td colspan='2'>" . $row['Role'] ."</td>";
                                                        
                                                            $section = $row['SectionID'];

                                                            echo "</tr>";




                                                        }
                                                    
                                        
                                        echo    '</tbody>
                                        </table>
                                </div>';
   }
?>
</div>
</body>
</html>
