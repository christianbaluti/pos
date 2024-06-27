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
        $query = "UPDATE supplier SET active='yes' WHERE supplier_id = '$id'";
    	$delete = mysqli_query($db, $query);
    	if($delete == true){
    		$logs 	= "INSERT INTO logs (username,purpose) VALUES('$user','Supplier Restored')";
 			$insert = mysqli_query($db,$logs);
			header("location: restore_supplier.php?restored");
    	}else{
    		header("location: restore_supplier.php?unrestored");
    	}
    }	