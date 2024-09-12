<?php 
    header('Content-Type: application/json');

    $pdo = new mysqli("localhost", "mine", "pass", "repo");
if ($_SERVER["REQUEST_METHOD"] == "POST") {


     $UID = $_POST['UID'];
     $secID = $_POST['secID'];


    $sql = "INSERT INTO `Student&SectionTBL` (`StudentNSectionID`, `UIDStudent`, `SectionId`) VALUES (NULL, '$UID', '$secID');";

    try{  $pdo->query($sql) === TRUE;

            echo json_encode([
                'success' => true,
                'message' => "Hello, ! Your form was successfully submitted."
            ]);

                    
    
                

    } catch(Exception $e) {
        echo "SQL Error: " . $e->getMessage();
        // Return error response
                    echo json_encode([
                        'success' => false,
                        'message' => "Please provide a valid name."
                    ]);
    }

    
}
if ($_SERVER["REQUEST_METHOD"] == "GET") {


    $host = 'localhost';
    $username = 'mine';
    $password = 'pass';
    $database = 'repo';
    $dsn = "mysql:host=$host;dbname=$database;charset=utf8mb4";
    
    try {
        $pdo = new PDO($dsn, $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
        // Select data from the database
        $stmt = $pdo->query("SELECT `Fname`, `Mname`, `Lname`, `Usertype`, `UserID` FROM Accounttbl ORDER BY `Fname` ASC");
        
        // Prepare data for DataTables
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        // Return JSON response
        echo json_encode($data);
    } catch (PDOException $e) {
        echo json_encode(["error" => $e->getMessage()]);
    }
    
    $pdo = null;
}






?>