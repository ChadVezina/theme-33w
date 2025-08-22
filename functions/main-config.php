<?php
function mon_theme_supports()
{
    add_theme_support('post-thumbnails');
    add_theme_support('title-tag');
    add_theme_support('menus');
    add_theme_support('custom-logo', array(
        'height'      => 75,
        'width'       => 75,
        'flex-height' => true,
        'flex-width'  => true,
    ));
}
add_action('after_setup_theme', 'mon_theme_supports');



function theme_tp_enqueue_styles()
{
    wp_enqueue_style('normalize', get_template_directory_uri() . '/normalize.css');
    wp_enqueue_style('main-style', get_stylesheet_uri());
}
add_action('wp_enqueue_scripts', 'theme_tp_enqueue_styles');

/**
 * Enqueue JavaScript files
 */
function theme_tp_enqueue_scripts()
{
    // Enqueue carousel script
    wp_enqueue_script(
        'hero-carousel',
        get_template_directory_uri() . '/script/carousel.js',
        array(), // No dependencies
        '1.0.0',
        true // Load in footer
    );

    // Enqueue checkbox script
    wp_enqueue_script(
        'checkbox',
        get_template_directory_uri() . '/script/checkbox.js',
        array(),
        '1.0.0',
        true
    );

    // Note: hero.js is temporarily disabled to avoid conflicts with the new carousel system
    // If needed, it can be re-enabled after reviewing its compatibility
}
add_action('wp_enqueue_scripts', 'theme_tp_enqueue_scripts');


/**
 * Modifie la requete principale de WordPress avant qu'elle soit exécuté
 * le hook « pre_get_posts » se manifeste juste avant d'exécuter la requête principal
 * Dépendant de la condition initiale on peut filtrer un type particulier de requête
 * Dans ce cas ci nous filtrons la requête de la page d'accueil
 * @param WP_query  $query la requête principal de WP
 */
function modifie_requete_principal($query)
{
    // Seulement pour la vraie page d'accueil (pas les catégories)
    if (
        $query->is_home() && $query->is_main_query() && ! is_admin()
        && empty($query->query_vars['category_name'])
        && empty($query->query_vars['cat'])
        && empty($query->query_vars['pagename'])
    ) {
        $query->set('category_name', 'populaire');
        $query->set('orderby', 'title');
        $query->set('order', 'ASC');
    }
}
add_action('pre_get_posts', 'modifie_requete_principal');

/**
 * Force l'utilisation du template category.php pour les vraies pages de catégories
 */
function force_category_template($template)
{
    if (is_category()) {
        $category_template = locate_template('category.php');
        if ($category_template) {
            return $category_template;
        }
    }
    return $template;
}
add_filter('template_include', 'force_category_template');

/**
 * Corrige automatiquement les liens de catégories dans les menus
 * pour utiliser /category/slug au lieu de /slug
 */
function fix_category_links_in_menu($items, $args)
{
    // Seulement pour le menu principal
    if ($args->theme_location == 'principal') {
        foreach ($items as $item) {
            // Si c'est un lien vers une catégorie qui pourrait causer un conflit
            if (strpos($item->url, '/aventure/') !== false && strpos($item->url, '/category/') === false) {
                $item->url = str_replace('/aventure/', '/category/aventure/', $item->url);
            }
            if (strpos($item->url, '/croisiere/') !== false && strpos($item->url, '/category/') === false) {
                $item->url = str_replace('/croisiere/', '/category/croisiere/', $item->url);
            }
            if (strpos($item->url, '/culturel/') !== false && strpos($item->url, '/category/') === false) {
                $item->url = str_replace('/culturel/', '/category/culturel/', $item->url);
            }
            if (strpos($item->url, '/economique/') !== false && strpos($item->url, '/category/') === false) {
                $item->url = str_replace('/economique/', '/category/economique/', $item->url);
            }
            if (strpos($item->url, '/pleine-nature/') !== false && strpos($item->url, '/category/') === false) {
                $item->url = str_replace('/pleine-nature/', '/category/pleine-nature/', $item->url);
            }
            if (strpos($item->url, '/populaire/') !== false && strpos($item->url, '/category/') === false) {
                $item->url = str_replace('/populaire/', '/category/populaire/', $item->url);
            }
            if (strpos($item->url, '/repos/') !== false && strpos($item->url, '/category/') === false) {
                $item->url = str_replace('/repos/', '/category/repos/', $item->url);
            }
            if (strpos($item->url, '/sport/') !== false && strpos($item->url, '/category/') === false) {
                $item->url = str_replace('/sport/', '/category/sport/', $item->url);
            }
            if (strpos($item->url, '/zen/') !== false && strpos($item->url, '/category/') === false) {
                $item->url = str_replace('/zen/', '/category/zen/', $item->url);
            }
        }
    }
    return $items;
}
add_filter('wp_nav_menu_objects', 'fix_category_links_in_menu', 10, 2);

/**
 * Affichage du message d'inscription simple
 */
function afficher_message_inscription_simple()
{
    if (isset($_GET['inscription']) && $_GET['inscription'] == 'merci') {
        echo '<div class="message-succes" style="background: #28a745; color: white; padding: 1rem; text-align: center; margin: 1rem 0; border-radius: 5px;">
                <p>✅ Merci pour votre inscription !</p>
              </div>';
    }
}
add_action('wp_footer', 'afficher_message_inscription_simple');
