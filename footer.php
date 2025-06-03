<footer class="site-footer">
  <div class="container-wide">
    <div class="footer-grid">
      <!-- Kolom 1: Contact -->
      <div class="footer-column">
        <h4>Contact</h4>

        <?php if( get_field('emailadres', 'option') ): ?>
          <p><i class="fa fa-envelope"></i>
            <a href="mailto:<?php the_field('emailadres', 'option'); ?>"><?php the_field('emailadres', 'option'); ?></a>
          </p>
        <?php endif; ?>

        <?php if( get_field('telefoonnummer', 'option') ): ?>
          <p><i class="fa fa-phone"></i>
            <a href="tel:<?php echo preg_replace('/\D+/', '', get_field('telefoonnummer', 'option')); ?>"><?php the_field('telefoonnummer', 'option'); ?></a>
          </p>
        <?php endif; ?>

        <?php if( get_field('adres', 'option') && get_field('postcode_plaats', 'option') ): ?>
          <p>
            <i class="fa fa-map-marker" aria-hidden="true" style="vertical-align: middle; margin-right: 0.5rem;"></i>
            <a href="https://www.google.com/maps/search/<?php echo urlencode(get_field('adres', 'option') . ', ' . get_field('postcode_plaats', 'option')); ?>" target="_blank" rel="noopener" style="display:inline-block; vertical-align: middle;">
              <?php the_field('adres', 'option'); ?><br>
              <?php the_field('postcode_plaats', 'option'); ?>
            </a>
          </p>
        <?php endif; ?>

        <div class="footer-logo" style="margin-top: 2rem;">
          <?php 
          if (has_custom_logo()) {
            the_custom_logo(); 
          } else { ?>
            <a href="<?php echo home_url(); ?>">
              <img src="<?php echo get_template_directory_uri(); ?>/assets/img/logo.png" alt="Logo">
            </a>
          <?php } ?>
        </div>
      </div>

      <!-- Kolom 2: Chalets -->
      <div class="footer-column">
        <h4>Chalets</h4>
        <?php
        wp_nav_menu(array(
          'theme_location' => 'footer_chalets',
          'container'      => 'ul',
          'menu_class'     => 'footer-menu',
          'fallback_cb'    => false
        ));
        ?>
      </div>

      <!-- Kolom 3: Over ons -->
      <div class="footer-column">
        <h4>Over ons</h4>
        <?php
        wp_nav_menu(array(
          'theme_location' => 'footer_over_ons',
          'container'      => 'ul',
          'menu_class'     => 'footer-menu',
          'fallback_cb'    => false
        ));
        ?>
      </div>

            <!-- Kolom 5: Projecten -->
<div class="footer-column">
  <h4>Projecten</h4>
  <?php
  wp_nav_menu(array(
    'theme_location' => 'footer_projecten',
    'container'      => 'ul',
    'menu_class'     => 'footer-menu',
    'fallback_cb'    => false
  ));
  ?>
</div>



      <!-- Kolom 4: Blog -->
      <div class="footer-column">
        <h4>Blog</h4>
        <ul class="footer-menu">
          <?php
          $recent_posts = wp_get_recent_posts([
            'numberposts' => 5,
            'post_status' => 'publish'
          ]);
          foreach ($recent_posts as $post) : ?>
            <li>
              <a href="<?= get_permalink($post['ID']); ?>">
                <?= esc_html($post['post_title']); ?>
              </a>
            </li>
          <?php endforeach; wp_reset_query(); ?>
        </ul>
      </div>

    </div>
  </div>

<!-- Onderfooter -->
<div class="container-wide onderfooter">
  <div class="onderfooter-flex">
    <div class="onderfooter-left">
      <span>© 2025 luxechaletbouwen.nl</span>
      <span>KVK: 82221367</span>
      <span>BTW: NL862380108B01</span>
      <span style="display: block; margin-top: 0.5rem;">
        Initiatief van <a href="https://www.dehouttwist.nl/" target="_blank" rel="noopener">De Houttwist</a>
      </span>
    </div>
    <div class="onderfooter-right">
      <span>Website door <a href="https://niceonline.nl" target="_blank" rel="noopener">Nice Online</a></span>
    </div>
  </div>
</div>
</footer>

<?php wp_footer(); ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<!-- andere code in je footer -->

<script>
  document.addEventListener('DOMContentLoaded', function () {
    const hiddenField = document.querySelector('input[name="page-url"]');
    if (hiddenField) {
      hiddenField.value = window.location.href;
    }
  });
</script>

</body>
</html>

</body>
</html>
