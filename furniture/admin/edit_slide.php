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

$sid = validate_id($_GET['sid']);

?>

<?php
$q = "SELECT * FROM slides WHERE slide_id = {$sid}";
$r = mysqli_query($dbc,$q);
confirm_query($r,$q);
if (mysqli_num_rows($r) == 1){
    $slides = mysqli_fetch_array($r,MYSQLI_ASSOC);
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
        }
        ?>
        <div class="row grid-margin">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title" style="text-align: center;font-size: 30px;">Edit slides</h4>
                        <?php
                        if (isset($slides['slide_image'])){
                            echo "
                                <img src='uploads/slides/" . $slides['slide_image'] . "' style = 'margin-bottom: 20px;' alt=\"\">
                                ";
                        }
                        ?>
                        <form class="forms-sample" method="post" action="action/action_edit_slide.php?sid=<?php echo $sid;?>" enctype="multipart/form-data">

                            <div class="form-group">
                                <label>Choose an image for the slide<span style="color: red">*</span></label>
                                <input type="file" name="image" class="file-upload-default">
                                <div class="input-group col-xs-12">
                                    <input type="text" value="<?php echo $slides['slide_image']?>" class="form-control file-upload-info"
                                           disabled="" placeholder="...">
                                    <span class="input-group-append">
                          <button class="file-upload-browse btn btn-primary" type="button">Choose a photo</button>
                        </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleTextarea1">Description<span style="color: red">*</span></label>

                                <textarea class="form-control" name="description" id="editor1" rows="4">
                                <?php
                                if (isset($slides['description'])) echo $slides['description'];
                                ?>
                                </textarea>
                                <script>

                                    CKEDITOR.replace( 'editor1' );

                                </script>
                            </div>
                            <input type="submit" class="btn btn-primary mr-2" name="submit" value="Edit slides">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- content-wrapper ends -->
</div>
<?php include "admin_end.php" ?>;
