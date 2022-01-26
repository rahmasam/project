<?php
if (isset($_GET['msg'])){
    $msg = $_GET['msg'];
}else{
    $msg = '';
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Original URL: http://www.urbanui.com/serein/template/demo/vertical-default-light/pages/samples/register-2.html
    Date Downloaded: 11/30/2018 1:56:42 PM !-->
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Serein Admin</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="vendors/iconfonts/mdi/font/css/materialdesignicons.min.css" />
    <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css" />
    <link rel="stylesheet" href="vendors/css/vendor.bundle.addons.css" />
    <!-- endinject -->
    <!-- plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="css/vertical-layout-light/style.css" />
    <!-- endinject -->
    <link rel="shortcut icon" href="images/favicon.png" />
</head>

<body>
<div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="content-wrapper d-flex align-items-stretch auth auth-img-bg">
            <div class="row flex-grow">
                <div class="col-lg-6 d-flex align-items-center justify-content-center">
                    <div class="auth-form-transparent text-left p-3">
                        <?php
                        if (!empty($msg)){
                            echo "
                                    <div class=\"card card-inverse-warning\" id=\"context-menu-access\">
                                        <div class=\"card-body\">
                                          <p class=\"card-text\" style='text-align: center;'>{$msg}</p>
                                        </div>
                                    </div>";
                        }
                        ?>
                        <div class="brand-logo">
                            <img src="images/logo.svg" alt="logo" />
                        </div>
                        <h4>Sign up for an admin account</h4>
                        <form class="pt-3" action="action/action_register.php" method="post">
                            <div class="form-group">
                                <label>Your full name</label>
                                <div class="input-group">
                                    <div class="input-group-prepend bg-transparent">
                      <span class="input-group-text bg-transparent border-right-0">
                        <i class="mdi mdi-account-outline text-primary"></i>
                      </span>
                                    </div>
                                    <input type="text" name="name" class="form-control form-control-lg border-left-0" placeholder="Username" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Email Accounts</label>
                                <div class="input-group">
                                    <div class="input-group-prepend bg-transparent">
                      <span class="input-group-text bg-transparent border-right-0">
                        <i class="mdi mdi-email-outline text-primary"></i>
                      </span>
                                    </div>
                                    <input type="email" name="account" class="form-control form-control-lg border-left-0" placeholder="Email" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <div class="input-group">
                                    <div class="input-group-prepend bg-transparent">
                      <span class="input-group-text bg-transparent border-right-0">
                        <i class="mdi mdi-lock-outline text-primary"></i>
                      </span>
                                    </div>
                                    <input type="password" name="password" class="form-control form-control-lg border-left-0" id="exampleInputPassword" placeholder="Password" />
                                </div>
                            </div>
                            <div class="mt-3">
                                <input type="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" value="Registration">
                            </div>
                            <div class="text-center mt-4 font-weight-light">
                            Do you already have an account? <a href="login.php" class="text-primary">Log in</a>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-6 register-half-bg d-flex flex-row">
                    <p class="text-white font-weight-medium text-center flex-grow align-self-end">Copyright &copy; 2018  All rights reserved.</p>
                </div>
            </div>
        </div>
        <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
</div>
<!-- container-scroller -->
<!-- plugins:js -->
<script src="vendors/js/vendor.bundle.base.js"></script>
<script src="vendors/js/vendor.bundle.addons.js"></script>
<!-- endinject -->
<!-- inject:js -->
<script src="js/off-canvas.js"></script>
<script src="js/hoverable-collapse.js"></script>
<script src="js/template.js"></script>
<script src="js/settings.js"></script>
<script src="js/todolist.js"></script>
<!-- endinject -->
</body>

</html>
