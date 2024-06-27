<?php 
	include('server/connection.php');
	if(!isset($_SESSION['pos_username_employee'])){
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
	if(isset($_SESSION['pos_username_employee'])){
		$user = $_SESSION['pos_username_employee'];
		$sql = "SELECT position FROM users WHERE username='$user'";
		$result	= mysqli_query($db, $sql);
		if (mysqli_num_rows($result) > 0){
			while($row = mysqli_fetch_assoc($result)){
?>
<!DOCTYPE html>
<html>
<head>
	<?php include('templates/head.php'); ?>
</head>
<body>
	<div class="h-100 bg-dark" id="container">
		<div id="header">
			<?php include('alert.php'); ?>
			<div>
				<img class="img-fluid m-2 w-100" src="images/logo.png" style="padding-top: 40px!important;" />
			</div>
			<div class="text-white mt-0 ml-5" >
				<table class="table-responsive-sm">
					<tbody>
						<tr>
							<td valign="baseline"><small>User:</small></td>
							<td valign="baseline" style="padding-left: 10px!important"><small><p class="pt-3 ml-5"><i class="fas fa-user-shield"></i> <?php echo $row['position'];}}}?></p></small></td>
						</tr>
						<tr>
							<td valign="baseline"><small class="pb-1">Date:</small></td>
							<td valign="baseline" style="padding-left: 10px!important"><small><p class="p-0 ml-5"><i class="fas fa-calendar-alt">&nbsp</i><span id='time'></span></p></small></td>
						</tr>
						<tr>
							<td valign="baseline"><small class="mt-5">Customer Phone:</small></td>
							<td valign="baseline" style="padding-left: 10px!important"><small><div class="content p-0 ml-5"><input type="text" class="form-control form-control-sm customer_search" autocomplete="off" data-provide="typeahead" id="customer_search" placeholder="Customer Search" name="customer"/></small></div>
							</td>
							<td valign="baseline" style="padding-left: 10px!important"><button class="btn-sm btn-info border ml-2" data-toggle="modal" data-target=".bd-example-modal-md" style="padding-top: 1px; padding-bottom: 2px;"><span class="badge badge-info"><i class="fas fa-user-plus"></i> New</span></button></td>
						</tr>
					</tbody>
				</table>
			</div>
			<div class="header_price border p-0">
				<h5>Grand Total</h5>
				<p class="pb-0 mr-2" style="float: right; font-size: 40px;" id="totalValue">Mwk 0.00</p>
			</div>
		</div>
		<div id="content" class="mr-2">
			<div id="price_column" class="m-2 table-responsive-sm table-wrapper-scroll-y my-custom-scrollbar-a">
				<form method="POST" action="">
				<table class="table-striped w-100 font-weight-bold" style="cursor: pointer;" id="table2">
					<thead>
						<tr class='text-center'>
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
					<tbody id="tableData">
					</tbody>
				</table>
				</form>
			</div>
			<div id="table_buttons">
				<button id="buttons" type="button" name='enter' class="Enter btn btn-secondary border ml-2"><i class="fas fa-handshake"></i> Finish</button>
				<div class="">
				<small>
					<ul class="text-white justify-content-center">
						<li class="d-flex mb-0">Total (Mwk): <p id="totalValue1" class="mb-0 ml-5 pl-3">0.00</p></li>
						<li class="mb-0 mt-0">Discount (Mwk): <input style="width: 100px" class="text-right form-control-sm" type="number" name="discount" value="0" min="0" placeholder="Enter Discount" id="discount" ></li>
					</ul>
				</small>
				</div>
			</div>
		</div>
		<div id="sidebar">
			<div class="mt-1 ">
			<div class="input-group"><div class="input-group-prepend"><span class="input-group-text" id="basic-addon1"><i class="fas fa-search"></i></span></div>
   				<input class="form-control" type="text" placeholder="Product Search" aria-label="Search" id="search" name="search" onkeyup="loadproducts();"/>
   			</div></div>
			<div id="product_area" class="table-responsive-sm mt-2 table-wrapper-scroll-y my-custom-scrollbar" >
				<table class="w-100 table-striped font-weight-bold" style="cursor: pointer;" id="table1">
					<thead>
						<tr claclass='text-center'><b>
							<td></td>
							<td>Barcode</td>
							<td>Product Name</td>
							<td>Price</td>
							<td>Unit</td>
							<td>Stocks</td>
						</tr></b>
						<tbody id="products">
							
						</tbody>
					</thead>
				</table>
			</div>
			<div class="w-100 mt-2" id="enter_area">
				<button id="buttons" type="button" class="cancel btn btn-secondary border"><i class="fas fa-ban"></i> Cancel</button>
			</div>
		</div>
		<div id="footer" class="w-100" align="center" style="">
			<button id="buttons" onclick="window.location.href='employee/profile.php'" class="btn btn-secondary border mr-2 ml-2"><i class="fas fa-user-circle"></i> My Profile</button>
			<button id="buttons" onclick="window.location.href='employee/inventory.php'" class="btn btn-secondary border mr-2"><i class="fas fa-box-open"></i> Inventory</button>
			<button id="buttons" onclick="window.location.href='employee/cashflow.php'" class="btn btn-secondary border mr-2"><i class="fas fa-money-bill-wave"></i> Cash-Flow</button>
			<button id="buttons" name="logout" type="button" onclick="out();" class="logout btn btn-danger border mr-2"/> <i class="fas fa-sign-out-alt"></i> Logout</div>
		</div>
	</div>
	<?php include('add.php');?>
	<?php include('templates/js_popper.php');?>
	<script type="text/javascript" src="script2.js"></script>
	<script src="bootstrap4/js/time.js"></script>
</body>
</html> 
