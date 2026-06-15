<?php if ($total) { ?>
    <section id="ft-project-page" class="ft-project-page-section page-padding wow fadeInUp" data-wow-delay="0.3ms" data-wow-duration="2000ms" dir="ltr">
        <div class="container">
            <div class="ft-section-title-2 headline pera-content text-center">
                <span class="sub-title">
                    <?php echo _translate('brand_products_subtitle') ?>
                </span>
                <h2>
                    <?php echo $page_data['title'] ?>
                </h2>
            </div>
            <div class="ft-project-post-item-content">
                <div class="ft-project-item-filter-btn ul-li">
                    <ul id="filters" class="nav-gallery text-center">
                        <li class="filtr-button filtr-active" data-filter="all">
                            <?php echo _translate('all_products_filter') ?>
                        </li>
                        <?php
                        $sql_cat = "select * from `products_categories` where `status` = 'T' order by `ordering`";
                        $result_cat = $mysqli->query($sql_cat);
                        $total_cat = $result_cat->num_rows;
                        if ($total_cat > 0) {
                            while ($item = $result_cat->fetch_assoc()) {
                        ?>
                                <li class="filtr-button" data-filter="<?php echo $item['id'] ?>">
                                    <?php echo $item['title'] ?>
                                </li>
                        <?php  }
                        } ?>
                    </ul>
                </div>
                <div class="ft-project-item-wrapper filtr-container row">

                    <?php
                    // print_r($result);die;
                    while ($product = $result->fetch_assoc()) { ?>
                        <div class="col-lg-4 col-sm-6 filtr-item" data-category="<?php echo $product['category_id'] ?>" data-sort="Busy streets" dir="rtl">
                            <div class="ft-portfolio-slider-innerbox information-product position-relative">
                                <?php if ($product['new'] == 'T') { ?>
                                    <img class="new-icon" src="<?php echo $_upload_folders_map['products'] . 'new.svg' ?>" alt="New Products">
                                <?php } ?>
                                <div class="ft-portfolio-img">
                                    <img src="<?php echo $_upload_folders_map['products'] . $product['image'] ?>" alt="<?php echo $product['title'] ?>">
                                </div>
                                <div class="ft-portfolio-text headline headline pera-content">
                                    <h3>
                                        <a href="<?php echo $_defines['domain'] . '/brand/' . $product['alias'] ?>">
                                            <?php echo $product['title'] ?>
                                        </a>
                                    </h3>
                                    <p>
                                        <?php echo $product['brief'] ?>
                                    </p>
                                    <div class="ft-btn-3">
                                        <a class="d-flex justify-content-center align-items-center" href="<?php echo $_defines['domain'] . '/brand/' . $product['alias'] ?>">
                                            <?php echo _translate('button_product_detailss') ?>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </section>
<?php } ?>