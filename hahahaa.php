<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dynamic Draggable List with Drop Zone</title>
    <style>
        #container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px;
        }
        #dropZone {
            width: 200px;
            height: 200px;
            border: 2px dashed #333;
            background-color: #f9f9f9;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #666;
            font-size: 16px;
            margin-right: 20px;
        }
        .draggable-item {
            padding: 10px;
            margin: 5px;
            background-color: lightblue;
            border: 1px solid #000;
            cursor: pointer;
        }
        .red {
            background-color: red !important; /* Red background for RoleConnectorKey */
        }
        .non-draggable {
            cursor: not-allowed;
        }
        #draggableListContainer {
            margin-top: 20px;
        }
        #draggableListContainer h2 {
            font-size: 24px;
            margin-bottom: 10px;
            text-align: center;
        }
        #dropZoneContainer {
            display: flex;
            gap: 20px;
        }
    </style>
</head>
<body>

<!-- Hidden input to pass PHP variable to JavaScript -->
<input type="hidden" id="phpVar" value="2">

<!-- Form with drop zone and dynamic draggable items -->
<form id="dropForm" method="POST" action="backend/backo.php">
    <div id="container">
        <!-- Drop Zone Container -->
        <div id="dropZoneContainer">
            <div id="dropZone">Drop here</div>
        </div>

        <!-- Button to Add New Drop Zone -->
        <button type="button" id="addDropZoneButton">Add Drop Zone</button>
        
        <!-- Draggable List Container -->
        <div id="draggableListContainer">
            <h2>Students</h2>
            <div id="draggableList">
                <!-- Draggable items will be appended here dynamically -->
            </div>
        </div>
    </div>

    <!-- Hidden Input to store dropped values -->
    <input type="hidden" id="dropInput" name="droppedStudents" value="[]">

    <!-- Submit Button -->
    <button type="submit">Submit</button>
</form>

<!-- jQuery Library -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    // Array to track dropped students
    let droppedStudents = [];

    // Fetch data from API and generate draggable items
    function loadDraggableItems() {
        $.ajax({
            url: 'sectionStudapi.php',
            type: 'GET',
            data: { secID: $('#phpVar').val() },
            success: function(data) {
                console.log("API call successful. Data received:", data);

                // If the data is a string, parse it into an array
                if (typeof data === 'string') {
                    try {
                        data = JSON.parse(data); // Parse the string into an array
                        console.log("Parsed data:", data);
                    } catch (e) {
                        console.error("Error parsing data:", e);
                        return;
                    }
                }

                // Check if data is an array and contains elements
                if (Array.isArray(data) && data.length > 0) {
                    $('#draggableList').empty(); // Clear existing items

                    // Create draggable items for each student
                    data.forEach(function(student) {
                        const fullName = `${student.Fname} ${student.Mname} ${student.Lname}`;
                        const userID = student.UserID;
                        const roleConnectorKey = student.RoleConnectorKey;

                        // Ensure fullName and userID are not empty
                        if (fullName && userID) {
                            // Create draggable item
                            const item = $('<div></div>')
                                .addClass('draggable-item')
                                .attr('draggable', roleConnectorKey === null) // Only make it draggable if RoleConnectorKey is null
                                .data('userID', userID) // Store the user ID for drag data
                                .text(fullName);

                            // Check if RoleConnectorKey is not null and make the item red
                            if (roleConnectorKey !== null) {
                                item.addClass('red');
                                item.addClass('non-draggable'); // Add class to show it's not draggable
                            }

                            // Add drag event listener to each item (only if it's draggable)
                            item.on('dragstart', function(event) {
                                if (!roleConnectorKey) {
                                    event.originalEvent.dataTransfer.setData('text', $(this).data('userID'));
                                }
                            });

                            // Append the draggable item to the list
                            $('#draggableList').append(item);
                        } else {
                            console.warn("Incomplete student data:", student);
                        }
                    });
                } else {
                    console.warn("Expected an array with student data, but received:", typeof data, data);
                    $('#draggableList').html('<p>No students found or data format incorrect.</p>');
                }
            },
            error: function(xhr, status, error) {
                console.error("Error fetching data:", status, error);
            }
        });
    }

    // Load draggable items on page load
    loadDraggableItems();

    // Drop Zone functionality
    function addDropZone() {
        const dropZone = $('<div></div>')
            .addClass('drop-zone')
            .css({
                width: '200px',
                height: '200px',
                border: '2px dashed #333',
                backgroundColor: '#f9f9f9',
                display: 'flex',
                alignItems: 'center',
                justifyContent: 'center',
                color: '#666',
                fontSize: '16px',
            })
            .text('Drop here');

        // Append the new drop zone to the container
        $('#dropZoneContainer').append(dropZone);

        // Add dragover and drop functionality to the new drop zone
        dropZone.on('dragover', function(event) {
            event.preventDefault();
            dropZone.css('background-color', '#e0ffe0');
        });

        dropZone.on('dragleave', function() {
            dropZone.css('background-color', '#f9f9f9');
        });

        dropZone.on('drop', function(event) {
            event.preventDefault();
            dropZone.css('background-color', '#d0ffd0');

            // Get the dragged user ID
            const userID = event.originalEvent.dataTransfer.getData('text');
            
            // Check if the student has already been dropped
            if (droppedStudents.includes(userID)) {
                alert("This student has already been dropped!");
                return; // Prevent adding the same student again
            }

            // Update drop zone with the dropped value
            dropZone.text('Student dropped!');

            // Add student to dropped list
            droppedStudents.push(userID);

            // Remove the dropped student from the draggable list
            $(`.draggable-item[data-userid='${userID}']`).remove();
        });
    }

    // Add new drop zone on button click
    $('#addDropZoneButton').on('click', function() {
        addDropZone();
    });

    // Original Drop Zone functionality
    const originalDropZone = $('#dropZone');
    originalDropZone.on('dragover', function(event) {
        event.preventDefault();
        originalDropZone.css('background-color', '#e0ffe0');
    });

    originalDropZone.on('dragleave', function() {
        originalDropZone.css('background-color', '#f9f9f9');
    });

    originalDropZone.on('drop', function(event) {
        event.preventDefault();
        originalDropZone.css('background-color', '#d0ffd0');

        // Get the dragged user ID
        const userID = event.originalEvent.dataTransfer.getData('text');
        
        // Check if the student has already been dropped
        if (droppedStudents.includes(userID)) {
            alert("This student has already been dropped!");
            return; // Prevent adding the same student again
        }

        // Update drop zone with the dropped value
        originalDropZone.text('Student dropped!');

        // Add student to dropped list
        droppedStudents.push(userID);

        // Remove the dropped student from the draggable list
        $(`.draggable-item[data-userid='${userID}']`).remove();
    });

    // Update the hidden input with the dropped students array when the form is submitted
    $('#dropForm').submit(function(event) {
        event.preventDefault(); // Prevent default form submission

        // Serialize the droppedStudents array and set it in the hidden input
        $('#dropInput').val(JSON.stringify(droppedStudents));

        // Send the form with the dropped students data
        this.submit();
    });
});

</script>

</body>
</html>
