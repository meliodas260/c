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
    include 'modal/CapTSidebar.php'; 
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
                    url: 'backend/fetch_predictions.php',
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
                    url: 'backend/fetch_predictions.php',
                    method: 'POST',
                    data: { input: inputValue},
                    dataType: 'json',
                    success: function(predictions) {
                if (predictions.length > 0) {
                    predictionContainer.html('');
                    predictions.forEach(prediction => {
                        const predictionElement = $('<div>').text(prediction.Fullname); // Display Fullname
                        predictionElement.on('click', function() {
                            inputField.val(prediction.Fullname); // Set Fullname in the input field on click
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
        <div class="input-group">
            <h3></h3>
        <div class="form-floating mb-3 w-25">
             <input class="border border-primary form-control"type="text" autocomplete="off" id="Leader" name="Leader" placeholder="Leader" >
            <label for="Leader">Leader</label>
            <div id="prediction1" class="prediction-container"  style="display: none;"></></div>
        </div>
        <div class="form-floating mb-3 w-25">
             <input class="border border-primary form-control"type="text" autocomplete="off" id="Member1" name="Member1" placeholder="Member" >
            <label for="Member1">Member1</label>
            <div id="Member1_pre" class="prediction-container"  style="display: none;"></></div>
        </div>  
        
        <h3></h3>
        </div>
        <div class="input-group">
            <h3></h3>
        <div class="form-floating mb-3 w-25">
             <input class="border border-primary form-control"type="text" autocomplete="off" id="Member2" name="Member2" placeholder="Member" >
            <label for="Member2">Member2</label>
            <div id="Member2_pre" class="prediction-container"  style="display: none;"></></div>
        </div>  
        <div class="form-floating mb-3 w-25">
             <input class="border border-primary form-control"type="text" autocomplete="off" id="Member3" name="Member3" placeholder="Member" >
            <label for="Member3">Member3</label>
            <div id="Member3_pre" class="prediction-container"  style="display: none;"></></div>
        </div>  
        <h3></h3>
        </div>
            <br>
            <h2>Table Input Form with Fixed Columns and Dynamic Rows</h2>

    <table id="inputTable">
        <tr id="headerRow">
            <th>teacherName</th>
            <th>role</th>
        </tr>
        <!-- Initial 3 rows -->
        <tr>
            <td><input type="text" name="teacherName[]" required></td>
            <td><input type="text" name="role[]" required></td>
        </tr>
        <tr>
            <td><input type="text" name="teacherName[]" required></td>
            <td><input type="text" name="role[]" required></td>
        </tr>
        <tr>
            <td><input type="text" name="teacherName[]" required></td>
            <td><input type="text" name="role[]" required></td>
        </tr>
    </table>
    <button type="button" onclick="addRow()">+ Add Row</button>


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



                <?php
                    // // Database connection
                    // $host = 'localhost';
                    // $username = 'root';
                    // $password = '';
                    // $database = 'repo';
                    // $dsn = "mysql:host=$host;dbname=$database;charset=utf8mb4";

                    // try {
                    //     $pdo = new PDO($dsn, $username, $password);
                    //     $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    //     // Select data from the database
                    //     $ResearchSql = $pdo->query("SELECT * FROM `researchtbl` WHERE `SectionID` = $secID");
                    //     // Loop through the result set and display data in table rows
                    //     while ($row = $ResearchSql->fetch(PDO::FETCH_ASSOC)) { 
                    //         echo "<div class='SpecDiv'>";
                    //         echo "<h3>" .$row['Title'] ."</h3>";
                    //        $connector = $row['RoleConnectorKey'];
                    //        $ResearcherSql = $pdo->query("SELECT * from researchroletbl a left join accounttbl b on b.UserID = a.UID WHERE a.RoleConnectorKey = $connector;");
                    //        $tags = $pdo->query("SELECT * FROM `reasearchtagtbl` a left join tagtbl b on a.TagID = b.TagId WHERE a.TagConnectorKey =  $connector;");
                    //        $keyws = $pdo->query("SELECT * FROM `reasearchkeywordstbl` WHERE`KeywordConnectorKey` =   $connector;");
                    //     while ($rowlower = $ResearcherSql->fetch(PDO::FETCH_ASSOC)) { 
                    //         echo " <h2>".$rowlower['Fname']."\n".$rowlower['Role']."</h2>";
                    //     }
                    //     while ($rowlower = $tags->fetch(PDO::FETCH_ASSOC)) { 
                    //         echo " <h4>".$rowlower['TagName']."</h4>";
                    //     }
                    //     while ($rowlower = $keyws->fetch(PDO::FETCH_ASSOC)) { 
                    //         echo " <h4>".$rowlower['Keyword']."</h4>";
                    //     }
                    //     echo "<button class='btn-more' data-id='".$row['ResearchID']."'> ".$row['ResearchID']." More</button>";
?>

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
                confirmButtonText: 'Try Again'
            });
        }
    })
    .catch(error => {
        console.error('Error:', error);
        Swal.fire({
            title: 'Error!',
            text: 'An unexpected error occurred. Please try again.',
            icon: 'error',
            confirmButtonText: 'Try Again'
        });
    });
});

// Function to dynamically add a new row to the table
function addRow() {
    var table = document.getElementById('inputTable');
    var newRow = table.insertRow(table.rows.length - 1); // Insert row before last row (button row)
    
    var cell1 = newRow.insertCell(0);
    var cell2 = newRow.insertCell(1);

    var input1 = document.createElement('input');
    input1.type = 'text';
    input1.name = 'teacherName[]';
    input1.required = true;
    cell1.appendChild(input1);

    var input2 = document.createElement('input');
    input2.type = 'text';
    input2.name = 'role[]';
    input2.required = true;
    cell2.appendChild(input2);
}




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
    const addButton = document.querySelector('.add-input');
    let inputCount = 1;
    
    addButton.addEventListener('click', function() {
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
            let inputCount = 1;

            addButton.addEventListener('click', function() {
                if (inputCount < 5) {
                    const newInputtag = document.createElement('div');
                    newInputtag.classList.add('input-group');
                    const addButton = document.querySelector('.add-tags');
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
