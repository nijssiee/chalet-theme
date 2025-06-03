<?php
/**
 * Template: Prijs Calculator
 * Locatie: template-parts/pagebuilder/prijs_calculator.php
 */

// Blokinstellingen ophalen
$ruimte = get_sub_field('ruimte') ?: '';
$achtergrond = get_sub_field('achtergrond') ?: '';
$blok_id = get_sub_field('blok_id') ?: '';
?>

<section id="<?php echo esc_attr($blok_id); ?>" class="prijs-calculator blok <?php echo esc_attr($ruimte); ?> <?php echo esc_attr($achtergrond); ?>">
  <div class="container">
    <div class="prijs-calculator-wrapper">

      <div class="tekst">
        <form id="calculator-form">
          <div class="stappen-progress">
  <div class="progress-track">
<div class="progress-track">
  <div class="progress-bar completed"></div>
</div>
  </div>
  <ul class="progress-steps">
    <li class="active">1</li>
    <li>2</li>
    <li>3</li>
    <li>4</li>
    <li>5</li>
    <li>6</li>
    <li>7</li>
    <li>8</li>
    <li>9</li>
    <li>10</li>
    <li>11</li>
    <li>12</li>
  </ul>
</div>

          <div class="form-step-container">
            <div class="form-step-wrap">

<div class="stap active" data-step="1">
  <h2>Stap 1: Kies je indeling</h2>
  <hr class="stap-divider">

  <div class="indeling-options">
    <label class="indeling-option" data-label="Optie 1">
      <span style="font-weight: 600; margin-bottom: 0.5rem; display: block;">Optie 1</span>
      <input type="radio" name="indeling" value="0" />
      <img src="<?php echo get_template_directory_uri(); ?>/assets/images/Standaard-chalet.svg" alt="Standaard chalet" />
    </label>

    <label class="indeling-option" data-label="Optie 2">
      <span style="font-weight: 600; margin-bottom: 0.5rem; display: block;">Optie 2</span>
      <input type="radio" name="indeling" value="0" />
      <img src="<?php echo get_template_directory_uri(); ?>/assets/images/Standaard-chalet-omgekeerd.svg" alt="Standaard chalet omgekeerd" />
    </label>
  </div>
</div>

<div class="stap" data-step="2">
  <h2>Stap 2: Gevelbekleding</h2>
  <hr class="stap-divider">
  <div class="opties-grid">
    <label><input type="radio" name="gevel" value="0"> Kunststof standaard</label>
    <label><input type="radio" name="gevel" value="3300"> Kunststof Keralit (+ €3300,-)</label>
    <label><input type="radio" name="gevel" value="5000"> Hout red cedar (+ €5000,-)</label>
    <label><input type="radio" name="gevel" value="3000"> Thermisch gemodificeerd hout (+ €3000,-)</label>
    <label><input type="radio" name="gevel" value="2000"> Composiet Horizontale planken (+ €2000,-)</label>
    <label><input type="radio" name="gevel" value="3500"> Composiet Verticaal geprofileerd (+ €3500,-)</label>
  </div>
</div>

<div class="stap" data-step="3">
  <h2>Stap 3: Kozijnen</h2>
  <hr class="stap-divider">
  <div class="opties-grid">
    <label><input type="radio" name="kozijnen" value="0"> Kunststof standaard</label>
    <label><input type="radio" name="kozijnen" value="3300"> Hout, ralkleur naar keuze (+ €3300,-)</label>
    <label><input type="radio" name="kozijnen" value="5000"> Aluminium (+ €5000,-)</label>
  </div>
</div>

<div class="stap" data-step="4">
  <h2>Stap 4: Dak</h2>
  <hr class="stap-divider">
  <div class="opties-grid">
    <label><input type="radio" name="dak" value="0"> Platdak</label>
    <label><input type="radio" name="dak" value="2000"> Lessenaardak (+ €2000,-)</label>
    <label><input type="radio" name="dak" value="5000"> Puntdak (+ €5000,-)</label>
  </div>
</div>

<div class="stap" data-step="5">
  <h2>Stap 5: Afwerking dak</h2>
  <hr class="stap-divider">
  <div class="opties-grid" id="afwerking-dak">
    <!-- wordt dynamisch gegenereerd op basis van stap 4 keuze via JS -->
  </div>
</div>

<div class="stap" data-step="6">
  <h2>Stap 6: Isolatiewaarde</h2>
  <hr class="stap-divider">
  <div class="opties-grid">
    <label><input type="radio" name="isolatie" value="2900"> Standaard (dak, wand en vloer) (+ €2900,-)</label>
    <label><input type="radio" name="isolatie" value="3100"> Hoogwaardig (winterproof) (+ €3100,-)</label>
  </div>
</div>

<div class="stap" data-step="7">
  <h2>Stap 7: Wandafwerking</h2>
  <hr class="stap-divider">
  <div class="opties-grid">
    <label><input type="radio" name="wand" value="0"> Standaard (Beplaat)</label>
    <label><input type="radio" name="wand" value="400"> Agnes wandpanelen (+ €400,-)</label>
    <label><input type="radio" name="wand" value="800"> Renovlies zonder afwerking (+ €800,-)</label>
    <label><input type="radio" name="wand" value="2500"> Renovlies met sauswerk (+ €2500,-)</label>
  </div>
</div>

<div class="stap" data-step="8">
  <h2>Stap 8: Vloerafwerking</h2>
  <hr class="stap-divider">
  <div class="opties-grid">
    <label><input type="radio" name="vloer" value="0"> Kale vloer</label>
    <label><input type="radio" name="vloer" value="1500"> Laminaat (+ €1500,-)</label>
    <label><input type="radio" name="vloer" value="2500"> PVC clickvloer (+ €2500,-)</label>
  </div>
</div>

<div class="stap" data-step="9">
  <h2>Stap 9: Plafondafwerking</h2>
  <hr class="stap-divider">
  <div class="opties-grid">
    <label><input type="radio" name="plafond" value="0"> Scandinavisch hout</label>
    <label><input type="radio" name="plafond" value="3500"> Agnes plafondpanelen (+ €3500,-)</label>
  </div>
</div>

<div class="stap" data-step="10">
  <h2>Stap 10: Keuken opties</h2>
  <hr class="stap-divider">
  <div class="opties-grid">
    <label><input type="radio" name="keuken" value="0"> Geen keuken</label>
    <label><input type="radio" name="keuken" value="4200"> Standaard keuken (+ €4200,-)</label>
    <label><input type="radio" name="keuken" value="7750"> Luxe keuken (+ €7750,-)</label>
  </div>
</div>

<div class="stap" data-step="11">
  <h2>Stap 11: Badkamer opties</h2>
  <hr class="stap-divider">
  <div class="opties-grid">
    <label><input type="radio" name="badkamer" value="0"> Geen badkamer</label>
    <label><input type="radio" name="badkamer" value="1400"> Standaard badkamer (+ €1400,-)</label>
    <label><input type="radio" name="badkamer" value="3250"> Luxe badkamer (+ €3250,-)</label>
  </div>
</div>

<div class="stap" data-step="12">
  <h2>Stap 12: Ventilatie, verwarming en watervoorziening</h2>
  <hr class="stap-divider">
  <div class="opties-grid">
    <label><input type="checkbox" name="verwarming[]" value="0"> Elektrische radiatoren + boiler (140L)</label>
    <label><input type="checkbox" name="verwarming[]" value="1400"> Extra: Vloerverwarming (+ €1400,-)</label>
    <label><input type="checkbox" name="verwarming[]" value="1950"> Extra: Zonnepanelen (+ €1950,-)</label>
    <label><input type="checkbox" name="verwarming[]" value="6850"> Extra: Airco (+ €6850,-)</label>
    <button type="submit" class="btn btn-actie">Vraag offerte aan</button>
  </div>
</div>

            </div>

            <div class="stap-buttons" style="display: flex; justify-content: space-between;" id="stap-buttons-container">
              <button type="button" class="btn-actie" onclick="vorigeStap()" id="btn-vorige">
                <span class="arrow">←</span> Vorige
              </button>
              <button type="button" class="btn-actie" onclick="volgendeStap()">Volgende <span class="arrow">→</span></button>
            </div>
          </div>
        </form>
      </div>

      <div class="prijs-wrap">
        <div class="prijs-output">
          <div id="prijs">Vanaf prijs: € 0</div>
          <div class="prijs-toelichting">
            Dit is een indicatieve prijs op basis van jouw keuzes. De uiteindelijke prijs kan afwijken door maatwerk, locatie of aanvullende wensen.
          </div>
        </div>
      </div>

    </div>
  </div>
</section>

<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "WebApplication",
  "name": "Chalet prijs calculator",
  "url": "https://www.chaletlatenbouwen.nl/prijs-berekenen/",
  "applicationCategory": "Real Estate Application",
  "operatingSystem": "All",
  "description": "Bereken eenvoudig de prijs van jouw chalet op basis van oppervlakte, constructie, interieur en exterieur. Je krijgt direct een indicatie van de kosten.",
  "offers": {
    "@type": "Offer",
    "price": "0.00",
    "priceCurrency": "EUR"
  },
  "publisher": {
    "@type": "Organization",
    "name": "Chaletlatebouwen.nl",
    "url": "https://chaletlatenbouwen.nl"
  }
}
</script>
