<?php get_header(); ?>

<!-- TEMPLATE: single-post.php - Post type DESTINATIONS -->

<main class="single-destination">
    <?php if (have_posts()) : ?>
        <?php while (have_posts()) : the_post(); ?>
            <article class="destination-article">

                <!-- En-tête de la destination -->
                <header class="destination-header">
                    <div class="destination-title-section">
                        <h1 class="destination-title"><?php the_title(); ?></h1>
                    </div>

                    <!-- Métadonnées de la destination -->
                    <div class="destination-meta">
                        <div class="destination-meta__item destination-meta__author">
                            <span class="destination-meta__label">Auteur :</span>
                            <span class="destination-meta__value"><?php the_author(); ?></span>
                        </div>

                        <div class="destination-meta__item destination-meta__date">
                            <span class="destination-meta__label">Date de publication :</span>
                            <span class="destination-meta__value"><?php echo get_the_date('d F Y'); ?></span>
                        </div>

                        <?php if (has_category()) : ?>
                            <div class="destination-meta__item destination-meta__categories">
                                <span class="destination-meta__label">Catégories :</span>
                                <div class="destination-meta__categories-list">
                                    <?php
                                    $categories = get_the_category();
                                    if ($categories) {
                                        foreach ($categories as $index => $category) {
                                            echo '<span class="destination-category">' . esc_html($category->name) . '</span>';
                                            if ($index < count($categories) - 1) {
                                                echo '<span class="category-separator">, </span>';
                                            }
                                        }
                                    }
                                    ?>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </header>

                <!-- Image mise en avant ou image par défaut -->
                <div class="destination-featured-image">
                    <?php if (has_post_thumbnail()) : ?>
                        <?php the_post_thumbnail('large', [
                            'class' => 'destination-image',
                            'alt' => get_the_title()
                        ]); ?>
                    <?php else : ?>
                        <!-- Image par défaut si aucune image mise en avant -->
                        <img src="<?php echo get_template_directory_uri(); ?>/images/destination1.jpg"
                            alt="Image par défaut - <?php the_title(); ?>"
                            class="destination-image destination-image--default">
                    <?php endif; ?>
                </div>

                <!-- Description complète de la destination -->
                <div class="destination-content">
                    <h2 class="destination-content__title">Description de la destination</h2>
                    <div class="destination-description">
                        <?php the_content(); ?>
                    </div>
                </div>

                <?php
                // Récupération des champs personnalisés ACF
                $temp_min = get_field('temperature_minimum');
                $temp_max = get_field('temperature_maximum');
                $temp_moy = get_field('temperature_moyenne');
                $note_general = get_field('note_general');
                ?>

                <!-- Section des températures -->
                <?php if ($temp_min || $temp_max || $temp_moy) : ?>
                    <section class="destination-temperatures">
                        <h2 class="destination-section-title">
                            <span class="section-icon">🌡️</span>
                            Informations climatiques
                        </h2>

                        <div class="temperatures-grid">
                            <?php if ($temp_min) : ?>
                                <div class="temperature-card temperature-card--<?php echo esc_attr(get_temperature_class($temp_min)); ?>">
                                    <div class="temperature-card__header">
                                        <h3 class="temperature-card__title">Température minimum</h3>
                                    </div>
                                    <div class="temperature-card__content">
                                        <span class="temperature-value"><?php echo esc_html($temp_min); ?>°C</span>
                                        <span class="temperature-description">
                                            <?php echo esc_html(get_temperature_description($temp_min, 'min')); ?>
                                        </span>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <?php if ($temp_max) : ?>
                                <div class="temperature-card temperature-card--<?php echo esc_attr(get_temperature_class($temp_max)); ?>">
                                    <div class="temperature-card__header">
                                        <h3 class="temperature-card__title">Température maximum</h3>
                                    </div>
                                    <div class="temperature-card__content">
                                        <span class="temperature-value"><?php echo esc_html($temp_max); ?>°C</span>
                                        <span class="temperature-description">
                                            <?php echo esc_html(get_temperature_description($temp_max, 'max')); ?>
                                        </span>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <?php if ($temp_moy) : ?>
                                <div class="temperature-card temperature-card--<?php echo esc_attr(get_temperature_class($temp_moy)); ?>">
                                    <div class="temperature-card__header">
                                        <h3 class="temperature-card__title">Température moyenne</h3>
                                    </div>
                                    <div class="temperature-card__content">
                                        <span class="temperature-value"><?php echo esc_html($temp_moy); ?>°C</span>
                                        <span class="temperature-description">
                                            <?php echo esc_html(get_temperature_description($temp_moy, 'moy')); ?>
                                        </span>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    </section>
                <?php endif; ?>

                <!-- Section du niveau d'appréciation -->
                <?php if ($note_general) : ?>
                    <section class="destination-appreciation">
                        <h2 class="destination-section-title">
                            <span class="section-icon">⭐</span>
                            Niveau d'appréciation
                        </h2>

                        <div class="appreciation-card">
                            <div class="appreciation-rating">
                                <span class="rating-value"><?php echo esc_html($note_general); ?></span>
                                <span class="rating-scale">/5</span>
                            </div>

                            <div class="appreciation-stars">
                                <?php
                                $note = floatval($note_general);
                                $full_stars = floor($note);
                                $has_half_star = ($note - $full_stars) >= 0.5;

                                // Affichage des étoiles pleines
                                for ($i = 1; $i <= $full_stars; $i++) {
                                    echo '<span class="star star--full">★</span>';
                                }

                                // Affichage de l'étoile à moitié si nécessaire
                                if ($has_half_star) {
                                    echo '<span class="star star--half">☆</span>';
                                    $full_stars++;
                                }

                                // Affichage des étoiles vides
                                for ($i = $full_stars + 1; $i <= 5; $i++) {
                                    echo '<span class="star star--empty">☆</span>';
                                }
                                ?>
                            </div>

                            <div class="appreciation-description">
                                <?php
                                if ($note >= 4.5) {
                                    echo "Destination exceptionnelle - Un voyage inoubliable vous attend !";
                                } elseif ($note >= 4.0) {
                                    echo "Très bonne destination - Fortement recommandée pour vos vacances.";
                                } elseif ($note >= 3.5) {
                                    echo "Bonne destination - Une expérience agréable à vivre.";
                                } elseif ($note >= 3.0) {
                                    echo "Destination correcte - Quelques points d'intérêt intéressants.";
                                } elseif ($note >= 2.0) {
                                    echo "Destination moyenne - À considérer selon vos préférences.";
                                } else {
                                    echo "Destination à améliorer - Potentiel à développer.";
                                }
                                ?>
                            </div>
                        </div>
                    </section>
                <?php endif; ?>

                <!-- Navigation entre les articles (optionnel) -->
                <nav class="destination-navigation">
                    <div class="nav-links">
                        <?php
                        $prev_post = get_previous_post();
                        $next_post = get_next_post();
                        ?>

                        <?php if ($prev_post) : ?>
                            <div class="nav-link nav-link--prev">
                                <a href="<?php echo get_permalink($prev_post); ?>" class="nav-link__anchor">
                                    <span class="nav-link__direction">← Destination précédente</span>
                                    <span class="nav-link__title"><?php echo get_the_title($prev_post); ?></span>
                                </a>
                            </div>
                        <?php endif; ?>

                        <?php if ($next_post) : ?>
                            <div class="nav-link nav-link--next">
                                <a href="<?php echo get_permalink($next_post); ?>" class="nav-link__anchor">
                                    <span class="nav-link__direction">Destination suivante →</span>
                                    <span class="nav-link__title"><?php echo get_the_title($next_post); ?></span>
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>
                </nav>

            </article>

        <?php endwhile; ?>
    <?php else : ?>
        <div class="no-content">
            <h2>Destination non trouvée</h2>
            <p>Désolé, cette destination n'existe pas ou n'est plus disponible.</p>
            <a href="<?php echo home_url(); ?>" class="btn btn--primary">Retour à l'accueil</a>
        </div>
    <?php endif; ?>
</main>

<?php get_footer(); ?>