<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database connection
    require 'dblogin.php';

    // Check connection
    if (!$pdo) {
        die("Connection failed: " . $pdo->errorInfo());
    }

    // Upload file
    $target_dir = "../pdfs/";
    $target_file = $target_dir . basename($_FILES["pdfFile"]["name"]);
    $uploadOk = 1;
    $fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if file is a PDF
    if ($fileType != "pdf") {
        echo "Sorry, only PDF files are allowed.";
        $uploadOk = 0;
    }

    $currentDateTime = new DateTime();
    $sesid = $currentDateTime->format("YmdHis");
    $new_filename = $sesid . '.pdf'; // Generate a unique filename with lowercase extension

    $target_file = $target_dir . $new_filename;

    // Check if upload was successful
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    } else {
        if (move_uploaded_file($_FILES["pdfFile"]["tmp_name"], $target_file)) {
            echo "The file " . basename($_FILES["pdfFile"]["name"]) . " has been uploaded.";

            // Insert metadata into database
            $filesize = $_FILES["pdfFile"]["size"];
             
            
            // You need to define these variables based on your logic
            $ResearchID = $_POST['ResearchID']; // Example ResearchID
            echo "adsd". $ResearchID;

            // SQL queries
            $sql = "UPDATE `ResearchTBL` SET `fileName` = :new_filename WHERE `ResearchTBL`.`ResearchID` = :ResearchID;";
            $insertsql = "INSERT INTO `ResearchFilelogtbl` (`ResearchID`, `newfilename`, `timestamp`) 
                          VALUES (:ResearchID, :new_filename,  current_timestamp());";

            try {
                // Prepare and execute the update query
                $stmt = $pdo->prepare($sql);
                $stmt->execute([
                    ':new_filename' => $new_filename,
                    ':ResearchID' => $ResearchID
                ]);

                // Prepare and execute the insert query
                $stmt = $pdo->prepare($insertsql);
                $stmt->execute([
                    ':ResearchID' => $ResearchID,
                    ':new_filename' => $new_filename,
                ]);

                echo "Metadata inserted successfully.";
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
echo "gege";
}
?>
