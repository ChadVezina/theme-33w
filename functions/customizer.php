<?php

/**
 * Register Customizer settings for Hero and Footer sections
 */
function theme_customize_register($wp_customize)
{
    // Hero Panel
    $wp_customize->add_panel('hero_panel', array(
        'title' => __('Hero Section', '33w-ete-25'),
        'priority' => 10,
    ));
    // Hero Content Section
    $wp_customize->add_section('hero_content_section', array(
        'title' => __('Content', '33w-ete-25'),
        'panel' => 'hero_panel',
        'priority' => 10,
    ));
    // Title
    $wp_customize->add_setting('hero_title', array(
        'default' => 'Club de Voyage Aventure',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('hero_title', array(
        'label' => __('Hero Title', '33w-ete-25'),
        'section' => 'hero_content_section',
        'type' => 'text',
    ));
    // Description
    $wp_customize->add_setting('hero_description', array(
        'default' => 'Découvrez des destinations extraordinaires avec notre club de voyage passionné.',
        'sanitize_callback' => 'sanitize_textarea_field',
    ));
    $wp_customize->add_control('hero_description', array(
        'label' => __('Hero Description', '33w-ete-25'),
        'section' => 'hero_content_section',
        'type' => 'textarea',
    ));
    // Hero Design Section
    $wp_customize->add_section('hero_design_section', array(
        'title' => __('Design', '33w-ete-25'),
        'panel' => 'hero_panel',
        'priority' => 20,
    ));
    // Background Image
    $wp_customize->add_setting('hero_bg_image', array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control(new WP_Customize_Image_Control(
        $wp_customize,
        'hero_bg_image',
        array(
            'label' => __('Background Image', '33w-ete-25'),
            'section' => 'hero_design_section',
            'settings' => 'hero_bg_image',
        )
    ));
    // Text Color
    $wp_customize->add_setting('hero_text_color', array(
        'default' => '#ffffff',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control(
        $wp_customize,
        'hero_text_color',
        array(
            'label' => __('Text Color', '33w-ete-25'),
            'section' => 'hero_design_section',
            'settings' => 'hero_text_color',
        )
    ));
    // Hero Animation Section
    $wp_customize->add_section('hero_animation_section', array(
        'title' => __('Animation', '33w-ete-25'),
        'panel' => 'hero_panel',
        'priority' => 30,
    ));
    $wp_customize->add_setting('hero_animation', array(
        'default' => 'none',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('hero_animation', array(
        'label' => __('Animation Type', '33w-ete-25'),
        'section' => 'hero_animation_section',
        'type' => 'select',
        'choices' => array(
            'none'    => __('None', '33w-ete-25'),
            'fade-in' => __('Fade In', '33w-ete-25'),
            'slide-up' => __('Slide Up', '33w-ete-25'),
        ),
    ));
    // Footer Panel
    $wp_customize->add_panel('footer_panel', array(
        'title' => __('Footer Section', '33w-ete-25'),
        'priority' => 20,
    ));
    $wp_customize->add_section('footer_section', array(
        'title' => __('Footer Content', '33w-ete-25'),
        'panel' => 'footer_panel',
        'priority' => 10,
    ));
    $footer_defaults = array(
        'footer_email'   => 'info@clubvoyage.com',
        'footer_phone'   => '(555) 123-4567',
        'footer_address' => '123 Rue du Voyage, Montréal, QC',
    );
    foreach ($footer_defaults as $key => $default) {
        $wp_customize->add_setting($key, array(
            'default'           => $default,
            'sanitize_callback' => 'sanitize_text_field',
        ));
        $wp_customize->add_control($key, array(
            'label'   => ucfirst(str_replace('footer_', '', $key)),
            'section' => 'footer_section',
            'type'    => 'text',
        ));
    }
}
add_action('customize_register', 'theme_customize_register');

/**
 * Render Hero Section with Customizer settings
 */
function render_hero_section()
{
    $title       = get_theme_mod('hero_title');
    $description = get_theme_mod('hero_description');
    $bg          = get_theme_mod('hero_bg_image');
    $text_color  = get_theme_mod('hero_text_color');
    $animation   = get_theme_mod('hero_animation');
?>
    <section class="hero <?php echo esc_attr($animation); ?>" style="background-image: url('<?php echo esc_url($bg); ?>');">
        <div class="hero__contenu" style="color: <?php echo esc_attr($text_color); ?>;">
            <h1 class="hero__titre"><?php echo esc_html($title); ?></h1>
            <p class="hero__description"><?php echo esc_html($description); ?></p>
            <div class="hero__actions">
                <?php $category = get_category_by_slug('populaire'); ?>
                <a href="<?php echo esc_url(get_category_link($category->term_id)); ?>" class="btn btn--primary"><?php _e('Découvrir nos destinations', '33w-ete-25'); ?></a>
                <a href="#contact" class="btn btn--secondary"><?php _e('Nous rejoindre', '33w-ete-25'); ?></a>
            </div>
        </div>
    </section>
<?php
}

/**
 * Render Footer Content with Customizer settings
 */
function render_footer_content()
{
    $email   = get_theme_mod('footer_email');
    $phone   = get_theme_mod('footer_phone');
    $address = get_theme_mod('footer_address');
?>
    <div class="piedpage__contenu">
        <div class="piedpage__logo">
            <img src="<?php echo get_template_directory_uri(); ?>/images/logo.png" alt="<?php bloginfo('name'); ?>">
        </div>
        <div class="piedpage__contact">
            <p><strong><?php _e('Contact', '33w-ete-25'); ?></strong></p>
            <p>📧 <?php echo esc_html($email); ?></p>
            <p>📞 <?php echo esc_html($phone); ?></p>
            <p>📍 <?php echo esc_html($address); ?></p>
        </div>
        <div class="piedpage__copyright">
            <p>&copy; <?php echo date('Y'); ?> <a href="<?php echo home_url(); ?>"><?php bloginfo('name'); ?></a>. <?php _e('Tous droits réservés.', '33w-ete-25'); ?></p>
            <p><?php _e('Développé avec ❤️ par', '33w-ete-25'); ?> <a href="https://github.com/ChadVezina" target="_blank">Chad Vezina</a></p>
        </div>
    </div>
<?php
}
