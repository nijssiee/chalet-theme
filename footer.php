<footer class="site-footer">
  <div class="container">
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
  <div class="container onderfooter">
    <div class="onderfooter-flex">
      <span>KVK: 12345678</span>
      <span>BTW: NL001234567B01</span>
    </div>
  </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
