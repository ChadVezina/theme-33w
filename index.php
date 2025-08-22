<?php get_header(); ?>
<section class="populaire">
  <?php if (have_posts()) {
    while (have_posts()) {
      the_post();
      the_post_thumbnail('thumbnail');
  ?>
      <h1><?php the_title(); ?></h1>
  <?php
      the_content();
    }
  } ?>
</section>
<?php get_footer();
