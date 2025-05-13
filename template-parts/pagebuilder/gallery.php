<?php
$afbeeldingen = get_sub_field('afbeeldingen');
$titel = get_sub_field('titel');
$subtitel = get_sub_field('subtitel');

// Blokinstellingen
$ruimte = get_sub_field('ruimte') ?: '';
$achtergrond = get_sub_field('achtergrond') ?: '';
$blok_id = get_sub_field('blok_id') ?: '';
?>

<?php if ($afbeeldingen): ?>
<section id="<?= esc_attr($blok_id); ?>" class="gallery-block <?= esc_attr($ruimte); ?> <?= esc_attr($achtergrond); ?>">
  <div class="container">

    <?php if ($titel || $subtitel): ?>
      <div class="blok-titel">
        <?php if ($titel): ?>
          <h2><?= esc_html($titel); ?></h2>
        <?php endif; ?>
        <?php if ($subtitel): ?>
          <p><?= esc_html($subtitel); ?></p>
        <?php endif; ?>
      </div>
    <?php endif; ?>

<div class="gallery-wrapper" style="position: relative;">
  
  <!-- Pijltjes voor desktop -->
  <button class="masonry-arrow left desktop-only">←</button>
  <button class="masonry-arrow right desktop-only">→</button>

  <div class="masonry">
    <?php foreach ($afbeeldingen as $afbeelding): ?>
      <div class="masonry-item">
        <a href="<?= esc_url($afbeelding['url']); ?>" data-fancybox="gallery">
          <img src="<?= esc_url($afbeelding['sizes']['large']); ?>" alt="" loading="lazy" class="object-cover w-full h-full">
        </a>
      </div>
    <?php endforeach; ?>
  </div>
</div>

<!-- Dots alleen op mobiel -->
<div class="gallery-navigation mobile-only">
  <div class="dots">
    <?php foreach ($afbeeldingen as $index => $afbeelding): ?>
      <span class="dot" data-slide="<?= $index; ?>"></span>
    <?php endforeach; ?>
  </div>
</div>

    
  </div>
</section>
<?php endif; ?>
