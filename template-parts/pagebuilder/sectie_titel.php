<?php
$titel = get_sub_field('titel');
$ondertitel = get_sub_field('ondertitel');

$ruimte = get_sub_field('ruimte') ?: '';
$achtergrond = get_sub_field('achtergrond') ?: '';
$blok_id = get_sub_field('blok_id') ?: '';
?>

<section id="<?php echo esc_attr($blok_id); ?>" class="sectie-titel-blok <?php echo esc_attr($ruimte); ?> <?php echo esc_attr($achtergrond); ?>">
  <div class="container">
    <?php if ($titel): ?>
<h2 class="sectie-titel" style="text-align:center;"><?php echo wp_kses_post($titel); ?></h2>
    <?php endif; ?>

    <?php if ($ondertitel): ?>
      <p class="sectie-ondertitel" style="text-align:center;"><?php echo esc_html($ondertitel); ?></p>
    <?php endif; ?>
  </div>
</section>
