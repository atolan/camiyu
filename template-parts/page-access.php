<?php
    /* 
    Template Name: Access
    */
    get_header(); 
?>
    <link rel="stylesheet" href="<?php echo get_template_directory_uri()?>/assets/css/access.css">
    <div class="main-content">
        <?php 
            global $wp_query;
            $postid = $wp_query->post->ID;
        ?>
        <div class="inner">
            <p class="page-notice">
                Top > アクセス
            </p>
        </div>
        <section class="access-content">
            <div class="page-title">
                アクセス
            </div>
            <div class="location-box inner" data-aos="zoom-in">
                <div class="location-part">
                    <div class="location-title">
                        所在地
                    </div>
                    <div class="location-text">
                        <?php echo the_field('name')?><br>
                        〒<?php echo the_field('zip_code')?>　<?php echo the_field('address')?><br>
                        TEL：<?php echo the_field('phone');?>　FAX： <?php echo the_field('fax');?>
                    </div>
                </div>
                <div class="location-part">
                    <div class="location-title pc">
                        交通アクセス
                    </div>
                    <div class="location-title sp">
                        交通<br>アクセス
                    </div>
                    <div class="location-text">
                        <?php echo the_field('access')?>
                    </div>
                </div>
            </div>

            <div class="google-map" data-aos="zoom-in" data-aos-duration="1000">
                <iframe src="<?php echo the_field('google_map_link');?>" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
            </div>
            <div class="inner">
                <?php if(get_field('map')) {?>
                    <?php $image = get_field('map')?>
                    <img src="<?php echo $image['url']?>" id="image" alt="" data-aos="zoom-in" data-aos-duration="1000" class="map-image">
                <?php } else {?>
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/common/map.svg" id="image" alt="" data-aos="zoom-in" data-aos-duration="1000" class="map-image">
                <?php }?>
                <div class="map-flex">
                    <a target="_blank" rel="noopener noreferrer" href="<?php echo get_template_directory_uri(); ?>/assets/pdf/Camiyu_Map.pdf" class="map-view">印刷画面へ</a>
                </div>
            </div>
        </section>



    </div>
<script>
    observer.observe(document.querySelector('section.access-content'));
</script>
<?php get_footer(); ?>
