<?php get_header();?>
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/css/event.css">
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/css/news.css">
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/css/perform.css">
<style>
	.post-part {
		margin-bottom: 2em;
	}
</style>
<div class="main-content">
	<?php
		if ( have_posts() ) {
	?>
	<div class="page-notice"></div>
	<section class="post-content inner">
		<div class="post-list">
			<?php
			while ( have_posts() ) {
				the_post();
				$images = acf_photo_gallery('gallery',$post->ID);
				$slide_count = count($images);
				if (get_post_type() == "news") {?>
					<div class="post-part" data-aos="fade-up">
						<div class="subtitle">
							<?php the_title()?>
						</div>
						<div class="post-date">
							<?php the_date('Y年m月d日');?>
						</div>
						<?php if( $images ) { ?>
							<div class="swiper-content">
								<?php if($slide_count > 1) {?>
								<div class="swiper-container zoom-Swiper swiper-<?php echo $post->ID?>">
									<div class="swiper-wrapper">
										<?php foreach( $images as $image ): ?>
										<div class="swiper-slide">
											<img src="<?php echo $image['full_image_url']; ?>" />
										</div>
										<?php endforeach; ?>
									</div>
								</div>
								<div class="thumb-content">
									<div thumbsSlider="" class="swiper-container thumb-swiper thumb-<?php echo $post->ID?>">
										<div class="swiper-wrapper">
										<?php foreach( $images as $image ): ?>
											<div class="swiper-slide">
												<img src="<?php echo $image['full_image_url']; ?>" />
											</div>
										<?php endforeach; ?>
										</div>
									</div>
									<div class="swiper-button-next next-<?php echo $post->ID?>">
										<img src="<?php echo get_template_directory_uri(); ?>/assets/images/common/next.svg" alt="">
									</div>
									<div class="swiper-button-prev prev-<?php echo $post->ID?>">
										<img src="<?php echo get_template_directory_uri(); ?>/assets/images/common/prev.svg" alt="">
									</div>
								</div>
								<?php } else {?>
									<img src="<?php echo $images[0]['full_image_url']; ?>" class="single_image" alt="">
								<?php }?>
							</div>
						<?php }?>
						<div class="post-text">
								<?php
									$publisher = get_post_meta( get_the_ID(), '版元', true);
									if( !empty( $publisher ) ) {
									echo '［版元］ ' . $publisher;
									}
								?><br>
								<?php
									$supervised = get_post_meta( get_the_ID(), '監修', true);
									if( !empty( $supervised ) ) {
										echo '［監修］ ' . $supervised;
									}
								?><br>
								<?php
									$writing = get_post_meta( get_the_ID(), '執筆', true);
									if( !empty( $writing ) ) {
										echo '［執筆］ ' . $writing;
									}
								?><br>
							［刊行］	<?php the_time('Y年m月d日'); ?><br>
								<?php
									$price = get_post_meta( get_the_ID(), '定価', true);
									if( !empty( $price ) ) {
										echo '［定価］ ' . $price . '円＋税';
									}
								?><br>
								<?php
									$charge = get_post_meta( get_the_ID(), '担当ページ', true);
									if( !empty( $charge ) ) {
										echo '［担当ページ］ ' . $charge;
									}
								?><br><br>
								<?php the_content(); ?>
						</div>
					</div>
					<?php if($slide_count > 1) {?>
					<script>
						var thumb_<?php echo $post->ID?> = new Swiper(".thumb-<?php echo $post->ID?>", {
							spaceBetween: 10,
							slidesPerView: 4,
							freeMode: false,
							watchSlidesVisibility: true,
							watchSlidesProgress: true,
							breakpoints: {
								200: {
									slidesPerView: 2,
								},
								769: {
									slidesPerView: 4,
									spaceBetween: 10
								}
							}
						});
						var swiper_<?php echo $post->ID?> = new Swiper(".swiper-<?php echo $post->ID?>", {
							spaceBetween: 25,
							navigation: {
								nextEl: ".next-<?php echo $post->ID?>",
								prevEl: ".prev-<?php echo $post->ID?>",
							},
							thumbs: {
								swiper: thumb_<?php echo $post->ID?>,
							},
						});
					</script>
					<?php }?>
				<?php } else if (get_post_type() == "event") {?>
					<div class="post-part" data-aos="fade-up">
						<div class="subtitle">
							<?php the_title()?>
						</div>
						<div class="post-date">
							<?php the_date('Y年m月d日');?>
						</div>
						<?php if( $images ) { ?>
							<div class="swiper-content">
								<?php if($slide_count > 1) {?>
								<div class="swiper-container zoom-Swiper swiper-<?php echo $post->ID?>">
									<div class="swiper-wrapper">
										<?php foreach( $images as $image ): ?>
										<div class="swiper-slide">
											<img src="<?php echo $image['full_image_url']; ?>" />
										</div>
										<?php endforeach; ?>
									</div>
								</div>
								<div class="thumb-content">
									<div thumbsSlider="" class="swiper-container thumb-swiper thumb-<?php echo $post->ID?>">
										<div class="swiper-wrapper">
										<?php foreach( $images as $image ): ?>
											<div class="swiper-slide">
												<img src="<?php echo $image['full_image_url']; ?>" />
											</div>
										<?php endforeach; ?>
										</div>
									</div>
									<div class="swiper-button-next next-<?php echo $post->ID?>">
										<img src="<?php echo get_template_directory_uri(); ?>/assets/images/common/next.svg" alt="">
									</div>
									<div class="swiper-button-prev prev-<?php echo $post->ID?>">
										<img src="<?php echo get_template_directory_uri(); ?>/assets/images/common/prev.svg" alt="">
									</div>
								</div>
								<?php } else {?>
									<img src="<?php echo $images[0]['full_image_url']; ?>" class="single_image" alt="">
								<?php }?>
							</div>
						<?php }?>
						<div class="post-text">
							<?php the_content();?>
						</div>
					</div>
					<?php if($slide_count > 1) {?>
					<script>
						var thumb_<?php echo $post->ID?> = new Swiper(".thumb-<?php echo $post->ID?>", {
							spaceBetween: 10,
							slidesPerView: 4,
							freeMode: false,
							watchSlidesVisibility: true,
							watchSlidesProgress: true,
							breakpoints: {
								200: {
									slidesPerView: 2,
								},
								769: {
									slidesPerView: 4,
									spaceBetween: 10
								}
							}
						});
						var swiper_<?php echo $post->ID?> = new Swiper(".swiper-<?php echo $post->ID?>", {
							spaceBetween: 25,
							navigation: {
								nextEl: ".next-<?php echo $post->ID?>",
								prevEl: ".prev-<?php echo $post->ID?>",
							},
							thumbs: {
								swiper: thumb_<?php echo $post->ID?>,
							},
						});
					</script>
					<?php }?>
				<?php } else if(get_post_type() == "perform") { ?>
					<div class="post-part" data-aos="fade-up">
						<div class="subtitle">
							<?php the_title()?>
						</div>
						<div class="post-date">
							<?php the_date('Y年m月d日');?>
						</div>
						<?php if( $images ) { ?>
							<div class="swiper-content">
								<?php if($slide_count > 1) {?>
								<div class="swiper-container zoom-Swiper swiper-<?php echo $post->ID?>">
									<div class="swiper-wrapper">
										<?php foreach( $images as $image ): ?>
										<div class="swiper-slide">
											<img src="<?php echo $image['full_image_url']; ?>" />
										</div>
										<?php endforeach; ?>
									</div>
								</div>
								<div class="thumb-content">
									<div thumbsSlider="" class="swiper-container thumb-swiper thumb-<?php echo $post->ID?>">
										<div class="swiper-wrapper">
										<?php foreach( $images as $image ): ?>
											<div class="swiper-slide">
												<img src="<?php echo $image['full_image_url']; ?>" />
											</div>
										<?php endforeach; ?>
										</div>
									</div>
									<div class="swiper-button-next next-<?php echo $post->ID?>">
										<img src="<?php echo get_template_directory_uri(); ?>/assets/images/common/next.svg" alt="">
									</div>
									<div class="swiper-button-prev prev-<?php echo $post->ID?>">
										<img src="<?php echo get_template_directory_uri(); ?>/assets/images/common/prev.svg" alt="">
									</div>
								</div>
								<?php } else {?>
									<img src="<?php echo $images[0]['full_image_url']; ?>" class="single_image" alt="">
								<?php }?>
							</div>
						<?php }?>
						<div class="post-text">
								<?php
									$publisher = get_post_meta( get_the_ID(), '版元', true);
									if( !empty( $publisher ) ) {
									echo '［版元］ ' . $publisher;
									}
								?><br>
								<?php
									$supervised = get_post_meta( get_the_ID(), '監修', true);
									if( !empty( $supervised ) ) {
										echo '［監修］ ' . $supervised;
									}
								?><br>
								<?php
									$writing = get_post_meta( get_the_ID(), '執筆', true);
									if( !empty( $writing ) ) {
										echo '［執筆］ ' . $writing;
									}
								?><br>
							［刊行］	<?php the_time('Y年m月d日'); ?><br>
								<?php
									$price = get_post_meta( get_the_ID(), '定価', true);
									if( !empty( $price ) ) {
										echo '［定価］ ' . $price . '円＋税';
									}
								?><br>
								<?php
									$charge = get_post_meta( get_the_ID(), '担当ページ', true);
									if( !empty( $charge ) ) {
										echo '［担当ページ］ ' . $charge;
									}
								?><br><br>
								<?php the_content(); ?>
						</div>
						<div class="category-btn-content">
							<?php 
								$post_id = get_the_ID(); // or use the post id if you already have it
								$categories = get_the_category($post_id);
								foreach($categories as $category) {
									echo '<div class="category-btn"><a href="' . get_category_link($category->term_id) . '">' . $category->name . '</a></div>';
								}
							?>	
						</div>
						<div class="buy-btn-content">
							<button class="buy-btn">
								購入
							</button>
						</div>
					</div>
					<?php if($slide_count > 1) {?>
					<script>
						var thumb_<?php echo $post->ID?> = new Swiper(".thumb-<?php echo $post->ID?>", {
							spaceBetween: 10,
							slidesPerView: 4,
							freeMode: false,
							watchSlidesVisibility: true,
							watchSlidesProgress: true,
							breakpoints: {
								200: {
									slidesPerView: 2,
								},
								769: {
									slidesPerView: 4,
									spaceBetween: 10
								}
							}
						});
						var swiper_<?php echo $post->ID?> = new Swiper(".swiper-<?php echo $post->ID?>", {
							spaceBetween: 25,
							navigation: {
								nextEl: ".next-<?php echo $post->ID?>",
								prevEl: ".prev-<?php echo $post->ID?>",
							},
							thumbs: {
								swiper: thumb_<?php echo $post->ID?>,
							},
						});
					</script>
					<?php }?>
				<?php }
			}?>
		</div>
		<div class="right-content">
			<div class="archive pc">
				<div class="archive-title">
					アーカイブ
				</div>
				<div class="radio-group">
					<?php
						$start = 2009;
						for($year = date("Y"); $year >= $start; $year--) { 
							if($y != $year) {?>
								<div class="radio_contain">
									<input id="<?php echo $year; ?>" value="<?php echo $year; ?>" type="radio" name="year" class="radio" onclick='window.location.href="<?php echo get_post_type_archive_link("perform"). '?y=' . $year; ?>"'>
									<label for="<?php echo $year; ?>"><?php echo $year; ?>年</label>
								</div>
							<?php } 
							else { ?>
								<div class="radio_contain">
									<input id="<?php echo $year; ?>" value="<?php echo $year; ?>" type="radio" name="year" class="radio" onclick='window.location.href="<?php echo get_post_type_archive_link("perform"). '?y=' . $year; ?>"' checked>
									<label for="<?php echo $year; ?>"><?php echo $year; ?>年</label>
								</div>
					<?php } } ?>
				</div>
			</div>
		</div>
	</section>
	<?php } else {
		echo "<div class='no-data-box'><div class='no-data'>表示するデータがありません。</div></div>"; 
	 }?>
		
	
</div>

<?php get_footer();?>