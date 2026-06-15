<?php
$sql = "select * from `brands` where `featured` = 'T' AND `status` = 'T' order by `ordering`";
$result = $mysqli->query($sql);
$total = $result->num_rows;
if ($total > 0) {
?>
    <section id="ft-case-study" class="ft-case-study-section bg-white wow fadeInUp" data-wow-delay="0.3ms" data-wow-duration="2000ms">
        <div class="container">
            <div class="ft-section-title-3 headline text-center wow fadeInUp" data-wow-delay="0ms" data-wow-duration="1500ms" style="visibility: visible; animation-duration: 1500ms; animation-delay: 0ms; animation-name: fadeInUp;">
                <span class="text-uppercase">
                    <?php echo _translate('brands_subtitle') ?>
                </span>
                <h2>
                    <?php echo $page_data['title'] ?>
                </h2>
                <?php if (isset($page_data['text'])) { ?>
                    <div class="text-dark text-center mt-4">
                        <?php echo $page_data['text'] ?>
                    </div>
                <?php } ?>
            </div>
            <div class="ft-case-study-content d-flex">
                <?php while ($brand = $result->fetch_assoc()) { ?>
                    <div class="ft-case-study-items position-relative brands-block">
                        <div class="ft-case-study-img position-relative text-center">
                            <a href="<?php echo $_defines['domain'] . '/brands/' . $brand['alias']  ?>">
                                <img src="<?php echo $_upload_folders_map['brands'] . $brand['image'] ?>" alt="<?php echo $brand['title'] ?>">
                            </a>
                        </div>
                        <div class="ft-case-study-text headline pera-content">
                            <h3>
                                <a class="bg-transparent name-brands-home" href="<?php echo $_defines['domain'] . '/brand/' . $brand['alias']  ?>">
                                    <?php echo $brand['title'] ?>
                                </a>
                            </h3>
                            <a class="more-btn d-flex align-items-center justify-content-center btn-brands" href="<?php echo $_defines['domain'] . '/brand/' . $brand['alias']  ?>">
                                <i class="fas fa-arrow-left"></i>
                            </a>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </section>
<?php } ?>