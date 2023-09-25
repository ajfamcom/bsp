<?php
/*

Plugin Name: Random Image Uploader
Description: Allows users to upload images to a custom folder.
Version: 1.0
Author: Famcom
*/
function custom_image_uploader_menu_page() {
    add_menu_page(
        'Random Image Uploader',
        'Random Image Uploader',
        'manage_options',
        'custom-image-uploader',
        'custom_image_uploader_page',
        'dashicons-admin-media'
    );

    add_submenu_page(
        'custom-image-uploader', // Parent slug
        'Existing Images', // Page title
        'Existing Images', // Menu title
        'manage_options', // Capability
        'custom-image-uploader-images', // Menu slug
        'custom_image_uploader_images_page' // Callback function
    );

}
add_action('admin_menu', 'custom_image_uploader_menu_page');

function custom_image_uploader_page() {
    if(isset($_POST['upload_image'])) {
        $uploaded_file = $_FILES['custom_image'];
        $upload_dir = wp_upload_dir(); // Get the default upload directory
        $custom_images_dir = $upload_dir['basedir'] . '/custom-images';

        if (!file_exists($custom_images_dir)) {
            wp_mkdir_p($custom_images_dir); // Create the custom-images folder if it doesn't exist
        }

        if($uploaded_file['error'] == 0) {
            $file_name = sanitize_file_name($uploaded_file['name']); // Sanitize the file name
            $upload_path = $custom_images_dir . '/' . $file_name;

            // Move the uploaded file to the custom folder
            if(move_uploaded_file($uploaded_file['tmp_name'], $upload_path)) {
                echo '<div class="updated"><p>File uploaded successfully!</p></div>';
            } else {
                echo '<div class="error"><p>Failed to upload file.</p></div>';
            }
        } else {
            echo '<div class="error"><p>Error uploading file.</p></div>';
        }
    }

    
    // Display the upload form
    ?>
    <div class="wrap">
        <h1>Random Image Uploader</h1>
        <form action="#" method="post" enctype="multipart/form-data">
            <input type="file" name="custom_image" accept="image/*" required>
            <input type="submit" name="upload_image" value="Upload Image">
        </form>
    </div>
    <?php
}


function custom_image_uploader_images_page() {
    $upload_dir = wp_upload_dir();
    $custom_images_dir = $upload_dir['basedir'] . '/custom-images';

    if (is_dir($custom_images_dir)) {
        $images = glob($custom_images_dir . '/*.{jpg,png,gif}', GLOB_BRACE);
        ?>
<?php 
 $msg = isset($_GET['msg']) ? intval($_GET['msg']) : null;

if ($msg == 1) {
    echo '<div class="updated notice notice-success is-dismissible"><p>Image deleted successfully.</p></div>';
} elseif ($msg === 0) {
    echo '<div class="error notice notice-error is-dismissible"><p>Image not found.</p></div>';
}
?>
       <?php 
        if (!empty($images)) {
            ?>
            <div class="wrap">
                <h1>Existing Images</h1>
 

                <ul>
                    <?php foreach ($images as $image) {
                        $image_name = basename($image);
                        ?>
                        <li>
                            <img src="<?php echo $upload_dir['baseurl'] . '/custom-images/' . $image_name; ?>" alt="<?php echo $image_name; ?>" width="50">
                            <?php echo $image_name; ?>
                           <form action="<?php echo admin_url('admin-post.php'); ?>" method="post" style="display:inline;">
                            <input type="hidden" name="action" value="delete_image">
                            <input type="hidden" name="delete_image" value="<?php echo $image_name; ?>">
                            <input type="submit" name="delete" class="button-link-delete" value="Delete">
                           </form>

                        </li>
                    <?php } ?>
                </ul>
            </div>
            <?php
        }
    }
}

add_action('admin_post_delete_image', 'handle_delete_image');
add_action('admin_post_nopriv_delete_image', 'handle_delete_image');

function handle_delete_image() {
    if (isset($_POST['delete_image'])) {
         $image_name = $_POST['delete_image'];
        
        $upload_dir = wp_upload_dir();
        $custom_images_dir = $upload_dir['basedir'] . '/custom-images/' . $image_name;

        if (file_exists($custom_images_dir)) {
            unlink($custom_images_dir);
            

        }
    }

    // Redirect back to the images page




    wp_redirect(admin_url('admin.php?page=custom-image-uploader-images&msg=1'));
    exit();
}



