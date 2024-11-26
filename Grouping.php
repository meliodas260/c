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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css">
    <link href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="css/custom2.css" rel="stylesheet">
    <link href="css/sidebar.css" rel="stylesheet">
    <title>Accounts</title>
    <style>        /* Modal background */
    

        .read-more {
            display: inline-block;
            padding: 8px 12px;
            margin-top: 10px;
            background-color: #6795c9;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            font-weight: bold;
        }

        .read-more:hover {
            background-color: #1060c9;
            color:white;
        }  
        .flexer {
            padding-top:2rem;
            display: flex;
            flex-wrap: wrap;
        }

        .half {
            flex: 1; /* Each child will take up equal space */
            padding: 10px;
            box-sizing: border-box; /* Include padding in the width */
        }

        .left {
            background-color: lightblue;
        }

        .right {
            background-color: lightcoral;
        }

        /* Responsive adjustments */
        @media screen and (max-width: 600px) {
            
            .half {
            
                flex: 1 1 100%;
            
            }
            #research-container {
                flex-direction: column;
                align-items: center;
            }
            
            .research-card {
                width: 100%;
                max-width: 500px;
            }
        }
        

</style>
</head>
<?php include 'modal/header.php'; 
   
    $secID = $_GET['SecID'];
    $secname = $_GET['Secname'];
    $course = $_GET['course'];
    ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
       function setupPrediction(inputFieldID, predictionContainerID, secID) {
    const inputField = $('#' + inputFieldID);
    const predictionContainer = $('#' + predictionContainerID);

    inputField.on('input', function () {
        const inputValue = inputField.val().toLowerCase();

        $.ajax({
    url: 'backend/fetch_predictions.php',
    method: 'POST',
    data: { input: inputValue, secid: secID }, // Pass secID dynamically
    dataType: 'json',
    success: function (predictions) {
        if (predictions.length > 0) {
            predictionContainer.html(''); // Clear previous predictions
            predictions.forEach(prediction => {
                // Use Fullname if available, fallback to UserID
                const displayText = prediction.Fullname ? prediction.Fullname : prediction.UserID;

                const predictionElement = $('<div>')
                    .text(displayText) // Display Fullname or UserID
                    .addClass('prediction-item') // Optional: Add a class for styling
                    .on('click', function () {
                        inputField.val(displayText); // Set the selected value
                        predictionContainer.hide(); // Hide container after selection
                    });

                predictionContainer.append(predictionElement);
            });

            predictionContainer.show(); // Show container if predictions are available
        } else {
            predictionContainer.hide(); // Hide container if no predictions
        }
    },
    error: function (xhr, status, error) {
        console.error('Error fetching predictions:', error);
    }
});

    });

    // Hide the prediction container when clicking outside
    $(document).on('click', function (event) {
        if (!inputField.is(event.target) &&
            !predictionContainer.is(event.target) &&
            predictionContainer.has(event.target).length === 0) {
            predictionContainer.hide();
        }
    });
}

$(document).ready(function () {
    const secID = <?php echo $secID; ?>; // Pass secID dynamically from PHP

    // Call setupPrediction for each field
    setupPrediction('Leader', 'prediction1', secID);
    setupPrediction('Member1', 'Member1_pre', secID);
    setupPrediction('Member2', 'Member2_pre', secID);
    setupPrediction('Member3', 'Member3_pre', secID);
});

    </script>

<body>
<div class="content">
    <div class="sidebar">
        <?php  include 'modal/CapTSidebar.php'; ?>
    </div>
    <div class="main-content">
<h2>Sections</h2>


<div class="SpecDiv">
   <h3><?php echo $secname;?></h3>
   <table class="table" id="sectionStud">
            <thead>
                <tr>
                <th scope="col">USER ID</th>
                <th scope="col">Student Name</th>
                <th scope="col">Middle</th>
                </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
        </div>
       <!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<!-- Initialization script -->
<!-- Hidden field to store the PHP variable -->
<input type="hidden" id="phpVar" value="<?php echo $secID; ?>">

<script>
$(document).ready(function() {
    $('#sectionStud').DataTable({
        "ajax": {
            "url": "sectionStudapi.php",
            "type": "GET",
            "data": function(d) {
                // Retrieve the value of the hidden input field
                d.secID = $('#phpVar').val();
            },
            "dataSrc": ""
        },
        "columns": [
            { "data": "UserID" },
            { "data": function(row) {
                return row.Fname + " " + row.Mname + " " + row.Lname;
            }},
            { "data": null, "defaultContent": "<a href='SEctioncontent.php'>More</a>" }
        ]
    });
});
</script>

        

    <form id="Createrole" method="POST" onsubmit="submitForm(event)">
        <input type="hidden" id="SecNumber" name="SecNumber" value="<?php echo $secID; ?>">
        <input type="hidden" id="course"  name="course" value="<?php echo $course; ?>">
        
        <div class="relative"> 
            <h2>Research info</h2>
            <h5><b>RESEARCH TITLE </b></h5>
            <div class="input-group centerer" style="padding-left:15%; padding-right:15%; ">
               <input class="border border-primary text-center" type="text" id="Title" name="Title" value= "" required>
            </div>
            <BR></BR>
            <h5><b>RESEARCH ABSTRACT</b></h5>

            <div class="mb-3 centerer"style="padding-left:15%; padding-right:15%;">
            <textarea class="form-control border border-primary"   id="exampleFormControlTextarea1" name="Abstract" rows="3"></textarea>
            </div>
        </div>     
        <h2>Research roles</h2>
        <div class="form-floating mb-3 w-50">
                <!-- Leader Dropdown -->
            <div class="form-floating mb-3">
                <select id="leaderDropdown" name="leader" class="form-control" required>
                    <option value="" disabled selected>Select Leader</option>
                </select>
                <input type="hidden" name="Leader"id="leaderHidden" value="3">
                <label for="leaderDropdown">Leader</label>
            </div>

                <!-- Members Section -->
            <div id="membersContainer">
                <!-- Member Dropdowns will be added here dynamically -->
            </div>
<!-- Button to Add Member -->
<button type="button" id="addMemberBtn" class="btn btn-primary">Add Member</button>

        <h3></h3>
        </div>
            <br>
            <h2>Table Input Form with Fixed Columns and Dynamic Rows</h2>


        <?php
// Fetch roles from the database
require 'backend/dblogin.php';

try {
    $stmt = $pdo->query("SELECT RoleID, RoleName FROM roletbl where `Usertype` <> 2;");
    $roles = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Error: " . $e->getMessage());
}
?>

<table id="inputTable">
    <thead>
        <tr>
            <th>Teacher Name</th>
            <th>Role</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>
                <input id="Teacher_0" type="text" name="teacherName[]" required>
                <div id="PredictTeacher_0" class="prediction-container" style="display: none;"></div>
            </td>
            <td>
                <select name="role[]" required>
                    <option value="" disabled selected>Select Role</option>
                    <?php foreach ($roles as $role): ?>
                        <option value="<?php echo htmlspecialchars($role['RoleID']); ?>">
                            <?php echo htmlspecialchars($role['RoleName']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </td>
        </tr>
    </tbody>
</table>
<button type="button" id="addRowButton">+ Add Row</button>





            <br>
            <div class="d-flex justify-content-center text-center">
                <div id="input-container">
                    Keywords
                    <div class="input-group px-2 ">
                        <input type="text" name="inputField[]" placeholder="Enter something">
                        <button type="button" class="add-input">+</button>
                    </div>
                </div>
                <div id="input-container2">
                    Tags
                    <div class="input-group px-2 ">
                        <input type="text" name="tags[]" placeholder="Enter something">
                        <button type="button" class="add-tags">+</button>
                    </div>
                </div>
            </div>
        <button type="submit" class="btn btn-primary buttonclean">Submit</button>
    </form>


 

<script>
document.addEventListener('DOMContentLoaded', function () {
    const secID = document.getElementById('phpVar').value; // Hidden input for secID
    const leaderDropdown = document.getElementById('leaderDropdown');
    const membersContainer = document.getElementById('membersContainer');
    const addMemberBtn = document.getElementById('addMemberBtn');

    let memberCount = 0; // Limit members to 4
    let students = []; // Store all student data

    // Fetch students from API
    async function fetchStudents() {
        try {
            const response = await fetch(`sectionStudApi?secID=${secID}`);
            const data = await response.json();
            if (data && data.length > 0) {
                // Filter students where RoleConnectorKey is null
                students = data.filter(student => !student.RoleConnectorKey);
                populateDropdown(leaderDropdown, students);
            } else {
                Swal.fire('Error', 'No students found for the selected section.', 'error');
            }
        } catch (error) {
            console.error('Error fetching students:', error);
            Swal.fire('Error', 'Failed to load student data.', 'error');
        }
    }

    // Populate dropdown with student data
    function populateDropdown(dropdown, studentList) {
        dropdown.innerHTML = '<option value="" disabled selected>Select</option>'; // Reset dropdown
        studentList.forEach(student => {
            const option = document.createElement('option');
            option.value = `${student.Fname} ${student.Mname} ${student.Lname}`;
            option.textContent = `${student.Fname} ${student.Mname} ${student.Lname}`;
            dropdown.appendChild(option);
        });
    }

    // Add a new member dropdown with a hidden input
    function addMemberDropdown() {
        if (memberCount >= 4) {
            Swal.fire('Warning', 'You can only add up to 4 members.', 'warning');
            return;
        }

        memberCount++;
        const memberDiv = document.createElement('div');
        memberDiv.className = 'form-floating mb-3';
        memberDiv.innerHTML = `
            <select id="memberDropdown${memberCount}" name="members[]" class="form-control" required>
                <option value="" disabled selected>Select Member</option>
            </select>
            <input type="hidden" name="MemberRole" id="memberHidden${memberCount}" value="5">
            <label for="memberDropdown${memberCount}">Member ${memberCount}</label>
        `;

        membersContainer.appendChild(memberDiv);

        const memberDropdown = document.getElementById(`memberDropdown${memberCount}`);
        populateDropdown(memberDropdown, students); // Populate without excluding selections
    }

    // Add event listener for Add Member button
    addMemberBtn.addEventListener('click', addMemberDropdown);

    // Fetch students and populate leader dropdown on page load
    fetchStudents();
});
</script>


    
<script>
    // // Use event delegation or make sure the button exists when this runs
    // document.querySelectorAll('.btn-more').forEach(button => {
    //     button.addEventListener('click', function() {
    //         // Get the ResearchID from the button's data-id attribute
    //         var researchID = this.getAttribute('data-id');
            
    //         // Redirect to the URL with ResearchID as a query parameter
    //         window.location.href = 'uploadfile.php?ResearchID=' + researchID;
    //     });
    // });
</script>
<?php
                    //     echo "</div>";
                    //     }
                    // } catch (PDOException $e) {
                    //     echo "Connection failed: " . $e->getMessage();
                    // }
                ?>



</div>
<script>
    $(document).ready(function () {
        // Initialize prediction setup for the first row
        setupPredictionT('#Teacher_0', '#PredictTeacher_0');
    });

    // Ensure the event listener for the add row button is added once the DOM is loaded
    document.addEventListener('DOMContentLoaded', function () {
        const addRowButton = document.getElementById('addRowButton');
        if (addRowButton) {
            addRowButton.onclick = addRow;
        }
    });

    function addRow() {
        const table = document.getElementById('inputTable').getElementsByTagName('tbody')[0];
        const rowCount = table.rows.length;
        const newRow = table.insertRow();

        // Teacher Name Input
        const cell1 = newRow.insertCell(0);
        const teacherInput = document.createElement('input');
        teacherInput.type = 'text';
        teacherInput.name = 'teacherName[]';
        teacherInput.id = `Teacher_${rowCount}`;
        teacherInput.required = true;
        cell1.appendChild(teacherInput);

        const predictionContainer = document.createElement('div');
        predictionContainer.id = `PredictTeacher_${rowCount}`;
        predictionContainer.className = 'prediction-container';
        predictionContainer.style.display = 'none';
        cell1.appendChild(predictionContainer);

        // Role Dropdown
        const cell2 = newRow.insertCell(1);
        const roleSelect = document.createElement('select');
        roleSelect.name = 'role[]';
        roleSelect.required = true;

        const defaultOption = document.createElement('option');
        defaultOption.value = '';
        defaultOption.text = 'Select Role';
        defaultOption.disabled = true;
        defaultOption.selected = true;
        roleSelect.appendChild(defaultOption);

        // Loop through roles and create the option elements
        <?php foreach ($roles as $role): ?>
            // Declare roleOption inside the loop
            var roleOption = document.createElement('option');
            roleOption.value = "<?php echo htmlspecialchars($role['RoleID']); ?>";
            roleOption.text = "<?php echo htmlspecialchars($role['RoleName']); ?>";
            roleSelect.appendChild(roleOption);
        <?php endforeach; ?>

        cell2.appendChild(roleSelect);

        // Initialize prediction setup for the newly added row
        setupPredictionT(`#Teacher_${rowCount}`, `#PredictTeacher_${rowCount}`);
    }

    function setupPredictionT(inputFieldSelector, predictionContainerSelector) {
        const inputField = $(inputFieldSelector);
        const predictionContainer = $(predictionContainerSelector);

        inputField.on('input', function () {
            const inputValue = inputField.val().toLowerCase();

            $.ajax({
                url: 'backend/fetch_predictions.php',
                method: 'POST',
                data: { input: inputValue },
                dataType: 'json',
                success: function (predictions) {
                    if (predictions.length > 0) {
                        predictionContainer.html(''); // Clear previous predictions
                        predictions.forEach(prediction => {
                            const displayText = prediction.Fullname || prediction.UserID;

                            const predictionElement = $('<div>')
                                .text(displayText)
                                .addClass('prediction-item')
                                .on('click', function () {
                                    inputField.val(displayText);
                                    predictionContainer.hide();
                                });

                            predictionContainer.append(predictionElement);
                        });

                        predictionContainer.show();
                    } else {
                        predictionContainer.hide();
                    }
                },
                error: function (xhr, status, error) {
                    console.error('Error fetching predictions:', error);
                }
            });
        });

        // Hide predictions when clicking outside
        $(document).on('click', function (event) {
            if (!inputField.is(event.target) &&
                !predictionContainer.is(event.target) &&
                predictionContainer.has(event.target).length === 0) {
                predictionContainer.hide();
            }
        });
    }
</script>
<section id="research-container"> 
</section>

<script>
const secID = <?php echo json_encode($secID); ?>;

function fetchResearchFiles(secID) {
    $.ajax({
        url: 'backend/Researchdata.php',
        type: 'POST',
        data: { SecID: secID }, // Ensure this matches the PHP expectation
        success: function(response) {
            const container = document.getElementById('research-container');
            container.innerHTML = ''; // Clear previous content

            // Check if response contains valid data
            if (Array.isArray(response)) {
                response.forEach(item => {
                    const authors = item.Researchers.map(res => `${res.name} (${res.role})`).join(', ');
                    addResearchCard(item.ID,item.Title, authors, item.Year, item.Description, item.ImageUrl);
                });
            } else {
                console.error('Invalid response format:', response);
            }
        },
        error: function(xhr, status, error) {
            console.error('AJAX Error:', error);
        }
    });
}

fetchResearchFiles(secID);

function addResearchCard(ID,title, authors, year, description, imageUrl) {
    const container = document.getElementById('research-container');
    const card = document.createElement('div');
    card.className = 'research-card';
    const imageSrc = imageUrl === '' ? 'img/neust_logo.png' : 'UploadIMG/' + imageUrl;

    card.innerHTML = `
        <img src="${imageSrc}" alt="Research Image" class="research-image">
        <h2 class="research-title">${title}</h2>
        <p class="research-author">Authors: ${authors}</p>
        <p class="research-year">Year: ${year}</p>
        <p class="research-description">${description}</p>
        <a href="ResearchINfo?researchID=${ID}&secID=${secID}" class="read-more">Read More</a>
    `;
    container.appendChild(card);
}
</script>







<script>
document.getElementById('Createrole').addEventListener('submit', function(event) {
    event.preventDefault(); // Prevent the default form submission

    // Create a FormData object from the form
    var formData = new FormData(this);

    // Log the FormData to the console to inspect it
    formData.forEach(function(value, key) {
        console.log(key + ": " + value);
    });

    // Send the form data to the PHP API using fetch
    fetch('backend/groupingsapi.php', {
        method: 'POST',
        body: formData
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json(); // Parse the JSON response
    })
    .then(data => {
        console.log('Success:', data);
        if (data.success) {
            Swal.fire({
                title: 'Success!',
                text: data.message,
                icon: 'success',
                confirmButtonText: 'OK'
            }).then(() => {
                document.getElementById('Createrole').reset(); // Reset form after success
            });
        } else {
            Swal.fire({
                title: 'Error!',
                text: data.message,
                icon: 'error',
                confirmButtonText: 'Try Again1'
            });
        }
    })
    .catch(error => {
        console.error('Error:', error);
        Swal.fire({
            title: 'Error!',
            text: 'An unexpected error occurred. Please try again.',
            icon: 'error',
            confirmButtonText: 'Try Again2'
        });
    });
});

// Function to dynamically add a new row to the table
   




      function toggleInfo() {
            var infoDiv = document.getElementById("researchInfo");
            if (infoDiv.style.display === "none") {
                infoDiv.style.display = "block";
            } else {
                infoDiv.style.display = "none";
            }
        }
        document.addEventListener('DOMContentLoaded', function() {
    const inputContainer = document.getElementById('input-container');
    const addButton1 = document.querySelector('.add-input');
    let inputCount = 1;
    
    addButton1.addEventListener('click', function() {
        if (inputCount < 5) { // Check if inputCount is less than 5
            const newInputGroup = document.createElement('div');
            newInputGroup.classList.add('input-group');
            newInputGroup.innerHTML = `
                <input type="text" name="inputField[${inputCount}]" placeholder="Enter something">
                <button type="button" class="remove-input">-</button>
            `;
            inputContainer.appendChild(newInputGroup);
            inputCount++;

            const removeButtons = document.querySelectorAll('.remove-input');
            removeButtons.forEach(function(button) {
                button.addEventListener('click', function() {
                    newInputGroup.remove();
                    inputCount--; // Decrement inputCount when removing an input field
                });
            });
        } else {
            alert("You can't add more than 5 Keywords.");
        }
    });
});

        document.addEventListener('DOMContentLoaded', function() {
            const inputContainer2 = document.getElementById('input-container2');
            const addButton2 = document.querySelector('.add-tags');
            let inputCount = 1;

            addButton2.addEventListener('click', function() {
                if (inputCount < 5) {
                    const newInputtag = document.createElement('div');
                    newInputtag.classList.add('input-group');
                    
                newInputtag.innerHTML = `
                    <input type="text" name="tags[${inputCount}]" placeholder="Enter something">
                    <button type="button" class="remove-tags">-</button>
                `;
                inputContainer2.appendChild(newInputtag);
                inputCount++;

                const removeButtons = document.querySelectorAll('.remove-tags');
                removeButtons.forEach(function(button) {
                    button.addEventListener('click', function() {
                        newInputtag.remove();
                    });
                });
            } else {
            alert("You can't add more than 5 tags.");
        }
            });
        });

</script>

</body>
</html>
