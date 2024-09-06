<?php
header('Content-Type: application/json'); 

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exeption;

require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';
require 'PHPMailer-master/src/Exception.php';
$notif = "sige";
    if (isset($_POST['ID']) && isset( $_POST['Email']) && isset($_POST['UserType']) && isset($_POST['Fname']) && isset($_POST['Mname']) && isset($_POST['Lname']) && isset($_POST['suffix'])  && isset($_POST['gender'])) {
 $UID = $_POST['ID'];
   $email = $_POST['Email'];
    $status = $_POST['UserType'];
    $fname = $_POST['Fname'];
    $mname = $_POST['Mname'];
    $lname = $_POST['Lname'];
    $suffix = $_POST['suffix'];
    $gender = $_POST['gender'];
    // Extract form data

    
// Generate a random password
function generateRandomPassword($length = 15) {
    $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()-_=+';
    return substr(str_shuffle($chars), 0, $length);
}

// Generate random password
$password = generateRandomPassword();

// Hash the password with salt
$hashed_password = md5($password);

// Verify the password
if ($hashed_password) {

    $conn = new mysqli("localhost", "mine", "pass", "repo");
  
    if ($conn->connect_error) {  // Check connection
        die("Connection failed: " . $conn->connect_error);
    }
    //Prepare SQL statement to insert data into a table
    $sql = "INSERT INTO `accounttbl` (`UserID`, `Email`, `SchoolId`, `Fname`, `Lname`, `Mname`, `Suffix`, `IsMale`, `imageName`, `Password`, `DateCreated`, `Usertype`) 
    VALUES (NULL, '$email', '$UID', '$fname', '$lname', '$mname', '$suffix', '$gender', NULL, '$hashed_password', DEFAULT, '$status')";
    // $sql = "INSERT INTO accounttbl (UserID, Email, Usertype, Fname, Mname, Lname, Suffix, Gender,Password,asin,DateCreated) 
    //         VALUES ('$UID','$email', '$status', '$fname', '$mname', '$lname', '$suffix', '$gender' , '$hashed_password', '$salt', DEFAULT)";
    
        try{  $conn->query($sql) === TRUE;
           
            // $to_email = $email; // Email address to which you want to send the email
            // $subject = "Password giver"; // Subject of the email
            // $message = " your password to repo system is $password"; // Body of the email

            // // Gmail SMTP configuration
            // $smtp_username = "lestersayson206@gmail.com"; // Your Gmail email address
            // $smtp_password = "mzvv vlse dpyb vtpn"; // Your Gmail app-specific password
            
            // // Create PHPMailer object
            // $mail = new PHPMailer;

            // // SMTP configuration
            // $mail->isSMTP();
            // $mail->Host = 'smtp.gmail.com';
            // $mail->SMTPAuth = true;
            // $mail->Username = $smtp_username;
            // $mail->Password = $smtp_password;
            // $mail->SMTPSecure = 'ssl';
            // $mail->Port = 465;

            // // Email content
            // $mail->setFrom($smtp_username);
            // $mail->addAddress($to_email);
            // $mail->Subject = $subject;
            // $mail->Body = $message;

        // Send email
        $lol = true;
        if($lol){
        // if ($mail->send()) {
            if ($lol) {
                // Return success response
                echo json_encode([
                    'success' => true,
                    'message' => "Hello, ! Your form was successfully submitted."
                ]);
            } else {
                // Return error response
                echo json_encode([
                    'success' => false,
                    'message' => "Please provide a valid name."
                ]);

            }
        } else {
          echo $password;
        }
    } catch(Exception $e) {
        echo "SQL Error: " . $e->getMessage();
    }
    
    $conn->close();


} else {
    $notif = "dikoalam";
}
    
}




    if(isset($_FILES['excel_file']) && $_FILES['excel_file']['error'] == UPLOAD_ERR_OK){
        // Include PHPExcel library
        require_once 'PHPExcel/Classes/PHPExcel.php';

        // Get file details
        $file_name = $_FILES['excel_file']['name'];
        $file_tmp = $_FILES['excel_file']['tmp_name'];

        // Load Excel file
        $objPHPExcel = PHPExcel_IOFactory::load($file_tmp);

        // Get worksheet
        $worksheet = $objPHPExcel->getActiveSheet();

        // Loop through rows
        foreach($worksheet->getRowIterator() as $row){
            // Get cell values
            $cellIterator = $row->getCellIterator();
            $cellIterator->setIterateOnlyExistingCells(FALSE);

            $data = [];
            foreach ($cellIterator as $cell) {
                $data[] = $cell->getValue();
            }

            echo implode($data);
            // // Save data to MySQL
            // // Modify this part according to your MySQL connection and table structure
            // $connection = mysqli_connect("localhost", "username", "password", "database_name");
            // $data = array_map('mysqli_real_escape_string', $data); // Prevent SQL injection
            // $query = "INSERT INTO your_table_name (column1, column2, column3) VALUES ('" . implode("','", $data) . "')";
            // mysqli_query($connection, $query);
        }

        // Close MySQL connection
        mysqli_close($connection);

        echo "Data imported successfully!";
    } else {
        // echo "Error uploading file.";
            }
 
?>
