<!DOCTYPE html>
<html>
    <head>
        <title>Dalkurd</title>
        <meta http-equiv="Content-type" content="text/html;charset=UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link href="<?php echo get_bloginfo('template_url'); ?>/Themes/KL-Theme/Content/styles.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo get_bloginfo('template_url'); ?>/Themes/Addons/styles.css" rel="stylesheet" type="text/css" />
        <link rel="shortcut icon" href="favicon.ico" />
        <link href="<?php echo get_bloginfo('template_url'); ?>/Themes/Base-Theme/Content/fonts.css" rel="stylesheet" type="text/css" />
        <link href='http://fonts.googleapis.com/css?family=PT+Sans:regular,italic,bold' rel='stylesheet' type='text/css' />
        <script src="<?php echo get_bloginfo('template_url'); ?>/js/jquery-1.11.3.js"></script>
        <script src="<?php echo get_bloginfo('template_url'); ?>/Scripts/vendor/modernizr-2.6.1-respond-1.1.0.min.js"></script> 
        <style type="text/css">
            .productResultsLists article .add_cart a {
                padding: 0 6px; font-size: 12px;
            }
        </style>
    </head>
    <body>
        <header id="header-section"> 
            <!--LOGO & QUICK LINKS-->
            <div class="container-wrapper">
                <div class="container" id="logo-section-wrapper">
                    <div class="row">
                        <div class="grid_3 col nobotmargin notopmargin">
                            <h1 class="logo"><a href="<?php echo get_bloginfo('url') ?>" title="Back Home"><span><?php echo get_bloginfo('site_title') ?></span></a></h1>
                        </div>
                        <div class="grid_9 col nobotmargin notopmargin" id="quick-access">
                            <div class="quick-access">
                                <ul class="quick-access-links links">
                                    <li class="first"><a href="<?php echo get_bloginfo('url') ?>/register" class="ico-register">Register</a></li>
                                    <li><a href="<?php echo get_bloginfo('url') ?>/login" class="ico-login">Log in</a></li>
                                    <li id="topcartlink"><a href="<?php echo get_bloginfo('url') ?>/cart" class="ico-cart">Shopping Cart (<span class="cart-qty">1</span>)</a></li>
                                </ul>
                                <script type="text/javascript">
                                    $(document).ready(function () {
                                        $('.header').on('mouseenter', '#topcartlink', function () {
                                            $('#flyout-cart').addClass('active');
                                        });
                                        $('.header').on('mouseleave', '#topcartlink', function () {
                                            $('#flyout-cart').removeClass('active');
                                        });
                                        $('.header').on('mouseenter', '#flyout-cart', function () {
                                            $('#flyout-cart').addClass('active');
                                        });
                                        $('.header').on('mouseleave', '#flyout-cart', function () {
                                            $('#flyout-cart').removeClass('active');
                                        });
                                    });
                                </script>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--END LOGO & QUICK LINKS-->

            <!--MAIN NAV-->
            <div class="container-wrapper" id="main-nav-container">
                <div class="container" id="main-nav-wrapper">
                    <div class="top-search-wrapper">
                        <form role="search" method="get" id="small-search-box-form" action="<?php echo get_bloginfo('url'); ?>/">
                            <div class="form-search">
                                <label for="search-form-58fb41d966adc">Search for:</label>
                                <input type="search" class="input-text" id="small-searchterms"  value="Search store" name="s"  onfocus="if (this.value == 'Search store')
                                            this.value = ''" onblur="if (this.value == '') {
                                                        this.value = 'Search store';
                                                    }" />
                                <button type="submit" title="Search" class="button" value="Search"><span><span>Search</span></span></button>
                            </div>
                        </form>
                    </div>
                    <div id="mobnav" class="show-phone">
                        <a id="mobnav-trigger" href="#" class="active">
                            <div class="icon"><div class="line"></div><div class="line"></div><div class="line"></div></div>
                            <span>Menu</span>
                        </a>
                    </div>

                    <nav id="main-nav">

                        <?php
                        $args = array('order' => 'ASC', 'orderby' => 'menu_order', 'post_type' => 'nav_menu_item', 'post_status' => 'publish', 'output' => ARRAY_A, 'output_key' => 'menu_order', 'nopaging' => true, 'update_post_term_cache' => false);
                        $items = wp_get_nav_menu_items('mainmenu', $args);
                        ?>
                        <ul class="top_nav">
                            <?php
                            foreach ($items as $key => $mnu_item) {
                                if ($mnu_item->menu_item_parent == '0') {
                                    echo '<li class="hasdropdown inactive"><a href="' . $mnu_item->url . '" title="' . $mnu_item->title . '">' . $mnu_item->title . '</a>';
                                    my_custom_submenu($mnu_item->ID);
                                    echo '</li>';
                                }
                            }
                            ?>
                        </ul>
                    </nav>
                </div>
            </div>

            <!--END MAIN NAV-->

            <!--TOP BASKET-->
            <div class="container-wrapper" id="top-cart-wrapper">
                <div class="container" id="top-cart">
                    <ul class="right hide-phone">
                        <li>
                            <div class="top-basket"><a href="/cart" id="basket-toggle">Shopping Cart - <span class="cart-total"></span></a>
                                <div class="basket-count"><span class="cart-qty"></span></div>
                            </div>	
                        </li>
                        <li class="basket-contents basket-contents-full">
                        </li>
                    </ul>
                </div>
            </div>
            <!--END TOP BASKET-->

        </header>
        <!--END HEADER-->
        <?php

        function my_custom_submenu($menuVal) {
            $menu_items = wp_get_nav_menu_items('mainmenu');
            $menuCount = 0;
            foreach ($menu_items as $item) {
                if ($item->menu_item_parent == $menuVal) {
                    $menuCount++;
                }
            }
            if ($menuCount > 0) {
                echo '<div class="dropdown">
            <div class="sub_wrapper">
                <ul>';
                foreach ($menu_items as $item) {
                    if ($item->menu_item_parent == $menuVal) {
                        echo '<li class="inactive"><a href="' . $item->url . '">' . $item->title . '</a></li>';
                    }
                }
                echo '</ul></div></div>';
            }
        }
        ?>