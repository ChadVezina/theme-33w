<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Mondo Voyages - Voyagez Autrement</title>
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link
    href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
    rel="stylesheet" />
  <link rel="stylesheet" href="normalize.css" />
  <link rel="stylesheet" href="style.css" />
  <?php wp_head(); ?>
</head>

<body>
  <header class="entete">
    <div class="entete__contenu">
      <div class="entete__logo-container">
        <?php
        echo get_custom_logo();
        ?>
      </div>
      <label for="chk__menu" class="entete__burger">
        <img src="https://s2.svgbox.net/hero-outline.svg?ic=menu&color=000" width="32" height="32">

      </label>
      <input type="checkbox" class="chk__menu" id="chk__menu" />
      <nav class="entete__nav">
        <?php wp_nav_menu(array(
          'menu'            => 'principal',
          'theme_location'  => 'menu-principal',
          'container'       => false,
          'menu_class'      => 'entete__menu',
          'items_wrap'      => '<ul class="entete__menu">%3$s</ul>',
          'fallback_cb'     => false,
          'add_li_class'    => 'entete__menu-item'
        )); ?>

        <form class="recherche" action="<?php echo esc_url(home_url('/')); ?>">
          <input class="recherche__input" type="search" name="s" placeholder="Recherche..." value="<?php echo get_search_query(); ?>" />
          <button class="recherche__bouton">
            <img
              src="https://s2.svgbox.net/hero-solid.svg?ic=search&color=000"
              width="24"
              height="24" />
          </button>
        </form>
      </nav>
    </div>
  </header>