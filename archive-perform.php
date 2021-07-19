<?php
    get_header(); 
?>
    <link rel="stylesheet" href="<?php echo get_template_directory_uri()?>/assets/css/perform.css">
    <div class="main-content">
        <div class="inner">
            <p class="page-notice">
                Top > 制作実績
            </p>
        </div>

        <div class="year inner sp" onclick="event.stopPropagation();categoryTrigger();">
            カテゴリーから探す <span><img src="<?php echo get_template_directory_uri(); ?>/assets/images/common/arrow-down.svg" alt=""></span>
        </div>
        <div class="category-menu sp">
            <div class="year inner sp" onclick="event.stopPropagation();categoryTrigger();">
                カテゴリーから探す <span><img src="<?php echo get_template_directory_uri(); ?>/assets/images/common/arrow-up.svg" alt=""></span>
            </div>
            <div class="archive">
                <div class="archive-title">
                    カテゴリーから探す
                </div>
                <div class="category-group">
                    <?php
                        $args = array('hide_empty' => FALSE, 'orderby'=>'id', 'order' => 'ASC');
                        $categories = get_categories($args);
                        $cat_array = explode("," , $search_categories);
                        foreach($categories as $key=>$category) {
                            if (in_array($category->term_id, $cat_array)) {
                                echo '<div class="category-item active" onclick="searchCategory(event);">' . $category->name . '<div style="display:none">'.$category->term_id.'</div></div>';    
                            } else {
                                echo '<div class="category-item" onclick="searchCategory(event);">' . $category->name . '<div style="display:none">'.$category->term_id.'</div></div>';  
                            }
                        }
                    ?>
                    <script>
                        function searchCategory(event) {
                            var activeCategories = "";
                            var element = event.target;
                            element.classList.toggle('active');
                            var activeElements = document.querySelectorAll('.category-group .active div');
                            var len = activeElements.length;
                            for (var i=0; i<len; i++) {
                                activeCategories = activeCategories + "," + activeElements[i].innerHTML;
                            }
                            var url = "<?php echo get_post_type_archive_link('perform')?>";
                            activeCategories = activeCategories.substr(1);
                            var categoryForm = document.getElementById('categoryForm');
                            document.getElementById('search_cat').value = activeCategories;
                            
                            categoryForm.submit();
                        }
                    </script>
                </div>
            </div>
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
                        /*$start = 2009;
                        for($year = date("Y"); $year >= $start; $year--) { 
                            if($y != $year) {?>
                                <div class="radio_contain">
                                    <input id="<?php echo $year; ?>-sp" value="<?php echo $year; ?>" type="radio" name="year" class="radio" onclick='window.location.href="<?php echo get_post_type_archive_link("perform"). '?y=' . $year; ?>"'>
                                    <label for="<?php echo $year; ?>-sp"><?php echo $year; ?>年</label>
                                </div>
                            <?php } 
                            else { ?>
                                <div class="radio_contain">
                                    <input id="<?php echo $year; ?>-sp" value="<?php echo $year; ?>" type="radio" name="year" class="radio" onclick='window.location.href="<?php echo get_post_type_archive_link("perform"). '?y=' . $year; ?>"' checked>
                                    <label for="<?php echo $year; ?>-sp"><?php echo $year; ?>年</label>
                                </div>
                    <?php } } */?>
                    <?php
                        $years = $wpdb->get_col("SELECT DISTINCT YEAR(post_date) FROM $wpdb->posts WHERE post_type = 'perform' AND post_status = 'publish' ORDER BY post_date DESC");
                        foreach($years as $year) : 
                            if($y != $year) {?>
                                <div class="radio_contain">
                                    <input id="<?php echo $year; ?>-sp" value="<?php echo $year; ?>" type="radio" name="year" class="radio" onclick='window.location.href="<?php echo get_post_type_archive_link("perform"). '?y=' . $year; ?>"'>
                                    <label for="<?php echo $year; ?>-sp"><?php echo $year; ?>年</label>
                                </div>
                            <?php } 
                            else { ?>
                                <div class="radio_contain">
                                    <input id="<?php echo $year; ?>-sp" value="<?php echo $year; ?>" type="radio" name="year" class="radio" onclick='window.location.href="<?php echo get_post_type_archive_link("perform"). '?y=' . $year; ?>"' checked>
                                    <label for="<?php echo $year; ?>-sp"><?php echo $year; ?>年</label>
                                </div>
                    <?php } endforeach; ?> 
                </div>
            </div>
        </div>
        <section class="post-content inner">
            <div class="post-list">
                <div class="page-title" data-aos="fade-up">
                    制作実績
                </div>
                <?php
                    $post_args = array( 'post_type' => 'perform', 'posts_per_page' => 10, 'orderby' => 'menu_order','order' => 'ASC');
                    $search_categories = '';
                    if(isset($_POST['search_cat'])) {
                        $search_categories = $_POST['search_cat'];
                        $post_args['cat'] = $search_categories;
                    } 
                    $y  = $_GET['y'];
                    if (!empty($y))
                        $post_args = array( 'post_type' => 'perform', 'posts_per_page' => 10, 'orderby' => 'menu_order', 'order' => 'ASC', 'date_query' => array(
                            'relation' => 'AND',
                            array('year' => $y)
                        ) );

                    $loop = new WP_Query( $post_args );
                    $count_posts = $loop->found_posts;

                    if ( $loop->have_posts() ) :
                ?>
                <div id="ajax-posts-perform">
                    <?php 
                        while ( $loop->have_posts() ) : $loop->the_post(); 
                        $images = acf_photo_gallery('gallery',$post->ID);
						$slide_count = count($images);
                    ?>
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
                                $publisher = get_post_meta( get_the_ID(), '版元', true);
                                if( !empty( $publisher ) ) {
                                    echo '［版元］ ' . $publisher;
                                }
                                if(get_field('publish_information')) {
                                    the_field('publish_information');
                                }
                                the_content();
                            ?>
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
                            <?php if(get_field('buy_link')) {?>
                                <a target="_blank" href="<?php echo get_field('buy_link')?>" class="buy-btn">
                                    購入
                                </a>
                            <?php } else {?>
                                <a href="#" class="buy-btn">
                                    購入
                                </a>
                            <?php } ?>
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
                    <?php endwhile;
                        wp_reset_postdata();
                    ?>
                </div>
                <button class="more-btn" id="more_posts" data-aos="fade-up">MORE<span>&#10010;</span></button>
                <?php 
                    wp_reset_postdata();
                    else:
                        echo "<div class='no-data-box'><div class='no-data'>表示するデータがありません。</div></div>"; 
                    endif;
                ?>
            </div>
            <div class="right-content">
                <div class="archive pc">
                    <div class="archive-title">
                        カテゴリーから探す
                    </div>
                    <div class="category-group">
                        <form id="categoryForm" action="<?php echo get_post_type_archive_link('perform')?>" method="post">
                            <input id="search_cat" type="hidden" name="search_cat" val="">
                        </form>
                        <?php
                            $args = array('hide_empty' => FALSE, 'orderby'=>'id', 'order' => 'ASC');
                            $categories = get_categories($args);
                            $cat_array = explode("," , $search_categories);
                            foreach($categories as $key=>$category) {
                                if (in_array($category->term_id, $cat_array)) {
                                    echo '<div class="category-item active" onclick="searchCategory(event);">' . $category->name . '<div style="display:none">'.$category->term_id.'</div></div>';    
                                } else {
                                    echo '<div class="category-item" onclick="searchCategory(event);">' . $category->name . '<div style="display:none">'.$category->term_id.'</div></div>';  
                                }
                            }
                        ?>
                        <script>
                            function searchCategory(event) {
                                var activeCategories = "";
                                var element = event.target;
                                element.classList.toggle('active');
                                var activeElements = document.querySelectorAll('.category-group .active div');
                                var len = activeElements.length;
                                for (var i=0; i<len; i++) {
                                    activeCategories = activeCategories + "," + activeElements[i].innerHTML;
                                }
                                var url = "<?php echo get_post_type_archive_link('perform')?>";
                                activeCategories = activeCategories.substr(1);
                                var categoryForm = document.getElementById('categoryForm');
                                document.getElementById('search_cat').value = activeCategories;
                                
                                categoryForm.submit();
                            }
                        </script>
                    </div>
                </div>
                <div class="archive pc">
                    <div class="archive-title">
                        アーカイブ
                    </div>
                    <div class="radio-group">
                        <?php
                            $years = $wpdb->get_col("SELECT DISTINCT YEAR(post_date) FROM $wpdb->posts WHERE post_type = 'perform' AND post_status = 'publish' ORDER BY post_date DESC");
                            foreach($years as $year) : 
                                if($y != $year) {?>
                                    <div class="radio_contain">
                                        <input id="<?php echo $year; ?>-sp" value="<?php echo $year; ?>" type="radio" name="year" class="radio" onclick='window.location.href="<?php echo get_post_type_archive_link("perform"). '?y=' . $year; ?>"'>
                                        <label for="<?php echo $year; ?>-sp"><?php echo $year; ?>年</label>
                                    </div>
                                <?php } 
                                else { ?>
                                    <div class="radio_contain">
                                        <input id="<?php echo $year; ?>-sp" value="<?php echo $year; ?>" type="radio" name="year" class="radio" onclick='window.location.href="<?php echo get_post_type_archive_link("perform"). '?y=' . $year; ?>"' checked>
                                        <label for="<?php echo $year; ?>-sp"><?php echo $year; ?>年</label>
                                    </div>
                        <?php } endforeach; ?> 
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
        var myyear = '<?php echo $y; ?>';
        var activeCategories = '<?php echo $search_categories?>';
    </script>
<?php get_footer(); ?>