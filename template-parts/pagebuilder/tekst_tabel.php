<?php
$weergave = get_sub_field('weergave');
$tekst = get_sub_field('tekst');
$tabel_keuze = get_sub_field('tabel_keuze');
$tabel = get_field($tabel_keuze, 'option'); // Laad tabel vanuit options page

$ruimte = get_sub_field('ruimte') ?: '';
$achtergrond = get_sub_field('achtergrond') ?: '';
$blok_id = get_sub_field('blok_id') ?: '';

// Check of kolom_3 gevuld is (op basis van eerste rij)
$toon_kolom_3 = !empty($tabel[0]['kolom_3']);
?>

<section id="<?php echo esc_attr($blok_id); ?>" class="tekst-tabel-blok <?php echo esc_attr($ruimte); ?> <?php echo esc_attr($achtergrond); ?>">
  <div class="container tekst-tabel-wrapper <?php echo $weergave === 'alleen_tabel' ? 'alleen-tabel' : ''; ?>">
    
    <?php if ($weergave === 'tekst_tabel' && $tekst): ?>
    <div class="tekst styled-lists">
      <?php echo wpautop(do_shortcode($tekst)); ?>
    </div>
    <?php endif; ?>

    <?php if ($tabel): ?>
      <div class="tabel">
        <table>
          <thead>
            <tr>
              <th><?php echo esc_html($tabel[0]['kolom_1']); ?></th>
              <th><?php echo esc_html($tabel[0]['kolom_2']); ?></th>
              <?php if ($toon_kolom_3): ?>
                <th><?php echo esc_html($tabel[0]['kolom_3']); ?></th>
              <?php endif; ?>
            </tr>
          </thead>
          <tbody>
            <?php foreach (array_slice($tabel, 1) as $rij): ?>
              <tr>
                <td><?php echo esc_html($rij['kolom_1']); ?></td>
                <td><?php echo esc_html($rij['kolom_2']); ?></td>
                <?php if ($toon_kolom_3): ?>
                  <td><?php echo esc_html($rij['kolom_3']); ?></td>
                <?php endif; ?>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    <?php endif; ?>

  </div>
</section>

<?php
if ($tabel_keuze === 'prijstabel_basic' && !empty($tabel)) :
    $data_rows = [];
    foreach (array_slice($tabel, 1) as $rij) {
        $data_rows[] = [
            'Onderdeel' => $rij['kolom_1'],
            'Richtprijs_EUR' => $rij['kolom_2'],
            'Totaal_incl_btw' => $rij['kolom_3'],
        ];
    }
    ?>
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "Dataset",
  "@id": "#<?php echo esc_attr($blok_id); ?>",
  "name": "Prijstabel basic",
  "description": "Overzicht van onderdelen en richtprijzen inclusief btw.",
  "data": <?php echo json_encode($data_rows, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT); ?>
}
</script>
<?php endif; ?>
