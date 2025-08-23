<?php

/**
 * REST API Configuration pour les filtres de destinations
 * Permet de créer une section filtre entièrement dynamique
 */

/**
 * Enregistre les routes REST API personnalisées
 */
function register_destinations_rest_routes()
{
    // Route pour récupérer les destinations par catégories
    register_rest_route('destinations/v1', '/categories', array(
        'methods' => 'GET',
        'callback' => 'get_destinations_by_categories',
        'permission_callback' => '__return_true',
    ));

    // Route pour récupérer les destinations filtrées
    register_rest_route('destinations/v1', '/filter', array(
        'methods' => 'GET',
        'callback' => 'get_filtered_destinations',
        'permission_callback' => '__return_true',
        'args' => array(
            'category' => array(
                'required' => false,
                'type' => 'string',
            ),
            'search' => array(
                'required' => false,
                'type' => 'string',
            ),
            'limit' => array(
                'required' => false,
                'type' => 'integer',
                'default' => 10,
            ),
        ),
    ));

    // Route pour récupérer les détails d'une destination
    register_rest_route('destinations/v1', '/destination/(?P<id>\d+)', array(
        'methods' => 'GET',
        'callback' => 'get_destination_details',
        'permission_callback' => '__return_true',
        'args' => array(
            'id' => array(
                'required' => true,
                'type' => 'integer',
            ),
        ),
    ));
}
add_action('rest_api_init', 'register_destinations_rest_routes');

/**
 * Callback pour récupérer les destinations organisées par catégories
 */
function get_destinations_by_categories($request)
{
    try {
        $categories = get_categories(array(
            'taxonomy' => 'category',
            'hide_empty' => true,
            'exclude' => array(1), // Exclure la catégorie "Uncategorized"
        ));

        $response_data = array();

        foreach ($categories as $category) {
            $posts = get_posts(array(
                'category' => $category->term_id,
                'numberposts' => -1,
                'post_status' => 'publish',
            ));

            $destinations = array();
            foreach ($posts as $post) {
                $destinations[] = format_destination_data($post);
            }

            $response_data[] = array(
                'category_id' => $category->term_id,
                'category_name' => $category->name,
                'category_slug' => $category->slug,
                'category_description' => $category->description,
                'category_count' => $category->count,
                'destinations' => $destinations,
            );
        }

        return new WP_REST_Response($response_data, 200);
    } catch (Exception $e) {
        return new WP_Error('api_error', 'Erreur lors de la récupération des catégories: ' . $e->getMessage(), array('status' => 500));
    }
}

/**
 * Callback pour récupérer les destinations filtrées
 */
function get_filtered_destinations($request)
{
    $category = $request->get_param('category');
    $search = $request->get_param('search');
    $limit = $request->get_param('limit');

    $args = array(
        'post_type' => 'post',
        'post_status' => 'publish',
        'posts_per_page' => $limit,
    );

    if ($category) {
        $args['category_name'] = $category;
    }

    if ($search) {
        $args['s'] = $search;
    }

    $query = new WP_Query($args);
    $destinations = array();

    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            $destinations[] = format_destination_data(get_post());
        }
        wp_reset_postdata();
    }

    return new WP_REST_Response(array(
        'destinations' => $destinations,
        'total' => $query->found_posts,
        'pages' => $query->max_num_pages,
    ), 200);
}

/**
 * Callback pour récupérer les détails d'une destination
 */
function get_destination_details($request)
{
    $id = $request->get_param('id');
    $post = get_post($id);

    if (!$post || $post->post_status !== 'publish') {
        return new WP_Error('destination_not_found', 'Destination non trouvée', array('status' => 404));
    }

    $destination_data = format_destination_data($post, true);

    return new WP_REST_Response($destination_data, 200);
}

/**
 * Formate les données d'une destination pour l'API
 */
function format_destination_data($post, $full_details = false)
{
    $categories = get_the_category($post->ID);
    $category_names = array_map(function ($cat) {
        return $cat->name;
    }, $categories);

    $data = array(
        'id' => $post->ID,
        'title' => $post->post_title,
        'slug' => $post->post_name,
        'excerpt' => $post->post_excerpt ?: wp_trim_words($post->post_content, 20),
        'permalink' => get_permalink($post->ID),
        'featured_image' => get_the_post_thumbnail_url($post->ID, 'medium'),
        'categories' => $category_names,
        'date' => get_the_date('c', $post->ID),
        'author' => get_the_author_meta('display_name', $post->post_author),
    );

    // Champs personnalisés si disponibles
    if (function_exists('get_field')) {
        $data['custom_fields'] = array(
            'prix' => get_field('prix', $post->ID),
            'duree' => get_field('duree', $post->ID),
            'difficulte' => get_field('difficulte', $post->ID),
            'note' => get_field('note', $post->ID),
            'pays' => get_field('pays', $post->ID),
        );
    }

    if ($full_details) {
        $data['content'] = apply_filters('the_content', $post->post_content);
        $data['featured_image_full'] = get_the_post_thumbnail_url($post->ID, 'large');
    }

    return $data;
}

/**
 * Ajouter les en-têtes CORS pour permettre les requêtes AJAX
 */
function add_cors_headers()
{
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
    header('Access-Control-Allow-Headers: Content-Type');
}
add_action('rest_api_init', 'add_cors_headers');
