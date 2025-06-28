<?php get_header() ?>

<main class="error-404">
  <div class="error-404__container">
    <div class="error-404__content">
      <div class="error-404__icon">
        🧭
      </div>

      <h1 class="error-404__title">404</h1>
      <h2 class="error-404__subtitle">Destination introuvable</h2>

      <p class="error-404__description">
        Oups ! Il semble que cette page ait pris des vacances sans nous prévenir.
        Elle est peut-être partie explorer de nouveaux horizons !
      </p>

      <div class="error-404__suggestions">
        <h3 class="error-404__suggestions-title">Que souhaitez-vous faire ?</h3>

        <div class="error-404__actions">
          <a href="<?php echo home_url(); ?>" class="btn btn--primary">
            🏠 Retour à l'accueil
          </a>

          <?php
          $category = get_category_by_slug('populaire');
          if ($category) :
          ?>
            <a href="<?php echo get_category_link($category->term_id); ?>" class="btn btn--secondary">
              ✈️ Voir nos destinations
            </a>
          <?php endif; ?>
        </div>

        <div class="error-404__search">
          <h4>Ou recherchez votre destination :</h4>
          <form class="error-404__search-form" role="search" method="get" action="<?php echo esc_url(home_url('/')); ?>">
            <label class="error-404__search-label">
              <input
                type="search"
                class="error-404__search-input"
                placeholder="Rechercher une destination..."
                value="<?php echo get_search_query(); ?>"
                name="s" />
            </label>
            <button type="submit" class="error-404__search-button">
              <span class="error-404__search-icon">🔍</span>
            </button>
          </form>
        </div>
      </div>

      <div class="error-404__popular">
        <h3>Destinations populaires</h3>
        <div class="error-404__popular-links">
          <?php
          // Récupérer quelques articles populaires
          $popular_posts = get_posts(array(
            'numberposts' => 3,
            'category_name' => 'populaire',
            'post_status' => 'publish'
          ));

          if ($popular_posts) :
            foreach ($popular_posts as $post) :
              setup_postdata($post);
          ?>
              <a href="<?php echo get_permalink(); ?>" class="error-404__popular-link">
                <?php echo get_the_title(); ?>
              </a>
          <?php
            endforeach;
            wp_reset_postdata();
          endif;
          ?>
        </div>
      </div>
    </div>
  </div>
</main>

<?php get_footer(); ?>