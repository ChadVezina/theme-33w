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
    // Hero Buttons
    $wp_customize->add_setting('hero_btn1_text', array(
        'default' => 'Découvrir nos destinations',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('hero_btn1_text', array(
        'label' => __('Button 1 Text', '33w-ete-25'),
        'section' => 'hero_content_section',
        'type' => 'text',
    ));
    $wp_customize->add_setting('hero_btn1_url', array(
        'default' => get_category_link(get_category_by_slug('populaire')->term_id),
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control('hero_btn1_url', array(
        'label' => __('Button 1 URL', '33w-ete-25'),
        'section' => 'hero_content_section',
        'type' => 'url',
    ));
    $wp_customize->add_setting('hero_btn2_text', array(
        'default' => 'Nous rejoindre',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('hero_btn2_text', array(
        'label' => __('Button 2 Text', '33w-ete-25'),
        'section' => 'hero_content_section',
        'type' => 'text',
    ));
    $wp_customize->add_setting('hero_btn2_url', array(
        'default' => '#contact',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control('hero_btn2_url', array(
        'label' => __('Button 2 URL', '33w-ete-25'),
        'section' => 'hero_content_section',
        'type' => 'url',
    ));
    // Hero Button Customization
    $wp_customize->add_setting('hero_btn1_bg_color', [
        'default' => '#ff6600',
        'sanitize_callback' => 'sanitize_hex_color',
    ]);
    $wp_customize->add_control(new WP_Customize_Color_Control(
        $wp_customize,
        'hero_btn1_bg_color',
        [
            'label' => __('Button 1 Background Color', '33w-ete-25'),
            'section' => 'hero_content_section',
            'settings' => 'hero_btn1_bg_color',
        ]
    ));
    $wp_customize->add_setting('hero_btn1_text_color', [
        'default' => '#ffffff',
        'sanitize_callback' => 'sanitize_hex_color',
    ]);
    $wp_customize->add_control(new WP_Customize_Color_Control(
        $wp_customize,
        'hero_btn1_text_color',
        [
            'label' => __('Button 1 Text Color', '33w-ete-25'),
            'section' => 'hero_content_section',
            'settings' => 'hero_btn1_text_color',
        ]
    ));
    $wp_customize->add_setting('hero_btn2_bg_color', [
        'default' => '#ffffff',
        'sanitize_callback' => 'sanitize_hex_color',
    ]);
    $wp_customize->add_control(new WP_Customize_Color_Control(
        $wp_customize,
        'hero_btn2_bg_color',
        [
            'label' => __('Button 2 Background Color', '33w-ete-25'),
            'section' => 'hero_content_section',
            'settings' => 'hero_btn2_bg_color',
        ]
    ));
    $wp_customize->add_setting('hero_btn2_text_color', [
        'default' => '#000000',
        'sanitize_callback' => 'sanitize_hex_color',
    ]);
    $wp_customize->add_control(new WP_Customize_Color_Control(
        $wp_customize,
        'hero_btn2_text_color',
        [
            'label' => __('Button 2 Text Color', '33w-ete-25'),
            'section' => 'hero_content_section',
            'settings' => 'hero_btn2_text_color',
        ]
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
    // Per-element animations
    $elements = array(
        'hero_title_animation'       => __('Title Animation', '33w-ete-25'),
        'hero_description_animation' => __('Description Animation', '33w-ete-25'),
        'hero_btn1_animation'        => __('Button 1 Animation', '33w-ete-25'),
        'hero_btn2_animation'        => __('Button 2 Animation', '33w-ete-25'),
    );
    foreach ($elements as $key => $label) {
        $wp_customize->add_setting($key, array(
            'default'           => 'none',
            'sanitize_callback' => 'sanitize_text_field',
        ));
        $wp_customize->add_control($key, array(
            'label'   => $label,
            'section' => 'hero_animation_section',
            'type'    => 'select',
            'choices' => array(
                'none'    => __('None', '33w-ete-25'),
                'fade-in' => __('Fade In', '33w-ete-25'),
                'slide-up' => __('Slide Up', '33w-ete-25'),
            ),
        ));
    }
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
    // Hero main content
    $title       = get_theme_mod('hero_title', 'Club de Voyage Aventure');
    $description = get_theme_mod('hero_description', 'Découvrez des destinations extraordinaires avec notre club de voyage passionné.');
    $bg          = get_theme_mod('hero_bg_image');
    $text_color  = get_theme_mod('hero_text_color');
    // Hero button texts, URLs, colors and opacity
    $btn1_text       = get_theme_mod('hero_btn1_text', 'Découvrir nos destinations');
    $btn1_url        = get_theme_mod('hero_btn1_url');
    $btn1_bg_color   = get_theme_mod('hero_btn1_bg_color', '#ff6600');
    $btn1_text_color = get_theme_mod('hero_btn1_text_color', '#ffffff');
    $btn1_opacity    = get_theme_mod('hero_btn1_bg_opacity', 1);
    $btn2_text       = get_theme_mod('hero_btn2_text', 'Nous rejoindre');
    $btn2_url        = get_theme_mod('hero_btn2_url', '#contact');
    $btn2_bg_color   = get_theme_mod('hero_btn2_bg_color', '#ffffff');
    $btn2_text_color = get_theme_mod('hero_btn2_text_color', '#000000');
    $btn2_opacity    = get_theme_mod('hero_btn2_bg_opacity', 1);
    // Per-element animations
    $title_anim      = get_theme_mod('hero_title_animation', 'none');
    $desc_anim       = get_theme_mod('hero_description_animation', 'none');
    $btn1_anim       = get_theme_mod('hero_btn1_animation', 'none');
    $btn2_anim       = get_theme_mod('hero_btn2_animation', 'none');
?>
    <section class="hero" style="background-image: url('<?php echo esc_url($bg); ?>');">
        <div class="hero__overlay"></div>
        <div class="hero__contenu" style="color: <?php echo esc_attr($text_color); ?>;">
            <h1 class="hero__titre<?php echo $title_anim !== 'none' ? ' hero__titre--'.esc_attr($title_anim) : ''; ?>"><?php echo esc_html($title); ?></h1>
            <p class="hero__description<?php echo $desc_anim !== 'none' ? ' hero__description--'.esc_attr($desc_anim) : ''; ?>"><?php echo esc_html($description); ?></p>
            <div class="hero__actions">
                <?php $category = get_category_by_slug('populaire'); ?>
                <?php $url1 = !empty($btn1_url) ? esc_url($btn1_url) : esc_url(get_category_link($category->term_id)); ?>
                <a href="<?php echo $url1; ?>" class="btn btn--primary<?php echo $btn1_anim !== 'none' ? ' btn--primary--'.esc_attr($btn1_anim) : ''; ?>" style="background-color: <?php echo esc_attr($btn1_bg_color); ?>; color: <?php echo esc_attr($btn1_text_color); ?>;">
                    <?php echo esc_html($btn1_text); ?>
                </a>
                <a href="<?php echo esc_url($btn2_url); ?>" class="btn btn--secondary<?php echo $btn2_anim !== 'none' ? ' btn--secondary--'.esc_attr($btn2_anim) : ''; ?>" style="background-color: <?php echo esc_attr($btn2_bg_color); ?>; color: <?php echo esc_attr($btn2_text_color); ?>;">
                    <?php echo esc_html($btn2_text); ?>
                </a>
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
    $email   = get_theme_mod('footer_email', 'info@clubvoyage.com');
    $phone   = get_theme_mod('footer_phone', '(555) 123-4567');
    $address = get_theme_mod('footer_address', '123 Rue du Voyage, Montréal, QC');
?>
    <div class="piedpage__contenu" id="contact">
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
