<?php
$my_domain      = $_defines['domain'];
$condition      = null;
$tag_id         = null;
$category_id    = null;
$archive        = null;
$pagination_alias = "";
if (isset($_GET['alias'])) {
    $alias          = _strip_tags($_GET['alias']);
    $alias          = str_replace('/', '', $alias);
    $category       = _function_get('blog_categories', 'alias', $alias, '*');
    $category_id    = $category['id'];
    $condition      = " AND FIND_IN_SET($category_id, `category_ids`)";
    $pagination_alias = "/category/$alias";
}
$page       = (int) (!isset($_GET["page"]) ? 1 : $_GET["page"]);
if ($page <= 0) $page = 1;
$per_page   = $_defines['pagination']['blog'];
$startpoint = ($page * $per_page) - $per_page;
$statement  = "`blog` WHERE `status` = 'T' $condition ";
$statement .= " ORDER BY `datetime` DESC ";
$sql        = "SELECT * FROM {$statement} LIMIT {$startpoint}, {$per_page}";
$result     = $mysqli->query($sql);
$total      = $result->num_rows;
if ($total) {
    while ($item_blogs = $result->fetch_assoc()) {
        $blogs_array[] = $item_blogs;
    }
?>
    <section id="ft-blog-post-feed" class="ft-blog-post-feed-section page-padding wow fadeInUp" data-wow-delay="0.3ms" data-wow-duration="2000ms">
        <div class="container">
            <div class="row">
                <div class="col-lg-9">
                    <div class="ft-blog-post-feed-content">
                        <?php foreach ($blogs_array as $blog) { ?>
                            <div class="ft-blog-post-feed-innerbox">
                                <div class="ft-blog-post-feed-img">
                                    <a href="<?php echo $_defines['domain'] . '/blog/' . $blog['alias'] ?>">
                                        <img src="<?php echo $_upload_folders_map['blogs'] . $blog['image'] ?>" alt="<?php echo $blog['title'] ?>">
                                    </a>
                                </div>
                                <div class="ft-blog-post-feed-text-wrapper headline pera-content">
                                    <div class="blog-meta information-blog">

                                        <?php
                                        $category_ids = $blog['category_ids'];
                                        $sql_cats = "SELECT `title`,`alias` FROM `blog_categories` WHERE `status` = 'T' AND FIND_IN_SET(`id`, '$category_ids') ORDER BY `ordering`";
                                        $result_cats = $mysqli->query($sql_cats);
                                        $total_cats = $result_cats->num_rows;
                                        ?>
                                        <ul style="list-style-type:none" class="category-blog">
                                            <?php while ($cats = $result_cats->fetch_assoc()) { ?>
                                                <li class="position-relative">
                                                    <a href="<?php echo $_defines['domain'] . '/blog/category/' . $cats['alias'] ?>">
                                                        <?php echo $cats['title'] ?>
                                                    </a>
                                                </li>
                                            <?php } ?>
                                        </ul>

                                        <a>
                                            <i class="fal fa-calendar-alt"></i>
                                            <?php echo _to_persian($_date->date("d F Y", strtotime($blog['datetime']))) ?>
                                        </a>
                                    </div>
                                    <div class="ft-blog-feed-title-text">
                                        <h3>
                                            <a href="<?php echo $_defines['domain'] . '/blog/' . $blog['alias'] ?>">
                                                <?php echo $blog['title'] ?>
                                            </a>
                                        </h3>
                                        <p>
                                            <?php echo $blog['brief'] ?>
                                        </p>
                                    </div>
                                    <div class="ft-btn-2">
                                        <a href="<?php echo $_defines['domain'] . '/blog/' . $blog['alias'] ?>">
                                            <span>
                                                <?php echo _translate('blog_details_button') ?>
                                            </span>
                                            <i class="icon-first flaticon-right-arrow"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                    <div class="ft-pagination-item  ul-li">
                        <?php if ($total) echo pagination_search($statement, $per_page, $page, $url = "$my_domain/blog$pagination_alias") ?>
                    </div>
                </div>
                <?php include(ROOT . 'inc/includes/blog_sidebar.php') ?>
            </div>
        </div>
    </section>
<?php } ?>