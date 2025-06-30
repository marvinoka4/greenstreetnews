<?php
/**
 * Enqueue theme styles and scripts
 *
 * @package helium-fdn
 */

function helium_fdn_enqueue_styles() {
    $css_url = get_template_directory_uri() . '/assets/styles/css/app.min.css';
    wp_enqueue_style('helium-fdn-style', $css_url, array(), '1.0.0');

    // Enqueue Google Fonts
    wp_enqueue_style('helium-fdn-google-fonts', 'https://fonts.googleapis.com/css2?family=Albert+Sans:ital,wght@0,100..900;1,100..900&family=Questrial&display=swap', [], null);

    // Unicons (via CDN - https://unicons.iconscout.com/release/v1.0.0/index.html)
    wp_enqueue_style('unicons', 'https://unicons.iconscout.com/release/v4.0.8/css/line.css', array(), '4.0.8');
}
add_action('wp_enqueue_scripts', 'helium_fdn_enqueue_styles');

function helium_fdn_enqueue_scripts() {
    $js_url = get_template_directory_uri() . '/assets/scripts/js/app.min.js';
    wp_enqueue_script('jquery');
    wp_enqueue_script('helium-fdn-script', $js_url, array('jquery'), '1.0.0', true);
}
add_action('wp_enqueue_scripts', 'helium_fdn_enqueue_scripts');


/**
 * Performance and SEO optimisations
 */
function helium_fdn_optimize_assets() {
    if (!is_admin() && !is_user_logged_in()) {
        wp_dequeue_style('admin-bar');
        wp_dequeue_style('dashicons');
        wp_dequeue_script('admin-bar');
        wp_dequeue_script('hoverintent-js');
    }
}
add_action('wp_enqueue_scripts', 'helium_fdn_optimize_assets', 100);