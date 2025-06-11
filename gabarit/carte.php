<?php

/**
 * Template-part carte.php
 * Affiche une carte dans un conteneur flex
 */
$lien = "<a href=" . get_permalink() . ">Suite</a>";
?>
<article class="conteneur__carte">
    <?php the_post_thumbnail('thumbnail'); ?>
    <h2><?php the_title(); ?></h2>
    <p><?php echo wp_trim_words(get_the_excerpt(), 10, $lien); ?></p>
</article>