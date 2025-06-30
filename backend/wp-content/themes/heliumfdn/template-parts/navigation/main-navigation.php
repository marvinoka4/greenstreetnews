<?php
/**
 * Main Navigation for Helium-Fdn Theme
 *
 * @package helium-fdn
 */
?>

<header class="header" role="banner">
    <div class="grid-container">
        <div class="grid-x">
            <div class="large-3 medium-3 small-6 cell" style="align-self: center;">
                <?php get_template_part('template-parts/navigation/logo'); ?>
            </div>

            <nav class="cell medium-9 small-6 flex-container align-right align-middle" role="navigation" aria-label="<?php esc_attr_e('Main Navigation', 'helium-fdn'); ?>">
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'main-menu',
                    'menu_class' => 'dropdown menu show-for-large',
                    'container' => false,
                    'menu_id' => 'main-menu',
                    'depth' => 2,
                    'fallback_cb' => false,
                    'walker' => new Foundation_Dropdown_Walker(),
                ));
                ?>

                <div class="hide-for-large">
                    <button class="hamburger hamburger--elastic" type="button" aria-label="<?php esc_attr_e('Toggle Menu', 'helium-fdn'); ?>" aria-controls="off-canvas" aria-expanded="false" data-toggle="off-canvas">
                        <span class="hamburger-box">
                            <span class="hamburger-inner"></span>
                        </span>
                    </button>
                </div>
            </nav>
        </div>
    </div>
</header>