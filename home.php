<?php
	if($loginerror){
		echo 
			'<script>swal("","Something went wrong!","failure");</script>';
		}
		if($nouser){
		echo 
			'<script>swal("","No user found!","failure");</script>';
		}