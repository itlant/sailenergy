<?php get_header(); ?>

<div class="wrapper d-flex flex-column min-vh-100">
  <main>
    <?php sailenergy_breadcrumbs(); ?>

    <section class="py-5 bg-light">
      <div class="container py-3">
        <h1 class="display-5 fw-bold mb-4 text-center">
          Все <span class="text-teal">курсы</span>
        </h1>

        <?php if (have_posts()) : ?>
          <div class="row g-4">
            <?php while (have_posts()) : the_post(); ?>
              <div class="col-md-6 col-lg-4">
                <div class="card service-card h-100 p-4 shadow-sm text-center border-0 bg-white rounded-4">
                  <div class="card-body d-flex flex-column align-items-center">
                    <?php $icon = get_field('course_icon') ?: 'fas fa-anchor'; ?>
                    <div class="icon-circle bg-light text-teal mb-4 rounded-circle d-flex align-items-center justify-content-center" style="width: 70px; height: 70px;">
                      <i class="<?php echo esc_attr($icon); ?> fs-2"></i>
                    </div>
                    <h4 class="card-title fw-bold"><?php the_title(); ?></h4>
                    <p class="card-text text-muted"><?php echo wp_trim_words(get_the_excerpt(), 15); ?></p>
                    <a href="<?php the_permalink(); ?>" class="stretched-link text-teal text-decoration-none mt-auto">Подробнее &rarr;</a>
                  </div>
                </div>
              </div>
            <?php endwhile; ?>
          </div>
          <?php sailenergy_pagination(); ?>
        <?php else : ?>
          <p class="text-center text-muted">Курсы будут добавлены в ближайшее время.</p>
        <?php endif; ?>
      </div>
    </section>
  </main>

  <?php get_footer(); ?>
</div>