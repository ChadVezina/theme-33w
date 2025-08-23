<?php get_header() ?>

<!-- TEMPLATE: single.php - Posts génériques -->
<!-- POST TYPE: <?php echo get_post_type(); ?> -->

<main class="single-post">
    <?php if (have_posts()) : ?>
        <?php while (have_posts()) : the_post(); ?>
            <article class="single-post__article">
                <header class="single-post__header">
                    <h1 class="single-post__title"><?php the_title(); ?></h1>
                    <div class="single-post__meta">
                        <span class="single-post__date"><?php echo get_the_date(); ?></span>
                        <span class="single-post__author">Par <?php the_author(); ?></span>
                        <?php if (has_category()) : ?>
                            <span class="single-post__categories">
                                <?php the_category(', '); ?>
                            </span>
                        <?php endif; ?>
                    </div>
                </header>

                <?php if (has_post_thumbnail()) : ?>
                    <div class="single-post__featured-image">
                        <?php the_post_thumbnail('large', ['class' => 'single-post__image']); ?>
                    </div>
                <?php endif; ?>

                <?php
                // Récupération des champs personnalisés de température
                $temp_min = get_field('temperature_minimum');
                $temp_max = get_field('temperature_maximum');
                $temp_moy = get_field('temperature_moyenne');
                // Récupération du champ personnalisé note générale
                $note_general = get_field('note_general');
                ?>

                <?php if ($temp_min || $temp_max || $temp_moy) : ?>
                    <div class="single-post__temperatures">
                        <h3 class="single-post__temperatures-title">🌡️ Informations climatiques</h3>
                        <div class="single-post__temperatures-grid">
                            <?php if ($temp_min) : ?>
                                <div class="single-post__temperature-card single-post__temperature-card--<?php echo esc_attr(get_temperature_class($temp_min)); ?>">
                                    <span class="single-post__temperature-label">Température minimum</span>
                                    <span class="single-post__temperature-value"><?php echo esc_html($temp_min); ?>°C</span>
                                    <span class="single-post__temperature-description"><?php echo esc_html(get_temperature_description($temp_min, 'min')); ?></span>
                                </div>
                            <?php endif; ?>

                            <?php if ($temp_max) : ?>
                                <div class="single-post__temperature-card single-post__temperature-card--<?php echo esc_attr(get_temperature_class($temp_max)); ?>">
                                    <span class="single-post__temperature-label">Température maximum</span>
                                    <span class="single-post__temperature-value"><?php echo esc_html($temp_max); ?>°C</span>
                                    <span class="single-post__temperature-description"><?php echo esc_html(get_temperature_description($temp_max, 'max')); ?></span>
                                </div>
                            <?php endif; ?>

                            <?php if ($temp_moy) : ?>
                                <div class="single-post__temperature-card single-post__temperature-card--<?php echo esc_attr(get_temperature_class($temp_moy)); ?>">
                                    <span class="single-post__temperature-label">Température moyenne</span>
                                    <span class="single-post__temperature-value"><?php echo esc_html($temp_moy); ?>°C</span>
                                    <span class="single-post__temperature-description"><?php echo esc_html(get_temperature_description($temp_moy, 'moy')); ?></span>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endif; ?>

                <?php if ($note_general) : ?>
                    <div class="single-post__note-section">
                        <h3 class="single-post__note-title">⭐ Évaluation de la destination</h3>
                        <div class="single-post__note-card">
                            <span class="single-post__note-label">Note générale</span>
                            <span class="single-post__note-value"><?php echo esc_html($note_general); ?>/5</span>
                            <span class="single-post__note-description">
                                <?php
                                $note = floatval($note_general);
                                if ($note >= 4.5) echo "Destination exceptionnelle";
                                elseif ($note >= 4.0) echo "Très bonne destination";
                                elseif ($note >= 3.5) echo "Bonne destination";
                                elseif ($note >= 3.0) echo "Destination correcte";
                                else echo "Destination à améliorer";
                                ?>
                            </span>
                        </div>
                    </div>
                <?php endif; ?>

                <div class="single-post__content">
                    <?php the_content(); ?>
                </div>
            </article>

        <?php endwhile; ?>
    <?php else : ?>
        <div class="single-post__no-content">
            <h2>Aucun contenu trouvé</h2>
            <p>Désolé, aucun contenu n'a été trouvé.</p>
        </div>
    <?php endif; ?>
</main>

<?php echo render_section_separator('wave-soft'); ?>

<?php get_footer(); ?>