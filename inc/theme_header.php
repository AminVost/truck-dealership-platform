<header id="ft-header" class="ft-header-section header-style-three">
    <div class="container">
        <div class="ft-header-content position-relative">
            <div class="ft-header-top d-flex justify-content-end ul-li">
                <ul>
                    <li><i class="fas fa-map-marker-alt"></i>
                        <?php echo $_config['contact_address'] ?>
                    </li>
                    <li><i class="fas fa-clock"></i>
                        <?php echo $_config['contact_working_days'] ?>
                    </li>
                    <li><i class="fas fa-phone"></i> <?php echo $_config['contact_mobile'] ?></li>
                </ul>
            </div>
            <div class="ft-header-main-menu d-flex align-items-center justify-content-between">
                <div class="ft-brand-logo ">
                    <a href="<?php echo $_defines['domain'] ?>">
                        <img src="<?php echo  $_upload_folders_map['config'] . $_config['site_logo'] ?>" alt="<?php echo $_config['site_title'] ?>"></a>
                </div>
                <div class="ft-header-main-menu-cta  d-flex align-items-center ">
                    <div class="mobile_menu_button open_mobile_menu">
                        <i class="fal fa-bars"></i>
                    </div>
                    <?php include(ROOT . "inc/menues/header.php")  ?>
                    <?php if ($_defines['page'] == 'home') { ?>
                        <div class="ft-header-cta-btn">
                            <a class="d-flex justify-content-center align-items-center" href="#soal" data-menuanchor="soal">
                                <?php echo _translate('service_request_buttun') ?>
                            </a>
                        </div>
                    <?php } else { ?>
                        <div class="ft-header-cta-btn">
                            <a class="d-flex justify-content-center align-items-center" type="button" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                <?php echo _translate('service_request_buttun') ?>
                            </a>
                        </div>
                    <?php } ?>
                </div>

            </div>

            <div class="mobile_menu position-relative ">
                <div class="mobile_menu_wrap">
                    <div class="mobile_menu_overlay open_mobile_menu"></div>
                    <div class="mobile_menu_content">
                        <div class="mobile_menu_close open_mobile_menu">
                            <i class="fal fa-times"></i>
                        </div>
                        <div class="m-brand-logo">
                            <a href="<?php echo $_defines['domain'] ?>"><img src="<?php echo $_upload_folders_map['config'] . $_config['site_logo'] ?>" alt="<?php echo $_config['site_title'] ?>"></a>
                        </div>

                        <?php include(ROOT . "inc/menues/mobile.php")  ?>
                    </div>
                </div>
                <!-- /Mobile-Menu -->
            </div>
        </div>
    </div>
</header>