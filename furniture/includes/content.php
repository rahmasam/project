
<!-- Grid Product -->
<section class="py-50">
    <div class="port-title">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 text-center">
                    <h2 class="title">OUR PRODUCTS</h2>
                    <div class="title-border mx-auto m-b-35"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="port-body">
        <div class="container">
            <div class="grid">
                <div class="grid-filter">
                    <ul class="text-center">
                        <?php
                        $active = 'active';
                        $q = "SELECT * FROM categories ORDER BY position ASC";
                        $r = mysqli_query($dbc,$q);
                        while ($cats = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
                            echo "<li class='{$active}'><span data-filter='.{$cats['cat_id']}'>{$cats['cat_name']}</span></li>";
                            $active ='';
                        }
                        echo '<li><span data-filter=\'*\'>All products</span></li>';
                        ?>
                    </ul>
                </div>
                <div class="grid-body row" data-layout="fitRows">
                    <?php
                    $q = "SELECT * FROM categories ";
                    $r = mysqli_query($dbc, $q);
                    $data = array();
                    while ($cat_id = mysqli_fetch_array($r,MYSQLI_ASSOC)){
                        $data[] = $cat_id;
                    }
                    for ($i = 0;$i<count($data);$i++){
                        $q = "SELECT * FROM products WHERE cat_id = {$data[$i]['cat_id']} ORDER BY post_on DESC ";
                        $r = mysqli_query($dbc,$q);
                        $a = mysqli_num_rows($r);
                        if ($a == 0){
                            echo "
                            <div class=\"col-lg-3 col-md-4 col-sm-6 grid-item {$data[$i]['cat_id']}\" style=\"position: absolute; left: 0px; top: 0px;\">
                            <div class=\"grid-product\">
                                <p style='width: 300px;'>There are currently no products in this category!</p>
                            </div>
                        </div>
                        ";
                        }
                        while ($rows = mysqli_fetch_array($r,MYSQLI_ASSOC)){
                            echo "
                            <div class=\"col-lg-3 col-md-4 col-sm-6 grid-item {$rows['cat_id']}\" style=\"position: absolute; left: 0px; top: 0px;\">
                            <div class=\"grid-product\">
                                <div class=\"image bg-lightblue\">
                                    <a href='product_detail.php?pid={$rows['product_id']}'>
                                        <img src='admin/uploads/products/{$rows['image']}' style='width: 100%'>";
                                if ($rows['selling_price']<$rows['product_price']){
                                    $discount = round((($rows['product_price'] - $rows['selling_price'])/$rows['product_price'])*100);
                                    echo "
                                        <span class=\"ribbons\">
                                            <span class=\"onsale ribbon\">Reduction $discount%</span>
                                        </span>
                                    ";
                                }

                               echo " </a>
                                    <div class=\"addcart\">
                                        <a href=\"cart.php?action=add&id={$rows['product_id']}\">Add to cart</a>
                                    </div>
                                </div>
                                <a href='product_detail.php?pid={$rows['product_id']}' class=\"name\">{$rows['product_name']}</a>
                                <div class=\"price\">".number_format($rows['selling_price'], 0, ',', '.')."L.E</div>
                            </div>
                        </div>
                        ";
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Grid Product -->
