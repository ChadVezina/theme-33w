<?php

/**
 * Modèle pour les résultats de recherche
 */
get_header();
?>
<main class="site__main">
    <section class="recherche__section">
        <?php
        global $wp_query;
        $total_results = $wp_query->found_posts;
        $search_query = get_search_query();
        ?>
        <h2>Résultats de recherche pour : "<?php echo esc_html($search_query); ?>"</h2>
        <p><?php echo $total_results; ?> résultat(s) trouvé(s)</p>

        <!-- Liste des résultats -->
        <?php if (have_posts()) : ?>
            <?php while (have_posts()) : the_post(); ?>
                <article>
                    <h5><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
                    <p><?php echo wp_trim_words(get_the_excerpt(), 60); ?></p>
                    <hr>
                </article>
            <?php endwhile; ?>

            <!-- Pagination -->
            <nav class="recherche__pagination">
                <?php
                the_posts_pagination(array(
                    'prev_text' => 'Précédent',
                    'next_text' => 'Suivant',
                    'mid_size'  => 2,
                ));
                ?>
            </nav>
        <?php else : ?>
            <!-- Cas "aucun résultat" -->
            <div class="recherche__aucun-resultat">
                <h3>Aucun résultat trouvé</h3>
                <p>Désolé, rien ne correspond à "<?php echo esc_html($search_query); ?>". Essayez d'autres mots-clés !</p>
            </div>
        <?php endif; ?>
    </section>
</main>
<?php get_footer(); ?>