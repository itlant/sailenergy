<?php get_header(); ?>

<div class="wrapper d-flex flex-column min-vh-100">
  <main>
    <!-- HERO -->
    <?php if (is_front_page()) : ?>
      <?php get_template_part('template-parts/hero'); ?>
      <?php get_template_part('template-parts/about'); ?>
      <?php get_template_part('template-parts/services'); ?>
      <?php get_template_part('template-parts/team'); ?>
      <?php get_template_part('template-parts/regattas'); ?>
      <?php get_template_part('template-parts/faq'); ?>
    <?php else : ?>
      <?php sailenergy_breadcrumbs(); ?>
      <section class="py-5 bg-light">
        <div class="container py-3">
          <?php if (have_posts()) : ?>
            <div class="row">
              <?php while (have_posts()) : the_post(); ?>
                <div class="col-12">
                  <?php get_template_part('template-parts/content', get_post_type()); ?>
                </div>
              <?php endwhile; ?>
            </div>
            <?php sailenergy_pagination(); ?>
          <?php else : ?>
            <?php get_template_part('template-parts/content', 'none'); ?>
          <?php endif; ?>
        </div>
      </section>
    <?php endif; ?>
  </main>

  <?php get_footer(); ?>
</div>