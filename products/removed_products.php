<?php 
	include("../server/connection.php");
	include '../set.php';
	$sql = "SELECT * FROM products WHERE active='no'";
	$result	= mysqli_query($db, $sql);
	$deleted = isset($_GET['deleted']);
	$added  = isset($_GET['added']);
	$not_added  = isset($_GET['not_added']);
	$updated = isset($_GET['updated']);
	$undelete = isset($_GET['undelete']);
	$error = isset($_GET['error']);
	$failure = "";	
?>
<!DOCTYPE html>
<html>
<head>
	<?php include('../templates/head1.php');?>
</head>
<body>
	<div class="contain h-100">
		<?php include('../products/base.php');?>
		<div>
			<h1 class="ml-4 pt-2"><i class="fas fa-box-open"></i> Product Management</h1>
			<hr>
			<?php include('../alert.php');?>
			<div class="table-responsive mt-4 pl-5 pr-5">
			<table class="table table-striped table-bordered" id="product_table" style="margin-top: -22px;">
				<thead>
					<tr>
						<th scope="col" class="column-text">Barcode</th>
						<th scope="col" class="column-text">Product Name</th>
						<th scope="col" class="column-text">Price</th>
						<th scope="col" class="column-text">Stocks</th>
						<th scope="col" class="column-text">Unit</th>
						<th scope="col" class="column-text">Minimum Stocks</th>
						<th scope="col" class="column-text">Remarks</th>
						<th scope="col" class="column-text">Location</th>
						<th scope="col" class="column-text">Actions</th>
					</tr>
				</thead>
				<tbody class="table-hover">
					<?php 
						while($row = mysqli_fetch_assoc($result)){
				  	?>
					<tr class="table-active">
						<td><?php echo $row['product_no'];?></td>
						<td><?php echo $row['product_name'];?></td>
						<td align="right">Mwk&nbsp<?php echo $row['sell_price'];?></td>
						<td><?php echo $row['quantity'];?></td>
						<td><?php echo $row['unit'];?></td>
						<td><?php echo $row['min_stocks'];?></td>
						<td><?php echo $row['remarks'];?></td>
						<td><?php echo $row['location'];?></td>
						<td>
							<button type="button" name="restore" title="Restore" style='font-size:10px; border-radius:5px;padding:4px;' data-id="<?php echo $row['product_no'];?>"  class="restore btn btn-primary btn-xs" data-toggle="#restoreModal" title="Delete"><i class="fas fa-recycle"></i></button>
						</td>
					</tr>
					<?php } ?>
				</tbody>
			</table>

			</div>
		</div>
	</div>
	<script src="../bootstrap4/jquery/jquery.min.js"></script>
	<script src="../bootstrap4/js/jquery.dataTables.js"></script>
	<script src="../bootstrap4/js/dataTables.bootstrap4.min.js"></script>
	<script src="../bootstrap4/js/bootstrap.bundle.min.js"></script>
	<div id="restoreModal" class="modal fade" data-backdrop="static" data-keyboard="false">  
	<div class="modal-dialog" role="document">  
		<div class="modal-content">
			<form action="restore.php" method="GET">
		   		<div class="modal-header" style="background-color:#007BFF;"> 
					<h3>Restore!</h3>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		   		</div>
				<div class="modal-body">
					<p>Are you sure you want to restore this product?</p>
					<p><small>This action cannot be undoned.</small></p>
				</div> 
				<div class="modal-footer">
					<input type="hidden" name="id" value="" />
					<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
					<button class="btn btn-danger" type="submit">Restore</button>  
				</div>
			</form>  
		</div>  
	</div>  
</div>
</body>
</html>
<script>
	$(function () {
  		$('[data-toggle="popover"]').popover()
	});
		$(function(){
		$('button.restore').click(function(e){
			e.preventDefault();
			var link = this;
			var restoreModal = $("#restoreModal");
			restoreModal.find('input[name=id]').val(link.dataset.id);
			restoreModal.modal();
		});
	});
		$(document).ready(function(){
	$('#product_table').dataTable();
})
</script>