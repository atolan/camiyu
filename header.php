<?php
/**
 * The header.
 *
 * This is the template that displays all of the <head> section and everything up until main.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage kamiyu
 * @since kamiyu 1.0
 */

?>
<html lang="ja">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="株式会社かみゆは、企画・編集・執筆・制作を専門とする編集プロダクションです。">
    <meta name="keywords" content="かみゆ,紙結,カミユ,カミュ,kamiyu,かみゆ歴史編集部,滝沢弘康,たきざわひろやす,企画,編集,執筆,制作,歴史,エンタメ,エンタテインメント,ロック,大人のロック,雑誌,書籍,本,書籍づくり,雑誌づくり,日経BP社出版,編集プロダクション">
    <meta property="og:title" content="">
    <meta property="og:type" content="article">
    <meta property="og:url" content="">
    <meta property="og:image" content="">
    <meta property="og:description" content="">
    <meta property="og:site_name" content="株式会社かみゆ［紙結］ 雑誌、書籍、WEBの企画・編集・制作を担います。">
    <title>株式会社かみゆ［紙結］ 雑誌、書籍、WEBの企画・編集・制作を担います。</title>
    <link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/favicon.ico">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/css/swiper-bundle.min.css">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/style.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="<?php echo get_template_directory_uri(); ?>/assets/js/swiper-bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        const observer = new IntersectionObserver(entries => {
            entries.forEach(entry => {
            const title = entry.target.querySelector('.page-title');
            if (entry.isIntersecting) {
                title.classList.add('view-active');
                return; // if we added the class, exit the function
            }
        
            // We're not intersecting, so remove the class!
            title.classList.remove('view-active');
            });
        });
    </script>
</head>
<body id="body">
    <header id="header" class="">
        <div class="header-bar">
            <div class="inner pc">
                <div class="logo-part">
                    <a href="<?php echo home_url('/'); ?>"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/common/logo.svg" alt="" class="logo"></a>
                </div>
                <h1 class="header-title">
                    株式会社かみゆは、書籍、雑誌、WEB、アプリの<br>
                    企画・編集・執筆・制作を専門とするプロダクションです。
                </h1>
                <div class="twitter-search">
                    <a href="https://twitter.com/camiyu2009"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/common/twitter.svg" alt="" class="twitter"></a>
                    <?php get_search_form()?>
                </div>
            </div>
            <div class="sp-inner sp">
                <div class="sp-inner-flex">
                    <a href="https://twitter.com/camiyu2009" style="visibility: hidden">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/common/twitter.svg" alt="" class="twitter">
                    </a>
                    <a href="<?php echo home_url('/'); ?>">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/common/logo.svg" alt="" class="logo">
                    </a>
                    <div class="menu-trigger sp" id="trigger" onclick="event.stopPropagation();menuTrigger();">
                        <div class="bar1"></div>
                        <div class="bar2"></div>
                        <div class="bar3"></div>
                    </div>
                </div>
            </div>
        </div>
        <nav class="navigation-menu inner pc">
            <?php $args = [ 'theme_location' => 'primary' ]; ?>
            <?php wp_nav_menu() ?>
        </nav>
    </header>
        <div id="myNav" class="menu_sp sp">
            <?php get_search_form()?>
            <div class="inner">
                <nav class="navigation-menu sp">
                    <?php $args = [ 'theme_location' => 'primary' ]; ?>
                    <?php wp_nav_menu() ?>
                </nav>
            </div>
        </div>