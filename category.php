<?php get_header(); ?>

<main class="site__main">
  <section class="category-page">
    <div class="category-header">
      <div class="category-header__content">
        <h1 class="category-title">
          <span class="category-title__icon">✈️</span>
          <?php single_cat_title(); ?>
        </h1>
        <?php if (category_description()) : ?>
          <div class="category-description">
            <?php echo category_description(); ?>
          </div>
        <?php endif; ?>

        <div class="category-stats">
          <?php
          global $wp_query;
          $total_posts = $wp_query->found_posts;
          ?>
          <span class="category-stats__count">
            <?php echo $total_posts; ?> destination<?php echo $total_posts > 1 ? 's' : ''; ?>
          </span>
        </div>
      </div>
    </div>

    <?php echo render_section_separator('wave-soft'); ?>

    <div class="category-content">
      <?php if (have_posts()) : ?>
        <div class="conteneur conteneur--category">
          <?php while (have_posts()) : the_post(); ?>
            <?php get_template_part('gabarit/carte'); ?>
          <?php endwhile; ?>
        </div>

        <!-- Pagination améliorée -->
        <nav class="category-pagination">
          <?php
          the_posts_pagination(array(
            'mid_size' => 2,
            'prev_text' => '<span class="pagination-icon">←</span> Précédent',
            'next_text' => 'Suivant <span class="pagination-icon">→</span>',
            'screen_reader_text' => 'Navigation des pages de la catégorie',
          ));
          ?>
        </nav>

      <?php else : ?>
        <div class="category-no-posts">
          <div class="category-no-posts__icon">🏝️</div>
          <h2 class="category-no-posts__title">Aucune destination trouvée</h2>
          <p class="category-no-posts__text">
            Il n'y a pas encore de destinations dans cette catégorie.
            Explorez nos autres catégories pour découvrir de nouveaux horizons !
          </p>

          <!-- Affichage des autres catégories avec la fonction carte() -->
          <div class="category-suggestions">
            <h3 class="category-suggestions__title">Découvrez d'autres destinations</h3>
            <?php
            // Utilisation de la fonction carte() en excluant la catégorie actuelle
            $current_category = get_queried_object();
            if ($current_category && isset($current_category->slug)) {
              carte($current_category->slug);
            } else {
              carte();
            }
            ?>
          </div>
        </div>
      <?php endif; ?>
    </div>
  </section>
</main>

<?php get_footer(); ?>