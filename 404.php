<?php
  add_filter('body_class', function($classes) {
    $classes[] = 'force-scrolled-header';
    return $classes;
  });
?>

<?php get_header(); ?>

<section class="fourofour">
  <div class="container">
    <h1>Pagina niet gevonden</h1>
    <p>De pagina die je zoekt bestaat niet (meer) of is verplaatst.</p>
    <a href="<?php echo esc_url(home_url('/')); ?>" class="btn">Terug naar home</a>
  </div>
</section>

<?php get_footer(); ?>
