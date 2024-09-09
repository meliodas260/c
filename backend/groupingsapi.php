<?php 

if (isset($_POST['Leader'])) {

    $conn = new mysqli("localhost", "mine", "pass", "repo");
  
    if ($conn->connect_error) {  // Check connection
        die("Connection failed: " . $conn->connect_error);
    }

    $SecID = $_POST['SecNumber'];
    $course = $_POST['course'];
    $Members = [ $_POST['Member1'],$_POST['Member2'],$_POST['Member3']];
    $panels = [$_POST['Panel1'], $_POST['Panel2'], $_POST['Panel3']];
    $LEmail = $_POST['Leader'];

    $currentDateTime = new DateTime(); // Creates a new DateTime object representing the current date and time
    $Roleconnector = $currentDateTime->format("YmdHis"); // Retrieves current date and time in YYYY-MM-DD HH:MM:SS format
    $Lead = "INSERT INTO `ResearchRoleTBL` ( `RoleConnectorKey`, `UID`, `Role`) VALUES ( '$Roleconnector', '$LEmail', 'Leader' );";
    if ($conn->query($Lead) !== TRUE) {    $errors[] = "Error: " . $Lead . "<br>" . $conn->error;   }
        
        $Advicer =$_POST['Advicer'];
        $Advicersql = "INSERT INTO `ResearchRoleTBL` ( `RoleConnectorKey`, `UID`, `Role`) VALUES ( '$Roleconnector', '$Advicer', 'Adviser' );";
    if ($conn->query($Advicersql) !== TRUE) {    $errors[] = "Error: " . $Advicersql . "<br>" . $conn->error;   }
        
        $Expert = $_POST['Expert'];
        $Expertsql = "INSERT INTO `ResearchRoleTBL` ( `RoleConnectorKey`, `UID`, `Role`) VALUES ( '$Roleconnector', '$Expert', 'Expert' );";
    if ($conn->query($Expertsql) !== TRUE) {    $errors[] = "Error: " . $Expertsql . "<br>" . $conn->error;   }

    foreach($Members as $key => $value){
        if(!($Members[$key] == null)){// dito lalagay ung mga input
            $membersql = "INSERT INTO `ResearchRoleTBL` ( `RoleConnectorKey`, `UID`, `Role`) VALUES ( '$Roleconnector', '$Members[$key]', 'Member' );";
            if ($conn->query($membersql) !== TRUE) {    $errors[] = "Error: " . $membersql . "<br>" . $conn->error;   }
                echo $Members[$key] . "<br>";
            }
    }
    foreach($panels as $key => $value){
        if(!($panels[$key] == null)){// dito lalagay ung mga input
            $panelsql = "INSERT INTO `ResearchRoleTBL` ( `RoleConnectorKey`, `UID`, `Role`) VALUES ( '$Roleconnector', '$panels[$key]', 'Panel$key' );";
            if ($conn->query($panelsql) !== TRUE) {    $errors[] = "Error: " . $panelsql . "<br>" . $conn->error;   }
        }
        }
}else{
           // SELECT * FROM `ResearchTBL` a LEFT JOIN `ResearchRoleTBL` b on a.ResearchID = b.ResearchID WHERE `Section` = '7' and b.ResearchID ='6';
        //    $sql = "INSERT INTO `ResearchTBL` (`ResearchID`, `Title`, `Abstract`, `filename`, `fileSize`, `YRPublished`, `CourseID`, `Status`, `TeacherComment`, `Section`) VALUES ($ReID, NULL, NULL, NULL, NULL, NULL, '$course', NULL, NULL, '$SecID')";
        //    if ($conn->query($sql) !== TRUE) {
        //        $errors[] = "Error: " . $sql . "<br>" . $conn->error;
        //    }
}








?>