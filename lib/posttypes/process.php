<?php

//testimonial post type
add_action('init', 'create_process', 0);

function create_process() {
    $labels = array(
        'name' => _x('Process', 'post type general name'),
        'singular_name' => _x('Process', 'post type singular name'),
        'add_new' => _x('Add Process', 'Event'),
        'add_new_item' => __('Add Process'),
        'edit_item' => __('Edit Process'),
        'new_item' => __('New Process'),
        'view_item' => __('View Process'),
        'search_items' => __('Search Process'),
        'not_found' => __('No Process found'),
        'not_found_in_trash' => __('No Process found in Trash'),
        'parent_item_colon' => ''
    );

    $args = array(
        'labels' => $labels,
		   'public' => true,
		   'publicly_queryable' => true,
		   'show_ui' => true,
		   'query_var' => true,
		   'rewrite' => array('slug' => 'process','with_front' => FALSE,),
		   'capability_type' => 'post',
		   'hierarchical' => true,
		   'menu_position' => 7,
		   'supports' => array( 'title', 'editor', 'thumbnail','excerpt','page-attributes')
    );

    //Register the testimonial post type.
    register_post_type('process', $args);
}

?>