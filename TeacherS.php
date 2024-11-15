<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;700&display=swap" rel="stylesheet">
    <link href="css/custom2.css" rel="stylesheet"> 
    <title>Teachers Page</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        /* Basic styling for profile cards */
        .profile-card {
            background-color: #eef3f7 ;
            display: flex;
            align-items: center;
            margin: auto;
            padding: auto;
            padding: .5rem .9rem;
            margin: .5rem .5rem;
            border: 1px solid #ddd;
            border-radius:20px;
            width: auto;
            cursor: pointer;
        }
        .profile-card img {
            width: 5rem;
            height: 5rem;
            border-radius: 50%;
            margin-right: 15px;
            border: 1px solid #bae3f0;
        }
        .profile-card .fullname {
            margin-left: 1rem;
            font-size: 1.5rem;
            font-family: 'Nunito', sans-serif;
        }
    </style>
</head>

<?php include 'modal/header.php'; ?>


<body>
    <div class="norDiv">
        <h1>Teachers</h1>
        <div id="teacherProfilesContainer"></div>
    </div>
    <script>
        // Function to fetch and display all teacher profiles
        function fetchTeacherProfiles() {
            fetch('backend/fetch_predictions?input=')
                .then(response => response.json())
                .then(predictions => {
                    const teacherProfilesContainer = $('#teacherProfilesContainer');
                    teacherProfilesContainer.html(''); // Clear any previous content

                    predictions.forEach(prediction => {
                        // Create a profile card for each teacher
                        const profileCard = $('<div>').addClass('profile-card');

                        // Profile image
                        const imagePath = prediction.imageName ? 'Profiles/' + prediction.imageName : 'img/avatar-default-icon-1024x1024-dvpl2mz1.png';
                        const profileImage = $('<img>').attr('src', imagePath);
                        profileCard.append(profileImage);


                        // Fullname
                        const fullname = $('<div>').addClass('fullname').text(prediction.Fullname);
                        profileCard.append(fullname);

                        // Click event to redirect to teacher profile
                        profileCard.on('click', function() {
                            window.location.href = 'teacherprofile?userid=' + prediction.UserID;
                        });

                        // Append profile card to container
                        teacherProfilesContainer.append(profileCard);
                    });
                })
                .catch(error => console.error('Error fetching teacher profiles:', error));
        }

        // Call the function on page load
        $(document).ready(() => {
            fetchTeacherProfiles();
        });
    </script>

   
</body>
</html>
