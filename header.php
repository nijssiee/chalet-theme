<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Google Fonts optimalisatie -->
    <link href="https://fonts.googleapis.com/css2?family=Liter:wght@100..900&family=Manrope:wght@400..700&family=Poppins:wght@300;400;600&family=Playfair+Display:wght@400;700&display=swap" rel="stylesheet">
	<link rel="preload" as="image" href="<?php echo esc_url($hero_bg); ?>" fetchpriority="high">


    <!-- Critical CSS direct inline -->
    <style>
        <?php include get_template_directory() . '/Assets/css/critical.css'; ?>
    </style>

    <?php wp_head(); ?>
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
