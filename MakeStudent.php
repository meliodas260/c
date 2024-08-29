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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/custom2.css" rel="stylesheet"> 
    <link href="css/sidebar.css" rel="stylesheet">
    <title>Admin Page</title>
</head>
<body>
    
<div class="relative">
    <?php include 'modal/header.php'; ?>  
    <?php include 'modal/adminSidebar.php'; ?>

    <div class="content">
        <!-- Form to Create Accounts -->
        <form action="backend/adminaccessApi.php" method="post">   
            <h2>Make Accounts</h2>
            <div class="input-group">
                <div class="form-floating mb-3 w-75">
                    <input class="border border-primary form-control" type="text" id="ID" name="ID" placeholder="com" required>
                    <label for="ID">ID no.</label><!--ID -->
                </div>
                <div class="form-floating mb-3 w-50">
                    <input type="email" class="border border-primary form-control" id="Email" name="Email" placeholder="name@example.com" required>
                    <label for="Email">Email</label><!--Email -->
                </div>
                <label for="types">Set Status</label>
                <select id="types" name="UserType" class="custom-select w-25 mx-3 mb-3">
                    <!-- Options will be dynamically populated here -->
                </select>
                <script>
                    document.addEventListener('DOMContentLoaded', function () {
                        fetch('backend/getUserTypes.php')
                            .then(response => response.json())
                            .then(data => {
                                const selectElement = document.getElementById('types');
                                if (Array.isArray(data.userTypes)) {
                                    data.userTypes.forEach((userType, index) => {
                                        const option = document.createElement('option');
                                        option.value = data.userValues[index];
                                        option.textContent = userType;
                                        selectElement.appendChild(option);
                                    });
                                } else {
                                    console.error("Failed to fetch user types:", data.error);
                                }
                            })
                            .catch(error => console.error('Error:', error));
                    });
                </script>
            </div>
            <br>
            <div class="input-group">
                <div class="form-floating mb-3">
                    <input class="border border-primary form-control" type="text" id="Fname" name="Fname" placeholder="Juan" required> <!--Fname -->
                    <label for="Fname">First Name</label>
                </div>
                <div class="form-floating mb-3">
                    <input class="border border-primary form-control" type="text" id="Mname" name="Mname" placeholder="Mercado"> <!--Mname -->
                    <label for="Mname">Middle Name</label>
                </div>
                <div class="form-floating mb-3">
                    <input class="border border-primary form-control" type="text" id="Lname" name="Lname" placeholder="Dela Cruz" required> <!--Lname -->
                    <label for="Lname">Last Name</label>
                </div>
                <div class="form-floating mb-3">
                    <input class="border border-primary form-control" type="text" id="suffix" name="suffix" placeholder="Sr./Jr."> <!--suffix -->
                    <label for="suffix">Suffix</label>
                </div>
            </div>
            <fieldset class="form-group w-50">
                <div class="row">
                    <legend class="col-form-label col-sm-2 pt-0">Gender</legend>
                    <div class="col-sm-10">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="gender" id="Female" value="0" checked> <!--gender -->
                            <label class="form-check-label" for="Female">
                                Female
                            </label>    
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="gender" id="male" value="1">
                            <label class="form-check-label" for="male">
                                Male
                            </label>
                        </div>
                    </div>
                </div>
            </fieldset>
            <br>
            <button type="submit" class="btn btn-primary buttonclean">Submit</button>
        </form>
        <br>
        <!-- Form to Upload Excel File -->
        <h2>For Excel Upload</h2>
        <br>
        <form action="backend/adminaccessApi.php" method="post" enctype="multipart/form-data">
            <label for="excel_file">Upload Excel File:</label>
            <input type="file" name="excel_file" id="excel_file" accept=".xls,.xlsx">
            <br>
            <button type="submit" class="btn btn-primary buttonclean" name="submit">Upload</button>
        </form>
        <?php
        if (isset($_GET['error'])) {
            echo "<p style='color: red;'>Error: " . htmlspecialchars($_GET['error']) . "</p>";
        }
        if (isset($_GET['success'])) {
            echo "<p style='color: green;'>Success: " . htmlspecialchars($_GET['success']) . "</p>";
        }
        ?>
    </div>
</div>
</body>
</html>
