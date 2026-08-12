<?php get_header(); ?>

<div class="wrapper d-flex flex-column">
  <main>
    <?php sailenergy_breadcrumbs(); ?>

    <section class="py-5 bg-white">
      <div class="container py-3">
        <div class="row justify-content-center">
          <div class="col-lg-10">
            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                <h1 class="display-5 fw-bold mb-4 text-dark"><?php the_title(); ?></h1>
                <div class="text-muted">
                  <?php the_content(); ?>
                </div>
            <?php endwhile;
            endif; ?>
          </div>
        </div>
      </div>
    </section>
  </main>

  <?php get_footer(); ?>
</div>