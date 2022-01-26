<?php
session_start();
include "includes/mysqli_connect.php";
include "includes/functions.php";
include "includes/source.php";
include "includes/header.php";
?>
<?php
$pid = validate_id($_GET['pid']);
$q = "SELECT * FROM products WHERE product_id = {$pid}";
$r = mysqli_query($dbc,$q);

$product =  mysqli_fetch_array($r,MYSQLI_ASSOC);
?>
    <!-- Page Title -->
    <section>
        <div class="pageintro">
            <div class="pageintro-bg">
                <img src="style\images\bg-page_03.jpeg" alt="About Us">
            </div>
            <div class="pageintro-body">
                <h1 class="pageintro-title">Product Details</h1>
                <nav class="pageintro-breadcumb">
                    <ul>
                        <li>
                            <a href="#"><?php echo $product['product_name']; ?></a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </section>
    <!-- End Page Title -->

    <!-- Product Detail -->
    <section>
        <div class="container p-b-90 p-t-100">
            <div class="row">
                <div class="col-md-12">
                    <div class="product-detail">
                        <div class="shop-product p-t-25">
                            <div class="slide100-01" id="slide100-01">
                                <div class="main-wrap-pic">
                                    <div class="main-frame">
                                        <div class="wrap-main-pic">
                                            <div class="main-pic">
                                                <img src="admin/uploads/products/<?php echo $product['image']; ?>"  alt="image">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="product-body">
                                <h3 class="name"><?php echo $product['product_name']; ?></h3><br>
                                <?php
                                    if ($product['selling_price']<$product['product_price']){
                                        ?>
                                        <span class="price" style="text-decoration: line-through;"><?php echo number_format($product['product_price'], 0, ',', '.'); ?></span>
                                        <span class="price"> - </span>
                                    <?php } ?>
                                <span class="price"><?php echo number_format($product['selling_price'], 0, ',', '.')." L.E"; ?></span><br><br>
                                <div class="product-button">
                                    <div class="quantity">
                                        <span class="sub">
                                            <i class="fa fa-angle-down"></i>
                                        </span>
                                        <input type="number" name="quantity[<?php echo $product['product_id'] ?>]"
                                               value="1" min="1">
                                        <span class="add">
                                            <i class="fa fa-angle-up"></i>
                                        </span>
                                    </div>
                                    <a href="cart.php?action=add&id=<?php echo $product['product_id']?>" class="add-to-cart">Add to cart</a>
                                </div>
                                <div class="product-available">
                                    <span>Status :</span>
                                    <span style="color: orangered">Stocking</span>
                                </div>
                                <div class="product-categories">
                                    <span class="text-black">Category:</span>
                                    <?php
                                    $q = "SELECT * FROM categories WHERE cat_id = {$product['cat_id']}";
                                    $r = mysqli_query($dbc,$q);

                                    $cat = mysqli_fetch_array($r,MYSQLI_ASSOC);
                                    ?>
                                    <a href="category.php?cid=<?php echo $cat['cat_id']?>" style="color: orangered"><?php echo $cat['cat_name']; ?></a>
                                </div>
                            </div>
                        </div>
                        <div class="au-tabs">
                            <ul class="nav nav-tabs">
                                <li class="active">
                                    <a data-toggle="tab" href="#description-tab" class="active show">Detailed description</a>
                                </li>
                                <li>
                                    <a data-toggle="tab" href="#review-tab">Comment</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div id="description-tab" class="tab-pane active">
                                    <p><?php echo $product['introduce']; ?></p>
                                </div>
                                <div id="review-tab" class="tab-pane">
                                    <div class="fb-comments" data-href="http://localhost/furniture/product_detail.php?pid=<?php echo $product['product_id'];?>" 
                                    data-width="1170" data-numposts="5"></div>
                                </div>
                            </div>
                        </div>
                        <div class="port-title justify-content-center text-center">
                            <h2 class="title">Related Products</h2>
                            <div class="title-border mx-auto m-b-70"></div>
                        </div>
                        <div class="related-products">
                            <div class="owl-carousel row" data-responsive='{"0":{"items":"1"},"576":{"items":"1"},"768":{"items":"2"}, "992":{"items":"3"} }'>
                                <?php
                                    $q = "SELECT * FROM products WHERE cat_id = {$product['cat_id']} LIMIT 3";
                                    $r = mysqli_query($dbc,$q);
                                    while ($rows = mysqli_fetch_array($r,MYSQLI_ASSOC)) {
                                        ?>
                                        <div class="col-md-12">
                                            <div class="grid-product">
                                                <div class="image bg-lightblue">
                                                    <a href="#">
                                                        <img src="admin/uploads/products/<?php echo $rows['image']?>" style="width: 100%" alt="Chair">
                                                    </a>
                                                    <div class="addcart">
                                                        <a href="cart.php?action=add&id=<?php echo $rows['product_id']?>">Add to cart</a>
                                                    </div>
                                                </div>
                                                <a href="#" class="name"><?php echo $rows['product_name']?></a>
                                                <div class="price"><?php echo number_format($product['selling_price'], 0, ',', '.')."L.E"; ?></div>
                                            </div>
                                        </div>
                                        <?php
                                    }
                                        ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Product Detail -->

<?php
include "includes/footer.php";

?>