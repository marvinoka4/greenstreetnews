<?php
/**
 * Archive Content
 *
 * @package helium-fdn
 */
?>
<?php if (is_post_type_archive('testimonials')) : ?>
    <?php get_template_part('template-parts/content/archive-content-testimonials');?>
<?php else : ?>
    <div class="archive-section grid-container">
        <div class="grid-x grid-margin-x">
            <div class="cell">
                <?php if (is_category()) : ?>
                    <h1 class="text-center"><?php single_cat_title(); ?></h1>
                <?php elseif (is_tag()) : ?>
                    <h1 class="text-center"><?php single_tag_title(); ?></h1>
                <?php else : ?>
                    <h1 class="text-center"><?php post_type_archive_title(); ?></h1>
                <?php endif; ?>
            </div>
        </div>
        <div class="grid-x grid-margin-x small-up-1 medium-up-2 large-up-3">
            <?php
            if (have_posts()) :
                while (have_posts()) : the_post();
                    ?>
                    <div class="cell">
                        <div class="callout">
                            <?php if (has_post_thumbnail()) : ?>
                                <img src="<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(), 'medium')); ?>" alt="<?php the_title_attribute(); ?>">
                            <?php endif; ?>
                            <h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                            <p><?php echo wp_trim_words(get_the_excerpt(), 20); ?></p>
                        </div>
                    </div>
                <?php
                endwhile;
                ?>
                <div class="cell">
                    <?php
                    the_posts_pagination([
                        'prev_text' => __('Previous', 'helium-fdn'),
                        'next_text' => __('Next', 'helium-fdn'),
                    ]);
                    ?>
                </div>
            <?php
            else :
                ?>
                <div class="cell">
                    <p class="text-center"><?php esc_html_e('No posts found.', 'helium-fdn'); ?></p>
                </div>
            <?php
            endif;
            ?>
        </div>
    </div>
<?php endif; ?>