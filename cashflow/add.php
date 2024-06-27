<?php 
	include('../server/connection.php');
	$alert  = array();
	if(isset($_POST['add_customer'])){
		if(isset($_SESSION['pos_username'])){
        	$user = $_SESSION['pos_username'];
        } elseif ($_SESSION['pos_username_employee']) {
        	$user = $_SESSION['pos_username_employee'];
        } else {
        	$user = "Default admin";
        }
		$purpose 	= mysqli_real_escape_string($db, $_POST['purpose']);
		$amount 	= mysqli_real_escape_string($db, $_POST['amount']);
		
		$sql  = "INSERT INTO cashflow (description,amount,username) VALUES ('$purpose','$amount','$user')";
	  	$result = mysqli_query($db, $sql);
 		if($result == true){
 			$query 	= "INSERT INTO logs (username,purpose) VALUES('$user','$purpose')";
 			$insert = mysqli_query($db,$query);
 			header('location: ../cashflow/cashflow.php?added');
	  	}else{
			array_push($alert,"Something went wrong!");
	  	}
	}
