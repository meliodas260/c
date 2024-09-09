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
<div class="sidebar">
<?php include 'adminSidebar.php'; ?>
  <ul>
  <?php 
    $cookie_value = $_COOKIE["RepSesID"];
        $lastChar = substr($cookie_value, -1);

        if ($lastChar === '1') {
            echo "<a href='./Accounts'> <span> Admin</span></a>";
        } else if ($lastChar === '9') {
            echo "<a href='./CapTSection'> <span> Capstone</span></a>";
        }else if ($lastChar === '8') {
            echo "<a href='./UploadResearchInfo'> <span>Student</span></a>";
        }
 ?>
  </ul>
</div>
<body>
</body>
</html>