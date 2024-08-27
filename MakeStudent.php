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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="css/custom2.css" rel="stylesheet"> 
    <link href="css/sidebar.css" rel="stylesheet">
    <title>Admin page</title>
</head>


<body>
    
<div class="relative">


<?php include 'header.php'; ?>  
<?php include 'adminSidebar.php'; ?>

<div class="content">
    <form  action="backend/adminaccessApi.php" method="post">   
        <h2>Make Accounts</h2>
        <div class="input-group">

            <div class="form-floating mb-3 w-75">
                <input class="border border-primary form-control" type="text" id="ID" name="ID" placeholder="com" required>
                <label for="ID">ID no.</label><!--ID -->
            </div>

        <div class="form-floating mb-3 w-50">
                        <input type="Email" class="border border-primary form-control " id="Email" name="Email" placeholder="name@example.com" required>
                        <label for="Email">Email</label><!--Email -->
        </div>
        <label for="cars"   >Set Status</label>
        <select id="cars" name="UserType" class="custom-select w-25 mx-3  mb-3 ">
            <?php
            //     $conn = new mysqli("localhost", "mine", "pass", "repository");
            
            //     // Check connection
            //     if ($conn->connect_error) {
            //         echo "error";
            //     }
            //     // SQL query to fetch data
            //     $sql = "SELECT usertypeTBL.`Status` FROM `usertypeTBL`;";
            //     $result = $conn->query($sql);
            //     if ($result) {
            //         // Fetch rows as associative array
            //         while ($row = mysqli_fetch_assoc($result)) {
            //             // Access the UserOption column value from the current row
            //             $userOption = $row['Status'];
                        
            //             // Output the <option> element
            //             echo "<option value=\"$userOption\">$userOption</option>";
            //         }
            // }
            ?>
        </select><!--userOption -->
        </div>
        <br>
        <div class="input-group">
        <div class="form-floating mb-3">
            <input class="border border-primary form-control "type="text" id="Fname" name="Fname" placeholder="juan" required> <!--Fname -->
            <label for="Fname">First Name</label>
        </div>
        <div class="form-floating mb-3 ">
            <input class="border border-primary form-control"type="text"  id="Mname" name="Mname" placeholder="Mercado" > <!--Mname -->
            <label for="Mname">Middle Name</label>
        </div>
        <div class="form-floating mb-3 ">
            <input class="border border-primary form-control"type="text" id="Lname" name="Lname" placeholder="Dela cruz" required> <!--Lname -->
            <label for="Lname">Last Name</label>
        </div>
        <div class="form-floating mb-3 ">
             <input class="border border-primary form-control"type="text" id="suffix" name="suffix" placeholder="Sr./Jr." > <!--suffix -->
            <label for="suffix">suffix</label>
        </div>
        
        </div>
        <fieldset class="form-group w-50">
            <div class="row">
            <legend class="col-form-label col-sm-2 pt-0">Gender</legend>
            <div class="col-sm-10">
                <div class="form-check">
                <input class="form-check-input " type="radio" name="gender" id="Female" value="Female" checked> <!--gender -->
                <label class="form-check-label " for="Female">
                    Female
                </label>    
                </div>
                <div class="form-check">
                <input class="form-check-input" type="radio" name="gender" id="male" value="male">
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
    <h2>for excel upload </h2>
    <br>
    <form action="adminaccessApi.php" method="post" enctype="multipart/form-data">
        <label for="excel_file">Upload Excel File:</label>
        <input type="file" name="excel_file" id="excel_file" accept=".xls,.xlsx">
        <br>
        <button type="submit" class="btn btn-primary buttonclean" name="submit">Upload</button>
    </form>
    <?php
    if (isset($_GET['error'])) {
        echo "<p style='color: red;'>Login failed. Please try again.</p>";
    }
    if (isset($_GET['tama'])) {
        echo "<p style='color: green;'>nasend</p>";
    }
    ?>
</div>
</div>
</body>
</html>
