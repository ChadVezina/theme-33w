<?php

/**
 * Template-part hero.php
 * Section héro de la page d'accueil
 */
?>
<section class="hero">
    <div class="hero__contenu">
        <h1 class="hero__titre">Club de Voyage Aventure</h1>
        <p class="hero__description">
            Découvrez des destinations extraordinaires avec notre club de voyage passionné.
            Nous organisons des aventures inoubliables à travers le monde, des plages
            paradisiaques aux montagnes majestueuses, en passant par les villes historiques
            et les cultures fascinantes. Rejoignez notre communauté d'explorateurs et
            créez des souvenirs qui dureront toute une vie.
        </p>
        <div class="hero__actions">
            <?php $category = get_category_by_slug('populaire'); ?>
            <a href="<?php echo get_category_link($category->term_id); ?>" class="btn btn--primary">Découvrir nos destinations</a>
            <a href="#contact" class="btn btn--secondary">Nous rejoindre</a>
        </div>
    </div>
</section>