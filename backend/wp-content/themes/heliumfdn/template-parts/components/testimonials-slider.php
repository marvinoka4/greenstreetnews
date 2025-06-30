<?php

/**
 * Testimonial Slider
 *
 * @package helium-fdn
 */
?>
<section class="testimonial-slider-section fluid grid-container">
    <div class="grid-container">
        <div class="grid-x grid-margin-x">
            <div class="cell">
                <h2 class="text-center">What Our Clients Say</h2>
                <div class="swiper testimonial-slider">
                    <div class="swiper-wrapper">
                        <?php
                        $args = [
                            'post_type'      => 'testimonials',
                            'posts_per_page' => 3,
                            'orderby'        => 'date',
                            'order'          => 'DESC',
                            'no_found_rows'  => true,
                        ];
                        $query = new WP_Query($args);
                        if ($query->have_posts()) :
                            while ($query->have_posts()) : $query->the_post();
                                $rating = get_post_meta(get_the_ID(), '_testimonial_rating', true);
                                $role = get_post_meta(get_the_ID(), '_testimonial_role', true);
                                $image = has_post_thumbnail() ? get_the_post_thumbnail_url(get_the_ID(), 'thumbnail') : '/wp-content/themes/helium-fdn/assets/images/util/placeholder.jpg';
                        ?>
                                <div class="swiper-slide testimonial-slide">
                                    <div class="callout">
                                        <img src="<?php echo esc_url($image); ?>" alt="<?php the_title_attribute(); ?>">
                                        <div class="star-rating" aria-label="<?php echo esc_attr($rating); ?> out of 5 stars">
                                            <?php for ($i = 1; $i <= 5; $i++) : ?>
                                                <svg class="star-svg" aria-hidden="true">
                                                    <use href="#star-<?php echo $i <= $rating ? 'filled' : 'empty'; ?>"></use>
                                                </svg>
                                            <?php endfor; ?>
                                        </div>
                                        <p class="padding-vertical-2">
                                            <svg class="quote-svg" aria-hidden="true">
                                                <use href="#quote-left"></use>
                                            </svg>
                                            <?php echo wp_trim_words(get_the_content(), 7, ''); ?>...
                                            <svg class="quote-svg" aria-hidden="true">
                                                <use href="#quote-right"></use>
                                            </svg>
                                        </p>
                                        <h4><?php the_title(); ?></h4>
                                        <span><?php echo esc_html($role); ?></span>
                                    </div>
                                </div>
                        <?php
                            endwhile;
                            wp_reset_postdata();
                        endif;
                        ?>
                    </div>
                    <div class="swiper-controls">
                        <div class="swiper-pagination"></div>
                        <div class="swiper-navigation">
                            <div class="swiper-button-prev"></div>
                            <div class="swiper-button-next"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="grid-x grid-margin-x align-center">
            <div class="cell shrink">
                <a href="<?php echo esc_url(get_post_type_archive_link('testimonials')); ?>" class="button primary">See More Testimonials</a>
            </div>
        </div>
    </div>
    <!-- SVG Sprite for Stars and Quotes -->
    <svg aria-hidden="true" style="position: absolute; width: 0; height: 0; overflow: hidden;">
        <defs>
            <symbol id="star-filled" viewBox="0 0 24 24">
                <path fill="#f5c518" d="M12 .587l3.668 7.429 8.332.82-6.001 5.862 1.415 8.314L12 18.896l-7.414 3.896 1.415-8.314L0 8.836l8.332-.82z" />
            </symbol>
            <symbol id="star-empty" viewBox="0 0 24 24">
                <path fill="#d3d3d3" d="M12 .587l3.668 7.429 8.332.82-6.001 5.862 1.415 8.314L12 18.896l-7.414 3.896 1.415-8.314L0 8.836l8.332-.82z" />
            </symbol>
            <symbol id="quote-left" viewBox="0 0 512 512">
                <path d="M464 256h-80v-64c0-35.3 28.7-64 64-64h8c13.3 0 24-10.7 24-24V56c0-13.3-10.7-24-24-24h-8c-88.4 0-160 71.6-160 160v240c0 26.5 21.5 48 48 48h128c26.5 0 48-21.5 48-48V304c0-26.5-21.5-48-48-48zm-288 0H96v-64c0-35.3 28.7-64 64-64h8c13.3 0 24-10.7 24-24V56c0-13.3-10.7-24-24-24h-8C71.6 32 0 103.6 0 192v240c0 26.5 21.5 48 48 48h128c26.5 0 48-21.5 48-48V304c0-26.5-21.5-48-48-48z" />
            </symbol>
            <symbol id="quote-right" viewBox="0 0 512 512">
                <path d="M464 32H336c-26.5 0-48 21.5-48 48v128c0 26.5 21.5 48 48 48h80v64c0 35.3-28.7 64-64 64h-8c-13.3 0-24 10.7-24 24v48c0 13.3 10.7 24 24 24h8c88.4 0 160-71.6 160-160V80c0-26.5-21.5-48-48-48zm-288 0H48C21.5 32 0 53.5 0 80v128c0 26.5 21.5 48 48 48h80v64c0 35.3-28.7 64-64 64h-8c-13.3 0-24 10.7-24 24v48c0 13.3 10.7 24 24 24h8c88.4 0 160-71.6 160-160V80c0-26.5-21.5-48-48-48z" />
            </symbol>
        </defs>
    </svg>
</section>