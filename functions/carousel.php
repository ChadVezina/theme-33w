<?php
function carousel_customize_register($wp_customize)
{
    // Section pour le carrousel
    $wp_customize->add_section('hero_carousel', [
        'title'    => __('Hero Carousel', 'mytheme'),
        'priority' => 30,
    ]);
    // Nombre d'images
    $wp_customize->add_setting('hero_carousel_count', [
        'default' => 3,
        'sanitize_callback' => 'absint',
    ]);
    $wp_customize->add_control('hero_carousel_count', [
        'label'   => __('Nombre de slides', 'mytheme'),
        'section' => 'hero_carousel',
        'type'    => 'number',
        'input_attrs' => [
            'min'  => 1,
            'max'  => 10,
            'step' => 1,
        ],
    ]);

    // Boucle pour ajouter des contrôles d'image pour chaque slide
    $count = get_theme_mod('hero_carousel_count', 3);
    for ($i = 1; $i <= $count; $i++) {
        $id = "hero_slide_$i";
        $wp_customize->add_setting($id, [
            'default'           => '',
            'transport'         => 'refresh',
            'sanitize_callback' => 'esc_url_raw',
        ]);
        $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, $id, [
            'label'    => sprintf(__('Image du slide %d', 'mytheme'), $i),
            'section'  => 'hero_carousel',
            'settings' => $id,
        ]));
    }
}
add_action('customize_register', 'carousel_customize_register');
