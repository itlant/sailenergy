<?php get_header(); ?>

<div class="wrapper d-flex flex-column">
  <main>
    <?php sailenergy_breadcrumbs(); ?>

    <section class="py-5 bg-light">
      <div class="container py-3">
        <h1 class="display-5 fw-bold mb-4 text-dark">
          Результаты поиска: <span class="text-teal"><?php echo get_search_query(); ?></span>
        </h1>

        <?php if (have_posts()) : ?>
          <div class="row g-4">
            <?php while (have_posts()) : the_post(); ?>
              <div class="col-md-6 col-lg-4">
                <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden">
                  <?php if (has_post_thumbnail()) : ?>
                    <img src="<?php the_post_thumbnail_url('medium'); ?>" class="card-img-top" style="height: 200px; object-fit: cover;" alt="<?php the_title(); ?>">
                  <?php endif; ?>
                  <div class="card-body p-4">
                    <h5 class="card-title fw-bold"><?php the_title(); ?></h5>
                    <p class="card-text text-muted small"><?php echo wp_trim_words(get_the_excerpt(), 20); ?></p>
                    <a href="<?php the_permalink(); ?>" class="stretched-link text-teal text-decoration-none">Читать &rarr;</a>
                  </div>
                </div>
              </div>
            <?php endwhile; ?>
          </div>
          <?php sailenergy_pagination(); ?>
        <?php else : ?>
          <p class="text-muted">По вашему запросу ничего не найдено. Попробуйте изменить запрос.</p>
          <?php get_search_form(); ?>
        <?php endif; ?>
      </div>
    </section>
  </main>

  <?php get_footer(); ?>
</div>