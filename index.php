<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <script src="bootstrap4/jquery/sweetalert.min.js"></script>
    <?php include('templates/head.php'); ?>
    <?php 
        $nouser = '';
        $loginerror = '';

        if (isset($_GET['loginerror']) || isset($_GET['nouser'])) {
            if (isset($_GET['loginerror'])) {
                $loginerror = $_GET['loginerror'];
                echo '<script> alert("Something went wrong!");</script>';
            }
            if (isset($_GET['nouser'])) {
                $nouser = $_GET['nouser'];
                echo '<script> alert("No user found!");</script>';
            }
        }
    ?>

    <?php include 'home.php' ?>
    
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
</head>

<body>
    <div class="container" style="margin-top: 100px;">
        <div class="row">
            <div class="col-md-6">
                <h1 style="font-size: 52.36px;font-weight: 900;margin-top: 115px;">Do a lot with a modern POS</h1>
                <p style="font-weight: bold;font-size: 18px;margin-top: 12px;">Choose your account type</p>
                <div class="btn-group" role="group">
                    <button class="btn btn-primary" type="button" style="margin-right: 23px;" id="admin" data-toggle="modal" data-target=".bd-example-modal-sm"><i class="fas fa-user-tie"></i> - Administrator</button>
                    <button class="btn btn-success" type="button" id="user" data-toggle="modal" data-target="#modal-user"><i class="fas fa-user"></i> - Employee</button>
                </div>
            </div>
            <div class="col-md-6 col-lg-6 offset-lg-0"><img src="https://i.imgur.com/SlLjy2g.png" style="width: 447px;"></div>
        </div>
    </div>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="bootstrap4/jquery/jquery.min.js"></script>
    <script src="bootstrap4/js/bootstrap.bundle.min.js"></script>

    <!-- Admin Modal -->
    <div class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-sm modal-dialog-centered">
            <div class="modal-content text-center">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="fas fa-user-lock"></i> Admin Sign In</h5>
                </div>
                <form class="login-one-form" method="post" action="login.php">
                    <div class="modal-body">
                        <div class="col">
                            <div class="login-one-ico"><i class="fa fa-opencart" id="lockico"></i></div>
                            <div class="form-group mb-3">
                                <div>
                                    <h3 id="heading">Admin Log in:</h3>
                                    <input type="hidden" name="position" value="admin" />
                                    <input type="hidden" name="username" value="admin" />
                                </div>
                                <input class="form-control" id="pass" type="password" name="password" placeholder="Enter Password" required>
                                <div class="modal-footer">
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

    <!-- Employee Modal -->
    <div class="modal fade" id="modal-user" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-sm modal-dialog-centered">
            <div class="modal-content text-center">
                <form class="login-one-form" method="post" action="login.php">
                    <div class="modal-body">
                        <div class="col">
                            <div class="login-one-ico"><i class="fa fa-opencart" id="lockico"></i></div>
                            <div class="form-group mb-3">
                                <div>
                                    <h3 id="heading">Employee Log in:</h3>
                                    <div>
                                        <div class="input-group mb-1">
                                            <div class="input-group-prepend"><span class="input-group-text" id="basic-addon1"><i class="fas fa-user"></i></span></div>
                                            <input class="form-control-sm form-control" type="text" name="username" placeholder="Enter Username" required />
                                        </div>
                                        <div class="input-group">
                                            <div class="input-group-prepend"><span class="input-group-text" id="basic-addon1"><i class="fas fa-key"></i></span></div>
                                            <input class="form-control-sm form-control" type="password" name="password" placeholder="Enter Password" required />
                                            <input type="hidden" name="position" value="Employee" />
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-ban"></i> Close</button>
                                        <button type="submit" name='login' class="btn btn-success"><i class="fas fa-sign-in-alt"></i> login</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>
