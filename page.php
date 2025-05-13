<?php get_header(); ?>

<div class="site-content">
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

        <article <?php post_class(); ?>>

            <?php if (have_rows('pagebuilder_content', get_the_ID())) : ?>
                <?php while (have_rows('pagebuilder_content', get_the_ID())) : the_row(); ?>

                    <?php 
                    // Ophalen van de layout naam
                    $layout = get_row_layout();
                    $template = "template-parts/pagebuilder/{$layout}.php";

                    // Controleer of het template bestand bestaat en laad het in
                    if (locate_template($template)) {
                        get_template_part("template-parts/pagebuilder/{$layout}");
                    } else {
                        echo "<p>⚠️ Geen template gevonden voor: {$layout}</p>";
                    }
                    ?>

                <?php endwhile; ?>
            <?php else : ?>
                <p>⚠️ Geen content gevonden in de pagebuilder.</p>
            <?php endif; ?>

        </article>

    <?php endwhile; endif; ?>
</div>

<?php get_footer(); ?>
