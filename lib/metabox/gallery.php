<?php

define("THUMB_DIR", WP_CONTENT_DIR . '/uploads/'); 
define("THUMB_URL", WP_CONTENT_URL . '/uploads/'); 

// needs to be implemented

function fileupload( $label ) { ?>
    <tr>
        <td class="left_label"> <?php
            echo $label; ?>
        </td>
        <td>
            <form name="uploadfile" id="uploadfile_form" method="POST" enctype="multipart/form-data" action="<?php echo $this->filepath.'#uploadfile'; ?>" accept-charset="utf-8" >
                <input type="file" name="uploadfiles[]" id="uploadfiles" size="35" class="uploadfiles" />
                <input class="button-primary" type="submit" name="uploadfile" id="uploadfile_btn" value="Upload"  />
            </form>
        </td>
    </tr>  <?php
}

// this too

function fileupload_process() { 
    $uploadfiles = $_FILES['uploadfiles'];

    if (is_array($uploadfiles)) {

        foreach ($uploadfiles['name'] as $key => $value) {

            // look only for uploded files
            if ($uploadfiles['error'][$key] == 0) {

                $filetmp = $uploadfiles['tmp_name'][$key];

                //clean filename and extract extension
                $filename = $uploadfiles['name'][$key];

                // get file info
                // @fixme: wp checks the file extension....
                $filetype = wp_check_filetype( basename( $filename ), null );
                $filetitle = preg_replace('/\.[^.]+$/', '', basename( $filename ) );
                $filename = $filetitle . '.' . $filetype['ext'];
                $upload_dir = wp_upload_dir();

                /**
                 * Check if the filename already exist in the directory and rename the
                 * file if necessary
                 */
                $i = 0;
                while ( file_exists( $upload_dir['path'] .'/' . $filename ) ) {
                    $filename = $filetitle . '_' . $i . '.' . $filetype['ext'];
                    $i++;
                }
                $filedest = $upload_dir['path'] . '/' . $filename;

                /**
                 * Check write permissions
                 */
                if ( !is_writeable( $upload_dir['path'] ) ) {
                    $this->msg_e('Unable to write to directory %s. Is this directory writable by the server?');
                    return;
                }

                /**
                 * Save temporary file to uploads dir
                 */
                if ( !@move_uploaded_file($filetmp, $filedest) ){
                    $this->msg_e("Error, the file $filetmp could not moved to : $filedest ");
                    continue;
                }

                $attachment = array(
                    'post_mime_type' => $filetype['type'],
                    'post_title' => $filetitle,
                    'post_content' => '',
                    'post_status' => 'inherit'
                );

                $attach_id = wp_insert_attachment( $attachment, $filedest );
                require_once( ABSPATH . "wp-admin" . '/includes/image.php' );
                $attach_data = wp_generate_attachment_metadata( $attach_id, $filedest );
                wp_update_attachment_metadata( $attach_id,  $attach_data );
            }
        }
    }
}

add_action('admin_menu', "post_upload_box_init");
add_action('save_post', 'post_save_thumb');

function post_upload_box_init() {
    add_meta_box("post-thumbnail-posting", "Background Image Options", "post_upload_thumbnail", 'post', "advanced");
}

function post_upload_thumbnail() {
    global $post;
?>
    <script type="text/javascript">
        document.getElementById("post").setAttribute("enctype","multipart/form-data");
        document.getElementById('post').setAttribute('encoding','multipart/form-data');
    </script>

    <?php
        $thumb = get_post_meta($post->ID, 'custom_thumbnail',true);

        if ( $thumb )
        {
    ?>
    <div style="float: left; margin-right: 10px;">
        <img style="border: 1px solid #ccc; padding: 3px;" src="<?php echo get_bloginfo('template_url').'/thumb.php?w=150&h=150&zc=0&src='.THUMB_URL . $thumb; ?>" alt="Thumbnail preview" />
    </div>
    <?php
        }
        else
        {
    ?>
    <div style="float: left; margin-right: 10px; width: 200px; height: 150px; line-height: 150px; border: solid 1px #ccc; text-align: center;">Image preview</div>
    <?php } ?>
    
    <div style="float: left;">
        <p>
            <label for="thumb-url-upload"><?php _e("Upload via URL, or Select Image (Below)"); ?>:</label><br />
            <input style="width: 300px; margin-top:5px;" id="thumb-url-upload" name="thumb-url-upload" type="text" />
        </p>    
        <p>
            <p><label for="thumbnail"><?php _e("Upload a Image"); ?>:</label><br />
            <input id="thumbnail" type="file" name="thumbnail" />
        </p>
        <p><input id="thumb-delete" type="checkbox" name="thumb-delete"> <label for="thumb-delete"><?php _e("Delete image"); ?></label></p>
         
        <p style="margin:10px 0 0 0;"><input id="publish" class="button-primary" type="submit" value="<?php _e("Update Post"); ?>" accesskey="p" tabindex="5" name="save"/></p>
    </div>
    
    <div class="clear"></div>
<?php
}

function post_save_thumb( $postID )
{
    global $wpdb;

    // Get the correct post ID if revision.
    if ( $wpdb->get_var("SELECT post_type FROM $wpdb->posts WHERE ID=$postID")=='revision')
        $postID = $wpdb->get_var("SELECT post_parent FROM $wpdb->posts WHERE ID=$postID");

    if ( $_POST['thumb-delete'] )
    {
        @unlink(THUMB_DIR . get_post_meta($postID, 'custom_thumbnail', true));
        delete_post_meta($postID, 'custom_thumbnail');
    }
    elseif ( $_POST['thumb-url-upload'] || !empty($_FILES['thumbnail']['tmp_name']) )
    {
        if ( !empty($_FILES['thumbnail']['name']) )
            preg_match("/(\.(?:jpg|jpeg|png|gif))$/i", $_FILES['thumbnail']['name'], $matches);
        else
            preg_match("/(\.(?:jpg|jpeg|png|gif))$/i", $_POST['thumb-url-upload'], $matches);
        
        $thumbFileName = $postID . strtolower($matches[0]);
   
        // Location of thumbnail on server.
        $loc = THUMB_DIR . $thumbFileName;
        
        $thumbUploaded = false;
   
        if ( $_POST['thumb-url-upload'] )
        {
            // Try just using fopen to download the image.
            if( ini_get('allow_url_fopen') )
            {
                copy($_POST['thumb-url-upload'], $loc);
                $thumbUploaded = true;

            }
            else
            
            // If fopen doesn't work, try cURL.
            if( function_exists('curl_init') )
            {
                $ch = curl_init($_POST['thumb-url-upload']);
                $fp = fopen($loc, "wb");
   
                $options = array(CURLOPT_FILE => $fp,
                    CURLOPT_HEADER => 0,
                    CURLOPT_FOLLOWLOCATION => 1,
                    CURLOPT_TIMEOUT => 60);
                curl_setopt_array($ch, $options);
                
                curl_exec($ch);
                curl_close($ch);
   
                fclose($fp);
                $thumbUploaded = true;
            }
        }
        else
   
        // Attempt to move the uploaded thumbnail to the thumbnail directory.
        if ( !empty($_FILES['thumbnail']['tmp_name']) && move_uploaded_file($_FILES['thumbnail']['tmp_name'], $loc) )
            $thumbUploaded = true;
        
        if ( $thumbUploaded )
        {
            if ( !update_post_meta($postID, 'custom_thumbnail', $thumbFileName) )
                add_post_meta($postID, 'custom_thumbnail', $thumbFileName);
        }

    }
}

?>