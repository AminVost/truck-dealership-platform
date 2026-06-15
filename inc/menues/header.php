<?php
$menu_items =   _menu_tree('header');
if (count($menu_items)) {
?>
            <nav class="ft-main-navigation clearfix ul-li">
                <ul id="ft-main-nav" class="nav navbar-nav clearfix">
                    <?php
                    foreach ($menu_items as $item) {
                        $item_childs    = false;
                        $ul_class       = null;
                        $li_class       = null;
                        if (isset($item['childs']) && count($item['childs'])) {
                            $item_childs    = true;
                            $li_class       = 'dropdown';
                            $ul_class   = 'dropdown-menu clearfix';
                        }
                    ?>
                        <li class="<?php echo $li_class ?>">
                            <a href="<?php echo $item['link']['link'] ?>">
                                <?php echo $item['title'] ?>
                            </a>
                            <?php if ($item_childs) { ?>
                                <ul class="<?php echo $ul_class ?>">
                                    <?php
                                    foreach ($item['childs'] as $item_sub) {
                                        $item_sub_childs    = false;
                                        if (isset($item_sub['childs']) && count($item_sub['childs'])) {
                                            $item_sub_childs    = true;
                                            $ul_sub_child = "level-menu";
                                        }
                                    ?>
                                        <li>
                                            <a href="<?php echo $item_sub['link']['link'] ?>">
                                                <?php echo $item_sub['title'] ?><?php if ($item_sub_childs) { ?><i class="fi-rs-angle-right"></i><?php } ?>
                                            </a>
                                            <?php if ($item_sub_childs) { ?>
                                                <ul class="<?php echo $ul_sub_child ?>">
                                                    <?php foreach ($item_sub['childs'] as $item_sub_sub) { ?>
                                                        <li>
                                                            <a href="<?php echo $item_sub_sub['link']['link'] ?>">
                                                                <?php echo $item_sub_sub['title'] ?>
                                                            </a>
                                                        </li>
                                                    <?php } ?>
                                                </ul>
                                            <?php } ?>
                                        </li>
                                    <?php } ?>
                                </ul>
                            <?php } ?>
                        </li>
                    <?php } ?>
                </ul>
            </nav>
<?php } ?>

