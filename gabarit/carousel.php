<?php
// Hero Background Carousel - This will be integrated into the hero section
$carousel_images = array();
for ($i = 1; $i <= 10; $i++) {
    $img_url = get_theme_mod("hero_slide_$i", '');
    if ($img_url) {
        $carousel_images[] = $img_url;
    }
}

if (!empty($carousel_images)): ?>
    <script>
        // Pass carousel images to JavaScript
        window.heroCarouselImages = <?php echo json_encode($carousel_images); ?>;
    </script>
<?php endif; ?>