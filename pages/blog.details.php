<?php
$page = $page_data;
// print_r($page);die;
$page_images = explode(',', $page['images']);
$page_related = explode(',', $page['related_blog_ids']);
$blog_categories = explode(',', $page['category_ids']);
?>
<section id="ft-blog-feed-details" class="ft-blog-feed-details-section page-padding">
    <div class="container">
        <div class="ft-blog-feed-details-content">
            <div class="row">
                <div class="col-lg-9 wow fadeInUp" data-wow-delay="0.3ms" data-wow-duration="1500ms" >
                    <div class="blog-details-img-text-wrapper">
                        <div class="blog-details-img position-relative">
                            <img src="<?php echo $_upload_folders_map['blogs'] . $page['image'] ?>" alt="<?php echo $page['title'] ?>">
                        </div>
                        <div class="ft-blog-details-item">
                            <div class="blog-details-text headline">
                                <div class="ftd-blog-meta-2  position-relative text-capitalize">
                                    <a href="blog-single.html#"><i class="far fa-clock"></i>
                                        <?php echo _to_persian($_date->date("d F Y", strtotime($page['datetime']))) ?>
                                    </a>
                                </div>
                                <h3>
                                    <?php echo $page['title'] ?>
                                </h3>
                                <article>
                                    <?php echo $page['brief'] ?>
                                </article>
                                <div>
                                    <?php echo $page['text'] ?>
                                </div>
                            </div>
                            <div class="ft-blog-next-prev d-flex justify-content-between flex-wrap">
                                <h3>
                                    <?php echo _translate('blog_details_images') ?>
                                </h3>
                                <div class="ft-blog-content-2">
                                    <div class="blog-images-3">
                                        <?php foreach ($page_images as $images) { ?>

                                            <div class="blog-images-content ft-item-innerbox">
                                                <a href="<?php echo $_upload_folders_map['blogs'] . $images ?>" data-fancybox="gallery">
                                                    <img class="images" src="<?php echo $_upload_folders_map['blogs'] . $images  ?>" alt="<?php echo $page['title'] ?>">
                                                </a>
                                            </div>

                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="ft-blog-comment headline">
                        <h3>
                            <?php echo _translate('related_blog_title') ?>
                        </h3>
                        <div class="ft-blog-comment-block-wrapper">
                            <div class="">
                                <div class="blog-slider-3">
                                    <?php
                                    foreach ($page_related as $related_id) {
                                        $sql_blogs = "select * from `blog` where `id` = '$related_id' AND `status` = 'T' order by `datetime`";
                                        // print_r($sql_blogs);die;
                                        $result_blogs = $mysqli->query($sql_blogs);
                                        $total_blogs = $result_blogs->num_rows;
                                        if ($total_blogs > 0) {
                                            while ($related_blog = $result_blogs->fetch_assoc()) {
                                                $related_blog_ids = explode(',', $related_blog['category_ids']);
                                    ?>
                                                <div class="ft-item-innerbox">
                                                    <div class="ft-blog-innerbox-3 position-relative">
                                                        <div class="ft-blog-img">
                                                            <img src="<?php echo $_upload_folders_map['blogs'] . $related_blog['image'] ?>" alt="<?php $related_blog['title'] ?>">
                                                        </div>
                                                        <div class="ft-blog-text headline pera-content position-relative related-content1 blog-details-related">
                                                            <div class="ft-blog-meta d-flex justify-content-center">
                                                                <a href="<?php echo $_defines['domain'] . '/blog/' . $related_blog['alias'] ?>">
                                                                    <i class="fas fa-calendar-alt"></i>
                                                                    <?php echo _to_persian($_date->date("d F Y", strtotime($related_blog['datetime']))) ?>
                                                                </a>

                                                            </div>
                                                            <h4 class="title-related-blog-item"><a href="<?php echo $_defines['domain'] . '/blog/' . $related_blog['alias'] ?>">
                                                                    <?php echo $related_blog['title'] ?>
                                                                </a></h4>
                                                            <a class="more-btn text-uppercase d-flex justify-content-center align-items-center position-absolute" href="<?php echo $_defines['domain'] . '/blog/' . $related_blog['alias'] ?>">
                                                                <?php echo _translate('blog_buttom') ?>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                    <?php }
                                        }
                                    } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php include(ROOT . 'inc/includes/blog_sidebar.php') ?>
            </div>
        </div>
    </div>
</section>