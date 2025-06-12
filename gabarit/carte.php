<?php

/**
 * Template-part carte.php
 * Affiche une carte dans un conteneur flex
 */
?>
<article class="conteneur__carte">
    <?php the_post_thumbnail('thumbnail'); ?>
    <h2><?php the_title(); ?></h2>
    <div class="conteneur__carte__content">
        <div class="conteneur__carte__text">
            <?php echo wp_trim_words(get_the_excerpt(), 10, '...'); ?>
        </div>
        <div class="conteneur__carte__button">
            <a href="<?php echo get_permalink(); ?>">Suite</a>
        </div>
    </div>
</article>