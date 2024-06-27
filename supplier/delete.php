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
        $query = "UPDATE supplier SET active='no' WHERE supplier_id = '$id'";
    	$delete = mysqli_query($db, $query);
    	if($delete == true){
    		$logs 	= "INSERT INTO logs (username,purpose) VALUES('$user','Supplier Deleted')";
 			$insert = mysqli_query($db,$logs);
			header("location: supplier.php?deleted");
    	}else{
    		header("location: supplier.php?undelete");
    	}
    }	