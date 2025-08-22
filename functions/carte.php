<?php

/**
 * Fonction carte pour afficher les cartes de la section "Populaire"
 * Répond aux exigences :
 * - Contient une liste de liens catégories
 * - Cette liste ne doit pas inclure la catégorie passée en paramètre
 * - Transition pour améliorer la visibilité
 * - Générée par une fonction au lieu d'un get_template_part()
 * - Utilisée dans front-page.php et category.php
 */

/**
 * Fonction carte($cat_a_retirer)
 * @param string $cat_a_retirer - Le slug de la catégorie à retirer de la liste
 * @return void - Affiche directement le HTML des cartes
 */
function carte($cat_a_retirer = '')
{
    // Récupération de toutes les catégories sauf celle à retirer
    $args = array(
        'taxonomy'   => 'category',
        'hide_empty' => true,
        'exclude'    => array(), // Sera rempli dynamiquement
    );

    // Si une catégorie à retirer est spécifiée, on l'exclut
    if (!empty($cat_a_retirer)) {
        $category_to_exclude = get_category_by_slug($cat_a_retirer);
        if ($category_to_exclude) {
            $args['exclude'] = array($category_to_exclude->term_id);
        }
    }

    $categories = get_categories($args);

    if (empty($categories)) {
        return;
    }

    echo '<div class="cartes-categories">';

    foreach ($categories as $category) {
        // Récupération du premier article de la catégorie pour l'image
        $posts_args = array(
            'category_name'  => $category->slug,
            'posts_per_page' => 1,
            'post_status'    => 'publish',
            'meta_query'     => array(
                array(
                    'key'     => '_thumbnail_id',
                    'compare' => 'EXISTS'
                )
            )
        );

        $category_posts = get_posts($posts_args);
        $image_url = '';

        if (!empty($category_posts)) {
            $image_url = get_the_post_thumbnail_url($category_posts[0]->ID, 'medium');
        }

        // Si pas d'image, utiliser une image par défaut
        if (empty($image_url)) {
            $image_url = get_template_directory_uri() . '/assets/images/default-card.jpg';
        }

        // Génération de la carte
?>
        <article class="carte-categorie" data-category="<?php echo esc_attr($category->slug); ?>">
            <a href="<?php echo esc_url(get_category_link($category->term_id)); ?>" class="carte-categorie__lien">

                <div class="carte-categorie__image">
                    <img src="<?php echo esc_url($image_url); ?>"
                        alt="<?php echo esc_attr($category->name); ?>"
                        class="carte-categorie__img">
                    <div class="carte-categorie__overlay"></div>
                </div>

                <div class="carte-categorie__contenu">
                    <h3 class="carte-categorie__titre"><?php echo esc_html($category->name); ?></h3>

                    <?php if (!empty($category->description)): ?>
                        <p class="carte-categorie__description">
                            <?php echo esc_html(wp_trim_words($category->description, 15)); ?>
                        </p>
                    <?php endif; ?>

                    <div class="carte-categorie__meta">
                        <span class="carte-categorie__count">
                            <?php
                            printf(
                                _n('%d article', '%d articles', $category->count, 'mytheme'),
                                $category->count
                            );
                            ?>
                        </span>
                    </div>
                </div>

                <div class="carte-categorie__cta">
                    <span class="carte-categorie__bouton">
                        <?php _e('Découvrir', 'mytheme'); ?>
                        <svg class="carte-categorie__icon" width="16" height="16" viewBox="0 0 16 16">
                            <path d="M8 0l8 8-8 8-1.5-1.5L12 9H0V7h12L6.5 1.5z" />
                        </svg>
                    </span>
                </div>

            </a>
        </article>
<?php
    }

    echo '</div>';
}

/**
 * Fonction utilitaire pour obtenir les métadonnées d'une catégorie
 * Peut être utilisée pour enrichir l'affichage des cartes
 */
function get_category_metadata($category_id)
{
    $metadata = array();

    // Si ACF est installé, récupérer les champs personnalisés
    if (function_exists('get_field')) {
        $metadata['couleur'] = get_field('couleur_categorie', 'category_' . $category_id);
        $metadata['icone'] = get_field('icone_categorie', 'category_' . $category_id);
        $metadata['image_hero'] = get_field('image_hero_categorie', 'category_' . $category_id);
    }

    return $metadata;
}
