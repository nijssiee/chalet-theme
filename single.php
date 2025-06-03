<?php get_header(); ?>

<section class="single-post">
<?php if (has_post_thumbnail()) : ?>
<section class="hero post-hero">
  <div class="hero-bg" style="background-image: url('<?php the_post_thumbnail_url('full'); ?>');"></div>
  <div class="hero-overlay"></div>
  <div class="container">
    <div class="hero-content hero-content--left">
      <h1><?php the_title(); ?></h1>
      <p class="post-date"><?php echo get_the_date('j F Y'); ?></p>
    </div>
  </div>
</section>
<?php endif; ?>

<div class="container">
  <div class="single-post__wrapper" style="display: flex; gap: 50px; flex-wrap: wrap; align-items: flex-start;">

    <div class="single-post__content" style="flex: 1 1 65%;">
      <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <div class="post-content styled-lists">
          <?php the_content(); ?>
        </div>

        <?php
        $prev = get_previous_post();
        $next = get_next_post();
        ?>

        <div class="post-navigation" style="display: flex; justify-content: space-between; margin-top: 50px; gap: 20px;">
          <div class="prev-post">
            <?php if ($prev): ?>
              <a href="<?= get_permalink($prev->ID); ?>" class="btn" style="display:inline-block;padding:12px 24px;background:#000;color:#fff;text-decoration:none;border-radius:6px;">
                ← <?= esc_html(get_the_title($prev->ID)); ?>
              </a>
            <?php endif; ?>
          </div>
          <div class="next-post">
            <?php if ($next): ?>
              <a href="<?= get_permalink($next->ID); ?>" class="btn" style="display:inline-block;padding:12px 24px;background:#000;color:#fff;text-decoration:none;border-radius:6px;">
                <?= esc_html(get_the_title($next->ID)); ?> →
              </a>
            <?php endif; ?>
          </div>
        </div>

      <?php endwhile; endif; ?>
    </div>

    <aside class="single-post__sidebar" style="flex: 1 1 30%;">
      <h2>Meer berichten</h2>
      <ul class="sidebar-cards">
        <?php
        $recent_posts = wp_get_recent_posts([
          'numberposts' => 5,
          'post_status' => 'publish',
          'exclude' => [get_the_ID()],
        ]);
        foreach ($recent_posts as $post) :
          $thumbnail = get_the_post_thumbnail($post['ID'], 'thumbnail');
        ?>
        <li class="sidebar-card">
          <a href="<?= get_permalink($post['ID']); ?>">
            <div class="sidebar-card__thumb"><?= $thumbnail; ?></div>
            <div class="sidebar-card__text">
              <div class="sidebar-card__title"><?= esc_html($post['post_title']); ?></div>
              <div class="sidebar-card__date"><?= get_the_date('j F Y', $post['ID']); ?></div>
            </div>
          </a>
        </li>
        <?php endforeach; wp_reset_query(); ?>
      </ul>
    </aside>

  </div>
</div>
</section>

<?php get_footer(); ?>
