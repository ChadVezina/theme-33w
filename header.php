<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="<?php bloginfo('description'); ?>" />

    <!-- Préchargement des polices pour optimiser les performances -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet" />

    <!-- CSS du thème -->
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/style.css" />

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>

    <header class="entete" role="banner">
        <div class="entete__contenu">
            <!-- Logo -->
            <figure class="entete__logo">
                <?php if (has_custom_logo()) : ?>
                    <a href="<?php echo esc_url(home_url('/')); ?>" rel="home">
                        <?php echo get_custom_logo(); ?>
                    </a>
                <?php else : ?>
                    <a href="<?php echo esc_url(home_url('/')); ?>" rel="home">
                        <span class="entete__logo-text">✈️ <?php bloginfo('name'); ?></span>
                    </a>
                <?php endif; ?>
            </figure>

            <!-- Menu burger pour mobile -->
            <label for="chk__menu" class="entete__burger" aria-label="Ouvrir le menu">
                <span class="entete__burger-line"></span>
                <span class="entete__burger-line"></span>
                <span class="entete__burger-line"></span>
            </label>

            <!-- Checkbox cachée pour le menu mobile -->
            <input type="checkbox" class="chk__menu" id="chk__menu" />

            <!-- Navigation principale -->
            <nav class="entete__nav" role="navigation" aria-label="Menu principal">
                <!-- Menu de catégories manuel pour éviter les conflits -->
                <ul class="entete__menu">
                    <li><a href="<?php echo esc_url(home_url('/')); ?>">Accueil</a></li>
                    <?php
                    // Générer les liens de catégories manuellement avec get_category_link()
                    $categories = array('aventure', 'croisiere', 'culturel', 'repos', 'sport', 'zen');
                    foreach ($categories as $cat_slug) {
                        $category = get_category_by_slug($cat_slug);
                        if ($category) {
                            echo '<li><a href="' . esc_url(get_category_link($category->term_id)) . '">' . esc_html($category->name) . '</a></li>';
                        }
                    }
                    ?>
                </ul>

                <!-- Barre de recherche -->
                <form class="recherche" role="search" method="get" action="<?php echo esc_url(home_url('/')); ?>">
                    <label for="header-search">
                        <span class="screen-reader-text">Rechercher :</span>
                        <input
                            id="header-search"
                            class="recherche__input"
                            type="search"
                            placeholder="Rechercher une destination..."
                            value="<?php echo get_search_query(); ?>"
                            name="s" />
                    </label>
                    <button class="recherche__bouton" type="submit">
                        <span class="recherche__icone">🔍</span>
                    </button>
                </form>
            </nav>
        </div>
    </header>