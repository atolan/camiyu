<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage camiyu
 * @since camiyu 1.0
 */

?>

<footer class="site-footer" role="contentinfo">
    <div class="footer-bar">
        <div class="inner pc">
            <div class="logo-part">
                <a href="<?php echo home_url('/'); ?>"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/common/logo.svg" alt="" class="logo"></a>
            </div>
            <div class="footer-title">
                <?php
                    global $wp_query;
                    $postid = $wp_query->post->ID;
                ?>
                〒160-0007　東京都新宿区荒木町11-2　北斗四谷ビル2階<br> 
                TEL：03-6457-7660 　 FAX： 03-6457-7661　　Email：info@camiyu.jp
            </div>
            <?php get_search_form()?>
        </div>
        <div class="footer-sp sp">
            <div class="footer-flex inner">
                <a href="<?php echo home_url('/'); ?>"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/common/logo.svg" alt="" class="logo"></a>
                <a href="https://twitter.com/camiyu2009"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/common/twitter.svg" alt="" class="twitter"></a>
            </div>
            <div class="footer-text inner">
                〒160-0007　東京都新宿区荒木町 11-2　北斗四谷ビル 2 階<br>
                TEL：<a href="tel:0364577660">03-6457-7660</a>  　FAX： 03-6457-7661　Email：info@camiyu.jp
            </div>
        </div>
    </div>
    <div class="copyright">
        Copyright © CAMIYU Inc. All Rights Reserved.
    </div>
</footer>
<a href="#" class="back-to-top" id="topBtn"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/top/totop.svg" alt=""></a>
<script id="__bs_script__">//<![CDATA[
    document.write("<script async src='http://HOST:3000/browser-sync/browser-sync-client.js?v=2.27.4'><\/script>".replace("HOST", location.hostname));
//]]></script>
</body>
<script src="<?php echo get_template_directory_uri(); ?>/assets/js/jquery-3.3.1.min.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/assets/js/main.js"></script>
<script>
    AOS.init();
</script>
</html>