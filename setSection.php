<?php
// require_once 'verifier.php';

//     if(!Verifyadmin()){
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="css/custom2.css" rel="stylesheet">
    <link href="css/sidebar.css" rel="stylesheet">
    <title>Make Section</title>
</head>
<body>
<?php include 'modal/header.php'; 
   
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
    <div class="sidebar">
<?php  include 'modal/adminSidebar.php';  ?>
    </div>
    <div class="main-content">
    <div class="SpecDiv">
            <h3>BSIT</h3>
            <table id="BSITTBL" class="table display">
                <thead>
                    <tr>
                        <th scope="col">Section</th>
                        <th scope="col">School YR</th>
                        <th scope="col">CapstoneTeacher</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Data will be populated here by DataTables -->
                </tbody>
            </table>
        </div>
       
        <?php 
                    } 
        catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
                                    }
        ?>




        <form id="CreateSection" method="POST" onsubmit="submitForm(event)">   
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
                        $sql = "SELECT `CourseID`, `CourseName` FROM `Coursetbl`;";
                        $result = $pdo->query($sql);
                        
                        if ($result) {
                            // Fetch rows as associative array
                            while ($row = $result->fetch(PDO::FETCH_ASSOC)) { 
                                $progID = $row['CourseID']; // Fixed quoting
                                $ProgramOption = $row['CourseName'];
                                
                                // Output the <option> element
                                echo "<option value='$progID'>$ProgramOption</option>";
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
                url: 'backend/fetch_predictions.php', // PHP script to fetch predictions
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
    <!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<!-- Initialization script -->
    <script>
    $(document).ready(function() {
        $('#BSITTBL').DataTable({
            "ajax": {
                "url": "backend/getsectionsAPI.php", // Your PHP file that returns JSON data
                "type": "GET",
                "dataSrc": ""
            },
            "columns": [
                { "data": "SectionName" },
                { "data": "SchoolYR"},
                { "data": "UID_Teacher" },
                { "data": null, "defaultContent": "<a href='SEctioncontent.php'>More</a>" }
            ]
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
    <script>

//makeStudent
document.getElementById('CreateSection').addEventListener('submit', function(event) {
event.preventDefault(); // Prevent the default form submission

// Create a FormData object from the form
var formData = new FormData(this);

// Send the form data to the PHP API using fetch
fetch('backend/setsectionapi.php', { // The URL of the PHP file that processes the form data
method: 'POST',
body: formData
})
.then(response => response.json()) // Parse the JSON response
.then(data => {
// Handle the response from the PHP API
if (data.success) {
    // Show success alert
    swal.fire({
        title: 'Success!',
        text: data.message,
        icon: 'success',
        confirmButtonText: 'OK'
    }).then(() => {
        // Clear the form inputs after closing the alert
        document.getElementById('CreateSection').reset();
    });
} else {
    // Show error alert
    swal.fire({
        title: 'Error!',
        text: data.message,
        icon: 'error',
        confirmButtonText: 'Try Again'
    });
}
})
.catch(error => {
// Handle any errors from the API or network
console.error('Error:', error);
swal.fire({
    title: 'Error!',
    text: error,
    icon: 'error',
    confirmButtonText: 'Try Again'
});
});
});</script>
</body>
</html>
