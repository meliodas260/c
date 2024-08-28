<?php
// require_once 'backend/verifier.php';

// if(!Verifyadmin()){
//     header("Location: homepage.php");
//     exit;
// }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="css/custom2.css" rel="stylesheet">
    <link href="css/sidebar.css" rel="stylesheet">
    <title>Accounts</title>
</head>

<body>
<?php include 'modal/header.php'; ?>
<?php include 'modal/adminSidebar.php'; ?>

<div class="content">
    <h2>Programs & Sections</h2>
    <div class="SpecDiv">
        <h3>BSIT</h3>
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
    <div class="norDiv">
        <a href="MakeStudent.php">
            <button class="btn btn-primary buttonclean">Add Account</button>
        </a>
    </div>
</div>

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<!-- Initialization script -->
<script>
    $(document).ready(function() {
        $('#accountsTable').DataTable({
            "ajax": {
                "url": "data.php", // Your PHP file that returns JSON data
                "type": "GET",
                "dataSrc": ""
            },
            "columns": [
                { "data": "UserID" },
                { "data": function(row) {
                    return row.Fname + " " + row.Mname + " " + row.Lname;
                }},
                { "data": "Usertype" },
                { "data": null, "defaultContent": "<a href='SEctioncontent.php'>More</a>" }
            ]
        });
    });
</script>
</body>
</html>
