<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <link href="css/custom2.css" rel="stylesheet"> 
    <title>Teachers Page</title>


    <style>
        .profile-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            border: 1px solid #ddd;
            border-radius: 20px;
            padding: 2rem;
            width: auto;
        }
        .profile-container img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            margin-bottom: 15px;
        }
        .profile-details {
            text-align: left;
            width: 100%;
        }
        .research-role-table {
            margin-top: 20px;
            width: 100%;
        }
        .research-role-table img {
            width: 50px;
            height: 50px;
        }
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
</head><?php include 'modal/header.php'; ?>
<body>
    <div id="imageModal" class="modal1">
        <div class="modal-content">
            <span class="close1">&times;</span>
            <img id="modalImage" src="" alt="Profile Picture">
        </div>
    </div>


    <div class="norDiv">
        <div class="profile-container">
        <div class="profile-section">
                <div class="profile-picture" id="profilePicture">
                    <img src="img/avatar-default-icon-1024x1024-dvpl2mz1.png" alt="Profile Picture">
                </div>
            </div>

    <!-- Modal Structure -->
   

    <script src="modal/ImageZoom.js"></script>
            <div class="profile-details">
                <h2 id="fullName">Loading...</h2>
                <p><strong>User ID:</strong> <span id="userID">Loading...</span></p>
                <p><strong>Email:</strong> <span id="email">Loading...</span></p>
            </div>
            <br>
            <table id="researchRolesTable" class="research-role-table">
                <thead>
                    <tr>
                        <th>Role</th>
                        <th>Title</th>
                        <th>Image</th>
                    </tr>
                </thead>
                <tbody id="researchRoles">
                    <tr>
                        <td colspan="3">Loading research roles...</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <script>
        const userID = new URLSearchParams(window.location.search).get('userid');

        if (userID) {
            // Fetch teacher's main profile
            fetch(`backend/teacherfullprofile.php?userid=${userID}`)
                .then(response => response.json())
                .then(profile => {
                    $('#fullName').text(profile.Fullname || 'Name not available');
                    $('#userID').text(profile.UserID || 'N/A');
                    $('#email').text(profile.Email || 'N/A');
                })
                .catch(error => console.error('Error fetching teacher profile:', error));

            // Fetch teacher's research roles
            fetch(`backend/teacherresearchroles.php?userid=${userID}`)
                .then(response => response.json())
                .then(researchRoles => {
                    const researchContainer = $('#researchRoles');
                    researchContainer.empty(); // Clear loading message

                    if (researchRoles && researchRoles.length > 0) {
                        researchRoles.forEach(role => {
                            const roleRow = $('<tr>');
                            roleRow.append(`<td>${role.Role}</td>`);
                            roleRow.append(`<td>${role.Title}</td>`);

                            // Check if the imageName is available
                            const imageUrl = role.ImageName ? `UploadIMG/${role.ImageName}` : 'img/neust_logo.png';
                            roleRow.append(`<td><img src="${imageUrl}" alt="Research Image"></td>`);
                            
                            researchContainer.append(roleRow);
                        });
                    } else {
                        researchContainer.append('<tr><td colspan="3">No research roles available.</td></tr>');
                    }

                    // Initialize DataTable
                    $('#researchRolesTable').DataTable();
                })
                .catch(error => console.error('Error fetching research roles:', error));
        } else {
            console.error('User ID is missing from the URL.');
        }
    </script>
</body>

</html>



