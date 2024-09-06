<?php

header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
$conn = new mysqli("localhost", "mine", "pass", "repo");

// Check connection
//make sure to have asection first
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
    if (isset($_POST['StudentIDField']) && !empty($_POST['StudentIDField']) && isset($_POST['SY']) && isset($_POST['ResearchT']) && isset($_POST['Course']) && isset($_POST['SectionName'])) {
        $TeacherEmail = $_POST['ResearchT'];
        $SectionName = $_POST['SectionName'];
        $Course = $_POST['Course'];
        $SHY = $_POST['SY'];
         $secID;
        $maxsection = $conn->query("SELECT MAX(`SectionID`) FROM `Sectionn&CapTeacherTBL` WHERE 1;");
                        while ($max = $maxsection->fetch_assoc()) {
                            
                            $secID = $max['MAX(`SectionID`)'] + 1;}

        $sqlSection = "INSERT INTO `sectionn&capteachertbl` (`SectionID`, `SectionName`, `CourseID`, `SchoolYR`, `SchoolID_Teacher`, `DateCreacted`) VALUES 
                    ($secID, '$SectionName', '$Course', '$SHY', '$TeacherEmail', DEFAULT);";


        if ($conn->query($sqlSection) === TRUE) {
        } else {
            echo "Error: " . $sqlSection . "<br>" . $conn->error;
        }
        
        
        // Loop through each input field value
        foreach ($_POST['StudentIDField'] as $key => $value) {
            // Output the value

            $escapedInput = $conn->real_escape_string($value);

            // Construct the SQL query to insert data into the database
            $sql = "INSERT INTO `Student&SectionTBL` (`StudentNSectionID`, `SchoolIDStudent`, `SectionId`,`date`) VALUES (default, '$value', '$secID',default);";

            // Execute the query
            if ($conn->query($sql) !== TRUE) {
                // If insertion fails, add an error message to the errors array
                $errors[] = "Error: " . $sql . "<br>" . $conn->error;
            }
        }
    } else {$r =$_POST['StudentIDField'];
        echo $r;
    }
}     
$conn->close();

// Check if there are any errors
if (!empty($errors)) {
    // If there are errors, output them

      echo json_encode([
            'success' => false,
            'message' => "$errors"]);
    
} else {
        // Return success response
        echo json_encode([
            'success' => true,
            'message' => "Section Created successfully."
        ]);
    
}

?>