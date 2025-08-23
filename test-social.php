<?php
/*
Template Name: Test Social Icons
*/

get_header();
?>

<div style="padding: 20px; background: #f9f9f9; margin: 20px;">
    <h2>Test des Icônes Sociales</h2>
    
    <h3>1. Test de la fonction render_social_icons():</h3>
    <div style="background: white; padding: 15px; border: 1px solid #ddd;">
        <?php
        if (function_exists('render_social_icons')) {
            echo "✅ Fonction existe<br>";
            render_social_icons();
        } else {
            echo "❌ Fonction n'existe pas<br>";
        }
        ?>
    </div>
    
    <h3>2. Test des valeurs du customizer:</h3>
    <div style="background: white; padding: 15px; border: 1px solid #ddd;">
        <?php
        $networks = ['facebook', 'twitter', 'instagram', 'linkedin', 'youtube', 'github', 'email'];
        foreach ($networks as $network) {
            $url = get_theme_mod('social_' . $network, '');
            echo "<strong>$network:</strong> " . ($url ?: 'Vide') . "<br>";
        }
        ?>
    </div>
    
    <h3>3. Test avec valeurs par défaut manuelles:</h3>
    <div style="background: white; padding: 15px; border: 1px solid #ddd;">
        <?php
        $defaults = [
            'github' => 'https://github.com/ChadVezina/33w-ete25',
            'email' => 'mailto:info@clubvoyage.com'
        ];
        foreach ($defaults as $network => $default) {
            $url = get_theme_mod('social_' . $network, $default);
            echo "<strong>$network (avec défaut):</strong> $url<br>";
        }
        ?>
    </div>
</div>

<?php get_footer(); ?>
