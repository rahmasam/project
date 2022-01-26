<?php
session_start();
include "includes/mysqli_connect.php";
include "includes/source.php";

if(isset($_GET['action']) && $_GET['action']=="add"){

    $id=intval($_GET['id']);

    if(isset($_SESSION['cart'][$id])){

        $_SESSION['cart'][$id]['quantity']++;

    }else{

        $q ="SELECT * FROM products 
                WHERE product_id ={$id}";
        $r=mysqli_query($dbc,$q);
        if(mysqli_num_rows($r)!=0){
            $rows=mysqli_fetch_array($r);

            $_SESSION['cart'][$rows['product_id']]=array(
                "quantity" => 1,
                "price" => $rows['selling_price']
            );
        }

    }
}
include "includes/header.php";




if (isset($_POST['submit'])) {

    foreach ($_POST['quantity'] as $key => $val) {
        if ($val == 0) {
            unset($_SESSION['cart'][$key]);
        } else {
            $_SESSION['cart'][$key]['quantity'] = $val;
        }
    }

}


?>

    <!-- Page Title -->
    <section>
        <div class="pageintro">
            <div class="pageintro-bg">
                <img src="style\images\bg-page_02.jpeg" alt="About Us">
            </div>
            <div class="pageintro-body">
                <h1 class="pageintro-title">Your cart</h1>
                
            </div>
        </div>
    </section>
    <!-- End Page Title -->
    <!-- Table -->
    <section>
        <div class="container p-t-100 p-b-30 py-tn-30">
            <div class="row m-t-20">
                <div class="col-md-12">
                    <?php
                    if (!empty($_SESSION['cart'])) {
                        ?>
                        <form action="" method="post">
                            <table class="table-shop">
                                <thead>
                                <tr>
                                    <th>Product's name</th>
                                    <th>Price</th>
                                    <th>Quantily</th>
                                    <th>into money</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php

                                $q = "SELECT * FROM products WHERE product_id IN (";

                                foreach ($_SESSION['cart'] as $id => $value) {
                                    $q .= $id . ",";
                                }

                                $q = substr($q, 0, -1) . ") ORDER BY product_name ASC";
                                $query = mysqli_query($dbc, $q);
                                $totalprice = 0;
                                while ($rows = mysqli_fetch_array($query)) {
                                    $subtotal = $_SESSION['cart'][$rows['product_id']]['quantity'] * $rows['selling_price'];
                                    $totalprice += $subtotal;
                                    ?>
                                    <tr>
                                        <td>
                                            <div class="table-shop-product">
                                                <div class="image">
                                                    <img src="admin/uploads/products/<?php echo $rows['image']; ?>"
                                                         style="width: 102px;height: 105px;">
                                                </div>
                                                <div class="name"><?php echo $rows['product_name']; ?></div>
                                            </div>
                                        </td>
                                        <td>
                                            <?php echo number_format($rows['selling_price'], 0, ',', '.') . " L.E" ?>
                                        </td>
                                        <td>
                                            <div class="quantity">
                                        <span class="sub">
                                            <i class="fa fa-angle-down"></i>
                                        </span>
                                                <input type="number" name="quantity[<?php echo $rows['product_id'] ?>]"
                                                       value="<?php echo $_SESSION['cart'][$rows['product_id']]['quantity'] ?>" >
                                                <span class="add">
                                            <i class="fa fa-angle-up"></i>
                                        </span>
                                            </div>
                                        </td>
                                        <td>
                                            <?php
                                            $Thanhtien = $_SESSION['cart'][$rows['product_id']]['quantity'] * $rows['selling_price'];
                                            echo number_format($Thanhtien, 0, ',', '.') . "L.E";
                                            ?>
                                        </td>
                                        <td>
                                            <a href="includes/remove_item.php?page=cart&id=<?php echo $rows['product_id']; ?>">
                                                <img src="style\images\icon\close.png" alt="Close">
                                            </a>
                                        </td>
                                    </tr>
                                    <?php

                                }
                                ?>
                                <tr>
                                    <td colspan="5">
                                        <div class="table-shop-product">
                                            <div class="name" style="margin: auto;color: orangered">Total money
                                                : <?php echo number_format($totalprice, 0, ',', '.') . " L.E"; ?></div>
                                        </div>
                                    </td>
                                </tr>
                                </tbody>
                                <tfoot>
                                <tr>
                                    <td colspan="5">
                                        <div class="table-button">
                                            <a href="index.php">Continue shopping</a>
                                            <button type="submit" name="submit" style="cursor: pointer">Update cart
                                            </button>
                                            <a href="checkout.php">Payment</a>
                                        </div>
                                    </td>
                                </tr>
                                </tfoot>
                            </table>
                        </form>
                        <?php
                    }else{
                        echo "There are no products in the cart!<br>";
                        echo "<a href='index.php'>go back to the main page</a>";
                    }
                        ?>
                </div>
            </div>
        </div>
    </section>
    <!-- End Table -->
<?php
include "includes/footer.php";

?>