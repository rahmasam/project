<?php
include "check_login.php";
include ('../includes/mysqli_connect.php');
include ('../includes/functions.php');
include "admin_header.php";
include "admin_navbar.php";
include "admin_partial.php";
include "admin_sidebar.php";

//$_GET['msg']
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
        }//If there is an error or a curved bar, the message will appear on the screen
        ?>
        <div class="row grid-margin">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title" style="text-align: center;font-size: 30px;">add new User</h4>
                        <form class="forms-sample" method="post" action="action/action_add_user.php" enctype="multipart/form-data">
                           

                        <div class="form-group">
                            <label for="exampleInputName1">User's name<span style="color: red">*</span></label>
                                <input type="text" class="form-control"
                                       value="<?php if(isset($_POST['name'])) echo Clean($_POST['product']);?>"
                                       name="name" id="exampleInputName1" placeholder="Enter your name...">
                        </div>


                        <div class="form-group">

                                <label for="exampleInputName1">Email account<span style="color: red">*</span></label>
                                <input type="text" class="form-control"
                                       value="<?php if(isset($_POST['email'])) echo Clean($_POST['email']);?>"
                                       name="email" id="exampleInputName1" placeholder="Enter your email...">
                        </div>
                        
                        <div class="form-group">

                                <label for="exampleInputName1">User Password<span style="color: red">*</span></label>
                                <input type="text" class="form-control"
                                       value="<?php if(isset($_POST['password'])) echo Clean($_POST['password']);?>"
                                       name="password" id="exampleInputName1" placeholder="Enter your email...">
                        </div>




                        <div class="form-group">
                                <label>Choose a photo for the User<span style="color: red">*</span></label>
                                <input type="file" name="image" class="file-upload-default">
                                <div class="input-group col-xs-12">
                                    <input type="text" class="form-control file-upload-info" disabled="" placeholder="...">
                                    <span class="input-group-append">
                                    <button class="file-upload-browse btn btn-primary" type="button">Choose a photo</button>
                                    </span>
                                </div>
                        </div>

                        <div class="form-group">
                                <label>User Phone<span style="color: red">*</span></label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-primary text-white">phone</span>
                                    </div>
                                    <input type="number" class="form-control" name="phone" placeholder="enter your phone..." >
                                    <div class="input-group-append">
                                        <span class="input-group-text">EG</span>
                                    </div>
                                </div>
                        </div>

                        <div class="form-group">
                                <label for="exampleInputPassword4">Choose a position<span style="color: red">*</span></label>
                                <select name="role_id" aria-controls="order-listing" class="form-control">
                                    <option>No position yet</option>
                                    <?php
                                    $q = "SELECT * FROM roles";
                                    $r = mysqli_query($dbc,$q);
                                    confirm_query($r,$q);

                                    if (mysqli_num_rows($r) > 0){
                                        while ($role = mysqli_fetch_array($r,MYSQLI_ASSOC)){
                                            echo "<option value='{$role['role_id']}'";
                                            if (isset($user['role_id']) && $role['role_id'] == $user['role_id']) echo "selected='selected'";
                                            echo ">".$role['role']."</option>";
                                        }
                                    }
                                    ?>
                                </select>
                            </div>

                            <input type="submit" class="btn btn-primary mr-2" name="submit" value="add user">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- content-wrapper ends -->
</div>
<?php include "admin_end.php" ?>;
