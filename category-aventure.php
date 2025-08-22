<?php
// Debug: Confirmer que ce template spécifique est utilisé
error_log('DEBUG - category-aventure.php est chargé !');

get_header(); ?>

<!-- DEBUG VISIBLE -->
<div style="position: fixed; top: 0; right: 0; background: blue; color: white; padding: 10px; z-index: 9999; font-size: 14px;">
    🔵 TEMPLATE: category-aventure.php
</div>

<main class="site__main">
    <section class="category-page">
        <div class="category-header">
            <div class="category-header__content">
                <h1 class="category-title">
                    <span class="category-title__icon">✈️</span>
                    AVENTURE - Template Spécifique
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
                <div class="conteneur conteneur--category">
                    <?php while (have_posts()) : the_post(); ?>
                        <div style="border: 2px solid blue; margin: 10px; padding: 10px;">
                            <h3><?php the_title(); ?></h3>
                            <p>Catégories: <?php the_category(', '); ?></p>
                            <?php if (has_post_thumbnail()) : ?>
                                <?php the_post_thumbnail('thumbnail'); ?>
                            <?php endif; ?>
                            <a href="<?php the_permalink(); ?>">Voir plus</a>
                        </div>
                    <?php endwhile; ?>
                </div>
            <?php else : ?>
                <div>
                    <h2>Aucun article trouvé dans Aventure</h2>
                    <p>Debug info:</p>
                    <ul>
                        <li>is_category(): <?php echo is_category() ? 'OUI' : 'NON'; ?></li>
                        <li>get_queried_object(): <?php var_dump(get_queried_object()); ?></li>
                    </ul>
                </div>
            <?php endif; ?>
        </div>
    </section>
</main>

<?php get_footer(); ?>