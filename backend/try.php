<?php

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['username']) && isset($_GET['password'])) {
    require 'dblogin.php';

    // Sanitize user inputs
    $username = $_GET['username'];
    $password = $_GET['password'];

    // Prepare SQL statement to prevent SQL injection
    $stmt = $pdo->prepare("SELECT Password, UserID, Usertype FROM accounttbl WHERE Email = :username");
    $stmt->execute([':username' => $username]);
    $UserInfo = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($UserInfo) {
        $hashedPasswordFromDatabase = $UserInfo['Password'];
        $UID = $UserInfo['UserID'];
        $status = $UserInfo['Usertype'];

        // Verify password using password_verify() for more secure comparison
        if (md5($password) === $hashedPasswordFromDatabase) {
            $currentDateTime = new DateTime();
            $sesid = $currentDateTime->format("YmdHis"); // Unique session ID
            $date = $currentDateTime->format('Y-m-d H:i:s');
            $currentDateTime->modify('+7 days'); // Add 7 days for session expiration
            $dateExpire = $currentDateTime->format('Y-m-d H:i:s');

            // Query to check the user's role
            $stmt = $pdo->prepare("SELECT UserStatus FROM `usertypetbl` WHERE UserStatus = :status");
            $stmt->execute([':status' => $status]);
            $UserType = $stmt->fetch(PDO::FETCH_ASSOC);

            // Check user role and set session cookies
            if ($UserType && $UserType['UserStatus'] == 1) {
                $SESID = $sesid . "1"; //admin
                updateSessionCookies($pdo, $SESID, $UID, $dateExpire, $date);
                header("Location: ../Accounts.php");
                exit;
            } elseif ($UserType && $UserType['UserStatus'] == 2) {
                // Check for Capstone Teacher
                $CapT = $pdo->prepare("SELECT MAX(DateCreacted) FROM `sectionn&capteachertbl` WHERE UID_Teacher = :UID");
                $CapT->execute([':UID' => $UID]);
                $anolaman = $CapT->fetchColumn();

                if ($anolaman) {
                    $SESID = $sesid . "9"; //Teacher
                    updateSessionCookies($pdo, $SESID, $UID, $dateExpire, $date);
                    header("Location: ../CapTSection");
                    exit;
                }  else {
                        // Default user role
                        $SESID = $sesid . "0"; // Default user
                        updateSessionCookies($pdo, $SESID, $UID, $dateExpire, $date);
                        header("Location: ../homepage.php");
                        exit;
                    }

                }
                else {
                // Check if the user is a researcher (Leader or Member)
                $RoleQuery = $pdo->prepare("
                    SELECT rr.Role, r.RoleID FROM researchroletbl rr JOIN roletbl r ON r.RoleID = rr.Role WHERE rr.UID = :UID AND r.Usertype = 3;
                ");
                $RoleQuery->execute([':UID' => $UID]);
                $userRole = $RoleQuery->fetch(PDO::FETCH_ASSOC);

                if ($userRole) {
                    // User has a valid researcher role
                    $SESID = $sesid . "8"; // Researcher role
                    updateSessionCookies($pdo, $SESID, $UID, $dateExpire, $date);
                    header("Location: ../profile");
                    exit;
                } else {
                    // Default user role
                    $SESID = $sesid . "0"; // Default user
                    updateSessionCookies($pdo, $SESID, $UID, $dateExpire, $date);
                    header("Location: ../homepage.php");
                    exit;
                }
            }  
        }else {
            // Invalid password
           header("Location: ../index.php?error=invalid_password");
            exit;
        }
    } else {
        // User not found
       header("Location: ../index.php?error=user_not_found");
        exit;
    }

    // Close connection
    $pdo = null;
}

// Function to update session cookies
function updateSessionCookies($pdo, $sesid, $UID, $dateExpire, $date) {
    session_start();

    // Insert session info into the database
    $stmt = $pdo->prepare("INSERT INTO `logtbl` (logID, UID, datelogin, DateExpire) VALUES ( default, :UID, :datelogin, :dateexpire)");
    $stmt->execute([
        ':UID' => $UID,
        ':datelogin' => $date,
        ':dateexpire' => $dateExpire
    ]);

    // Set cookies
    setcookie("Email", $UID, time() + (86400 * 7), "/", "", false, true); // Secure and HTTP-only
    setcookie("RepSesID", $sesid, time() + (86400 * 7), "/", "", false, true);
}

?>
