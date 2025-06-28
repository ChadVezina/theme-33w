<?php

/**
 * Template-part populaire.php
 * Section des destinations populaires
 */
?>
<section class="populaire">
    <div class="populaire__header">
        <h2 class="populaire__titre">Destinations Populaires</h2>
        <p class="populaire__description">
            Découvrez nos destinations les plus appréciées par notre communauté de voyageurs
        </p>
    </div>

    <div class="conteneur global">
        <?php if (have_posts()) : ?>
            <?php while (have_posts()) : the_post(); ?>
                <?php
                if (in_category('galerie')) {
                    
                } else {
                    get_template_part("gabarit/carte");
                }
                ?>
            <?php endwhile; ?>
        <?php else : ?>
            <div class="populaire__no-posts">
                <h3>Aucune destination disponible</h3>
                <p>Nous travaillons à ajouter de nouvelles destinations passionnantes.</p>
            </div>
        <?php endif; ?>
    </div>
</section>