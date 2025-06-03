<?php
// Aantal kolommen instellen
$aantal = get_sub_field('aantal_kolommen');

// Blokinstellingen ophalen
$ruimte = get_sub_field('ruimte') ?: '';
$achtergrond = get_sub_field('achtergrond') ?: '';
$blok_id = get_sub_field('blok_id') ?: '';

if (have_rows('paginalinks_repeater')) : ?>
    <section class="paginalinks-blok <?php echo esc_attr($ruimte); ?> <?php echo esc_attr($achtergrond); ?>" <?php if ($blok_id) echo 'id="' . esc_attr($blok_id) . '"'; ?>>
        <div class="container">
            <div class="paginalinks-container cols-<?php echo esc_attr($aantal); ?>">
                <?php while (have_rows('paginalinks_repeater')) : the_row();
                    $afbeelding = get_sub_field('afbeelding');
                    $titel = get_sub_field('titel');
                    $tekst = get_sub_field('tekst');
                    $pagina = get_sub_field('page_link');
                    $knoptekst = get_sub_field('knoptekst');
                    
                    // Permalink ophalen
                    $link_url = $pagina ? get_permalink($pagina) : '#';
                    ?>
<a class="paginalink-item" href="<?php echo esc_url($link_url); ?>">
    <?php if ($afbeelding) : ?>
        <div class="paginalink-afbeelding">
            <img src="<?php echo esc_url($afbeelding['url']); ?>" alt="<?php echo esc_attr($afbeelding['alt']); ?>">
        </div>
    <?php endif; ?>

    <div class="paginalink-inhoud">
        <?php if ($titel) : ?>
            <h3 class="paginalink-titel"><?php echo esc_html($titel); ?></h3>
        <?php endif; ?>

        <?php if ($tekst) : ?>
            <div class="paginalink-tekst styled-lists">
                <?php echo wpautop(do_shortcode($tekst)); ?>
            </div>
        <?php endif; ?>

        <?php if ($knoptekst && $pagina) : ?>
            <div class="paginalink-button">
                <span class="btn"><?php echo esc_html($knoptekst); ?></span>
            </div>
        <?php endif; ?>
    </div>
</a>
                <?php endwhile; ?>
            </div>
        </div>
    </section>
<?php endif; ?>
