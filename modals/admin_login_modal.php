<div class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog modal-sm modal-dialog-centered">
		<div class="modal-content text-center" id="login-one" class="login-one">
			<div class="modal-header">
				<h5 class="modal-title"><i class="fas fa-user-lock"></i> Admin Sign In</h5>
			</div>
			<form class="login-one-form" method="post" action="">
				<div class="modal-body">
		            <div class="col">
		                <div class="login-one-ico"><i class="fa fa-opencart" id="lockico"></i></div>
		                <div class="form-group mb-3">
		                    <div>
		                        <h3 id="heading">Admin Log in:</h3>
		                        <input type="hidden" name="position" value="admin"/>
								<input type="hidden" name="username" value=""/>
		                    </div><input class="form-control" id="pass" type="password" name="password" placeholder="Enter Password" required>
		                    <div class="modal-footer ">
								<button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-ban"></i> Close</button>
								<button type="submit" name="login" class="btn btn-success"><i class="fas fa-sign-in-alt"></i> login</button>
							</div>
		                </div>
		            </div>
	            </div>
	        </form>
		</div>
	</div>
</div>

    <script src="assets/bootstrap/js/bootstrap.min.js"></script>