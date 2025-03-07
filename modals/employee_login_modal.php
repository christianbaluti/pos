<div class="modal fade" id="modal-user" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog modal-sm modal-dialog-centered">
		<div class="modal-content text-center">
			<form class="login-one-form" method="post" action="">
				<div class="modal-body">
		            <div class="col">
		                <div class="login-one-ico"><i class="fa fa-opencart" id="lockico"></i></div>
		                <div class="form-group mb-3">
		                    <div>
		                        <h3 id="heading">Employee Log in:</h3>
		                        <div>
									<div class="input-group mb-1"><div class="input-group-prepend"><span class="input-group-text" id="basic-addon1"><i class="fas fa-user"></i></span></div>
									<input class="form-control-sm form-control" type="text" name="username" placeholder="Enter Username" required/></div>
									<div class="input-group"><div class="input-group-prepend"><span class="input-group-text" id="basic-addon1"><i class="fas fa-key"></i></span></div>
									<input class="form-control-sm form-control" type="password" name="password" placeholder="Enter Password" required/>
									<input type="hidden" name="position" value="Employee"/></div>
								</div>

		                    <div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-ban"></i>  Close</button>
								<button type="submit" name='login' class="btn btn-success"><i class="fas fa-sign-in-alt"></i> login</button>					
							</div>
		                </div>
		            </div>
	            </div>
	        </form>
		</div>
	</div>
</div>

    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
