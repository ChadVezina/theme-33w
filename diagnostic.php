<?php
// Script de diagnostic - à supprimer après utilisation
get_header();

echo '<div style="background: yellow; padding: 20px; margin: 20px; border: 2px solid orange;">';
echo '<h2>🔧 DIAGNOSTIC - ICÔNES SOCIALES</h2>';

// 1. Vérifier que la fonction existe
echo '<h3>1. Fonction render_social_icons() existe:</h3>';
if (function_exists('render_social_icons')) {
    echo '✅ Fonction existe<br>';
} else {
    echo '❌ Fonction n\'existe pas<br>';
}

// 2. Vérifier les paramètres du customizer
echo '<h3>2. Paramètres du customizer:</h3>';
$social_networks = array('facebook', 'twitter', 'instagram', 'linkedin', 'youtube', 'github', 'email');
foreach ($social_networks as $network) {
    $url = get_theme_mod('social_' . $network, '');
    $status = !empty($url) ? '✅' : '❌';
    echo "{$status} {$network}: " . ($url ?: 'Non configuré') . '<br>';
}

// 3. Test de rendu de la fonction
echo '<h3>3. Test de rendu de la fonction:</h3>';
echo '<div style="background: white; padding: 10px; border: 1px solid #ccc;">';
if (function_exists('render_social_icons')) {
    render_social_icons();
} else {
    echo 'Fonction non disponible';
}
echo '</div>';

// 4. Vérifier si le CSS est chargé
echo '<h3>4. Vérification CSS:</h3>';
echo 'Style.css modifié: ' . date('Y-m-d H:i:s', filemtime(get_template_directory() . '/style.css')) . '<br>';

echo '</div>';

get_footer();
