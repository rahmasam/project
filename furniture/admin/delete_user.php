<?php
include "check_login.php";
include ('../includes/mysqli_connect.php');
include ('../includes/functions.php');
include "admin_header.php";
include "admin_navbar.php";
include "admin_partial.php";
include "admin_sidebar.php"
?>
<?php
$uid = validate_id($_GET['uid']);


$q = "SELECT user_name FROM users WHERE user_id ={$uid}";
$r = mysqli_query($dbc, $q);
confirm_query($r, $q);

if (mysqli_num_rows($r) == 1) {
    $user = mysqli_fetch_array($r, MYSQLI_ASSOC);
} else {
    $msg = "Error!Category does not exist";
    $suc = 0;
}
?>

<div class="main-panel">
    <div class="content-wrapper">
        <div class="row grid-margin">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title" style="text-align: center;font-size: 30px;">Delete your account:<?php if (isset($user['user_name'])) echo $user['user_name'];?></h4>
                        <!-- Dummy Modal Starts -->
                        <form action="action/action_delete_user.php?uid=<?php echo $uid;?>" method="post">
                            <div class="modal demo-modal">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Notify</h5>
                                            <button type="button" class="close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Do you want to delete your account?<b><?php if (isset($user['user_name'])) echo $user['user_name'];?></b> Are not?</p>
                                        </div>
                                        <div class="modal-footer">
                                            <input type="submit" class="btn btn-danger" name="delete" value="Erase">
                                            <input type="submit" class="btn btn-light" name="delete" value="Cancel">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <!-- Dummy Modal Ends -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- content-wrapper ends -->
</div>
<?php include "admin_end.php" ?>;
