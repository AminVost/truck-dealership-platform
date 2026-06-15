<?php
$_blocks    =   [];
$home_breadcrumb            =   [];
$home_breadcrumb['title']   =   "<i class='fa fa-home fa-lg'></i>";
$home_breadcrumb['link']    =   $_defines['domain'];
$breadcrumb_array[]         =   $home_breadcrumb;
$header_image = $_config['header_image'] ? $_upload_folders_map['config'] . '/' . $_config['header_image'] : $_defines['no_images'] . '/header-image.jpg';
$page_params =  [
    'meta_title'                   => $_config['meta_title'],
    'meta_image'                   => $_config['meta_image'],
    'meta_description'             => $_config['meta_description'],
    'meta_follow'                  => 'follow',
    'meta_index'                   => 'index',
    'meta_url'                     => $_defines['domain'],
    'show_body'                    => 'T',
    'header_image'                 => $header_image,
    'show_header_image'            => $_config['show_header_image'],
    'show_breadcrumb'              => $_config['show_breadcrumb'],
    'canonical'                    => $_defines['domain'],
    'data'                         => [],
    'breadcrumb'                   => $breadcrumb_array
];

if (in_array($_defines['page'], $_modules_alias) && !isset($_GET['alias']) ) {//-->handling all modules like blog contact services ...
    
    $my_page_alt        = str_replace(".", "/", $_defines['page']);
    $module_params      = explode('/', $my_page_alt);
    $page_data      = _function_get('modules', 'alias', $my_page_alt, '*');
    // print_r($page_data);die;
    if (!$page_data) {
        header('Location: ' . $_defines['domain'] . '/error');
        exit;
    }
    if ($page_data['status'] != 'T') {
        header('Location: ' . $_defines['domain'] . '/error');
        exit;
    }
    $page_params['data']                    = $page_data;
    $page_params['meta_title']              = $page_data['title'];
    if ($page_data['meta_title']) {
        $page_params['meta_title']          = $page_data['meta_title'];
    }
    if ($page_data['meta_description']) {
        $page_params['meta_description']    = $page_data['meta_description'];
    }
    if ($page_data['meta_image']) {
        $page_params['meta_image']    = $page_data['meta_image'];
    }
    if ($page_data['meta_follow']) {
        $page_params['meta_follow']    = $page_data['meta_follow'];
    }
    if ($page_data['meta_index']) {
        $page_params['meta_index']    = $page_data['meta_index'];
    }
    if ($page_data['header_image']) {
        $page_params['header_image']    = $_upload_folders_map['modules'] . '/' . $page_data['header_image'];
    }
    if ($page_data['show_header_image']) {
        $page_params['show_header_image']   = $page_data['show_header_image'];
    }
    if ($page_data['show_breadcrumb']) {
        $page_params['show_breadcrumb']   = $page_data['show_breadcrumb'];
    }
    if ($page_data['show_body']) {
        $page_params['show_body']   = $page_data['show_body'];
    }
    if ($_defines['page'] == 'home') {
        $page_params['meta_url']    =   $_defines['domain'];
        $page_params['canonical']   =   $_defines['domain'];
    } else {
        $page_params['meta_url']    =   $_defines['domain'] . '/' . $page_data['alias'];
        $page_params['canonical']   =   $_defines['domain'] . '/' . $page_data['alias'];
    }

    if (isset($module_params[0]) && $module_params[0] == 'profile') {
        $breadcrumb['title']        =   $_modules['profile']['title'];
        $breadcrumb['link']         =   $_defines['domain'] . '/' . $_modules['profile']['alias'];
        $page_params['breadcrumb'][]            = $breadcrumb;
    }

    $breadcrumb['title']        =   $page_params['data']['title'];
    $breadcrumb['link']         =   $_defines['domain'] . '/' . $page_params['data']['alias'];
    $page_params['breadcrumb'][]            = $breadcrumb;
    $_block_source          = 'module';
    $_block_source_id       = $page_data['id'];
}
if ($_defines['page'] == 'page' && isset($_GET['alias'])) {
    $alias              = _strip_tags($_GET['alias']);
    $page_data          = _function_get('pages', 'alias', $alias, '*');
    if (!$page_data) {
        header('Location: ' . $_defines['domain'] . '/error');
        exit;
    }
    if ($page_data['status'] != 'T') {
        header('Location: ' . $_defines['domain'] . '/error');
        exit;
    }
    $page_params['data']                    = $page_data;
    $page_params['meta_title']              = $page_data['title'];
    if ($page_data['meta_title']) {
        $page_params['meta_title']          = $page_data['meta_title'];
    }
    if ($page_data['meta_description']) {
        $page_params['meta_description']    = $page_data['meta_description'];
    }
    if ($page_data['meta_image']) {
        $page_params['meta_image']    = $page_data['meta_image'];
    }
    if ($page_data['meta_follow']) {
        $page_params['meta_follow']    = $page_data['meta_follow'];
    }
    if ($page_data['meta_index']) {
        $page_params['meta_index']    = $page_data['meta_index'];
    }
    if ($page_data['header_image']) {
        $page_params['header_image']    = $_upload_folders_map['pages'] . '/' . $page_data['header_image'];
    }
    if ($page_data['show_header_image']) {
        $page_params['show_header_image']   = $page_data['show_header_image'];
    }
    if ($page_data['show_breadcrumb']) {
        $page_params['show_breadcrumb']   = $page_data['show_breadcrumb'];
    }
    if ($page_data['show_body']) {
        $page_params['show_body']   = $page_data['show_body'];
    }
    if ($_defines['page'] == 'home') {
        $page_params['meta_url']    =   $_defines['domain'];
        $page_params['canonical']   =   $_defines['domain'];
    } else {
        $page_params['meta_url']    =   $_defines['domain'] . '/page/' . $page_data['alias'];
        $page_params['canonical']   =   $_defines['domain'] . '/page/' . $page_data['alias'];
    }

    $breadcrumb['title']        =   $page_params['data']['title'];
    $breadcrumb['link']         =   $_defines['domain'] . '/page/' . $page_params['data']['alias'];
    $page_params['breadcrumb'][]            = $breadcrumb;
    
    $_block_source          = 'page';
    $_block_source_id       = $page_data['id'];
}
if ($_defines['page'] == 'brands' && isset($_GET['alias'])) {
    // print_r($_GET);die;
    $alias              = _strip_tags($_GET['alias']);
    $page_data          = _function_get('brands', 'alias', $alias, '*');
    if (!$page_data) {
        header('Location: ' . $_defines['domain'] . '/error');
        exit;
    }
    if ($page_data['status'] != 'T') {
        header('Location: ' . $_defines['domain'] . '/error');
        exit;
    }
    $page_data['text']                      = $page_data['text'];
    $page_params['data']                    = $page_data;
    $page_params['meta_title']              = $page_data['title'];
    if ($page_data['meta_title']) {
        $page_params['meta_title']          = $page_data['meta_title'];
    }
    if ($page_data['meta_description']) {
        $page_params['meta_description']    = $page_data['meta_description'];
    }
    if ($page_data['meta_image']) {
        $page_params['meta_image']    = $page_data['meta_image'];
    }
    if ($page_data['meta_follow']) {
        $page_params['meta_follow']    = $page_data['meta_follow'];
    }
    if ($page_data['meta_index']) {
        $page_params['meta_index']    = $page_data['meta_index'];
    }
    if ($page_data['header_image']) {
        $page_params['header_image']    = $_upload_folders_map['brands'] . '/' . $page_data['header_image'];
    }
    if ($page_data['show_header_image']) {
        $page_params['show_header_image']   = $page_data['show_header_image'];
    }
    if ($page_data['show_breadcrumb']) {
        $page_params['show_breadcrumb']   = $page_data['show_breadcrumb'];
    }
    if ($_defines['page'] == 'home') {
        $page_params['meta_url']    =   $_defines['domain'];
        $page_params['canonical']   =   $_defines['domain'];
    } else {
        $page_params['meta_url']    =   $_defines['domain'] . '/brands/' . $page_data['alias'];
        $page_params['canonical']   =   $_defines['domain'] . '/brands/' . $page_data['alias'];
    }

    $breadcrumb['title']        =   $_modules['brands']['title'];
    $breadcrumb['link']         =   $_defines['domain'] . '/brands/';
    $page_params['breadcrumb'][]            = $breadcrumb;
}
if ($_defines['page'] == 'brand.details' && isset($_GET['alias'])) {
    // print_r($_GET);die;
    $alias              = _strip_tags($_GET['alias']);
    $page_data          = _function_get('products', 'alias', $alias, '*');
    if (!$page_data) {
        // print_r("1");die;
        header('Location: ' . $_defines['domain'] . '/error');
        exit;
    }
    if ($page_data['status'] != 'T') {
        // print_r("2");die;
        header('Location: ' . $_defines['domain'] . '/error');
        exit;
    }
    $page_data['text']                      = $page_data['text'];
    $page_params['data']                    = $page_data;
    $page_params['meta_title']              = $page_data['title'];
    if ($page_data['meta_title']) {
        $page_params['meta_title']          = $page_data['meta_title'];
    }
    if ($page_data['meta_description']) {
        $page_params['meta_description']    = $page_data['meta_description'];
    }
    if ($page_data['meta_image']) {
        $page_params['meta_image']    = $page_data['meta_image'];
    }
    if ($page_data['meta_follow']) {
        $page_params['meta_follow']    = $page_data['meta_follow'];
    }
    if ($page_data['meta_index']) {
        $page_params['meta_index']    = $page_data['meta_index'];
    }
    if ($page_data['header_image']) {
        $page_params['header_image']    = $_upload_folders_map['brands'] . '/' . $page_data['header_image'];
    }
    if ($page_data['show_header_image']) {
        $page_params['show_header_image']   = $page_data['show_header_image'];
    }
    if ($page_data['show_breadcrumb']) {
        $page_params['show_breadcrumb']   = $page_data['show_breadcrumb'];
    }
    if ($_defines['page'] == 'home') {
        $page_params['meta_url']    =   $_defines['domain'];
        $page_params['canonical']   =   $_defines['domain'];
    } else {
        $page_params['meta_url']    =   $_defines['domain'] . '/brands/' . $page_data['alias'];
        $page_params['canonical']   =   $_defines['domain'] . '/brands/' . $page_data['alias'];
    }

    $breadcrumb['title']        =   $_modules['brands']['title'];
    $breadcrumb['link']         =   $_defines['domain'] . '/brands/';
    $page_params['breadcrumb'][]            = $breadcrumb;
}
if ($_defines['page'] == 'blog' && isset($_GET['alias'])) {
    $alias              = _strip_tags($_GET['alias']);
    $page_data          = _function_get('blog_categories', 'alias', $alias, '*');
    if (!$page_data) {
        header('Location: ' . $_defines['domain'] . '/error');
        exit;
    }
    if ($page_data['status'] != 'T') {
        header('Location: ' . $_defines['domain'] . '/error');
        exit;
    }
    $page_data['text']                      = $page_data['text'];
    $page_params['data']                    = $page_data;
    $page_params['meta_title']              = $page_data['title'];
    if ($page_data['meta_title']) {
        $page_params['meta_title']          = $page_data['meta_title'];
    }
    if ($page_data['meta_description']) {
        $page_params['meta_description']    = $page_data['meta_description'];
    }
    if ($page_data['meta_image']) {
        $page_params['meta_image']    = $page_data['meta_image'];
    }
    if ($page_data['meta_follow']) {
        $page_params['meta_follow']    = $page_data['meta_follow'];
    }
    if ($page_data['meta_index']) {
        $page_params['meta_index']    = $page_data['meta_index'];
    }
    if ($page_data['header_image']) {
        $page_params['header_image']    = $_upload_folders_map['blog_categories'] . '/' . $page_data['header_image'];
    }
    if ($page_data['show_header_image']) {
        $page_params['show_header_image']   = $page_data['show_header_image'];
    }
    if ($page_data['show_breadcrumb']) {
        $page_params['show_breadcrumb']   = $page_data['show_breadcrumb'];
    }
    if ($_defines['page'] == 'home') {
        $page_params['meta_url']    =   $_defines['domain'];
        $page_params['canonical']   =   $_defines['domain'];
    } else {
        $page_params['meta_url']    =   $_defines['domain'] . '/blog/category/' . $page_data['alias'];
        $page_params['canonical']   =   $_defines['domain'] . '/blog/category/' . $page_data['alias'];
    }

    $breadcrumb['title']        =   $page_params['data']['title'];
    $breadcrumb['link']         =   $_defines['domain'] . '/blog/' . $page_params['data']['alias'];
    $page_params['breadcrumb'][]            = $breadcrumb;
    
    $_block_source          = 'module';
    $_block_source_id       = $_modules['blog']['id'];
}
if ($_defines['page'] == 'product.details' && isset($_GET['alias'])) {
    $alias              = _strip_tags($_GET['alias']);
    $page_data          = _function_get('products', 'alias', $alias, '*');
    if (!$page_data) {
        header('Location: ' . $_defines['domain'] . '/error');
        exit;
    }
    if ($page_data['status'] != 'T') {
        header('Location: ' . $_defines['domain'] . '/error');
        exit;
    }
    $page_params['data']                    = $page_data;
    $page_params['meta_title']              = $page_data['title'];
    if ($page_data['meta_title']) {
        $page_params['meta_title']          = $page_data['meta_title'];
    }
    if ($page_data['meta_description']) {
        $page_params['meta_description']    = $page_data['meta_description'];
    }
    if ($page_data['meta_image']) {
        $page_params['meta_image']    = $page_data['meta_image'];
    }
    if ($page_data['meta_follow']) {
        $page_params['meta_follow']    = $page_data['meta_follow'];
    }
    if ($page_data['meta_index']) {
        $page_params['meta_index']    = $page_data['meta_index'];
    }
    if ($page_data['show_breadcrumb']) {
        $page_params['show_breadcrumb']   = $page_data['show_breadcrumb'];
    }
    if ($_defines['page'] == 'home') {
        $page_params['meta_url']    =   $_defines['domain'];
        $page_params['canonical']   =   $_defines['domain'];
    } else {
        $page_params['meta_url']    =   $_defines['domain'] . '/product/' . $page_data['alias'];
        $page_params['canonical']   =   $_defines['domain'] . '/product/' . $page_data['alias'];
    }

    $breadcrumb['title']        =   $_modules['products']['title'];
    $breadcrumb['link']         =   $_defines['domain'] . '/products/';
    $page_params['breadcrumb'][]            = $breadcrumb;
    $breadcrumb['title']        =   $page_params['data']['title'];
    $breadcrumb['link']         =   $_defines['domain'] . '/product/' . $page_params['data']['alias'];
    $page_params['breadcrumb'][]            = $breadcrumb;
    // print_r($page_params['breadcrumb']);die;
}
if ($_defines['page'] == 'blog.details' && isset($_GET['alias'])) {
    $alias              = _strip_tags($_GET['alias']);
    $page_data          = _function_get('blog', 'alias', $alias, '*');
    if (!$page_data) {
        header('Location: ' . $_defines['domain'] . '/error');
        exit;
    }
    if ($page_data['status'] != 'T') {
        header('Location: ' . $_defines['domain'] . '/error');
        exit;
    }
    $page_params['data']                    = $page_data;
    $page_params['meta_title']              = $page_data['title'];
    if ($page_data['meta_title']) {
        $page_params['meta_title']          = $page_data['meta_title'];
    }
    if ($page_data['meta_description']) {
        $page_params['meta_description']    = $page_data['meta_description'];
    }
    if ($page_data['meta_image']) {
        $page_params['meta_image']    = $page_data['meta_image'];
    }
    if ($page_data['meta_follow']) {
        $page_params['meta_follow']    = $page_data['meta_follow'];
    }
    if ($page_data['meta_index']) {
        $page_params['meta_index']    = $page_data['meta_index'];
    }
    if ($page_data['show_breadcrumb']) {
        $page_params['show_breadcrumb']   = $page_data['show_breadcrumb'];
    }
    if ($_defines['page'] == 'home') {
        $page_params['meta_url']    =   $_defines['domain'];
        $page_params['canonical']   =   $_defines['domain'];
    } else {
        $page_params['meta_url']    =   $_defines['domain'] . '/blog/' . $page_data['alias'];
        $page_params['canonical']   =   $_defines['domain'] . '/blog/' . $page_data['alias'];
    }

    $breadcrumb['title']        =   $_modules['blog']['title'];
    $breadcrumb['link']         =   $_defines['domain'] . '/blog/';
    $page_params['breadcrumb'][]            = $breadcrumb;
    $breadcrumb['title']        =   $page_params['data']['title'];
    $breadcrumb['link']         =   $_defines['domain'] . '/blog/' . $page_params['data']['alias'];
    $page_params['breadcrumb'][]            = $breadcrumb;
    // print_r($page_params['breadcrumb']);die;
}
if ($_defines['page'] == 'services.details' && isset($_GET['alias'])) {
    $alias              = _strip_tags($_GET['alias']);
    $page_data          = _function_get('services', 'alias', $alias, '*');
    if (!$page_data) {
        header('Location: ' . $_defines['domain'] . '/error');
        exit;
    }
    if ($page_data['status'] != 'T') {
        header('Location: ' . $_defines['domain'] . '/error');
        exit;
    }
    $page_params['data']                    = $page_data;
    $page_params['meta_title']              = $page_data['title'];
    if ($page_data['meta_title']) {
        $page_params['meta_title']          = $page_data['meta_title'];
    }
    if ($page_data['meta_description']) {
        $page_params['meta_description']    = $page_data['meta_description'];
    }
    if ($page_data['meta_image']) {
        $page_params['meta_image']    = $page_data['meta_image'];
    }
    if ($page_data['meta_follow']) {
        $page_params['meta_follow']    = $page_data['meta_follow'];
    }
    if ($page_data['meta_index']) {
        $page_params['meta_index']    = $page_data['meta_index'];
    }
    if ($page_data['show_breadcrumb']) {
        $page_params['show_breadcrumb']   = $page_data['show_breadcrumb'];
    }
    if ($_defines['page'] == 'home') {
        $page_params['meta_url']    =   $_defines['domain'];
        $page_params['canonical']   =   $_defines['domain'];
    } else {
        $page_params['meta_url']    =   $_defines['domain'] . '/services/' . $page_data['alias'];
        $page_params['canonical']   =   $_defines['domain'] . '/services/' . $page_data['alias'];
    }
    $breadcrumb['title']        =   $_modules['services']['title'];
    $breadcrumb['link']         =   $_defines['domain'] . '/services/';
    $page_params['breadcrumb'][]            = $breadcrumb;

    $breadcrumb['title']        =   $page_params['data']['title'];
    $breadcrumb['link']         =   $_defines['domain'] . '/services/' . $page_params['data']['alias'];
    $page_params['breadcrumb'][]            = $breadcrumb;
}
if ($_defines['page'] == 'services' && isset($_GET['alias'])) {
    $alias              = _strip_tags($_GET['alias']);
    $page_data          = _function_get('services', 'alias', $alias, '*');
    if (!$page_data) {
        header('Location: ' . $_defines['domain'] . '/error');
        exit;
    }
    if ($page_data['status'] != 'T') {
        header('Location: ' . $_defines['domain'] . '/error');
        exit;
    }
    $page_params['data']                    = $page_data;
    $page_params['meta_title']              = $page_data['title'];
    if ($page_data['meta_title']) {
        $page_params['meta_title']          = $page_data['meta_title'];
    }
    if ($page_data['meta_description']) {
        $page_params['meta_description']    = $page_data['meta_description'];
    }
    if ($page_data['meta_image']) {
        $page_params['meta_image']    = $page_data['meta_image'];
    }
    if ($page_data['meta_follow']) {
        $page_params['meta_follow']    = $page_data['meta_follow'];
    }
    if ($page_data['meta_index']) {
        $page_params['meta_index']    = $page_data['meta_index'];
    }
    if ($page_data['show_breadcrumb']) {
        $page_params['show_breadcrumb']   = $page_data['show_breadcrumb'];
    }
    if ($_defines['page'] == 'home') {
        $page_params['meta_url']    =   $_defines['domain'];
        $page_params['canonical']   =   $_defines['domain'];
    } else {
        $page_params['meta_url']    =   $_defines['domain'] . '/services/' . $page_data['alias'];
        $page_params['canonical']   =   $_defines['domain'] . '/services/' . $page_data['alias'];
    }

    $breadcrumb['title']        =   $page_params['data']['title'];
    $breadcrumb['link']         =   $_defines['domain'] . '/services/' . $page_params['data']['alias'];
    $page_params['breadcrumb'][]            = $breadcrumb;
}
if (isset($_block_source) && isset($page_data)) {
    if ($_block_source == 'module') {
        $sql_blocks     = "SELECT * FROM `blocks` WHERE `status` = 'T' AND FIND_IN_SET(" . $_block_source_id . ", `show_in_module_ids`) ORDER BY `ordering` ";
    } else if ($_block_source == 'page') {
        $sql_blocks     = "SELECT * FROM `blocks` WHERE `status` = 'T' AND FIND_IN_SET(" . $_block_source_id . ", `show_in_page_ids`) ORDER BY `ordering` ";
    }
}
if (isset($sql_blocks)) {
    //BLOCKS
    $_blocks    =   [];
    $result_blocks  = $mysqli->query($sql_blocks);
    $total_blocks   = $result_blocks->num_rows;
    if ($total_blocks > 0) {
        while ($block = $result_blocks->fetch_assoc()) {
            $_blocks[$block['position']][]  =   $block;
        }
    }
    //BLOCKS
}
?>
<script>
    var page_alias = '<?php echo isset($_GET['alias']) ? $_GET['alias'] : '' ?>';
</script>
<title><?php echo $page_params['meta_title'] ?></title>
<link rel="canonical" href="<?php echo $page_params['canonical'] ?>">

<meta name="description" content="<?php echo $page_params['meta_description'] ?>">
<base href="<?php echo $_defines['domain'] ?>/">
<meta property="og:title" content="<?php echo $page_params['meta_title'] ?>" />
<meta property="og:url" content="<?php echo $page_params['meta_url'] ?>" />
<meta property="og:type" content="website" />
<meta property="og:image" content="<?php echo $_upload_folders_map['config'] . '/' . $page_params['meta_image'] ?>" />
<meta property="og:description" content="<?php echo $page_params['meta_description'] ?>" />
<meta property="og:site_name" content="<?php echo $_config['site_title'] ?>" />
<?php
$meta_index_follow   = [];
$meta_index_follow[] = $page_params['meta_index'];
$meta_index_follow[] = $page_params['meta_follow'];
?>
<meta name="robots" content="<?php echo implode(',', $meta_index_follow); ?>" />
<meta name="googlebot" content="<?php echo implode(',', $meta_index_follow); ?>">
<link rel="dns-prefetch" href="<?php echo $_defines['domain'] ?>">