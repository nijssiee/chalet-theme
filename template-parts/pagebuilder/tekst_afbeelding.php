<?php
$afbeelding = get_sub_field('afbeelding');
$afbeelding_positie = get_sub_field('afbeelding_positie') ?: 'links';
$tekst = get_sub_field('tekst');
$knop_label = get_sub_field('knop_label');
$knop_link = get_sub_field('knop_link');
$ruimte = get_sub_field('ruimte') ?: '';
$achtergrond = get_sub_field('achtergrond') ?: '';
$blok_id = get_sub_field('blok_id') ?: '';
$toon_knop = !empty($knop_label);
?>

<section id="<?= esc_attr($blok_id ? sanitize_title($blok_id) : ''); ?>"
         class="tekst-afbeelding <?= esc_attr($ruimte); ?> <?= esc_attr($achtergrond); ?> afbeelding-<?= esc_attr($afbeelding_positie); ?>">

  <div class="container">
    <div class="tekst-afbeelding__wrapper">

      <div class="tekst-afbeelding__content">
        <?php if ($tekst): ?>
          <div class="tekst-afbeelding__tekst">
            <?= wp_kses_post($tekst); ?>
          </div>
        <?php endif; ?>

        <?php if ($toon_knop): ?>
          <a href="<?= esc_url(get_permalink($knop_link)); ?>" class="btn"><?= esc_html($knop_label); ?></a>
        <?php endif; ?>
      </div>

      <?php if ($afbeelding): ?>
        <?php $is_svg = isset($afbeelding['mime_type']) && $afbeelding['mime_type'] === 'image/svg+xml'; ?>
        <div class="tekst-afbeelding__afbeelding<?= $is_svg ? ' is-svg' : ''; ?>">
          <div class="tekst-afbeelding__img-wrapper">
            <img 
              src="<?= esc_url($is_svg ? $afbeelding['url'] : $afbeelding['sizes']['large']); ?>" 
              alt="<?= esc_attr($afbeelding['alt']); ?>" 
              class="tekst-afbeelding__img" 
              loading="lazy"
            />
          </div>
        </div>
      <?php endif; ?>

    </div>
  </div>
</section>
