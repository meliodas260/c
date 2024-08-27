<?php 

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $conn = new mysqli("localhost", "mine", "pass", "repository");

     $UID = $_POST['UID'];
     $secID = $_POST['secID'];



        $sql = "INSERT INTO `Student&SectionTBL` (`StudentNSectionID`, `UID`, `SectionId`) VALUES (NULL, '$UID', '$secID');";

            // Execute the query
            if ($conn->query($sql) !== TRUE) {
                 header("Location: SEctioncontent.php?error=true");
                exit;  
                 
            }else{
               header("Location: SEctioncontent.php?tama=true");
                exit; 
             }
    
}






?>