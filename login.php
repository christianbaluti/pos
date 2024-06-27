<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "PointOfSale";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $position = $_POST['position'];

    // Prepare and execute the SQL statement
    $stmt = $conn->prepare("SELECT * FROM users WHERE active='yes' AND username = ? AND position = ?");
    $stmt->bind_param('ss', $username, $position);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // Verify the password
        if ($user['password'] === $password) {
            if ($position=='admin') {
            	$_SESSION['pos_username'] = $user['username'];
            	header('location: ./main.php');
            } else{
            	$_SESSION['pos_username_employee'] = $user['username'];
            	header('location: ./employee_page.php');
            }
            
        } else {
            header('location: ./index.php?loginerror=loginerror');
        }
    } else {
        header('location: ./index.php?nouser=nouser');
    }

    $stmt->close();
}
?>
