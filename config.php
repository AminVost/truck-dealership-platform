<?php
ob_start();
session_name('xxxxx');
session_start();

ini_set('display_errors', 'On');
error_reporting(E_ALL);



$_version = '1.0.0.6';
$_minify_access    =    'u-wd5vHC4l=MdsAJ';

if (isset($_GET['_dev'])) {
    $_SESSION['_dev']   =   true;
}
if (isset($_GET['_no_dev'])) {
    if (isset($_SESSION['_dev'])) {
        unset($_SESSION['_dev']);
    }
    if (isset($_SESSION['translations'])) {
        unset($_SESSION['translations']);
    }
}
if (isset($_SESSION['_dev'])) {
    $_dev   =   true;
} else {
    $_dev   =   false;
}
if (isset($_GET['_tp']) && $_GET['_tp'] == 1) {
    $_SESSION['_tp']   =   true;

    if (isset($_SESSION['translations'])) {
        unset($_SESSION['translations']);
    }
}
if (isset($_GET['_tp']) && $_GET['_tp'] == 0) {
    if (isset($_SESSION['_tp'])) {
        unset($_SESSION['_tp']);
    }
    if (isset($_SESSION['translations'])) {
        unset($_SESSION['translations']);
    }
}
if (isset($_SESSION['_tp'])) {
    $_tp   =   true;
} else {
    $_tp   =   false;
}

define("ROOT", dirname(__FILE__) . "/");
define("UPLOAD_PATH", ROOT . "uploads/");


define('PHP_FIREWALL_REQUEST_URI', strip_tags($_SERVER['REQUEST_URI']));
define('PHP_FIREWALL_ACTIVATION', false);

//includes
require_once(ROOT . 'inc/libs/vendors/ReCaptchav3/Recaptcha.php');
require_once(ROOT . 'inc/libs/vendors/minify/autoload.php');
require_once(ROOT . 'inc/libs/vendors/EmailParser/EmailParser.php');
require_once(ROOT . 'inc/libs/vendors/php_mailer/phpmailer/phpmailer/src/Exception.php');
require_once(ROOT . 'inc/libs/vendors/php_mailer/phpmailer/phpmailer/src/PHPMailer.php');
require_once(ROOT . 'inc/libs/vendors/php_mailer/phpmailer/phpmailer/src/SMTP.php');
require_once(ROOT . 'inc/libs/vendors/jdatetime/jdatetime.class.php');
require_once(ROOT . 'inc/libs/functions/general.php');
require_once(ROOT . 'inc/libs/functions/custom.php');

$_date = new jDateTime(false, true, 'Asia/Tehran');
define("HOST", "localhost");
define("USER", "root");
define("PASSWORD", "");
define("DATABASE", "xxxxx");

$mysqli = _db_connect(HOST, USER, PASSWORD, DATABASE);
$mysqli->set_charset("utf8");
$_subdomain     = (explode('.', $_SERVER['HTTP_HOST']));

//CONFIG
$sql_config     = "SELECT * FROM `config` ";
$result_config     = $mysqli->query($sql_config);
$_config        = $result_config->fetch_assoc();
if (!$_config) {
    header("Location: https://xxxx.ir/en");
    exit;
}
$_captcha =  [
    'client-key' => '6Lxxxxx_D-',
    'secret-key' => '6LcxxxxxxUkqDV'
];
$_defines = [
    'version'           => $_version,
    'domain'            => $_config['site_domain'],
    'assets'            => $_config['site_domain'] . '/assets',
    'no_images'         => $_config['site_domain'] . '/assets/images/no-images',
    'upload'            => $_config['site_domain'] . '/uploads',
    'captcha'           => $_captcha,
];
$_defines['pagination'] = [
    'blog'       => 3,
    'services'   => 6,
    'products'   => 10,
];
$_upload_folders_map = [
    'config'           => $_defines['domain'] . '/uploads/config/',
    'blocks'           => $_defines['domain'] . '/uploads/blocks/',
    'block_slides'     => $_defines['domain'] . '/uploads/block_slides/',
    'block_services'   => $_defines['domain'] . '/uploads/block_services/',
    'services'         => $_defines['domain'] . '/uploads/services/',
    'icons'            => $_defines['domain'] . '/uploads/icons/',
    'socials'          => $_defines['domain'] . '/uploads/socials/',
    'pages'            => $_defines['domain'] . '/uploads/pages/',
    'modules'          => $_defines['domain'] . '/uploads/modules/',
    'testimonial'      => $_defines['domain'] . '/uploads/testimonial/',
    'blogs'            => $_defines['domain'] . '/uploads/blogs/',
    'brands'           => $_defines['domain'] . '/uploads/brands/',
    'gallery'          => $_defines['domain'] . '/uploads/gallery/',
    'modal'            => $_defines['domain'] . '/uploads/modal/',
    'products'         => $_defines['domain'] . '/uploads/products/',
];

$_smtp = [
    'host'          => $_config['smtp_host'],
    'username'      => $_config['smtp_username'],
    'password'      => $_config['smtp_password'],
    'type'          => $_config['smtp_type'],
    'port'          => $_config['smtp_port'],
    'from_email'    => $_config['smtp_from_email'],
    'from_name'     => $_config['smtp_from_name'],
    'admin_email'   => $_config['smtp_to_email'],
];
$sql_modules    = "SELECT * FROM `modules`";
$result_modules = $mysqli->query($sql_modules);
$total_modules  = $result_modules->num_rows;
while ($module = $result_modules->fetch_assoc()) {
    $module['alias']            = str_replace("/", ".", $module['alias']);
    $_modules[$module['alias']] = $module;
    $_modules_alias[]           = $module['alias'];
}
// print_r($_modules_alias);die;

if (isset($_SESSION['no_translate'])) {
    foreach ($_SESSION['no_translate'] as $no_translate_key => $no_translate_value) {
        $sql_insert =   "INSERT INTO `translations` ( `label`, `value` ) VALUES ( '" . $no_translate_key . "', '" . $no_translate_value . "' )";
        if ($mysqli->query($sql_insert)) {
            unset($_SESSION['no_translate'][$no_translate_key]);
        } else {
            unset($_SESSION['no_translate'][$no_translate_key]);
        }
    }
}
$sql_translate_updates    = "SELECT UPDATE_TIME FROM information_schema.tables WHERE  TABLE_SCHEMA = '" . DATABASE . "' AND TABLE_NAME = 'translations' ";
$result_translate_updates = $mysqli->query($sql_translate_updates);
$_translate_last_update   = $result_translate_updates->fetch_assoc();
if (!isset($_SESSION['last_updates']['translations']) || !isset($_SESSION['translations']) || $_translate_last_update['UPDATE_TIME'] != $_SESSION['last_updates']['translations']) {
    $sql_translate      =   "SELECT `label`,`value` FROM `translations`";
    $result_translate   =   $mysqli->query($sql_translate);
    $translate_array    =   [];
    while ($row_translate    = $result_translate->fetch_assoc()) {
        $translate_array[$row_translate['label']]   =   $row_translate['value'];
    }
    $_translations = new stdClass();
    foreach ($translate_array as $translate_key => $translate_value) {
        $translate_key  =   strtoupper($translate_key);
        $_translations->$translate_key = _clean($translate_value);
    }
    $_SESSION['translations']                    = $_translations;
    $_SESSION['last_updates']['translations']    = $_translate_last_update['UPDATE_TIME'];
} else {
    $_translations   =    $_SESSION['translations'];
}

$sql_socials = "SELECT * FROM `socials` WHERE `status` = 'T' ORDER BY `ordering`";
$result_socials = $mysqli->query($sql_socials);
$total_socials = $result_socials->num_rows;
if ($total_socials > 0) {
    $social_array = [];
    while ($socials = $result_socials->fetch_assoc()) {
        $social_array[] = $socials;
    }
}

