
<div class="SpecDiv">
    <table id="accountsTable" class="table display">
                <thead>
                    <tr>
                        <th scope="col">UserID</th>
                        <th scope="col">Name</th>
                        <th scope="col">UserType</th>
                        <th scope="col">Actions</th>
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
                "defaultContent": "<button class='edit-btn'><span class='bxs--edit'></span></button>" 
            }
        ]
    });

    // Event delegation for dynamically generated rows
    $('#accountsTable tbody').on('click', '.edit-btn', function() {
        var data = table.row($(this).parents('tr')).data(); // Get row data
        var userID = data.UserID; // Extract UserID from the row

        // Prompt for new usertypename (you can also use a modal here)
        var newUsertype = prompt("Enter new user type for " + data.Fname + " " + data.Lname, data.usertypename);
        
        if (newUsertype != null && newUsertype != "") {
            // Send AJAX request to update usertypename
            $.ajax({
    url: 'backend/updateUserType.php',
    type: 'POST',
    data: {
        userID: userID,
        newUsertype: newUsertype
    },
    dataType: 'json', // Ensure jQuery knows to expect a JSON response
})
.done(function(data) {
    // Handle the response from the PHP API
    if (data.success) {
        // Show success alert
        swal.fire({
            title: 'Success!',
            text: data.message || 'User type updated successfully!',
            icon: 'success',
            confirmButtonText: 'OK'
        }).then(() => {
            table.ajax.reload(); // Reload DataTable if needed
            document.getElementById('CreateAccount').reset(); // Reset form if needed
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
.fail(function(xhr, status, error) {
    // Handle any errors from the API or network
    console.error('Error:', error);
    swal.fire({
        title: 'Error!',
        text: 'An unexpected error occurred. Please try again later.',
        icon: 'error',
        confirmButtonText: 'Try Again'
    });
});

        }
    });
});
</script>