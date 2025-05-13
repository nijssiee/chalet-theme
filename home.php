<?php
  add_filter('body_class', function($classes) {
    $classes[] = 'force-scrolled-header';
    return $classes;
  });
?>

<?php get_header(); ?>

<section class="blog-archive">
  <div class="container">
    <h1 class="archive-title">Blog</h1>

    <div class="blog-grid">
      <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <article class="blog-card">
          <a href="<?php the_permalink(); ?>">
            <?php if (has_post_thumbnail()) : ?>
              <div class="blog-card__thumb">
              <?php the_post_thumbnail('large'); ?>
              </div>
            <?php endif; ?>
            <div class="blog-card__content">
              <h2><?php the_title(); ?></h2>
              <p class="blog-card__date"><?php echo get_the_date(); ?></p>
              <p class="blog-card__excerpt"><?php echo get_the_excerpt(); ?></p>
            </div>
          </a>
        </article>
      <?php endwhile; endif; ?>
    </div>

    <div class="blog-pagination">
      <?php the_posts_pagination(); ?>
    </div>
  </div>
</section>

<?php get_footer(); ?>
