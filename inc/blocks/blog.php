<?php
$sql = "select * from `blog` where `featured` = 'T' AND `status` = 'T' order by `datetime`";
$result = $mysqli->query($sql);
$total = $result->num_rows;
if ($total > 0) {
?>
    <section id="ft-blog-3" class="ft-blog-section-3 wow fadeInUp" data-wow-delay="0.1ms" data-wow-duration="1500ms" >
        <div class="container">
            <div class="ft-section-title-3 headline text-center">
                <span class="text-uppercase">
                    <?php echo $_block['sub_title'] ?>
                </span>
                <h2>
                    <?php echo $_block['title'] ?>
                </h2>
            </div>
            <div class="ft-blog-content-3">
                <div class="blog-slider-3">
                    <?php while ($blog = $result->fetch_assoc()) { ?>
                        <div class="ft-item-innerbox blog-block-home">
                            <div class="ft-blog-innerbox-3 position-relative">
                                <div class="ft-blog-img">
                                    <img src="<?php echo $_upload_folders_map['blogs'] . $blog['image'] ?>" alt="<?php $blog['title'] ?>">
                                </div>
                                <div class="ft-blog-text headline pera-content position-relative">
                                    <div class="ft-blog-meta d-flex justify-content-between">
                                        <a href="<?php echo $_defines['domain'] .'/blog/'. $blog['alias'] ?>">
                                        <i class="fas fa-calendar-alt"></i> 
                                        <?php echo _to_persian($_date->date("d F Y", strtotime($blog['datetime']))) ?>
                                    </a>

                                    </div>
                                    <h3><a href="<?php echo $_defines['domain'] .'/blog/'. $blog['alias'] ?>">
                                           <?php echo $blog['title'] ?> 
                                        </a></h3>
                                    <a class="more-btn text-uppercase d-flex justify-content-center align-items-center position-absolute" href="<?php echo $_defines['domain'] .'/blog/'. $blog['alias'] ?>">
                                        <?php echo _translate('blog_buttom') ?>
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </section>
<?php } ?>