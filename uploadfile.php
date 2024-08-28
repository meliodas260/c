<?php
require_once 'verifier.php';

    if(!VerifyResearcher()){
        header("Location: homepage.php");
        exit;
}
?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="css/custom2.css" rel="stylesheet"> 
    <title>PDF File Upload</title>
</head>
<body>

<?php   include 'modal/header.php'; 
        include 'modal/ResearcherSidebar.php';
        
 
                ?>

<div class="content">
 
    <h2>Upload Research File</h2>


    
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
       <?php 
            $servername = "localhost";
            $username = "mine";
            $password = "pass";
            $dbname = "repository";
            
        $conn = mysqli_connect($servername, $username, $password, $dbname);
        $ResearchID = $_COOKIE["ResearchNya"];
        $maxsection = $conn->query("SELECT a.filename, a.fileSize FROM `ResearchTBL` a WHERE `ResearchID`='$ResearchID';");
           $max = $maxsection->fetch_assoc();
           $pastname = $max['filename'];
           $pastsize = $max['fileSize'];
           if( $max['filename'] == null){
            $pastname ="none";
           $pastsize = "none";
           }
                
                echo "<h3>"." Research file upload : " . $pastname."</h3> <br>"; 

    ?>
    <div class="custom-file">
        <input type="file" class="custom-file-input"   name="file" accept=".pdf" id="file" id="file">
    </div>
    <br>
    <button type="submit" class="btn btn-primary buttonclean" name="submit">Upload</button>
    </form>


   
            <?php
       if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Database connection
           
        // Check connection
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }
        // Upload file
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["file"]["name"]);
        $uploadOk = 1;
        $fileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));


        // Check if file is a PDF
        if($fileType != "pdf") {
            echo "Sorry, only PDF files are allowed.";
            $uploadOk = 0;
        }
        $currentDateTime = new DateTime(); 
        $sesid = $currentDateTime->format("YmdHis");
        $new_filename = $sesid. '.PDF'; // Generate a unique filename

        $target_file = $target_dir . $new_filename;
        // Check if upload was successful
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        } else {
            if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
                echo "The file ". basename( $_FILES["file"]["name"]). " has been uploaded.";

                // Insert metadata into database
                $filesize = $_FILES["file"]["size"];
                //UPDATE `ResearchTBL` SET `fileSize` = '12' WHERE `ResearchTBL`.`ResearchID` = 1;
                //INSERT INTO pdf_metadata (filename, filesize, author) VALUES ('$new_filename', '$filesize', '$author')
                $sql = "UPDATE `ResearchTBL` SET `filename` = '$new_filename' , `fileSize`='$filesize' WHERE `ResearchTBL`.`ResearchID` = $ResearchID;";
                $insertsql = "INSERT INTO `ResearchFileLogTBL` (`update`, `ResearchID`, `pastfilename`, `pastfilesize`, `newfilename`, `newfilesize`, `timestamp`) VALUES 
                (NULL, '$ResearchID', '$pastname', '$pastsize', '$new_filename', '$filesize', current_timestamp());";
                try{ $conn->query($insertsql) === TRUE;
                }catch(Exception $e) {
                    echo "Error: ";
                }
                
                if (mysqli_query($conn, $sql)) {
                    echo " Metadata inserted successfully.";
                } else {
                    echo "Error: ";
                }

            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }

        mysqli_close($conn);
        header("Location: uploadfile.php");
    }
    ?>
    </div>
</body>
</html>