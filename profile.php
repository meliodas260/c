<?php
// require_once 'verifier.php';

//     if(!VerifyCApT()){
//         header("Location: homepage.php");
//         exit;
// }
?>
<!DOCTYPE html>
<html lang="en">
<head>
<style>
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
    flex: 0 0 70%;
    background-color: #ffffff; /* Optional: Add background color to distinguish */
}
    </style>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="css/custom2.css" rel="stylesheet">
    <link href="css/sidebar.css" rel="stylesheet">
    <title>Accounts</title>
</head>

<?php include 'modal/header.php'; ?>

<body>

    <div class="content">
        <div class="sidebar">
        <?php
            include 'modal/profileSidebar.php';
        ?>
        </div>
        <div class="main-content">
            <div class="norDiv1">
                <image src="img\avatar-default-icon-1024x1024-dvpl2mz1.png" class="profile">
                <div class="norDiv1">
                    genggene
                </div>
            </div>
            <form action="Accounts.php">
            <button type="submit">gegegge</button></form>
        </div>
    </div>
</body>
</html>
