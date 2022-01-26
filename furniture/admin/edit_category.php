<?php
include "check_login.php";
$account = $_SESSION['user_account'];
$permission = 'edit_category';
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



$cid = validate_id($_GET['cid']);//function


//get data of selected category

$q = "SELECT * FROM categories WHERE cat_id ={$cid}";
$r = mysqli_query($dbc, $q);
confirm_query($r, $q);

if (mysqli_num_rows($r) == 1) {
    $cats = mysqli_fetch_array($r,MYSQLI_ASSOC);
} else {
    $msg = "Error!Category does not exist";
    $suc = 0;
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
                        <h4 class="card-title" style="text-align: center;font-size: 30px;">Edit directory:<?php if(isset($cats['cat_name'])) echo $cats['cat_name'];?></h4>
                        <form class="forms-sample" action="action/action_edit_category.php?cid=<?php echo $cid;?>" method="post" >

                            <div class="form-group">
                                <label for="exampleInputName1">category name<span style="color: red">*</span></label>
                                <input type="text" value="<?php if(isset($cats['cat_name'])) echo $cats['cat_name'];?>"
                                   name="category" class="form-control" id="exampleInputName1" placeholder="Name list" />
                            </div>

                            <div class="form-group">
                                <label for="exampleInputName1">category description<span style="color: red">*</span></label>
                                <input type="text" value="<?php if(isset($cats['description'])) echo $cats['description'];?>"
                                       name="desc" class="form-control" id="exampleInputName1" placeholder="description" />
                               
                            </div>

                            <div class="form-group">
                                <label for="exampleInputPassword4">user Position<span style="color: red">*</span></label>
                                <select name="position" aria-controls="order-listing" class="form-control">
                                    <option>Position</option>
                                    <?php
                                    $q = "SELECT count(cat_id) as count FROM categories";
                                    $r = mysqli_query($dbc,$q);
                                    confirm_query($r,$q);

                                    if (mysqli_num_rows($r) == 1){
                                        list($num) = mysqli_fetch_array($r,MYSQLI_NUM);
                                        for($i=1;$i<=$num+1;$i++){
                                            echo "<option value='{$i}'";
                                            if(isset($cats['position']) && $cats['position'] == $i) echo "selected='selected'";
                                            echo ">".$i."</option>";
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <button type="submit" name="submit" class="btn btn-primary mr-2">Edit category</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- content-wrapper ends -->
</div>
<?php include "admin_end.php" ?>;

