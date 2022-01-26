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
$rid = validate_id($_GET['rid']);
//get data of selected category
$q = "SELECT role FROM roles WHERE role_id ={$rid}";
$r = mysqli_query($dbc, $q);
confirm_query($r, $q);

if (mysqli_num_rows($r) == 1) {
    $role = mysqli_fetch_array($r, MYSQLI_ASSOC);
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
                        <h4 class="card-title" style="text-align: center;font-size: 30px;">Delete position:<?php if (isset($role['role'])) echo $role['role'];?></h4>
                        <!-- Dummy Modal Starts -->
                        <form action="action/action_delete_role.php?rid=<?php echo $rid;?>" method="post">
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
                                            <p>Do you want to delete the position?<b><?php if (isset($role['role'])) echo $role['role'];?></b> Are not?</p>
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
