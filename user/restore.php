<?php session_start();
include('../server/connection.php');

	if(isset($_GET['id'])){ 
		$id	= $_GET['id'];
        if(isset($_SESSION['pos_username'])){
        	$user = $_SESSION['pos_username'];
        } else {
        	$user = "Default admin";
        }
        echo $id;
		$query = "UPDATE users SET active='yes' WHERE id = '$id'"; 
    	$result = mysqli_query($db, $query);
    	if($result == true){
    		$insert 	= "INSERT INTO logs (username,purpose) VALUES('$user','User Restored')";
 			mysqli_query($db,$insert);
			header("location: user.php?restored");
    	}
    } else echo "fuuuuuck";