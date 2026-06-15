<?php
$sql = "select * from `block_slides` where `block_id` = '$_block_id' AND `status` = 'T' order by `ordering`";
$result = $mysqli->query($sql);
$total = $result->num_rows;
if ($total > 0) {
    
?>
    <div class="position-relative slider3">
        <div class="slider-area over-hidden slider-dots2">
            <div class="slider-active">
                <?php while ($slide = $result->fetch_assoc()) {
                     $slides_link = _menu($slide['button_page_id'] , $slide['button_module_id'] , $slide['button_service_id'] , $slide['button_brand_id'] , $slide['button_url']);
                    ?>
                    <div class="single-slider slider-height3 d-flex align-items-center" data-background="<?php echo $_upload_folders_map['block_slides'] . $slide['image'] ?>">
                        <div class="container z-index1 slider-container">
                            <div class="row slider-home">
                                <div class="col-xl-7 col-lg-6  col-md-6  col-sm-12 col-12 d-flex align-items-center justify-content-end">
                                    <div class="slider-content position-absolutes mt--12 z-index1" dir="rtl">
                                        <h2 data-animation="fadeInLeft" data-delay="1s" class="text-white mb-1 text-capitalize pb-15 font500 font-pt">
                                            <?php echo $slide['title'] ?>
                                        </h2>
                                        <p class="text-white font300 pb-12" data-animation="fadeInLeft" data-delay="1.5s">
                                            <?php echo $slide['sub_title'] ?>
                                        </p>
                                        <p class="text-white font300" data-animation="fadeInLeft" data-delay="1.5s">
                                        <?php echo $slide['text'] ?>
                                        </p>
                                        <a data-animation="fadeInUp" data-delay="1.7s" href="<?php echo $slides_link['link'] ?>" class="web-btn h3-web-btn d-inline-block text-uppercase white h3-theme-bg position-relative over-hidden pl-30 pr-30 ptb-17 slide-home">
                                            <?php echo $_block['button_text'] ?>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
<?php  } ?>