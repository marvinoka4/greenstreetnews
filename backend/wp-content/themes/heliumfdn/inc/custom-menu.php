<?php


function helium_fdn_register_menus() {
register_nav_menus(array(
    'main-menu' => __('Main Menu', 'helium-fdn'),
    'off-canvas-menu' => __('Off-Canvas Menu', 'helium-fdn'),
    ));
}
add_action('after_setup_theme', 'helium_fdn_register_menus');

class Foundation_Dropdown_Walker extends Walker_Nav_Menu {
    // Start level (ul)
    function start_lvl(&$output, $depth = 0, $args = null) {
        if ($depth === 0) {
            $output .= '<ul class="vertical menu nested">';
        } else {
            $output .= '<ul class="menu nested">';
        }
    }

    // End level (ul)
    function end_lvl(&$output, $depth = 0, $args = null) {
        $output .= '</ul>';
    }

    // Start element (li)
    function start_el(&$output, $item, $depth = 0, $args = null, $id = 0) {
        $classes = empty($item->classes) ? array() : (array) $item->classes;
        $classes[] = 'menu-item-' . $item->ID;
        $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args));
        $class_names = $class_names ? ' class="' . esc_attr($class_names) . '"' : '';

        $output .= '<li' . $class_names . '>';

        $attributes = !empty($item->attr_title) ? ' title="' . esc_attr($item->attr_title) . '"' : '';
        $attributes .= !empty($item->target) ? ' target="' . esc_attr($item->target) . '"' : '';
        $attributes .= !empty($item->xfn) ? ' rel="' . esc_attr($item->xfn) . '"' : '';
        $attributes .= !empty($item->url) ? ' href="' . esc_attr($item->url) . '"' : '';

        $item_output = $args->before;
        $item_output .= '<a' . $attributes . '>';
        $item_output .= $args->link_before . apply_filters('the_title', $item->title, $item->ID) . $args->link_after;
        $item_output .= '</a>';
        $item_output .= $args->after;

        $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
    }

    // End element (li)
    function end_el(&$output, $item, $depth = 0, $args = null) {
        $output .= '</li>';
    }
}