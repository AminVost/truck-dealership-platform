<?php require(ROOT . 'inc/theme_head_title.php') ?>
<meta charset="UTF-8">
<title><?php echo $_config['site_title'] ?></title>
<meta name="description" content="FasTrans - Logistics & Delivery Company HTML template">
<meta name="keywords" content="cargo, clean, contractor, corporate, freight, industry, localization, logistics, page builder, shipment, transport, transportation, truck, trucking">
<meta name="author" content="Themexriver">
<link rel="shortcut icon" href="<?php echo $_upload_folders_map['config'] . $_config['site_favicon'] ?>" type="image/x-icon">
<!-- Mobile Specific Meta -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<script src="https://www.google.com/recaptcha/api.js?render=<?php echo $_defines['captcha']['client-key'] ?>"></script>
<link rel="stylesheet" href="assets/fonts/iranyekan/css/style.css">
<?php if (!$_dev) { ?>
    <link rel="stylesheet" href="<?php echo $_defines['assets'] ?>/bundle/app.css?version=<?php echo $_version ?>">
<?php } else { ?>
    <link rel="stylesheet" href="assets/libs/css/bootstrap.min.css?version=<?php echo $_version ?>">
    <link rel="stylesheet" href="assets/libs/css/fontawesome-all.css?version=<?php echo $_version ?>">
    <link rel="stylesheet" href="assets/libs/css/flaticon.css?version=<?php echo $_version ?>">
    <link rel="stylesheet" href="assets/libs/css/animate.css?version=<?php echo $_version ?>">
    <link rel="stylesheet" href="assets/libs/css/nice-select.css?version=<?php echo $_version ?>">
    <link rel="stylesheet" href="assets/libs/css/video.min.css?version=<?php echo $_version ?>">
    <link rel="stylesheet" href="assets/libs/css/jquery.mCustomScrollbar.min.css?version=<?php echo $_version ?>">
    <link rel="stylesheet" href="assets/libs/css/slick.css?version=<?php echo $_version ?>">
    <link rel="stylesheet" href="assets/libs/css/fancybox.css?version=<?php echo $_version ?>">
    <link rel="stylesheet" href="assets/libs/css/rs6.css?version=<?php echo $_version ?>">
    <link rel="stylesheet" href="assets/libs/css/slick-theme.css?version=<?php echo $_version ?>">
    <link rel="stylesheet" href="assets/libs/css/iziToast.min.css?version=<?php echo $_version ?>">
    <link rel="stylesheet" href="assets/libs/css/default.css?version=<?php echo $_version ?>">
    <link rel="stylesheet" href="assets/css/style.css?version=<?php echo $_version ?>">
    <link rel="stylesheet" href="assets/css/dev.css?version=<?php echo $_version ?>">
<?php } ?>