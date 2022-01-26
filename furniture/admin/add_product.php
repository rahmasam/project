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
                        <h4 class="card-title" style="text-align: center;font-size: 30px;">More products</h4>

                        
                        <form class="forms-sample" method="post" action="action/action_add_product.php" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="exampleInputPassword4">Products in this category<span style="color: red">*</span></label>
                                <select  name="cat_id" aria-controls="order-listing" class="form-control">
                                    <option>Categories</option>
                                    <?php
                                    $q = "SELECT * FROM categories ";
                                    $r = mysqli_query($dbc,$q);
                                    confirm_query($r,$q);

                                    if (mysqli_num_rows($r) > 0){
                                        while ($cats = mysqli_fetch_array($r,MYSQLI_ASSOC)){
                                            echo "<option value='$cats[cat_id]'>$cats[cat_name]</option>";
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputName1">Product's name<span style="color: red">*</span></label>
                                <input type="text" class="form-control"
                                       value="<?php if(isset($_POST['product'])) echo strip_tags($_POST['product']);?>"
                                       name="product" id="exampleInputName1" placeholder="...">
                            </div>

                            <div class="form-group">
                                <label>Choose a photo for the product<span style="color: red">*</span></label>
                                <input type="file" name="image" class="file-upload-default">
                                <div class="input-group col-xs-12">
                                    <input type="text" class="form-control file-upload-info" disabled="" placeholder="...">
                                    <span class="input-group-append">
                          <button class="file-upload-browse btn btn-primary" type="button">Choose a photo</button>
                        </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Product price<span style="color: red">*</span></label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-primary text-white">Price</span>
                                    </div>
                                    <input type="number" class="form-control" name="product_price" placeholder="..." aria-label="Amount (to the nearest dollar)">
                                    <div class="input-group-append">
                                        <span class="input-group-text">L.E</span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Product selling price<span style="color: red">*</span></label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-primary text-white">Price</span>
                                    </div>
                                    <input type="number" class="form-control" name="selling_price" placeholder="..." aria-label="Amount (to the nearest dollar)">
                                    <div class="input-group-append">
                                        <span class="input-group-text"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputCity1">Where production<span style="color: red">*</span></label>
                                <input type="text"
                                       value="<?php if(isset($_POST['made_in'])) echo strip_tags($_POST['made_in']);?>"
                                       name="made_in" class="form-control" id="exampleInputCity1" placeholder="...">
                            </div>
                            <div class="form-group">
                                <label for="exampleTextarea1">Product information<span style="color: red">*</span></label>

                                <textarea class="form-control" name="introduce" id="editor1" rows="4">
                                <?php if (isset($_POST['introduce']))
                                    $content = htmlentities($_POST['introduce'],ENT_COMPAT,'UTF-8');
                                //convert html tags to special form
                                ?>
                                </textarea>
                                <script>

                                    CKEDITOR.replace( 'editor1' );

                                </script>
                            </div>
                            <input type="submit" class="btn btn-primary mr-2" name="submit" value="add products">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- content-wrapper ends -->
</div>
<?php include "admin_end.php" ?>;
