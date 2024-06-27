<?php session_start();
include('../server/connection.php');

	if(isset($_GET['id'])){ 
		$id	= $_GET['id'];
        if(isset($_SESSION['pos_username'])){
        	$user = $_SESSION['pos_username'];
        } elseif ($_SESSION['pos_username_employee']) {
        	$user = $_SESSION['pos_username_employee'];
        } else {
        	$user = "Default admin";
        }
        echo $id;
		$query = "UPDATE products SET active='no' WHERE product_no = '$id'";
    	$result = mysqli_query($db, $query);
    	if($result==true){
    		$logs	= "INSERT INTO logs (username,purpose) VALUES('$user','Product deleted')";
    		$insert = mysqli_query($db,$logs);
    		header("location: products.php?deleted");
    	}else{
            echo $id;
			header("location: products.php?undelete");
    	}
    } else echo "fuuuuuck";