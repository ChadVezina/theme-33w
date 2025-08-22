<?php get_header() ?>

<main class="error-404">
  <div class="error-404__container">
    <!-- Animation de carte du monde ou avion qui vole -->
    <div class="error-404__animation">
      <div class="error-404__plane">✈️</div>
      <div class="error-404__clouds">
        <span class="cloud cloud--1">☁️</span>
        <span class="cloud cloud--2">☁️</span>
        <span class="cloud cloud--3">☁️</span>
      </div>
    </div>

    <div class="error-404__content">
      <div class="error-404__status">
        <span class="error-404__code">404</span>
        <div class="error-404__divider">✈️</div>
      </div>

      <h1 class="error-404__title">Destination Introuvable</h1>
      <h2 class="error-404__subtitle">Votre vol a pris une route inattendue !</h2>

      <p class="error-404__description">
        🧭 Oups ! Il semblerait que cette page ait pris des vacances permanentes et soit partie explorer de nouveaux horizons sans nous laisser d'adresse de retour.
        <br><br>
        Mais ne vous inquiétez pas, nous avons d'autres destinations fantastiques qui vous attendent !
      </p>

      <div class="error-404__suggestions">
        <h3 class="error-404__suggestions-title">🎯 Que souhaitez-vous faire ?</h3>

        <div class="error-404__actions">
          <a href="<?php echo home_url(); ?>" class="btn btn--primary btn--home">
            <span class="btn__icon">🏠</span>
            <span class="btn__text">Retour à l'accueil</span>
          </a>

          <?php
          $category = get_category_by_slug('populaire');
          if ($category) :
          ?>
            <a href="<?php echo get_category_link($category->term_id); ?>" class="btn btn--secondary btn--destinations">
              <span class="btn__icon">✈️</span>
              <span class="btn__text">Nos destinations</span>
            </a>
          <?php endif; ?>

          <a href="<?php echo home_url('/contact'); ?>" class="btn btn--tertiary btn--contact">
            <span class="btn__icon">💬</span>
            <span class="btn__text">Nous contacter</span>
          </a>
        </div>

        <!-- Recherche améliorée -->
        <div class="error-404__search">
          <h4 class="error-404__search-title">🔍 Ou recherchez votre destination :</h4>
          <form class="error-404__search-form" role="search" method="get" action="<?php echo esc_url(home_url('/')); ?>">
            <div class="error-404__search-group">
              <label class="error-404__search-label" for="error-search">
                <span class="screen-reader-text">Rechercher :</span>
              </label>
              <input
                id="error-search"
                type="search"
                class="error-404__search-input"
                placeholder="Ex: Paris, Japon, plage..."
                value="<?php echo get_search_query(); ?>"
                name="s"
                autocomplete="off" />
              <button type="submit" class="error-404__search-button">
                <span class="error-404__search-icon">🔍</span>
                <span class="error-404__search-text">Chercher</span>
              </button>
            </div>
          </form>
        </div>
      </div>

      <!-- Destinations populaires avec design amélioré -->
      <div class="error-404__popular">
        <h3 class="error-404__popular-title">🌟 Destinations les plus populaires</h3>
        <div class="error-404__popular-grid">
          <?php
          // Récupérer quelques articles populaires avec plus d'informations
          $popular_posts = get_posts(array(
            'numberposts' => 6,
            'category_name' => 'populaire',
            'post_status' => 'publish',
            'meta_key' => '_thumbnail_id'
          ));

          if ($popular_posts) :
            foreach ($popular_posts as $post) :
              setup_postdata($post);
              $thumbnail = get_the_post_thumbnail_url($post->ID, 'thumbnail');
          ?>
              <article class="error-404__popular-card">
                <a href="<?php echo get_permalink(); ?>" class="error-404__popular-link">
                  <?php if ($thumbnail): ?>
                    <div class="error-404__popular-image">
                      <img src="<?php echo esc_url($thumbnail); ?>" alt="<?php echo esc_attr(get_the_title()); ?>">
                    </div>
                  <?php endif; ?>
                  <div class="error-404__popular-content">
                    <h4 class="error-404__popular-name"><?php echo get_the_title(); ?></h4>
                    <p class="error-404__popular-excerpt">
                      <?php echo wp_trim_words(get_the_excerpt(), 8, '...'); ?>
                    </p>
                  </div>
                  <div class="error-404__popular-arrow">→</div>
                </a>
              </article>
            <?php
            endforeach;
            wp_reset_postdata();
          else:
            ?>
            <!-- Fallback si pas de destinations populaires -->
            <div class="error-404__no-popular">
              <p>🌍 Explorez notre site pour découvrir de magnifiques destinations !</p>
            </div>
          <?php
          endif;
          ?>
        </div>
      </div>

      <!-- Informations utiles -->
      <div class="error-404__help">
        <h4 class="error-404__help-title">💡 Quelques conseils :</h4>
        <ul class="error-404__tips">
          <li>Vérifiez l'URL dans la barre d'adresse</li>
          <li>Utilisez notre moteur de recherche</li>
          <li>Naviguez via notre menu principal</li>
          <li>Contactez-nous si le problème persiste</li>
        </ul>
      </div>

      <!-- Code d'erreur technique pour les développeurs -->
      <details class="error-404__technical">
        <summary class="error-404__technical-toggle">🔧 Informations techniques</summary>
        <div class="error-404__technical-content">
          <p><strong>Code d'erreur :</strong> HTTP 404 Not Found</p>
          <p><strong>URL demandée :</strong> <?php echo esc_html($_SERVER['REQUEST_URI']); ?></p>
          <p><strong>Référent :</strong> <?php echo esc_html(wp_get_referer() ?: 'Direct access'); ?></p>
          <p><strong>User Agent :</strong> <?php echo esc_html($_SERVER['HTTP_USER_AGENT'] ?? 'Unknown'); ?></p>
        </div>
      </details>
    </div>
  </div>
</main>

<?php get_footer(); ?>