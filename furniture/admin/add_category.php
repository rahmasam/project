<?php
include "check_login.php";
$account = $_SESSION['user_account'];

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
        }//If there is an error or a curved bar, the message will appear on the screen
        ?>
        <div class="row grid-margin">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title" style="text-align: center;font-size: 30px;">Add category</h4>

                        <form class="forms-sample" method="post" action="action/action_add_category.php">
                            <div class="form-group">
                                <label for="exampleInputName1">category Name<span style="color: red">*</span></label>
                                <input type="text" value="<?php if(isset($_POST['category'])) echo strip_tags($_POST['category']);?>"
                                       name="category" class="form-control" id="exampleInputName1" placeholder="Name list" />
                                
                            </div>
                            
                            <div class="form-group">
                                <label for="exampleInputName1">category description<span style="color: red">*</span></label>
                                <input type="text" value="<?php if(isset($_POST['desc'])) echo strip_tags($_POST['desc']);?>"
                                       name="desc" class="form-control" id="exampleInputName1" placeholder="Name list" />
                                
                            </div>




                            <div class="form-group">
                                <label for="exampleInputPassword4">Choose a role<span style="color: red">*</span></label>
                                <select name="position" aria-controls="order-listing" class="form-control">
                                    <option>Position</option>
                                    <?php
                                    
                                       
                                        $q = "SELECT * FROM roles";
                                        $r = mysqli_query($dbc,$q);
                                        confirm_query($r,$q);
    
                                        if (mysqli_num_rows($r) > 0){
                                            
                                            while ($cats = mysqli_fetch_array($r,MYSQLI_ASSOC)){
                                                echo "<option value='$cats[role_id]'>$cats[role]</option>";
                                            }
                                        }
                                
                                    ?>
                                </select>
                            </div>
                            <button type="submit" name="submit" class="btn btn-primary mr-2">Add category</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- content-wrapper ends -->
</div>
<?php include "admin_end.php" ?>;

