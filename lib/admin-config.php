<?php

if (is_admin()) {
    wp_enqueue_script("jquerydate", "http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js", false, "1.0");
    wp_enqueue_script("rmscript", get_bloginfo('template_url') . "/lib/js/common.js", false, "1.0");
    wp_enqueue_script("tabs", get_bloginfo('template_url') . "/lib/common/jquery.idTabs.min.js", false, "1.0");
    wp_enqueue_script("uidate", get_bloginfo('template_url') . "/lib/js/jquery.ui.datepicker.js", false, "1.0");

    function load_styles() {
        wp_enqueue_style('demo', get_bloginfo('template_url') . '/lib/common/demos.css', false, '1.1', 'all');
        wp_enqueue_style('datetime', get_bloginfo('template_url') . '/lib/css/jquery.ui.datepicker.css', false, '1.1', 'all');
    }

    add_action('init', 'load_styles');
}

include('includes/theme-options.php');
//include('includes/pagination.php');
//include('metabox/gallery.php');
//include('includes/admin-entry-pages.php');
