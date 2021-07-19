<?php
    /* 
    Template Name: Company
    */
    get_header(); 
?>
        <link rel="stylesheet" href="<?php echo get_template_directory_uri()?>/assets/css/company.css">
        <div class="main-content">
            <?php
                global $wp_query;
                $postid = $wp_query->post->ID;
            ?>
            <div class="inner">
                <p class="page-notice">
                    Top > 会社概要
                </p>
            </div>
            <section class="company-profile">
                <div class="page-title" data-aos="fade-up">
                    会社概要
                </div>
                <div class="profile-content inner">
                    <div class="profile-box">
                        <div class="profile-part" data-aos="zoom-in" data-aos-delay="200">
                            <div class="part-title">
                                <p>社名</p>
                            </div>
                            <div class="part-text">
                                <p><?php echo the_field('name');?></p>
                            </div>
                        </div>
                        <div class="profile-part" data-aos="zoom-in" data-aos-delay="400">
                            <div class="part-title">
                                <p>所在地</p>
                            </div>
                            <div class="part-text sp">
                                <div class="part-flex">
                                    <p>〒<?php echo the_field('zip_code');?><br><?php echo the_field('address');?><br>TEL：<a href="tel:0364577660"><?php echo the_field('phone');?></a>　 FAX：<?php echo the_field('fax');?></p>
                                    <a href='<?php echo home_url('access')?>' class="map-view access-view">アクセス</a>
                                </div>
                            </div>
                            <div class="part-text pc">
                                <div class="part-flex">
                                    <p>〒<?php echo the_field('zip_code');?><br><?php echo the_field('address');?><br>TEL：<?php echo the_field('phone');?>　 FAX：<?php echo the_field('fax');?></p>
                                    <a href='<?php echo home_url('access')?>' class="map-view access-view">アクセス</a>
                                </div>
                            </div>
                        </div>
                        <div class="profile-part" data-aos="zoom-in" data-aos-delay="600">
                            <div class="part-title">
                                <p>設立</p>
                            </div>
                            <div class="part-text">
                                <p>2009年4月1日</p>
                            </div>
                        </div>
                        <div class="profile-part" data-aos="zoom-in" data-aos-delay="800">
                            <div class="part-title">
                                <p>スタッフ</p>
                            </div>
                            <div class="part-text">
                                <p>
                                    <?php echo the_field('staff');?>
                                </p>
                            </div>
                        </div>
                        <div class="profile-part" data-aos="zoom-in" data-aos-delay="200">
                            <div class="part-title">
                                <p>おもな<br> クライアント</p>
                            </div>
                            <div class="part-text">
                                <p>
                                    <?php echo the_field('client');?>
                                </p>
                            </div>
                        </div>
                        <div class="profile-part" data-aos="zoom-in" data-aos-delay="400">
                            <div class="part-title">
                                <p>取引銀行</p>
                            </div>
                            <div class="part-text">
                                <p>
                                    <?php echo the_field('bank');?>
                                </p>
                            </div>
                        </div>
                        <div class="profile-part" data-aos="zoom-in" data-aos-delay="600">
                            <div class="part-title">
                                <p>事業内容</p>
                            </div>
                            <div class="part-text">
                                <p>
                                    <?php echo the_field('business_content');?>
                                </p>
                            </div>
                        </div>
                        <div class="profile-part" data-aos="zoom-in" data-aos-delay="800">
                            <div class="part-title">
                                <p>実績のある<br> ジャンル</p>
                            </div>
                            <div class="part-text">
                                <p>
                                    <?php echo the_field('proven _genre');?>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section class="company-about">
                <div class="page-title" data-aos="fade-up">
                    会社情報
                </div>
                <div class="about-content">
                    <div class="about-text" data-aos="fade-up" data-aos-delay="500">
                        <?php echo the_field('origin');?>
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
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/profile/back-title.png" alt="" class="back-image">
                </div>
            </section>
            <section class="company-access">
                <div class="page-title" data-aos="fade-up">
                    アクセス
                </div>
                <div class="access-content inner">
                    <?php if(get_field('map')) {?>
                        <?php $image = get_field('map')?>
                        <img src="<?php echo $image['url']?>" id="image" alt="" data-aos="zoom-in" data-aos-duration="1000" class="map-image">
                    <?php } else {?>
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/common/map.svg" id="image" alt="" data-aos="zoom-in" data-aos-duration="1000" class="map-image">
                    <?php }?>
                    <!-- <img src="<?php echo get_template_directory_uri(); ?>/assets/images/common/map.svg" id="image" alt="" data-aos="zoom-in" data-aos-duration="1000" class="map-image"> -->
                    <div class="map-flex">
                        <a href="https://www.google.com/maps?ll=35.690537,139.722953&z=17&t=m&hl=ja&gl=JP&mapclient=embed&q=%E5%8C%97%E6%96%97%E5%9B%9B%E8%B0%B7%E3%83%93%E3%83%AB+%E3%80%92160-0007+%E6%9D%B1%E4%BA%AC%E9%83%BD%E6%96%B0%E5%AE%BF%E5%8C%BA%E8%8D%92%E6%9C%A8%E7%94%BA%EF%BC%91%EF%BC%91%E2%88%92%EF%BC%92" target="_blank"><div class="map-view">
                            Google Map
                        </div></a>
                        <a target="_blank" href="<?php echo get_template_directory_uri(); ?>/assets/pdf/Camiyu_Map.pdf"><div class="map-view">
                            拡大図を見る
                        </div></a>
                    </div>
                    <div class="pos-flex">
                        <div class="pc" data-aos="fade-up">
                            <?php echo the_field('name');?><br>
                            〒<?php echo the_field('zip_code');?>　 <?php echo the_field('address');?><br>
                            TEL：<?php echo the_field('phone');?> 　 FAX： <?php echo the_field('fax');?><br>
                        </div>
                        <div class="sp" data-aos="fade-up">
                            <?php echo the_field('name');?><br>
                            〒<?php echo the_field('zip_code');?>　 <br><?php echo the_field('address');?><br>
                            TEL：<a href="tel:0364577660"><?php echo the_field('phone');?></a> 　 <br>FAX： <?php echo the_field('fax');?><br>
                            （※電話・FAXは変更ありません）
                        </div>
                        <div data-aos="fade-up">
                            交通アクセス<br>
                            <?php echo the_field('access');?>
                        </div>
                    </div>
                </div>
                
            </section>
            <section id="staff" class="company-staff">
                <div class="page-title" data-aos="fade-up">
                    スタッフ募集
                </div>
                <div class="staff-content inner">
                    <div class="staff-text" data-aos="fade-up" data-aos-delay="300">
                        <?php echo the_field('recruit_intro');?>
                    </div>
                    <div class="staff-box">
                        <div class="staff-box-title">
                            こんな人材を求めています
                        </div>
                        <div class="staff-flex">
                            <?php $images = acf_photo_gallery('recruit_images',$post->ID)?>
                            <div class="staff-part" data-aos="fade-up" data-aos-delay="300">
                                <div class="staff-image">
                                    <img src="<?php echo $images[0]['full_image_url']?>" alt="">
                                </div>
                                <div class="staff-part-title">
                                    <?php echo the_field('target1');?>
                                </div>
                                <div class="staff-part-text">
                                    <?php echo the_field('target_text1');?>
                                </div>
                            </div>
                            <div class="staff-part" data-aos="fade-up" data-aos-delay="600">
                                <div class="staff-image">
                                    <img src="<?php echo $images[1]['full_image_url']?>" alt="">
                                </div>
                                <div class="staff-part-title">
                                    <?php echo the_field('target2');?>
                                </div>
                                <div class="staff-part-text">
                                    <?php echo the_field('target_text2');?>
                                </div>
                            </div>
                            <div class="staff-part" data-aos="fade-up" data-aos-delay="900">
                                <div class="staff-image">
                                    <img src="<?php echo $images[2]['full_image_url']?>" alt="">
                                </div>
                                <div class="staff-part-title">
                                    <?php echo the_field('target3');?>
                                </div>
                                <div class="staff-part-text">
                                    <?php echo the_field('target_text3');?>
                                </div>
                            </div>
                        </div>
                        <div class="staff-circle"></div>
                        <div class="staff-circle"></div>
                        <div class="staff-circle"></div>
                        <div class="staff-circle"></div>
                    </div>
                    <button class="btn width line pc" data-aos="fade-up" onclick="window.location.href='<?php echo home_url('contact')?>'">
                        <a class="font--en">採用お問い合わせ
                            <span><svg xmlns="http://www.w3.org/2000/svg" width="28.852" height="6.693" viewBox="0 0 28.852 6.693">
                                <path id="Path_1" data-name="Path 1" d="M30.3,16.677l-1.167-5.009,12.135,6.693H12.414V16.677Z" transform="translate(-12.414 -11.668)"/>
                                </svg>
                            </span>
                        </a>
                    </button>
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
        observer.observe(document.querySelector('section.company-profile'));
        observer.observe(document.querySelector('section.company-about'));
        observer.observe(document.querySelector('section.company-access'));
        observer.observe(document.querySelector('section.company-staff'));
        observer.observe(document.querySelector('section.inquery'));
    </script>
<?php get_footer(); ?>