<?php
$sql = "select * from `services` where `featured` = 'T' AND `status` = 'T' order by `ordering` LIMIT 0,4";
$result = $mysqli->query($sql);
$total = $result->num_rows;
if ($total > 0) {
?>
    <section id="ft-service-3" class="ft-service-section-3">
        <div class="container">
            <div class="ft-section-title-3 headline text-center wow fadeInUp" data-wow-delay="0ms" data-wow-duration="1500ms">
                <span class="text-uppercase">
                    <?php echo $_block['sub_title'] ?>
                </span>
                <h2>
                    <?php echo $_block['title'] ?>
                </h2>
            </div>
            <div class="ft-service-content-3">
                <div class="ft-service-content-items-3">
                    <div class="row justify-content-center">
                        <?php while ($service = $result->fetch_assoc()) { ?>
                            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0ms" data-wow-duration="1500ms">
                                <a href="<?php echo $_defines['domain'] . '/service/' . $service['alias'] ?>">
                                    <div class="ft-service-innerbox-3 position-relative">
                                        <div class="ft-service-img position-relative">
                                            <img src="<?php echo $_upload_folders_map['services'] .  $service['image'] ?>" alt="<?php echo $service['title'] ?>">
                                        </div>
                                        <div class="ft-service-text-icon position-relative">
                                            <div class="ft-service-icon d-flex align-items-center justify-content-center position-absolute">
                                                <i class="<?php echo $service['icon'] ?>"></i>
                                            </div>
                                            <div class="ft-service-text position-relative headline pera-content">
                                                <h3>
                                                    <a href="<?php echo $_defines['domain'] . '/service/' . $service['alias'] ?>">
                                                        <?php echo $service['title'] ?>
                                                    </a>
                                                </h3>
                                                <p class="brief-service-home">
                                                    <?php echo $service['brief'] ?>
                                                </p>
                                            </div>
                                        </div>
                                        <div class="more-btn position-absolute">
                                            <a class="d-flex align-items-center justify-content-center text-uppercase" href="<?php echo $_defines['domain'] . '/service/' . $service['alias'] ?>">
                                                <?php echo _translate('button_service_home') ?>
                                                <i class="far fa-arrow-right"></i>
                                            </a>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php } ?>