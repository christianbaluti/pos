<?php 

$error		= array();
$alert 		= array();

if (isset($_POST['changepass'])){
	if(isset($_SESSION['pos_username'])){
        	$username = $_SESSION['pos_username'];
        } elseif ($_SESSION['pos_username_employee']) {
        	$username = $_SESSION['pos_username_employee'];
        } else {
        	$username = "Default admin";
        }
	$newpass 	= mysqli_real_escape_string($db, $_POST['newpass']);
	$confirmpass	= (mysqli_real_escape_string($db, $_POST['confirmpass']));
	
	$query 		= "SELECT * FROM users WHERE username = '$username'";
	$result 	= mysqli_query($db, $query);
	$row 		= mysqli_fetch_array($result);

	if ($newpass != $confirmpass){
		array_push($error, "The Password did not match!"); 
	}
	if (md5($confirmpass) == $row['password'] AND md5($confirmpass) == $row['password']){
		array_push($error, "The Password is still the same!");
	}

	if (count($error) == 0){
		$newpass = md5($confirmpass);
		$sql  = "UPDATE users SET password='$newpass' WHERE username = '$username'";
		$update = mysqli_query($db ,$sql);
		array_push($alert, "Password Successfully Changed!");
	}else{

	}
}