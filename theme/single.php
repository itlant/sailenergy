<?php get_header(); ?>

<div class="wrapper d-flex flex-column">
  <main>
    <?php sailenergy_breadcrumbs(); ?>

    <section class="py-5 bg-white">
      <div class="container py-3">
        <div class="row justify-content-center">
          <div class="col-lg-8">
            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                <?php get_template_part('template-parts/content', 'single'); ?>
            <?php endwhile;
            endif; ?>
          </div>
        </div>
      </div>
    </section>
  </main>

  <?php get_footer(); ?>
</div>