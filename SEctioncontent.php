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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="css/custom2.css" rel="stylesheet">
    <link href="css/sidebar.css" rel="stylesheet">
    <title>Accounts</title>
</head>
<body>
<?php include 'modal/header.php'; ?>
<?php include 'modal/adminSidebar.php'; ?>
<div class="content">
    <div class="norDiv">
    <?php
                    $host = 'localhost';
                    $username = 'mine';
                    $password = 'pass';
                    $database = 'repo';
                    $dsn = "mysql:host=$host;dbname=$database;charset=utf8mb4";
                    $pdo = new PDO($dsn, $username, $password);
                        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Retrieve the value of 'data' from the URL parameter
$receivedSection = $_GET['sectionID'];
$section = $pdo->query("SELECT * FROM `sectionn&capteachertbl` WHERE `SectionID` = $receivedSection;");
$secN = $section->fetch();
$secID = $secN['SectionID'];
echo "<h1> " . $secN['SectionName'] ."</h1>";
?>

        <table id="StudentTBL" class="table">
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">FUll NAME</th>

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
<input type="hidden" id="phpVar" value="<?php echo $secID; ?>">
<script>
$(document).ready(function() {
    $('#StudentTBL').DataTable({
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
            }}
        ]
    });
});
</script>
    <form id="AddStudent" method="POST" onsubmit="submitForm(event)">
            <h3>Add Student</h3>
        <div class="input-group"><h6></h6>
        <input type="hidden" name="secID" value="<?php echo $receivedSection; ?>">
        <div class="form-floating mb-3 w-75">
            <input class="border border-primary form-control "type="text" id="UID" name="UID" placeholder="juan@gmail.com" required>
            <label for="UID">Student #</label>
        </div> 
        <h6></h6>
        </div>
        <button type="submit" class="btn btn-primary buttonclean">submit</button>
    </form>
<script>
    document.getElementById('AddStudent').addEventListener('submit', function(event) {
    event.preventDefault(); // Prevent the default form submission

    // Create a FormData object from the form
    var formData = new FormData(this);

    // Send the form data to the PHP API using fetch
    fetch('onestudent.php', { // The URL of the PHP file that processes the form data
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
                document.getElementById('AddStudent').reset();
                location.reload();
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
            text: 'Already in Database',
            icon: 'error',
            confirmButtonText: 'Try Again'
        });
    });
});
</script>
</div>
</body>
</html>
