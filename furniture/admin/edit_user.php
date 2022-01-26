<?php
include "check_login.php";
include('../includes/mysqli_connect.php');
include('../includes/functions.php');
include "admin_header.php";
include "admin_navbar.php";
include "admin_partial.php";
include "admin_sidebar.php";

if (isset($_GET['msg'])) {
    $msg = $_GET['msg'];
} else {
    $msg = '';
}

if (isset($_GET['suc'])) {
    $suc = $_GET['suc'];
} else {
    $suc = '';
}

//xu li code

$uid = validate_id($_GET['uid']);




$q = "SELECT * FROM users WHERE user_id ={$uid}";
$r = mysqli_query($dbc, $q);
confirm_query($r, $q);

if (mysqli_num_rows($r) == 1) {
    $user = mysqli_fetch_array($r, MYSQLI_ASSOC);
} else {
    $msg = "Error!This account no longer exists";
    $suc = 0;
}
?>

<div class="main-panel">
    <div class="content-wrapper">
        <?php
        if (!empty($msg) && ($suc == 0)) {
            echo "
                    <div class=\"card card-inverse-warning\" id=\"context-menu-access\">
                        <div class=\"card-body\">
                          <p class=\"card-text\" style='text-align: center;'>{$msg}</p>
                        </div>
                    </div>";
        } elseif (!empty($msg) && ($suc == 1)) {
            echo "
                    <div class=\"card card-inverse-success\" id=\"context-menu-access\">
                        <div class=\"card-body\">
                          <p class=\"card-text\" style='text-align: center;'>{$msg}</p>
                        </div>
                    </div>";
        } //If there is an error or a curved bar, the message will appear on the screen
        ?>
        <div class="row grid-margin">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title" style="text-align: center;font-size: 30px;">Edit 's account : <?php if (isset($user['user_name'])) echo $user['user_name']; ?></h4>
                        <form class="forms-sample" action="action/action_edit_user.php?uid=<?php echo $uid; ?>" method="post">
                            <div class="form-group">
                                <label for="exampleInputName1">First and last name<span style="color: red">*</span></label>
                                <input type="text" value="<?php if (isset($user['user_name'])) echo $user['user_name']; ?>" name="name" class="form-control" id="exampleInputName1" placeholder="" />
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail3">Email<span style="color: red">*</span></label>
                                <input type="text" value="<?php if (isset($user['user_account'])) echo $user['user_account']; ?>" name="account" class="form-control" id="exampleInputEmail3" placeholder="" />
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail3">phone<span style="color: red">*</span></label>
                                <input type="text" value="<?php if (isset($user['phone'])) echo $user['phone']; ?>" name="phone" class="form-control" id="exampleInputEmail3" placeholder="" />
                            </div>

                            

                            <div class="form-group">
                                <label>Choose a photo for your user<span style="color: red">*</span></label>
                                <input type="file" name="image" class="file-upload-default">
                                <div class="input-group col-xs-12">
                                    <input type="text" value="<?php echo $user['image'] ?>" class="form-control file-upload-info" disabled="" placeholder="...">
                                    <span class="input-group-append">
                                        <button class="file-upload-browse btn btn-primary" type="button">Choose a photo</button>
                                    </span>
                                </div>
                            </div>



                            <div class="form-group">
                                <label for="exampleInputPassword4">Choose a position<span style="color: red">*</span></label>
                                <select name="role_id" aria-controls="order-listing" class="form-control">
                                    <option>No position yet</option>
                                    <?php
                                    $q = "SELECT * FROM roles";
                                    $r = mysqli_query($dbc, $q);
                                    confirm_query($r, $q);

                                    if (mysqli_num_rows($r) > 0) {
                                        while ($role = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
                                            echo "<option value='{$role['role_id']}'";
                                            if (isset($user['role_id']) && $role['role_id'] == $user['role_id']) echo "selected='selected'";
                                            echo ">" . $role['role'] . "</option>";
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <button type="submit" name="submit" class="btn btn-primary mr-2">Edit user</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- content-wrapper ends -->
</div>
<?php include "admin_end.php" ?>;