<section id="soal" class="ft-why-choose-section-2 position-relative" data-anchor="soal">
    <span class="why-choose-bg-2"><img src="img/bg/wc-bg2.jpg" alt=""></span>
    <span class="why-choose-img-2 position-absolute wow fadeInLeft" data-wow-delay="0ms" data-wow-duration="1500ms">
        <img src="<?php echo $_upload_folders_map['blocks'] . $_block['image_extra'] ?>" alt="<?php echo $_block['title'] ?>">
    </span>
    <div class="container">
        <div class="ft-why-choose-content-2">
            <div class="row">
                <div class="col-lg-5 wow fadeInRight" data-wow-delay="0.3ms" data-wow-duration="1500ms">
                    <div class="ft-why-choose-text-2">
                        <div class="ft-section-title-3 headline">
                            <span class="text-uppercase">
                                <?php echo $_block['sub_title'] ?>
                            </span>
                            <h2>
                                <?php echo $_block['title'] ?>
                            </h2>
                        </div>
                        <div class="ft-why-choose-list-wrapper ul-li-block">
                            <p>
                                <?php echo $_block['text'] ?>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7 wow fadeInLeft" data-wow-delay="0.3ms" data-wow-duration="1500ms">
                    <div class="ft-why-choose-form-wrapper">
                        <div class="ft-why-choose-form pera-content">
                            <form class="my-form-home" method="POST" action="<?php echo $_defines['domain'] ?>/api/contact.php">
                            <input type="hidden" name="form_type" id="form_type" value="order">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="wc-input">
                                            <span><?php echo _translate('form_choose_service') ?></span>
                                            <div class="wc-select position-relative">
                                                <select name="order_service" id="order_service" required>
                                                    <option value="" disabled selected required>
                                                        <?php echo _translate("form_option_1") ?>
                                                    </option>
                                                    <?php
                                                    $sql = "select * from `services` where `status` = 'T' order by `ordering`";
                                                    $result = $mysqli->query($sql);
                                                    $total = $result->num_rows;
                                                    if ($total > 0) {
                                                        while ($service = $result->fetch_assoc()) {
                                                    ?>
                                                            <option value="<?php echo $service['id'] ?>">
                                                                <?php echo $service['title'] ?>
                                                            </option>
                                                    <?php }
                                                    } ?>
                                                    <option value="<?php echo _translate('form_option_5') ?>">
                                                        <?php echo _translate("form_option_5") ?>
                                                    </option>
                                                </select>
                                                
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="wc-input">
                                            <span>
                                                <?php echo _translate("form_brands") ?>
                                            </span>
                                            <div class="wc-select position-relative">
                                                <select name="order_brand" required>
                                                    <option value="" disabled required>
                                                        <?php echo _translate('form_choose_brand_placeholder') ?>
                                                    </option>
                                                    <?php
                                                    $sql = "select * from `brands` where `status` = 'T' order by `ordering`";
                                                    $result = $mysqli->query($sql);
                                                    $total = $result->num_rows;
                                                    if ($total > 0) {
                                                        while ($brand = $result->fetch_assoc()) {

                                                    ?>
                                                            <option value="<?php echo $brand['title'] ?>">
                                                                <?php echo $brand['title'] ?>
                                                            </option>
                                                    <?php }
                                                    } ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="wc-input">
                                            <span>
                                                <?php echo _translate("form_truck_name") ?>
                                            </span>
                                            <span class="input-optional">
                                                <?php echo _translate("optional") ?>
                                            </span>
                                            <div class="position-relative">
                                                <input type="text" name="order_truckname" id="order_truckname" placeholder="<?php echo _translate('form_truck_name_placeholder') ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="wc-input">
                                            <span>
                                                <?php echo _translate("form_email_order") ?>
                                            </span>
                                            <span class="input-optional">
                                                <?php echo _translate("optional") ?>
                                            </span>
                                            <div class="position-relative">
                                                <input type="email" name="order_email" id="order_email" placeholder="<?php echo _translate('form_email_placeholder') ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="wc-input">
                                            <span>
                                                <?php echo _translate("form_name") ?>
                                            </span>
                                            <div class="wc-text-input position-relative">
                                                <input type="text" name="order_name" id="order_name" placeholder="<?php echo _translate('place_holder_name_form') ?>" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="wc-input">
                                            <span>
                                                <?php echo _translate('form_number') ?>
                                            </span>
                                            <div class="wc-text-input position-relative">
                                                <input type="tel" name="order_phone" id="order_phone" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" minlength="8" placeholder="<?php echo _translate('form_place_holder_number') ?>" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="wc-input">
                                            <span>
                                                <?php echo _translate('form_text_area') ?>
                                            </span>
                                            <div class="wc-texterea position-relative">
                                                <textarea name="order_msg" id="order_msg" placeholder="<?php echo _translate('form_place_holder_textarea') ?>" required></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button class="text-uppercase" type="submit">
                                    <?php echo _translate('button_form_home') ?>
                                </button>
                                <input type="hidden" id="order_recaptcha" name="order_recaptcha" class="g-recaptcha">
                                <input type="hidden" name="product_id" id="product_id" value="Null">
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
            </div>
        </div>
    </div>
</section>