<?php
if ($_block['status'] == 'T') {
    $_block_link    = _menu($_block['button_page_id'], $_block['button_module_id'], $_block['button_service_id'] , $_block['button_brand_id'], $_block['button_url']);
?>
    <section id="ft-about-3" class="ft-about-section-3">
        <div class="container">
            <div class="ft-about-content-3">
                <div class="row">
                    <div class="col-lg-6 wow fadeInLeft" data-wow-delay="0ms" data-wow-duration="1500ms">
                        <div class="ft-about-img-wrapper-3 position-relative">
                            <div class="ft-about-img-3">
                                <img src="<?php echo $_upload_folders_map['blocks'] . $_block['image'] ?>" alt="<?php echo $_block['title'] ?>">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="ft-about-text-3">
                            <div class="ft-section-title-3 headline wow fadeInUp" data-wow-delay="0ms" data-wow-duration="1500ms">
                                <span class="text-uppercase">
                                    <?php echo $_block['sub_title'] ?>
                                </span>
                                <h2>
                                    <?php echo $_block['title'] ?>
                                </h2>
                            </div>
                            <div class="ft-about-sub-text wow fadeInUp" data-wow-delay="200ms" data-wow-duration="1500ms">
                                <?php echo $_block['text'] ?>
                            </div>
                            <div class="ft-about-feature-3 wow fadeInUp" data-wow-delay="400ms" data-wow-duration="1500ms">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="ft-about-feature-text">
                                            <?php echo _translate('about_home_col1') ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="ft-about-btn-group text-uppercase d-flex wow fadeInUp" data-wow-delay="600ms" data-wow-duration="1500ms">
                                <?php if ($_block['button_text']) { ?>
                                    <a class="d-flex justify-content-center align-items-center" href="<?php echo $_block_link['link'] ?>">
                                        <i class="fas fa-arrow-left"></i>
                                        <?php echo $_block['button_text'] ?>
                                    </a>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php } ?>