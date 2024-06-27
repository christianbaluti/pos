<?php include('../server/connection.php');
	$msg 	= '';
	$error  = array();
	if(isset($_SESSION['pos_username'])){
		$username = $_SESSION['pos_username'];
	} elseif (isset($_SESSION['pos_username_employee'])) {
		$username = $_SESSION['pos_username_employee'];
	} else {
		$username = 'A strange user';
	}
	if(isset($_POST['add'])){
		$username = mysqli_real_escape_string($db, $_POST['username']);
		$firstname = mysqli_real_escape_string($db, $_POST['firstname']);
		$lastname = mysqli_real_escape_string($db, $_POST['lastname']);
		$number = mysqli_real_escape_string($db, $_POST['number']);
		$position = mysqli_real_escape_string($db, $_POST['position']);
		$password = mysqli_real_escape_string($db, $_POST['password']);
		$password1 = mysqli_real_escape_string($db, $_POST['password1']);
	  	
		$query = "SELECT username FROM users WHERE username='$username'";
		$result = mysqli_query($db, $query);
		if (mysqli_num_rows($result) == 1){
		  array_push($error, "Username already taken");
		}
		if ($password != $password1){
		  array_push($error, "The Password did not match"); 
		}

		if (count($error) == 0){
			$password = $password1;
			$sql  = "INSERT INTO users (username,firstname,lastname,position,contact_number,password) VALUES ('$username','$firstname','$lastname','$position','$number','$password')";
	  		$result = mysqli_query($db, $sql);
				$insert	= "INSERT INTO logs (username,purpose) VALUES('$username','User $firstname added')";
 				$logs = mysqli_query($db,$insert);
				header('location: ../user/user.php?added');
		}
	}
