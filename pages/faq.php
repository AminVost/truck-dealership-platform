<?php
$sql = "select * from `faq` where `status` = 'T' order by `ordering`";
$result = $mysqli->query($sql);
$total = $result->num_rows;
if ($total > 0) {
?>
    <section id="ft-faq-page" class="ft-faq-page-section page-padding">
        <div class="container">
            <div class="ft-faq-page-top-content d-flex justify-content-between align-items-end flex-wrap">
                <div class="ft-section-title-2 headline pera-content">
                    <span>
                        <?php echo $_config['site_title'] ?>
                    </span><br>
                    <h2>

                        <?php echo _translate('faq_page_title') ?>

                    </h2>
                </div>
            </div>
            <div class="ft-faq-content">
                <div class="row justify-content-center">
                    <div class="col-lg-10">
                        <div class="accordion" id="accordionExample">
                            <?php while ($faq = $result->fetch_assoc()) { ?>
                                <div class="accordion-item headline pera-content wow fadeInUp" data-wow-delay="0.3ms" data-wow-duration="2000ms">
                                    <h2 class="accordion-header" id="headingOne">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?php echo $faq['id'] ?>" aria-expanded="false" aria-controls="collapse<?php echo $faq['id'] ?>">
                                            <?php echo $faq['question'] ?>
                                        </button>
                                    </h2>
                                    <div id="collapse<?php echo $faq['id'] ?>" class="accordion-collapse collapsed collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <p>
                                                <?php echo $faq['answers'] ?>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php } ?>