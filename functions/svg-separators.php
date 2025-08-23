<?php

/**
 * Functions for generating animated SVG separators
 */

/**
 * Generate animated wave SVG separator
 * 
 * @param array $args Configuration array with the following options:
 *   - 'color' (string): Primary color of the wave (default: '#20b2aa')
 *   - 'secondary_color' (string): Secondary color for gradient (default: '#40e0d0')
 *   - 'height' (int): Height of the SVG in pixels (default: 100)
 *   - 'width' (string): Width of the SVG, can be '100%' or px value (default: '100%')
 *   - 'position' (string): 'top' or 'bottom' for wave direction (default: 'bottom')
 *   - 'animation' (bool): Enable wave animation (default: true)
 *   - 'animation_duration' (int): Duration of animation in seconds (default: 8)
 *   - 'wave_type' (string): 'single', 'double', 'triple' (default: 'double')
 *   - 'amplitude' (int): Wave amplitude/intensity (default: 40)
 *   - 'frequency' (float): Wave frequency (default: 1.5)
 *   - 'opacity' (float): Wave opacity (default: 1.0)
 *   - 'gradient' (bool): Use gradient colors (default: true)
 * 
 * @return string SVG HTML
 */
function render_animated_wave_separator($args = array())
{
    // Default configuration
    $defaults = array(
        'color' => '#20b2aa',
        'secondary_color' => '#40e0d0',
        'height' => 100,
        'width' => '100%',
        'position' => 'bottom',
        'animation' => true,
        'animation_duration' => 8,
        'wave_type' => 'triple', // Changed to triple for more waves
        'amplitude' => 40,
        'frequency' => 1.5,
        'opacity' => 1.0,
        'gradient' => true,
        'wave_count' => 3 // Number of layered waves
    );

    // Merge user args with defaults
    $config = wp_parse_args($args, $defaults);

    // Generate unique IDs for SVG elements
    $svg_id = 'wave-' . uniqid();
    $gradient_id = 'gradient-' . uniqid();

    // Start building SVG container with multiple layered waves
    $svg = '<div class="wave-separator wave-separator--' . esc_attr($config['position']) . '" style="position: relative; height: ' . esc_attr($config['height']) . 'px;">';

    // Create multiple wave layers
    for ($layer = 0; $layer < $config['wave_count']; $layer++) {
        $layer_opacity = $config['opacity'] * (1 - ($layer * 0.25)); // Decreasing opacity for each layer
        $layer_delay = $layer * 2; // Stagger animation delays
        $layer_speed = $config['animation_duration'] + ($layer * 1.5); // Slightly different speeds
        $layer_amplitude = $config['amplitude'] * (1 - ($layer * 0.15)); // Slightly different amplitudes
        $layer_offset = $layer * 150; // Horizontal offset for wave variation

        $svg .= '<svg class="wave-svg wave-layer-' . $layer . '" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%;" width="' . esc_attr($config['width']) . '" height="' . esc_attr($config['height']) . '" viewBox="0 0 1200 ' . esc_attr($config['height']) . '" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">';

        // Add gradient definition for this layer
        if ($config['gradient']) {
            $layer_gradient_id = $gradient_id . '-layer-' . $layer;
            $svg .= '<defs>';
            $svg .= '<linearGradient id="' . $layer_gradient_id . '" x1="0%" y1="0%" x2="100%" y2="0%">';
            $svg .= '<stop offset="0%" style="stop-color:' . esc_attr($config['color']) . ';stop-opacity:' . esc_attr($layer_opacity) . '" />';
            $svg .= '<stop offset="50%" style="stop-color:' . esc_attr($config['secondary_color']) . ';stop-opacity:' . esc_attr($layer_opacity) . '" />';
            $svg .= '<stop offset="100%" style="stop-color:' . esc_attr($config['color']) . ';stop-opacity:' . esc_attr($layer_opacity) . '" />';
            $svg .= '</linearGradient>';
            $svg .= '</defs>';
        }

        // Generate wave path for this layer
        $wave_path = generate_layered_wave_path($config, $layer, $layer_amplitude, $layer_offset);

        $fill_color = $config['gradient'] ? 'url(#' . $layer_gradient_id . ')' : $config['color'];

        $svg .= '<path d="' . esc_attr($wave_path) . '" fill="' . esc_attr($fill_color) . '" fill-opacity="' . esc_attr($layer_opacity) . '"';

        // Add animation if enabled
        if ($config['animation']) {
            $animation_id = 'waveAnimation-' . $svg_id . '-layer-' . $layer;
            $svg .= ' class="wave-path wave-path--animated wave-layer-' . $layer . '"';
            $svg .= ' style="animation: ' . $animation_id . ' ' . esc_attr($layer_speed) . 's ease-in-out infinite alternate; animation-delay: ' . esc_attr($layer_delay) . 's;"';

            // Add keyframes for this specific layer
            $svg .= '>';
            $svg .= '<animate attributeName="d" dur="' . $layer_speed . 's" repeatCount="indefinite" values="' .
                generate_wave_keyframes($config, $layer, $layer_amplitude, $layer_offset) . '" />';
            $svg .= '</path>';
        } else {
            $svg .= '/>';
        }

        $svg .= '</svg>';
    }

    $svg .= '</div>';

    // Add CSS for animations if not already added
    if ($config['animation']) {
        add_action('wp_footer', 'add_layered_wave_animation_css');
    }

    return $svg;
}

/**
 * Generate wave paths based on configuration
 * 
 * @param array $config Wave configuration
 * @return array Array of SVG path strings
 */
function generate_wave_paths($config)
{
    $paths = array();
    $width = 1200; // Base SVG width
    $height = $config['height'];
    $amplitude = $config['amplitude'];
    $frequency = $config['frequency'];

    // Number of waves based on wave_type
    $wave_count = 1;
    switch ($config['wave_type']) {
        case 'double':
            $wave_count = 2;
            break;
        case 'triple':
            $wave_count = 3;
            break;
    }

    for ($i = 0; $i < $wave_count; $i++) {
        $vertical_offset = ($i * 15); // Offset each wave vertically
        $phase_shift = ($i * 60); // Phase shift for wave variety

        if ($config['position'] === 'top') {
            // Wave from top
            $path = "M0,0 ";
            for ($x = 0; $x <= $width; $x += 10) {
                $y = $amplitude * sin(($x * $frequency * M_PI / 180) + $phase_shift) + $amplitude + $vertical_offset;
                $path .= "L$x,$y ";
            }
            $path .= "L$width,0 Z";
        } else {
            // Wave from bottom (default)
            $baseline = $height - $amplitude - $vertical_offset;
            $path = "M0,$height ";
            for ($x = 0; $x <= $width; $x += 10) {
                $y = $baseline + $amplitude * sin(($x * $frequency * M_PI / 180) + $phase_shift);
                $path .= "L$x,$y ";
            }
            $path .= "L$width,$height Z";
        }

        $paths[] = $path;
    }

    return $paths;
}

/**
 * Add CSS for wave animations to footer
 */
function add_wave_animation_css()
{
    static $css_added = false;

    if (!$css_added) {
        echo '<style>
        .wave-separator {
            position: relative;
            width: 100%;
            overflow: hidden;
            line-height: 0;
        }
        
        .wave-separator--top {
            transform: rotate(180deg);
        }
        
        .wave-svg {
            display: block;
            width: 100%;
            height: auto;
        }
        
        @keyframes waveAnimation {
            0% {
                transform: translateX(-10px) scaleY(1);
            }
            50% {
                transform: translateX(10px) scaleY(1.1);
            }
            100% {
                transform: translateX(-5px) scaleY(0.9);
            }
        }
        
        .wave-path--animated {
            transform-origin: center;
        }
        
        /* Responsive adjustments */
        @media (max-width: 768px) {
            .wave-separator {
                height: auto;
            }
            
            .wave-svg {
                height: 60px;
            }
        }
        </style>';
        $css_added = true;
    }
}

/**
 * Generate wave path for layered waves
 * 
 * @param array $config Wave configuration
 * @param int $layer Layer index
 * @param float $amplitude Layer amplitude
 * @param float $offset Horizontal offset
 * @return string SVG path string
 */
function generate_layered_wave_path($config, $layer, $amplitude, $offset)
{
    $width = 1200; // Base SVG width
    $height = $config['height'];
    $frequency = $config['frequency'] + ($layer * 0.2); // Slightly different frequencies

    if ($config['position'] === 'top') {
        // Wave from top
        $path = "M0,0 ";
        for ($x = 0; $x <= $width; $x += 15) {
            $wave_x = $x + $offset;
            $y = $amplitude * sin(($wave_x * $frequency * M_PI / 180)) + $amplitude;
            $path .= "L$x,$y ";
        }
        $path .= "L$width,0 Z";
    } else {
        // Wave from bottom (default)
        $baseline = $height - $amplitude;
        $path = "M0,$height ";
        for ($x = 0; $x <= $width; $x += 15) {
            $wave_x = $x + $offset;
            $y = $baseline + $amplitude * sin(($wave_x * $frequency * M_PI / 180));
            $path .= "L$x,$y ";
        }
        $path .= "L$width,$height Z";
    }

    return $path;
}

/**
 * Generate animation keyframes for wave layers
 * 
 * @param array $config Wave configuration
 * @param int $layer Layer index
 * @param float $amplitude Layer amplitude
 * @param float $offset Horizontal offset
 * @return string Animation keyframes
 */
function generate_wave_keyframes($config, $layer, $amplitude, $offset)
{
    $frames = array();
    $width = 1200;
    $height = $config['height'];
    $frequency = $config['frequency'] + ($layer * 0.2);

    // Generate 5 keyframes for smooth animation
    for ($frame = 0; $frame < 5; $frame++) {
        $phase = ($frame / 4) * 2 * M_PI; // Full cycle

        if ($config['position'] === 'top') {
            $path = "M0,0 ";
            for ($x = 0; $x <= $width; $x += 20) {
                $wave_x = $x + $offset;
                $y = $amplitude * sin(($wave_x * $frequency * M_PI / 180) + $phase) + $amplitude;
                $path .= "L$x,$y ";
            }
            $path .= "L$width,0 Z";
        } else {
            $baseline = $height - $amplitude;
            $path = "M0,$height ";
            for ($x = 0; $x <= $width; $x += 20) {
                $wave_x = $x + $offset;
                $y = $baseline + $amplitude * sin(($wave_x * $frequency * M_PI / 180) + $phase);
                $path .= "L$x,$y ";
            }
            $path .= "L$width,$height Z";
        }

        $frames[] = $path;
    }

    return implode(';', $frames);
}

/**
 * Add CSS for layered wave animations to footer
 */
function add_layered_wave_animation_css()
{
    static $css_added = false;

    if (!$css_added) {
        echo '<style>
        .wave-separator {
            position: relative;
            width: 100%;
            overflow: hidden;
            line-height: 0;
        }
        
        .wave-separator--top {
            transform: rotate(180deg);
        }
        
        .wave-svg {
            display: block;
            width: 100%;
            height: auto;
        }
        
        .wave-layer-0 { z-index: 3; }
        .wave-layer-1 { z-index: 2; }
        .wave-layer-2 { z-index: 1; }
        
        /* Enhanced wave animations for layered effect */
        @keyframes waveAnimation {
            0% { transform: translateX(-15px) scaleY(1); }
            25% { transform: translateX(5px) scaleY(1.05); }
            50% { transform: translateX(15px) scaleY(1.1); }
            75% { transform: translateX(-5px) scaleY(1.05); }
            100% { transform: translateX(-15px) scaleY(1); }
        }
        
        .wave-path--animated {
            transform-origin: center bottom;
        }
        
        /* Individual layer animations with different speeds */
        .wave-layer-0 .wave-path--animated {
            animation-duration: 8s;
        }
        
        .wave-layer-1 .wave-path--animated {
            animation-duration: 10s;
            animation-delay: 1s;
        }
        
        .wave-layer-2 .wave-path--animated {
            animation-duration: 12s;
            animation-delay: 2s;
        }
        
        /* Responsive adjustments */
        @media (max-width: 768px) {
            .wave-separator {
                height: auto;
            }
            
            .wave-svg {
                height: 60px;
            }
        }
        </style>';
        $css_added = true;
    }
}

/**
 * Render geometric separator (alternative to waves)
 * 
 * @param array $args Configuration array
 * @return string SVG HTML
 */
function render_geometric_separator($args = array())
{
    $defaults = array(
        'color' => '#20b2aa',
        'secondary_color' => '#40e0d0',
        'height' => 80,
        'width' => '100%',
        'pattern' => 'triangles', // 'triangles', 'diamonds', 'zigzag'
        'animation' => true,
        'animation_duration' => 6,
        'opacity' => 1.0
    );

    $config = wp_parse_args($args, $defaults);
    $svg_id = 'geo-' . uniqid();

    $svg = '<div class="geometric-separator">';
    $svg .= '<svg width="' . esc_attr($config['width']) . '" height="' . esc_attr($config['height']) . '" viewBox="0 0 1200 ' . esc_attr($config['height']) . '" xmlns="http://www.w3.org/2000/svg">';

    switch ($config['pattern']) {
        case 'triangles':
            $svg .= generate_triangle_pattern($config);
            break;
        case 'diamonds':
            $svg .= generate_diamond_pattern($config);
            break;
        case 'zigzag':
            $svg .= generate_zigzag_pattern($config);
            break;
    }

    $svg .= '</svg>';
    $svg .= '</div>';

    if ($config['animation']) {
        add_action('wp_footer', 'add_geometric_animation_css');
    }

    return $svg;
}

/**
 * Generate triangle pattern for geometric separator
 */
function generate_triangle_pattern($config)
{
    $pattern = '';
    $triangle_width = 60;
    $triangle_count = ceil(1200 / $triangle_width);

    for ($i = 0; $i < $triangle_count; $i++) {
        $x = $i * $triangle_width;
        $color = ($i % 2 === 0) ? $config['color'] : $config['secondary_color'];

        $pattern .= '<polygon points="' . $x . ',0 ' . ($x + $triangle_width / 2) . ',' . $config['height'] . ' ' . ($x + $triangle_width) . ',0" ';
        $pattern .= 'fill="' . esc_attr($color) . '" opacity="' . esc_attr($config['opacity']) . '"';

        if ($config['animation']) {
            $delay = $i * 0.1;
            $pattern .= ' class="geo-element" style="animation: geoFade ' . ($config['animation_duration'] + $delay) . 's ease-in-out infinite alternate;"';
        }

        $pattern .= '/>';
    }

    return $pattern;
}

/**
 * Generate diamond pattern for geometric separator
 */
function generate_diamond_pattern($config)
{
    $pattern = '';
    $diamond_width = 40;
    $diamond_count = ceil(1200 / $diamond_width);
    $mid_height = $config['height'] / 2;

    for ($i = 0; $i < $diamond_count; $i++) {
        $x = $i * $diamond_width + $diamond_width / 2;
        $color = ($i % 2 === 0) ? $config['color'] : $config['secondary_color'];

        $pattern .= '<polygon points="' . $x . ',0 ' . ($x + $diamond_width / 2) . ',' . $mid_height . ' ' . $x . ',' . $config['height'] . ' ' . ($x - $diamond_width / 2) . ',' . $mid_height . '" ';
        $pattern .= 'fill="' . esc_attr($color) . '" opacity="' . esc_attr($config['opacity']) . '"';

        if ($config['animation']) {
            $delay = $i * 0.15;
            $pattern .= ' class="geo-element" style="animation: geoRotate ' . ($config['animation_duration'] + $delay) . 's linear infinite;"';
        }

        $pattern .= '/>';
    }

    return $pattern;
}

/**
 * Generate zigzag pattern for geometric separator
 */
function generate_zigzag_pattern($config)
{
    $zigzag_width = 80;
    $zigzag_count = ceil(1200 / $zigzag_width);

    $path = 'M0,' . ($config['height'] / 2) . ' ';

    for ($i = 0; $i < $zigzag_count; $i++) {
        $x = $i * $zigzag_width;
        $y = ($i % 2 === 0) ? 0 : $config['height'];
        $path .= 'L' . ($x + $zigzag_width / 2) . ',' . $y . ' ';
        $path .= 'L' . ($x + $zigzag_width) . ',' . ($config['height'] / 2) . ' ';
    }

    $pattern = '<path d="' . $path . '" stroke="' . esc_attr($config['color']) . '" stroke-width="3" fill="none" opacity="' . esc_attr($config['opacity']) . '"';

    if ($config['animation']) {
        $pattern .= ' class="zigzag-path" style="animation: zigzagMove ' . $config['animation_duration'] . 's ease-in-out infinite alternate;"';
    }

    $pattern .= '/>';

    return $pattern;
}

/**
 * Add CSS for geometric animations
 */
function add_geometric_animation_css()
{
    static $geo_css_added = false;

    if (!$geo_css_added) {
        echo '<style>
        .geometric-separator {
            position: relative;
            width: 100%;
            overflow: hidden;
            line-height: 0;
        }
        
        @keyframes geoFade {
            0% { opacity: 0.3; transform: scaleY(0.8); }
            100% { opacity: 1; transform: scaleY(1.2); }
        }
        
        @keyframes geoRotate {
            0% { transform: rotate(0deg) scale(1); }
            100% { transform: rotate(360deg) scale(1.1); }
        }
        
        @keyframes zigzagMove {
            0% { stroke-dasharray: 0 100; }
            100% { stroke-dasharray: 100 0; }
        }
        
        .zigzag-path {
            stroke-dasharray: 50 50;
        }
        </style>';
        $geo_css_added = true;
    }
}

/**
 * Helper function to render section separator with preset configurations
 * 
 * @param string $type Type of separator: 'wave-soft', 'wave-strong', 'geo-triangles', 'geo-diamonds'
 * @param array $custom_args Custom arguments to override defaults
 * @return string SVG HTML
 */
function render_section_separator($type = 'wave-soft', $custom_args = array())
{
    // Get customizer settings with fallbacks
    $customizer_settings = array(
        'color' => get_theme_mod('svg_primary_color', '#20b2aa'),
        'secondary_color' => get_theme_mod('svg_secondary_color', '#40e0d0'),
        'height' => get_theme_mod('svg_wave_height', 100),
        'amplitude' => get_theme_mod('svg_wave_amplitude', 40),
        'animation' => get_theme_mod('svg_animation_enabled', true),
        'animation_duration' => get_theme_mod('svg_animation_speed', 8),
        'opacity' => get_theme_mod('svg_wave_opacity', 1.0),
        'wave_count' => get_theme_mod('svg_wave_count', 3),
        'gradient' => get_theme_mod('svg_gradient_enabled', true),
    );

    $presets = array(
        'wave-soft' => array_merge($customizer_settings, array(
            'wave_type' => 'triple',
            'frequency' => 1.2,
            'position' => 'bottom'
        )),
        'wave-strong' => array_merge($customizer_settings, array(
            'wave_type' => 'triple',
            'frequency' => 2.0,
            'position' => 'bottom'
        )),
        'geo-triangles' => array(
            'color' => get_theme_mod('svg_primary_color', '#20b2aa'),
            'secondary_color' => get_theme_mod('svg_secondary_color', '#40e0d0'),
            'height' => get_theme_mod('svg_wave_height', 60),
            'pattern' => 'triangles',
            'animation' => get_theme_mod('svg_animation_enabled', true),
            'animation_duration' => get_theme_mod('svg_animation_speed', 6),
            'opacity' => get_theme_mod('svg_wave_opacity', 1.0)
        ),
        'geo-diamonds' => array(
            'color' => get_theme_mod('svg_primary_color', '#20b2aa'),
            'secondary_color' => get_theme_mod('svg_secondary_color', '#40e0d0'),
            'height' => get_theme_mod('svg_wave_height', 80),
            'pattern' => 'diamonds',
            'animation' => get_theme_mod('svg_animation_enabled', true),
            'animation_duration' => get_theme_mod('svg_animation_speed', 8),
            'opacity' => get_theme_mod('svg_wave_opacity', 1.0)
        )
    );

    if (!isset($presets[$type])) {
        $type = 'wave-soft'; // Default fallback
    }

    $args = wp_parse_args($custom_args, $presets[$type]);

    if (strpos($type, 'wave-') === 0) {
        return render_animated_wave_separator($args);
    } else {
        return render_geometric_separator($args);
    }
}
