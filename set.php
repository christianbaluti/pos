<?php 
if(isset($_SESSION['pos_username'])){
		$name = $_SESSION['pos_username'];
	} elseif (isset($_SESSION['pos_username_employee'])) {
		$name = $_SESSION['pos_username_employee'];
	} else {
		
	}
if(!isset($name)){

	header('location: ../index.php');
}

?>