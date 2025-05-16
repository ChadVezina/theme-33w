<?php get_header(); ?>
<section class="hero">
  <div class="hero__contenu">
    <h1 class="hero__titre">Voyagez Autrement avec Mondo Voyages !</h1>
    <p class="hero__description">
      Découvrez des destinations uniques et inoubliables avec Mondo Voyages.
      Nous vous offrons des expériences authentiques, des paysages à couper le souffle
      et des aventures sur mesure. Partez à la découverte du monde avec nous et créez
      des souvenirs impérissables.
    </p>
    <div class="hero__contact">
      <p class="hero__email">info@cmaisonneuve.qc.ca</p>
      <p class="hero__adresse">3800, rue Sherbrooke, Montreal</p>
      <p class="hero__telephone">514-254-7131</p>
      <a href="#" class="hero__button">S'INSCRIRE</a>
      <div class="hero__social">
        <a href="#" class="hero__social-link">
          <img src="https://s2.svgbox.net/social.svg?ic=facebook&color=000" width="24" height="24" alt="Facebook">
        </a>
        <a href="#" class="hero__social-link">
          <img src="https://s2.svgbox.net/social.svg?ic=instagram&color=000" width="24" height="24" alt="Instagram">
        </a>
      </div>
    </div>
  </div>
</section>
<section class="recherche-voyage">
  <div class="recherche-voyage__container">
    <div class="recherche-voyage__item">
      <h3>Départ</h3>
      <input type="text" placeholder="Date de départ">
    </div>
    <div class="recherche-voyage__item">
      <h3>Retour</h3>
      <input type="text" placeholder="Date de retour">
    </div>
    <div class="recherche-voyage__item">
      <h3>Budget</h3>
      <select>
        <option>Sélectionner un budget</option>
      </select>
    </div>
    <div class="recherche-voyage__item">
      <h3>Thématique</h3>
      <select>
        <option>Choisir une thématique</option>
      </select>
    </div>
    <div class="recherche-voyage__item">
      <h3>S'INSCRIRE</h3>
    </div>
  </div>
</section>
<section class="destinations">
  <?php
  // Vérifie s'il y a des articles à afficher
  if (have_posts()) :
    // Boucle sur chaque article
  ?>
    <h2 class="destinations__titre">Nos destinations favorites</h2>
    <?php
    // Boucle sur chaque article
    if (have_posts()) :
    ?>
      <div class="destinations__grille">
        <?php while (have_posts()) : the_post(); ?>
          <div class="destination-card">
            <?php
            if (has_post_thumbnail()) {
              the_post_thumbnail('large', ['class' => 'destination-card__image', 'alt' => get_the_title()]);
            }
            ?>
            <h3 class="destination-card__title"><?php the_title(); ?></h3>
            <div class="destination-card__content">
              <?php the_content(); ?>
            </div>
          </div>
        <?php endwhile; ?>
      </div>
    <?php else : ?>
      <!-- Message si aucun article trouvé -->
      <p>Aucun contenu trouvé.</p>
    <?php endif; ?>
  <?php
  else :
    // Message si aucun article trouvé
  ?>
    <p>Aucun article trouvé.</p>
  <?php endif; ?>
</section>
<?php get_footer(); ?>