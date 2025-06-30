<?php
/**
 * Custom Post Types
 *
 * @package helium-fdn
 */

// Register Testimonials Custom Post Type
function helium_fdn_register_testimonials() {
    $labels = [
        'name'               => __('Testimonials', 'helium-fdn'),
        'singular_name'      => __('Testimonial', 'helium-fdn'),
        'menu_name'          => __('Testimonials', 'helium-fdn'),
        'name_admin_bar'     => __('Testimonial', 'helium-fdn'),
        'add_new'            => __('Add New', 'helium-fdn'),
        'add_new_item'       => __('Add New Testimonial', 'helium-fdn'),
        'edit_item'          => __('Edit Testimonial', 'helium-fdn'),
        'new_item'           => __('New Testimonial', 'helium-fdn'),
        'view_item'          => __('View Testimonial', 'helium-fdn'),
        'all_items'          => __('All Testimonials', 'helium-fdn'),
        'search_items'       => __('Search Testimonials', 'helium-fdn'),
        'not_found'          => __('No testimonials found.', 'helium-fdn'),
    ];

    $args = [
        'labels'             => $labels,
        'public'             => true,
        'has_archive'        => 'testimonials',
        'rewrite'            => ['slug' => 'testimonials'],
        'supports'           => ['title', 'editor', 'thumbnail', 'custom-fields'],
        'show_in_rest'       => true, // For Gutenberg
        'menu_icon'          => 'dashicons-star-filled',
        'taxonomies'         => [],
    ];

    register_post_type('testimonials', $args);
}
add_action('init', 'helium_fdn_register_testimonials');

// Add Meta Boxes for Testimonials
function helium_fdn_testimonial_meta_boxes() {
    add_meta_box(
        'testimonial_details',
        __('Testimonial Details', 'helium-fdn'),
        'helium_fdn_testimonial_meta_box_callback',
        'testimonials',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'helium_fdn_testimonial_meta_boxes');

function helium_fdn_testimonial_meta_box_callback($post) {
    wp_nonce_field('helium_fdn_testimonial_meta', 'helium_fdn_testimonial_nonce');
    $role = get_post_meta($post->ID, '_testimonial_role', true);
    $rating = get_post_meta($post->ID, '_testimonial_rating', true);
    ?>
    <p>
        <label for="testimonial_role"><?php _e('Role/Position', 'helium-fdn'); ?></label><br>
        <input type="text" id="testimonial_role" name="testimonial_role" value="<?php echo esc_attr($role); ?>" style="width: 100%;">
    </p>
    <p>
        <label for="testimonial_rating"><?php _e('Rating (1-5)', 'helium-fdn'); ?></label><br>
        <input type="number" id="testimonial_rating" name="testimonial_rating" min="1" max="5" value="<?php echo esc_attr($rating); ?>" style="width: 100%;">
    </p>
    <?php
}

function helium_fdn_save_testimonial_meta($post_id) {
    if (!isset($_POST['helium_fdn_testimonial_nonce']) || !wp_verify_nonce($_POST['helium_fdn_testimonial_nonce'], 'helium_fdn_testimonial_meta')) {
        return;
    }
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    if (isset($_POST['testimonial_role'])) {
        update_post_meta($post_id, '_testimonial_role', sanitize_text_field($_POST['testimonial_role']));
    }
    if (isset($_POST['testimonial_rating'])) {
        update_post_meta($post_id, '_testimonial_rating', absint($_POST['testimonial_rating']));
    }
}
add_action('save_post', 'helium_fdn_save_testimonial_meta');