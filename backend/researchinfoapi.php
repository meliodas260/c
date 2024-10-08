<?php
// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require 'dblogin.php';

    // Retrieve form data
    $title = $_POST['Title'];
    $abstract = $_POST['Abstract'];
    $ResearchID = $_COOKIE["ResearchNya"];

    // Prepare and execute INSERT statement for research info
    $sql = "UPDATE `ResearchTBL` SET `Title` = '$title' ,`Abstract` ='$abstract' WHERE `ResearchTBL`.`ResearchID` = '$ResearchID';";
    $pdo->query($sql);

    // Insert keywords
    // $_POST['EmailField'] as $key => $value
    
    foreach ($_POST['inputField'] as $key => $keyword) {
            if (!empty($keyword)) {
            // Check if keyword exists
            $check_sql = "SELECT * FROM `KeywordsTBL` WHERE Keywords = '$keyword'";
            $check_result = $pdo->query($check_sql);
            if ($check_result->num_rows == 0) {
                // Keyword doesn't exist, insert it
                $insert_keyword_sql = "INSERT INTO `KeywordsTBL` (`keywords`, `datecreated`) VALUES ('$keyword', current_timestamp());";
                $pdo->query($insert_keyword_sql);
            }
            // Insert keyword ID and research ID into the bridge table
            $insert_bridge_sql = "INSERT INTO `ReasearchKeyWordsTBL` (`ReasearchKeyWordsD`, `ReasearchID`, `Keywords`, `date`) VALUES (NULL, '$ResearchID', '$keyword', current_timestamp());";
            $pdo->query($insert_bridge_sql);
        }
    }

    // Insert tags
    
    foreach ($_POST['tags'] as $key => $tag) {
            if (!empty($tag)) {
            // Check if tag exists
            $check_tag_sql = "SELECT * FROM `TagTBL` WHERE `TagName` = '$tag'";
            $check_tag_result = $pdo->query($check_tag_sql);
            if ($check_tag_result->num_rows == 0) {
                // Tag doesn't exist, insert it
                //
                $insert_tag_sql = "INSERT INTO `TagTBL` (`TagName`, `date`) VALUES ('$tag', current_timestamp());";
                $pdo->query($insert_tag_sql);
            }

            // Insert tag ID and research ID into the bridge table
            $insert_tag_bridge_sql = "INSERT INTO `ReasearchTagTBL` (`ResearchTagID`, `ReasearchID`, `TagName`, `date`) VALUES (NULL, '$ResearchID', '$tag', current_timestamp());";
            $pdo->query($insert_tag_bridge_sql);
        }
    }

    // // Close the database connection
    $pdo->close();
    header("Location: UploadResearchInfo.php");

    // Redirect the user to a success page or display a success message

}
?>
