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
<link rel="stylesheet" type="text/css" href="bootstrap4/css/bootstrap.min.cssmmmm">
<link rel="stylesheet" type="text/css" href="bootstrap4/css/style.css">
<link rel="stylesheet" href="bootstrap4/css/all.min.css"/>
<link rel="stylesheet" href="bootstrap4/css/typeahead.css"/>
<link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">

    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/Login-screen.css">
<script src="bootstrap4/jquery/sweetalert.min.js"></script>
<script src="assets/bootstrap/js/bootstrap.min.js"></script>

</head>
<body>
	<div class="h-100 bg-dark" id="container">
		<div id="header">
			<?php
	if($deleted){
		echo 
			'<script>swal("","Successfully Deleted!","success");</script>';
		}
	if($added){
		echo 
			'<script>swal("","Successfully Added!","success");</script>';
	}
	if($updated){
		echo 
			'<script>swal("","Successfully Updated!","success");</script>';
	}
	if($undelete){
		echo '<script>swal("","Cannot Delete this one!","warning");</script>';
	}
	if($error){
		echo '<script>swal("","Cannot Delete this item!","warning");</script>';
	}
	if($failure){
		echo '<script>swal("Unsuccesful","Customer not found!","error");</script>';
	}
	if($not_added){
		echo '<script>swal("Unsuccesful","Customer number already used!","error");</script>';
	}
 ?>
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
		<div id="footer" class="w-100">
			<button id="buttons" onclick="window.location.href='user/user.php'" class="btn btn-secondary border mr-2 ml-2"><i class="fas fa-users"></i> User</button>
			<button id="buttons" onclick="window.location.href='products/products.php'" class="btn btn-secondary border mr-2"><i class="fas fa-box-open"></i> Product</button>
			<button id="buttons" onclick="window.location.href='supplier/supplier.php'" class="btn btn-secondary border mr-2"><i class="fas fa-user-tie"></i> Supplier</button>
			<button id="buttons" onclick="window.location.href='customer/customer.php'" class="btn btn-secondary border mr-2"><i class="fas fa-user-friends"></i> Customer</button>
			<button id="buttons" onclick="window.location.href='logs/logs.php'" class="btn btn-secondary border mr-2"><i class="fas fa-globe"></i> Logs</button>
			<button id="buttons" onclick="window.location.href='cashflow/cashflow.php'" class="btn btn-secondary border mr-2"><i class="fas fa-money-bill-wave"></i> Cash-Flow</button>
			<button id="buttons" onclick="window.location.href='sales/sales.php'" class="btn btn-secondary border mr-2"><i class="fas fa-shopping-cart"></i> Sales</button>
			<button id="buttons" onclick="window.location.href='delivery/delivery.php'" class="btn btn-secondary border mr-2"><i class="fas fa-truck"></i> Deliveries</button>
			<button id="buttons" name="logout" type="button" onclick="out();" class="logout btn btn-danger border mr-2"><i class="fas fa-sign-out-alt"></i> Logout</button> 
		</div>
	</div>
	
<style>
	input[name="image"]{
		width: 100px;
	}
	input[id="validationCustom02"]{
		margin-bottom: -20px
	}
</style>
<?php 

	if(isset($_SESSION['pos_username'])){
		$name = $_SESSION['pos_username'];
	} elseif (isset($_SESSION['pos_username_employee'])) {
		$name = $_SESSION['pos_username_employee'];
	} else {
		$name = 'A strange user';
	}

 ?>

<!-- Modal for Adding data -->
<div class="modal fade bd-example-modal-md" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog modal-fluid" role="document">
		<div class="modal-content" style="width:70%; margin-left: 20%;">
	  		<div class="modal-header bg-secondary">
				<h4 class="modal-title text-light" id="exampleModalCenterTitle" ><strong>Add New Customer</strong></h4>
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	  		</div>
	  	<div class="modal-body">
			<div class="container-fluid">
				<form method="post" id="modal-form" action="add_customer.php" enctype="multipart/form-data" class="needs-validation">
		  			<div>
		  			<div align="center">
		  				<input type="hidden" name="size" class="form-control-sm" value="1000000">
		  				<input type="hidden" name="user" class="form-control-sm" value="<?php echo $name;?>">
		  				<img class="mb-1" width="150" height="150" src="images/user.png"/>
		  			</div>
		  				<small><div class="input-group mb-2"><div class="input-group-prepend"><span class="input-group-text" id="basic-addon1"><i class="fas fa-pen-alt"></i></span></div>		  				
		  				<input class="form-control form-control-sm" type="text" name="fname" placeholder="Enter First name" required></div>
		  				<div class="input-group mb-2"><div class="input-group-prepend"><span class="input-group-text" id="basic-addon1"><i class="fas fa-pen-alt"></i></span></div>
		  				<input class="form-control form-control-sm" type="text" name="lname" placeholder="Enter Last name" required></div>
		  				<div class="input-group mb-2"><div class="input-group-prepend"><span class="input-group-text" id="basic-addon1"><i class="fas fa-phone"></i></span></div>
		  				<input class="form-control form-control-sm" pattern='\d{10}' title='Phone Number (Format: 0999999999)' type="text" name="number" placeholder="Enter Phone number" required></div>
		  				<div class="input-group"><div class="input-group-prepend"><span class="input-group-text" id="basic-addon1"><i class="fas fa-map-marker-alt"></i></span></div>
		  				<textarea type="text" class="form-control form-control-sm" name="address" placeholder="Enter Address" required></textarea></div>
		  				</small>

		  			</div>
				</form>
			</div>
		</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-outline-danger" data-dismiss="modal"><i class="fas fa-ban"></i> Cancel</button>
				<button  type="submit" name="submit" class="btn btn-secondary" form="modal-form">Submit</button>
			</div>
		</div>
	</div>
</div>


	<?php include('templates/js_popper.php');?>
	<script type="text/javascript">
		function loadproducts(){
	var name = $("#search").val();
	if(name){
		$.ajax({
			type: 'post',
			data: {
				products:name,
			},
			url: 'loadproducts.php',
			success: function (Response){
				$('#products').html(Response);
			}
		});
	}
};

$(document).ready(function(){

  $('#customer_search').typeahead({

    source: function(query, result)
    {

        $.ajax({
          url: 'loadcustomer.php',
          method: "POST",
          data:{
            query:query
          },
          dataType: "json",
          success:function(data)
          {
            result($.map(data,function(item){
              return item;
            }));
          }
        })
    }
  });
});


function GrandTotal(){
  var TotalValue = 0;
  var TotalPriceArr = $('#tableData tr .totalPrice').get()
  var discount = $('#discount').val();

  $(TotalPriceArr).each(function(){
    TotalValue += parseFloat($(this).text().replace(/,/g, "").replace("Mwk",""));
  });

  if(discount != null){
    var f_discount = 0;

    f_discount = TotalValue - discount;

    $("#totalValue").text(accounting.formatMoney(f_discount,{symbol:"Mwk",format: "%s %v"}));
    $("#totalValue1").text(accounting.formatMoney(TotalValue,{format: "%v"}));
  }else{
    $("#totalValue").text(accounting.formatMoney(TotalValue,{symbol:"Mwk",format: "%s %v"}));
    $("#totalValue1").text(accounting.formatMoney(TotalValue,{format: "%v"}));
  }
};

$(document).on('change', '#discount', function(){
  GrandTotal();
});

$('body').on('click','.js-add',function(){
			var totalPrice = 0;
   		var target = $(this);
    	var product = target.attr('data-product');
    	var price = target.attr('data-price');
    	var barcode = target.attr('data-barcode');
      var images = target.attr('data-images');
    	var unit = target.attr('data-unt');   	
    	swal({
        title: "Enter number of items:",
  			content: "input",
		  })
		  .then((value) => {
			  if (value == "") {
				  swal("Error","Entered none!","error");
			  }else{
				  var qtynum = value;
				  if (isNaN(qtynum)){
    				swal("Error","Please enter a valid number!","error");
          }else if(qtynum == null){
            swal("Error","Please enter a number!","error");
    		  }else{
    				var total = parseInt(value,10) * parseFloat(price);
    				$('#tableData').append("<tr class='prd'><td> <img style='width: auto; height: 40px;' src='images/"+images+"'></td><td class='barcode text-center'>"+barcode+"</td><td class='text-center'>"+product+"</td><td class='price text-center'>"+accounting.formatMoney(price,{symbol:"Mwk",format: "%s %v"})+"</td><td class='text-center'>"+unit+"</td><td class='qty text-center'>"+value+"</td><td class='totalPrice text-center'>"+accounting.formatMoney(total,{symbol:"Mwk",format: "%s %v"})+"</td><td class='text-center p-1'><button class='btn btn-danger btn-sm' type='button' id='delete-row'><i class='fas fa-times-circle'></i></button><tr>");
	          GrandTotal();
        }
			}
  });
});

$(document).ready(function(){
  	document.getElementById("search").focus();
 });

$("body").on('click','#delete-row', function(){
   	var target = $(this);
   	swal({
  		title: "Remove this item?",
  		icon: "warning",
  		buttons: true,
  		dangerMode: true,
		})
		.then((willDelete) => {
  		if (willDelete) {
  			$(this).parents("tr").remove();
    		swal("Removed Successfully!", {
      		icon: "success",
    		});
    			GrandTotal();
  		}
	});
});

$(document).on('click','.Enter',function(){

  var TotalPriceArr = $('#tableData tr .totalPrice').get();

  if($.trim($('#customer_search').val()).length == 0){
      swal("Warning","Please Enter Customer Phone!","warning");
      return false;
    }

  if (TotalPriceArr == 0){
    swal("Warning","No products ordered!","warning");
    return false; 
  }else{

    var product = [];
    var quantity = [];
    var price = [];
    var user = $('#uname').val();
    var customer = $('#customer_search').val();
    var discount = $('#discount').val();

    $('.barcode').each(function(){
      product.push($(this).text());
    });
    $('.qty').each(function(){
      quantity.push($(this).text());
    });
    $('.price').each(function(){
      price.push($(this).text().replace(/,/g, "").replace("Mwk",""));
    });

    swal({
      title: "Enter Cash",
      content: "input",
    })
    .then((value) => {  
      if(value == "") {
        swal("Error","Entered None!","error");
      }else{

        var qtynum = value;
        if(isNaN(qtynum)){
          swal("Error","Please enter a valid number!","error");
        }else if(qtynum == null){
          swal("Error","Entered None!","error");
        }else{

          var change = 0;
          // var TotalPriceArr = $('#tableData tr .totalPrice').get()
          // $(TotalPriceArr).each(function(){
          //   TotalValue += parseFloat($(this).text().replace(/,/g, "").replace("Mwk",""));
          // });
          var TotalValue = parseFloat($('#totalValue').text().replace(/,/g, "").replace("Mwk",""));

          if(TotalValue > qtynum){
            swal("Error","Can't process a smaller number","error");
          }else{
            change = parseInt(value,10) - parseFloat(TotalValue);
            $.ajax({
              url:"insert_sales.php",
              method:"POST",
              data:{totalvalue:TotalValue, product:product, price:price, user:user, customer:customer, quantity:quantity, discount:discount},
              success: function(data){
                
                if( data == "success"){
                  swal({
                    title: "Change is " + accounting.formatMoney(change,{symbol:"Mwk",format: "%s %v"}),
                    icon: "success",
                    buttons: "Okay",
                  })
                  .then((okay)=>{
                    if(okay){
                      window.location.href='main.php';
                    }
                  })
                }else{
                  window.location.href='main.php?'+data;
                }
                
              }
            });
          }
        }
      }
    });
  }
});

$(document).on('click','.cancel',function(e){
  var TotalPriceArr = $('#tableData tr .totalPrice').get();
  if (TotalPriceArr == 0){
    return 0;
  }else{
    swal({
      title: "Cancel orders?",
      text: "By doing this,orders will remove!",
      icon: "warning",
      buttons: ["No","Yes"],
      dangerMode: true,
    })
    .then((reload) => {
      if (reload) {
        location.reload();
      }
    });
  }
});

function out(){
  var lag = "logout";
  swal({
      title: "Logout?",
      icon: "warning",
      buttons: ["Cancel","Yes"],
      dangerMode: true,
    })
    .then((value) => {
      if(value){
        if(lag){
            $.ajax({
              type: 'post',
              data: {
                logout:lag
              },
              url: 'server/connection.php',
              success: function (data){
                window.location.href='index.php';
              }
            });
        }
      }
    })
};

	</script>
	<script src="bootstrap4/js/time.js"></script>
</body>
</html> 
