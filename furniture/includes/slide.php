
<!-- Slider -->
<section>
    <div class="slideshow-container">
        <?php
        $q ="SELECT * FROM slides ORDER BY post_on LIMIT 3";
        $r = mysqli_query($dbc,$q);

        while ($rows = mysqli_fetch_array($r,MYSQLI_ASSOC)){
            echo "<div class='mySlides' style='display: block;'>
                    <img src='admin/uploads/slides/{$rows['slide_image']}' width='100%' height='95%'  >
                </div>
                    ";
        }
        ?>
    </div><br>
    <!--.dot-->
    <div style="text-align:center">
        <span class="dot"></span>
        <span class="dot"></span>
        <span class="dot"></span>
    </div>
</section>
<!-- End Slider -->
