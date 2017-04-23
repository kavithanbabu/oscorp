<?php
/*
 * Template Name: Home Page
 */
get_header();
?>
<div class="container-wrapper">
    <div class="title-container">
        <div class="row">
            <!--BREADCRUMBS-->
            <section class="grid_12 col nobotmargin notopmargin" id="page-title">
                <h2><?php echo $post->post_title; ?></h2>
            </section>
            <!--END BREADCRUMBS-->
        </div>
    </div>
</div>

<!--START MAIN CONTAINER-->
<div class="container-wrapper">
    <div class="container-with-border" id="mainContent">
        <div class="row">
            <!--RIGHT CONTENT-->
            <div class="grid_9 col push_3">
                <div class="row">
                    <!--START BREAD CRUMBS-->
                    <div class="grid_12 col notopmargin">
                        <div class="crumbs boxbottomBorder" style="padding-bottom: 6px !important;">
                            <ul>
                                <li><a href="<?php echo get_bloginfo('url'); ?>/" title="Home">home</a> /</li>
                                <li><?php echo $post->post_title; ?></li>
                            </ul>
                        </div>
                    </div>
                    <!--END BREAD CRUMBS-->

                    <hr class="thin_light" />

                    <!--START INTRO-->
                    <div class="pageIntro grid_12 col">
                        <?php echo apply_filters('the_content', $post->post_content); ?>
                    </div>
                    <!--END INTRO-->
                    <hr class="thin_light" />
                    <?php
                    $spc_cats = explode(',', get_option('spc_cats'));
                    foreach ($spc_cats as $homePageCat) {
                        $s_term = get_term_by('id', $homePageCat, 'product_cat');
                        ?>
                        <section class="grid_12 col upsell productResultsLists">
                            <header><h3 class="bottomBorderLight"><?php echo $s_term->name ?></h3></header>
                            <div class="hide-screen"></div>
                            <div class="info"><p class="right viewAll"><a href="<?php echo get_term_link($s_term->slug, 'product_cat'); ?>">VIEW ALL <?php echo $s_term->name ?></a></p><p>Featured <a href="<?php echo get_term_link($s_term->slug, 'product_cat'); ?>"><?php echo $s_term->name ?></a> Products</p></div>
                            <div class="productResultsLists notopmargin">
                                <div class="row">
                                    <?php
                                    $args = array(
                                        'post_type' => 'product',
                                        'tax_query' => array(
                                            array(
                                                'taxonomy' => 'product_cat',
                                                'field' => 'slug', //can be set to ID
                                                'terms' => $s_term->slug //if field is ID you can reference by cat/term number
                                            )
                                        )
                                    );
                                    $loop = new WP_Query($args);


                                    if ($loop->have_posts()) {
                                        while ($loop->have_posts()) : $loop->the_post();
                                            wc_get_template_part('content', 'product');
                                        endwhile;
                                    } else {
                                        echo __('No products found');
                                    }
                                    wp_reset_postdata();
                                    ?>
                                </div>
                            </div>
                        </section>
                        <hr class="thin_light" />
                        <?php
                    }
                    ?>
                </div>
            </div>
            <!--END RIGHT CONTENT-->
            <?php get_sidebar('menu'); ?>
        </div>
    </div>
</div>
<!--END MAIN CONTAINER-->
<?php
get_footer();
