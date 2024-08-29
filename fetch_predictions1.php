<?php
// Database connection
$conn = new mysqli("localhost", "mine", "pass", "repo");
predictStudentInSection(){
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $input = $_POST['input'];
        $sec = $_POST['secid'];

        // $Status = $_POST['input2'];
        // Fetch predictions from the database
        // SELECT * FROM `Student&SectionTBL` WHERE `SectionId` = 7;
        $sql = "SELECT * FROM `Student&SectionTBL` WHERE `UID` like '%$input%' and `SectionId` = '$sec';";
        $result = $conn->query($sql);

        $predictions = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $predictions[] = $row['UID'];
            }
        }

        // Return predictions as JSON
        echo json_encode($predictions);

        $conn->close();
    }
?>
