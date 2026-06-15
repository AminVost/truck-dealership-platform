<?php
$product = $page_data;
$images = explode(',', $product['images']);
$related_ids = explode(',', $product['related_product_ids']);

// print_r($images);die;
?>
<section id="ft-project-details" class="ft-project-details-section page-padding">
    <div class="container">
        <div class="ft-project-overview">
            <div class="row">
                <div class="col-lg-8">
                    <div class="ft-project-details-img">
                        <a href="<?php echo $_upload_folders_map['products'] . $product['image'] ?>" data-fancybox rel="detail">
                            <img src="<?php echo $_upload_folders_map['products'] . $product['image'] ?>" alt="<?php echo $product['title'] ?>">
                        </a>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="ft-portfolio-overview-text headline">
                        <div class="project-title-overview text-center">
                            <h3>
                                <?php echo $product['brief'] ?>
                            </h3>
                        </div>
                        <div class="ft-portfolio-overview-list-value">
                            <div class="ft-portfolio-overview-list  ul-li-block">
                                <ul class="information-details-ul">
                                    <li>
                                        <?php echo _translate('product_name') ?>
                                        <span>
                                            <?php echo $product['title'] ?>
                                        </span>
                                    </li>
                                    <li>
                                        <?php echo _translate('product_mileage') ?>
                                        <span>
                                            <?php echo $product['mileage'] ?>
                                        </span>
                                    </li>
                                    <li>
                                        <?php echo _translate('product_production_year') ?>
                                        <span>
                                            <?php echo $product['production_year'] ?>
                                        </span>
                                    </li>
                                    <li>
                                        <?php echo _translate('product_price') ?>
                                        <span>
                                            <a href="tel:<?php echo $_config['contact_mobile'] ?>">
                                                <?php echo _translate('contact_us_price') ?>
                                            </a>
                                        </span>
                                    </li>
                                </ul>
                            </div>
                            <div class="ft-project-value ul-li">
                                <form class="makeorder mt-40 text-center" method="POST" action="<?php echo $_defines['domain'] ?>/contact">
                                    <input type="submit" class="order-product" value="<?php echo _translate('make_order') ?>" class="button"></input>
                                    <input type="hidden" name="product_id" value="<?php echo $product['id'] ?>"></input>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12">
                        <div class="ft-section-title headline pera-content text-center mt-4 mb-4">
                            <span class="sub-title">
                                <?php echo _translate('title_product_gallery') ?>
                            </span>
                        </div>
                        <div class="ft-footer-widget ft-gallery-widget ul-li-block headline pera-content">
                            <div class="gallery-widget clearfix">
                                <ul class="product-gallery">
                                    <?php foreach ($images as $image_brand_gallery) { ?>
                                        <li>
                                            <a href="<?php echo $_upload_folders_map['products'] . $image_brand_gallery ?>" data-fancybox="brand-details-gallery">
                                                <img src="<?php echo $_upload_folders_map['products'] . $image_brand_gallery ?>" class="images-gallery-product" alt="<?php echo $product['title'] ?>">
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
        <div class="ft-project-overview-text-wrapper headline pera-content">
            <h3>
                <?php echo $product['title'] ?>
            </h3>
            <p class="text-justify">
                <?php echo $product['text'] ?>
            </p>
            <div class="ft-section-title headline pera-content text-center mt-5">
                <span class="sub-title">
                    <?php echo _translate('title_product_features') ?>
                </span>
            </div>
            <div class="ft-project-overview-comment-list col-10">
                <div class="row">
                    <div class="col-lg-3 col-3 col-sm-4 wow fadeInUp product-feature" data-wow-delay="200ms" data-wow-duration="1500ms" style="visibility: visible; animation-duration: 1500ms; animation-delay: 200ms; animation-name: fadeInUp;">
                        <div class="ft-why-choose-feature-list-item-2">
                            <div class="ft-why-choose-feature-icon">
                                <i class="fal fa-clipboard-list-check"></i>
                            </div>
                            <div class="ft-why-choose-feature-text headline pera-content">
                                <h3>
                                    <?php echo _translate('insurance') ?>
                                </h3>
                                <p>
                                    <?php echo $product['insurance'] ?>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-3 col-sm-4 wow fadeInUp product-feature" data-wow-delay="200ms" data-wow-duration="1500ms" style="visibility: visible; animation-duration: 1500ms; animation-delay: 200ms; animation-name: fadeInUp;">
                        <div class="ft-why-choose-feature-list-item-2">
                            <div class="ft-why-choose-feature-icon">
                                <i class="fal fa-clipboard-list-check"></i>
                            </div>
                            <div class="ft-why-choose-feature-text headline pera-content">
                                <h3>
                                    <?php echo _translate('production_year') ?>
                                </h3>
                                <p>
                                    <?php echo $product['production_year'] ?>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-3 col-sm-4 wow fadeInUp product-feature" data-wow-delay="200ms" data-wow-duration="1500ms" style="visibility: visible; animation-duration: 1500ms; animation-delay: 200ms; animation-name: fadeInUp;">
                        <div class="ft-why-choose-feature-list-item-2">
                            <div class="ft-why-choose-feature-icon">
                                <i class="fal fa-clipboard-list-check"></i>
                            </div>
                            <div class="ft-why-choose-feature-text headline pera-content">
                                <h3>
                                    <?php echo _translate('cabin_bed') ?>
                                </h3>
                                <p>
                                    <?php echo $product['cabin_bed'] ?>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-3 col-sm-4 wow fadeInUp product-feature" data-wow-delay="200ms" data-wow-duration="1500ms" style="visibility: visible; animation-duration: 1500ms; animation-delay: 200ms; animation-name: fadeInUp;">
                        <div class="ft-why-choose-feature-list-item-2">
                            <div class="ft-why-choose-feature-icon">
                                <i class="fal fa-clipboard-list-check"></i>
                            </div>
                            <div class="ft-why-choose-feature-text headline pera-content">
                                <h3>
                                    <?php echo _translate('company_guarantee') ?>
                                </h3>
                                <?php if ($product['company_guarantee'] == 'T') { ?>
                                    <p>
                                        <?php echo _translate('yes_feature') ?>
                                    </p>
                                <?php } else { ?>
                                    <p>
                                        <?php echo _translate('no_feature') ?>
                                    </p>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-3 col-sm-4 wow fadeInUp product-feature" data-wow-delay="200ms" data-wow-duration="1500ms" style="visibility: visible; animation-duration: 1500ms; animation-delay: 200ms; animation-name: fadeInUp;">
                        <div class="ft-why-choose-feature-list-item-2">
                            <div class="ft-why-choose-feature-icon">
                                <i class="fal fa-clipboard-list-check"></i>
                            </div>
                            <div class="ft-why-choose-feature-text headline pera-content">
                                <h3>
                                    <?php echo _translate('body_color') ?>
                                </h3>
                                <p>
                                    <?php echo $product['body_color'] ?>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-3 col-sm-4 wow fadeInUp product-feature" data-wow-delay="200ms" data-wow-duration="1500ms" style="visibility: visible; animation-duration: 1500ms; animation-delay: 200ms; animation-name: fadeInUp;">
                        <div class="ft-why-choose-feature-list-item-2">
                            <div class="ft-why-choose-feature-icon">
                                <i class="fal fa-clipboard-list-check"></i>
                            </div>
                            <div class="ft-why-choose-feature-text headline pera-content">
                                <h3>
                                    <?php echo _translate('color_inside') ?>
                                </h3>
                                <p>
                                    <?php echo $product['color_inside'] ?>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-3 col-sm-4 wow fadeInUp product-feature" data-wow-delay="200ms" data-wow-duration="1500ms" style="visibility: visible; animation-duration: 1500ms; animation-delay: 200ms; animation-name: fadeInUp;">
                        <div class="ft-why-choose-feature-list-item-2">
                            <div class="ft-why-choose-feature-icon">
                                <i class="fal fa-clipboard-list-check"></i>
                            </div>
                            <div class="ft-why-choose-feature-text headline pera-content">
                                <h3>
                                    <?php echo _translate('mileage') ?>
                                </h3>
                                <p>
                                    <?php echo $product['mileage'] ?>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-3 col-sm-4 wow fadeInUp product-feature" data-wow-delay="200ms" data-wow-duration="1500ms" style="visibility: visible; animation-duration: 1500ms; animation-delay: 200ms; animation-name: fadeInUp;">
                        <div class="ft-why-choose-feature-list-item-2">
                            <div class="ft-why-choose-feature-icon">
                                <i class="fal fa-clipboard-list-check"></i>
                            </div>
                            <div class="ft-why-choose-feature-text headline pera-content">
                                <h3>
                                    <?php echo _translate('gearbox') ?>
                                </h3>
                                <p>
                                    <?php echo $product['gearbox'] ?>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-3 col-sm-4 wow fadeInUp product-feature" data-wow-delay="200ms" data-wow-duration="1500ms" style="visibility: visible; animation-duration: 1500ms; animation-delay: 200ms; animation-name: fadeInUp;">
                        <div class="ft-why-choose-feature-list-item-2">
                            <div class="ft-why-choose-feature-icon">
                                <i class="fal fa-clipboard-list-check"></i>
                            </div>
                            <div class="ft-why-choose-feature-text headline pera-content">
                                <h3>
                                    <?php echo _translate('capacity') ?>
                                </h3>
                                <p>
                                    <?php echo $product['capacity'] ?>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-3 col-sm-4 wow fadeInUp product-feature" data-wow-delay="200ms" data-wow-duration="1500ms" style="visibility: visible; animation-duration: 1500ms; animation-delay: 200ms; animation-name: fadeInUp;">
                        <div class="ft-why-choose-feature-list-item-2">
                            <div class="ft-why-choose-feature-icon">
                                <i class="fal fa-clipboard-list-check"></i>
                            </div>
                            <div class="ft-why-choose-feature-text headline pera-content">
                                <h3>
                                    <?php echo _translate('document_status') ?>
                                </h3>
                                <p>
                                    <?php echo $product['document_status'] ?>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-3 col-sm-4 wow fadeInUp product-feature" data-wow-delay="200ms" data-wow-duration="1500ms" style="visibility: visible; animation-duration: 1500ms; animation-delay: 200ms; animation-name: fadeInUp;">
                        <div class="ft-why-choose-feature-list-item-2">
                            <div class="ft-why-choose-feature-icon">
                                <i class="fal fa-clipboard-list-check"></i>
                            </div>
                            <div class="ft-why-choose-feature-text headline pera-content">
                                <h3>
                                    <?php echo _translate('technical_diagnosis') ?>
                                </h3>
                                <?php if ($product['technical_diagnosis'] == 'T') { ?>
                                    <p>
                                        <?php echo _translate('yes_feature') ?>
                                    </p>
                                <?php } else { ?>
                                    <p>
                                        <?php echo _translate('no_feature') ?>
                                    </p>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-3 col-sm-4 wow fadeInUp product-feature" data-wow-delay="200ms" data-wow-duration="1500ms" style="visibility: visible; animation-duration: 1500ms; animation-delay: 200ms; animation-name: fadeInUp;">
                        <div class="ft-why-choose-feature-list-item-2">
                            <div class="ft-why-choose-feature-icon">
                                <i class="fal fa-clipboard-list-check"></i>
                            </div>
                            <div class="ft-why-choose-feature-text headline pera-content">
                                <h3>
                                    <?php echo _translate('tax') ?>
                                </h3>
                                
                                <?php if ($product['tax'] == 'T') { ?>
                                    <p>
                                        <?php echo _translate('yes_feature') ?>
                                    </p>
                                <?php } else { ?>
                                    <p>
                                        <?php echo _translate('no_feature') ?>
                                    </p>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-3 col-sm-4 wow fadeInUp product-feature" data-wow-delay="200ms" data-wow-duration="1500ms" style="visibility: visible; animation-duration: 1500ms; animation-delay: 200ms; animation-name: fadeInUp;">
                        <div class="ft-why-choose-feature-list-item-2">
                            <div class="ft-why-choose-feature-icon">
                                <i class="fal fa-clipboard-list-check"></i>
                            </div>
                            <div class="ft-why-choose-feature-text headline pera-content">
                                <h3>
                                    <?php echo _translate('job_tax') ?>
                                </h3>
                                <?php if ($product['job_tax'] == 'T') { ?>
                                    <p>
                                        <?php echo _translate('yes_feature') ?>
                                    </p>
                                <?php } else { ?>
                                    <p>
                                        <?php echo _translate('no_feature') ?>
                                    </p>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-3 col-sm-4 wow fadeInUp product-feature" data-wow-delay="200ms" data-wow-duration="1500ms" style="visibility: visible; animation-duration: 1500ms; animation-delay: 200ms; animation-name: fadeInUp;">
                        <div class="ft-why-choose-feature-list-item-2">
                            <div class="ft-why-choose-feature-icon">
                                <i class="fal fa-clipboard-list-check"></i>
                            </div>
                            <div class="ft-why-choose-feature-text headline pera-content">
                                <h3>
                                    <?php echo _translate('fuel_card') ?>
                                </h3>
                                <?php if ($product['fuel_card'] == 'T') { ?>
                                    <p>
                                        <?php echo _translate('yes_feature') ?>
                                    </p>
                                <?php } else { ?>
                                    <p>
                                        <?php echo _translate('no_feature') ?>
                                    </p>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>
<section id="ft-similar-work" class="ft-similar-work-section">
    <div class="container">
        <div class="ft-similar-work-content headline">
            <h2>
                <?php echo _translate('related_product_title') ?>
            </h2>
            <div class="ft-similar-work-items">
                <div class="row">
                    <div class="related-products">
                        <?php foreach ($related_ids as $related_id) {
                            $sql_related = "select * from `products` where `id` = '$related_id' AND `status` = 'T' order by `ordering`";
                            // print_r($sql_blogs);die;
                            $result_related = $mysqli->query($sql_related);
                            $total_related = $result_related->num_rows;
                            if ($total_related > 0) {
                                while ($related_related = $result_related->fetch_assoc()) {
                        ?>
                                    <div class="col-lg-4 col-sm-6 filtr-item" dir="rtl">
                                        <div class="ft-portfolio-slider-innerbox information-product position-relative">
                                            <div class="ft-portfolio-img">
                                                <img src="<?php echo $_upload_folders_map['products'] . $product['image'] ?>" alt="">
                                            </div>
                                            <div class="ft-portfolio-text headline headline pera-content">
                                                <h3>
                                                    <a href="project-single.html">
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
                        <?php  }
                            }
                        }  ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>