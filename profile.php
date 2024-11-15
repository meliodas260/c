<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="css/custom2.css" rel="stylesheet">
    <link href="css/sidebar.css" rel="stylesheet">
    <title>Accounts</title>
    <style>
        .content {
            display: flex;
            width: 100%;
            flex-wrap: wrap;
        }

        .sidebar {
            flex: 0 0 20%;
            background-color: #8d2424;
        }

        .main-content {
            flex: 1;
            background-color: #ffffff;
            padding: 20px;
        }

        .profile-picture {
            width: 20rem;
            height: 20rem;
            border-radius: 50%;
            overflow: hidden;
            border: 2px solid #a0c4ff;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
            background-color: #f0f0f0;
            margin: 20px auto;
            cursor: pointer;
        }

        .profile-picture img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        /* Modal styling */
        .modal1 {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            align-items: center;
            justify-content: center;
            z-index: 20;
        }

        .modal-content {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            width: 80%;
            max-width: 600px;
            text-align: center;
            position: relative;
            z-index: 21;
        }

        .modal-content img {
            width: 100%;
            max-height: 90vh;
            object-fit: contain;
            border-radius: 8px;
        }

        .close1 {
            position: absolute;
            top: 10px;
            right: 20px;
            font-size: 24px;
            cursor: pointer;
        }
    </style>
</head>
<?php include 'modal/header.php'; ?>
<body>
    <div class="content">
        <div class="sidebar">
            <?php include 'modal/profileSidebar.php'; ?>
        </div>

        <div class="main-content">
            <div class="profile-section">
                <div class="profile-picture" id="profilePicture">
                    <img src="img/avatar-default-icon-1024x1024-dvpl2mz1.png" alt="Profile Picture">
                </div>
                <div class="norDiv1">
                    <form action="profileedit">
                        <button type="submit" class="btn btn-primary">Edit Profile</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Structure -->
    <div id="imageModal" class="modal1">
        <div class="modal-content">
            <span class="close1">&times;</span>
            <img id="modalImage" src="" alt="Profile Picture">
        </div>
    </div>

    <script src="modal/ImageZoom.js"></script>

</body>
</html>
