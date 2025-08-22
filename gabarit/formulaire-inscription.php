<?php

/**
 * Gabarit pour le formulaire d'inscription simple
 */
?>

<!-- TEST DEBUG: Formulaire d'inscription chargé -->

<div style="background: red; color: white; padding: 20px; text-align: center; margin: 20px 0;">
    <h2>TEST - Formulaire d'inscription visible</h2>
</div>

<style>
    .inscription {
        background: linear-gradient(135deg, #007cba, #00a0d2);
        padding: 3rem 0;
        margin: 2rem 0;
        color: white;
    }

    .inscription .container {
        max-width: 800px;
        margin: 0 auto;
        padding: 0 2rem;
    }

    .inscription h2 {
        text-align: center;
        font-size: 2.5rem;
        margin-bottom: 1rem;
        color: white;
    }

    .inscription p {
        text-align: center;
        font-size: 1.1rem;
        margin-bottom: 2rem;
        color: rgba(255, 255, 255, 0.9);
    }

    .formulaire-inscription {
        background: white;
        padding: 2rem;
        border-radius: 10px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
    }

    .champs-groupe {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1rem;
        margin-bottom: 1.5rem;
    }

    .champ {
        display: flex;
        flex-direction: column;
    }

    .champ-large {
        grid-column: 1 / -1;
    }

    .champ label {
        font-weight: bold;
        color: #333;
        margin-bottom: 0.5rem;
    }

    .champ input {
        padding: 0.8rem;
        border: 2px solid #ddd;
        border-radius: 5px;
        font-size: 1rem;
    }

    .champ input:focus {
        outline: none;
        border-color: #007cba;
    }

    .champ-submit {
        text-align: center;
        margin-bottom: 1rem;
    }

    .btn-inscription {
        background: linear-gradient(135deg, #007cba, #00a0d2);
        color: white;
        border: none;
        padding: 1rem 2rem;
        border-radius: 25px;
        font-size: 1.1rem;
        font-weight: bold;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .btn-inscription:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0, 124, 186, 0.4);
    }

    .mentions {
        color: #666;
        font-size: 0.9rem;
        text-align: center;
        margin: 0;
    }

    @media (max-width: 768px) {
        .champs-groupe {
            grid-template-columns: 1fr;
        }

        .inscription h2 {
            font-size: 2rem;
        }

        .formulaire-inscription {
            padding: 1.5rem;
        }
    }
</style>

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