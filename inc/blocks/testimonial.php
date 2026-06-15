<?php
$sql = "select * from `testimonials` where `featured` = 'T' AND `status` = 'T' order by `datetime`";
// print_r($sql);die;
$result = $mysqli->query($sql);
$total = $result->num_rows;
if ($total > 0) {
?>
    <section id="ft-testimonial" class="ft-testimonial-section position-relative" style="background-image: url(<?php echo $_upload_folders_map['blocks'] . $_block['image'] ?>);">
        <span class="ft-testimonial-map text-center position-absolute"></span>
        <div class="container">
            <div class="ft-section-title headline pera-content text-center">
                <span class="sub-title">
                    <?php echo $_block['sub_title'] ?>
                </span>
                <h2>
                    <?php echo $_block['title'] ?>
                </h2>
            </div>
            <div class="ft-testimonial-slider-wrapper">
                <div class="ft-testimonial-slider-area">
                    <?php while ($testimonial = $result->fetch_assoc()) { ?>
                        <div class="ft-item-innerbox wow fadeInUp" data-wow-delay="100ms" data-wow-duration="1500ms">
                            <div class="ft-testimonial-item-innerbox">
                                <div class="ft-testimonial-item-img-wrapper position-relative">
                                    <div class="ft-testimonial-item-img">
                                        <img src="<?php echo $_upload_folders_map['testimonial'] . $testimonial['image'] ?>" alt="<?php echo $testimonial['author'] ?>">
                                    </div>
                                    <div class="ft-testimonial-quote d-flex align-items-center justify-content-center position-absolute">
                                        <img src="img/shape/quote.png" alt="testimonial">
                                    </div>
                                </div>
                                <div class="ft-testimonial-text-item text-center">
                                <?php echo $testimonial['text'] ?>
                                </div>
                                <div class="ft-testimonial-name headline position-relative">
                                    <span class="ft-testimonial-shape"></span>
                                    <h3>
                                        <?php echo $testimonial['author'] ?>
                                    </h3>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </section>
<?php } ?>