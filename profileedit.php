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
.profile{
    width: 400px;
    height: 400px;
    border: 1px solid blue;
    border-radius:50%;
}

</style>
<?php include 'modal/header.php'; ?>
<body>
    <div class="norDiv1">
        <image src="img\avatar-default-icon-1024x1024-dvpl2mz1.png" class="profile">
    </div>
    <div class="container mt-5">
        <h2>Upload Profile Image</h2>
        
        <div class="mb-3">
            <label for="profile_image" class="form-label">Select Image (PNG or JPEG)</label>
            <input type="file" class="form-control" id="profile_image" name="profile_image" accept=".png, .jpeg, .jpg" onchange="previewImage();">
        </div>
        
        <div class="mb-3">
            <img id="image_preview" src="" alt="Image Preview" class="img-fluid" style="max-width: 150px; display: none;">
        </div>
        
        <button type="submit" class="btn btn-primary">Upload Image</button>
    </div>

    <script>
        function previewImage() {
            const fileInput = document.getElementById('profile_image');
            const preview = document.getElementById('image_preview');
            const file = fileInput.files[0];

            if (file) {
                const reader = new FileReader();
                
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                }
                
                reader.readAsDataURL(file);
            } else {
                preview.src = '';
                preview.style.display = 'none';
            }
        }
    </script>
</body>
</html>
