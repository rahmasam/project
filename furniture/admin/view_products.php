<?php
include "check_login.php";
include "admin_header.php";
include "admin_navbar.php";
include "admin_partial.php";
include "admin_sidebar.php";
include('../includes/mysqli_connect.php');
include('../includes/functions.php');

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

?>
<?php


$page = 1;
$limit = 10;
$arrs_list = mysqli_query($dbc, "
                    select product_id from products 
                ");
$total_record = mysqli_num_rows($arrs_list);
$total_page = ceil($total_record / $limit);


if (isset($_GET["page"]))
    $page = $_GET["page"];
if ($page < 1) $page = 1; 
if ($page > $total_page) $page = $total_page;


$start = ($page - 1) * $limit;
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
        }
        ?>

        <div class="row grid-margin">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title" style="text-align: center;font-size: 30px;">List of products</h4>
                        <p>total  <b><?php echo $total_record;?></b>product</p><br>
                        <div id="js-grid" class="jsgrid" style="position: relative; height: 500px; width: 100%;">
                            <div class="jsgrid-grid-header jsgrid-header-scrollbar">
                                <table class="jsgrid-table">
                                    <tr class="jsgrid-header-row">
                                        <th class="jsgrid-header-cell jsgrid-align-center jsgrid-header-sortable"
                                            style="width: 30px;">
                                            #
                                        </th>
                                        <th class="jsgrid-header-cell jsgrid-align-center jsgrid-header-sortable"
                                            style="width: 120px;">
                                            Product's name
                                        </th>
                                        <th class="jsgrid-header-cell jsgrid-align-center jsgrid-header-sortable"
                                            style="width: 150px;">
                                            Products in this category
                                        </th>
                                        <th class="jsgrid-header-cell jsgrid-align-center jsgrid-header-sortable"
                                            style="width: 100px;">
                                            Photo
                                        </th>
                                        <th class="jsgrid-header-cell jsgrid-align-center jsgrid-header-sortable"
                                            style="width: 100px;">
                                            Product price
                                        </th>
                                        <th class="jsgrid-header-cell jsgrid-align-center jsgrid-header-sortable"
                                            style="width: 100px;">
                                            Price
                                        </th>
                                        <th class="jsgrid-header-cell jsgrid-align-center jsgrid-header-sortable"
                                            style="width: 100px;">
                                            Where production
                                        </th>
                                        <th class="jsgrid-header-cell jsgrid-align-center jsgrid-header-sortable"
                                            style="width: 100px;">
                                            Product information
                                        </th>
                                        <th class="jsgrid-header-cell jsgrid-align-center jsgrid-header-sortable"
                                            style="width: 100px;">
                                            Date Submitted
                                        </th>
                                        <th class="jsgrid-header-cell jsgrid-control-field jsgrid-align-center"
                                            style="width: 50px;"><a href="add_product.php"><input
                                                        class="jsgrid-button jsgrid-mode-button jsgrid-insert-mode-button"
                                                        type="button" title="More products"></a></th>
                                    </tr>
                                </table>
                            </div>
                            <div class="jsgrid-grid-body" style="height: 307.625px;">

                                <table class="jsgrid-table">
                                    <tbody>
                                    <?php
                                    $q1 = "SELECT * FROM products ORDER BY product_id ASC LIMIT $start,$limit";
                                    $r1 = mysqli_query($dbc, $q1);
                                    confirm_query($r1, $q1);
                                    $stt = 0;
                                    while ($products = mysqli_fetch_array($r1, MYSQLI_ASSOC)) {
                                        $stt += 1;
                                        echo "
                                        <tr class=\"jsgrid-row\">
                                            <td class=\"jsgrid-cell jsgrid-align-center\" style=\"width: 30px;\">" . $stt . "</td>
                                            <td class=\"jsgrid-cell jsgrid-align-center\" style=\"width: 120px;\">" . $products['product_name'] . "</td>
                                            <td class=\"jsgrid-cell jsgrid-align-center\" style=\"width: 150px;\">";
                                        $q = "SELECT cat_id,cat_name ";
                                        $q .= " FROM categories ";
                                        $q .= " WHERE cat_id = {$products['cat_id']}";
                                        $r = mysqli_query($dbc, $q);
                                        confirm_query($r, $q);
                                        $cats = mysqli_fetch_array($r, MYSQLI_ASSOC);
                                        echo "{$cats['cat_name']}";
                                        echo "</td>
                                            <td class=\"jsgrid-cell jsgrid-align-center\" style=\"width: 100px;\"><a href='uploads/products/" . $products['image'] . "'><img src='uploads/products/" . $products['image'] . "' 
                                            style='    width: 50px;height: 50px;border-radius: 0%;' alt=''></a></td>
                                            <td class=\"jsgrid-cell jsgrid-align-center\" style=\"width: 100px;\">" . number_format($products['product_price'], 0, ',', '.') . "</td>
                                            <td class=\"jsgrid-cell jsgrid-align-center\" style=\"width: 100px;\">" . number_format($products['selling_price'], 0, ',', '.') . "</td>
                                            <td class=\"jsgrid-cell jsgrid-align-center\" style=\"width: 100px;\">" . $products['made_in'] . "</td>
                                            <td class=\"jsgrid-cell jsgrid-align-center\" style=\"width: 100px;\">" . $products['introduce'] . "</td>
                                            <td class=\"jsgrid-cell jsgrid-align-center\" style=\"width: 100px;\">" . $products['post_on'] . "</td>
                                            <td class=\"jsgrid-cell jsgrid-control-field jsgrid-align-center\"
                                                style=\"width: 50px;\">
                                                <a href='edit_product.php?pid={$products['product_id']}'><input class=\"jsgrid-button jsgrid-edit-button\" type=\"button\" title=\"Fix\"></a>
                                                <a href='delete_product.php?pid={$products['product_id']}'><input class=\"jsgrid-button jsgrid-delete-button\" type=\"button\" title=\"Erase\"></a>
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
                                            <a class="page-link" href="view_products.php?page=<?php echo $current_page -1; ?>">
                                                <i class="mdi mdi-chevron-left"></i>
                                            </a>
                                        </li>
                                    <?php } ?>
                                    <?php for($i=1;$i<=$total_page;$i++){ ?>
                                        <li class="page-item <?php if($page == $i) echo "active"; ?>">
                                            <a class="page-link" href="view_products.php?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                                        </li>
                                    <?php } ?>
                                    <?php
                                    if ($current_page<$total_page){?>
                                        <li class="page-item">
                                            <a class="page-link" href="view_products.php?page=<?php echo $current_page +1; ?>">
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
