




<style>
    .red {
    background-color:  #e7f2f8;
}

</style>




<div class="SpecDiv red">
    <table id="accountsTable" class="table display">
                <thead>
                    <tr>
                        <th scope="col">UserID</th>
                        <th scope="col">Name</th>
                        <th scope="col">UserType</th>
                        <th scope="col">Edit UserType</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Data will be populated here by DataTables -->
                </tbody>
            </table>
        </div>
        <!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<!-- Initialization script -->




<script>
    $(document).ready(function() {
    var table = $('#accountsTable').DataTable({
        "ajax": {
            "url": "backend/dbaccountsJq.php", // PHP file returning JSON data
            "type": "GET",
            "dataSrc": ""
        },
        "columns": [
            { "data": "UserID" },
            { 
                "data": function(row) {
                    return row.Fname + " " + row.Mname + " " + row.Lname;
                }
            },
            { "data": "usertypename" },
            { 
                "data": null, 
                "defaultContent": "<button class='edit-btn btn btn-success btn-sm'>Edit</button>" 
            }
        ]
    });

    // Event listener for the Edit button
    $('#accountsTable tbody').on('click', '.edit-btn', function() {
        var data = table.row($(this).parents('tr')).data(); // Get row data
        var userID = data.UserID; // Extract UserID from the row
        var currentUserTypeValue = data.UserTypeID; // Use UserTypeID if it's available

        // Set the user ID in the modal
        $('#editUserID').val(userID);

        // Fetch user types and populate the dropdown
        $.ajax({
            url: 'backend/getUserTypes.php',
            method: 'GET',
            dataType: 'json',
            success: function(response) {
                if (response.userTypes && response.userValues) {
                    const userTypes = response.userTypes;
                    const userValues = response.userTypes;
                    
                    const select = $('#editUserType');

                    // Clear existing options
                    select.empty();

                    // Populate dropdown options
                    userValues.forEach((value, index) => {
                        const option = $('<option>')
                            .val(value)
                            .text(userTypes[index]);

                        // Set the current value as selected
                        if (value == currentUserTypeValue) {
                            option.prop('selected', true);
                        }

                        select.append(option);
                    });

                    // Show the modal after the dropdown is populated
                    var editModal = new bootstrap.Modal(document.getElementById('editUserTypeModal'));
                    editModal.show();
                } else {
                    alert('Failed to load user types.');
                }
            },
            error: function() {
                alert('Error fetching user types.');
            }
        });
    });

    // Handle Save Changes button in the modal
    $('#saveUserTypeBtn').on('click', function() {
        // Collect data from the modal form
        var userID = $('#editUserID').val();
        var newUsertype = $('#editUserType').val();

        if (newUsertype.trim() !== "") {
            // Send AJAX request to update usertypename
            $.ajax({
                url: 'backend/updateUserType.php',
                type: 'POST',
                data: {
                    userID: userID,
                    newUsertype: newUsertype
                },
                dataType: 'json',
            })
            .done(function(data) {
                if (data.success) {
                    swal.fire({
                        title: 'Success!',
                        text: data.message || 'User type updated successfully!',
                        icon: 'success',
                        confirmButtonText: 'OK'
                    }).then(() => {
                        $('#editUserTypeModal').modal('hide'); // Hide the modal
                        table.ajax.reload(); // Reload DataTable
                    });
                } else {
                    swal.fire({
                        title: 'Error!',
                        text: data.message,
                        icon: 'error',
                        confirmButtonText: 'Try Again'
                    });
                }
            })
            .fail(function(xhr, status, error) {
                console.error('Error:', error);
                swal.fire({
                    title: 'Error!',
                    text: 'An unexpected error occurred. Please try again later.',
                    icon: 'error',
                    confirmButtonText: 'Try Again'
                });
            });
        } else {
            swal.fire({
                title: 'Warning!',
                text: 'User type cannot be empty.',
                icon: 'warning',
                confirmButtonText: 'OK'
            });
        }
    });
});

</script>