<?php
add_action('admin_menu', 'team_spec_options');

function team_spec_options() {
    add_meta_box('team_details', 'Team Details', 'team_details_function', 'team');
}

function team_details_function($post_id) {
    global $post;
    $designation = get_post_meta($post->ID, 'designation', true);
    $linkedin_url = get_post_meta($post->ID, 'linkedin_url', true);
    $facebook_url = get_post_meta($post->ID, 'facebook_url', true);
    $twitter_url = get_post_meta($post->ID, 'twitter_url', true);
    ?>
    <table class="pdf" cellpadding="5" cellspacing="10">

        <tr>
            <td class="left"><label for="tax-order">Designation</label></td>
            <td  class="right" width="400"><input type="text" name="designation"  value="<?php echo $designation; ?>" id="width" style="width:400px;"/></td>
        </tr>
        <tr>
            <td class="left"><label for="tax-order">Linkedin URL</label></td>
            <td  class="right" width="400"><input type="text" name="linkedin_url"  value="<?php echo $linkedin_url; ?>" id="height" style="width:400px;"/></td>
        </tr>
        <tr>
            <td class="left"><label for="tax-order">Facebook URL</label></td>
            <td  class="right" width="400"><input type="text" name="facebook_url"  value="<?php echo $facebook_url; ?>" id="height" style="width:400px;"/></td>
        </tr>
        <tr>
            <td class="left"><label for="tax-order">Twitter URL</label></td>
            <td  class="right" width="400"><input type="text" name="twitter_url"  value="<?php echo $twitter_url; ?>" id="height" style="width:400px;"/></td>
        </tr>
   
    </table>
    <?php
}

add_action('save_post', 'save_team_spec');

function save_team_spec($post_id) {
    global $post;
    if (get_post_type($post_id) == 'team') {

// do not save if this is an auto save routine
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
            return $post->ID;

        update_post_meta($post_id, 'designation', $_REQUEST['designation']);
        update_post_meta($post_id, 'linkedin_url', $_REQUEST['linkedin_url']);
        update_post_meta($post_id, 'facebook_url', $_REQUEST['facebook_url']);
        update_post_meta($post_id, 'twitter_url', $_REQUEST['twitter_url']);

    }
}


?>