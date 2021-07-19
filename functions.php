<?php
/******************* 投稿サムネイル ********************/
add_theme_support( 'post-thumbnails' );
set_post_thumbnail_size( '326', '220');
/**
* カスタム投稿を設定する
*/
function news_post_type()
{
	$supports = array(
		'title',
		'editor',
		'author',
		'revisions',
		'thumbnail'
	);
	/**
	* カスタム投稿「お知らせ」を追加
	* slug: 'kamiyu-news'
	*/
	register_post_type(
		'news',
		array(
			'labels' => array(
				'name' => __( 'お知らせ' ),
				'singular_name' => __( 'お知らせ' )
			),
			'public' => true,
			'has_archive' => true,
			'menu_position' => 6,
			'supports' => $supports,
		)
	);
}

function perform_post_type()
{
	$supports = array(
		'title',
		'editor',
		'author',
		'revisions',
		'thumbnail'
	);
	/**
	* カスタム投稿「制作実績」を追加
	* slug: 'kamiyu-perform'
	*/
	register_post_type(
		'perform',
		array(
			'labels' => array(
				'name' => __( '制作実績' ),
				'singular_name' => __( '制作実績' )
			),
			'public' => true,
			'has_archive' => true,
			'menu_position' => 6,
			'supports' => $supports,
		)
	);
}
function event_post_type()
{
	$supports = array(
		'title',
		'editor',
		'author',
		'revisions',
		'thumbnail'
	);
	/**
	* カスタム投稿「イベント」を追加
	* slug: 'kamiyu-event'
	*/
	register_post_type(
		'event',
		array(
			'labels' => array(
				'name' => __( 'イベント' ),
				'singular_name' => __( 'イベント' )
			),
			'public' => true,
			'has_archive' => true,
			'menu_position' => 6,
			'supports' => $supports,
		)
	);
}
add_action('init', 'news_post_type');
add_action('init', 'perform_post_type');
add_action('init', 'event_post_type');
function reg_cat() {
         register_taxonomy_for_object_type('category','perform');
}
add_action('init', 'reg_cat');
wp_localize_script( 'main-js', 'ajax_posts', array(
	'ajaxurl' => admin_url( 'admin-ajax.php' ),
	'noposts' => __('No older posts found', 'kamiyu'),
));

function rss_widgets_init() {

    register_sidebar( array(
      'name'          => 'RSSWidgetArea',
      'id'            => 'twitter-rss-widget',
    ));
 
}
add_action( 'widgets_init', 'rss_widgets_init' );
register_nav_menus( [ 'primary' => __( 'Primary Menu' ) ] );

function check_post_type_and_remove_media_buttons() {
	global $current_screen;
	// Replace following array items with your own custom post types
	$post_types = array('perform');
	if (in_array($current_screen->post_type,$post_types)) {
		remove_action('media_buttons', 'media_buttons');
	}
}
add_action('admin_head','check_post_type_and_remove_media_buttons');

wp_register_script( 'main-js', get_template_directory_uri() . '/assets/js/main.js');
wp_enqueue_script( 'main-js' );
function more_post_ajax(){
	global $post;
    $out = '';
    $ppp = (isset($_POST["ppp"])) ? $_POST["ppp"] : 2;
    $page = (isset($_POST['pageNumber'])) ? $_POST['pageNumber'] : 0;
	$newspage = $_POST["newsPage"];
	$performpage = $_POST["performPage"];
	$eventpage = $_POST["eventPage"];
	$y = $_POST["myyear"];
	$catname = $_POST["search_cat"];

    header("Content-Type: text/html");
	
	if( $newspage == 'false' && $performpage == 'false' && $eventpage == 'false') {
		$args = array(
			'suppress_filters' => true,
			'post_type' => array( 'news', 'perform', 'event'),
			'posts_per_page' => 6,
			'paged'    => $page
		);
	}
	else {
		if($newspage == 'true') {
			$args = array( 'post_type' => 'news', 'posts_per_page' => 5, 'orderby' => 'menu_order', 'order' => 'ASC', 'paged' => $page );
			// $y  = $_GET['y'];
			if (!empty($y))
				$args = array( 'suppress_filters' => true, 'post_type' => 'news', 'posts_per_page' => 5, 'orderby' => 'menu_order', 'order' => 'ASC', 'paged' => $page, 'date_query' => array(
					'relation' => 'AND',
					array('year' => $y)
				) );
		}
		if($performpage == 'true') {
			$args = array( 'post_type' => 'perform', 'posts_per_page' => 10, 'orderby' => 'menu_order', 'order' => 'ASC', 'paged' => $page);
			// $y  = $_GET['y'];
			if (!empty($y))
				$args = array( 'suppress_filters' => true, 'post_type' => 'perform', 'posts_per_page' => 10, 'orderby' => 'menu_order', 'order' => 'ASC', 'paged' => $page, 'date_query' => array(
					'relation' => 'AND',
					array('year' => $y)
				) );
		}
		if($eventpage == 'true') {
			$args = array( 'post_type' => 'event', 'posts_per_page' => 5, 'orderby' => 'menu_order', 'order' => 'ASC', 'paged' => $page );
			// $y  = $_GET['y'];
			if (!empty($y))
				$args = array( 'suppress_filters' => true, 'post_type' => 'event', 'posts_per_page' => 5, 'orderby' => 'menu_order', 'order' => 'ASC', 'paged' => $page, 'date_query' => array(
					'relation' => 'AND',
					array('year' => $y)
				) );
		}
	}

	if( $catname ) {
		$args = array(
			'post_type' => 'perform',
			'posts_per_page' => 10,
			'paged' => $page,
			'cat' => $catname
		);

		$loop = new WP_Query($args);
		if ($loop -> have_posts()) :  while ($loop -> have_posts()) : $loop -> the_post();
		$images = acf_photo_gallery('gallery',$post->ID);
		$slide_count = count($images);
		$out .= '<div class="post-part">
			<div class="subtitle">'
				.get_the_title(). '
			</div>
			<div class="post-date">'
				.get_the_date('Y年m月d日'). '
			</div>';
			if($images) {
				$out .= '<div class="swiper-content">';
					if($slide_count > 1) {
						$out .= '
						<div class="swiper-container zoom-Swiper swiper-' .$post->ID. '">
							<div class="swiper-wrapper">';
								foreach( $images as $image ):
									$imagesize = getimagesize($image['full_image_url']);
									$width = $imagesize[0];
									$height = $imagesize[1];
									if($width < $height) {
										$out .= '<div class="swiper-slide">
											<img src="' .$image['full_image_url']. '" />
										</div>';
									} else {
										$out .= '<div class="swiper-slide">
											<img src="'.$image['full_image_url'].'" style="width:100%; height:auto;" alt="">
										</div>';
									}
								endforeach;
							$out .= '</div>
						</div>
						<div class="thumb-content">
							<div thumbsSlider="" class="swiper-container thumb-swiper thumb-' .$post->ID. '">
								<div class="swiper-wrapper">';
									foreach( $images as $image ):
										$imagesize = getimagesize($image['full_image_url']);
										$width = $imagesize[0];
										$height = $imagesize[1];
										if($width < $height) {
											$out .= '<div class="swiper-slide">
												<img src="' .$image['full_image_url']. '" />
											</div>';
										} else {
											$out .= '<div class="swiper-slide">
												<img src="'.$image['full_image_url'].'" style="width:100%; height:auto;" alt="">
											</div>';
										}
									endforeach;
								$out .= '</div>
							</div>
							<div class="swiper-button-next next-' .$post->ID. '">
								<img src="' .get_template_directory_uri(). '/assets/images/common/next.svg" alt="">
							</div>
							<div class="swiper-button-prev prev-' .$post->ID. '">
								<img src="' .get_template_directory_uri(). '/assets/images/common/prev.svg" alt="">
							</div>
						</div>';
					} else {
						$imagesize = getimagesize($images[0]['full_image_url']);
						$width = $imagesize[0];
						$height = $imagesize[1];
						if($width < $height) {
							$out .= '<img src="'.$images[0]['full_image_url'].'" class="single_image" alt="">';
						} else {
							$out .= '<img src="'.$images[0]['full_image_url'].'" class="single_image" style="width:100%; height:auto;" alt="">';
						}    
					}
				$out .= '</div>';
			}
			$out .='<div class="post-text">';
				$publisher = get_post_meta( get_the_ID(), "版元", true);
				if( !empty( $publisher ) ) {
					$out .= '［版元］' . $publisher;
				}
				$out .= get_field('publish_information');
				$out .= get_the_content(). '
			</div>
			<div class="category-btn-content">';
				$post_id = get_the_ID(); 
				$categories = get_the_category($post_id);
				foreach($categories as $category) {
					$out .= '<div class="category-btn"><a href="' .get_category_link($category->term_id). '">' . $category->name . '</a></div>';
				}
			$out .= '</div>
				<div class="buy-btn-content">
					<button class="buy-btn">
						購入
					</button>
				</div>
			</div>';
			if($slide_count > 1) {
				$out .= '
				<script>
					var thumb_' .$post->ID. ' = new Swiper(".thumb-' .$post->ID. '", {
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
					var swiper_' .$post->ID. ' = new Swiper(".swiper-' .$post->ID. '", {
						spaceBetween: 25,
						navigation: {
							nextEl: ".next-' .$post->ID. '",
							prevEl: ".prev-' .$post->ID. '",
						},
						thumbs: {
							swiper: thumb_' .$post->ID. ',
						},
					});
				</script>
				';
			}
		endwhile;
		endif;
		wp_reset_postdata();
		die($out);
	}

    $loop = new WP_Query($args);

    if ($loop -> have_posts()) :  while ($loop -> have_posts()) : $loop -> the_post();
		if( $newspage == 'false' && $performpage == 'false' && $eventpage == 'false') {
			$out .= '<div class="info-tab-item">
				<div class="info-tab-item-img">
					<a href="' .get_the_permalink(). '">
						' .get_the_post_thumbnail(). '
					</a>
				</div>
				<div class="info-tab-item-body">
					<div class="info-tab-item-subtitle font-H-W3">
						<span><img src="' .get_template_directory_uri(). '/assets/images/top/clock.svg" alt=""></span> 更新日：' .get_the_time('Y年m月d日'). '
					</div>
					<div class="info-tab-item-title font-H-W6">
						' .get_the_title(). '
					</div>
					<div class="info-tab-item-text">';
					$string=mb_substr(strip_tags(get_the_content()), 0, 100, "utf-8");
					if (strlen($string)< strlen(strip_tags(get_the_content()))) {
						$string=$string.'...';
					}
				$out .= $string. '
					</div>
				</div>
			</div>';
		}
		else {
			if($newspage == 'true') {
				$images = acf_photo_gallery('gallery',$post->ID);
				$slide_count = count($images);
				$out .= '<div class="post-part">
					<div class="subtitle">'
						.get_the_title(). '
					</div>
					<div class="post-date">'
						.get_the_date('Y年m月d日'). '
					</div>';
					if($images) {
						$out .= '<div class="swiper-content">';
							if($slide_count > 1) {
								$out .= '
								<div class="swiper-container zoom-Swiper swiper-' .$post->ID. '">
									<div class="swiper-wrapper">';
										foreach( $images as $image ):
											$imagesize = getimagesize($image['full_image_url']);
											$width = $imagesize[0];
											$height = $imagesize[1];
											if($width < $height) {
												$out .= '<div class="swiper-slide">
													<img src="' .$image['full_image_url']. '" />
												</div>';
											} else {
												$out .= '<div class="swiper-slide">
													<img src="'.$image['full_image_url'].'" style="width:100%; height:auto;" alt="">
												</div>';
											}
										endforeach;
									$out .= '</div>
								</div>
								<div class="thumb-content">
									<div thumbsSlider="" class="swiper-container thumb-swiper thumb-' .$post->ID. '">
										<div class="swiper-wrapper">';
											foreach( $images as $image ):
												$imagesize = getimagesize($image['full_image_url']);
												$width = $imagesize[0];
												$height = $imagesize[1];
												if($width < $height) {
													$out .= '<div class="swiper-slide">
														<img src="' .$image['full_image_url']. '" />
													</div>';
												} else {
													$out .= '<div class="swiper-slide">
														<img src="'.$image['full_image_url'].'" style="width:100%; height:auto;" alt="">
													</div>';
												}
											endforeach;
										$out .= '</div>
									</div>
									<div class="swiper-button-next next-' .$post->ID. '">
										<img src="' .get_template_directory_uri(). '/assets/images/common/next.svg" alt="">
									</div>
									<div class="swiper-button-prev prev-' .$post->ID. '">
										<img src="' .get_template_directory_uri(). '/assets/images/common/prev.svg" alt="">
									</div>
								</div>';
							} else {
								$imagesize = getimagesize($images[0]['full_image_url']);
								$width = $imagesize[0];
								$height = $imagesize[1];
								if($width < $height) {
									$out .= '<img src="'.$images[0]['full_image_url'].'" class="single_image" alt="">';
								} else {
									$out .= '<img src="'.$images[0]['full_image_url'].'" class="single_image" style="width:100%; height:auto;" alt="">';
								}    
							}
						$out .= '</div>';
					}
					$out .='<div class="post-text">';
							$out .= get_field('information');
							$out .= get_the_content(). '
						</div>
					</div>';
					if($slide_count > 1) {
						$out .= '
						<script>
							var thumb_' .$post->ID. ' = new Swiper(".thumb-' .$post->ID. '", {
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
							var swiper_' .$post->ID. ' = new Swiper(".swiper-' .$post->ID. '", {
								spaceBetween: 25,
								navigation: {
									nextEl: ".next-' .$post->ID. '",
									prevEl: ".prev-' .$post->ID. '",
								},
								thumbs: {
									swiper: thumb_' .$post->ID. ',
								},
							});
						</script>
						';
					}
			}
			if($performpage == 'true') {
				$images = acf_photo_gallery('gallery',$post->ID);
				$slide_count = count($images);
				$out .= '<div class="post-part">
					<div class="subtitle">'
						.get_the_title(). '
					</div>
					<div class="post-date">'
						.get_the_date('Y年m月d日'). '
					</div>';
					if($images) {
						$out .= '<div class="swiper-content">';
							if($slide_count > 1) {
								$out .= '
								<div class="swiper-container zoom-Swiper swiper-' .$post->ID. '">
									<div class="swiper-wrapper">';
										foreach( $images as $image ):
											$imagesize = getimagesize($image['full_image_url']);
											$width = $imagesize[0];
											$height = $imagesize[1];
											if($width < $height) {
												$out .= '<div class="swiper-slide">
													<img src="' .$image['full_image_url']. '" />
												</div>';
											} else {
												$out .= '<div class="swiper-slide">
													<img src="'.$image['full_image_url'].'" style="width:100%; height:auto;" alt="">
												</div>';
											}
										endforeach;
									$out .= '</div>
								</div>
								<div class="thumb-content">
									<div thumbsSlider="" class="swiper-container thumb-swiper thumb-' .$post->ID. '">
										<div class="swiper-wrapper">';
											foreach( $images as $image ):
												$imagesize = getimagesize($image['full_image_url']);
												$width = $imagesize[0];
												$height = $imagesize[1];
												if($width < $height) {
													$out .= '<div class="swiper-slide">
														<img src="' .$image['full_image_url']. '" />
													</div>';
												} else {
													$out .= '<div class="swiper-slide">
														<img src="'.$image['full_image_url'].'" style="width:100%; height:auto;" alt="">
													</div>';
												}
											endforeach;
										$out .= '</div>
									</div>
									<div class="swiper-button-next next-' .$post->ID. '">
										<img src="' .get_template_directory_uri(). '/assets/images/common/next.svg" alt="">
									</div>
									<div class="swiper-button-prev prev-' .$post->ID. '">
										<img src="' .get_template_directory_uri(). '/assets/images/common/prev.svg" alt="">
									</div>
								</div>';
							} else {
								$imagesize = getimagesize($images[0]['full_image_url']);
								$width = $imagesize[0];
								$height = $imagesize[1];
								if($width < $height) {
									$out .= '<img src="'.$images[0]['full_image_url'].'" class="single_image" alt="">';
								} else {
									$out .= '<img src="'.$images[0]['full_image_url'].'" class="single_image" style="width:100%; height:auto;" alt="">';
								}    
							}
						$out .= '</div>';
					}
					$out .='<div class="post-text">';
							$publisher = get_post_meta( get_the_ID(), "版元", true);
							if( !empty( $publisher ) ) {
								$out .= '［版元］' . $publisher;
							}
							$out .= get_field('publish_information');
							$out .= get_the_content(). '
					</div>
					<div class="category-btn-content">';
						$post_id = get_the_ID(); 
						$categories = get_the_category($post_id);
						foreach($categories as $category) {
							$out .= '<div class="category-btn"><a href="' .get_category_link($category->term_id). '">' . $category->name . '</a></div>';
						}
                    $out .= '</div>
					<div class="buy-btn-content">
                        <button class="buy-btn">
                            購入
                        </button>
                    </div>
					</div>';
					if($slide_count > 1) {
						$out .= '
						<script>
							var thumb_' .$post->ID. ' = new Swiper(".thumb-' .$post->ID. '", {
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
							var swiper_' .$post->ID. ' = new Swiper(".swiper-' .$post->ID. '", {
								spaceBetween: 25,
								navigation: {
									nextEl: ".next-' .$post->ID. '",
									prevEl: ".prev-' .$post->ID. '",
								},
								thumbs: {
									swiper: thumb_' .$post->ID. ',
								},
							});
						</script>
						';
					}
			}
			if($eventpage == 'true') {
				$images = acf_photo_gallery('gallery',$post->ID);
				$slide_count = count($images);
				$out .= '<div class="post-part">
					<div class="subtitle">'
						.get_the_title(). '
					</div>
					<div class="post-date">'
						.get_the_date('Y年m月d日'). '
					</div>';
					if($images) {
						$out .= '<div class="swiper-content">';
							if($slide_count > 1) {
								$out .= '
								<div class="swiper-container zoom-Swiper swiper-' .$post->ID. '">
									<div class="swiper-wrapper">';
										foreach( $images as $image ):
											$imagesize = getimagesize($image['full_image_url']);
											$width = $imagesize[0];
											$height = $imagesize[1];
											if($width < $height) {
												$out .= '<div class="swiper-slide">
													<img src="' .$image['full_image_url']. '" />
												</div>';
											} else {
												$out .= '<div class="swiper-slide">
													<img src="'.$image['full_image_url'].'" style="width:100%; height:auto;" alt="">
												</div>';
											}
										endforeach;
									$out .= '</div>
								</div>
								<div class="thumb-content">
									<div thumbsSlider="" class="swiper-container thumb-swiper thumb-' .$post->ID. '">
										<div class="swiper-wrapper">';
											foreach( $images as $image ):
												$imagesize = getimagesize($image['full_image_url']);
												$width = $imagesize[0];
												$height = $imagesize[1];
												if($width < $height) {
													$out .= '<div class="swiper-slide">
														<img src="' .$image['full_image_url']. '" />
													</div>';
												} else {
													$out .= '<div class="swiper-slide">
														<img src="'.$image['full_image_url'].'" style="width:100%; height:auto;" alt="">
													</div>';
												}
											endforeach;
										$out .= '</div>
									</div>
									<div class="swiper-button-next next-' .$post->ID. '">
										<img src="' .get_template_directory_uri(). '/assets/images/common/next.svg" alt="">
									</div>
									<div class="swiper-button-prev prev-' .$post->ID. '">
										<img src="' .get_template_directory_uri(). '/assets/images/common/prev.svg" alt="">
									</div>
								</div>';
							} else {
								$imagesize = getimagesize($images[0]['full_image_url']);
								$width = $imagesize[0];
								$height = $imagesize[1];
								if($width < $height) {
									$out .= '<img src="'.$images[0]['full_image_url'].'" class="single_image" alt="">';
								} else {
									$out .= '<img src="'.$images[0]['full_image_url'].'" class="single_image" style="width:100%; height:auto;" alt="">';
								}    
							}
						$out .= '</div>';
					}
					$out .='<div class="post-text">
							' .get_the_content(). '
						</div>
					</div>';
					if($slide_count > 1) {
						$out .= '
						<script>
							var thumb_' .$post->ID. ' = new Swiper(".thumb-' .$post->ID. '", {
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
							var swiper_' .$post->ID. ' = new Swiper(".swiper-' .$post->ID. '", {
								spaceBetween: 25,
								navigation: {
									nextEl: ".next-' .$post->ID. '",
									prevEl: ".prev-' .$post->ID. '",
								},
								thumbs: {
									swiper: thumb_' .$post->ID. ',
								},
							});
						</script>
						';
					}
			}
		}
    endwhile;
    endif;
    wp_reset_postdata();
    die($out);
}

add_action('wp_ajax_nopriv_more_post_ajax', 'more_post_ajax');
add_action('wp_ajax_more_post_ajax', 'more_post_ajax');
function custom_events_query( $query ) {
    if (  $query->is_main_query() && $query->is_archive && !is_admin()&& is_post_type_archive('perform') && $query->query_vars['m']!='') {

        $query->set( 'post_type', 'perform' );
        $query->set( 'meta_key', 'event_date' );
        $query->set( 'orderby', 'meta_value' );
        $query->set( 'order', 'DESC' );
        $query->set( 'post_per_page', 10 );
        unset($query->query_vars['year']);
        unset($query->query_vars['monthnum']);
        unset($query->query_vars['day']);

        $meta_query = array(
            array(
                'key' => 'event_date',
                'value' =>  array(date('Y-m-d',strtotime($query->query_vars['m'].'01')),date('Y-m-d',strtotime($query->query_vars['m'].'31'))) ,
                'compare' => 'BETWEEN'
            )
        );
        unset($query->query_vars['m']);
        $query->set( 'meta_query', $meta_query );
    }

    return $query;
}

// add_filter( 'the_content', 'add_img_dimensions' );

// function add_img_dimensions( $content ) { 

// 	$doc = new DOMDocument();
// 	$doc->loadHTML($content);
// 	$images = $doc->getElementsByTagName('img');
// 	if(count($images) < 1) {
// 		return $content;
// 	} else {
// 		foreach($images as $img) {
// 			$url = $img->getAttribute("src");
// 			$imagesize = getimagesize($url);
// 			$width = $imagesize[0];
// 			$height = $imagesize[1];
// 		}
// 		return $content;
// 	}
	
// }

// add_filter( 'the_content', 'add_img_dimensions' );

