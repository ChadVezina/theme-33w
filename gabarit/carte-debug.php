<?php

/**
 * Template-part carte.php SIMPLIFIÉ pour débogage
 */
?>
<article class="conteneur__carte" style="border: 2px solid red; margin: 10px; padding: 10px;">
    <h2>CARTE: <?php the_title(); ?></h2>
    <p>ID: <?php the_ID(); ?></p>
    <p>Permalien: <?php the_permalink(); ?></p>

    <?php if (has_post_thumbnail()) : ?>
        <div>IMAGE: <?php the_post_thumbnail('thumbnail'); ?></div>
    <?php else : ?>
        <p>Pas d'image featured</p>
    <?php endif; ?>

    <div>
        EXTRAIT: <?php echo wp_trim_words(get_the_excerpt(), 10, '...'); ?>
    </div>

    <a href="<?php the_permalink(); ?>" style="background: blue; color: white; padding: 5px 10px; text-decoration: none;">
        Voir l'article
    </a>
</article>