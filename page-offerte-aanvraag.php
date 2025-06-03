<?php
/**
 * Template Name: Offerte aanvraag (los)
 */
get_header();
?>
<style>
  .blok.offerte-aanvraag,
  .blok.offerte-aanvraag > .container {
    overflow: visible !important;
  }
</style>
<section class="blok offerte-aanvraag">
  <div class="container" style="display: flex; gap: 3rem; align-items: flex-start;">

<?php
global $keuzedata_str;
$keuzesGesorteerd = [];
$keuzedata_str = '';

if (!empty($_GET)) {
    foreach ($_GET as $stap => $optie) {
        $stap = urldecode($stap);
        $optie = urldecode($optie);
        $stap = preg_replace('/^stap\s*\d+\s*:\s*/i', '', $stap);
        $stap = trim($stap);

        if (!isset($keuzesGesorteerd[$stap])) {
            $keuzesGesorteerd[$stap] = [];
        }
        $keuzesGesorteerd[$stap][] = $optie;
    }

// Bouw HTML string voor mail & hidden field
$keuzedata_str = '<ul style="background:#f8f5f0; padding: 1rem; border-radius: 8px;">';
foreach ($keuzesGesorteerd as $stap => $opties) {
    // underscore vervangen door spaties in stapnaam
    $stap = str_replace('_', ' ', $stap);

    $keuzedata_str .= '<li><strong>' . esc_html(trim($stap)) . '</strong><ul>';
    foreach ($opties as $opt) {
        $keuzedata_str .= '<li>' . esc_html(trim($opt)) . '</li>';
    }
    $keuzedata_str .= '</ul></li>';
}
$keuzedata_str .= '</ul>';
}?>

<?php if (!empty($keuzesGesorteerd)) : ?>
  <div class="offerte-keuzes" style="flex: 1; background: #f5f5f5; padding: 1.5rem; border-radius: 12px; overflow-wrap: break-word;">
    <h3>Jouw keuzes:</h3>
    <p>Hieronder zie je de keuzes die je hebt gemaakt. Deze worden gebruikt om een offerte voor je op te stellen.</p>
    <ol style="padding-left: 0; margin-left: 0;">
      <?php foreach($keuzesGesorteerd as $stap => $opties): ?>
        <li>
          <p><strong><?php echo esc_html(str_replace('_', ' ', $stap)); ?></strong></p>
          <ul style="margin-top: 0; padding-left: 0;">
            <?php foreach ($opties as $optie): ?>
              <li><?php echo esc_html($optie); ?></li>
            <?php endforeach; ?>
          </ul>
        </li>
      <?php endforeach; ?>
    </ol>
  </div>
<?php endif; ?>

<div class="contactblok__form" style="flex: 1;">
  <?php echo do_shortcode('[contact-form-7 id="e4bfc8d" title="Offerte formulier"]'); ?>
</div>

  </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function () {
  var keuzedataHtml = <?php echo json_encode($keuzedata_str); ?>;
  var hiddenField = document.querySelector('input[name="keuzedata"]');
  if (hiddenField) {
    hiddenField.value = keuzedataHtml;
  }
});
</script>

<?php get_footer(); ?>
