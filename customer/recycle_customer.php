<?php 
	include("../server/connection.php");
	include '../set.php';
	$sql = "SELECT * FROM customer WHERE active='no' ORDER BY customer_id DESC";
	$result	= mysqli_query($db, $sql);
	$deleted = isset($_GET['deleted']);
	$restored = isset($_GET['restored']);
	$unrestored = isset($_GET['unrestored']);
	$added  = isset($_GET['added']);
	$not_added  = isset($_GET['not_added']);
	$updated = isset($_GET['updated']);
	$undelete = isset($_GET['undelete']);
	$failure = "";
	$error = "";
?>
<!DOCTYPE html>
<html>
<head>
	<?php include('../templates/head1.php');
	?>
</head>
<body>
	<div class="contain h-100">
		<?php 
			include('../customer/base.php');
			include('../alert.php');
			if($restored){
				echo 
					'<script>swal("","Successfully restored!","success");</script>';
			}
			if($unrestored){
				echo '<script>swal("","Something went wrong!","warning");</script>';
			}
		?>
		<div>
			<h1 class="ml-4 pt-2"><i class="fas fa-user-friends"></i>Restore Customers</h1>
			<hr>
			<div class="table-responsive mt-4 pl-5 pr-5">
			<table class="table table-striped table-bordered" id="customer_table" style="margin-top: -22px;">
				<thead> 
					<tr>
						<th scope="col" class="column-text">Customer ID</th>
						<th scope="col" class="column-text">Customer Name</th>
						<th scope="col" class="column-text">Address</th>
						<th scope="col" class="column-text">Contact Number</th>
						<th scope="col" class="column-text">Actions</th>
					</tr>
				</thead>
				<tbody class="table-hover">
					<?php 
						while($row = mysqli_fetch_assoc($result)){
				  	?>
					<tr class="table-active">
						<td><a href="customer_sales.php?customer_id=<?php echo $row['customer_id'];?>"><?php echo $row['customer_id'];?></a></td>
						<td><?php echo $row['firstname'].'&nbsp'.$row['lastname'];?></td>
						<td><?php echo $row['address'];?></td>
						<td><?php echo $row['contact_number'];?></td>
						<td>
							<button type="button" name="restore" title="restore" style='font-size:10px; border-radius:5px;padding:4px;' data-id="<?php echo $row['customer_id'];?>"  class="restore btn btn-primary btn-xs" data-toggle="#restoreModal" title="restore"><i class="fas fa-recycle"></i></button>
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
	<?php include('../customer/restore_customer.php');?>
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
	/* function for activating modal to show data when click using ajax */
	$(document).on('click', '.view_data', function(){  
		var id = $(this).attr("id");  
		if(id != ''){  
			$.ajax({  
				url:"view_customer.php",  
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
		$('#customer_table').dataTable();
	});

	</script>	
</body>
</html>
<div id="dataModal" class="modal fade bd-example-modal-md" data-backdrop="static" data-keyboard="false">  
	<div class="modal-dialog modal-md"  role="document">  
		<div class="modal-content">   
		<div class="modal-body d-inline" id="Contact_Details"></div> 
			<div class="modal-footer"> 
				<input type="button" class="btn btn-default btn-success" data-dismiss="modal" value="Okay">   
			</div>  
	   </div>  
	</div>  
</div>
