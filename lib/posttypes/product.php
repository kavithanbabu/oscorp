<?php add_action('init', 'create_product', 0);

function create_product() {
    $labels = array(
        'name' => _x('Products', 'post type general name'),
        'singular_name' => _x('Product', 'post type singular name'),
        'add_new' => _x('Add Product', 'Event'),
        'add_new_item' => __('Add Product'),
        'edit_item' => __('Edit Product'),
        'new_item' => __('New Product'),
        'view_item' => __('View Product'),
        'search_items' => __('Search Product'),
        'not_found' => __('No Product found'),
        'not_found_in_trash' => __('No Product found in Trash'),
        'parent_item_colon' => ''
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'query_var' => true,
        'hierarchical' => true,
		'rewrite' => array('slug' => 'products','with_front' => FALSE,),
        'menu_position' => 7,
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt', 'page-attributes')
    );

    //Register the product_post post type.
    register_post_type('products', $args);
}
?>