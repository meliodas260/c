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

    <link href="css/custom2.css" rel="stylesheet">
    <link href="css/sidebar.css" rel="stylesheet">
    <link href="css/datatable.css" rel="stylesheet">
    <title>Accounts</title>
    <style>
.rigthbutton{
    display: flex;
    margin: 10px 20px; /* Optional spacing */
}
.rigthbutton a {
    margin-left: auto;
    margin-right: 8rem; /* Push the button slightly to the right */
}
.rigthbutton_btn {
    display: inline-block; /* Ensure it doesn't stretch */
    margin-left: auto;     /* Push the button to the right */
    margin-right: 5rem;    /* Adjust this for fine-tuning */
    position: relative;
}
</style>
</head>
<style>

        .card {
            background: #fff;
            border: 1px solid #ddd;
            border-radius: 50px;
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
        .lightblue{
            color:skyblue;
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
                <p> <span class="lightblue"> <?php echo htmlspecialchars($user['UserCount']); ?></span></p>
            </div>
        <?php endforeach; ?>
    </div>
        <div class="norDiv">
            <h2>Programs & Sections</h2>
            <div class="rigthbutton">
                <a href="MakeStudent.php">
                    <button class="btn btn-primary buttonclean">Add Account</button>
                </a>
            </div>
            
            <?php include 'modal/accounttbl.php'; ?>

        </div>

        <div class="norDiv">
            <hr>

            <h3>All Roles</h3>
            <div class="rigthbutton">
                <button type="button" class="btn btn-primary rigthbutton_btn" data-bs-toggle="modal" data-bs-target="#ExpertType">
                    Add ExpertType
                </button>
            </div>
            <table id="rolesTable" class="table table-striped">
                <thead>
                    <tr>
                        <th>Role ID</th>
                        <th>Role Name</th>
                        <th>Usertype</th> <!-- New column -->
                        <th>Date Created</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>

        </div>


<!-- Button to Trigger Modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#AddCourseModal">
    Add New Course
</button>

<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#AddUSertype">
    Add New Usertype
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



    </div>
</div>

<!-- Edit User Type Modal -->
<div class="modal fade" id="editUserTypeModal" tabindex="-1" aria-labelledby="editUserTypeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editUserTypeModalLabel">Edit User Type</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editUserTypeForm">
                    <input type="hidden" id="editUserID" name="userID">
                    <label for="editUserType" class="form-label">New User Type</label>
                    <select class="form-select" id="editUserType" name="newUsertype" required>
                        <option value="" disabled selected>Loading...</option>
                    </select>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="saveUserTypeBtn">Save</button>
            </div>
        </div>
    </div>
</div>



<div class="modal fade" id="ExpertType" tabindex="-1" aria-labelledby="ExpertTypeLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered"  style="max-width: 50%; margin: auto;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ExpertTypeLabel">Create New ExpertType</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="createExpertTypeForm">
                    <h3>Create new ExpertType</h3>
                    <div class="form-floating mb-23 w-50" style="margin-left:20%; margin-right:20%;">
                        <input
                            class="border border-primary form-control"
                            type="text"
                            autocomplete="off"
                            id="ExpertTypeInput"
                            name="ExpertTypeInput"
                            placeholder="ExpertTypeInput"
                        >
                        <label for="ExpertTypeInput">New ExpertType</label>
                    </div>
                    
                    <!-- New Dropdown for User Type -->
                    <div class="form-floating mb-23 w-50" style="margin-left:20%; margin-right:20%;">
                        <select
                            id="UsertypeDropdown"
                            name="userType"
                            class="border border-primary form-control"
                            required
                        >
                            <option value="" disabled selected>Select User Type</option>
                        </select>
                        <label for="UsertypeDropdown">User Type</label>
                    </div>
                    
                    <br>
                    <button type="submit" class="btn btn-primary buttonclean">Submit</button>
                </form>


            </div>
        </div>
    </div>
</div>

<!-- usertype -->
<div class="modal fade" id="AddUSertype" tabindex="-1" aria-labelledby="AddUSertypeLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered"  style="max-width: 50%; margin: auto;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="AddUSertypeLabel">Create New Usertype</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <form id="createUserTypeForm" method="post">
    <h3>Create New USERTYPE</h3>

    <div class="form-floating mb-23 w-50" style="margin-left:20%; margin-right:20%; ">
        <input class="border border-primary form-control" type="text" autocomplete="off" id="USERTYPENAME" name="USERTYPENAME" placeholder="USERTYPENAME" required>
        <label for="USERTYPENAME">New UserType</label>
    </div>

    <br>

    <div class="form-floating mb-23 w-50" style="margin-left:20%; margin-right:20%;">
        <select class="border border-primary form-control" id="Access" name="Access" required>
            <option value="" disabled selected>Select Access Type</option>
            <option value="1">Admin</option>
            <option value="3">Teacher</option>
            <option value="2">User</option>
        </select>
        <label for="Access">Usertype's Access</label>
    </div>

    <button type="submit" class="btn btn-primary buttonclean">Submit</button>
</form>


            </div>
        </div>
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




<script>
    document.addEventListener('DOMContentLoaded', function () {
        const userTypeDropdown = document.getElementById('UsertypeDropdown'); // Fixed ID

        // Fetch user types from the API
        fetch('backend/getUserTypes.php')
            .then(response => response.json())
            .then(data => {
                if (data.userTypes && data.userValues) {
                    for (let i = 0; i < data.userTypes.length; i++) {
                        const option = document.createElement('option');
                        option.value = data.userValues[i];
                        option.textContent = data.userTypes[i];
                        userTypeDropdown.appendChild(option);
                    }
                } else {
                    console.error('Invalid response structure:', data);
                }
            })
            .catch(error => {
                console.error('Error fetching user types:', error);
            });

        // Attach submit event listener
        document.getElementById('createExpertTypeForm').addEventListener('submit', function (e) {
            e.preventDefault();

            const expertType = document.getElementById('ExpertTypeInput').value.trim();
            const userType = document.getElementById('UsertypeDropdown').value;

            if (expertType === '' || userType === '') {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'All fields are required!',
                });
                return;
            }

            fetch('backend/createExpertTypeAPI.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: new URLSearchParams({
                    ExpertTypeInput: expertType,
                    Usertype: userType,
                }),
            })
                .then((response) => response.json())
                .then((data) => {
                    if (data.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: data.message,
                        }).then(() => {
                            window.location.reload();
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: data.message,
                        });
                    }
                })
                .catch((error) => {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Something went wrong. Please try again later.',
                    });
                    console.error('Error:', error);
                });
        });
    });

</script>

<script>

    document.addEventListener('DOMContentLoaded', function () {
        const rolesTableBody = document.querySelector('#rolesTable tbody');
        const roleForm = document.getElementById('createRoleForm');

        // Function to fetch and populate roles
        function fetchRoles() {
        const rolesTableBody = document.querySelector('#rolesTable tbody');

        fetch('backend/createExpertTypeAPI.php')
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    rolesTableBody.innerHTML = ''; // Clear existing rows

                    data.data.forEach(role => {
                        const row = `
                            <tr>
                                <td>${role.RoleID}</td>
                                <td>${role.RoleName}</td>
                                <td>${role.Usertype}</td> <!-- Display Usertype -->
                                <td>${new Date(role.DateCreated).toLocaleString()}</td>
                            </tr>
                        `;
                        rolesTableBody.innerHTML += row;
                    });
                } else {
                    console.error(data.message);
                    Swal.fire('Error', data.message, 'error');
                }
            })
            .catch(error => {
                console.error('Error fetching roles:', error);
                Swal.fire('Error', 'Unable to fetch roles.', 'error');
            });
    }


        // Fetch roles on page load
        fetchRoles();

    });
</script>

<script>
document.getElementById('createUserTypeForm').addEventListener('submit', function(event) {
    event.preventDefault(); // Prevent form submission

    // Get the form data
    const formData = new FormData(this);

    // Send form data to the server
    fetch('backend/CreateUserType.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())  // Assuming the server returns JSON
    .then(data => {
        if (data.success) {
            // Show success message
            Swal.fire({
                title: 'Success!',
                text: 'UserType created successfully.',
                icon: 'success',
                confirmButtonText: 'Okay'
            }).then(() => {
                // Optionally, reset the form or do something else
                document.getElementById('createUserTypeForm').reset();
            });
        } else {
            // Show error message
            Swal.fire({
                title: 'Error!',
                text: data.error || 'An error occurred.',
                icon: 'error',
                confirmButtonText: 'Okay'
            });
        }
    })
    .catch(error => {
        // Handle any errors in the fetch call
        console.error('Error submitting form:', error);
        Swal.fire({
            title: 'Error!',
            text: 'An error occurred while submitting the form.',
            icon: 'error',
            confirmButtonText: 'Okay'
        });
    });
});

</script>



</div>
</body>
</html>
