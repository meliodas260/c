<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dynamic Draggable List with Drop Zone and Role Dropdown</title>
    <style>
        #container {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            padding: 20px;
        }
        #dropZoneContainer {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }
        .drop-zone-wrapper {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 10px;
        }
        .drop-zone {
            width: 200px;
            height: 200px;
            border: 2px dashed #333;
            background-color: #f9f9f9;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #666;
            font-size: 16px;
        }
        .drop-zone.hover {
            background-color: #e0ffe0;
        }
        .drop-zone.dropped {
            background-color: #d0ffd0;
        }
        select {
            width: 200px;
            padding: 5px;
        }
        .draggable-item {
            padding: 10px;
            margin: 5px;
            background-color: lightblue;
            border: 1px solid #000;
            cursor: pointer;
        }
        .red {
            background-color: red !important;
        }
        .non-draggable {
            cursor: not-allowed;
        }
        #draggableListContainer h2 {
            font-size: 24px;
            margin-bottom: 10px;
            text-align: center;
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
            <div class="drop-zone-wrapper">
                <div class="drop-zone">Drop here</div>
                <select class="role-dropdown">
                    <option value="" disabled selected>Select Role</option>
                    <option value="Leader">Leader</option>
                    <option value="Member">Member</option>
                    <option value="Observer">Observer</option>
                </select>
            </div>
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
    let droppedStudents = []; // Track dropped students with roles and drop zones

    // Fetch data from API and generate draggable items
    function loadDraggableItems() {
        $.ajax({
            url: 'sectionStudapi.php',
            type: 'GET',
            data: { secID: $('#phpVar').val() },
            success: function(data) {
                if (typeof data === 'string') {
                    try {
                        data = JSON.parse(data);
                    } catch (e) {
                        console.error("Error parsing data:", e);
                        return;
                    }
                }

                if (Array.isArray(data) && data.length > 0) {
                    $('#draggableList').empty(); // Clear existing items

                    data.forEach(function(student) {
                        const fullName = `${student.Fname} ${student.Mname} ${student.Lname}`;
                        const userID = student.UserID;
                        const roleConnectorKey = student.RoleConnectorKey;

                        if (fullName && userID) {
                            const item = $('<div></div>')
                                .addClass('draggable-item')
                                .attr('draggable', roleConnectorKey === null)
                                .data('userID', userID)
                                .text(fullName);

                            if (roleConnectorKey !== null) {
                                item.addClass('red').addClass('non-draggable');
                            }

                            item.on('dragstart', function(event) {
                                if (!roleConnectorKey) {
                                    event.originalEvent.dataTransfer.setData('text', $(this).data('userID'));
                                }
                            });

                            $('#draggableList').append(item);
                        }
                    });
                } else {
                    $('#draggableList').html('<p>No students found or data format incorrect.</p>');
                }
            },
            error: function(xhr, status, error) {
                console.error("Error fetching data:", status, error);
            }
        });
    }

    loadDraggableItems();

    // Configure Drop Zone functionality
    function configureDropZone(wrapper) {
        const dropZone = wrapper.find('.drop-zone');
        const dropdown = wrapper.find('.role-dropdown');

        dropZone.on('dragover', function(event) {
            event.preventDefault();
            dropZone.addClass('hover');
        });

        dropZone.on('dragleave', function() {
            dropZone.removeClass('hover');
        });

        dropZone.on('drop', function(event) {
            event.preventDefault();
            dropZone.removeClass('hover').addClass('dropped');

            const userID = event.originalEvent.dataTransfer.getData('text');

            if (droppedStudents.some(student => student.userID === userID)) {
                alert("This student has already been dropped!");
                return;
            }

            const selectedRole = dropdown.val();
            if (!selectedRole) {
                alert("Please select a role before dropping!");
                return;
            }

            droppedStudents.push({ userID, role: selectedRole });
            dropZone.text('Student dropped!');

            $(`.draggable-item[data-userid='${userID}']`).remove();
        });
    }

    // Add new drop zone with dropdown on button click
    $('#addDropZoneButton').on('click', function() {
        const wrapper = $('<div></div>').addClass('drop-zone-wrapper');
        const dropZone = $('<div></div>').addClass('drop-zone').text('Drop here');
        const dropdown = $('<select></select>').addClass('role-dropdown').html(`
            <option value="" disabled selected>Select Role</option>
            <option value="Leader">Leader</option>
            <option value="Member">Member</option>
            <option value="Observer">Observer</option>
        `);

        wrapper.append(dropZone, dropdown);
        $('#dropZoneContainer').append(wrapper);
        configureDropZone(wrapper);
    });

    // Configure the initial drop zone
    configureDropZone($('.drop-zone-wrapper').first());

    // Update the hidden input with dropped students when form is submitted
    $('#dropForm').submit(function(event) {
        event.preventDefault();
        $('#dropInput').val(JSON.stringify(droppedStudents));
        this.submit();
    });
});
</script>

</body>
</html>
