<?php
$vragen = get_sub_field('selecteer_vragen');
$titel = get_sub_field('titel');
$subtitel = get_sub_field('subtitel');

// Blokinstellingen ophalen via kloonveld
$ruimte = get_sub_field('ruimte') ?: '';
$achtergrond = get_sub_field('achtergrond') ?: '';
$blok_id = get_sub_field('blok_id') ?: '';
$curve = get_sub_field('curve') ?: '';
?>

<?php if ($vragen): ?>
<section class="faq-blok <?php echo esc_attr("$ruimte $achtergrond curve-$curve"); ?>" <?php if ($blok_id) echo 'id="' . esc_attr($blok_id) . '"'; ?>>
  <div class="container">
    
    <?php if ($titel): ?>
      <h2 class="faq-titel"><?php echo esc_html($titel); ?></h2>
    <?php endif; ?>
    <?php if ($subtitel): ?>
      <p class="faq-subtitel"><?php echo esc_html($subtitel); ?></p>
    <?php endif; ?>

    <div class="faq-items" itemscope itemtype="https://schema.org/FAQPage">
      <?php foreach ($vragen as $index => $post): setup_postdata($post); ?>
        <?php
          $vraag_id = 'faq-antw-' . $index;
        ?>
        <div class="faq-item" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
          <button
            class="faq-vraag"
            aria-expanded="false"
            aria-controls="<?php echo esc_attr($vraag_id); ?>"
            itemprop="name"
          >
            <?php the_title(); ?>
            <span class="icoon">+</span>
          </button>
          <div
            id="<?php echo esc_attr($vraag_id); ?>"
            class="faq-antwoord"
            hidden
            itemscope
            itemprop="acceptedAnswer"
            itemtype="https://schema.org/Answer"
          >
<div itemprop="text" class="styled-lists">
  <?php the_content(); ?>
</div>
          </div>
        </div>
      <?php endforeach; wp_reset_postdata(); ?>
    </div>
  </div>
</section>
<?php endif; ?>
