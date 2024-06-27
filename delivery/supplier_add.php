<?php 
    include('../server/connection.php');
    
    if(isset($_POST['submit'])){
        $com        = mysqli_real_escape_string($db, $_POST['com_name']);
        $fname      = mysqli_real_escape_string($db, $_POST['fname']);
        $lname      = mysqli_real_escape_string($db, $_POST['lname']);
        $address    = mysqli_real_escape_string($db, $_POST['address']);
        $number     = mysqli_real_escape_string($db, $_POST['number']);
        
        if(isset($_SESSION['pos_username'])){
            $user = $_SESSION['pos_username'];
        } elseif ($_SESSION['pos_username_employee']) {
            $user = $_SESSION['pos_username_employee'];
        } else {
            $user = "Default admin";
        }

        // Check if company name already exists
        $sql_check = "SELECT company_name FROM supplier WHERE company_name = '$com'";
        $result_check = mysqli_query($db, $sql_check);

        if (mysqli_num_rows($result_check) > 0) {
            // Company name already exists
            header('Location: ../delivery/add_delivery.php?failure');
            exit; // Stop further execution
        } else {
            // Company name does not exist, proceed to insert
            $sql  = "INSERT INTO supplier (company_name, firstname, lastname, address, contact_number) 
                     VALUES ('$com', '$fname', '$lname', '$address', '$number')";
            $result = mysqli_query($db, $sql);

            if ($result) {
                // Log the addition
                $query = "INSERT INTO logs (username, purpose) VALUES ('$user', 'Customer $fname Added')";
                $insert = mysqli_query($db, $query);

                // Redirect with success message
                header('Location: ../delivery/add_delivery.php?done');
                exit; // Stop further execution
            } else {
                // Handle insertion error
                header('Location: ../delivery/add_delivery.php?failure');
                exit; // Stop further execution
            }
        }
    }
?>
