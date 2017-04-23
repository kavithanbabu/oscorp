<?php

//team post type
add_action('init', 'create_team', 0);

function create_team() {
    $labels = array(
        'name' => _x('Team', 'post type general name'),
        'singular_name' => _x('Team', 'post type singular name'),
        'add_new' => _x('Add member', 'Event'),
        'add_new_item' => __('Add member'),
        'edit_item' => __('Edit member'),
        'new_item' => __('New member'),
        'view_item' => __('View member'),
        'search_items' => __('Search member'),
        'not_found' => __('No member found'),
        'not_found_in_trash' => __('No member found in Trash'),
        'parent_item_colon' => ''
    );

    $args = array(
        'labels' => $labels,
		   'public' => true,
		   'publicly_queryable' => true,
		   'show_ui' => true,
		   'query_var' => true,
		   'rewrite' => array('slug' => 'team','with_front' => FALSE,),
		   'capability_type' => 'post',
		   'hierarchical' => true,
		   'menu_position' => 7,
		   'supports' => array( 'title', 'editor', 'thumbnail','excerpt','page-attributes')
    );

    //Register the team post type.
    register_post_type('team', $args);
}

?>