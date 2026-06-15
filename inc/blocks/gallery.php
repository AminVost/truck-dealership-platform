<?php
$sql = "select * from `gallery` where `featured` = 'T' AND `status` = 'T' order by `ordering`";
$result_gallery = $mysqli->query($sql);
$total = $result_gallery->num_rows;
if ($total > 0) {
?>
    <section id="ft-portfolio-2" class="ft-portfolio-section-2 position-relative">
        <div class="ft-section-title-2 headline pera-content text-center">
            <span class="sub-title">
                <?php echo $_block['sub_title'] ?>
            </span>
            <h2>
                <?php echo $_block['title'] ?>
            </h2>
        </div>
        <div class="ft-portfolio-content-2 wow fadeInUp" data-wow-delay="0.1s" data-wow-duration="1s">
            <div class="ft-portfolio-slider-2">
                <?php while ($image = $result_gallery->fetch_assoc()) { ?>
                    <div class="ft-portfolio-slider-item">
                        <div class="ft-portfolio-slider-innerbox position-relative">
                            <div class="ft-portfolio-img">
                                <a href="<?php echo $_upload_folders_map['gallery'] . $image['image'] ?>" data-fancybox="block-gallery">
                                    <img src="<?php echo $_upload_folders_map['gallery'] . $image['image'] ?>" alt="<?php echo $image['title'] ?>">
                                </a>ّ
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </section>
<?php } ?>