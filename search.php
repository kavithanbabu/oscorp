<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */
get_header();
?>


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
                                <li><a href="index.html" title="Home">home</a> /</li>
                                <li>apparel</li>
                            </ul>
                        </div>
                    </div>
                    <!--END BREAD CRUMBS-->

                    <hr class="thin_light" />

                    <section class="grid_12 col upsell productResultsLists">
                        <header>
                            <h3 class="bottomBorderLight">
                                <?php if (have_posts()) : ?>
                                    <?php printf(__('Search Results for: %s', 'twentyseventeen'), '<span>' . get_search_query() . '</span>'); ?>
                                <?php else : ?>
                                    <?php _e('Nothing Found', 'twentyseventeen'); ?>
                                <?php endif; ?>
                            </h3>
                        </header>
                        <div class="productResultsLists notopmargin">
                            <div class="row">
                                <?php
                                if (have_posts()) :
                                    /* Start the Loop */
                                    while (have_posts()) : the_post();

                                        /**
                                         * Run the loop for the search to output the results.
                                         * If you want to overload this in a child theme then include a file
                                         * called content-search.php and that will be used instead.
                                         */
                                        get_template_part('template-parts/post/content', 'excerpt');

                                    endwhile; // End of the loop.

                                    the_posts_pagination(array(
                                        'prev_text' => twentyseventeen_get_svg(array('icon' => 'arrow-left')) . '<span class="screen-reader-text">' . __('Previous page', 'twentyseventeen') . '</span>',
                                        'next_text' => '<span class="screen-reader-text">' . __('Next page', 'twentyseventeen') . '</span>' . twentyseventeen_get_svg(array('icon' => 'arrow-right')),
                                        'before_page_number' => '<span class="meta-nav screen-reader-text">' . __('Page', 'twentyseventeen') . ' </span>',
                                    ));

                                else :
                                    ?>

                                    <p><?php _e('Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'twentyseventeen'); ?></p>
                                    <?php
                                    get_search_form();

                                endif;
                                ?>
                            </div>
                        </div>
                    </section>
                    <hr class="thin_light" />

                </div>
            </div>
            <!--END RIGHT CONTENT-->
            <?php get_sidebar('menu') ?>
        </div>
    </div>
</div>
<!--END MAIN CONTAINER-->
<?php get_footer();
