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
		$query = "UPDATE users SET active='no' WHERE id = '$id'"; 
    	$result = mysqli_query($db, $query);
    	if($result == true){
    		$insert 	= "INSERT INTO logs (username,purpose) VALUES('$user','User Deleted')";
 			mysqli_query($db,$insert);
			header("location: user.php?deleted");
    	}
    } else echo "fuuuuuck";