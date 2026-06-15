<?php
$sql_brands = "SELECT * FROM `brands` WHERE `status` = 'T' ORDER BY `ordering`";
$result_brands = $mysqli->query($sql_brands);
$total_brands = $result_brands->num_rows;
if ($total_brands > 0) {
    $brand_array = [];
    while ($brands = $result_brands->fetch_assoc()) {
        $brand_array[] = $brands;
    }
}
$sql = "select * from `products` where `featured` = 'T' AND `status` = 'T' order by `ordering`";
$result = $mysqli->query($sql);
$total = $result->num_rows;
if ($total > 0) {
?>
    <section id="ft-service-2" class="ft-service-section-2 position-relative" style="background-image: url('img/bg/ser-bg.png');">
        <span class="ft-service-bg position-absolute">
            <!-- <img src="img/bg/ser-bg.png" alt=""> -->
        </span>
        <div class="container">
            <div class="ft-section-title-2 headline pera-content text-center">
                <span class="sub-title text-orange">
                    <?php echo _translate('sub_title_product_home') ?>
                </span>
                <h2>
                    <?php echo _translate('itle_product_home') ?>
                </h2>
            </div>
            <div class="ft-service-content-2">
                <div class="ft-service-slider-2">
                    <?php
                    while ($product = $result->fetch_assoc()) {
                        $product_brand_id = $product['brand_id'];
                    ?>
                        <div class="ft-item-innerbox wow fadeInRight" data-wow-delay="0.2s" data-wow-duration="1s">
                            <div class="ft-service-innerbox-2 position-relative">
                                <div class="ft-service-img text-center">
                                    <img src="<?php echo $_upload_folders_map['products'] . $product['image'] ?>" alt="<?php echo $product['title'] ?>">
                                </div>
                                <div class="ft-service-text position-relative headline">
                                    <div class="ft-service-icon position-absolute d-flex align-items-center justify-content-center">
                                        <?php
                                        foreach ($brand_array as $brand) {
                                            if ($brand['id'] == $product_brand_id) {
                                        ?>
                                                <img src="<?php echo $_upload_folders_map['brands'] . $brand['images'] ?>" alt="<?php echo $brand['title'] ?>">
                                        <?php }
                                        } ?>
                                    </div>
                                    <h3>
                                        <a href="<?php echo $_defines['domain'] . '/brand/' . $product['alias'] ?>">
                                            <?php echo $product['title'] ?>
                                        </a>
                                    </h3>
                                    <div class="ft-btn-2">
                                        <a href="<?php echo $_defines['domain'] . '/brand/' . $product['alias'] ?>">
                                            <i class="icon-first flaticon-right-arrow"></i>
                                            <span>
                                                <?php echo _translate('read_more_products_home') ?>
                                            </span>
                                        </a>
                                    </div>
                                </div>
                                <div class="ft-service-serial position-absolute">
                                    <?php if ($product['new'] == 'T') { ?>
                                        <img src="<?php echo $_upload_folders_map['products'] . 'new.svg' ?>" alt="New Products">
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </section>
<?php } ?>