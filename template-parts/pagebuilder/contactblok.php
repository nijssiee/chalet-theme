<?php
$intro = get_sub_field('intro_tekst');
$form = get_sub_field('formulier_shortcode');

// Blokinstellingen via kloonveld
$ruimte = get_sub_field('ruimte') ?: '';
$achtergrond = get_sub_field('achtergrond') ?: '';
$blok_id = get_sub_field('blok_id') ?: '';
$curve = get_sub_field('curve') ?: '';
?>

<section class="contactblok <?php echo esc_attr("$ruimte $achtergrond curve-$curve"); ?>" <?php if ($blok_id) echo 'id="' . esc_attr($blok_id) . '"'; ?>>
  <div class="container contactblok__wrapper">

    <div class="contactblok__tekst">
      <?php echo $intro; ?>
    </div>
    <div class="contactblok__form">
      <?php echo do_shortcode($form); ?>
    </div>

  </div>
</section>
