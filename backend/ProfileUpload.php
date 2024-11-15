<?php
    require 'dblogin.php';

    // Check connection
    if (!$pdo) {
        die("Connection failed: " . $pdo->errorInfo());
    }
    $UID = $_COOKIE["Email"];
// Check if the form is submitted
if (isset($_POST['submit'])) {
    // Directory where the uploaded file will be saved
    $target_dirIMG = "../Profiles/";
    $currentDateTime = new DateTime();
    $sesid = $currentDateTime->format("YmdHis");
    // Path to the uploaded file
    $newfileNameIMG =  $sesid. basename($_FILES["profile_image"]["name"]);
    $target_fileIMG = $target_dirIMG . $newfileNameIMG;

    // Set a flag to check if the upload is valid
    $uploadOkIMG = 1;

    // Get the file extension
    $imageFileType = strtolower(pathinfo($target_fileIMG, PATHINFO_EXTENSION));

    // Check if the file is an actual image or fake image
    if (isset($_POST["submit"])) {
        $check = getimagesize($_FILES["profile_image"]["tmp_name"]);
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
    if ($_FILES["profile_image"]["size"] > 500000) {
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
        if (move_uploaded_file($_FILES["profile_image"]["tmp_name"], $target_fileIMG)) {
            echo "The file " . htmlspecialchars(basename($_FILES["profile_image"]["name"])) . " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }

       
        // SQL query with only the `:UID` placeholder
        $sql = "UPDATE `accounttbl` SET `imageName` = :new_filename WHERE `accounttbl`.`UserID` = :UID;";
        try {
            // Prepare and execute the update query
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                ':new_filename' => $newfileNameIMG,
                ':UID' => $UID
            ]);
        
            echo "Metadata inserted successfully.";
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        
    }
}
if($_SERVER['REQUEST_METHOD'] == 'GET'){
   // SQL query
$sql = "SELECT `imageName` FROM `accounttbl` WHERE `UserID` = :UID";

try {
    // Prepare the statement
    $stmt = $pdo->prepare($sql);
    
    // Bind the parameter
    $stmt->bindParam(':UID', $UID, PDO::PARAM_STR);
    
    // Execute the statement
    $stmt->execute();
    
    // Fetch the result
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    // Check if data was found
    if ($result) {
        // Return JSON-encoded data
        echo json_encode($result);
    } else {
        echo json_encode(['error' => 'No data found']);
    }
} catch (PDOException $e) {
    // Handle the error
    echo json_encode(['error' => $e->getMessage()]);
}
}

?>