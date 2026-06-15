<?php if ($_config['show_header_image'] == 'T') {
	if ($page_params['show_breadcrumb'] == 'T') { ?>
		<section id="ft-breadcrumb" class="ft-breadcrumb-section position-relative" data-background="<?php echo $_upload_folders_map['config'] . 'breadcrumb.jpg' ?>">
			<span class="background_overlay"></span>
			<span class="design-shape position-absolute"><img src="img/shape/tmd-sh.png" alt=""></span>
			<div class="container">
				<div class="ft-breadcrumb-content headline text-center position-relative">
					<h2><?php echo $page_data['title'] ?></h2>
					<div class="ft-breadcrumb-list ul-li">
						<ul>
							<?php foreach ($page_params['breadcrumb'] as $breadcrumb) { ?>
								<li>
									<a href="<?php echo $breadcrumb['link'] ?>">
									<?php echo $breadcrumb['title'] ?>
							</a>
						</li>
							<?php } ?>
						</ul>
					</div>
				</div>
			</div>
		</section>
<?php }
} ?>