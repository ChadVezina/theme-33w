<?php

get_header();
?>
<main class="site__main">
    <section class="recherche__section">
        <?php
        global $wp_query;
        $total_results = $wp_query->found_posts;
        $search_query = get_search_query();
        ?>

        <h2>Résultats de recherche</h2>

        <div class="recherche__stats">
            <p>
                <span class="recherche__count"><?php echo $total_results; ?> résultat<?php echo $total_results > 1 ? 's' : ''; ?> trouvé<?php echo $total_results > 1 ? 's' : ''; ?></span>
                pour
                <span class="recherche__terme">"<?php echo esc_html($search_query); ?>"</span>
            </p>
        </div>

        <?php if (have_posts()) : ?>
            <div class="recherche__resultats">
                <?php while (have_posts()) : the_post(); ?>
                    <article class="recherche__article">
                        <h5><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
                        <div class="recherche__meta">
                            <span class="recherche__date"><?php echo get_the_date('j F Y'); ?></span>
                            <?php if (has_category()) : ?>
                                <span class="recherche__categories">
                                    dans <?php the_category(', '); ?>
                                </span>
                            <?php endif; ?>
                        </div>
                        <p><?php echo wp_trim_words(get_the_excerpt(), 30, '...'); ?></p>
                    </article>
                <?php endwhile; ?>
            </div>

            <!-- Pagination -->
            <nav class="recherche__pagination">
                <?php
                the_posts_pagination(array(
                    'prev_text' => '← Précédent',
                    'next_text' => 'Suivant →',
                    'mid_size'  => 2,
                ));
                ?>
            </nav>
        <?php else : ?>
            <!-- Cas "aucun résultat" -->
            <div class="recherche__aucun-resultat">
                <h3>😔 Aucun résultat trouvé</h3>
                <p>Désolé, rien ne correspond à "<?php echo esc_html($search_query); ?>". Essayez d'autres mots-clés ou explorez nos destinations populaires !</p>

                <div class="recherche__suggestions">
                    <h4>Essayez une nouvelle recherche :</h4>
                    <form class="recherche__suggestions__form" role="search" method="get" action="<?php echo esc_url(home_url('/')); ?>">
                        <label>
                            <input type="search" placeholder="Rechercher une destination..." value="" name="s" />
                        </label>
                        <button type="submit">
                            <span class="recherche__icone">🔍</span>
                        </button>
                    </form>
                </div>
            </div>
        <?php endif; ?>
    </section>
</main>
<?php get_footer(); ?>