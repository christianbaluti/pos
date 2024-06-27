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
		$query = "UPDATE products SET active='yes' WHERE product_no = '$id'";
    	$result = mysqli_query($db, $query);
    	if($result==true){
    		$logs	= "INSERT INTO logs (username,purpose) VALUES('$user','Product restored')";
    		$insert = mysqli_query($db,$logs);
    		header("location: removed_products.php?restored");
    	}else{
            echo $id;
			header("location: removed_products.php?unrestored");
    	}
    } else echo "fuuuuuck";