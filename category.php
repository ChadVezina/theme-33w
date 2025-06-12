<?php get_header(); ?>

<div class="category-page">
  <div class="category-header">
    <h1 class="category-title"><?php single_cat_title(); ?></h1>
    <?php if (category_description()) : ?>
      <div class="category-description">
        <?php echo category_description(); ?>
      </div>
    <?php endif; ?>
  </div>

  <div class="conteneur">
    <?php if (have_posts()) : ?>
      <?php while (have_posts()) : the_post(); ?>
        <article class="conteneur__carte" onclick="location.href='<?php the_permalink(); ?>'" style="cursor: pointer;">
          <?php if (has_post_thumbnail()) : ?>
            <div class="conteneur__carte__image">
              <?php the_post_thumbnail('medium_large', array('alt' => get_the_title())); ?>
            </div>
          <?php endif; ?>

          <div class="conteneur__carte__content">
            <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>

            <div class="conteneur__carte__meta">
              <span class="date"><?php echo get_the_date(); ?></span>
              <span class="author">Par <?php the_author(); ?></span>
            </div>

            <div class="conteneur__carte__text">
              <?php echo wp_trim_words(get_the_excerpt(), 20, '...'); ?>
            </div>

            <div class="conteneur__carte__button">
              <a href="<?php the_permalink(); ?>">Lire la suite</a>
            </div>
          </div>
        </article>
      <?php endwhile; ?>
    <?php else : ?>
      <div class="no-posts">
        <h2>Aucun article trouvé</h2>
        <p>Il n'y a pas d'articles dans cette catégorie pour le moment.</p>
      </div>
    <?php endif; ?>
  </div>

  <?php
  // Pagination
  the_posts_pagination(array(
    'mid_size' => 2,
    'prev_text' => '← Précédent',
    'next_text' => 'Suivant →',
  ));
  ?>
</div>

<?php get_footer(); ?>