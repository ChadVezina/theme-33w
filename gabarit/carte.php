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
        <?php
        // Récupération du champ personnalisé de température moyenne uniquement
        $temp_moy = get_field('temperature_moyenne');
        ?>

        <?php if ($temp_moy) : ?>
            <div class="conteneur__carte__temperature">
                <span class="conteneur__carte__temperature-value conteneur__carte__temperature-value--<?php echo esc_attr(get_temperature_class($temp_moy)); ?>">
                    <?php echo esc_html($temp_moy); ?>°C
                </span>
            </div>
        <?php endif; ?>

        <div class="conteneur__carte__text">
            <?php echo wp_trim_words(get_the_excerpt(), 10, '...'); ?>
        </div>
        <div class="conteneur__carte__button">
            <a href="<?php echo get_permalink(); ?>">Suite</a>
        </div>
    </div>
</article>