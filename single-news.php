<?php
    /* 
    Template Name: News
    */
    get_header(); 
?>
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/css/news.css">
    <div class="main-content">
        <div class="inner">
            <p class="page-notice">
                Top > お知らせ
            </p>
        </div>

        <div class="year inner sp" onclick="event.stopPropagation();yearTrigger();">
            アーカイブ <span><img src="<?php echo get_template_directory_uri(); ?>/assets/images/common/arrow-down.svg" alt=""></span>
        </div>
        <div class="year-menu sp">
            <div class="year inner sp" onclick="event.stopPropagation();yearTrigger();">
                アーカイブ <span><img src="<?php echo get_template_directory_uri(); ?>/assets/images/common/arrow-up.svg" alt=""></span>
            </div>
            <div class="archive">
                <div class="archive-title">
                    アーカイブ
                </div>
                <div class="radio-group">
                    <?php
                    $start = 2009;
                    for($year = date("Y"); $year >= $start; $year--) { 
                        if($y != $year) {?>
                            <div class="radio_contain">
                                <input id="<?php echo $year; ?>" value="<?php echo $year; ?>" type="radio" name="year" class="radio" onclick='window.location.href="<?php echo get_post_type_archive_link("news"). '?y=' . $year; ?>"'>
                                <label for="<?php echo $year; ?>"><?php echo $year; ?>年</label>
                            </div>
                        <?php } 
                        else { ?>
                            <div class="radio_contain">
                                <input id="<?php echo $year; ?>" value="<?php echo $year; ?>" type="radio" name="year" class="radio" onclick='window.location.href="<?php echo get_post_type_archive_link("news"). '?y=' . $year; ?>"' checked>
                                <label for="<?php echo $year; ?>"><?php echo $year; ?>年</label>
                            </div>
                    <?php } } ?>
                </div>
            </div>
        </div>
<!--      Year Smartphone Menu      -->

        <section class="post-content inner">
            <div class="post-list">
                <div class="page-title" data-aos="fade-up">
                    お知らせ
                </div>
                <?php
                    if ( have_posts() ) :
                    while ( have_posts() ) : the_post(); 
                    $images = acf_photo_gallery('gallery',$post->ID);
					$slide_count = count($images);
                ?>
                <div id="ajax-posts-news">
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
                                            <?php 
                                                $imagesize = getimagesize($image['full_image_url']);
                                                $width = $imagesize[0];
                                                $height = $imagesize[1];
                                                if($width < $height) {
                                                    echo '<img src="'.$image['full_image_url'].'" alt="">';
                                                } else {
                                                    echo '<img src="'.$image['full_image_url'].'" style="width:100%; height:auto;" alt="">';
                                                }
                                            ?>
                                        </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                                <div class="thumb-content">
                                    <div thumbsSlider="" class="swiper-container thumb-swiper thumb-<?php echo $post->ID?>">
                                        <div class="swiper-wrapper">
                                        <?php foreach( $images as $image ): ?>
                                            <div class="swiper-slide">
                                                <?php 
                                                    $imagesize = getimagesize($image['full_image_url']);
                                                    $width = $imagesize[0];
                                                    $height = $imagesize[1];
                                                    if($width < $height) {
                                                        echo '<img src="'.$image['full_image_url'].'" alt="">';
                                                    } else {
                                                        echo '<img src="'.$image['full_image_url'].'" style="width:100%; height:auto;" alt="">';
                                                    }
                                                ?>
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
                                <?php } else {
                                    $imagesize = getimagesize($images[0]['full_image_url']);
                                    $width = $imagesize[0];
                                    $height = $imagesize[1];
                                    if($width < $height) {
                                        echo '<img src="'.$images[0]['full_image_url'].'" class="single_image" alt="">';
                                    } else {
                                        echo '<img src="'.$images[0]['full_image_url'].'" class="single_image" style="width:100%; height:auto;" alt="">';
                                    }
                                }?>
                            </div>
                        <?php }?>
                        <div class="post-text">
                            <?php
                                if(get_field('information')) {
                                    the_field('information');
                                }
                                the_content();
                            ?>
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
                </div>
                <?php endwhile; // ending while loop
                    wp_reset_postdata();
                 endif; // ending condition ?>
                <!-- <button class="more-btn" id="more_posts">MORE</button> -->
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
                                    <input id="<?php echo $year; ?>" value="<?php echo $year; ?>" type="radio" name="year" class="radio" onclick='window.location.href="<?php echo get_post_type_archive_link("news"). '?y=' . $year; ?>"'>
                                    <label for="<?php echo $year; ?>"><?php echo $year; ?>年</label>
                                </div>
                            <?php } 
                            else { ?>
                                <div class="radio_contain">
                                    <input id="<?php echo $year; ?>" value="<?php echo $year; ?>" type="radio" name="year" class="radio" onclick='window.location.href="<?php echo get_post_type_archive_link("news"). '?y=' . $year; ?>"' checked>
                                    <label for="<?php echo $year; ?>"><?php echo $year; ?>年</label>
                                </div>
                        <?php } } ?>
                    </div>
                </div>
            </div>
        </section>

        <section class="inquery">
            <div class="page-title" data-aos="fade-up">
                お問い合わせ
            </div>
            <div class="inquery-text pc" data-aos="fade-up" data-aos-delay="300">
                制作のご質問・ご相談･ご依頼はお電話または、<br>
                以下のお問い合わせフォームよりお問い合わせください。
            </div>
            <div class="inquery-text sp"  data-aos="fade-up" data-aos-delay="300">
                制作のご質問・ご相談･ご依頼はお電話または、
                以下のお問い合わせフォームよりお問い合わせください。
            </div>
            <button class="inquery-btn" data-aos="fade-up" data-aos-delay="600" onclick="window.location.href='<?php echo home_url('contact')?>'">
                お問い合わせフォーム
                <span><svg xmlns="http://www.w3.org/2000/svg" width="28.852" height="6.693" viewBox="0 0 28.852 6.693">
                    <path id="Path_1" data-name="Path 1" d="M30.3,16.677l-1.167-5.009,12.135,6.693H12.414V16.677Z" transform="translate(-12.414 -11.668)" fill="#fff"/>
                    </svg>
                </span>
            </button>
        </section>
    </div>
    <script>
        observer.observe(document.querySelector('section.post-content'));
        observer.observe(document.querySelector('section.inquery'));
        function yearTrigger() {
            document.querySelector('.year-menu').classList.toggle("is-show");
            document.querySelector('body').classList.toggle("menu_open");
        }
        function categoryTrigger() {
            document.querySelector('.category-menu').classList.toggle("is-show");
            document.querySelector('body').classList.toggle("menu_open");
        }
        var adminurl = '<?php echo admin_url( "admin-ajax.php" ) ?>';
        var str = '<?php echo get_the_archive_title(); ?>';
        var performPage = str.includes("制作実績");
        var eventPage = str.includes("イベント");
        var newsPage = str.includes("お知らせ");
    </script>
<?php get_footer(); ?>