<?php
/**
 * Header template for Helium-Fdn Theme
 *
 * @package helium-fdn
 */
?>

<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js" dir="<?php echo is_rtl() ? 'rtl' : 'ltr'; ?>">

<head>
    <!-- Meta Basics -->
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?php echo esc_attr(is_singular() ? wp_trim_words(get_the_excerpt(), 25) : get_bloginfo('description')); ?>">
    <meta name="keywords" content="helium fdn, foundation framework, responsive design, wordpress theme, seo optimized">
    <meta name="author" content="Marvin Oka">

    <!-- Favicons -->
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/favicon/favicon-16x16.png">
    <meta name="msapplication-TileColor" content="#603cba">
    <meta name="theme-color" content="#ffffff">

    <!-- Open Graph (Social Media) -->
    <meta property="og:title" content="<?php echo esc_attr(wp_get_document_title()); ?>">
    <meta property="og:description" content="<?php echo esc_attr(is_singular() ? wp_trim_words(get_the_excerpt(), 25) : get_bloginfo('description')); ?>">
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?php echo esc_url(get_permalink() ?: home_url()); ?>">
    <meta property="og:image" content="<?php echo esc_url(has_post_thumbnail() ? get_the_post_thumbnail_url() : get_template_directory_uri() . '/assets/images/og-image.jpg'); ?>">

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?php echo esc_attr(wp_get_document_title()); ?>">
    <meta name="twitter:description" content="<?php echo esc_attr(is_singular() ? wp_trim_words(get_the_excerpt(), 25) : get_bloginfo('description')); ?>">
    <meta name="twitter:image" content="<?php echo esc_url(has_post_thumbnail() ? get_the_post_thumbnail_url() : get_template_directory_uri() . '/assets/images/og-image.jpg'); ?>">

    <!-- Optional Foundation MQ -->
    <meta class="foundation-mq">

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<a class="skip-link screen-reader-text" href="#content"><?php _e('Skip to content', 'helium-fdn'); ?></a>