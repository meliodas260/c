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
    <style>
        .bxs--edit {
  display: inline-block;
  width: 1.5em;
  height: 1.5em;
  --svg: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24'%3E%3Cpath fill='%23000' d='m18.988 2.012l3 3L19.701 7.3l-3-3zM8 16h3l7.287-7.287l-3-3L8 13z'/%3E%3Cpath fill='%23000' d='M19 19H8.158c-.026 0-.053.01-.079.01c-.033 0-.066-.009-.1-.01H5V5h6.847l2-2H5c-1.103 0-2 .896-2 2v14c0 1.104.897 2 2 2h14a2 2 0 0 0 2-2v-8.668l-2 2z'/%3E%3C/svg%3E");
  background-color: currentColor;
  -webkit-mask-image: var(--svg);
  mask-image: var(--svg);
  -webkit-mask-repeat: no-repeat;
  mask-repeat: no-repeat;
  -webkit-mask-size: 100% 100%;
  mask-size: 100% 100%;
}
.edit-btn{
    border:0px;
}
        .content {
    display: flex;
    width: 100%;
    flex-wrap: wrap;
}

.sidebar {
    flex: 0 0 20%;
    background-color: #8d2424; /* Optional: Add background color to distinguish */
}

.main-content {
    margin-top: 3%;
    flex: 0 0 70%;
    background-color: #ffffff; /* Optional: Add background color to distinguish */
}
    </style>
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


<div class="content">
    <div class="sidebar">
        <?php include 'modal/adminSidebar.php'; ?>
    </div>
    <div class="main-content">
    
        <h2>Programs & Sections</h2>
        
        <?php include 'modal/AccountTBL.php'; ?>
        

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
