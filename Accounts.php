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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
 
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css">
    <script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js"></script>

    <link href="css/custom2.css" rel="stylesheet">
    <link href="css/sidebar.css" rel="stylesheet">
    <link href="css/datatable.css" rel="stylesheet">
    <title>Accounts</title>
</head>
<style>
        .card {
            background: #fff;
            border: 1px solid #ddd;
            border-radius: 20px;
            box-shadow: 0 1px 4px rgba(0, 0, 0, 0.1);
            width: 200px;
            padding: 20px;
            text-align: center;
        }
        .card h2 {
            margin: 0;
            font-size: 1.5em;
            color: #333;
        }
        .card p {
            margin: 10px 0 0;
            font-size: 1.2em;
            color: #555;
        }
        .COUNT {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
        }
    </style>
<body>
<?php include 'modal/header.php'; ?>


<div class="content">
    <div class="sidebar">
        <?php include 'modal/adminSidebar.php'; ?>
    </div>
    <div class="main-content">
    <?php
require 'backend/dblogin.php';

try {
    // Query to get user counts grouped by UserType
    $sql = "SELECT b.usertypename, Count(a.`Usertype`) as USERCOUNT FROM `accounttbl` as a left join usertypetbl as b on a.Usertype = b.usertype Group by b.usertypename;";
    $result = $pdo->query($sql);

    // Initialize an array to store user data
    $userData = [];

    // Fetch data from the database
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        $userData[] = [
            'UserType' => $row['usertypename'],
            'UserCount' => $row['USERCOUNT']
        ];
    }
} catch (PDOException $e) {
    die("Error: " . $e->getMessage());
}
?>
    <div class="COUNT">
        <?php foreach ($userData as $user) : ?>
            <div class="card">
                <h2><?php echo htmlspecialchars($user['UserType']); ?></h2>
                <p>Count: <?php echo htmlspecialchars($user['UserCount']); ?></p>
            </div>
        <?php endforeach; ?>
    </div>
        <h2>Programs & Sections</h2>
        
        <?php include 'modal/accounttbl.php'; ?>
        

        <div class="norDiv">
            <a href="MakeStudent.php">
                <button class="btn btn-primary buttonclean">Add Account</button>
            </a>
        </div>

<!-- Button to Trigger Modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#AddCourseModal">
    Add New Course
</button>



<!-- Bootstrap CSS and JS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
<!-- Include SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function () {
        $('#submitButton').on('click', function () {
            // Collect form data
            const formData = {
                Course: $('#Course1').val(),
                Acronym: $('#Acronym').val(),
                desc: $('#desc').val()
            };
console.log($('#Course1').val()); // Check the value of the field

            // Send AJAX request
            $.ajax({
                url: 'backend/CreateCourse.php', // API endpoint
                type: 'POST',
                data: formData,
                dataType: 'json',
                success: function (response) {
                    if (response.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: response.message
                        }).then(() => {
                            $('#createCourseForm')[0].reset(); // Reset the form
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: response.message
                        });
                    }
                },
                error: function () {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'An error occurred while processing the request.'
                    });
                }
            });
        });
    });
</script>

        <form action="" method="post">
            <H3>Create new USERTYPE</H3>
            <div class="form-floating mb-23 w-50"  style="margin-left:20%; magrin-right:20%; ">
                <input class="border border-primary form-control"type="text" autocomplete="off" id="USERTYPENAME" name="USERTYPENAME" placeholder="USERTYPENAME" >
                <label for="USERTYPENAME">New UserType</label>
            </div>
            <br>
            <div class="form-floating mb-23 w-50"  style="margin-left:20%; magrin-right:20%; ">
                <input class="border border-primary form-control"type="text" autocomplete="off" id="Access" name="Access" placeholder="Access" >
                <label for="sdsd"> UserType Access</label>
            </div>

            <button type="submit" class="btn btn-primary buttonclean">Submit</button>
        </form>

    </div>
</div>
<!-- Modal Structure -->
<div class="modal fade" id="AddCourseModal" tabindex="-1" aria-labelledby="AddCourseModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered"  style="max-width: 50%; margin: auto;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="AddCourseModalLabel">Create New Course</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="createCourseForm">
                    <div class="form-floating mb-3 w-100">
                        <input class="border border-primary form-control" type="text" autocomplete="off" id="Course1" name="Course" placeholder="Course" required>
                        <label for="Course1">New Course</label>
                    </div>
                    <div class="form-floating mb-3 w-100">
                        <input class="border border-primary form-control" type="text" autocomplete="off" id="Acronym" name="Acronym" placeholder="Acronym" required>
                        <label for="Acronym">New Course Acronym</label>
                    </div>
                    <div class="form-floating mb-3 w-100">
                        <input class="border border-primary form-control" type="text" autocomplete="off" id="desc" name="desc" placeholder="Description" required>
                        <label for="desc">New Course Description</label>
                    </div>
                    <button type="button" id="submitButton" class="btn btn-primary w-100">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>
