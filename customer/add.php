<?php 
	include('../server/connection.php');
	$alert  = array();
	if(isset($_POST['add_customer'])){
		$fname 		= mysqli_real_escape_string($db, $_POST['fname']);
		$lname 		= mysqli_real_escape_string($db, $_POST['lname']);
		$address	= mysqli_real_escape_string($db, $_POST['address']);
		$number		= mysqli_real_escape_string($db, $_POST['number']);
	  		if(isset($_SESSION['pos_username'])){
		$username = $_SESSION['pos_username'];
	} elseif (isset($_SESSION['pos_username_employee'])) {
		$username = $_SESSION['pos_username_employee'];
	} else {
		$username = 'A strange user';
	}
	$sql2 = "SELECT * from customer WHERE contact_number = $number";
	$result2 = mysqli_query($db, $sql2);
	if ($result2!=0) {
		header('location: ../customer/customer.php?not_added');
	} else {
		$sql  = "INSERT INTO customer (firstname,lastname,address,contact_number) VALUES ('$fname','$lname','$address','$number')";
	  	$result = mysqli_query($db, $sql);
 			$query 	= "INSERT INTO logs (username,purpose) VALUES('$username','Customer $fname Added')";
 			$insert 	= mysqli_query($db,$query);
			header('location: ../customer/customer.php?added');
		}
	}
