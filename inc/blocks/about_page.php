<section id="ft-about-2" class="ft-about-section-2">
    <div class="container">
        <div class="ft-about-content-2">
            <div class="row">
                <div class="col-lg-6">
                    <div class="ft-about-text-wrapper-2">
                        <div class="ft-section-title-2 headline pera-content">
                            <span class="sub-title">
                                <?php echo _translate('about_page_subtitle') ?>
                            </span>
                            <h2>
                                <?php echo $_block['title'] ?>
                            </h2>
                            <p class="text-justify text-dark">
                                <?php echo $_block['text'] ?>
                            </p>
                        </div>
                        <div class="ft-about-feature-wrapper-2">
                            <div class="row">
                                <?php
                                $sql = "SELECT * FROM `block_boxes` WHERE `block_id` = '$_block_id' AND `status` = 'T' ORDER BY `ordering`";
                                $result = $mysqli->query($sql);
                                $total = $result->num_rows;
                                if ($total > 0) {
                                    while ( $box = $result->fetch_assoc()) {
                                ?>
                                        <div class="col-lg-6">
                                            <div class="ft-about-feature-list-item d-flex align-items-center">
                                                <div class="ft-about-feature-icon d-flex align-items-center justify-content-center">
                                                    <i class="<?php echo $box['icon'] ?>"></i>
                                                </div>
                                                <div class="ft-about-feature-text headline pera-content">
                                                    <h3> <?php echo $box['title'] ?></h3>
                                                    <p>
                                                        <?php echo $box['text'] ?>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                <?php }
                                } ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="ft-about-img-2-wrapper position-relative">
                        <div class="ft-about-img-2">
                            <a href="<?php echo $_defines['domain'] ?>">
                                <img src="<?php echo $_upload_folders_map['blocks'] . $_block['image'] ?>" alt="<?php echo $_block['title'] ?>">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>