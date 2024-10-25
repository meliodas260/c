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
    <link href="css/custom2.css" rel="stylesheet">
    <link href="css/sidebar.css" rel="stylesheet">
    <link href="css/datatable.css" rel="stylesheet">
    <title>Accounts</title>
</head>

<body>
<?php include 'modal/header.php'; ?>


<div class="content">
    <div class="sidebar">
        <?php include 'modal/adminSidebar.php'; ?>
    </div>
    <div class="main-content">
    
        <h2>Programs & Sections</h2>
        
        <?php include 'modal/accounttbl.php'; ?>
        

        <div class="norDiv">
            <a href="MakeStudent.php">
                <button class="btn btn-primary buttonclean">Add Account</button>
            </a>
        </div>

        <form action="" method="post">
            <H3>Create new course</H3>
            <div class="form-floating mb-23 w-50"  style="margin-left:20%; magrin-right:20%; ">
                <input class="border border-primary form-control"type="text" autocomplete="off" id="Course" name="Course" placeholder="Course" >
                <label for="Course">New Course</label>
            </div>
            <br>
            <div class="form-floating mb-23 w-50"  style="margin-left:20%; magrin-right:20%; ">
                <input class="border border-primary form-control"type="text" autocomplete="off" id="Acronym" name="Acronym" placeholder="Acronym" >
                <label for="Acronym">New Course Acronym</label>
            </div>
            <br>
            <div class="form-floating mb-23 w-50"  style="margin-left:20%; magrin-right:20%; ">
                <input class="border border-primary form-control"type="text" autocomplete="off" id="desc" name="desc" placeholder="desc" >
                <label for="desc">New Course description</label>
            </div>

            <button type="submit" class="btn btn-primary buttonclean">Submit</button>
        </form>
        <form action="" method="post">
            <H3>Create new USERTYPE</H3>
            <div class="form-floating mb-23 w-50"  style="margin-left:20%; magrin-right:20%; ">
                <input class="border border-primary form-control"type="text" autocomplete="off" id="USERTYPENAME" name="USERTYPENAME" placeholder="USERTYPENAME" >
                <label for="USERTYPENAME">New UserType</label>
            </div>
            <br>
            <div class="form-floating mb-23 w-50"  style="margin-left:20%; magrin-right:20%; ">
                <input class="border border-primary form-control"type="text" autocomplete="off" id="Access" name="Access" placeholder="Access" >
                <label for="Acronym"> UserType Access</label>
            </div>

            <button type="submit" class="btn btn-primary buttonclean">Submit</button>
        </form>

    </div>
</div>

</body>
</html>
