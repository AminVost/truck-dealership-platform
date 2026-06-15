<footer id="ft-footer-3" class="ft-footer-section-3" data-background="<?php echo $_upload_folders_map['config'] . $_config['footer_image'] ?>">
    <div class="ft-newslatter-section-3">
        <div class="container">
            <div class="ft-newslatter-content-3 d-flex justify-content-between align-items-center">
                <div class="ft-newslatter-text headline">
                    <h3>

                        <?php echo _translate('top_footer_title') ?>
                    </h3>
                    <span>

                        <?php echo _translate('top_footer_subtitle') ?>
                    </span>
                </div>
                <div class="ft-newslatter-btn position-relative">
                    <?php if ($_defines['page'] == 'home') { ?>
                        <div class="ft-header-cta-btn">
                            <a class="d-flex align-items-center justify-content-center text-uppercase" href="#soal" data-menuanchor="soal">
                                <?php echo _translate('service_request_buttun') ?>
                            </a>
                        </div>
                    <?php } else { ?>
                        <div class="ft-header-cta-btn">
                            <a class="d-flex align-items-center justify-content-center text-uppercase" type="button" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                <?php echo _translate('service_request_buttun') ?>
                            </a>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
    <div class="ft-footer-widget-wrapper-3">
        <div class="container">
            <div class="ft-footer-content-wrap-3">
                <div class="row">
                    <div class="col-lg-4 col-md-6">
                        <div class="ft-footer-widget">
                            <div class="ft-footer-logo-widget headline pera-content">
                                <div class="ft-footer-logo">
                                    <a href="<?php echo $_defines['domain'] ?>">
                                        <img src="<?php echo $_upload_folders_map['config'] . $_config['site_logo'] ?>" alt="<?php echo $_config['site_title']  ?>">
                                </div>
                                <p>
                                    <?php echo $_config['footer_text'] ?>
                                </p>
                                </a>
                                <div class="container-socials-footer">
                                    <?php foreach ($social_array as $social) { ?>
                                        <a href="<?php echo $social['link'] ?>" class="icon-button-footer" target="_blank">
                                            <i class="<?php echo $social['icon'] ?>"></i>
                                            <span></span>
                                        </a>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5 col-md-6">
                        <div class="ft-footer-widget">
                            <div class="ft-footer-newslatter-widget pera-content headline">
                                <div class="ft-footer-info-widget ul-li ">
                                    <h3 class="widget-title"> <?php echo _translate('contact_info_footer') ?> </h3>
                                    <ul>
                                        <li>
                                            <i class="fas fa-map-marker-alt"></i>
                                            <a href="">
                                                <?php echo $_config['contact_address'] ?>
                                            </a>
                                        </li>
                                        <li>
                                            <i class="fas fa-phone"></i><a href="tel:09121061110"><?php echo $_config['contact_mobile'] ?></a>
                                        </li>
                                    </ul>
                                    <div class="office-open-hour">
                                        <span><?php echo _translate('contact_working_days_footer') ?></span>
                                        <p>
                                            <?php echo $_config['contact_working_days'] ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php
                    $sql_footer = "select * from `gallery` where `featured` = 'T' AND `status` = 'T' order by `ordering` DESC LIMIT 0,4";
                    $result_footer = $mysqli->query($sql_footer);
                    $total_footer = $result_footer->num_rows;
                    if ($total_footer > 0) {
                    ?>
                        <div class="col-lg-3 col-md-6">
                            <div class="ft-footer-widget ul-li-block headline pera-content mb-2">
                                <div class="gallery-widget clearfix">
                                    <h3 class="widget-title"><?php echo _translate('galley_footer_title') ?> </h3>
                                    <ul class="footer-gallery">
                                        <?php while ($footer_image = $result_footer->fetch_assoc()) { ?>
                                            <li class="col-5">
                                                <a href="<?php echo $_upload_folders_map['gallery'] . $footer_image['image'] ?>" data-fancybox="footer-gallery">
                                                    <img src="<?php echo $_upload_folders_map['gallery'] . $footer_image['image'] ?>" alt="<?php echo $footer_image['title'] ?>">
                                                </a>
                                            </li>
                                        <?php } ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
            <div class="ft-footer-copyright text-center">
                <span><?php echo $_config['copyright_text'] . date("y") ?> طراحی و برنامه نویسی <a href="https://webnevisan.com">وب نویسان</a></span>
            </div>
        </div>
    </div>
    </div>
</footer>