<?php


    // Database connection
    $conn = new mysqli("localhost", "mine", "pass", "repository");
predictTeacher(){
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $input = $_POST['input'];
        // $Status = $_POST['input2'];
        // Fetch predictions from the database
        // $sql = "SELECT `Email` FROM `AccountTBL` WHERE Email LIKE '$input%' and `Status` = '$Status';";
        $sql = "SELECT `UserID` FROM `AccountTBL` WHERE `UserID` LIKE '$input%' and `Usertype` = 'Teacher';";
        $result = $conn->query($sql);

        $predictions = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $predictions[] = $row['UserID'];
            }
        }

        // Return predictions as JSON
        echo json_encode($predictions);

        $conn->close();
    }
?>
