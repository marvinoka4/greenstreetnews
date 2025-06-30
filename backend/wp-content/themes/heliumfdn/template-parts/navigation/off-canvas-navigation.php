<?php
/**
 * Off-Canvas Navigation for Helium-Fdn Theme
 *
 * @package helium-fdn
 */
?>

<nav class="off-canvas position-right text-white text-center padding-top-1" id="off-canvas" data-off-canvas data-transition="push" role="navigation" aria-label="<?php esc_attr_e('Off-Canvas Navigation', 'helium-fdn'); ?>" aria-hidden="true">
    <div class="cell large-4 medium-6 small-6 padding-vertical-2">
        <?php get_template_part('template-parts/navigation/logo'); ?>
    </div>

    <?php
    wp_nav_menu(array(
        'theme_location' => 'off-canvas-menu',
        'menu_class' => 'vertical dropdown menu',
        'container' => false,
        'menu_id' => 'off-canvas-menu',
        'depth' => 2,
        'fallback_cb' => false,
        'walker' => new Foundation_Dropdown_Walker(),
    ));
    ?>

    <button class="close-button" aria-label="<?php esc_attr_e('Close Menu', 'helium-fdn'); ?>" type="button" data-close>
        <span aria-hidden="true">&times;</span>
    </button>
</nav>