<?php
	include('server/connection.php');

	if (isset($_POST['products'])){

		$name = mysqli_real_escape_string($db,$_POST['products']);
		$show 	= "SELECT * FROM products WHERE active = 'yes' and product_name LIKE '$name%' AND quantity > 0 OR product_no LIKE '$name%' AND quantity > 0";
		$query 	= mysqli_query($db,$show);
		if(mysqli_num_rows($query)>0){
			while($row = mysqli_fetch_array($query)){
				echo "<tr class='js-add' data-barcode=".$row['product_no']." data-images=".$row['images']." data-product=".$row['product_name']." data-price=".$row['sell_price']." data-unt=".$row['unit']."><td><img style='width: auto; height: 20px' src='images/".$row['images']."'></td><td>".$row['product_no']."</td><td>".$row['product_name']."</td>";
				echo "<td>Mwk ".$row['sell_price']."</td>";
				echo "<td>".$row['unit']."</td>";
				echo "<td>".$row['quantity']."</td>";
			}
		}
		else{
			echo "<td></td><td>No Products found!</td><td></td>";
		}
	}?>