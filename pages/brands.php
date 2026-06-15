
<?php
    $my_domain      = $_defines['domain'];
    $condition      = "";
    $query          = "`brands` WHERE `status` = 'T'";
    $tag_id         = null;
    $category_id    = null;
    $pagination_alias = "";
    $link = "";
    $alias = "";

    if (isset($_GET['alias'])) {
        // print_r($_GET);die;
        $alias          = _strip_tags($_GET['alias']);
        $alias          = str_replace('/', '', $alias);
        $brand          = _function_get('brands', 'alias', $alias, '*');
        $brand_id    = $brand['id'];
        $condition      = " AND `brand_id` = $brand_id ";
        $pagination_alias = "/$alias";
        $query          = "`products` WHERE `status` = 'T' $condition ";
    }
    $page       = (int)(!isset($_GET["page"]) ? 1 : $_GET["page"]);
    if ($page <= 0) $page = 1;
    $per_page   = $_defines['pagination']['products'];
    $startpoint = ($page * $per_page) - $per_page;
    $statement  = $query;
    $statement .= " ORDER BY `ordering` ";
    $sql        = "SELECT * FROM {$statement} LIMIT {$startpoint}, {$per_page}";
    // print_r($sql);die;
    $result     = $mysqli->query($sql);
    $total      = $result->num_rows;
    ?>
<div class="page-content">
    <div class="container">
        <?php

        if (isset($_GET['alias'])) {
            include_once(ROOT . 'inc/includes/products.php');
        } else {
            include_once(ROOT . 'inc/includes/brands.php');
        } ?>
    </div>
</div>