<?php
include "check_login.php";
$account = $_SESSION['user_account'];
$permission = 'delete_role';
$permission1 = 'edit_role';
$permission2 = 'add_role';

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


$page = 1;
$limit = 10;
$arrs_list = mysqli_query($dbc, "
                    select role_id from roles 
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
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title" style="text-align: center;font-size: 30px;">List of positions</h4>
                        <p>total<b><?php echo $total_record;?></b> position</p><br>
                        <div id="js-grid" class="jsgrid" style="position: relative; height: 500px; width: 100%;">
                            <div class="jsgrid-grid-header jsgrid-header-scrollbar">
                                <table class="jsgrid-table">
                                    <tr class="jsgrid-header-row">
                                        <th class="jsgrid-header-cell jsgrid-align-center jsgrid-header-sortable" style="width: 30px;">
                                            #
                                        </th>
                                        <th class="jsgrid-header-cell jsgrid-align-center jsgrid-header-sortable"
                                            style="width: 120px;">
                                            position
                                        </th>
                                        <th class="jsgrid-header-cell jsgrid-align-center jsgrid-header-sortable" style="width: 150px;">
                                        Decentralization
                                        </th>

                                        <th class="jsgrid-header-cell jsgrid-control-field jsgrid-align-center"
                                            style="width: 50px;">
                                            <?php
                                            if (has_permission($account,$permission2)){
                                                echo "<a href=\"add_role.php\"><input class=\"jsgrid-button jsgrid-mode-button jsgrid-insert-mode-button\" type=\"button\" title=\"Add position\"></a>";
                                            }
                                            ?>
                                        </th>
                                    </tr>
                                </table>
                            </div>
                            <div class="jsgrid-grid-body" style="height: 307.625px;">

                                <table class="jsgrid-table">
                                    <tbody>
                                    <?php
                                    $q1 = "SELECT * FROM roles ORDER BY role_id ASC ";
                                    $r1 = mysqli_query($dbc, $q1);
                                    confirm_query($r1, $q1);
                                    $stt=0;
                                    while ($role = mysqli_fetch_array($r1, MYSQLI_ASSOC)) {

                                        $stt+=1;
                                        echo "
                                        <tr class=\"jsgrid-row\">
                                            <td class=\"jsgrid-cell jsgrid-align-center\" style=\"width: 30px;\">".$stt."</td>
                                            <td class=\"jsgrid-cell jsgrid-align-center\" style=\"width: 120px;\">".$role['role']."</td>
                                            <td class=\"jsgrid-cell jsgrid-align-center\" style=\"width: 150px;\">".$role['permission']."</td>
                                            <td class=\"jsgrid-cell jsgrid-control-field jsgrid-align-center\"
                                                style=\"width: 50px;\">";
                                        if (has_permission($account,$permission1)){
                                            echo "<a href='edit_role.php?rid={$role['role_id']}'><input class='jsgrid-button jsgrid-edit-button' type='button' title='Cancel'></a>";
                                        }
                                        if (has_permission($account,$permission)){
                                            if ($role['role'] != 'User'){
                                                echo "<a href='delete_role.php?rid={$role['role_id']}'><input class='jsgrid-button jsgrid-delete-button' type='button' title='Erase'></a>";
                                            }
                                        }


                                                echo "
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
                                            <a class="page-link" href="view_slides.php?page=<?php echo $current_page -1; ?>">
                                                <i class="mdi mdi-chevron-left"></i>
                                            </a>
                                        </li>
                                    <?php } ?>
                                    <?php for($i=1;$i<=$total_page;$i++){ ?>
                                        <li class="page-item <?php if($page == $i) echo "active"; ?>">
                                            <a class="page-link" href="view_slides.php?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                                        </li>
                                    <?php } ?>
                                    <?php
                                    if ($current_page<$total_page){?>
                                        <li class="page-item">
                                            <a class="page-link" href="view_slides.php?page=<?php echo $current_page +1; ?>">
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
