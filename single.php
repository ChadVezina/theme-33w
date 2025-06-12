<?php get_header() ?>

<main class="single-post">
    <?php if (have_posts()) : ?>
        <?php while (have_posts()) : the_post(); ?>
            <article class="single-post__article">
                <header class="single-post__header">
                    <h1 class="single-post__title"><?php the_title(); ?></h1>
                    <div class="single-post__meta">
                        <span class="single-post__date"><?php echo get_the_date(); ?></span>
                        <span class="single-post__author">Par <?php the_author(); ?></span>
                        <?php if (has_category()) : ?>
                            <span class="single-post__categories">
                                <?php the_category(', '); ?>
                            </span>
                        <?php endif; ?>
                    </div>
                </header>

                <?php if (has_post_thumbnail()) : ?>
                    <div class="single-post__featured-image">
                        <?php the_post_thumbnail('large', ['class' => 'single-post__image']); ?>
                    </div>
                <?php endif; ?>

                <div class="single-post__content">
                    <?php the_content(); ?>
                </div>
            </article>

        <?php endwhile; ?>
    <?php else : ?>
        <div class="single-post__no-content">
            <h2>Aucun contenu trouvé</h2>
            <p>Désolé, aucun contenu n'a été trouvé.</p>
        </div>
    <?php endif; ?>
</main>

<?php get_footer(); ?>