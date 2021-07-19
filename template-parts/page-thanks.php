<?php
    /* 
    Template Name: thanks
    */
    get_header(); 
?>
    <link rel="stylesheet" href="<?php echo get_template_directory_uri()?>/assets/css/contact.css">
    <div class="main-content">
        <div class="inner">
            <p class="page-notice">
                top > お問い合わせ
            </p>
        </div>
        <section class="confirm-content">
            <?php 
                global $wp_query;
                $postid = $wp_query->post->ID;
            ?>
            <div class="page-title" data-aos="fade-up">
                お問い合わせが送信されました
            </div>
            <div class="contact-end inner">
                <?php 
                    if(get_field('thanks_text')) {
                        echo the_field('thanks_text');
                    } else {
                ?>
                お問い合わせいただきありがとうございます。<br><br>
                ご入力いただいたメールアドレス宛に受付確認メールをお送りしましたのでご確認ください。<br><br>
                なお、お問い合わせ内容につきましては、5 営業日、弊社担当者よりご返信させていただきます。<br><br>
                万一、ご返信メールが届かない場合は、処理が正常に行われていない可能性があります。<br>
                大変お手数ですが、再度お問い合わせの手続きをお願い致します。<br><br>
                ※迷惑メールフォルダに受信されている場合もございますので一度ご確認よろしくお願いいたします。
                <?php }?>
            </div>
            <button type="" onclick="window.location.href='<?php echo home_url();?>'" style="display: block; margin-bottom: 50px" class="confirm-btn">ホーム</button>
        </section>
    </div>
<script>
    observer.observe(document.querySelector('section.confirm-content'));
</script>
<?php get_footer(); ?>