<div class="off-canvas-wrapper">
    <?php get_template_part('template-parts/navigation/off-canvas-navigation'); ?>
    <div class="off-canvas-content" data-off-canvas-content>
        <?php get_template_part('template-parts/navigation/main-navigation'); ?>
        <main class="site-main">
            <div class="grid-container">
                <div class="grid-x">
                    <div class="cell large-8">
                        <?php
                        // Check for custom page template
                        $custom_template = get_page_template_slug();
                        if ($custom_template && locate_template('templates/' . str_replace('.php', '', basename($custom_template)) . '.php')) {
                            // Extract template name (e.g., 'about' from 'templates/about.php')
                            $template_name = str_replace('.php', '', basename($custom_template));
                            get_template_part('templates/' . $template_name);
                        } else {
                            // Core template hierarchy
                            if (is_front_page()) {
                                get_template_part('template-parts/content/front-page-content');
                            } elseif (is_page()) {
                                get_template_part('template-parts/content/page-content');
                            } elseif (is_single()) {
                                get_template_part('template-parts/content/single-content');
                            } elseif (is_archive() || is_category() || is_tag()) {
                                get_template_part('template-parts/content/archive-content');
                            } elseif (is_404()) {
                                get_template_part('template-parts/content/404-content');
                            } else {
                                get_template_part('template-parts/content/index-content');
                            }
                        }
                        ?>
                    </div>
                    <div class="cell large-4">
                        <?php get_sidebar(); ?>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>