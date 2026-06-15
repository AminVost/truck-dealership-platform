<div class="modal fade p-0" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content order">
            <div class="modal-body">
                <section class="ft-why-choose-section-2 position-relative modal-order">
                    <div class="container">
                        <div class="ft-why-choose-content-2">
                            <div class="row justify-content-center">
                                <div class="col-lg-8">
                                    <div class="ft-why-choose-form-wrapper">
                                        <div class="ft-why-choose-form pera-content">
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            <form class="my-form-modal" method="POST" action="<?php echo $_defines['domain'] ?>/api/contact.php">
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
                                                                    $sql_services = "select * from `services` where `status` = 'T' order by `ordering`";
                                                                    $result_services = $mysqli->query($sql_services);
                                                                    $total_services = $result_services->num_rows;
                                                                    if ($total_services > 0) {
                                                                        while ($service = $result_services->fetch_assoc()) {
                                                                    ?>
                                                                            <option value="<?php echo $service['id'] ?>">
                                                                                <?php echo $service['title'] ?>
                                                                            </option>
                                                                    <?php }
                                                                    } ?>
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
                                                                    <option value="<?php echo _translate('sayer_brand_form') ?>">
                                                                        <?php echo _translate('sayer_brand_form') ?>
                                                                    </option>
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
            </div>
        </div>
    </div>
</div>