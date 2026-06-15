<?php
$page = $page_data;
// print_r($page);die;
$page_images = explode(',', $page['images']);
?>
<div class="container wow fadeInUp" data-wow-delay="0.3ms" data-wow-duration="2000ms">
    <div class="text-content-page">
        <p class="text-justify">
            <?php echo $page_data['text'] ?>
        </p>
    </div>
    <div class="ft-blog-content-2">
        <div class="blog-images-3">
            <?php foreach ($page_images as $images) { ?>

                <div class="blog-images-content ft-item-innerbox mb-5">
                    <a href="<?php echo $_upload_folders_map['pages'] . $images ?>" data-fancybox="gallery">
                        <img class="images" src="<?php echo $_upload_folders_map['blogs'] . $images  ?>" alt="<?php echo $page['title'] ?>">
                    </a>
                </div>

            <?php } ?>
        </div>
    </div>
</div>