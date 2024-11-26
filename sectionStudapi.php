<?php
if (isset($_GET['secID'])) {
    $secID = $_GET['secID'];

    try {
        require 'backend/dblogin.php';

        // First query: Get all UIDStudent for the given SectionId from the student&sectiontbl
        $stmt1 = $pdo->prepare("
            SELECT a.UIDStudent 
            FROM `student&sectiontbl` as a
            WHERE a.SectionId = :secID
        ");

        // Bind the secID parameter to the query
        $stmt1->bindParam(':secID', $secID, PDO::PARAM_STR);

        // Execute the query
        $stmt1->execute();

        // Fetch all UIDStudent values
        $userIDs = $stmt1->fetchAll(PDO::FETCH_COLUMN, 0); // Fetch only the UIDStudent column

        if (count($userIDs) > 0) {
            // Second query: Get Fname, Mname, Lname, UserID from accounttbl based on UIDStudent
            $placeholders = str_repeat('?,', count($userIDs) - 1) . '?'; // Create placeholders for IN clause
            $stmt2 = $pdo->prepare("
                SELECT b.UserID, b.Fname, b.Mname, b.Lname 
                FROM `accounttbl` as b
                WHERE b.UserID IN ($placeholders)
            ");

            // Execute the second query with the array of UIDStudent values
            $stmt2->execute($userIDs);

            // Fetch all account data (UserID, Fname, Mname, Lname)
            $accountData = $stmt2->fetchAll(PDO::FETCH_ASSOC);

            if (count($accountData) > 0) {
                // Prepare an array of UserIDs for the next query
                $accountUserIDs = array_column($accountData, 'UserID');

                // Third query: Get RoleConnectorKey from researchroletbl based on UserID
                $placeholders = str_repeat('?,', count($accountUserIDs) - 1) . '?'; // Create placeholders for IN clause
                $stmt3 = $pdo->prepare("
                    SELECT c.UID, c.RoleConnectorKey 
                    FROM `researchroletbl` as c
                    WHERE c.UID IN ($placeholders)
                ");

                // Execute the third query with the array of UserID values
                $stmt3->execute($accountUserIDs);

                // Fetch the results from the third query (RoleConnectorKey)
                $roleConnectorKeys = $stmt3->fetchAll(PDO::FETCH_ASSOC);

                // Combine all data together
                $finalResults = [];
                foreach ($accountData as $index => $account) {
                    // If RoleConnectorKey exists, merge it, otherwise add an empty key
                    $roleKey = isset($roleConnectorKeys[$index]) ? $roleConnectorKeys[$index] : ['RoleConnectorKey' => null];
                    $finalResults[] = array_merge($account, $roleKey);
                }

                // Return the results as a JSON response
                echo json_encode($finalResults);

            } else {
                // If no account data found, return an empty array
                echo json_encode([]);
            }

        } else {
            // If no UIDStudent found for the given SectionId, return an empty array
            echo json_encode([]);
        }

    } catch (PDOException $e) {
        // Return an error message in case of an exception
        echo json_encode(["error" => $e->getMessage()]);
    }

    // Close the database connection
    $pdo = null;

} else {
    echo json_encode(["error" => "No secID provided."]);
}
?>
