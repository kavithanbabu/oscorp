<?php 
add_action('admin_menu', 'news_banner_image_option');

function news_banner_image_option() 
{
     add_meta_box('news_banner_options', 'Post Options', 'news_banner_image_options_design', 'post');
	 
}


function news_banner_image_options_design($post_id) 
{
	global $post;
	$post_type = get_post_meta($post->ID,'post_type',true);
?>
<table class="post_image" cellpadding="5" cellspacing="10">
	<tr>
		<td class="left"><label for="tax-order">Post type</label></td>
		<td  class="right" width="400">
			<select name="post_type">
			<option <?php echo (($post_type == 1)?'selected="selected"':''); ?> value="1">Article</option>
			<option <?php echo (($post_type == 2)?'selected="selected"':''); ?> value="2">Image</option>
			<option <?php echo (($post_type == 3)?'selected="selected"':''); ?> value="3">Video</option>
			</select>
		</td>
	</tr>
  </table>
<?php      
}


add_action('save_post', 'save_news_banner_image');

function save_news_banner_image($post_id)
{
	global $post;
    if (get_post_type($post_id) == 'post') {
		// do not save if this is an auto save routine
		if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
		return $post->ID;

		update_post_meta($post_id, 'post_type', $_REQUEST['post_type']);
	}
}

?>