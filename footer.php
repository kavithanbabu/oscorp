<!--START FOOTER-->
<footer class="container-wrapper" id="footer-section">
    <div class="container" id="mainFooter">
        <div class="row">
            <div class="grid_3 col">
                <h4>Stay Connected</h4>
            </div>
            <div class="grid_6 col">
                <h4>Keep up to date with our latest offers and products.</h4>
                <div class="subscribe-wrapper">
                    <div class="subscribe-form" id="newsletter-subscribe-block">
                        <input class="newsletter-subscribe-text input-text" id="newsletter-email" name="NewsletterEmail" placeholder="Enter your email here..." type="text" value="" />
                        <button type="submit" title="Search" class="button" id="newsletter-subscribe-button"><span><span>Subscribe</span></span></button>
                    </div>
                    <div id="newsletter-result-block" class="showMsg"></div>
                </div>
            </div>
            <div class="grid_3 col text-right">
                <h4>100% Secure Shopping</h4>
                <img src="<?php echo get_bloginfo('template_url'); ?>/Plugins/Payments.SagePayDirect/Content/images/logo.png" alt="Sage Pay" style="max-width: 100%;width: auto;"/>
            </div>
        </div>
    </div>
</footer>
<div class="container-wrapper" id="secondary-footer-section">
    <div class="container">
        <div class="row">
            <article class="grid_4 col">
                <div class="topic-block">
                    <div class="topic-block-body">
                        <?php
                        $postval = get_post(get_option('footer_id'));
                        ?>
                        <h3 class="bottomBorder"><?php echo $postval->post_title; ?></h3>
                        <?php echo apply_filters('the_content', $postval->post_content); ?>
                    </div>
                </div>

            </article>
            <article class="grid_3 col">
                <h3 class="bottomBorder">CUSTOMER SERVICE</h3>
                <?php wp_nav_menu(array('theme_location' => 'customer_service', 'menu_class' => 'norm_list has_icon', 'menu_id' => '', 'container' => '', 'container_class' => '')); ?>
            </article>
            <article class="grid_2 col">
                <h3 class="bottomBorder">MY ACCOUNT</h3>
                <?php wp_nav_menu(array('theme_location' => 'myaccount', 'menu_class' => 'norm_list has_icon', 'menu_id' => '', 'container' => '', 'container_class' => '')); ?>
            </article>
            <article class="grid_3 col">
                <img class="avec-logo" src="<?php echo get_bloginfo('template_url'); ?>/Themes/KL-Theme/Content/images/avec-logo.png" />
            </article>
        </div>
    </div>
</div>
<div class="container-wrapper" id="third-footer-section">
    <div class="container">
        <div class="row">
            <div class="grid_12 col notopmargin nobotmargin">
                <ul class="footer_list">
                    <li class="right text-right">Copyright &copy; 2017 dalkurd FC Store. All rights reserved.</li>
                    <li><a href="<?php echo get_bloginfo('url') ?>/shipping-returns">Shipping &amp; Returns</a></li>
                    <li><a href="<?php echo get_bloginfo('url') ?>/privacy-notice">Privacy Notice</a></li>
                    <li><a href="<?php echo get_bloginfo('url') ?>/conditions-of-use">Conditions of Use</a></li>
                    <li><a href="http://www.untiedshoes.co.uk/" title="Freelance web developer">Freelance web developer</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!--END FOOTER-->
<script src="<?php echo get_bloginfo('template_url'); ?>/Scripts/vendor/app.js"></script>
<script src="<?php echo get_bloginfo('template_url'); ?>/Scripts/plugins.js"></script>
<script src="<?php echo get_bloginfo('template_url'); ?>/Scripts/main.js"></script>
<script src="<?php echo get_bloginfo('template_url'); ?>/js/custom.js"></script>
</body>
</html>