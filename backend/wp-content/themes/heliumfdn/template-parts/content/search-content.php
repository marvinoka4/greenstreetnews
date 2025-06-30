<?php
/**
 * Search Content for Helium-Fdn Theme
 *
 * @package helium-fdn
 */
?>

<header class="page-header">
    <h1 class="page-title">
        <?php
        /* translators: %s: search query */
        printf(esc_html__('Search Results for: %s', 'helium-fdn'), '<span>' . esc_html(get_search_query()) . '</span>');
        ?>
    </h1>
    <?php get_search_form(); ?>
</header>

<div class="grid-x grid-margin-x">
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class('cell medium-6 large-4'); ?>>
            <?php if (has_post_thumbnail()) : ?>
                <a href="<?php the_permalink(); ?>" class="post-thumbnail">
                    <?php the_post_thumbnail('medium', array('alt' => esc_attr(get_the_title()))); ?>
                </a>
            <?php endif; ?>
            <h2 class="entry-title">
                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
            </h2>
            <div class="entry-excerpt">
                <?php the_excerpt(); ?>
            </div>
            <a href="<?php the_permalink(); ?>" class="button small"><?php _e('Read More', 'helium-fdn'); ?></a>
        </article>
    <?php endwhile; ?>
        <nav class="pagination" aria-label="<?php esc_attr_e('Pagination', 'helium-fdn'); ?>">
            <?php
            the_posts_pagination(array(
                'mid_size' => 2,
                'prev_text' => __('Previous', 'helium-fdn'),
                'next_text' => __('Next', 'helium-fdn'),
                'screen_reader_text' => __('Posts navigation', 'helium-fdn'),
            ));
            ?>
        </nav>
    <?php else : ?>
        <section class="no-results" style="padding: 1rem;">
            <h2><?php _e('No Results Found', 'helium-fdn'); ?></h2>
            <p><?php _e('Sorry, nothing matched your search terms. Please try again with different keywords.', 'helium-fdn'); ?></p>
            <?php get_search_form(); ?>
        </section>
    <?php endif; ?>
</div>