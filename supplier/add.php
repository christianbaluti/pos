<?php include('../server/connection.php');
	$msg 	= '';
	$error  = array();
	if(isset($_POST['add'])){
		$company 	= mysqli_real_escape_string($db, $_POST['com_name']);
		$firstname 	= mysqli_real_escape_string($db, $_POST['firstname']);
		$lastname 	= mysqli_real_escape_string($db, $_POST['lastname']);
		$address 	= mysqli_real_escape_string($db, $_POST['address']);
		$number 	= mysqli_real_escape_string($db, $_POST['number']);
		if(isset($_SESSION['pos_username'])){
		$username = $_SESSION['pos_username'];
	} elseif (isset($_SESSION['pos_username_employee'])) {
		$username = $_SESSION['pos_username_employee'];
	} else {
		$username = 'A strange user';
	}

		$sql  = "INSERT INTO supplier (company_name,firstname,lastname,address,contact_number) VALUES ('$company','$firstname','$lastname','$address','$number')";
	  	$result = mysqli_query($db, $sql);
	  	
			$query 	= "INSERT INTO logs (username,purpose) VALUES('$username','Supplier $company added')";
 			$insert = mysqli_query($db,$query);
			header('location: ../supplier/supplier.php?added');
	}
