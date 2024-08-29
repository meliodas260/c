    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.css">
    <?php

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $conn = new mysqli("localhost", "mine", "pass", "repo");


echo "<script>swal('Success!', 'Form submitted successfully!', 'success');</script>";
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
        if (isset($_POST['inputField']) && !empty($_POST['inputField'])) 
        {$maxsection = $conn->query("SELECT MAX(`SectionID`) FROM `Sectionn&CapTeacherTBL` WHERE 1;");
                        while ($max = $maxsection->fetch_assoc()) {
                            
                            echo $max['MAX(`SectionID`)'] + 1;}
            // Loop through each input field value
            foreach ($_POST['inputField'] as $key => $value) {
                // Output the value
                echo "Input field $key: $value<br>";

                $escapedInput = $conn->real_escape_string($value);


                // Construct the SQL query to insert data into the database
                // $sql = "INSERT INTO research_info (skills) VALUES ('$escapedInput')";
    
                // // Execute the query
                // if ($conn->query($sql) !== TRUE) {
                //     // If insertion fails, add an error message to the errors array
                //     $errors[] = "Error: " . $sql . "<br>" . $conn->error;
                // }
            }
        } else {
            echo "No input fields submitted.";
        }
    }     
    $conn->close();

    // Check if there are any errors
    if (!empty($errors)) {
        // If there are errors, output them
        foreach ($errors as $error) {
            echo $error . "<br>";
        }
    } else {
        // If there are no errors, output success message
        echo "All records inserted successfully.";
    }
 
    ?>   <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

