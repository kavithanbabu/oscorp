<?php
show_admin_bar(FALSE);

require_once(TEMPLATEPATH . "/lib/admin-config.php");

register_nav_menu('mainmenu', 'Main Navigation');
register_nav_menu('myaccount', 'Footer Navigation 1');
register_nav_menu('customer_service', 'Footer Navigation 2');
register_nav_menu('footer_links', 'Footer Links');

remove_filter('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 20);
add_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_add_to_cart', 20);

remove_filter('woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10 );
add_action('woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open1', 10 );

if (!function_exists('woocommerce_template_loop_add_to_cart')) {

    /**
     * Get the add to cart template for the loop.
     *
     * @subpackage	Loop
     */
    function woocommerce_template_loop_add_to_cart($args = array()) {
        global $product;

        if ($product) {
            $defaults = array(
                'quantity' => 1,
                'class' => implode(' ', array_filter(array(
                    'product_type_' . $product->get_type(),
                    $product->is_purchasable() && $product->is_in_stock() ? 'add_to_cart_button' : '',
                    $product->supports('ajax_add_to_cart') ? 'ajax_add_to_cart' : '',
                ))),
            );

            $args = apply_filters('woocommerce_loop_add_to_cart_args', wp_parse_args($args, $defaults), $product);

            wc_get_template('loop/add-to-cart.php', $args);
        }
    }

}

/**
 * Insert the opening anchor tag for products in the loop.
 */
function woocommerce_template_loop_product_link_open1() {
    echo '<figure><a href="' . get_the_permalink() . '" class="woocommerce-LoopProduct-link">';
}

if ( ! function_exists( 'woocommerce_template_loop_product_title' ) ) {

	/**
	 * Show the product title in the product loop. By default this is an H2.
	 */
	function woocommerce_template_loop_product_title() {
		echo '<figcaption><a href="' . get_the_permalink() . '" class="woocommerce-LoopProduct-link"><h5>' . get_the_title() . '</h5></a></figcaption></figure>';
	}
}

add_action( 'after_setup_theme', 'woocommerce_support' );
function woocommerce_support() {
    add_theme_support( 'woocommerce' );
}

remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);

add_action('woocommerce_before_main_content', 'my_theme_wrapper_start', 10);
add_action('woocommerce_after_main_content', 'my_theme_wrapper_end', 10);

function my_theme_wrapper_start() {
	
	if(is_product()){
		global $post, $product;
		$product = $post;
		$title = $post->post_title;
	} elseif(is_product_category()){
		$title = single_cat_title('', false);
	}
	echo '<div class="container-wrapper">
				<div class="title-container">
					<div class="row">
					   <section class="grid_12 col nobotmargin notopmargin" id="page-title">
							<h2>'.$title.'</h2>
						</section> 				
					</div>
				</div>
		  </div>
		  <div class="container-wrapper">
			<div class="container-with-border" id="mainContent">
				<div class="row">';
}

function my_theme_wrapper_end() {
	echo '</div>
			</div>
				</div>';
}

//woocommerce breadcrumb overwrite
add_filter( 'woocommerce_breadcrumb_defaults', 'jk_woocommerce_breadcrumbs' );
function jk_woocommerce_breadcrumbs() {
    return array(
            'delimiter'   => ' / ',
            'wrap_before' => '<div class="grid_12 col"><div class="crumbs boxbottomBorder"><ul class="crumbs">',
            'wrap_after'  => '</ul></div></div>',
            'before'      => '<li>',
            'after'       => '</li>',
            'home'        => _x( 'Home', 'breadcrumb', 'woocommerce' ),
        );
}

add_action( 'get_header', 'bbloomer_remove_storefront_sidebar' );
 
function bbloomer_remove_storefront_sidebar() {
    if ( is_product() ) {
        remove_action( 'storefront_sidebar', 'storefront_get_sidebar', 10 );
    }
}

function wc_remove_related_products( $args ) {
 return array();
}
add_filter( 'woocommerce_related_products_args','wc_remove_related_products', 10 );

