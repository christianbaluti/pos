<?php
	include('server/connection.php');

	
	$query 	= mysqli_real_escape_string($db, $_POST['query']);	
	$show 	= "SELECT * FROM customer WHERE active='yes' and contact_number LIKE '%{$query}%'";
	$result	= mysqli_query($db,$show);
	$array  = array();

		while($row = mysqli_fetch_assoc($result)){
			$array[] = $row['contact_number'];				
		}
		print json_encode($array);

