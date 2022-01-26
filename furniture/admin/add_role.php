<?php
include "check_login.php";
include ('../includes/mysqli_connect.php');
include ('../includes/functions.php');
include "admin_header.php";
include "admin_navbar.php";
include "admin_partial.php";
include "admin_sidebar.php";

if (isset($_GET['msg'])){
    $msg = $_GET['msg'];
}else{
    $msg= '';
}

if (isset($_GET['suc'])){
    $suc = $_GET['suc'];
}else{
    $suc= '';
}
?>

<div class="main-panel">
    <div class="content-wrapper">
        <?php
        if (!empty($msg) && ($suc==0)){
            echo "
                    <div class=\"card card-inverse-warning\" id=\"context-menu-access\">
                        <div class=\"card-body\">
                          <p class=\"card-text\" style='text-align: center;'>{$msg}</p>
                        </div>
                    </div>";
        } elseif(!empty($msg) && ($suc==1)){
            echo "
                    <div class=\"card card-inverse-success\" id=\"context-menu-access\">
                        <div class=\"card-body\">
                          <p class=\"card-text\" style='text-align: center;'>{$msg}</p>
                        </div>
                    </div>";
        }//if there is an error or the bar is bent, the message will be displayed on the screen
        ?>
        <div class="row grid-margin">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title" style="text-align: center;font-size: 30px;">Add position</h4>
                        <form class="forms-sample" method="post" action="action/action_add_role.php">
                            <div class="form-group">
                                <label for="exampleInputName1">Job title<span style="color: red">*</span></label>
                                <input type="text" value="<?php if(isset($_POST['role'])) echo strip_tags($_POST['role']);?>"
                                       name="role" class="form-control" id="exampleInputName1" placeholder="Fill in job title..." />
                                
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail3">Decentralization</label>
                                <input type="text" value="<?php if(isset($_POST['permission'])) echo strip_tags($_POST['permission']);?>"
                                       name="permission" class="form-control" id="exampleInputEmail3" placeholder="Fill in the authority for the position: for example : add_categories" />
                            </div>
                            <button type="submit" name="submit" class="btn btn-primary mr-2">Add position</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- content-wrapper ends -->
</div>
<?php include "admin_end.php" ?>;

