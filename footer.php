<footer class="piedpage">
    <div class="piedpage__contenu">
        <div class="piedpage__logo">
            <img src="<?php echo get_template_directory_uri(); ?>/images/logo.png" alt="<?php bloginfo('name'); ?>">
        </div>
        
        <div class="piedpage__contact">
            <p><strong>Contact</strong></p>
            <p>📧 info@clubvoyage.com</p>
            <p>📞 (555) 123-4567</p>
            <p>📍 123 Rue du Voyage, Montréal, QC</p>
        </div>
        
        <div class="piedpage__copyright">
            <p>&copy; <?php echo date('Y'); ?> <a href="<?php echo home_url(); ?>"><?php bloginfo('name'); ?></a>. Tous droits réservés.</p>
            <p>Développé avec ❤️ par <a href="https://github.com/ChadVezina" target="_blank">Chad Vezina</a></p>
        </div>
    </div>
</footer>

<script src="<?php echo get_template_directory_uri(); ?>/script/checkbox.js"></script>

<?php wp_footer(); ?>
</body>
</html>