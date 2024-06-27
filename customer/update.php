<?php
include('../server/connection.php');
$alert = array();

if (isset($_POST['update_customer'])) {
    $id = $_POST['id'];
    $fname = mysqli_real_escape_string($db, $_POST['fname']);    
    $lname = mysqli_real_escape_string($db, $_POST['lname']);
    $address = mysqli_real_escape_string($db, $_POST['address']);
    $number = mysqli_real_escape_string($db, $_POST['number']);

    if (isset($_SESSION['pos_username'])) {
        $username = $_SESSION['pos_username'];
    } elseif (isset($_SESSION['pos_username_employee'])) {
        $username = $_SESSION['pos_username_employee'];
    } else {
        $username = 'A strange user';
    }

    // Prepared statement to check if the contact number exists
    $sql2 = "SELECT * FROM customer WHERE contact_number = ?";
    $stmt2 = $db->prepare($sql2);
    $stmt2->bind_param("s", $number);
    $stmt2->execute();
    $result2 = $stmt2->get_result();

    if ($result2->num_rows > 0) {
        // If the contact number exists
        $row2 = $result2->fetch_assoc();
        header('Location: ../customer/customer.php?not_added');
    } else {
        // Prepared statement for updating customer information
        $sql = "UPDATE customer SET firstname = ?, lastname = ?, address = ?, contact_number = ? WHERE customer_id = ?";
        $stmt = $db->prepare($sql);
        $stmt->bind_param("ssssi", $fname, $lname, $address, $number, $id);
        
        if ($stmt->execute()) {
            $msg = "Customer information successfully updated!";
            
            // Log the update action
            $sql_log = "INSERT INTO logs (username, purpose) VALUES(?, ?)";
            $stmt_log = $db->prepare($sql_log);
            $log_msg = "Customer $fname updated";
            $stmt_log->bind_param("ss", $username, $log_msg);
            $stmt_log->execute();
            
            header('Location: ../customer/customer.php?updated');
        } else {
            die('Error updating customer: ' . $db->error);
        }
    }

  }
