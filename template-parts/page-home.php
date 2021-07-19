<?php
    /* 
    Template Name: Home
    */
?>
<?php get_header(); ?>
<link rel="stylesheet" href="<?php echo get_template_directory_uri()?>/assets/css/top.css">
<div class="main-content" id="top-scroll">
    <section class="banner">
        <?php
            global $wp_query;
            $postid = $wp_query->post->ID;
            $slides = acf_photo_gallery('gallery', $postid);
        ?>
        <?php if( $slides ) { ?>
            <div class="swiper-container swiper1">
                <div class="swiper-wrapper">
                    <?php foreach($slides as $slide) {?>
                    <div class="swiper-slide">
                        <div class="card-image">
                            <picture>
                                <img src="<?php echo $slide['full_image_url']?>" alt="Image Slider">
                            </picture>
                        </div>
                    </div>
                <?php }?>
                </div>
                <div class="swiper-button-next">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/top/next.png" alt="">
                </div>
                <div class="swiper-button-prev">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/top/prev.png" alt="">
                </div>
            </div>
        <?php }?>
        <?php 
            wp_reset_query();
        ?>
        <div class="scroll">
            <a href="#news">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/top/Scroll.svg" alt="">
            </a>
        </div>
    </section>
    <section class="news mb-100" id="news">
        <div class="container">
            <div class="info-tab">
                <div class="page-title" data-aos="fade-up">
                    最新情報
                </div>
                <div class="info-tab-body" id="ajax-posts">
					<?php
                    $y  = $_GET['y'];
					$first_post_ids = get_posts( array(
						'fields'         => 'ids', 
						'posts_per_page' => '9999',
						'post_type'      => array('news'),
                        'orderby' => 'post_date', 
                        'order' => 'DESC',
					));
					$second_post_ids = get_posts( array(
						'fields'         => 'ids', 
						'posts_per_page' => '9999',
						'post_type'      => array('perform'),
                        'orderby' => 'post_date', 
                        'order' => 'DESC',
					));
					$third_post_ids = get_posts( array(
						'fields'         => 'ids', 
						'posts_per_page' => '9999',
						'post_type'      => array('event'),
                        'orderby' => 'post_date', 
                        'order' => 'DESC',
					));
					$merged_post_ids = array_merge( $first_post_ids, $second_post_ids, $third_post_ids);
					$loop = new WP_Query
                    ( array(
						'post_type' => array('news', 'perform', 'event'),
						'post__in'  => $merged_post_ids,
                        'orderby' => 'post_date', 
                        'order' => 'DESC',
						'posts_per_page' => 6
					));
					$post_num = $loop->post_count; 
					if( $loop->have_posts() ):
						while( $loop->have_posts() ):
							$loop->the_post();?>
                    <div class="info-tab-item" data-aos="zoom-out">
                    <a href="<?php the_permalink(); ?>">
						<div class="info-tab-item-img">
                            <?php 
                            if (has_post_thumbnail()) {
                                the_post_thumbnail();
                            } else {
                                echo '<img src="'.get_template_directory_uri().'/assets/images/common/camiyu.jpg" style="width: 90%; margin: auto" alt="">';
                            }
                            ?>
						</div>
                        <div class="info-tab-item-body">
                            <div class="info-tab-item-subtitle font-H-W3">
                                <span><img src="<?php echo get_template_directory_uri(); ?>/assets/images/top/clock.svg" alt=""></span> 更新日：<?php the_time('Y年m月d日'); ?>
                            </div>
                            <div class="info-tab-item-title font-H-W6">
                                <?php the_title(); ?>
                            </div>
                            <div class="info-tab-item-text">
								<?php
									$string=mb_substr(strip_tags(get_the_content()), 0, 100, "utf-8");
									if (strlen($string)< strlen(strip_tags(get_the_content()))) {
										$string=$string.'...';
									}
									echo $string;
                                ?>
                            </div>
                        </div>
					</a>
                    </div>
					<?php
						endwhile;
						wp_reset_postdata();
					endif; ?>
                </div>
				<button class="info-tab-more" id="more_posts" data-aos="fade-up">MORE <span>&#10010;</span></button>
            </div>
            <div class="twitter-rss">
                <div class="page-title" data-aos="fade-up">
                    Twitter
                </div>
                <div class="temporary" style="margin-top:2.5vw">
                    <?php dynamic_sidebar( 'twitter-rss-widget' ) ?>
                </div>
            </div>
        </div>
    </section>
    <section class="production mb-100">
        <div class="page-title" data-aos="fade-up">
            かみゆ歴史編集部の制作実績
        </div>
        <div class="production-body">
            <div class="container">			
				<?php
					$args = array(
						'post_type' => 'perform',
						'field' => 'slug',
						'posts_per_page' => 6
					);
					$products = new WP_Query
                    ( $args );
					if( $products->have_posts() ) {
					  while( $products->have_posts() ) {
						$products->the_post();
						?>
						<div class="production-item" data-aos="fade-up" data-delay="">
                        <a href="<?php the_permalink(); ?>">
							<div class="production-item-subimg">
								<img src="<?php echo get_template_directory_uri(); ?>/assets/images/top/production-title.png" alt="">
							</div>
							<div class="production-item-main">
                                <?php 
                                    if (has_post_thumbnail()) {
                                        the_post_thumbnail();
                                    } else {
                                        echo '<img src="'.get_template_directory_uri().'/assets/images/common/camiyu.jpg" style="width: 90%; margin: auto" alt="">';
                                    }
                                ?>
							</div>
							<div class="production-item-text">
								<div class="info-tab-item-subtitle font-H-W3">
									<?php
										$publisher = get_post_meta( get_the_ID(), '版元', true);
									 	if( !empty( $publisher ) ) {
											echo '出版社 : ' . $publisher;
										}
						  			?>
								</div>
								<div class="info-tab-item-title font-H-W6">
									<?php the_title(); ?>
								</div>
							</div>
						</a>
						</div>
                    <?php
                      }
                      wp_reset_postdata();
                    }
                    else {
                        echo '制作実績はありません!';
                    }
			  ?>
            </div>
            <button class="btn width line" data-aos="fade-up" onclick="window.location.href='<?php echo home_url('/perform'); ?>'">
                <a class="font--en">制作実績詳細
                    <span><svg xmlns="http://www.w3.org/2000/svg" width="28.852" height="6.693" viewBox="0 0 28.852 6.693">
                        <path id="Path_1" data-name="Path 1" d="M30.3,16.677l-1.167-5.009,12.135,6.693H12.414V16.677Z" transform="translate(-12.414 -11.668)"/>
                        </svg>
                    </span>
                </a>
            </button>
        </div>
    </section>
    <?php
        global $wp_query;
        $postid = $wp_query->post->ID;
        if (get_field('video')) {
    ?>
    <section class="movie mb-100">
        <div class="page-title" data-aos="fade-up">
            MOVIE
        </div>
        <div class="movie-body" data-aos="zoom-in" data-aos-delay="500">
            <iframe src="<?php echo the_field('video');?>"></iframe>
        </div>
    </section>
    <?php 
        } else {
            echo "<br><br><br>";
        }
        wp_reset_query();
    ?>
    <section class="company mb-100">
        <div class="page-title" data-aos="fade-up">
            会社情報
        </div>
        <div class="company-body">
            <div class="company-info">
                <div class="company-info-text font-H-W6" data-aos="fade-up" data-aos-delay="500">
                    <?php echo the_field('origin')?>
                </div>
                <button class="btn width line disup550" data-aos="fade-up" onclick="window.open('<?php echo get_template_directory_uri(); ?>/assets/pdf/d_camiyu_annai.pdf', '_blank');">
                    <a class="font--en">かみゆの社名の由来はこのページをご覧ください
                        <span><svg xmlns="http://www.w3.org/2000/svg" width="28.852" height="6.693" viewBox="0 0 28.852 6.693">
                            <path id="Path_1" data-name="Path 1" d="M30.3,16.677l-1.167-5.009,12.135,6.693H12.414V16.677Z" transform="translate(-12.414 -11.668)"/>
                            </svg>
                        </span>
                    </a>
                </button>
                <button class="btn width line  disdown550" data-aos="fade-up" onclick="window.open('<?php echo get_template_directory_uri(); ?>/assets/pdf/d_camiyu_annai.pdf', '_blank');">
                    <a class="font--en">かみゆの社名の由来は<br>このページをご覧ください
                        <span><svg xmlns="http://www.w3.org/2000/svg" width="28.852" height="6.693" viewBox="0 0 28.852 6.693">
                            <path id="Path_1" data-name="Path 1" d="M30.3,16.677l-1.167-5.009,12.135,6.693H12.414V16.677Z" transform="translate(-12.414 -11.668)"/>
                            </svg>
                        </span>
                    </a>
                </button>
            </div>
            <div class="company-pos">
                <div class="company-map">
                    <div class="company-map-body" data-aos="fade-up" data-aos-delay="300">
                        <iframe src="<?php echo the_field('google_map_link');?>" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                        <!-- <img src="<?php echo get_template_directory_uri(); ?>/assets/images/common/map.svg" alt=""> -->
                    </div>
                    <div class="company-map-link">
                        <a target="_blank" rel="noopener noreferrer" href="https://www.google.com/maps?ll=35.690537,139.722953&z=17&t=m&hl=ja&gl=JP&mapclient=embed&q=%E5%8C%97%E6%96%97%E5%9B%9B%E8%B0%B7%E3%83%93%E3%83%AB+%E3%80%92160-0007+%E6%9D%B1%E4%BA%AC%E9%83%BD%E6%96%B0%E5%AE%BF%E5%8C%BA%E8%8D%92%E6%9C%A8%E7%94%BA%EF%BC%91%EF%BC%91%E2%88%92%EF%BC%92">Google Map</a>
                        <a target="_blank" rel="noopener noreferrer" href="<?php echo get_template_directory_uri(); ?>/assets/pdf/Camiyu_Map.pdf">拡大図を見る</a>
                    </div>
                </div>
                <div class="company-table" data-aos="fade-up" data-aos-delay="600">
                    <div class="company-table-item">
                        <div class="company-table-item-title">
                            社名
                        </div>
                        <div class="company-table-item-text">
                            <?php echo the_field('name')?>
                        </div>
                    </div>
                    <div class="company-table-item">
                        <div class="company-table-item-title">
                            所在地
                        </div>
                        <div class="company-table-item-text">
                            〒<?php echo the_field('zip_code')?><br>
                            <?php echo the_field('address')?>
                        </div>
                    </div>
                    <div class="company-table-item">
                        <div class="company-table-item-title">
                            電話番号
                        </div>
                        <div class="company-table-item-text">
                            <?php echo the_field('phone');?>
                        </div>
                    </div>
                    <div class="company-table-item">
                        <div class="company-table-item-title">
                            FAX
                        </div>
                        <div class="company-table-item-text">
                            <?php echo the_field('fax');?>
                        </div>
                    </div>
                    <div class="company-table-item">
                        <div class="company-table-item-title">
                            Email
                        </div>
                        <div class="company-table-item-text">
                            <?php echo the_field('email')?>
                        </div>
                    </div>
                </div>
            </div>
            <button class="btn width line" data-aos="fade-up" onclick="window.location.href='<?php echo home_url('/company'); ?>'">
                <a class="font--en">会社概要詳細
                    <span><svg xmlns="http://www.w3.org/2000/svg" width="28.852" height="6.693" viewBox="0 0 28.852 6.693">
                        <path id="Path_1" data-name="Path 1" d="M30.3,16.677l-1.167-5.009,12.135,6.693H12.414V16.677Z" transform="translate(-12.414 -11.668)"/>
                        </svg>
                    </span>
                </a>
            </button>
        </div>
        <div class="company-bg">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/top/company-bg.png" alt="">
        </div>
    </section>
    <section class="social-link">
        <div class="page-title" data-aos="fade-up">
            L I N K
        </div>
        <div class="social-link-body">
            <a href="https://rekijin.com/" target="_blank" rel="noopener noreferrer"><img src="<?php echo get_template_directory_uri();?>/assets/images/top/link01.png" data-aos="zoom-in" data-aos-delay="300" alt=""></a>
            <a href="https://cmeg.jp/w/" target="_blank" rel="noopener noreferrer"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/top/link02.png" data-aos="zoom-in" data-aos-delay="600" alt=""></a>
            <a href="https://twitter.com/camiyu2009" target="_blank" rel="noopener noreferrer"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/top/link03.png" data-aos="zoom-in" data-aos-delay="900" alt=""></a>
        </div>
    </section>
</div>
<script>
    var swiper1 = new Swiper(".swiper1", {
        slidesPerView: 1,
        spaceBetween: 0,
        centeredSlides: true,
        grabCursor: true,
        loop: true,
        pagination: {
            el: ".swiper-pagination",
            clickable: true
        },
        autoplay: {
            delay: 4000,
            disableOnInteraction: false
        },
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev"
        },
        breakpoints: {
            200: {
            slidesPerView: 1
            },
            700: {
            slidesPerView: 1
            }
        }
    }); 
    observer.observe(document.querySelector('section.news'));
    observer.observe(document.querySelector('div.twitter-rss'));
    observer.observe(document.querySelector('section.production'));
    <?php if (get_field('video')) {?>
        observer.observe(document.querySelector('section.movie'));
    <?php }?>
    observer.observe(document.querySelector('section.company'));
    observer.observe(document.querySelector('section.social-link'));
	var adminurl = '<?php echo admin_url( "admin-ajax.php" ) ?>';
    var str = '<?php echo get_the_archive_title(); ?>';
    var performPage = str.includes("制作実績");
    var eventPage = str.includes("イベント");
    var newsPage = str.includes("お知らせ");
    var myyear = '<?php echo $y; ?>';
    var activeCategories = '';
</script>
<?php get_footer(); ?>