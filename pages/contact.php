<section id="ft-contact-page" class="ft-contact-page-section page-padding">
    <div class="container">
        <div class="ft-contact-page-content">
            <div class="ft-section-title-2 headline pera-content">
                <span class="sub-title"></span>
                <?php echo $page_data['title'] ?>
                </span>
                <h2>
                    <?php echo $page_data['text'] ?>
                </h2>
            </div>
            <div class="row">
                <div class="col-lg-6 wow fadeInRight" data-wow-delay="0.3ms" data-wow-duration="2000ms">
                    <div class="ft-contact-page-text-wrapper">

                        <div class="ft-contact-page-contact-info">
                            <div class="ft-contact-cta-items d-flex">
                                <div class="ft-contact-cta-icon d-flex align-items-center justify-content-center">
                                    <i class="fal fa-map-marker-alt"></i>
                                </div>
                                <div class="ft-contact-cta-text headline pera-content">
                                    <h3>
                                        <?php echo _translate('contact_address') ?>
                                    </h3>
                                    <p>
                                        <?php echo $_config['contact_address'] ?>
                                    </p>
                                </div>
                            </div>
                            <div class="ft-contact-cta-items d-flex">
                                <div class="ft-contact-cta-icon d-flex align-items-center justify-content-center">
                                    <i class="fas fa-phone-alt"></i>
                                </div>
                                <div class="ft-contact-cta-text headline pera-content">
                                    <h3>
                                        <?php echo _translate('contact_mobile')  ?>
                                    </h3>
                                    <a href="tel:<?php echo $_config['contact_mobile'] ?>">
                                        <?php echo $_config['contact_mobile'] ?>
                                    </a>
                                </div>
                            </div>
                            <div class="ft-contact-cta-items d-flex">
                                <div class="ft-contact-cta-icon d-flex align-items-center justify-content-center">
                                    <i class="far fa-envelope"></i>
                                </div>
                                <div class="ft-contact-cta-text headline pera-content">
                                    <h3>
                                        <?php echo _translate('contact_email') ?>
                                    </h3>
                                    <a href="mailto:<?php echo $_config['contact_email'] ?>">
                                        <?php echo $_config['contact_email'] ?>
                                    </a>
                                </div>
                            </div>
                            <div class="container-socials">
                                <?php foreach ($social_array as $social) { ?>
                                    <a href="<?php echo $social['link'] ?>" class="icon-button twitter" target="_blank">
                                        <i class="<?php echo $social['icon'] ?>"></i>
                                        <span></span>
                                    </a>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 wow fadeInLeft" data-wow-delay="0.3ms" data-wow-duration="2000ms">
                    <div class="ft-contact-page-form-wrapper headline">
                        <?php if (isset($_POST['product_id'])) {
                            $order_product_id = intval($_POST['product_id']);
                            $sql_make_order = "SELECT * FROM `products` WHERE `id` = $order_product_id AND `status` = 'T' ORDER BY `ordering`";
                            $result_order_product = $mysqli->query($sql_make_order);
                            $total_order = $result_order_product->num_rows;
                            $product_order = $result_order_product->fetch_assoc();
                        ?>
                            <h3 class="text-center order-title">
                                <a href="<?php echo $_defines['domain'] . '/brand/' . $product_order['alias'] ?>">
                                    <?php echo _translate('order_title_part1') . "&nbsp" . "<span class='span-order'>" . $product_order['title'] . "</span>" . "&nbsp" . _translate('order_title_part2') ?>
                                </a>
                            </h3>
                        <?php } else { ?>
                            <h3 class="text-center">
                                <?php echo _translate('contact_form_title') ?>
                            </h3>
                        <?php } ?>
                        <form class="my-form-contact" method="POST" action="<?php echo $_defines['domain'] ?>/api/contact.php">
                            <div class="row">
                                <div class="col-lg-6">
                                    <input type="text" name="order_name" id="order_name" placeholder="<?php echo _translate('placeholder_contact_name') ?>" required>
                                </div>
                                <div class="col-lg-6">
                                    <input type="email" name="order_email" name="order_email" placeholder="<?php echo _translate('placeholder_contact_email') ?>" required>
                                </div>
                                <div class="col-lg-6">
                                    <input type="tel" name="order_phone" id="order_phone" minlength="8" placeholder="<?php echo _translate('placeholder_contact_phone') ?>" required>
                                </div>
                                <div class="col-lg-6">
                                    <?php if (isset($_POST['product_id'])) { ?>
                                        <input type="text" name="order_subject" id="order_subject" value="<?php echo _translate('placeholder_subject_order') ." ". $product_order['title'] ?>" required>
                                    <?php } else { ?>
                                        <input type="text" name="order_subject" id="order_subject" placeholder="<?php echo _translate('placeholder_contact_subject') ?>" required>
                                    <?php } ?>
                                </div>
                                <div class="col-lg-12">
                                    <textarea name="order_msg" id="order_msg" placeholder="<?php echo _translate('placeholder_contact_msg') ?>" required></textarea>
                                </div>
                                <div class="col-lg-12">
                                    <button type="submit">
                                        <?php echo _translate('contact_form_submit') ?>
                                    </button>
                                </div>
                            </div>
                            <?php if (isset($_POST['product_id'])) {
                                $product_id = intval($_POST['product_id']);
                                echo $product_id;
                            ?>
                                <input type="hidden" id="product_id" name="product_id" value="<?php echo $product_id ?>">
                                <input type="hidden" name="order_service" id="order_service" value="Null">
                            <?php } ?>
                            <input type="hidden" id="order_recaptcha" name="order_recaptcha" class="g-recaptcha">
                            <script>
                                grecaptcha.ready(function() {
                                    grecaptcha.execute('<?php echo $_captcha['client-key'] ?>', {
                                        action: 'event'
                                    }).then(function(token) {
                                        var recaptchaResponse = document.getElementById('order_recaptcha');
                                        recaptchaResponse.value = token;
                                    });
                                });
                            </script>
                        </form>
                    </div>
                </div>
            </div>
            <?php if (isset($_config['map_lat'])) { ?>
                <div class="google-map wow fadeInUp">
                    <div id="map"></div>
                    <script>
                        var map = L.map('map').setView([<?php echo $_config['map_lat'] ?>, <?php echo $_config['map_long'] ?>], 13);
                        L.tileLayer('https://api.maptiler.com/maps/outdoor/{z}/{x}/{y}.png?key=2zs8OwKmCXj6KKqe4f1k', {
                            attribution: '<a href="https://www.maptiler.com/copyright/" target="_blank">&copy; MapTiler</a> <a href="https://www.openstreetmap.org/copyright" target="_blank">&copy; OpenStreetMap contributors</a>'
                        }).addTo(map);
                        var marker = L.marker([<?php echo $_config['map_lat'] ?>, <?php echo $_config['map_long'] ?>]).addTo(map);
                        var circle = L.circle([<?php echo $_config['map_lat'] ?>, <?php echo $_config['map_long'] ?>], {
                            color: 'red',
                            fillColor: '#f03',
                            fillOpacity: 0.5,
                            radius: 500
                        }).addTo(map);
                        // map.locate({
                        //     setView: true,
                        //     maxZoom: 16
                        // });
                    </script>

                </div>
            <?php } ?>
        </div>
    </div>
</section>