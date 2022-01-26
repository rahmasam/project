<?php
//session_start();
include "check_login.php";
include "admin_header.php";
include "admin_navbar.php";
include "admin_partial.php";
include "admin_sidebar.php";
include('../includes/mysqli_connect.php');
include('../includes/functions.php');
$code = validate_id($_GET['code']);

$q = "SELECT * FROM transactions WHERE transaction_code = {$code}";
$r = mysqli_query($dbc,$q);

$detail = mysqli_fetch_array($r,MYSQLI_ASSOC);
?>

<div class="main-panel">
    <div class="content-wrapper">
        <div class="row grid-margin">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Invoice Details</h4>
                        <p class="card-description">
                        Customer's first and last name : <b><?php echo $detail['customer_name']?></b>
                        </p>
                        <p class="card-description">
                        Phone number : <b><?php echo $detail['customer_phone']?></b>
                        </p>
                        <p class="card-description">
                        Email address : <b><?php echo $detail['customer_email']?></b>
                        </p>
                        <p class="card-description">
                        Delivery address : <b><?php echo $detail['customer_address']?></b>
                        </p>

                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Quantily</th>
                                    <th>into money</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $q1 = "SELECT * FROM transactions WHERE transaction_code = {$code}";
                                $r1 = mysqli_query($dbc,$q1);
                                $total = 0;
                                while ($rows = mysqli_fetch_array($r1,MYSQLI_ASSOC)){
                                ?>
                                <tr>
                                    <td><?php echo $rows['product']; ?></td>
                                    <td><?php echo $rows['quantity']; ?></td>
                                    <td><?php echo number_format($rows['subtotal'], 0, ',', '.')." L.E"; ?></td>
                                </tr>
                                <?php
                                $total +=$rows['subtotal'];
                                }
                                $total +=30000;
                                ?>
                                <tr>
                                    <td>Delivery charges </td>
                                    <td>1</td>
                                    <td>30.000 L.E</td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <th>Total money :  <?php echo number_format($total, 0, ',', '.')." LE"; ?></th>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-body">
                    <button type="button" class="btn btn-info btn-icon-text">
                        <a href="action/print.php?code=<?php echo $code;?>" style="color:white;">Print Invoice</a>
                        <i class="mdi mdi-printer btn-icon-append"></i>
                    </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- content-wrapper ends -->
</div>
<?php include "admin_end.php" ?>;
