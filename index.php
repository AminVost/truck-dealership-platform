<?php
$render_start = microtime(true);
$_request   =   'normal';
require 'config.php';
// print_r($_GET['alias']);die;
if (isset($_GET['type'])  && !empty($_GET['type'])) {
    $_defines['page']         = strip_tags($_GET['type']);

    $_defines['page']         = $mysqli->real_escape_string($_defines['page']); //کاراکترهای خاص که معنی ویژه ای برای دیتابیس داشته و ممکن است در دستور SQL خطرناک باشند را از آن حذف کرده
    $_defines['page']         = str_replace('/', '', $_defines['page']);
    if ($_defines['page'] == 'home') {
        header("Location: " . $_defines['domain']);
        exit;
    }
    if (file_exists('pages/' . $_defines['page'] . '.php')) {
        $_defines['page'] = $_defines['page'];
    } else {
        if ($_dev) {
            echo 'page ' . $_defines['page'] . ' not found';
            die;
        } else {
            header('Location: ' . $_defines['domain'] . '/error');
            exit;
        }
    }
} else {
    $_defines['page'] = 'home';
}
?>
<!DOCTYPE html>
<html>

<head>
    <?php require_once(ROOT . 'inc/theme_head.php'); ?>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A==" crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js" integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA==" crossorigin=""></script>
</head>

<body class="my-page-<?php echo $_defines['page'] ?>" dir="rtl">
    <?php require_once(ROOT . 'inc/theme_preloader.php'); ?>
    <div class="up">
        <a href="index-2.html#" class="scrollup text-center"><i class="fas fa-chevron-up"></i></a>
    </div>
        <!-- Header -->
        <?php include(ROOT . 'inc/theme_header.php') ?>
        <!-- breadcrumb -->
        <?php require_once(ROOT . 'inc/theme_breadcrumb.php'); ?>
        <?php include(ROOT . "inc/theme_splash_ajax.php") ?>
        <?php include(ROOT . "inc/theme_order_modal.php") ?>
        <h1 class="d-none"><?php echo $_config['meta_title'] ?></h1>
        <!-- Main Section -->
        <?php
        $_block_position = 'content_top';
        require(ROOT . 'inc/blocks.php');
        if ($page_params['show_body'] == 'T') {
            if (file_exists(ROOT . 'pages/' . $_defines['page'] . '.php')) {
        ?>

                <?php require_once(ROOT . 'pages/' . $_defines['page'] . '.php'); ?>

        <?php
            } else {
                if ($_dev) {
                    echo 'page ' . $_defines['page'] . ' not found';
                } else {
                    header('Location: ' . $_defines['domain'] . '/error');
                    exit;
                }
            }
        }
        $_block_position = 'content_bottom';
        require(ROOT . 'inc/blocks.php');
        ?>
        <?php require_once(ROOT . "inc/theme_footer.php") ?>

    <?php require_once(ROOT . "inc/theme_foot.php") ?>

</body>

</html>
<?php
$render_end     = microtime(true);
$render_time    = ($render_end - $render_start);
if ($_dev) {
    echo '<div class="dev_buttons_container">';
    echo '<span class="show_hide_button"><i class="fa fa-angle-right"></i></span>';
    if ($_dev) {
        echo '<div class="dev_render my-english">';
        printf("%.6f seconds.", $render_time);
        echo '<div class="panel-power my-english">';
        echo '<a href="' . $_defines['domain'] . '/index.php?_no_dev"><svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><path d="M18.36 6.64a9 9 0 1 1-12.73 0"></path><line x1="12" y1="2" x2="12" y2="12"></line></svg>';
        echo '</a>';
        echo '</div>';
        echo '</div>';
    }
    if ($_dev) {
        echo '<div class="minify_render my-english">';
        echo '<a class="text-dark" href="' . $_defines['domain'] . '/minify.php?_passcode=' . $_minify_access . '" target="_blank">';
        echo 'minify assets';
        echo '</a>';
        echo '</div>';
    }
    if ($_dev && !$_tp) {
        echo '<div class="blocks_render my-english">';
        echo '<a href="' . $_defines['domain'] . '/index.php?_tp=1" >';
        echo 'blocks & langs';
        echo '</a>';
        echo '</div>';
    }
    if ($_dev && $_tp) {
        echo '<div class="tp_render my-english">';
        echo '<ul class="list-unstyled p-0 m-0">';
        echo '<li class="bullet-blocks">';
        echo '<span class="my-bullet"></span> <span>BLOCKS</span>';
        echo '</li>';
        echo '<li class="bullet-menues">';
        echo '<span class="my-bullet"></span> <span>MENUES</span>';
        echo '</li>';
        // echo '<li class="bullet-translations">';
        // echo '<span class="my-bullet"></span> <span>TRANSLATIONS</span>';
        // echo '</li>';
        echo '</ul>';
        echo '<div class="panel-power my-english">';
        echo '<a href="' . $_defines['domain'] . '/index.php?_tp=0"><svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><path d="M18.36 6.64a9 9 0 1 1-12.73 0"></path><line x1="12" y1="2" x2="12" y2="12"></line></svg>';
        echo '</a>';
        echo '</div>';
        echo '</div>';
    }
    echo '</div>';
}
?>
<script>
    $('.show_hide_button').on('click', function() {
        $('.dev_buttons_container').toggleClass('show');
    });
</script>