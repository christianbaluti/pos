<?php include('../server/connection.php');
	if(isset($_GET['id'])){ 
		$id	= $_GET['id'];
         if(isset($_SESSION['pos_username'])){
        	$user = $_SESSION['pos_username'];
        } elseif ($_SESSION['pos_username_employee']) {
        	$user = $_SESSION['pos_username_employee'];
        } else {
        	$user = "Default admin";
        } 
		$query = "UPDATE customer SET active='no' WHERE customer_id = '$id'";
    	if(mysqli_query($db, $query)==true){
    		$logs 	= "INSERT INTO logs (username,purpose) VALUES('$user','Customer deleted')";
 			$insert = mysqli_query($db,$logs);
			header("location: customer.php?deleted");
    	}else{
    		header("location: customer.php?undelete");
    	}
    }	