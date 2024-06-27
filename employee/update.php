<?php
include("../server/connection.php"); // Ensure database connection is included

$msg = '';

if (isset($_POST['update'])) {
    $id = mysqli_real_escape_string($db, $_POST['id']);
    $user = mysqli_real_escape_string($db, $_POST['username']);
    $firstname = mysqli_real_escape_string($db, $_POST['firstname']);
    $lastname = mysqli_real_escape_string($db, $_POST['lastname']);
    $number = mysqli_real_escape_string($db, $_POST['number']);
    $position = mysqli_real_escape_string($db, $_POST['position']);

    if (isset($_SESSION['pos_username_employee'])) {
        $username = $_SESSION['pos_username_employee'];

        // Prepare the SQL statement
        $stmt = $db->prepare("UPDATE users SET username=?, firstname=?, lastname=?, contact_number=? WHERE id=?");
        $stmt->bind_param("ssssi", $user, $firstname, $lastname, $number, $id);

        if ($stmt->execute()) {
            // Log the update
            $logs_stmt = $db->prepare("INSERT INTO logs (username, purpose) VALUES (?, ?)");
            $purpose = "User $firstname updated";
            $logs_stmt->bind_param("ss", $username, $purpose);
            $logs_stmt->execute();

            // Redirect after update
            header('Location: ../employee/profile.php?updated');
            exit();
        } else {
            $msg = "Error updating record: " . $stmt->error;
        }

        $stmt->close();
        $logs_stmt->close();
    } else {
        $msg = "Session variable 'pos_username_employee' is not set.";
    }
}

if (!empty($msg)) {
    echo $msg;
}
?>
