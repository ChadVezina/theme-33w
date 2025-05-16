<?php

function enregistrer_theme_menus(){
    register_nav_menus(array(
        'menu-principal' => __('Menu Principal', 'mon_theme'),
        'menu-footer' => __('Menu Footer', 'mon_theme')
    ));
}
add_action('init', 'enregistrer_theme_menus');

function ajouter_classes_menu($classes, $item, $args)
{
    if (isset($args->add_li_class)) {
        $classes[] = $args->add_li_class;
    }
    return $classes;
}
add_filter('nav_menu_css_class', 'ajouter_classes_menu', 10, 3);

function mon_theme_supports()
{
    add_theme_support('post-thumbnails');
    set_post_thumbnail_size(600, 400, true);
    add_image_size('image-article', 600, 400, true);
    add_theme_support('title-tag');
    add_theme_support('menus');
    add_theme_support('custom-logo', array(
        'height'      => 100,
        'width'       => 400,
        'flex-height' => true,
        'flex-width'  => true,
    ));
}
add_action('after_setup_theme', 'mon_theme_supports');

function theme_tp_enqueue_styles()
{
    wp_enqueue_style('normalize', get_template_directory_uri() . 'normalize.css');
    wp_enqueue_style('main-style', get_stylesheet_uri());
}
add_action('wp_enqueue_scripts', 'theme_tp_enqueue_styles');
