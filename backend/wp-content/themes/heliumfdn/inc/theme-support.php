<?php
/**
 * Theme Support and Setup
 *
 * @package helium-fdn
 */

if (!function_exists('helium_fdn_theme_setup')) {
    function helium_fdn_theme_setup() {
        // Translation support
        load_theme_textdomain('helium-fdn', get_template_directory() . '/languages');

        // Other theme support (e.g., post thumbnails, menus)
        add_theme_support('automatic-feed-links');
        add_theme_support('title-tag');
        add_theme_support('post-thumbnails');
        add_theme_support('html5', array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
        ));
    }
}
add_action('after_setup_theme', 'helium_fdn_theme_setup');


function helium_fdn_customizer($wp_customize) {
$wp_customize->add_setting('layout_style', array('default' => 'default'));
$wp_customize->add_control('layout_style', array(
'label' => __('Layout Style', 'helium-fdn'),
'section' => 'layout_options',
'type' => 'select',
'choices' => array(
'default' => 'Default',
'sidebar' => 'Sidebar'
)
));
$wp_customize->add_section('layout_options', array('title' => __('Layout Options', 'helium-fdn')));
}
add_action('customize_register', 'helium_fdn_customizer');


// Prevent Direct Template Loading
function helium_fdn_force_page_template($template) {
    if (is_page() && get_page_template_slug()) {
        $template = locate_template('page.php');
    }
    return $template;
}
add_filter('template_include', 'helium_fdn_force_page_template', 99);