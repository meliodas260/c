<?php
header('Content-Type: application/json'); 
require 'dblogin.php';
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


        $userGreeting = putusers($UID , $email, $status , $fname,
         $mname ,
         $lname ,
         $suffix ,
         $gender);
}

function putusers( $UID, $email,  $status, $fname, $mname, $lname, $suffix, $gender) {
    global $pdo;
    
    // Generate a random password
    if (!function_exists('generateRandomPassword')) {
        function generateRandomPassword($length = 15) {
            $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()-_=+';
            return substr(str_shuffle($chars), 0, $length);
        }
    }
    // Generate random password
    $password = generateRandomPassword();
    // Hash the password
    $hashed_password = md5($password);
    
    // Verify the password
    if ($hashed_password) {
        //Prepare SQL statement to insert data into a table
        $sql = "INSERT INTO `accounttbl` (`UserID`, `Email`, `SchoolId`, `Fname`, `Lname`, `Mname`, `Suffix`, `IsMale`, `imageName`, `Password`, `DateCreated`, `Usertype`) 
        VALUES (NULL, '$email', '$UID', '$fname', '$lname', '$mname', '$suffix', '$gender', NULL, '$hashed_password', DEFAULT, '$status')";
        
            try{  $pdo->query($sql) === TRUE;
               
                $to_email = $email; // Email address to which you want to send the email
                $subject = "Password giver"; // Subject of the email
                $message = " your password to repo system is $password"; // Body of the email
    
                // Gmail SMTP configuration
                $smtp_username = "lestersayson206@gmail.com"; // Your Gmail email address
                $smtp_password = "mzvv vlse dpyb vtpn"; // Your Gmail app-specific password
                
                // Create PHPMailer object
                $mail = new PHPMailer;
    
                // SMTP configuration
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = $smtp_username;
                $mail->Password = $smtp_password;
                $mail->SMTPSecure = 'ssl';
                $mail->Port = 465;
    
                // Email content
                $mail->setFrom($smtp_username);
                $mail->addAddress($to_email);
                $mail->Subject = $subject;
                $mail->Body = $message;
    
            // Send email
            if ($mail->send()) {
    
                    // Return success response
                    echo json_encode([
                        'success' => true,
                        'message' => "Hello, ! Your form was successfully submitted."
                    ]);
    
    
    
                
            } else {
                                // Return error response
                                echo json_encode([
                                    'success' => false,
                                    'message' => $fname . $lname .  $mname . $suffix . "not inputed"
                                ]);
              echo $password;
            }
        } catch(Exception $e) {
            echo "SQL Error: " . $e->getMessage();
        }
        
    
    
    } else {
        $notif = "dikoalam";
    }
    
            }


            $target_dir = "../uploads/";
            $target_file = $target_dir . basename($_FILES["file"]["name"]);
            $uploadOk = 1;
            $fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        
            // Check if the file is an Excel file
            if ($fileType != "xls" && $fileType != "xlsx") {
                echo "Sorry, only Excel files are allowed.";
                $uploadOk = 0;
            }
        
            if ($uploadOk == 1) {
                // Upload the file
                if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
                    echo "The file has been uploaded.<br>";
        
                    // Call Python script to read the Excel file
                    $command = escapeshellcmd("python ../backend/try.py " . escapeshellarg($target_file));
                    $output = trim(shell_exec($command));
                    
                    // Check if any output was returned by the Python script
                    if ($output) {
                        // Decode the JSON string into an associative array
                        $decoded_data = json_decode($output, true);
                    
                        // Check for JSON errors
                        if (json_last_error() !== JSON_ERROR_NONE) {
                            echo "JSON decoding error: " . json_last_error_msg();
                        } else {
                            // Check if there's data to process
                            if (!empty($decoded_data) && is_array($decoded_data)) {
                                foreach ($decoded_data as $row) {
                                    // Use null if the column is missing or empty
                                    $UID = isset($row['UID']) ? $row['UID'] : null;
                                    $email = isset($row['email']) ? $row['email'] : null;
                                    $status = isset($row['status']) ? $row['status'] : null;
                                    $fname = isset($row['fname']) ? $row['fname'] : null;
                                    $mname = isset($row['mname']) ? $row['mname'] : null;
                                    $lname = isset($row['lname']) ? $row['lname'] : null;
                                    $suffix = isset($row['suffix']) ? $row['suffix'] : null; // Allow suffix to be empty
                                    $gender = isset($row['gender']) ? $row['gender'] : null;
                                
                                    // Call your function
                                    $userGreeting = putusers($UID, $email, $status, $fname, $mname, $lname, $suffix, $gender);
                                }
                                
                                echo "Data has been processed.";
                            } else {
                                echo "No data to process.";
                            }
                        }
                    } else {
                        echo "No output was returned from the Python script.";
                    }
                    

                } else {
                    echo "Sorry, there was an error uploading your file.";
                }
            }
            
        
?>
