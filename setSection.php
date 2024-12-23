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
    position:sticky;
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
    <link href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="css/custom2.css" rel="stylesheet">
    <link href="css/sidebar.css" rel="stylesheet">
    <link href="css/datatable.css" rel="stylesheet">
    <title>Make Section</title>
</head>
<body>
<?php include 'modal/header.php'; 

    
    ?>

<div class="content">
    <div class="sidebar">
<?php  include 'modal/adminSidebar.php';  ?>
    </div>
    <div class="main-content">

    <br>

<div id="courseTables"></div>





        <form id="CreateSection" method="POST" onsubmit="submitForm(event)">   
        <div class="relative">
                <h2>Create Section</h2>
                <div class="input-group">
                <div class="form-floating mb-3 w-50">
                                <input type="Text" class="border border-primary form-control " id="SectionName" name="SectionName" placeholder="name@example.com" required>
                                <label for="SectionName">SectionName</label><!--SectionName -->
                </div>
                <label for="Course" class="mx-3"><b>Course</b></label> <!-- Course -->
<select id="Coursea" name="Course" class="form-select w-25 mx-3 mb-3"></select>

                    
        </select>
                </div>
                <br>
                <div class="input-group">
                <div class="form-floating mb-3 w-50">
                    <input class="border border-primary form-control "type="text" id="ResearchT" autocomplete="off" name="ResearchT" placeholder="juan" required> 
                    <label for="ResearchT">Research Teacher Name</label>
                    <div id="prediction-container"></div><!--ResearchT -->
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

            <h3>Upload Section in Excel</h3>
        <br>
        <form action="backend/CreateSectionFileupload.php" method="post" enctype="multipart/form-data">
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="card">
                    <div class="card-header">
                        <h4>Upload Excel File</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="excel_file">Upload Excel File:</label>
                            <input type="file" name="excel_file" id="excel_file" accept=".xls,.xlsx" class="form-control" required>
                        </div>
                    </div>
                    <div class="card-footer text-center">
                        <button type="submit" class="btn btn-primary" name="submit">Upload</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>



    </div>                    
</div>
<script>
document.addEventListener('DOMContentLoaded', async function () {
    try {
        const response = await fetch('backend/setsectionapi.php', { method: 'GET' });
        const data = await response.json();
        const selectElement = document.getElementById('Coursea');

        // Check if data.CourseTypes is an array
        if (Array.isArray(data.CourseTypes) && Array.isArray(data.CourseValues)) {
            data.CourseTypes.forEach((courseType, index) => {
                const option = document.createElement('option');
                option.value = data.CourseValues[index]; // Values from the API
                option.textContent = courseType;         // Course names from the API
                selectElement.appendChild(option);
            });
        } else {
            console.error("Failed to fetch course types:", data.error);
        }
    } catch (error) {
        console.error('Error fetching course data:', error);
    }
});

    </script>
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script> 
    $(document).ready(function() {
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
                    predictionContainer.html(''); // Clear previous predictions
                    predictions.forEach(prediction => {
                        const predictionElement = $('<div>')
                            .text(prediction.Fullname) // Only display the Fullname
                            .addClass('prediction-item') // Optional: Add a class for styling
                            .on('click', function() {
                                inputField.val(prediction.Fullname); // Set input value to selected Fullname
                                predictionContainer.hide();
                            });
                        predictionContainer.append(predictionElement); // Append the prediction element
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
        if (!inputField.is(event.target) && 
            !predictionContainer.is(event.target) && 
            predictionContainer.has(event.target).length === 0) {
            
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
$(document).ready(function () {
    // Function to initialize a DataTable for a given CourseID and CourseAcronym
    function initializeTable(courseID, courseAcronym) {
        // Create a unique table for the CourseID
        const tableID = `courseTable_${courseID}`;
        const tableHTML = `
        <div class="norDiv" >
            <h3>Course: ${courseAcronym}</h3>
            <table id="${tableID}" class="display" style="width:100%">
                <thead>
                    <tr>
                        <th>Section Name</th>
                        <th>Teacher Name</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
        <br>
        `;
        $('#courseTables').append(tableHTML);

        // Initialize DataTable for the specific CourseID
        $(`#${tableID}`).DataTable({
            "ajax": {
                "url": "backend/getsectionsAPI.php",
                "type": "GET",
                "data": { CourseID: courseID }, // Send CourseID as a query parameter
                "dataSrc": ""
            },
            "columns": [
                { "data": "SectionName" },
                { "data": "Fullname" },
                {
                    "data": null,
                    "render": function (data, type, row) {
                        return `<button class='btn-more' data-sectionid='${row.SectionID}'>More</button>`;
                    }
                }
            ]
        });

        // Attach event listener for "More" buttons inside this table
        $(`#${tableID} tbody`).on('click', '.btn-more', function () {
            const sectionID = $(this).attr('data-sectionid'); // Get sectionID
            // Redirect to SEctioncontent.php with sectionID as query parameter
            window.location.href = `SEctioncontent.php?sectionID=${sectionID}`;
        });
    }

    // Fetch course list and initialize tables
    $.ajax({
        url: "backend/getcoursesAPI.php", // Your API endpoint for fetching course data
        type: "GET",
        success: function (data) {
            if (typeof data === "string") {
                data = JSON.parse(data); // Parse string response if needed
            }

            // For each course, create a table
            data.forEach(course => {
                initializeTable(course.CourseID, course.CourseAcronym); // Pass CourseAcronym
            });
        },
        error: function (xhr, status, error) {
            console.error("Error fetching course data:", error);
        }
    });
});
</script>





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
    });
    </script>
</body>
</html>
