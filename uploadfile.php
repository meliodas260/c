

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Photo</title>
</head>
<body>
   
    <form action="upload.php" method="post" enctype="multipart/form-data"> <h2>Upload Photo Form</h2>
        Select image to upload:
        <input type="file" name="fileToUpload" id="fileToUpload" accept=".jpg, .jpeg, .png">
        <input type="submit" value="Upload Image" name="submit">
    </form>
</body>
</html>
