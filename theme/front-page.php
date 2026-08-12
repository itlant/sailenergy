<?php get_header(); ?>

<div class="wrapper d-flex flex-column min-vh-100">
  <main>
    <?php get_template_part('template-parts/hero'); ?>
    <?php get_template_part('template-parts/about'); ?>
    <?php get_template_part('template-parts/services'); ?>
    <?php get_template_part('template-parts/team'); ?>
    <?php get_template_part('template-parts/regattas'); ?>
    <?php get_template_part('template-parts/faq'); ?>
  </main>

  <?php get_footer(); ?>
</div>