<?php
/**
 * Testimonial Archive Content
 *
 * @package helium-fdn
 */
?>
<!-- SVG Sprite for Stars and Quotes -->
<svg aria-hidden="true" style="position: absolute; width: 0; height: 0; overflow: hidden;">
    <defs>
        <symbol id="star-filled" viewBox="0 0 24 24">
            <path fill="#f5c518" d="M12 .587l3.668 7.429 8.332.82-6.001 5.862 1.415 8.314L12 18.896l-7.414 3.896 1.415-8.314L0 8.836l8.332-.82z"/>
        </symbol>
        <symbol id="star-empty" viewBox="0 0 24 24">
            <path fill="#d3d3d3" d="M12 .587l3.668 7.429 8.332.82-6.001 5.862 1.415 8.314L12 18.896l-7.414 3.896 1.415-8.314L0 8.836l8.332-.82z"/>
        </symbol>
        <symbol id="quote-left" viewBox="0 0 512 512">
            <path d="M464 256h-80v-64c0-35.3 28.7-64 64-64h8c13.3 0 24-10.7 24-24V56c0-13.3-10.7-24-24-24h-8c-88.4 0-160 71.6-160 160v240c0 26.5 21.5 48 48 48h128c26.5 0 48-21.5 48-48V304c0-26.5-21.5-48-48-48zm-288 0H96v-64c0-35.3 28.7-64 64-64h8c13.3 0 24-10.7 24-24V56c0-13.3-10.7-24-24-24h-8C71.6 32 0 103.6 0 192v240c0 26.5 21.5 48 48 48h128c26.5 0 48-21.5 48-48V304c0-26.5-21.5-48-48-48z"/>
        </symbol>
        <symbol id="quote-right" viewBox="0 0 512 512">
            <path d="M48 256h80v-64c0-35.3-28.7-64-64-64h-8c-13.3 0-24-10.7-24-24V56c0-13.3 10.7-24 24-24h8c88.4 0 160 71.6 160 160v240c0 26.5-21.5 48-48 48H48c-26.5 0-48-21.5-48-48V304c0-26.5 21.5-48 48-48zm288 0h80v-64c0-35.3-28.7-64-64-64h-8c-13.3 0-24-10.7-24-24V56c0-13.3 10.7-24 24-24h8c88.4 0 160 71.6 160 160v240c0 26.5-21.5 48-48 48H336c-26.5 0-48-21.5-48-48V304c0-26.5 21.5-48 48-48z"/>
        </symbol>
    </defs>
</svg>

<div class="testimonial-archive-section grid-container">
    <div class="grid-x grid-margin-x">
        <div class="cell">
            <h1 class="text-center">All Testimonials</h1>
        </div>
    </div>
    <div class="grid-x padding-vertical-2">
        <?php
        if (have_posts()) :
        while (have_posts()) : the_post();
            $rating = get_post_meta(get_the_ID(), '_testimonial_rating', true);
            $role = get_post_meta(get_the_ID(), '_testimonial_role', true);
            $image = has_post_thumbnail() ? get_the_post_thumbnail_url(get_the_ID(), 'medium') : '/wp-content/themes/helium-fdn/assets/images/util/placeholder.jpg';
            ?>
            <div class="cell">
                <div class="testimonial-card flex">
                    <div class="card-image">
                        <img src="<?php echo esc_url($image); ?>" alt="<?php the_title_attribute(); ?>" class="testimonial-image">
                    </div>
                    <div class="card-content">
                        <div class="star-rating" aria-label="<?php echo esc_attr($rating); ?> out of 5 stars">
                            <?php for ($i = 1; $i <= 5; $i++) : ?>
                                <svg class="star-svg" aria-hidden="true">
                                    <use href="#star-<?php echo $i <= $rating ? 'filled' : 'empty'; ?>"></use>
                                </svg>
                            <?php endfor; ?>
                        </div>
                        <p>
                            <svg class="quote-svg" aria-hidden="true">
                                <use href="#quote-left"></use>
                            </svg>
                            <?php echo wp_strip_all_tags(get_the_content()); ?>
                            <svg class="quote-svg" aria-hidden="true">
                                <use href="#quote-right"></use>
                            </svg>
                        </p>
                        <h4><?php the_title(); ?></h4>
                        <span><?php echo esc_html($role); ?></span>
                    </div>
                </div>
            </div>
        <?php
        endwhile;
        ?>
    </div>
    <div class="grid-x grid-margin-x">
        <div class="cell text-center">
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
                <p class="text-center"><?php esc_html_e('No testimonials found.', 'helium-fdn'); ?></p>
            </div>
        <?php
        endif;
        ?>
    </div>
</div>