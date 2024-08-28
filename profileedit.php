<?php
// Database connection
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'your_database';
$dsn = "mysql:host=$host;dbname=$database;charset=utf8mb4";

try {
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Fetch the user's current profile data
    $userId = 1; // Replace with dynamic user ID from session or URL
    $stmt = $pdo->prepare("SELECT username, profile_image FROM users WHERE id = :id");
    $stmt->execute(['id' => $userId]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Handle image upload
        if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] === UPLOAD_ERR_OK) {
            $fileTmpPath = $_FILES['profile_image']['tmp_name'];
            $fileName = $_FILES['profile_image']['name'];
            $fileSize = $_FILES['profile_image']['size'];
            $fileType = $_FILES['profile_image']['type'];
            $fileNameCmps = explode('.', $fileName);
            $fileExtension = strtolower(end($fileNameCmps));

            // Set allowed file extensions
            $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];

            if (in_array($fileExtension, $allowedExtensions)) {
                // Create a unique name for the file
                $newFileName = md5(time() . $fileName) . '.' . $fileExtension;
                $uploadFileDir = 'uploads/';
                $destFilePath = $uploadFileDir . $newFileName;

                if (move_uploaded_file($fileTmpPath, $destFilePath)) {
                    // Update the profile image path in the database
                    $updateStmt = $pdo->prepare("UPDATE users SET profile_image = :profile_image WHERE id = :id");
                    $updateStmt->execute([
                        'profile_image' => $newFileName,
                        'id' => $userId
                    ]);

                    // Update $user array to reflect the new profile image
                    $user['profile_image'] = $newFileName;

                    $message = "Profile image updated successfully!";
                } else {
                    $message = "There was an error moving the uploaded file.";
                }
            } else {
                $message = "Unsupported file type.";
            }
        }
    }
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<?php
include 'modal/header.php';
?>
<body>
    <div class="container mt-5">
        <h2>Profile</h2>
        <div>
        <img src="${imageUrl}" alt="Research Image" class="research-image" style="width:400px;
         heigth:400px;  
        display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            border:2px solid blue; 
            border-radius:100%">
        </div>
        <?php if (isset($message)) : ?>
            <div class="alert alert-success" role="alert">
                <?php echo htmlspecialchars($message); ?>
            </div>
        <?php endif; ?>

        <form method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="profile_image" class="form-label">Profile Image</label>
                <input type="file" class="form-control" id="profile_image" name="profile_image">
            </div>
            <button type="submit" class="btn btn-primary">Upload Image</button>
        </form>

        <div class="mt-4">
            <h4>Profile Details</h4>
            <p><strong>Username:</strong> <?php echo htmlspecialchars($user['username']); ?></p>
            <p><strong>Profile Image:</strong></p>
            <?php if ($user['profile_image']) : ?>
                <img src="uploads/<?php echo htmlspecialchars($user['profile_image']); ?>" alt="Profile Image" class="img-thumbnail" style="width: 150px;">
            <?php else : ?>
                <p>No profile image uploaded.</p>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
