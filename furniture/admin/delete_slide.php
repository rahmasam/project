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
$sid = validate_id($_GET['sid']);
//get data of selected category

$q = "SELECT slide_image FROM slides WHERE slide_id ={$sid}";
$r = mysqli_query($dbc, $q);
confirm_query($r, $q);

if (mysqli_num_rows($r) == 1) {
    $slides = mysqli_fetch_array($r, MYSQLI_ASSOC);
} else {
    $msg = "Lỗi!Slide này không còn tồn tại";
    $suc = 0;
}
?>

<div class="main-panel">
    <div class="content-wrapper">
        <div class="row grid-margin">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title" style="text-align: center;font-size: 30px;">Delete slides</h4>
                        <?php
                            if (isset($slides['slide_image'])){
                                echo "
                                <img src='uploads/slides/" . $slides['slide_image'] . "' alt=\"\">
                                ";
                            }
                        ?>
                        <!-- Dummy Modal Starts -->
                        <form action="action/action_delete_slide.php?sid=<?php echo $sid;?>" method="post">
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
                                            <p>Do you want to delete this category?</p>
                                        </div>
                                        <div class="modal-footer">
                                            <input type="submit" class="btn btn-danger" name="delete" value="erase">
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
