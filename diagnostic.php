<?php
// Script de diagnostic - à supprimer après utilisation
get_header();

echo '<div style="background: yellow; padding: 20px; margin: 20px; border: 2px solid orange;">';
echo '<h2>🔧 DIAGNOSTIC COMPLET</h2>';

// 1. Vérifier les catégories existantes
echo '<h3>1. Catégories existantes:</h3>';
$categories = get_categories(array('hide_empty' => false));
foreach ($categories as $cat) {
    echo "- {$cat->name} (ID: {$cat->term_id}, Slug: {$cat->slug})<br>";
}

// 2. Vérifier les permaliens
echo '<h3>2. Structure des permaliens:</h3>';
echo 'Structure: ' . get_option('permalink_structure') . '<br>';
echo 'Base catégorie: ' . get_option('category_base') . '<br>';

// 3. Vérifier l'URL actuelle
echo '<h3>3. Informations URL actuelle:</h3>';
echo 'URL complète: ' . $_SERVER['REQUEST_URI'] . '<br>';
echo 'Query string: ' . $_SERVER['QUERY_STRING'] . '<br>';

// 4. Vérifier les rewrite rules
echo '<h3>4. WordPress Query Info:</h3>';
global $wp_query;
echo 'Query vars: ';
var_dump($wp_query->query_vars);

echo '<h3>5. Tests manuels:</h3>';
// Test avec différentes méthodes pour trouver la catégorie
echo 'get_category_by_slug("aventure"): ';
$cat_by_slug = get_category_by_slug('aventure');
var_dump($cat_by_slug);

echo '<br>get_queried_object(): ';
var_dump(get_queried_object());

echo '</div>';

get_footer();
