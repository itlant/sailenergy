<?php

/**
 * Template Name: Регаты
 */
?>

<?php get_header(); ?>

<div class="wrapper d-flex flex-column">
  <main>
    <?php sailenergy_breadcrumbs(); ?>

    <section class="py-5 bg-light" id="regattas-page">
      <div class="container py-5">
        <div class="row">
          <div class="col-lg-3">
            <div class="card border-0 shadow-sm rounded-4 p-4 sticky-top" style="top: 100px">
              <h5 class="fw-bold mb-3">Фильтр</h5>
              <div class="mb-3">
                <label class="fw-medium small text-muted mb-1">Месяц</label>
                <select class="form-select border-0 bg-light">
                  <option>Все</option>
                  <option>Май</option>
                  <option>Июнь</option>
                </select>
              </div>
              <div class="mb-3">
                <label class="fw-medium small text-muted mb-1">Страна</label>
                <select class="form-select border-0 bg-light">
                  <option>Все</option>
                  <option>Турция</option>
                  <option>Россия</option>
                </select>
              </div>
              <button class="btn btn-teal w-100">Применить</button>
            </div>
          </div>

          <div class="col-lg-9">
            <h1 class="display-5 fw-bold mb-4">Календарь <span class="text-teal">регат</span></h1>
            <div class="row g-4">
              <?php
              $regattas = get_posts(array(
                'post_type' => 'regatta',
                'posts_per_page' => -1,
                'orderby' => 'meta_value',
                'meta_key' => 'regatta_date',
                'order' => 'ASC',
              ));

              if ($regattas) :
                foreach ($regattas as $regatta) :
                  $date = get_field('regatta_date', $regatta->ID);
                  $location = get_field('regatta_location', $regatta->ID);
                  $badge = get_field('regatta_badge', $regatta->ID);
              ?>
                  <div class="col-md-6 col-lg-4">
                    <div class="card regatta-card bg-white text-dark border-0 h-100 shadow-sm rounded-4 overflow-hidden">
                      <div class="position-relative">
                        <?php if ($badge) : ?>
                          <span class="badge bg-teal text-white position-absolute top-0 start-0 m-3 px-3 py-2 rounded-pill"><?php echo esc_html($badge); ?></span>
                        <?php endif; ?>
                        <?php if (has_post_thumbnail($regatta->ID)) : ?>
                          <img src="<?php echo get_the_post_thumbnail_url($regatta->ID, 'medium'); ?>" class="card-img-top" alt="<?php echo esc_attr(get_the_title($regatta)); ?>" loading="lazy">
                        <?php else : ?>
                          <img src="<?php echo get_template_directory_uri(); ?>/assets/img/sailenergy-template-img-6.jpg" class="card-img-top" alt="<?php echo esc_attr(get_the_title($regatta)); ?>" loading="lazy">
                        <?php endif; ?>
                      </div>
                      <div class="card-body p-4 d-flex flex-column">
                        <h3 class="card-title fw-bold fs-5"><?php echo get_the_title($regatta); ?></h3>
                        <p class="card-text text-muted small mb-0">
                          <?php echo $location ?: ''; ?>
                          <?php if ($date) : ?>
                            <br><?php echo esc_html($date); ?>
                          <?php endif; ?>
                        </p>
                        <a href="<?php echo get_permalink($regatta); ?>" class="stretched-link text-teal text-decoration-none mt-auto">Подробнее &rarr;</a>
                      </div>
                    </div>
                  </div>
                <?php
                endforeach;
              else :
                ?>
                <div class="col-12 text-center">
                  <p class="text-muted">Регаты будут добавлены в ближайшее время.</p>
                </div>
              <?php endif; ?>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>

  <?php get_footer(); ?>
</div>