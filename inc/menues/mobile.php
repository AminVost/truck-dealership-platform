<?php
$menu_items =   _menu_tree('mobile');
if (count($menu_items)) {
?>
    <nav class="mobile-main-navigation  clearfix ul-li">
        <ul id="m-main-nav" class="navbar-nav text-capitalize clearfix">
            <?php
            foreach ($menu_items as $item) {
                $item_childs    = false;
                $ul_class       = null;
                $li_class       = null;
                if (isset($item['childs']) && count($item['childs'])) {
                    $item_childs    = true;
                    $ul_class   = 'dropdown-menu clearfix';
                    $li_class   = 'dropdown';
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
    </nav>ّ
<?php } ?>





<!-- <nav class="mobile-main-navigation  clearfix ul-li">
    <ul id="m-main-nav" class="navbar-nav text-capitalize clearfix">
        <li class="dropdown">
            <a href="https://html.themexriver.com/fastrans/!#">Home</a>
            <ul class="dropdown-menu clearfix">
                <li><a href="index-1.html">Home Page 1</a></li>
                <li><a href="index-2.html">Home Page 2</a></li>
                <li><a href="index-3.html">Home Page 3</a></li>
            </ul>
        </li>
        <li><a href="about.html">About</a></li>
        <li class="dropdown">
            <a href="https://html.themexriver.com/fastrans/!#">Service</a>
            <ul class="dropdown-menu clearfix">
                <li><a href="service.html">Service Page </a></li>
                <li><a href="service-single.html">Service Details</a></li>
            </ul>
        </li>
        <li class="dropdown">
            <a href="https://html.themexriver.com/fastrans/!#">Project</a>
            <ul class="dropdown-menu clearfix">
                <li><a href="project.html">Services</a></li>
                <li><a href="project-single.html">Team Page</a></li>
            </ul>
        </li>
        <li class="dropdown">
            <a href="https://html.themexriver.com/fastrans/!#">News</a>
            <ul class="dropdown-menu clearfix">
                <li><a href="blog.html">News </a></li>
                <li><a href="blog-single.html">News Details</a></li>
            </ul>
        </li>
        <li class="dropdown">
            <a href="https://html.themexriver.com/fastrans/!#">Others</a>
            <ul class="dropdown-menu clearfix">
                <li><a href="team.html">Team Page </a></li>
                <li><a href="team-single.html">Team Details </a></li>
                <li><a href="coming-soon.html">Coming Soon</a></li>
                <li><a href="faq.html">Faq Page</a></li>
                <li><a href="contact.html">Contact Page</a></li>
                <li><a href="pricing.html">Pricing Page</a></li>
            </ul>
        </li>
    </ul>
</nav> -->