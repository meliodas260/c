<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Image Upload Preview</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/custom2.css" rel="stylesheet"> 
    <title>Edit profile</title>
</head>
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
.profile-picture {
    width: 20rem;
    height: 20rem;
    border-radius: 50%;
    overflow: hidden;
    border: 2px solid #a0c4ff;
    box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
    background-color: #f0f0f0;
    margin: 0 auto; /* Centers horizontally */
}

.profile-picture img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}
</style>
<?php include 'modal/header.php'; ?>
<body>
<div class="content">
        <div class="sidebar">
            <?php
                include 'modal/profileSidebar.php';
            ?>
        </div>
     <div class=" main-content">  
        <div class="norDiv1">
            
<div class="profile-picture">
    <img src="img/avatar-default-icon-1024x1024-dvpl2mz1.png" alt="Profile Picture">
</div>

<script>
// Function to fetch profile image data
function fetchProfileImage() {
    fetch('backend/ProfileUpload.php', { method: 'GET' })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok ' + response.statusText);
            }
            return response.json();
        })
        .then(data => {
            const profileImage = document.querySelector('.profile-picture img');
            
            // If `imageName` is provided, use it; otherwise, keep the default
            if (data.imageName) {
                const imageUrl = `Profiles/${data.imageName}`; // Adjust path as needed
                profileImage.src = imageUrl;
                profileImage.alt = "Profile Picture";
            } else {
                // If imageName is null or empty, set the default alt text
                profileImage.alt = "img/avatar-default-icon-1024x1024-dvpl2mz1.png";
            }
        })
        .catch(error => console.error('Error fetching profile image:', error));
}

// Call the function to fetch the profile image when the page loads
document.addEventListener('DOMContentLoaded', fetchProfileImage);
</script>
       
            <div class="container mt-5">
                <h2>Upload Profile Image</h2>
                <form action="backend/ProfileUpload.php" method="post" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="profile_image" class="form-label">Select Image (PNG or JPEG)</label>
                    <input type="file" class="form-control" id="profile_image" name="profile_image" accept=".png, .jpeg, .jpg" onchange="previewImage();">
                </div>
                
                <div class="mb-3">
                    <div class="profile-picture" id="imageDIV" style="display: none;">
                        <img id="image_preview" src="" alt="Image Preview" >
                    </div>
                </div>
                
                <input type="submit" value="Upload Image" name="submit">
            </form>
            </div>
        </div>
    </div>
</div>
    <script>
        function previewImage() {
            const fileInput = document.getElementById('profile_image');
            const preview = document.getElementById('image_preview');
            const previewDIV = document.getElementById('imageDIV');
            const file = fileInput.files[0];

            if (file) {
                const reader = new FileReader();
                
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    previewDIV.style.display = 'block';
                }
                
                reader.readAsDataURL(file);
            } else {
                preview.src = '';
                previewDIV.style.display = 'none';
            }
        }
    </script>
</body>
</html>
