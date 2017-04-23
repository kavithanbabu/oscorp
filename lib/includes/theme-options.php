<?php

function theme_menu() {
    add_menu_page('Theme Options', 'Theme Options', 'administrator', 'options_page', 'theme_options_page');
}

add_action('admin_menu', 'theme_menu');

function theme_options_page() {
    if (isset($_REQUEST['submit'])) {
        update_option('upload_image', $_REQUEST['upload_image']);
        update_option('logo_image', $_REQUEST['logo_image']);
        update_option('spc_cats', $_REQUEST['spc_cats']);

        update_option('facebook_url', $_REQUEST['facebook_url']);
        update_option('twitter_url', $_REQUEST['twitter_url']);
        update_option('instagram_url', $_REQUEST['instagram_url']);
        update_option('pin_url', $_REQUEST['pin_url']);
        update_option('footer_id', $_REQUEST['footer_id']);

        update_option('sidebar_image', $_REQUEST['sidebar_image']);
        update_option('ad_redirect_url', $_REQUEST['ad_redirect_url']);
        update_option('footer_image', $_REQUEST['footer_image']);
        update_option('fad_redirect_url', $_REQUEST['fad_redirect_url']);

        $updated = 1;
    }
    ?>
    <?php if ($updated == 1) { ?>
        <div class="updated" style="margin-top: 10px;"><p>Details Updated Successfully</p></div>
    <?php } ?>
    <div id="usual2" class="usual"> 

        <form name="options" id="options" action="" method="post">
            <h1>Theme Options <br /><br /></h1>
            <ul> 
                <li><a href="#tabs1">Home Page Settings</a></li> 
                <li><a href="#tabs2">General Settings</a></li> 
                <li><a href="#tabs3">Ad Settings</a></li> 
            </ul> 
            <div id="tabs1" class="tab">
                <?php /*<div class="contaniner">
                    <tr valign="top">
                    <div class="label">Logo Image</div>
                    <td><label for="upload_image">
                            <input id="upload_image" type="text" name="upload_image" style="width: 40%;" value="<?php echo get_option('upload_image'); ?>" />
                            <input id="upload_image_button" type="button" value="Upload Image" />
                        </label></td>
                    </tr>
                </div>*/ ?>
                <div class="contaniner">
                    <div class="label">Special Category IDs</div>
                    <div class="field"><input type="text" name="spc_cats" id="spc_cats" value="<?php echo get_option('spc_cats'); ?>" />
                    <br /><small>Comma seperated values</small>
                    </div>
                </div>
            </div> 
            <div id="tabs2" class="tab">
                <div class="contaniner">
                    <div class="label">Footer Page ID</div>
                    <div class="field"><input type="text" name="footer_id" id="footer_id" value="<?php echo get_option('footer_id'); ?>" /></div>
                </div>
                <div class="contaniner">
                    <div class="label">Twitter Url</div>
                    <div class="field"><input type="text" name="twitter_url" id="twitter_url" value="<?php echo get_option('twitter_url'); ?>" /></div>
                </div>
                <div class="contaniner">
                    <div class="label">Facebook Url</div>
                    <div class="field"><input type="text" name="facebook_url" id="facebook_url" value="<?php echo get_option('facebook_url'); ?>" /></div>
                </div>
                <div class="contaniner">
                    <div class="label">Instagram Url</div>
                    <div class="field"><input type="text" name="instagram_url" id="instagram_url" value="<?php echo get_option('instagram_url'); ?>" /></div>
                </div>
                <div class="contaniner">
                    <div class="label">Pintrust Url</div>
                    <div class="field"><input type="text" name="pin_url" id="pin_url" value="<?php echo get_option('pin_url'); ?>" /></div>
                </div>
            </div>
            <div id="tabs3" class="tab">
                <div class="contaniner">
                    <div class="label">Sidebar Ad Image URL</div>
                    <div class="field"><input type="text" name="sidebar_image" id="sidebar_image" value="<?php echo get_option('sidebar_image'); ?>" /></div>
                </div>
                <div class="contaniner">
                    <div class="label">Sidebar Ad Image Redirect URL</div>
                    <div class="field"><input type="text" name="ad_redirect_url" id="ad_redirect_url" value="<?php echo get_option('ad_redirect_url'); ?>" /></div>
                </div>
                <div class="contaniner">
                    <div class="label">Footer Ad Image URL</div>
                    <div class="field"><input type="text" name="footer_image" id="footer_image" value="<?php echo get_option('footer_image'); ?>" /></div>
                </div>
                <div class="contaniner">
                    <div class="label">Footer Ad Image Redirect URL</div>
                    <div class="field"><input type="text" name="fad_redirect_url" id="fad_redirect_url" value="<?php echo get_option('fad_redirect_url'); ?>" /></div>
                </div>
            </div> 
            <br style="clear:both;" />
            <input type="submit" class="btn" name="submit" value="Save Options" style="margin-top:20px;" />
        </form>
    </div> 

    <script type="text/javascript">
        jQuery("#usual2 ul").idTabs();
        jQuery(document).ready(function () {
            jQuery('#upload_image_button').click(function () {
                formfield = jQuery('#upload_image').attr('name');
                tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
                return false;
            });

            window.send_to_editor = function (html) {
                imgurl = jQuery('img', html).attr('src');
                jQuery('#upload_image').val(imgurl);
                tb_remove();
            }
        });
    </script>

<?php }
?>
