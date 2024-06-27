<?php 
	include("../server/connection.php");
	include '../set.php';
	
	$sql = "SELECT * FROM supplier WHERE active='no'";
	$result	= mysqli_query($db, $sql);
	$deleted = isset($_GET['deleted']);
	$restored = isset($_GET['restored']);
	$unrestored = isset($_GET['unrestored']);
	$added  = isset($_GET['added']);
	$not_added  = isset($_GET['not_added']);
	$updated = isset($_GET['updated']);
	$undelete = isset($_GET['undelete']);
	$error = '';
	$failure = "";
?>
<!DOCTYPE html>
<html>
<head>
	<?php include('../templates/head1.php');?>
</head>
<body>
	<div class="contain h-100">
		<?php include('../supplier/base.php');?>
		<div>
			<h1 class="ml-4 pt-2"><i class="fas fa-user-tie"></i> Supplier Management</h1>
			<hr>
			<?php include('../alert.php');

				if($restored){
					echo 
						'<script>swal("","Successfully restored!","success");</script>';
				}
				if($unrestored){
					echo '<script>swal("","Something went wrong!","warning");</script>';
				}
			?>
			<div class="table-responsive mt-4 pl-5 pr-5">
			<table class="table table-striped table-bordered" id="supplier_table">
				<thead>
					<tr>
						<th scope="col" class="column-text">Supplier ID</th>
						<th scope="col" class="column-text">Company Name</th>
						<th scope="col" class="column-text">Supplier Name</th>
						<th scope="col" class="column-text">Address</th>
						<th scope="col" class="column-text">Contact Number</th>
						<th scope="col" class="column-text">Action</th>
					</tr>
				</thead>
				<tbody class="table-hover">
					<?php 
						while($row = mysqli_fetch_array($result)){
				  	?>
					<tr class="table-active">
						<td><?php echo $row['supplier_id'];?></td>
						<td><a href="supplier_details.php?id=<?php echo $row['supplier_id'];?>"><?php echo $row['company_name'];?></a></td>
						<td><?php echo $row['firstname'].'&nbsp'.$row['lastname'];?></td>
						<td><?php echo $row['address'];?></td>
						<td><?php echo $row['contact_number'];?></td>
						<td>
							
							<button type="button" name="restore" title="restore" value="restore" style='font-size:10px; border-radius:5px;padding:4px;' data-id="<?php echo $row['supplier_id'];?>"  class="restore btn btn-primary btn-xs" data-toggle="#restoreModal" title="restore"><i class="fas fa-recycle"></i></button>
						</td>
					</tr>
					<?php } ?>
				</tbody> 
			</table>

			</div>
		</div>
	</div>
	<?php include('../supplier/view_modal.php');?>
	<div id="restoreModal" class="modal fade" data-backdrop="static" data-keyboard="false">  
	<div class="modal-dialog" role="document">  
		<div class="modal-content">
			<form action="restore.php" method="GET">
		   		<div class="modal-header" style="background-color:#007bff;"> 
					<h3 style="color: white">Restore!</h3>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		   		</div>
				<div class="modal-body">
					<p>Are you sure you want to restore this supplier?</p>
					<p><small>This action cannot be undoned.</small></p>
				</div> 
				<div class="modal-footer">
					<input type="hidden" name="id" value="" />
					<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
					<button class="btn btn-primary" type="submit">Restore</button>  
				</div>
			</form>  
		</div>  
	</div>  
</div>
	<script src="../bootstrap4/jquery/jquery.min.js"></script>
	<script src="../bootstrap4/js/jquery.dataTables.js"></script>
	<script src="../bootstrap4/js/dataTables.bootstrap4.min.js"></script>
	<script src="../bootstrap4/js/bootstrap.bundle.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			$('#supplier_table').dataTable();
		});
		$(document).ready(function(){
			$('#supplier_table').dataTable();
		});

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
	/* function for activating modal to show data when click using ajax */
	$(document).on('click', '.view_data', function(){  
		var id = $(this).attr("id");  
		if(id != ''){  
			$.ajax({  
				url:"view_supplier.php",  
				method:"POST",  
				data:{id:id},  
				success:function(data){  
					$('#Contact_Details').html(data);  
					$('#dataModal').modal('show');  
				}  
			});  
		}            
	});   
 });

 $(document).ready(function(){
	/* function for activating modal to show data when click using ajax */
	$(document).on('click', '.view_product', function(){  
		var id = $(this).attr("id");  
		if(id != ''){  
			$.ajax({  
				url:"view_products.php",  
				method:"POST",  
				data:{id:id},  
				success:function(data){  
					$('#product_Details').html(data);  
					$('#productModal').modal('show');  
				}  
			});  
		}            
	});   
 });
	</script>
	
</body>
</html>

