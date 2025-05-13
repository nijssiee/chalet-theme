<?php
// Hero ACF-velden ophalen
$hero_image = get_sub_field('hero_image');
$hero_title = get_sub_field('hero_title') ?: 'Standaard titel';
$hero_text = get_sub_field('hero_text') ?: '';
$hero_button_text = get_sub_field('hero_button_text') ?: '';
$hero_button_type = get_sub_field('hero_button_type');
$hero_button_scroll = get_sub_field('hero_button_scroll');
$hero_button_link = get_sub_field('hero_button_link');

// Achtergrondafbeelding instellen
$hero_bg = !empty($hero_image['url']) ? esc_url($hero_image['url']) : '';
?>

<?php if ($hero_title || $hero_text) : ?>
<section class="hero">
    <div class="hero-bg" style="background-image: url('<?php echo $hero_bg; ?>');"></div>
<?php if ($hero_bg): ?>
    <img 
        src="<?php echo $hero_bg; ?>" 
        alt="" 
        width="1920" 
        height="1080" 
        fetchpriority="high" 
        loading="eager" 
        decoding="async"
        style="position:absolute; width:0; height:0; overflow:hidden; clip:rect(0 0 0 0); border:0;"
        class="hero-preload-mobile"
        aria-hidden="true">
<?php endif; ?>
    <div class="hero-overlay"></div>

        <div class="hero-content">
            <h1><?php echo esc_html($hero_title); ?></h1>
            <p><?php echo esc_html($hero_text); ?></p>

            <?php if ($hero_button_text) : ?>
                <div class="hero-button">
                    <?php if ($hero_button_type == 'scroll' && !empty($hero_button_scroll)) : ?>
                        <a href="#<?php echo esc_attr($hero_button_scroll); ?>" class="btn scroll-to">
                            <?php echo esc_html($hero_button_text); ?>
                        </a>
                    <?php elseif ($hero_button_type == 'link' && !empty($hero_button_link['url'])) : ?>
                        <a href="<?php echo esc_url($hero_button_link['url']); ?>" class="btn">
                            <?php echo esc_html($hero_button_text); ?>
                        </a>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        </div>

    </section>
<?php endif; ?>
