<?php get_header(); ?>

<main class="site__main">
    <section class="recherche__section">
        <?php
        global $wp_query;
        $total_results = $wp_query->found_posts;
        $search_query = get_search_query();
        ?>

        <div class="recherche__header">
            <h1 class="recherche__title">
                <span class="recherche__icon">🔍</span>
                Résultats de recherche
            </h1>

            <div class="recherche__stats">
                <div class="recherche__stats-content">
                    <span class="recherche__count recherche__count--<?php echo $total_results > 0 ? 'found' : 'empty'; ?>">
                        <?php echo $total_results; ?> résultat<?php echo $total_results > 1 ? 's' : ''; ?> trouvé<?php echo $total_results > 1 ? 's' : ''; ?>
                    </span>
                    <span class="recherche__pour">pour</span>
                    <span class="recherche__terme">"<?php echo esc_html($search_query); ?>"</span>
                </div>

                <?php if ($total_results > 0): ?>
                    <div class="recherche__filters">
                        <span class="recherche__filter-label">Trier par :</span>
                        <select class="recherche__sort" onchange="this.form.submit()">
                            <option value="relevance">Pertinence</option>
                            <option value="date">Date</option>
                            <option value="title">Titre</option>
                        </select>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <?php if (have_posts()) : ?>
            <div class="recherche__resultats">
                <?php $count = 0; ?>
                <?php while (have_posts()) : the_post(); ?>
                    <?php $count++; ?>
                    <article class="recherche__article" data-result="<?php echo $count; ?>">
                        <div class="recherche__article-header">
                            <h2 class="recherche__article-title">
                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            </h2>

                            <div class="recherche__meta">
                                <span class="recherche__date">
                                    <span class="recherche__meta-icon">📅</span>
                                    <?php echo get_the_date('j F Y'); ?>
                                </span>

                                <?php if (has_category()) : ?>
                                    <span class="recherche__categories">
                                        <span class="recherche__meta-icon">🏷️</span>
                                        dans <?php the_category(', '); ?>
                                    </span>
                                <?php endif; ?>

                                <?php if (get_the_author()) : ?>
                                    <span class="recherche__author">
                                        <span class="recherche__meta-icon">👤</span>
                                        par <?php the_author(); ?>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <?php if (has_post_thumbnail()) : ?>
                            <div class="recherche__thumbnail">
                                <a href="<?php the_permalink(); ?>">
                                    <?php the_post_thumbnail('thumbnail', array('alt' => get_the_title())); ?>
                                </a>
                            </div>
                        <?php endif; ?>

                        <div class="recherche__excerpt">
                            <p><?php echo wp_trim_words(get_the_excerpt(), 25, '...'); ?></p>
                            <a href="<?php the_permalink(); ?>" class="recherche__read-more">
                                Lire la suite <span class="recherche__arrow">→</span>
                            </a>
                        </div>
                    </article>
                <?php endwhile; ?>
            </div>

            <!-- Pagination améliorée -->
            <nav class="recherche__pagination">
                <?php
                the_posts_pagination(array(
                    'prev_text' => '<span class="pagination-icon">←</span> Précédent',
                    'next_text' => 'Suivant <span class="pagination-icon">→</span>',
                    'mid_size'  => 2,
                    'screen_reader_text' => 'Navigation des résultats de recherche',
                ));
                ?>
            </nav>
        <?php else : ?>
            <!-- Cas "aucun résultat" amélioré -->
            <div class="recherche__aucun-resultat">
                <div class="recherche__empty-icon">🧭</div>
                <h2 class="recherche__empty-title">Aucun résultat trouvé</h2>
                <p class="recherche__empty-text">
                    Désolé, rien ne correspond à <strong>"<?php echo esc_html($search_query); ?>"</strong>.
                    Essayez d'autres mots-clés ou explorez nos destinations populaires !
                </p>

                <div class="recherche__suggestions">
                    <h3 class="recherche__suggestions-title">💡 Suggestions pour améliorer votre recherche :</h3>
                    <ul class="recherche__tips">
                        <li>Vérifiez l'orthographe de vos mots-clés</li>
                        <li>Essayez des termes plus généraux</li>
                        <li>Utilisez des synonymes</li>
                        <li>Réduisez le nombre de mots</li>
                    </ul>

                    <div class="recherche__new-search">
                        <h4 class="recherche__new-search-title">Essayez une nouvelle recherche :</h4>
                        <form class="recherche__form recherche__form--highlighted" role="search" method="get" action="<?php echo esc_url(home_url('/')); ?>">
                            <div class="recherche__input-group">
                                <label class="recherche__label" for="search-input">
                                    <span class="screen-reader-text">Rechercher :</span>
                                </label>
                                <input
                                    id="search-input"
                                    class="recherche__input"
                                    type="search"
                                    placeholder="Rechercher une destination..."
                                    value=""
                                    name="s"
                                    autocomplete="off" />
                                <button type="submit" class="recherche__button">
                                    <span class="recherche__button-icon">🔍</span>
                                    <span class="recherche__button-text">Rechercher</span>
                                </button>
                            </div>
                        </form>
                    </div>

                    <!-- Suggestions de destinations populaires -->
                    <div class="recherche__populaire">
                        <h4 class="recherche__populaire-title">🌟 Destinations populaires</h4>
                        <div class="recherche__populaire-links">
                            <?php
                            $popular_posts = get_posts(array(
                                'numberposts' => 6,
                                'category_name' => 'populaire',
                                'post_status' => 'publish'
                            ));

                            if ($popular_posts) :
                                foreach ($popular_posts as $post) :
                                    setup_postdata($post);
                            ?>
                                    <a href="<?php echo get_permalink(); ?>" class="recherche__populaire-link">
                                        <?php echo get_the_title(); ?>
                                    </a>
                            <?php
                                endforeach;
                                wp_reset_postdata();
                            endif;
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </section>
</main>

<?php get_footer(); ?>