<?php
//https://github.com/matthiasmullie/minify

require_once('config.php');
require_once(ROOT . '/inc/libs/vendors/minify/autoload.php');

use MatthiasMullie\Minify;

if (isset($_GET['_passcode']) && ($_GET['_passcode'] == $_minify_access)) {
    $sourcePath = ROOT . '/assets/libs/css/bootstrap.min.css';
    $minifier = new Minify\CSS($sourcePath);

    //CSS VENDORS
    $css_vendors = array(
        ROOT . 'assets/libs/css/fontawesome-all.css',
        ROOT . 'assets/libs/css/flaticon.css',
        ROOT . 'assets/libs/css/animate.css',
        ROOT . 'assets/libs/css/nice-select.css',
        ROOT . 'assets/libs/css/video.min.css',
        ROOT . 'assets/libs/css/jquery.mCustomScrollbar.min.css',
        ROOT . 'assets/libs/css/slick.css',
        ROOT . 'assets/libs/css/fancybox.css',
        // ROOT . 'assets/libs/css/rs6.css',
        ROOT . 'assets/libs/css/slick-theme.css',
        ROOT . 'assets/libs/css/iziToast.min.css',
        ROOT . 'assets/libs/css/default.css',
        ROOT . 'assets/css/style.css'
    );

    foreach ($css_vendors as $css_file) {
        $sourcePath = $css_file;
        $minifier->add($sourcePath);
    }
    $minifier->minify(ROOT . '/assets/bundle/app.css');


    //JS VENDORS
    $sourcePath = ROOT . '/assets/libs/js/jquery.min.js';
    $minifier = new Minify\JS($sourcePath);

    $js_vendors = array(
        ROOT . 'assets/libs/js/bootstrap.min.js',
        ROOT . 'assets/libs/js/popper.min.js',
        ROOT . 'assets/libs/js/jquery.magnific-popup.min.js',
        ROOT . 'assets/libs/js/appear.js',
        ROOT . 'assets/libs/js/slick.js',
        ROOT . 'assets/libs/js/fancybox.umd.js',
        ROOT . 'assets/libs/js/jquery.counterup.min.js',
        ROOT . 'assets/libs/js/waypoints.min.js',
        ROOT . 'assets/libs/js/imagesloaded.pkgd.min.js',
        ROOT . 'assets/libs/js/jquery.filterizr.js',
        ROOT . 'assets/libs/js/jquery.mCustomScrollbar.concat.min.js',
        ROOT . 'assets/libs/js/wow.min.js',
        ROOT . 'assets/libs/js/jquery.cssslider.min.js',
        ROOT . 'assets/libs/js/rbtools.min.js',
        // ROOT . 'assets/libs/js/rs6.min.js',
        ROOT . 'assets/libs/js/jquery.validate.min.js',
        ROOT . 'assets/libs/js/jquery.form.min.js',
        ROOT . 'assets/libs/js/iziToast.min.js',
        ROOT . 'assets/js/theme.js',
        ROOT . 'assets/js/my-forms.js'
    );
    foreach ($js_vendors as $js_file) {
        $sourcePath = $js_file;
        $minifier->add($sourcePath);
    }
    $minifier->minify(ROOT . '/assets/bundle/app.js');
    //JS VENDORS
    echo 'minified successfully';
} else {
    echo 'error auhtentication';
}
