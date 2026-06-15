<div class="col-lg-3 wow fadeInUp" data-wow-delay="0.3ms" data-wow-duration="2000ms">
    <div class="ft-side-bar-wrapper top-stikcy">
        <div class="ft-side-bar-widget-area">
            <div class="ft-side-bar-widget headline ul-li-block">
                <div class="category-widget">
                    <?php
                    $sql_blog_cat = "SELECT * FROM `blog_categories` WHERE `status` = 'T' ORDER BY `ordering`";
                    $result_blog_cat = $mysqli->query($sql_blog_cat);
                    $total_blog_cat = $result_blog_cat->num_rows;
                    if ($total_blog_cat > 0) {
                    ?>
                        <h3 class="widget-title position-relative">
                            <?php echo _translate('blog_sidebar_category') ?>
                        </h3>
                        <ul>
                            <?php while ($blog_cat = $result_blog_cat->fetch_assoc()) {
                                $category_id                = $blog_cat['id'];
                                $sql_count_of_categories    = "SELECT COUNT(*) AS 'cats_count' FROM `blog` WHERE `status` = 'T' AND FIND_IN_SET('$category_id' , `category_ids`) ";
                                $result_count_cat           = $mysqli->query($sql_count_of_categories);
                                $total_all_count            = $result_count_cat->num_rows;
                                $count = $result_count_cat->fetch_assoc();
                            ?>
                                <li>
                                    <a href="<?php echo $_defines['domain'] . '/blog/category/' . $blog_cat['alias'] ?>">
                                        <?php echo $blog_cat['title'] ?>
                                        <span>
                                            <?php echo $count['cats_count'] ?>
                                        </span>
                                    </a>
                                </li>
                            <?php } ?>
                        </ul>
                    <?php } ?>
                </div>
            </div>
            <div class="ft-side-bar-widget headline ul-li-block">
                <div class="recent-news-widget">
                    <?php
                    $sql_recent = "select * from `blog` where `status` = 'T' order by `datetime` LIMIT 0,4";
                    $result_recent = $mysqli->query($sql_recent);
                    $total_recent = $result_recent->num_rows;
                    if ($total_recent > 0) {
                    ?>
                        <h3 class="widget-title position-relative">
                            <?php echo _translate('blog_sidebar_recent') ?>
                        </h3>
                        <?php while ($blog_recent = $result_recent->fetch_assoc()) { ?>
                            <div class="recent-blog-img-text clearfix">
                                <div class="recent-blog-img float-left">
                                    <img src="<?php echo $_upload_folders_map['blogs'] . $blog_recent['image'] ?>" alt="<?php echo $blog_recent['title'] ?>">
                                </div>
                                <div class="recent-blog-text headline">
                                    <h3>
                                        <a href="<?php echo $_defines['domain'] . '/blog/' . $blog_recent['alias'] ?>">
                                            <?php echo $blog_recent['title'] ?>
                                        </a>
                                    </h3>
                                    <span><i class="far fa-calendar-alt"></i>
                                        <?php echo _to_persian($_date->date("d F Y", strtotime($blog_recent['datetime']))) ?>
                                    </span>
                                </div>
                            </div>
                    <?php }
                    } ?>
                </div>
            </div>
        </div>
    </div>
</div>