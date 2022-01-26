<?php
include "check_login.php";
include ('../includes/mysqli_connect.php');
include ('../includes/functions.php');
include "admin_header.php";
include "admin_navbar.php";
include "admin_partial.php";
include "admin_sidebar.php";

//kiem tra bien $_GET['msg']
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
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title" style="text-align: center;font-size: 30px;">More Slides</h4>
                        <form class="forms-sample" method="post" action="action/action_add_slide.php" enctype="multipart/form-data">


                            <div class="form-group">
                                <label>Select slide image<span style="color: red">*</span></label>
                                <input type="file" name="image" class="file-upload-default">
                                <div class="input-group col-xs-12">
                                    <input type="text" class="form-control file-upload-info" disabled="" placeholder="...">
                                    <span class="input-group-append">
                          <button class="file-upload-browse btn btn-primary" type="button">Choose a photo</button>
                        </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleTextarea1">Description<span style="color: red">*</span></label>

                                <textarea class="form-control" name="description" id="editor1" rows="4">
                                <?php if (isset($_POST['description']))
                                    $content = htmlentities($_POST['description'],ENT_COMPAT,'UTF-8');
                                //convert html tags to special form
                                ?>
                                </textarea>
                                <script>

                                    CKEDITOR.replace( 'editor1' );

                                </script>
                            </div>
                            <input type="submit" class="btn btn-primary mr-2" name="submit" value="add slide">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- content-wrapper ends -->
</div>
<?php include "admin_end.php" ?>;
