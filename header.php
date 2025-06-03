<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <?php
    // Hero image preload (alleen op singe page)
    if (is_singular()) {
        $hero_image = get_field('hero_image');
        if (!$hero_image) {
            $hero_image = ['url' => get_the_post_thumbnail_url(get_the_ID(), 'full')];
        }
        if (!empty($hero_image['url'])) {
            echo '<link rel="preload" as="image" href="' . esc_url($hero_image['url']) . '" fetchpriority="high">';
        }
    }

    // Logo preload (uniek, geen dubbele preload)
    $logo_url = '';
    if (has_custom_logo()) {
        $custom_logo_id = get_theme_mod('custom_logo');
        $logo_url = wp_get_attachment_image_url($custom_logo_id, 'full');
    } else {
        $logo_url = get_template_directory_uri() . '/assets/img/logo.png';
    }
    ?>
    <link rel="preload" as="image" href="<?php echo esc_url($logo_url); ?>" fetchpriority="high">

    <!-- Google Fonts optimalisatie -->
    <link href="https://fonts.googleapis.com/css2?family=Liter:wght@100..900&family=Manrope:wght@400..700&family=Poppins:wght@300;400;600&family=Playfair+Display:wght@400;700&display=swap" rel="stylesheet" media="all" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">

    <!-- Critical CSS direct inline -->
    <style>
        <?php include get_template_directory() . '/assets/css/critical.css'; ?>
    </style>

    <?php wp_head(); ?>
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-LZKYMTTTZ8"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());
      gtag('config', 'G-LZKYMTTTZ8');
    </script>
</head>

<body <?php body_class(); ?>>

<?php 
// Alleen transparant als er een pagebuilder hero is én het geen blog/archief/single post is
$has_hero = '';

if (
    is_singular('page') &&
    have_rows('pagebuilder_content') &&
    !is_home() &&
    !is_archive() &&
    !is_single()
) {
    $has_hero = 'transparent';
}
?>

<header class="site-header <?php echo esc_attr($has_hero); ?>">
    <div class="container header-flex">

        <!-- Logo links -->
        <div class="logo">
            <?php 
            if (has_custom_logo()) {
                the_custom_logo(); 
            } else { ?>
                <a href="<?php echo esc_url(home_url()); ?>">
                    <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/img/logo.png'); ?>" alt="Logo">
                </a>
            <?php } ?>
        </div>

        <!-- Navigatie in het midden (desktop) -->
        <nav class="main-navigation">
            <?php wp_nav_menu(array(
                'theme_location' => 'primary',
                'container'      => false,
                'menu_class'     => 'nav-menu'
            )); ?>
        </nav>

        <!-- Header knop -->
        <?php
        $button_text = get_field('header_button_text', 'option') ?: 'Contact';
        $button_url  = get_field('header_button_url', 'option') ?: '#';
        ?>
        <div class="header-button">
            <a href="<?php echo esc_url($button_url); ?>" class="btn">
                <?php echo esc_html($button_text); ?>
            </a>
        </div>

        <!-- Hamburger Menu -->
        <div class="hamburger-menu" id="hamburger">
            <span></span>
            <span></span>
            <span></span>
        </div>

        <!-- Mobile Slide-out menu -->
        <div class="mobile-nav" id="mobileNav">
            <div class="mobile-nav-inner">
                <div class="logo mobile-logo">
                    <?php 
                    if (has_custom_logo()) {
                        the_custom_logo();
                    } 
                    ?>
                </div>

                <nav>
                    <?php 
                    wp_nav_menu(array(
                        'theme_location' => 'primary',
                        'container'      => false,
                        'menu_class'     => 'mobile-menu',
                        'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s<li class="menu-item mobile-button"><a href="' . esc_url($button_url) . '" class="btn">' . esc_html($button_text) . '</a></li></ul>'
                    )); 
                    ?>
                </nav>
            </div>
        </div>

    </div>
</header>

<!-- Openingsdiv voor de hero -->
<div class="site-content">
