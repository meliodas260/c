<?php
require 'backend/dblogin.php';

// Get the logged-in student's ID from the cookie
$students_id = $_COOKIE["Email"];

try {
    // Fetch the RoleConnectorKey for the student
    $stmtRoleConnector = $pdo->prepare("SELECT `RoleConnectorKey` FROM `researchroletbl` WHERE `UID` = :students_id");
    $stmtRoleConnector->bindParam(':students_id', $students_id, PDO::PARAM_STR);
    $stmtRoleConnector->execute();
    $roleConnectorKey = $stmtRoleConnector->fetch(PDO::FETCH_COLUMN);

    if ($roleConnectorKey) {
        // Fetch all users with the same RoleConnectorKey and non-student roles, including existing ratings
        $stmtUsers = $pdo->prepare("
            SELECT 
                b.UID, 
                CONCAT(c.Fname, ' ', c.Mname, ' ', c.Lname, ' ', c.Suffix) AS fullname, 
                a.RoleName, 
                (SELECT `Rate` FROM `teacherratetbl` WHERE `UID_Student` = :students_id AND `UID_Teacher` = b.UID) AS existing_rate
            FROM `researchroletbl` b
            LEFT JOIN `roletbl` a ON a.RoleID = b.Role
            LEFT JOIN `accounttbl` c ON b.UID = c.UserID
            WHERE b.RoleConnectorKey = :roleConnectorKey
            AND b.Role IN (SELECT RoleID FROM roletbl WHERE Usertype <> 3)
            AND b.UID <> :students_id
        ");
        $stmtUsers->bindParam(':roleConnectorKey', $roleConnectorKey, PDO::PARAM_STR);
        $stmtUsers->bindParam(':students_id', $students_id, PDO::PARAM_STR);
        $stmtUsers->execute();
        $usersToRate = $stmtUsers->fetchAll(PDO::FETCH_ASSOC);
    } else {
        $usersToRate = [];
    }
} catch (PDOException $e) {
    die("Error: " . $e->getMessage());
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['rate'], $_POST['uid_teacher'])) {
    $uid_teacher = $_POST['uid_teacher'];
    $rate = $_POST['rate'];

    try {
        // Check if the student already rated the teacher
        $stmtCheck = $pdo->prepare("SELECT COUNT(*) FROM `teacherratetbl` WHERE `UID_Student` = :students_id AND `UID_Teacher` = :uid_teacher");
        $stmtCheck->bindParam(':students_id', $students_id, PDO::PARAM_STR);
        $stmtCheck->bindParam(':uid_teacher', $uid_teacher, PDO::PARAM_STR);
        $stmtCheck->execute();
        $exists = $stmtCheck->fetchColumn();

        if ($exists) {
            // Update the existing rating
            $stmtUpdate = $pdo->prepare("
                UPDATE `teacherratetbl` 
                SET `Rate` = :rate, `Date` = NOW() 
                WHERE `UID_Student` = :students_id AND `UID_Teacher` = :uid_teacher
            ");
            $stmtUpdate->bindParam(':rate', $rate, PDO::PARAM_INT);
            $stmtUpdate->bindParam(':students_id', $students_id, PDO::PARAM_STR);
            $stmtUpdate->bindParam(':uid_teacher', $uid_teacher, PDO::PARAM_STR);
            $stmtUpdate->execute();
            $message = "<div class='alert alert-success'>Rating updated successfully!</div>";
        } else {
            // Insert a new rating
            $stmtInsert = $pdo->prepare("
                INSERT INTO `teacherratetbl` (`RateID`, `UID_Student`, `UID_Teacher`, `Rate`, `Date`)
                VALUES (NULL, :students_id, :uid_teacher, :rate, NOW())
            ");
            $stmtInsert->bindParam(':students_id', $students_id, PDO::PARAM_STR);
            $stmtInsert->bindParam(':uid_teacher', $uid_teacher, PDO::PARAM_STR);
            $stmtInsert->bindParam(':rate', $rate, PDO::PARAM_INT);
            $stmtInsert->execute();
            $message = "<div class='alert alert-success'>Rating submitted successfully!</div>";
        }
    } catch (PDOException $e) {
        $message = "<div class='alert alert-danger'>Error: " . $e->getMessage() . "</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="css/custom2.css" rel="stylesheet">
    <link href="css/sidebar.css" rel="stylesheet">
    <title>Rate Teachers</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<?php include 'modal/header.php'; ?>
<body>
<div class="content">
        <div class="sidebar">
            <?php include 'modal/adminSidebar.php'; ?>
        </div>

        <div class="main-content">
            <div class="container mt-5">
                <h1 class="text-center">Rate Your Teachers</h1>

                <?php if (isset($message)) echo $message; ?>

                <?php if (!empty($usersToRate)): ?>
                    <form method="POST" class="mt-4">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Full Name</th>
                                    <th>Role</th>
                                    <th>Rate</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($usersToRate as $user): ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($user['fullname']); ?></td>
                                        <td><?php echo htmlspecialchars($user['RoleName']); ?></td>
                                        <td>
                                            <input type="hidden" name="uid_teacher" value="<?php echo $user['UID']; ?>">
                                            <select name="rate" class="form-select" required>
                                                <option value="" disabled <?php echo is_null($user['existing_rate']) ? 'selected' : ''; ?>>Rate</option>
                                                <?php for ($i = 1; $i <= 5; $i++): ?>
                                                    <option value="<?php echo $i; ?>" <?php echo $user['existing_rate'] == $i ? 'selected' : ''; ?>>
                                                        <?php echo $i; ?> - <?php echo ['Poor', 'Fair', 'Good', 'Very Good', 'Excellent'][$i - 1]; ?>
                                                    </option>
                                                <?php endfor; ?>
                                            </select>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                        <button type="submit" class="btn btn-primary w-100">Submit Rating</button>
                    </form>
                <?php else: ?>
                    <div class="alert alert-warning text-center">No teachers available to rate.</div>
                <?php endif; ?>
            </div>
        </div>
</div>
</body>
</html>
