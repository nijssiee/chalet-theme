<?php
// Voorkom directe toegang
if (!defined('ABSPATH')) {
    exit;
}


wp_enqueue_style( 'font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css' );
add_image_size('hero_mobile', 900, 600, true); // naam, breedte, hoogte, crop

add_action('wp_head', function() {
    // Favicon alleen frontend
    if (!is_admin()) {
        echo '<link rel="icon" href="https://www.chaletlatenbouwen.nl/wp-content/uploads/2025/04/Ontwerp-zonder-titel-4.svg" type="image/svg+xml" sizes="any">';
        echo '<link rel="apple-touch-icon" href="https://www.chaletlatenbouwen.nl/wp-content/uploads/2025/04/Ontwerp-zonder-titel-4.svg">';
    }
    // Hero achtergrond preload (indien variabele aanwezig)
    global $hero_bg;
    if (!empty($hero_bg)) {
        echo '<link rel="preload" as="image" href="' . esc_url($hero_bg) . '" fetchpriority="high">';
    }
});


// Thema setup
function chalet_theme_setup() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('menus');

    register_nav_menus(array(
        'primary' => __('Hoofdmenu', 'chalet-theme'),
        'footer_menu' => __('Footer Menu', 'chalet-theme'),
        'footer_chalets'   => 'Footer Chalets',
        'footer_over_ons'  => 'Footer Over ons',
        'footer_projecten'   => 'Footer menu Projecten',
     // ✅ Footer menu toegevoegd
    ));

    // ✅ Voeg ondersteuning toe voor een aangepast logo
    add_theme_support('custom-logo', array(
        'height'      => 80,  // Pas aan naar gewenste hoogte
        'width'       => 200, // Pas aan naar gewenste breedte
        'flex-height' => true,
        'flex-width'  => true,
        'header-text' => array('site-title', 'site-description'), // Titel en slogan verbergen als logo actief is
    ));
}
add_action('after_setup_theme', 'chalet_theme_setup');



// Laadt CSS en JS
function chalet_enqueue_assets() {
    // Algemene CSS met filemtime voor live reload
    wp_enqueue_style(
        'main-css',
        get_template_directory_uri() . '/assets/css/style.css',
        array(),
        filemtime(get_template_directory() . '/assets/css/style.css'),
        'all'
    );

    // Blokinstellingen CSS met filemtime
    wp_enqueue_style(
        'blokinstellingen-css',
        get_template_directory_uri() . '/assets/css/blokinstellingen.css',
        array(),
        filemtime(get_template_directory() . '/assets/css/blokinstellingen.css'),
        'all'
    );

    // Responsive CSS met filemtime
    wp_enqueue_style(
        'responsive',
        get_template_directory_uri() . '/assets/css/responsive.css',
        array(),
        filemtime(get_template_directory() . '/assets/css/responsive.css'),
        'all'
    );

    // JavaScript
wp_enqueue_script('main-js', get_template_directory_uri() . '/assets/js/main.js', array(), filemtime(get_template_directory() . '/assets/js/main.js'), true);
}
add_action('wp_enqueue_scripts', 'chalet_enqueue_assets');

// ACF JSON opslaan in themafolder
add_filter('acf/settings/save_json', function($path) {
    return get_template_directory() . '/acf-json';
});

// ACF JSON laden vanuit themafolder
add_filter('acf/settings/load_json', function($paths) {
    $paths[] = get_template_directory() . '/acf-json';
    return $paths;
});

// Custom Post Type: Vraag
function register_vraag_cpt() {
    register_post_type('vraag', array(
        'labels' => array(
            'name' => 'Veelgestelde vragen',
            'singular_name' => 'Vraag',
            'add_new' => 'Nieuwe vraag',
            'add_new_item' => 'Nieuwe vraag toevoegen',
            'edit_item' => 'Bewerk vraag',
            'new_item' => 'Nieuwe vraag',
            'view_item' => 'Bekijk vraag',
            'search_items' => 'Zoek vragen',
            'not_found' => 'Geen vragen gevonden',
            'not_found_in_trash' => 'Geen vragen in prullenbak',
        ),
        'public' => true,
        'has_archive' => false,
        'menu_icon' => 'dashicons-editor-help',
        'supports' => array('title', 'editor'),
        'show_in_rest' => true,
    ));
}
add_action('init', 'register_vraag_cpt');

if( function_exists('acf_add_options_page') ) {
    acf_add_options_page(array(
        'page_title'  => 'Site-instellingen',
        'menu_title'  => 'Site-instellingen',
        'menu_slug'   => 'site-instellingen',
        'capability'  => 'edit_posts',
        'redirect'    => false
    ));
}

function thema_enqueue_fancybox() {
    wp_enqueue_style('fancybox-css', 'https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css');
    wp_enqueue_script('fancybox-js', 'https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js', array(), null, true);
  }
  add_action('wp_enqueue_scripts', 'thema_enqueue_fancybox');
  
function thema_gallery_slider_scripts() {
    wp_enqueue_script('gallery-slider', get_template_directory_uri() . '/js/gallery-slider.js', array(), null, true);
  }
  add_action('wp_enqueue_scripts', 'thema_gallery_slider_scripts');
  
  function custom_excerpt_length($length) {
    return 40; // max 20 woorden
}
add_filter('excerpt_length', 'custom_excerpt_length');

function custom_excerpt_more($more) {
    return ' →';
}
add_filter('excerpt_more', 'custom_excerpt_more');


// Maximaal 5 revisies per bericht of pagina
if (!defined('WP_POST_REVISIONS')) {
    define('WP_POST_REVISIONS', 20);
}

function allow_svg_upload($mimes) {
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}
add_filter('upload_mimes', 'allow_svg_upload');

// Add a function to automatically add an ALT text to images based on the image itself not the filename
function auto_add_alt_text($metadata, $attachment_id) {
    $attachment = get_post($attachment_id);
    if ($attachment->post_type === 'attachment' && strpos($attachment->post_mime_type, 'image') !== false) {
        $image = wp_get_attachment_image_src($attachment_id, 'full');
        if ($image) {
            $alt_text = pathinfo($image[0], PATHINFO_FILENAME);
            update_post_meta($attachment_id, '_wp_attachment_image_alt', $alt_text);
        }
    }
    return $metadata;
}
add_filter('wp_generate_attachment_metadata', 'auto_add_alt_text', 10, 2);

function cf7_show_keuzes_shortcode() {
  if ( isset($_GET['keuzedata']) ) {
    return nl2br( esc_html( $_GET['keuzedata'] ) );
  }
  return '';
}
add_shortcode('keuzes', 'cf7_show_keuzes_shortcode');

// Zorg dat shortcodes in CF7 mail worden verwerkt
add_filter('wpcf7_mail_components', function($components, $contact_form, $mail_tag) {
    foreach ($components as $key => $content) {
        if (is_string($content)) {
            $components[$key] = do_shortcode($content);
        }
    }
    return $components;
}, 10, 3);

add_filter('wpcf7_mail_components', function($components, $form) {
    if (isset($components['body'])) {
        $components['body'] = wp_specialchars_decode($components['body'], ENT_QUOTES);
    }
    return $components;
}, 10, 2);

// Shortcode voor [keuzedata] in mail template
add_shortcode('keuzedata', function() {
    global $keuzedata_str;
    // underscores vervangen door spaties
    return str_replace('_', ' ', $keuzedata_str);
});

add_action('wp_footer', function () {
  if (is_page('offerte-aanvraag')) { ?>
    <script>
      document.addEventListener('wpcf7mailsent', function (event) {
        // Stuurt door naar bedankt-pagina met dezelfde query parameters
        window.location.href = 'https://chaletverkopen.nl/bedankt-offerte/' + window.location.search;
      }, false);
    </script>
<?php }
});
add_filter('get_custom_logo', function ($html) {
  $style = 'transform: translateZ(0); will-change: transform; opacity:1;';

  if (wp_is_mobile()) {
    $style .= ' filter: drop-shadow(0 0 4px rgba(0,0,0,0.5));';
  }

  $html = str_replace(
    '<img',
    '<img decoding="async" fetchpriority="high" style="' . esc_attr($style) . '"',
    $html
  );

  return $html;
});

add_filter('acf/load_field/name=formulier_shortcode', function ($field) {
    $forms = get_posts([
        'post_type'      => 'wpcf7_contact_form',
        'posts_per_page' => -1,
        'orderby'        => 'title',
        'order'          => 'ASC'
    ]);

    $choices = [];

    if ($forms) {
        foreach ($forms as $form) {
            $choices['[contact-form-7 id="' . $form->ID . '" title="' . $form->post_title . '"]'] = $form->post_title;
        }
    }

    $field['choices'] = $choices;
    return $field;
});

add_filter('wp_get_attachment_image_attributes', function($attr, $attachment) {
    if (isset($attr['class']) && strpos($attr['class'], 'custom-logo') !== false) {
        // Lazy loading uitschakelen
        $attr['loading'] = 'eager';
        // Preload prioriteit + visuele fix
        $attr['decoding'] = 'async';
        $attr['fetchpriority'] = 'high';
        $attr['style'] = 'transform: translateZ(0); will-change: transform; opacity:1;';
        // Drop-shadow enkel op mobiel
        if (wp_is_mobile()) {
            $attr['style'] .= ' filter: drop-shadow(0 0 4px rgba(0,0,0,0.5));';
        }
    }
    return $attr;
}, 10, 2);

add_filter('acf_the_content', 'wpautop');
add_filter('acf_the_content', 'shortcode_unautop');
