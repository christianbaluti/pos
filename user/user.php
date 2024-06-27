<?php 
	include("../server/connection.php");
	include('../user/add.php');
	include '../set.php';

	// Use prepared statements to avoid SQL injection
	$sql = "SELECT * FROM users WHERE active = ? ORDER BY firstname ASC";
	$stmt = $db->prepare($sql);
	$active_yes = 'yes';
	$active_no = 'no';

	$stmt->bind_param('s', $active_yes);
	$stmt->execute();
	$result = $stmt->get_result();

	$stmt->bind_param('s', $active_no);
	$stmt->execute();
	$result2 = $stmt->get_result();

	// Check GET parameters
	$deleted = isset($_GET['deleted']);
	$restored = isset($_GET['restored']);
	$added = isset($_GET['added']);
	$not_added = isset($_GET['not_added']);
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
		<?php include('../user/base.php');?>
		<div>
			<h1 class="ml-4 pt-2"><i class="fas fa-users"></i> User Management</h1>
			<hr>
			<?php 
				include('../alert.php');
				if ($restored) {
					echo '<script>swal("", "Successfully Restored!", "success");</script>';
				}
			?>
			<div class="table-responsive mt-4 pl-5 pr-5">
				<table class="table table-striped table-bordered" id="user_table_active" style="margin-top: -22px;">
					<thead>
						<tr>
							<th scope="col" class="column-text">Username</th>
							<th scope="col" class="column-text">Name</th>
							<th scope="col" class="column-text">Position</th>
							<th scope="col" class="column-text">Contact Number</th>
							<th scope="col" class="column-text">Action</th>
						</tr>
					</thead>
					<tbody class="table-hover">
						<?php while ($row = $result->fetch_assoc()) { ?>
						<tr class="table-active">
							<td><?php echo htmlspecialchars($row['username']); ?></td>
							<td><?php echo htmlspecialchars($row['firstname']) . ' ' . htmlspecialchars($row['lastname']); ?></td>
							<td><?php echo htmlspecialchars($row['position']); ?></td>
							<td><?php echo htmlspecialchars($row['contact_number']); ?></td>
							<td>
								<a name="edit" title="Edit" style='font-size:10px; border-radius:5px;padding:4px;' href="update_user.php?id=<?php echo htmlspecialchars($row['id']); ?>" class="btn btn-info"><i class="fas fa-user-edit"></i></a>
								<button type="button" name="view" style='font-size:10px; border-radius:5px;padding:4px;' id="<?php echo htmlspecialchars($row['id']); ?>" class="btn btn-success btn-xs view_data"><i class="fas fa-eye"></i></button>
								<button type="button" name="delete" title="Delete" style='font-size:10px; border-radius:5px;padding:4px;' data-id="<?php echo htmlspecialchars($row['id']); ?>" class="delete btn btn-danger" data-toggle="#deleteModal"><i class="fas fa-trash"></i></button>
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
	<?php include('../user/delete_user.php');?>
	<?php include('../user/restore_user.php');?>

	<div id="dataModal" class="modal fade bd-example-modal-md" data-backdrop="static" data-keyboard="false">
		<div class="modal-dialog modal-md" role="document">
			<div class="modal-content">
				<div class="modal-body d-inline" id="Contact_Details"></div>
				<div class="modal-footer">
					<input type="button" class="btn btn-default btn-success" data-dismiss="modal" value="Okay">
				</div>
			</div>
		</div>
	</div>

	<script>
		$(function () {
			$('[data-toggle="popover"]').popover();
		});

		$(function () {
			$('button.delete').click(function (e) {
				e.preventDefault();
				var link = this;
				var deleteModal = $("#deleteModal");
				deleteModal.find('input[name=id]').val(link.dataset.id);
				deleteModal.modal();
			});
		});

		$(function () {
			$('button.restore').click(function (e) {
				e.preventDefault();
				var link = this;
				var restoreModal = $("#restoreModal");
				restoreModal.find('input[name=id]').val(link.dataset.id);
				restoreModal.modal();
			});
		});

		$(document).ready(function () {
			$(document).on('click', '.view_data', function () {
				var id = $(this).attr("id");
				if (id != '') {
					$.ajax({
						url: "view.php",
						method: "POST",
						data: { id: id },
						success: function (data) {
							$('#Contact_Details').html(data);
							$('#dataModal').modal('show');
						}
					});
				}
			});
		});

		$(document).ready(function () {
			$('#user_table_active').dataTable();
			$('#user_table_deleted').dataTable();
		});
	</script>
</body>
</html>
