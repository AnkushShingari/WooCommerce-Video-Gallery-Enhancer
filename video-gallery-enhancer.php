<?php
/*
Plugin Name: WooCommerce Video Gallery Enhancer
Description: Add video to WooCommerce product gallery with position control
Version: 1.0
Author: AnkushShingari
*/

// Add admin meta box
add_action('add_meta_boxes', 'vge_add_meta_box');
function vge_add_meta_box() {
    add_meta_box(
        'vge_video_meta',
        'Product Video Gallery',
        'vge_meta_box_callback',
        'product',
        'side',
        'default'
    );
}

// Meta box content
function vge_meta_box_callback($post) {
    wp_nonce_field('vge_save_meta', 'vge_nonce');
    $video_url = get_post_meta($post->ID, '_vge_video_url', true);
    $video_position = get_post_meta($post->ID, '_vge_video_position', true);
    ?>
    <p>
        <label>Video URL:<br>
            <input type="text" name="vge_video_url" id="vge_video_url" value="<?php echo esc_attr($video_url); ?>" style="width:75%">
            <button type="button" class="button vge-media-upload" style="vertical-align:bottom">
                <span class="dashicons dashicons-upload"></span>
            </button>
        </label>
    </p>
    <p>
        <label>Display Position:<br>
            <input type="number" name="vge_video_position" value="<?php echo esc_attr($video_position); ?>" min="1" step="1">
        </label>
    </p>
    <?php
}

// Save meta data
add_action('save_post_product', 'vge_save_meta');
function vge_save_meta($post_id) {
    if (!isset($_POST['vge_nonce']) || !wp_verify_nonce($_POST['vge_nonce'], 'vge_save_meta')) return;
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;

    update_post_meta($post_id, '_vge_video_url', esc_url_raw($_POST['vge_video_url']));
    update_post_meta($post_id, '_vge_video_position', absint($_POST['vge_video_position']));
}

// Add media uploader script
add_action('admin_footer', 'vge_media_script');
function vge_media_script() {
    ?>
    <script>
    jQuery(document).ready(function($){
        $('.vge-media-upload').click(function(e) {
            e.preventDefault();
            var frame = wp.media({
                title: 'Select or Upload Video',
                library: {type: 'video'},
                multiple: false
            });
            
            frame.on('select', function() {
                var attachment = frame.state().get('selection').first().toJSON();
                $('#vge_video_url').val(attachment.url);
            });
            
            frame.open();
        });
    });
    </script>
    <?php
}

// Display video in gallery
add_filter('woocommerce_single_product_image_thumbnail_html', 'vge_insert_video_into_gallery', 10, 2);
function vge_insert_video_into_gallery($html, $attachment_id) {
    global $product;

    static $count = 0; // Track the position within the loop
    $video_url = get_post_meta($product->get_id(), '_vge_video_url', true);
    $position = get_post_meta($product->get_id(), '_vge_video_position', true);

    if (!$video_url) return $html; // If no video, return default

    // Ensure valid position
    $gallery_ids = $product->get_gallery_image_ids();
    $total_images = count($gallery_ids);
    $position = ($position !== '' && is_numeric($position)) ? max(0, min($position - 1, $total_images)) : $total_images;

    // Insert video at exact position
    if ($count === $position) {
        $thumbnail = vge_get_video_thumbnail($video_url);
        $video_html = '<div data-thumb="' . esc_url($thumbnail) . '" class="woocommerce-product-gallery__image">';
        $video_html .= '<a href="' . esc_url($video_url) . '" class="vge-video-popup">';
        $video_html .= '<img width="500" height="500" src="' . esc_url($thumbnail) . '" class="wp-post-image" alt="Product video"';
        $video_html .= ' data-large_image="' . esc_url($thumbnail) . '" data-large_image_width="500" data-large_image_height="500">';
        $video_html .= '<span class="vge-play-icon"></span></a></div>';

        $html = $video_html . $html; // Place video before current image
    }

    $count++; // Increment position tracker
    return $html;
}

// Remove default gallery display
remove_action('woocommerce_product_thumbnails', 'woocommerce_show_product_thumbnails', 20);

// Get video thumbnail (supports Media Library and YouTube)
function vge_get_video_thumbnail($url) {
    // Check if it's a media library video
    $video_id = attachment_url_to_postid($url);
    if ($video_id) {
        $thumbnail_id = get_post_thumbnail_id($video_id);
        if ($thumbnail_id) {
            return wp_get_attachment_image_url($thumbnail_id, 'full');
        }
    }

    // YouTube handling
    if (preg_match('/youtube\.com\/watch\?v=([^\&\?\/]+)/', $url, $matches) || 
        preg_match('/youtu\.be\/([^\&\?\/]+)/', $url, $matches)) {
        return 'https://img.youtube.com/vi/' . $matches[1] . '/0.jpg';
    }

    // Default thumbnail (use your own or WP default)
    return plugins_url('default-thumbnail.png', __FILE__);
}

// Enqueue assets
add_action('wp_enqueue_scripts', 'vge_enqueue_assets');
function vge_enqueue_assets() {
    // Magnific Popup CSS
    wp_enqueue_style(
        'magnific-popup', 
        'https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css',
        array(),
        '1.1.0'
    );
    
    // Plugin CSS
    wp_enqueue_style(
        'vge-styles', 
        plugins_url('vge-styles.css', __FILE__),
        array('magnific-popup'),
        filemtime(plugin_dir_path(__FILE__) . 'vge-styles.css')
    );

    // Magnific Popup JS
    wp_enqueue_script(
        'magnific-popup',
        'https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js',
        array('jquery'),
        '1.1.0',
        true
    );

    // Plugin JS
    wp_enqueue_script(
        'vge-scripts',
        plugins_url('vge-scripts.js', __FILE__),
        array('jquery', 'magnific-popup'),
        filemtime(plugin_dir_path(__FILE__) . 'vge-scripts.js'),
        true
    );

}

