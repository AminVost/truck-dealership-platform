<?php
if (isset($_block_position) && isset($_blocks[$_block_position]) && count($_blocks[$_block_position])) {
    foreach ($_blocks[$_block_position] as $_block) {
        $_block_id      = $_block['id'];
        $_block_link    = _menu($_block['button_page_id'] , $_block['button_module_id'] , $_block['button_service_id'] , $_block['button_brand_id'] , $_block['button_url']);
        $_block_image   =   null;
        if ($_block['image']) {
            $_block_image =   $_upload_folders_map['blocks'] . '/' . $_block['image'];
        }
?>
        <?php require(ROOT . 'inc/blocks/' . $_block['type'] . '.php'); ?>
<?php
    }
} ?>