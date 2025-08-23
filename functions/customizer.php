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

    // Footer Content Section
    $wp_customize->add_section('footer_section', array(
        'title' => __('Footer Content', '33w-ete-25'),
        'panel' => 'footer_panel',
        'priority' => 10,
    ));

    // Footer Social Icons Section
    $wp_customize->add_section('footer_social_section', array(
        'title' => __('Social Icons', '33w-ete-25'),
        'panel' => 'footer_panel',
        'priority' => 20,
    ));

    // Footer Destination Image Section
    $wp_customize->add_section('footer_destination_section', array(
        'title' => __('Destination Image', '33w-ete-25'),
        'panel' => 'footer_panel',
        'priority' => 30,
        'description' => __('Add a featured destination image to enhance your footer design', '33w-ete-25'),
    ));

    // Social Media Links
    $social_networks = array(
        'facebook' => array(
            'label' => 'Facebook',
            'default' => ''
        ),
        'twitter' => array(
            'label' => 'Twitter/X',
            'default' => ''
        ),
        'instagram' => array(
            'label' => 'Instagram',
            'default' => ''
        ),
        'linkedin' => array(
            'label' => 'LinkedIn',
            'default' => ''
        ),
        'youtube' => array(
            'label' => 'YouTube',
            'default' => ''
        ),
        'github' => array(
            'label' => 'GitHub',
            'default' => 'https://github.com/ChadVezina/33w-ete25'
        ),
        'email' => array(
            'label' => 'Email',
            'default' => 'mailto:info@clubvoyage.com'
        )
    );

    foreach ($social_networks as $network => $data) {
        $wp_customize->add_setting('social_' . $network, array(
            'default' => $data['default'],
            'sanitize_callback' => 'esc_url_raw',
        ));

        $wp_customize->add_control('social_' . $network, array(
            'label' => sprintf(__('%s URL', '33w-ete-25'), $data['label']),
            'section' => 'footer_social_section',
            'type' => 'url',
            'description' => sprintf(__('Enter the full URL for your %s profile', '33w-ete-25'), $data['label']),
        ));
    }

    // Footer Destination Image Settings
    $wp_customize->add_setting('footer_destination_image', array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
    ));

    $wp_customize->add_control(new WP_Customize_Image_Control(
        $wp_customize,
        'footer_destination_image',
        array(
            'label' => __('Destination Image', '33w-ete-25'),
            'section' => 'footer_destination_section',
            'settings' => 'footer_destination_image',
            'description' => __('Upload an image showcasing a beautiful destination', '33w-ete-25'),
        )
    ));

    $wp_customize->add_setting('footer_destination_title', array(
        'default' => 'Découvrez nos destinations',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('footer_destination_title', array(
        'label' => __('Destination Title', '33w-ete-25'),
        'section' => 'footer_destination_section',
        'type' => 'text',
        'description' => __('Title to display with the destination image', '33w-ete-25'),
    ));

    $wp_customize->add_setting('footer_destination_description', array(
        'default' => 'Explorez des lieux magiques avec notre club de voyage',
        'sanitize_callback' => 'sanitize_textarea_field',
    ));

    $wp_customize->add_control('footer_destination_description', array(
        'label' => __('Destination Description', '33w-ete-25'),
        'section' => 'footer_destination_section',
        'type' => 'textarea',
        'description' => __('Brief description of the destination or call to action', '33w-ete-25'),
    ));

    $wp_customize->add_setting('footer_destination_link', array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
    ));

    $wp_customize->add_control('footer_destination_link', array(
        'label' => __('Destination Link', '33w-ete-25'),
        'section' => 'footer_destination_section',
        'type' => 'url',
        'description' => __('Optional link when clicking on the destination image', '33w-ete-25'),
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
            <h1 class="hero__titre<?php echo $title_anim !== 'none' ? ' hero__titre--' . esc_attr($title_anim) : ''; ?>"><?php echo esc_html($title); ?></h1>
            <p class="hero__description<?php echo $desc_anim !== 'none' ? ' hero__description--' . esc_attr($desc_anim) : ''; ?>"><?php echo esc_html($description); ?></p>
            <div class="hero__actions">
                <?php $category = get_category_by_slug('populaire'); ?>
                <?php $url1 = !empty($btn1_url) ? esc_url($btn1_url) : esc_url(get_category_link($category->term_id)); ?>
                <a href="<?php echo $url1; ?>" class="btn btn--primary<?php echo $btn1_anim !== 'none' ? ' btn--primary--' . esc_attr($btn1_anim) : ''; ?>" style="background-color: <?php echo esc_attr($btn1_bg_color); ?>; color: <?php echo esc_attr($btn1_text_color); ?>;">
                    <?php echo esc_html($btn1_text); ?>
                </a>
                <a href="<?php echo esc_url($btn2_url); ?>" class="btn btn--secondary<?php echo $btn2_anim !== 'none' ? ' btn--secondary--' . esc_attr($btn2_anim) : ''; ?>" style="background-color: <?php echo esc_attr($btn2_bg_color); ?>; color: <?php echo esc_attr($btn2_text_color); ?>;">
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

    // Destination image settings
    $dest_image = get_theme_mod('footer_destination_image', '');
    $dest_title = get_theme_mod('footer_destination_title', 'Découvrez nos destinations');
    $dest_description = get_theme_mod('footer_destination_description', 'Explorez des lieux magiques avec notre club de voyage');
    $dest_link = get_theme_mod('footer_destination_link', '');
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

        <?php render_social_icons(); ?>

        <?php render_footer_destination(); ?>

        <div class="piedpage__copyright">
            <p>&copy; <?php echo date('Y'); ?> <a href="<?php echo home_url(); ?>"><?php bloginfo('name'); ?></a>. <?php _e('Tous droits réservés.', '33w-ete-25'); ?></p>
            <p><?php _e('Développé avec ❤️ par', '33w-ete-25'); ?> <a href="https://github.com/ChadVezina" target="_blank">Chad Vezina</a></p>
        </div>
    </div>
<?php
}

/**
 * Render Social Icons based on Customizer settings
 */
function render_social_icons()
{
    // Définition des réseaux sociaux disponibles avec leurs icônes SVG et valeurs par défaut
    $social_networks = array(
        'facebook' => array(
            'label' => 'Facebook',
            'default' => '',
            'icon' => '<svg viewBox="0 0 24 24" width="24" height="24"><path fill="currentColor" d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>'
        ),
        'twitter' => array(
            'label' => 'Twitter/X',
            'default' => '',
            'icon' => '<svg viewBox="0 0 24 24" width="24" height="24"><path fill="currentColor" d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>'
        ),
        'instagram' => array(
            'label' => 'Instagram',
            'default' => '',
            'icon' => '<svg viewBox="0 0 24 24" width="24" height="24"><path fill="currentColor" d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>'
        ),
        'linkedin' => array(
            'label' => 'LinkedIn',
            'default' => '',
            'icon' => '<svg viewBox="0 0 24 24" width="24" height="24"><path fill="currentColor" d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>'
        ),
        'youtube' => array(
            'label' => 'YouTube',
            'default' => '',
            'icon' => '<svg viewBox="0 0 24 24" width="24" height="24"><path fill="currentColor" d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>'
        ),
        'github' => array(
            'label' => 'GitHub',
            'default' => 'https://github.com/ChadVezina/33w-ete25',
            'icon' => '<svg viewBox="0 0 24 24" width="24" height="24"><path fill="currentColor" d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/></svg>'
        ),
        'email' => array(
            'label' => 'Email',
            'default' => 'mailto:info@clubvoyage.com',
            'icon' => '<svg viewBox="0 0 24 24" width="24" height="24"><path fill="currentColor" d="M24 5.457v13.909c0 .904-.732 1.636-1.636 1.636h-3.819V11.73L12 16.64l-6.545-4.91v9.273H1.636A1.636 1.636 0 0 1 0 19.366V5.457c0-.904.732-1.636 1.636-1.636h.749L12 10.724l9.615-6.903h.749c.904 0 1.636.732 1.636 1.636Z"/></svg>'
        )
    );

    // Récupérer les URLs configurées dans le customizer
    $social_links = array();
    foreach ($social_networks as $network => $data) {
        $url = get_theme_mod('social_' . $network, $data['default']);
        if (!empty($url)) {
            $social_links[$network] = array(
                'url' => $url,
                'label' => $data['label'],
                'icon' => $data['icon']
            );
        }
    }

    // Si aucun lien n'est configuré, ne rien afficher
    if (empty($social_links)) {
        return;
    }

    // Afficher les icônes sociales
?>
    <div class="piedpage__social">
        <p><strong><?php _e('Suivez-nous', '33w-ete-25'); ?></strong></p>
        <div class="social-icons">
            <?php foreach ($social_links as $network => $link): ?>
                <a href="<?php echo esc_url($link['url']); ?>"
                    class="social-icon social-icon--<?php echo esc_attr($network); ?>"
                    target="_blank"
                    rel="noopener noreferrer"
                    aria-label="<?php echo esc_attr($link['label']); ?>">
                    <?php echo $link['icon']; ?>
                </a>
            <?php endforeach; ?>
        </div>
    </div>
<?php
}

/**
 * Render Footer Destination Image based on Customizer settings
 */
function render_footer_destination()
{
    $dest_image = get_theme_mod('footer_destination_image', '');
    $dest_title = get_theme_mod('footer_destination_title', 'Découvrez nos destinations');
    $dest_description = get_theme_mod('footer_destination_description', 'Explorez des lieux magiques avec notre club de voyage');
    $dest_link = get_theme_mod('footer_destination_link', '');

    // Si aucune image n'est configurée, ne rien afficher
    if (empty($dest_image)) {
        return;
    }
?>
    <div class="piedpage__destination">
        <?php if (!empty($dest_link)): ?>
            <a href="<?php echo esc_url($dest_link); ?>" class="piedpage__destination-link" target="_blank" rel="noopener noreferrer">
            <?php endif; ?>

            <div class="piedpage__destination-image">
                <img src="<?php echo esc_url($dest_image); ?>" alt="<?php echo esc_attr($dest_title); ?>">
                <div class="piedpage__destination-overlay">
                    <div class="piedpage__destination-content">
                        <h3 class="piedpage__destination-title"><?php echo esc_html($dest_title); ?></h3>
                        <p class="piedpage__destination-description"><?php echo esc_html($dest_description); ?></p>
                    </div>
                </div>
            </div>

            <?php if (!empty($dest_link)): ?>
            </a>
        <?php endif; ?>
    </div>
<?php
}
