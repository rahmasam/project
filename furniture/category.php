<?php
session_start();
include "includes/mysqli_connect.php";
include "includes/functions.php";
include "includes/source.php";
include "includes/header.php";
?>
<?php
$cid = validate_id($_GET['cid']);


    $page=1;
    //initialization of the initial page
    $limit=10;
    //number of records per page (2 records per page)
    $arrs_list = mysqli_query($dbc,"
                select product_id from products WHERE cat_id = {$cid}
            ");
    $total_record = mysqli_num_rows($arrs_list);//Calculate the total number of records in the science table

    $total_page=ceil($total_record/$limit);//calculate the total number of pages to be divided

    //see if the page is out of bounds:
    if(isset($_GET["page"]))
        $page=$_GET["page"];//if $_GET["page"] variable exists then current page is page $_GET["page"]
    if($page<1) $page=1; //if the current page is less than 1 then assign it to 1
    if($page>$total_page) $page=$total_page;//if the current page exceeds the number of divided pages, it will be equal to the last page

    //calculate start (where the record will start getting):
    $start=($page-1)*$limit;

//products database
$q = "SELECT * FROM categories WHERE cat_id = {$cid}";
$r = mysqli_query($dbc,$q);

$cat = mysqli_fetch_array($r,MYSQLI_ASSOC);
?>
    <section>
        <div class="pageintro">
            <div class="pageintro-bg">
                <img src="style\images\bg-page_03.jpeg" alt="About Us">
            </div>
            <div class="pageintro-body">
                <h1 class="pageintro-title">Category</h1>
                <nav class="pageintro-breadcumb">
                    <ul>
                        <li>
                            <a href="category.php?cid={$rows['cat_id']}"><?php echo $cat['cat_name']?></a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </section>
    <?php
        $q = "SELECT * FROM products WHERE cat_id = {$cat['cat_id']} ORDER BY post_on ASC";
        $r = mysqli_query($dbc,$q);
        $array = array();
        while ($rows = mysqli_fetch_array($r)){
            $array[] = $rows;
        }
        $dem = count($array);
    ?>
    <section>
        <div class="container p-t-100 p-b-70">

            <?php if ($total_page>0){?>

            <div class="row">
                <div class="col-md-9">
                    <div class="shop-list">
                        <div class="shop-list-heading">
                            <div class="number-product">
                            Have everything
                                <span>
                                    <?php
                                        echo "<b>".$dem."</b>";
                                    ?>
                                </span>Products in this category <?php echo "<b>".$cat['cat_name']."</b>" ?>
                            </div>
                        </div>
                        <div class="shop-list-body">
                            <?php
                            $q = "SELECT * FROM products WHERE cat_id = {$cat['cat_id']} ORDER BY post_on DESC LIMIT $start,$limit";
                            $r = mysqli_query($dbc,$q);
                                while ($products = mysqli_fetch_array($r,MYSQLI_ASSOC)) {
                                    ?>
                                    <div class="shop-product">
                                        <div class="product-image">
                                            <a href="product_detail.php?pid=<?php echo $products['product_id'] ?>">
                                                <img src="admin/uploads/products/<?php echo $products['image']?>" style="width: 270px;height: 340px;" alt="Product 1">
                                        <?php
                                            if ($products['selling_price']<$products['product_price']){
                                                $discount = round((($products['product_price'] - $products['selling_price'])/$products['product_price'])*100);
                                                echo "
                                                    <span class=\"ribbons\">
                                                        <span class=\"onsale ribbon\">Reduction $discount%</span>
                                                    </span>
                                                ";
                                            }
                                        ?>
                                            </a>
                                        </div>
                                        <div class="product-body">
                                            <a href="product_detail.php?pid=<?php echo $products['product_id'] ?>" class="name"><?php echo $products['product_name']?></a><br><br>
                                            <?php
                                            if ($products['selling_price']<$products['product_price']){
                                                ?>
                                                <span class="price" style="text-decoration: line-through;"><?php echo number_format($products['product_price'], 0, ',', '.'); ?></span>
                                                <span class="price"> - </span>
                                            <?php } ?>
                                            <span class="price"><?php echo number_format($products['selling_price'], 0, ',', '.')." L.E"; ?></span><br>
                                            <p class="description"><?php echo $products['introduce']?></p>
                                            <div class="product-button">
                                                <a href="cart.php?action=add&id=<?php echo $products['product_id']?>" class="add-to-cart">Add to cart</a>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                }
                            ?>
                        </div>
                        <nav class="border-bottom-1 border-top-1">
                            <ul class="au-panigation">
                                <?php
                                $current_page = ($start/$limit) + 1;
                                if ($page>1){?>
                                    <li class="panigation-item">
                                        <a href="category.php?cid=<?php echo $cid; ?>&&page=<?php echo $current_page -1; ?>" class="panigation-link">
                                            <i class="fa fa-angle-left"></i>
                                        </a>
                                    </li>
                                <?php } ?>
                                <li class="panigation-item">
                                    <span>Trang:</span>
                                </li>
                                <?php for($i=1;$i<=$total_page;$i++){ ?>
                                    <li class="panigation-item <?php if($page == $i) echo "active"; ?>">
                                        <a href="category.php?cid=<?php echo $cid; ?>&&page=<?php echo $i; ?>" class="panigation-link"><?php echo $i; ?></a>
                                    </li>
                                <?php } ?>
                                <?php
                                if ($current_page<$total_page){?>
                                    <li class="panigation-item" >
                                        <a href="category.php?cid=<?php echo $cid; ?>&&page=<?php echo $current_page +1; ?>" class="panigation-link">
                                            <i class="fa fa-angle-right"></i>
                                        </a>
                                    </li>
                                <?php } ?>
                            </ul>
                        </nav>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="col-md-3">
                    <div class="page-sidebar">

                        <div class="page-sidebar-item">
                            <div class="sidebar-item__heading">
                                <h3 class="title">Category</h3>
                                <div class="title-border m-b-24"></div>
                            </div>
                            <div class="sidebar-item__body">
                                <ul class="sidebar-list">
                                    <?php
                                    $q ="SELECT * FROM categories ORDER BY position ASC";
                                    $r = mysqli_query($dbc,$q);
                                    while ($cats = mysqli_fetch_array($r,MYSQLI_ASSOC)){
                                    ?>
                                    <li>
                                        <a href="category.php?cid=<?php echo $cats['cat_id']?>"><?php echo $cats['cat_name']?></a>
                                        <span class="number">
                                            <?php
                                            $q1 ="SELECT * FROM products WHERE cat_id = {$cats['cat_id']}";
                                            $r1 = mysqli_query($dbc,$q1);
                                            $mang = array();
                                            while ($product_total = mysqli_fetch_array($r1)){
                                                $mang[] = $product_total;
                                            }
                                            echo count($mang);
                                            ?>
                                        </span>
                                    </li>
                                        <?php } ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Sidebar -->
            </div>
            <?php }else{
                echo "No products in this category!<br>";
                echo "<a href='index.php'>go back to the main page</a>";
            }?>
        </div>
    </section>
<?php
include "includes/footer.php";

?>