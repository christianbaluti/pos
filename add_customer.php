<?php 
	include('server/connection.php');
	$msg 	= '';
	$error  = array();
	if(isset($_POST['submit'])){
		$user 		= mysqli_real_escape_string($db, $_POST['user']);
		$fname 		= mysqli_real_escape_string($db, $_POST['fname']);
		$lname 		= mysqli_real_escape_string($db, $_POST['lname']);
		$address	= mysqli_real_escape_string($db, $_POST['address']);
		$number		= mysqli_real_escape_string($db, $_POST['number']);

		$query = "SELECT contact_number FROM customer WHERE contact_number='$number'";
		$result = mysqli_query($db, $query);
		if (mysqli_num_rows($result) == 1){
		  array_push($error, "Customer number already taken");
		  header('location: main.php?not_added');
		}
		
		if (count($error) == 0){
			$sql  = "INSERT INTO customer (firstname,lastname,address,contact_number) VALUES ('$fname','$lname','$address','$number')";
		  	$result = mysqli_query($db, $sql);
	 		$query 	= "INSERT INTO logs (username,purpose,logs_time) VALUES('$user','Customer $fname Added',CURRENT_TIMESTAMP)";
	 			$insert 	= mysqli_query($db,$query);
				header('location: main.php?username='.$user.'&added');
		}
	}
