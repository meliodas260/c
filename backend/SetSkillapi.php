<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database connection
    $servername = "localhost";
    $username = "mine";
    $password = "pass";
    $dbname = "repo";

    $pdo = new mysqli($servername, $username, $password, $dbname);
    $ResearchID = $_COOKIE["ResearchNya"];
    $Email = $_COOKIE["Email"];
    echo $Email;
    
    // // Check connection
    if ($pdo->connect_error) {
        die("Connection failed: " . $pdo->connect_error);
    }
    foreach ($_POST['inputField'] as $key => $keyword) {
        if (!empty($keyword)) {
        // Check if keyword exists
        $check_sql = "SELECT * FROM `SkillTBL` WHERE `SkillNAme` = '$keyword'";
        $check_result = $pdo->query($check_sql);
        if ($check_result->num_rows == 0) {
            // Keyword doesn't exist, insert it
            $insert_keyword_sql = "INSERT INTO `SkillTBL` (`SkillNAme`, `date`) VALUES ('$keyword', current_timestamp());";
            $pdo->query($insert_keyword_sql);
        }
        // Insert keyword ID and research ID into the bridge table
        $insert_bridge_sql = "INSERT INTO `SkillConnectTBL` (`SkillConID`, `Email`,`ResearchID`, `SKillName`, `date`) VALUES (NULL, '$Email','$ResearchID', '$keyword', current_timestamp());";
        $pdo->query($insert_bridge_sql);
    }
}
}
?>