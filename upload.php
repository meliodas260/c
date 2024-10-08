<?php
    require 'backend/dblogin.php';

    // Check connection
    if (!$pdo) {
        die("Connection failed: " . $pdo->errorInfo());
    }
// Check if the form is submitted
if (isset($_POST['submit'])) {
    // Directory where the uploaded file will be saved
    $target_dirIMG = "UploadIMG/";
    $currentDateTime = new DateTime();
    $sesid = $currentDateTime->format("YmdHis");
    // Path to the uploaded file
    $newfileNameIMG =  $sesid. basename($_FILES["fileToUpload"]["name"]);
    $target_fileIMG = $target_dirIMG . $newfileNameIMG;

    // Set a flag to check if the upload is valid
    $uploadOkIMG = 1;

    // Get the file extension
    $imageFileType = strtolower(pathinfo($target_fileIMG, PATHINFO_EXTENSION));

    // Check if the file is an actual image or fake image
    if (isset($_POST["submit"])) {
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if ($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOkIMG = 1;
        } else {
            echo "File is not an image.";
            $uploadOkIMG = 0;
        }
    }

    // Check if file already exists
    if (file_exists($target_fileIMG)) {
        echo "Sorry, file already exists.";
        $uploadOkIMG = 0;
    }

    // Limit the file size (e.g., 500KB)
    if ($_FILES["fileToUpload"]["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOkIMG = 0;
    }

    // Allow certain file formats (JPEG, PNG, JPG, GIF)
    if (
        $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    ) {
        echo "Sorry, only JPG, JPEG & PNG are allowed.";
        $uploadOkIMG = 0;
    }

    // Check if $uploadOkIMG is set to 0 by an error
    if ($uploadOkIMG == 0) {
        echo "Sorry, your file was not uploaded.";
    } else {
        // If all checks pass, try to upload the file
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_fileIMG)) {
            echo "The file " . htmlspecialchars(basename($_FILES["fileToUpload"]["name"])) . " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
        $ResearchID = $_POST['ResearchID']; // Example ResearchID
        echo "adsd". $ResearchID;

        // SQL queries
        $sql = "UPDATE `ResearchTBL` SET `ImageName` = :new_filename WHERE `ResearchTBL`.`ResearchID` = :ResearchID;";

        try {
            // Prepare and execute the update query
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                ':new_filename' => $newfileNameIMG,
                ':ResearchID' => $ResearchID
            ]);

            echo "Metadata inserted successfully.";
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}
?>