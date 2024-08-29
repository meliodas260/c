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
<?php include 'modal/header.php'; 
    include 'modal/adminSidebar.php'; 
    // Database connection
                    $host = 'localhost';
                    $username = 'mine';
                    $password = 'pass';
                    $database = 'repo';
                    $dsn = "mysql:host=$host;dbname=$database;charset=utf8mb4";

                    try {
                        $pdo = new PDO($dsn, $username, $password);
                        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                        
    
    
    ?>

<div class="content">
<h2>Programs & Sections</h2>
<?php 
$sqlsection = $pdo->query("SELECT `CourseID` FROM `CourseTBL` ORDER BY `CourseTBL`.`CourseID` DESC;");

                        // Loop through the result set and display data in table rows
                        while ($higherRow = $sqlsection->fetch(PDO::FETCH_ASSOC)) {
                            
                            $courseID = $higherRow['CourseID'];



                            echo  '<div class="SpecDiv">
                                <h3> '.$courseID.'</h3>
                                <table class="table">
                                            <thead>
                                                <tr>
                                                <th scope="col">Section</th>
                                                <th scope="col">School Yr</th>
                                                <th scope="col">CapstoneTeacher</th>
                                                
                                                </tr>
                                            </thead>
                                            <tbody>';
                                
                                                    

                                                        // Select data from the database
                                                        $stmt = $pdo->query("SELECT A.`SectionID`, A.`SectionName`, A.`CourseID` , A.`SchoolYR` , B.Fname, B.Mname , B.Lname , B.suffix FROM `Sectionn&CapTeacherTBL` as A 
                                                        INNER JOIN AccountTBL as B ON A.`UID_Teacher` = B.UserID WHERE `CourseID` ='$courseID' ORDER BY A.`SectionID` DESC;");

                                                        // Loop through the result set and display data in table rows
                                                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                                            echo "<tr>";
                                                            echo "<th scope='row'>" . $row['SectionName'] . "</td>";
                                                            echo "<td>" . $row['SchoolYR'] . "</td>";
                                                            echo "<td colspan='2'>" . $row['Fname'] . " " . $row['Mname'] . " " . $row['Lname'] . " " . $row['suffix'] ."</td>";
                                                        
                                                            $section = $row['SectionID'];
                                                            echo "<td> <a href='" . "SEctioncontent.php?section=" . urlencode($section) . "'> More</a></td>";
                                                            echo "</tr>";




                                                        }
                                                    
                                        
                                        echo    '</tbody>
                                        </table>
                                </div>';
   }} 
   catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
                            }
?>




<form  action="setsectionapi.php" method="post">   
<div class="relative">
        <h2>Create Section</h2>
        <div class="input-group">
        <div class="form-floating mb-3 w-50">
                        <input type="Text" class="border border-primary form-control " id="SectionName" name="SectionName" placeholder="name@example.com" required>
                        <label for="SectionName">SectionName</label><!--SectionName -->
        </div>
        <label for="Course"  class="mx-3"  > <b>Course</b> </label> <!--Course -->
        <select id="Course" name="Course" class="form-select w-25 mx-3  mb-3 ">
            <?php
                $conn = new mysqli("localhost", "mine", "pass", "repo");
            
                // Check connection
                if ($conn->connect_error) {
                    echo "error";
                }
                // SQL query to fetch data
                $sql = "SELECT CourseID FROM `CourseTBL`;";
                $result = $conn->query($sql);
                if ($result) {
                    // Fetch rows as associative array
                    while ($row = mysqli_fetch_assoc($result)) {
                        // Access the ProgramOption column value from the current row
                        $ProgramOption = $row['CourseID'];
                        
                        // Output the <option> element
                        echo "<option value=\"$ProgramOption\">$ProgramOption</option>";
                    }
            }
            ?>
</select>
        </div>
        <br>
        <div class="input-group">
        <div class="form-floating mb-3 w-50">
            <input class="border border-primary form-control "type="text" id="ResearchT" autocomplete="off" name="ResearchT" placeholder="juan" required> 
            <label for="ResearchT">Research Teacher ID #</label>
            <div id="prediction-container"></div><!--ResearchT -->
        </div>
        <div class="form-floating mb-3  w-25">
            <input class="border border-primary form-control"type="text"  id="SY" name="SY" placeholder="Mercado" > 
            <label for="SY">School Year</label><!--SY -->
        </div>  
        
        </div>
        <br><br>
        <div class="mx-10">
        <div id="input-container">
                <h3> Students</h3>
            
            <div class="input-group ">
                <h6></h6>
                <div class="form-floating mb-3 w-75">
                            <input type="text" class="border border-primary form-control " id="StudentID" name="StudentIDField[]" placeholder="name@example.com" required>
                            <label for="StudentID">Student #</label><!--StudentID -->
                </div>  
                <button type="button" class="add-input btn btn-primary btn-lg mb-3 ">+</button>

            </div>
        </div>

        </div>
        <button type="submit" class="btn btn-primary buttonclean">Submit</button>
    </form>

    


</div>

 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script> $(document).ready(function() {
        const inputField = $('#ResearchT');
        const predictionContainer = $('#prediction-container');
    
        // Event listener for input field
        inputField.on('input', function() {
            const inputValue = inputField.val().toLowerCase();
    
            // AJAX request to fetch predictions
            $.ajax({
                url: 'fetch_predictions.php', // PHP script to fetch predictions
                method: 'POST',
                data: { input: inputValue },
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
    
        // Hide predictions when clicking outside the input field
        $(document).on('click', function(event) {
            if (!inputField.is(event.target) && !predictionContainer.is(event.target) && predictionContainer.has(event.target).length === 0) {
                predictionContainer.hide();
            }
        });
    });

    document.addEventListener('DOMContentLoaded', function() {
            const inputContainer = document.getElementById('input-container');
            const addButton = document.querySelector('.add-input');
            let inputCount = 1;

            addButton.addEventListener('click', function() {
                const newInputGroup = document.createElement('div');    
                newInputGroup.classList.add('input-group');
                newInputGroup.innerHTML = `
                <h6></h6>
                <div class="form-floating mb-3 w-75">
                            <input type="text" class="border border-primary form-control " id="StudentID" name="StudentIDField[]" placeholder="name@example.com" required>
                            <label for="StudentID">StudentID</label><!--StudentID -->
                </div> 
                    <button type="button" class="remove-input btn btn-primary btn-lg mb-3 ">-</button>
                `;
                inputContainer.appendChild(newInputGroup);
                inputCount++;

                const removeButtons = document.querySelectorAll('.remove-input');
                removeButtons.forEach(function(button) {
                    button.addEventListener('click', function() {
                        newInputGroup.remove();
                    });
                });
            });
        });
    </script>
        <h3>Upload Section in Excel</h3>
        <br>
        <form action="adminaccessApi.php" method="post" enctype="multipart/form-data">
            <label for="excel_file">Upload Excel File:</label>
            <input type="file" name="excel_file" id="excel_file" accept=".xls,.xlsx">
            <br>
            <button type="submit" class="btn btn-primary buttonclean" name="submit">Upload</button>
        </form>
</body>
</html>
