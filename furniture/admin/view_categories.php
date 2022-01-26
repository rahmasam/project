<?php
include "check_login.php";
$account = $_SESSION['user_account'];
$permission = 'add_category';
include "admin_header.php";
include "admin_navbar.php";
include "admin_partial.php";
include "admin_sidebar.php";
include('../includes/mysqli_connect.php');
include('../includes/functions.php');

if (isset($_GET['msg'])){
    $msg = $_GET['msg'];
}else{
    $msg= '';
}if (isset($_GET['suc'])){
    $suc = $_GET['suc'];
}else{
    $suc= '';
}

?>
<?php
//Phan trang

$page = 1;//initialize page
$limit = 10;//number of records per page (2 records per page)
$arrs_list = mysqli_query($dbc, "
                    select cat_id from categories 
                ");
$total_record = mysqli_num_rows($arrs_list);//calculate the total number of records that have

$total_page = ceil($total_record / $limit);//calculate the total number of pages to be divided

// see if the page is out of bounds:
if (isset($_GET["page"]))
//if the $_GET["page"] variable exists, the current page is $_GET["page"]
    $page = $_GET["page"];
    //if current page is less than 1 then set equal to 1
if ($page < 1) $page = 1;
//if the current page exceeds the number of divided pages, it will be equal to the last page
if ($page > $total_page) $page = $total_page;

//calculate start (where the record will start getting):
$start = ($page - 1) * $limit;
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
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title" style="text-align: center;font-size: 30px;">List of categories</h4>
                        <p>Total <b><?php echo $total_record;?></b>category</p><br>
                        <div id="js-grid" class="jsgrid" style="position: relative; height: 500px; width: 100%;">
                            <div class="jsgrid-grid-header jsgrid-header-scrollbar">
                                <table class="jsgrid-table">

                                    <tr class="jsgrid-header-row">

                                        <th class="jsgrid-header-cell jsgrid-align-center jsgrid-header-sortable" style="width: 50px;">
                                            #
                                        </th>
                                        <th class="jsgrid-header-cell jsgrid-align-center jsgrid-header-sortable"
                                            style="width: 150px;">
                                           category Name
                                        </th>
                                        <th class="jsgrid-header-cell jsgrid-align-center jsgrid-header-sortable"
                                            style="width: 100px;">
                                            description
                                        </th>
                                        <th class="jsgrid-header-cell jsgrid-align-center jsgrid-header-sortable"
                                            style="width: 100px;">
                                            Position
                                        </th>
                                        <th class="jsgrid-header-cell jsgrid-control-field jsgrid-align-center"
                                            style="width: 50px;"><a href="add_category.php"><input
                                                    class="jsgrid-button jsgrid-mode-button jsgrid-insert-mode-button"
                                                    type="button" title="Add category"></a></th>
                                    </tr>
                                </table>
                            </div>
                            <div class="jsgrid-grid-body" style="height: 307.625px;">
                                <table class="jsgrid-table">
                                    <tbody>
                                    <?php
                                    $q = "SELECT * FROM categories ORDER BY cat_id ASC LIMIT $start,$limit ";
                                    $r = mysqli_query($dbc, $q);
                                    confirm_query($r, $q);
                                    $stt=0;
                                    while ($cats = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
                                        $stt+=1;
                                        
                                        echo "
                                        <tr class=\"jsgrid-row\">
                                            <td class=\"jsgrid-cell jsgrid-align-center\" style=\"width: 50px;\">".$stt."</td>
                                            <td class=\"jsgrid-cell jsgrid-align-center\" style=\"width: 150px;\">".$cats['cat_name']."</td>
                                            <td class=\"jsgrid-cell jsgrid-align-center\" style=\"width: 150px;\">".substr($cats['description'],0,25)."</td>
                                            <td class=\"jsgrid-cell jsgrid-align-center\" style=\"width: 100px;\">".$cats['position']."</td>
                                            <td class=\"jsgrid-cell jsgrid-control-field jsgrid-align-center\"
                                                style=\"width: 50px;\">
                                                <a href='edit_category.php?cid={$cats['cat_id']}'><input class=\"jsgrid-button jsgrid-edit-button\" type=\"button\" title=\"Cancel\"></a>
                                                <a href='delete_category.php?cid={$cats['cat_id']}'><input class=\"jsgrid-button jsgrid-delete-button\" type=\"button\" title=\"Erase\"></a>
                                            </td>
                                        </tr>
                                        ";
                                    }
                                    ?>

                                    </tbody>
                                </table>
                            </div>
                            <div class="jsgrid-pager-container">
                                <ul class="pagination" style="margin-top: 50px">
                                    <?php
                                    $current_page = ($start/$limit) + 1;
                                    if ($page>1){?>
                                        <li class="page-item">
                                            <a class="page-link" href="view_categories.php?page=<?php echo $current_page -1; ?>">
                                                <i class="mdi mdi-chevron-left"></i>
                                            </a>
                                        </li>
                                    <?php } ?>
                                    <?php for($i=1;$i<=$total_page;$i++){ ?>
                                        <li class="page-item <?php if($page == $i) echo "active"; ?>">
                                            <a class="page-link" href="view_categories.php?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                                        </li>
                                    <?php } ?>
                                    <?php
                                    if ($current_page<$total_page){?>
                                        <li class="page-item">
                                            <a class="page-link" href="view_categories.php?page=<?php echo $current_page +1; ?>">
                                                <i class="mdi mdi-chevron-right"></i>
                                            </a>
                                        </li>
                                    <?php } ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- content-wrapper ends -->
</div>
<?php include "admin_end.php" ?>;
