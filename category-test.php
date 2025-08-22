<?php get_header(); ?>

<main class="site__main">
    <section class="category-page">
        <div class="category-header">
            <div class="category-header__content">
                <h1 class="category-title">
                    <span class="category-title__icon">✈️</span>
                    <?php single_cat_title(); ?>
                </h1>

                <div class="category-stats">
                    <?php
                    global $wp_query;
                    $total_posts = $wp_query->found_posts;
                    ?>
                    <span class="category-stats__count">
                        <?php echo $total_posts; ?> destination<?php echo $total_posts > 1 ? 's' : ''; ?>
                    </span>
                </div>
            </div>
        </div>

        <div class="category-content">
            <?php if (have_posts()) : ?>
                <h2>DEBUG: Nous avons <?php echo $wp_query->found_posts; ?> articles</h2>
                <div class="conteneur conteneur--category">
                    <?php while (have_posts()) : the_post(); ?>
                        <div style="border: 1px solid red; margin: 10px; padding: 10px;">
                            <h3>DEBUG: <?php the_title(); ?></h3>
                            <p>ID: <?php the_ID(); ?></p>
                            <p>Catégories: <?php the_category(', '); ?></p>
                        </div>
                        <?php get_template_part('gabarit/carte'); ?>
                    <?php endwhile; ?>
                </div>
            <?php else : ?>
                <div class="category-no-posts">
                    <h2>DEBUG: Aucun article trouvé</h2>
                    <p>Catégorie actuelle: <?php
                                            $current_cat = get_queried_object();
                                            echo $current_cat->name . ' (Slug: ' . $current_cat->slug . ')';
                                            ?></p>
                </div>
            <?php endif; ?>
        </div>
    </section>
</main>

<?php get_footer(); ?>