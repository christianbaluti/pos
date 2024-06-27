<?php 
	include('server/connection.php');
	if(!isset($_SESSION['pos_username'])){
		header('location: index.php');
	}
	$added = isset($_GET['added']);
	$not_added = isset($_GET['not_added']);
	$error = isset($_GET['error']);
	$undelete = isset($_GET['undelete']);
	$updated = '';
	$deleted = '';
	$failure = isset($_GET['failure']);
	
	$query 	= "SELECT * FROM `customer`";
	$show	= mysqli_query($db,$query);
	if(isset($_SESSION['pos_username'])){
		$user = $_SESSION['pos_username'];
		$sql = "SELECT position FROM users WHERE username='$user'";
		$result	= mysqli_query($db, $sql);
		if (mysqli_num_rows($result) > 0){
			while($row = mysqli_fetch_assoc($result)){
?>
<!DOCTYPE html>
<html>
<head>
	<title>Umoya POS System</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="icon" type="image/png" sizes="180x180" href="images/icon.jpg">
	<link rel="stylesheet" type="text/css" href="bootstrap4/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="bootstrap4/css/style.css">
	<link rel="stylesheet" href="bootstrap4/css/all.min.css"/>
	<link rel="stylesheet" href="bootstrap4/css/typeahead.css"/>
	<link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
	<link rel="stylesheet" href="assets/css/Login-screen.css">
	<script src="bootstrap4/jquery/sweetalert.min.js"></script>
	<script src="assets/bootstrap/js/bootstrap.min.js"></script>
</head>
<body class="bg-dark">
	<div class="container-fluid">
		<div id="header" class="d-flex justify-content-between align-items-center bg-secondary p-3 text-white">
			<div>
				<img src="images/logo.png" class="img-fluid" style="max-height: 50px;">
			</div>
			<div class="text-right">
				<p><i class="fas fa-user-shield"></i> <?php echo $row['position'];}}}?></p>
				<p><i class="fas fa-calendar-alt"></i> <span id='time'></span></p>
				<p><i class="fas fa-phone"></i> Customer Phone:</p>
				<div class="input-group">
					<input type="text" class="form-control form-control-sm customer_search" autocomplete="off" data-provide="typeahead" id="customer_search" placeholder="Customer Search" name="customer"/>
					<div class="input-group-append">
						<button class="btn btn-info" data-toggle="modal" data-target=".bd-example-modal-md"><i class="fas fa-user-plus"></i> New</button>
					</div>
				</div>
			</div>
			<div class="header_price border p-3 text-center">
				<h5>Grand Total</h5>
				<p style="font-size: 40px;" id="totalValue">Mwk 0.00</p>
			</div>
		</div>
		<div class="row mt-4">
			<div class="col-md-8">
				<div class="table-responsive bg-light p-3 rounded">
					<form method="POST" action="">
						<table class="table table-striped table-hover">
							<thead class="thead-dark text-center">
								<tr>
									<th></th>
									<th>Barcode</th>
									<th>Description</th>
									<th>Price</th>
									<th>Unit</th>
									<th>Qty</th>
									<th>Sub.Total</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody id="tableData"></tbody>
						</table>
					</form>
				</div>
				<div class="mt-3">
					<button id="buttons" type="button" name='enter' class="btn btn-success"><i class="fas fa-handshake"></i> Finish</button>
				</div>
				<div class="mt-2 text-white">
					<ul class="list-unstyled">
						<li class="d-flex justify-content-between">Total (Mwk): <span id="totalValue1">0.00</span></li>
						<li class="d-flex justify-content-between align-items-center">Discount (Mwk): 
							<input class="form-control form-control-sm w-25" type="number" name="discount" value="0" min="0" placeholder="Enter Discount" id="discount">
						</li>
					</ul>
				</div>
			</div>
			<div class="col-md-4">
				<div class="input-group mb-3">
					<div class="input-group-prepend">
						<span class="input-group-text"><i class="fas fa-search"></i></span>
					</div>
					<input class="form-control" type="text" placeholder="Product Search" id="search" name="search" onkeyup="loadproducts();">
				</div>
				<div class="table-responsive bg-light p-3 rounded">
					<table class="table table-striped table-hover">
						<thead class="thead-dark text-center">
							<tr>
								<th></th>
								<th>Barcode</th>
								<th>Product Name</th>
								<th>Price</th>
								<th>Unit</th>
								<th>Stocks</th>
							</tr>
						</thead>
						<tbody id="products"></tbody>
					</table>
				</div>
				<div class="mt-3 text-center">
					<button class="btn btn-warning"><i class="fas fa-ban"></i> Cancel</button>
				</div>
			</div>
		</div>
		<div style="" id="footer" class="d-flex sticky bottom sticky-bottom justify-content-around bg-secondary p-2">
			<button class="btn btn-outline-light" onclick="window.location.href='user/user.php'"><i class="fas fa-users"></i> User</button>
			<button class="btn btn-outline-light" onclick="window.location.href='products/products.php'"><i class="fas fa-box-open"></i> Product</button>
			<button class="btn btn-outline-light" onclick="window.location.href='supplier/supplier.php'"><i class="fas fa-user-tie"></i> Supplier</button>
			<button class="btn btn-outline-light" onclick="window.location.href='customer/customer.php'"><i class="fas fa-user-friends"></i> Customer</button>
			<button class="btn btn-outline-light" onclick="window.location.href='logs/logs.php'"><i class="fas fa-globe"></i> Logs</button>
			<button class="btn btn-outline-light" onclick="window.location.href='cashflow/cashflow.php'"><i class="fas fa-money-bill-wave"></i> Cash-Flow</button>
			<button class="btn btn-outline-light" onclick="window.location.href='sales/sales.php'"><i class="fas fa-shopping-cart"></i> Sales</button>
			<button class="btn btn-outline-light" onclick="window.location.href='delivery/delivery.php'"><i class="fas fa-truck"></i> Deliveries</button>
			<button class="btn btn-danger" name="logout" type="button" onclick="out();"><i class="fas fa-sign-out-alt"></i> Logout</button> 
		</div>
	</div>

<!-- Modal for Adding data -->
<div class="modal fade bd-example-modal-md" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
	  		<div class="modal-header bg-secondary text-white">
				<h4 class="modal-title"><strong>Add New Customer</strong></h4>
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	  		</div>
	  	<div class="modal-body">
			<div class="container-fluid">
				<form method="post" id="modal-form" action="add_customer.php" enctype="multipart/form-data" class="needs-validation">
		  			<div align="center">
		  				<input type="hidden" name="size" class="form-control-sm" value="1000000">
		  				<input type="hidden" name="user" class="form-control-sm" value="<?php echo $name;?>">
		  				<img class="mb-1" width="150" height="150" src="images/user.png"/>
		  			</div>
		  			<div class="form-group">
						<label>First Name</label>
						<input class="form-control" type="text" name="fname" placeholder="Enter First name" required>
					</div>
					<div class="form-group">
						<label>Last Name</label>
						<input class="form-control" type="text" name="lname" placeholder="Enter Last name" required>
					</div>
					<div class="form-group">
						<label>Email</label>
						<input class="form-control" type="email" name="email" placeholder="Enter Email">
					</div>
					<div class="form-group">
						<label>Gender</label>
						<select name="gender" class="form-control">
							<option disabled>Select gender</option>
							<option>Male</option>
							<option>Female</option>
						</select>
					</div>
					<div class="form-group">
						<label>Phone</label>
						<input class="form-control" type="number" name="phone" placeholder="Enter Phone Number">
					</div>
					<div class="form-group">
						<label>Address</label>
						<textarea class="form-control" rows="3" name="address" placeholder="Enter Address"></textarea>
					</div>
					<div class="form-group">
						<label>Date of Birth</label>
						<input class="form-control" type="date" name="dob">
					</div>
					<div class="form-group">
						<label>Image</label>
						<input type="file" name="file" class="form-control">
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-outline-secondary" data-dismiss="modal"><i class="fas fa-times-circle"></i> Cancel</button>
						<button type="submit" name="submit" class="btn btn-outline-success"><i class="fas fa-check-circle"></i> Add</button>
					</div>
				</form>
			</div>
	  	</div>
		</div>
	</div>
</div>
<script src="bootstrap4/jquery/jquery.min.js"></script>
<script src="bootstrap4/js/bootstrap.min.js"></script>
<script src="bootstrap4/js/popper.min.js"></script>
<script src="bootstrap4/js/script.js"></script>
</body>
</html>
<?php
		if($added){
			echo "<script> swal('Added','New Customer added!','success'); </script>";
		}
		if($not_added){
			echo "<script> swal('Oops','Customer not added!','warning'); </script>";
		}
		if($error){
			echo "<script> swal('Error','Something went wrong!','error'); </script>";
		}
		if($undelete){
			echo "<script> swal('Unrestored','Customer not restored!','warning'); </script>";
		}
		if($deleted){
			echo "<script> swal('Deleted','Customer deleted!','success'); </script>";
		}
		if($failure){
			echo "<script> swal('Oops','Failed to delete customer!','error'); </script>";
		}
?>
<script type="text/javascript">
	$(document).ready(function() {
		$('#customer_search').typeahead({
			source: function(query, result) {
				$.ajax({
					url: "server/customer_search.php",
					data: 'query=' + query,            
					dataType: "json",
					type: "POST",
					success: function(data) {
						result($.map(data, function(item) {
							return item;
						}));
					}
				});
			}
		});
	});
	var d = new Date();
	var month = d.getMonth() + 1;
	var day = d.getDate();
	var output = d.getFullYear() + '/' +
		(('' + month).length < 2 ? '0' : '') + month + '/' +
		(('' + day).length < 2 ? '0' : '') + day;
	document.getElementById("time").innerHTML = output;
	function loadproducts() {
		var search = document.getElementById('search').value;
		$.ajax({
			url: 'server/product_search.php',
			method: 'POST',
			data: {
				search: search
			},
			success: function(data) {
				$('#products').html(data);
			}
		});
	}
	function out() {
		swal({
			title: "Logout",
			text: "Are you sure you want to logout?",
			icon: "warning",
			buttons: true,
			dangerMode: true,
		}).then((willDelete) => {
			if (willDelete) {
				swal("You have been logged out!", {
					icon: "success",
				});
				setTimeout(() => {
					window.location = 'logout.php';
				}, 1000);
			}
		});
	}
</script>
