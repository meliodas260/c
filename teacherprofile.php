<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Profile</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            display: flex;
            justify-content: center;
        }
        .profile-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 20px;
            width: 600px;
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
    </style>
</head>
<body>
    <div class="profile-container">
        <img id="profileImage" src="" alt="Profile Image">
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

    <script>
        const userID = new URLSearchParams(window.location.search).get('userid');

        if (userID) {
            // Fetch teacher's main profile
            fetch(`backend/teacherfullprofile.php?userid=${userID}`)
                .then(response => response.json())
                .then(profile => {
                    $('#profileImage').attr('src', profile.imageName ? `img/${profile.imageName}` : 'img/avatar-default-icon-1024x1024-dvpl2mz1.png');
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
