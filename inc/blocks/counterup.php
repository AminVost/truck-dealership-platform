<?php
$sql = "select * from `block_statistics` where `block_id` = '$_block_id' AND `status` = 'T' order by `ordering`";
$result = $mysqli->query($sql);
$total = $result->num_rows;
if ($total > 0) {

?>
    <section id="ft-counterup" class="ft-counterup-section position-relative">
        <div class="container">
            <div class="ft-counterup-content">
                <div class="row">
                    <?php while ($counter = $result->fetch_assoc()) { ?>
                        <div class="col-lg-3 col-md-6">
                            <div class="ft-counterup-innerbox d-flex align-items-center position-relative">
                                <div class="ft-counterup-icon d-flex align-items-center justify-content-center">
                                    <i class="<?php echo $counter['icon'] ?>"></i>
                                </div>
                                <div class="ft-counterup-text headline pera-content">
                                    <h3><span class="counter"><?php echo $counter['count'] ?></span>k</h3>
                                    <p>
                                        <?php echo $counter['sub_title'] ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </section>
<?php } ?>