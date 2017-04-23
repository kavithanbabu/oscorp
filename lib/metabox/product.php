<?php
add_action('admin_menu', 'product_spec_options');

function product_spec_options() {
    add_meta_box('product_spec_options', 'Product Specifications', 'product_spec_options_design', 'products');
}

function product_spec_options_design($post_id) {
    global $post;
    $display_home = get_post_meta($post->ID, 'display_home', true);
    $upcoming_app = get_post_meta($post->ID, 'upcoming_app', true);
    $android_url = get_post_meta($post->ID, 'android_url', true);
    $iphone_url = get_post_meta($post->ID, 'iphone_url', true);
    $feature1 = get_post_meta($post->ID, 'feature1', true);
    $feature2 = get_post_meta($post->ID, 'feature2', true);
    $feature3 = get_post_meta($post->ID, 'feature3', true);
    $feature4 = get_post_meta($post->ID, 'feature4', true);

    ?>
    <table class="pdf" cellpadding="5" cellspacing="10">

        <tr>
            <td class="left"><label for="tax-order">Display in Home</label></td>
            <td  class="right" width="400">
				<select name="display_home">
					<option value="0">No</option>
					<option <?php echo (($display_home)?'selected="selected"':''); ?> value="1">Yes</option>
				</select>
			</td>
        </tr>
        <tr>
            <td class="left"><label for="tax-order">Upcoming apps</label></td>
            <td  class="right" width="400">
				<select name="upcoming_app">
					<option value="0">No</option>
					<option <?php echo (($upcoming_app)?'selected="selected"':''); ?> value="1">Yes</option>
				</select>
			</td>
        </tr>
        <tr>
            <td class="left"><label for="tax-order">Android URL</label></td>
            <td  class="right" width="400"><input type="text" name="android_url"  value="<?php echo $android_url; ?>" id="width" style="width:400px;"/></td>
        </tr>
        <tr>
            <td class="left"><label for="tax-order">Iphone URL</label></td>
            <td  class="right" width="400"><input type="text" name="iphone_url"  value="<?php echo $iphone_url; ?>" id="height" style="width:400px;"/></td>
        </tr>
        <tr>
            <td class="left"><label for="tax-order">Feature 1 content</label></td>
            <td  class="right" width="400">
			<?php
				$settings = array( 'media_buttons' => true,'quicktags' => false );
				$content = $feature1;                     
				$editor_id = 'feature1';
				wp_editor( $content, $editor_id,$settings );
			?>
			</td>
        </tr>
		<tr>
            <td class="left"><label for="tax-order">Feature 2 content</label></td>
            <td  class="right" width="400">
			<?php
				$settings = array( 'media_buttons' => true,'quicktags' => false );
				$content = $feature2;                     
				$editor_id = 'feature2';
				wp_editor( $content, $editor_id,$settings );
			?>
			</td>
        </tr>
		<tr>
            <td class="left"><label for="tax-order">Feature 3 content</label></td>
            <td  class="right" width="400">
			<?php
				$settings = array( 'media_buttons' => true,'quicktags' => false );
				$content = $feature3;                     
				$editor_id = 'feature3';
				wp_editor( $content, $editor_id,$settings );
			?>
			</td>
        </tr>
		<tr>
            <td class="left"><label for="tax-order">Feature 4 content</label></td>
            <td  class="right" width="400">
			<?php
				$settings = array( 'media_buttons' => true,'quicktags' => false );
				$content = $feature4;                     
				$editor_id = 'feature4';
				wp_editor( $content, $editor_id,$settings );
			?>
			</td>
        </tr>
    </table>
    <?php
}

add_action('save_post', 'save_product_spec');

function save_product_spec($post_id) {
    global $post;
    if (get_post_type($post_id) == 'products') {

// do not save if this is an auto save routine
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
            return $post->ID;

        update_post_meta($post_id, 'display_home', $_REQUEST['display_home']);
        update_post_meta($post_id, 'upcoming_app', $_REQUEST['upcoming_app']);
        update_post_meta($post_id, 'android_url', $_REQUEST['android_url']);
        update_post_meta($post_id, 'iphone_url', $_REQUEST['iphone_url']);
        update_post_meta($post_id, 'feature1', $_REQUEST['feature1']);
        update_post_meta($post_id, 'feature2', $_REQUEST['feature2']);
        update_post_meta($post_id, 'feature3', $_REQUEST['feature3']);
        update_post_meta($post_id, 'feature4', $_REQUEST['feature4']);
    }
}


?>