<?php get_header() ?>

<?php
// Affichage du message de confirmation
if (isset($_GET['inscription']) && $_GET['inscription'] == 'merci') {
    echo '<div class="message-succes-inscription">
            <p>✅ Merci pour votre inscription ! Vous recevrez bientôt nos dernières nouvelles.</p>
          </div>';
}
?>

<?php render_hero_section(); ?>

<?php get_template_part('gabarit/carousel'); ?>

<?php get_template_part('gabarit/populaire'); ?>

<?php get_template_part('gabarit/filtres-destinations'); ?>

<!-- FORMULAIRE D'INSCRIPTION -->
<section class="inscription">
    <div class="container">
        <h2>Inscrivez-vous à notre newsletter</h2>
        <p>Restez informé(e) de nos dernières destinations et offres exclusives</p>

        <form class="formulaire-inscription" method="GET" action="<?php echo esc_url(home_url('/')); ?>" id="form-inscription">
            <input type="hidden" name="inscription" value="merci">

            <div class="champs-groupe">
                <div class="champ">
                    <label for="prenom">Prénom *</label>
                    <input type="text" id="prenom" name="prenom" required>
                </div>

                <div class="champ">
                    <label for="nom">Nom *</label>
                    <input type="text" id="nom" name="nom" required>
                </div>

                <div class="champ champ-large">
                    <label for="courriel">Courriel *</label>
                    <input type="email" id="courriel" name="courriel" required>
                </div>
            </div>

            <div class="champ-submit">
                <button type="submit" class="btn-inscription">
                    S'inscrire
                </button>
            </div>

            <p class="mentions">
                En vous inscrivant, vous acceptez de recevoir nos communications par courriel.
                Vous pouvez vous désabonner à tout moment.
            </p>
        </form>
    </div>
</section>

<?php get_template_part('gabarit/contact'); ?>

<?php get_footer(); ?>