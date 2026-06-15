<?php
$page = $page_data;
$page_images = explode(',', $page['images']);
?>
<section id="ft-service-details" class="ft-service-details-section page-padding">
    <div class="container">
        <div class="ft-service-details-content">
            <div class="row">
                <div class="col-lg-4 wow fadeInUp" data-wow-delay="0.3ms" data-wow-duration="2000ms">
                    <div class="ft-service-sidebar">
                        <div class="ft-service-sidebar-widget headline ul-li-block">
                            <div class="service-category-widget">
                                <h3 class="widget-title">All Service</h3>

                                <ul>
                                    <?php
                                    $sql_services = "select * from `services` where `status` = 'T' order by `ordering`";
                                    $result_services = $mysqli->query($sql_services);
                                    $total_services = $result_services->num_rows;
                                    if ($total_services > 0) {
                                        while ($service = $result_services->fetch_assoc()) {
                                    ?>
                                            <li class="hover-up">
                                                <a href="<?php echo $_defines['domain'] . '/service/' . $service['alias']  ?>">
                                                    <?php echo $service['title'] ?> 
                                                </a>
                                            </li>
                                    <?php }
                                    } ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 wow fadeInUp" data-wow-delay="0.3ms" data-wow-duration="2000ms">
                    <div class="ft-service-details-content-wrapper headline pera-content">
                        <div class="ft-service-details-img-wrapper">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="ft-service-details-img">
                                        <img src="<?php echo $_upload_folders_map['services'] . $page['image'] ?>" alt="<?php echo $page['title'] ?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="ft-service-details-text-wrapper">
                            <h3><?php echo $page['title'] ?></h3>
                            <p>
                                <?php echo $page['text'] ?>
                            </p>
                            <h3><?php echo _translate('service_details_images') ?></h3>
                            <div class="blog-images-3">
                                <?php foreach ($page_images as $images) { ?>
                                    <div class="blog-images-content ft-item-innerbox">
                                        <a href="<?php echo $_upload_folders_map['services'] . $images ?>" data-fancybox="gallery">
                                            <img class="images" src="<?php echo $_upload_folders_map['services'] . $images  ?>" alt="<?php echo $page['title'] ?>">
                                        </a>
                                    </div>

                                <?php } ?>
                            </div>
                            <div class="ft-video-content position-relative">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>