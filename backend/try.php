<?php

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['username']) && isset($_GET['password'])) {
    $conn = new mysqli("localhost", "mine", "pass", "repo");

    // Check connection
    if ($conn->connect_error) {
        echo "error";
    }

    // Sanitize user inputs to prevent SQL injection
    $username = $_GET['username'];
    $password = $_GET['password'];

    // SQL query to fetch data
    $sql = "SELECT Password ,UserID, Usertype FROM accounttbl WHERE Email = '$username'   ";
    $result = $conn->query($sql);
    
    
    if ($result->num_rows > 0) {
        $UserInfo = $result->fetch_assoc();
        
        $hashedPasswordFromDatabase = $UserInfo['Password'];
        $UID = $UserInfo['UserID'];
        
        // Verify the password
        if (md5($password) === $hashedPasswordFromDatabase) {

            $currentDateTime = new DateTime(); // Creates a new DateTime object representing the current date and time
            $sesid = $currentDateTime->format("YmdHis"); // Retrieves current date and time in YYYY-MM-DD HH:MM:SS format

            $date = $currentDateTime->format('Y-m-d H:i:s');

            // Add 7 days to the current date
            $currentDateTime->modify('+7 days');

            // Format the date and time as required for MySQL datetime format
            $dateExpire = $currentDateTime->format('Y-m-d H:i:s');

            $status = $UserInfo['Usertype'];
            $sqlRepSesIDs = "SELECT * FROM `usertypetbl` WHERE `UserStatus` = '$status'";
            $RepSesIDs = $conn->query($sqlRepSesIDs);
            $UserType = $RepSesIDs->fetch_assoc();
            if ($UserType['usertype'] == 1) {
                $SESID = $sesid . "1";
                //admin sya
                updateSessionCookies($SESID, $UID,$dateExpire,$date);
                header("Location: ../Accounts.php");
                exit;
            } elseif ($UserType['usertype'] == 2) {
                //check if researcher or capstone teacher
                $CapT = "SELECT MAX(`DateCreacted`) FROM `Sectionn&CapTeacherTBL` WHERE `UID_Teacher`='$UID' LIMIT 1;";
                $CheckcapT = $conn->query($CapT);
                if($CheckcapT){
                    $anolaman = $CheckcapT->fetch_assoc();
                    if(!($anolaman['MAX(`DateCreacted`)'] == null)){
                        $SESID = $sesid . "9";
                        //edi teacher sya
                        updateSessionCookies($SESID,$UID,$dateExpire,$date);
                        header("Location: ../CapTSection.php");
                        exit;
                    }else{

                        $Role = "SELECT * FROM `ResearchRoleTBL` WHERE `UID` ='$UID';";
                        $roles = $conn->query($Role);
                        $anolamans = $roles->fetch_assoc();
                            if($anolamans['Role'] == "Leader"){//leader

                                $SESID = $sesid . "8";
                                $Research = $anolamans['ResearchID'];
                                //edi Researcher sya
                                $expiration_time = time() + (86400 * 7);
                                setcookie("ResearchNya", $Research, $expiration_time, "/", "", false, true);
                                updateSessionCookies($SESID,$UID,$dateExpire,$date);
                                header("Location: ../UploadResearchInfo.php");
                            }elseif($anolamans['Role'] == "Member"){//members

                                $SESID = $sesid . "7"; 
                                $Research = $anolamans['ResearchID'];
                                //edi Researcher sya
                                $expiration_time = time() + (86400 * 7);
                                setcookie("ResearchNya", $Research, $expiration_time, "/", "", false, true);
                                updateSessionCookies($SESID,$UID,$dateExpire,$date);
                                header("Location: ../UploadResearchInfo.php");
                            }else{
                                $SESID = $sesid . "0";
                                //edi USER sya
                                updateSessionCookies($SESID,$UID,$dateExpire,$date);
                                header("Location: ../homepage.php");
                            }
//1 admin, 9 Capstone Teacher, 8 Lead Researcher, 7 Member Researcher
                        
                    }
                }
                
                updateSessionCookies("User",$username);
                header("Location: ../homepage.php");
                exit;
            

            } else{
                $role = "Ekis";
            }
        } else {
            header("Location: ../index.php?error=true");
            exit;
        }
    

    } 
    else {
        header("Location: ../index.php?error=true");
        exit;
    }

    // Close connection
       $conn->close();
}


function updateSessionCookies($sesid, $UID,$dateExpire,$date) {
    $conn = new mysqli("localhost", "mine", "pass", "repo");
    session_start(); 
    // Set the cookie
    $cookie_name = "RepSesID";
    $cookie_Session = $sesid;
    $expiration_time = time() + (86400 * 7); //7days
    $path = "/"; // Available in the entire domain
    $domain = ""; // Use your domain here if needed
    $secure = false; // Set it to true if you're using HTTPS
    $http_only = true; // Only accessible through HTTP (not JavaScript)

    $Check ="INSERT INTO `logTBL` (`SessionID`, `UID`, `datelogin`, `DateExpire`) 
    VALUES ('$sesid', '$UID', '$date', '$dateExpire');";
    try{ $conn->query($Check) === TRUE;
    }catch(Exception $e) {
        echo "Error: ";
    }
    setcookie("Email", $UID, $expiration_time, $path, $domain, $secure, $http_only);
    setcookie($cookie_name, $cookie_Session, $expiration_time, $path, $domain, $secure, $http_only);

    
    $conn->close();
}

?>

