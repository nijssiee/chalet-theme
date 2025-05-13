<?php
// Check of dit een 'kolommen' layout is
$aantal = get_sub_field('aantal_kolommen');

// Blokinstellingen ophalen
$ruimte = get_sub_field('ruimte') ?: '';
$achtergrond = get_sub_field('achtergrond') ?: '';
$blok_id = get_sub_field('blok_id') ?: '';

if (have_rows('kolommen_repeater')) : ?>
    <section class="kolommen-blok <?php echo esc_attr($ruimte); ?> <?php echo esc_attr($achtergrond); ?>" <?php if ($blok_id) echo 'id="' . esc_attr($blok_id) . '"'; ?>>
        <div class="container">
            <div class="kolommen-container cols-<?php echo esc_attr($aantal); ?>">
                <?php while (have_rows('kolommen_repeater')) : the_row(); ?>
                    <?php 
                    $afbeelding = get_sub_field('afbeelding');
                    $titel = get_sub_field('titel');
                    $tekst = get_sub_field('tekst');
                    ?>
<div class="kolom scroll-fade">
<?php if ($afbeelding) : ?>
                            <div class="kolom-afbeelding">
                                <img src="<?php echo esc_url($afbeelding['url']); ?>" alt="<?php echo esc_attr($afbeelding['alt']); ?>">
                            </div>
                        <?php endif; ?>
                        <?php if (!empty($titel)) : ?>
                            <h3 class="kolom-titel"><?php echo esc_html($titel); ?></h3>
                        <?php endif; ?>
                        <?php if (!empty($tekst)) : ?>
                            <div class="kolom-tekst"><?php echo wp_kses_post($tekst); ?></div>
                        <?php endif; ?>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>
    </section>
<?php endif; ?>
