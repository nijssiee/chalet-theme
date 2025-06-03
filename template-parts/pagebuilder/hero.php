<?php
$is_mobile = wp_is_mobile();
$hero_image = get_sub_field('hero_image') ?: ['url' => get_the_post_thumbnail_url(get_the_ID(), 'full')];
$hero_title = get_sub_field('hero_title') ?: 'Standaard titel';
$hero_text = get_sub_field('hero_text') ?: '';
$hero_button_text = get_sub_field('hero_button_text') ?: '';
$hero_button_type = get_sub_field('hero_button_type');
$hero_button_scroll = get_sub_field('hero_button_scroll');
$hero_button_link = get_sub_field('hero_button_link');
$hero_bg = !empty($hero_image['url']) ? esc_url($hero_image['url']) : '';
$hero_image_id = attachment_url_to_postid($hero_bg);
$srcset = wp_get_attachment_image_srcset($hero_image_id);
$sizes = '(max-width: 768px) 100vw, 1920px';
$mobile_src = wp_get_attachment_image_url($hero_image_id, 'hero_mobile');
?>

<?php if ($hero_title || $hero_text) : ?>
<section class="hero">
    <?php if ($hero_bg): ?>
    <picture class="hero-bg"<?php if ($is_mobile): ?> style="background-image:url('<?php echo esc_url($mobile_src); ?>')"<?php endif; ?>>
        <source media="(max-width: 767px)" srcset="<?php echo esc_url($mobile_src); ?>">
        <img
            src="<?php echo esc_url($hero_bg); ?>"
            srcset="<?php echo esc_attr($srcset); ?>"
            sizes="<?php echo esc_attr($sizes); ?>"
            alt=""
            fetchpriority="high"
            decoding="async"
            loading="eager"
            width="1920"
            height="1080"
            <?php if ($is_mobile): ?>class="hero-img-mobile"<?php endif; ?>
        >
    </picture>
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
