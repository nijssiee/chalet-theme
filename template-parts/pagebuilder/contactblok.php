<?php
$intro = get_sub_field('intro_tekst');
$form_shortcode = get_sub_field('formulier_shortcode'); // nieuwe naam als select gebruikt

// Blokinstellingen via kloonveld
$ruimte = get_sub_field('ruimte') ?: '';
$achtergrond = get_sub_field('achtergrond') ?: '';
$blok_id = get_sub_field('blok_id') ?: '';
$curve = get_sub_field('curve') ?: '';
?>

<section class="contactblok <?php echo esc_attr("$ruimte $achtergrond curve-$curve"); ?>" <?php if ($blok_id) echo 'id="' . esc_attr($blok_id) . '"'; ?>>
  <div class="container contactblok__wrapper">

<div class="contactblok__tekst styled-lists">
  <?php echo wpautop(do_shortcode($intro)); ?>
</div>

    <div class="contactblok__form">
      <?php
      if ($form_shortcode) {
        echo do_shortcode($form_shortcode);
      } else {
        echo '<p style="color: red;">Geen formulier geselecteerd.</p>';
      }
      ?>
    </div>

  </div>
</section>
