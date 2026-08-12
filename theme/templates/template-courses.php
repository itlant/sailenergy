<?php

/**
 * Template Name: Курсы
 */
?>

<?php get_header(); ?>

<div class="wrapper d-flex flex-column">
  <main>
    <?php sailenergy_breadcrumbs(); ?>

    <section class="py-5 bg-light" id="courses">
      <div class="container py-5">
        <div class="row mb-5">
          <div class="col-lg-8 mx-auto text-center">
            <h1 class="display-5 fw-bold">
              Наши <span class="text-teal">курсы</span>
            </h1>
            <p class="lead text-muted">
              Выберите программу обучения, которая соответствует вашему уровню.
            </p>
          </div>
        </div>
        <div class="row g-4">
          <?php
          $courses = get_posts(array(
            'post_type' => 'course',
            'posts_per_page' => -1,
            'orderby' => 'menu_order',
            'order' => 'ASC',
          ));

          if ($courses) :
            foreach ($courses as $course) :
              $icon = get_field('course_icon', $course->ID) ?: 'fas fa-anchor';
              $level = get_field('course_level', $course->ID);
              $level_label = '';
              if ($level == 'start') $level_label = 'Новичок';
              elseif ($level == 'pro') $level_label = 'Опытный';
              elseif ($level == 'master') $level_label = 'Профи';
          ?>
              <div class="col-md-6 col-lg-4">
                <div class="card service-card h-100 p-4 shadow-sm text-center border-0 bg-white rounded-4">
                  <div class="card-body d-flex flex-column align-items-center">
                    <div class="icon-circle bg-light text-teal mb-4 rounded-circle d-flex align-items-center justify-content-center" style="width: 70px; height: 70px;">
                      <i class="<?php echo esc_attr($icon); ?> fs-2"></i>
                    </div>
                    <h3 class="card-title fw-bold"><?php echo get_the_title($course); ?></h3>
                    <?php if ($level_label) : ?>
                      <span class="badge bg-teal text-white mb-2"><?php echo $level_label; ?></span>
                    <?php endif; ?>
                    <?php $duration = get_field('course_duration', $course->ID); ?>
                    <?php if ($duration) : ?>
                      <p class="text-muted small">Длительность: <?php echo esc_html($duration); ?></p>
                    <?php endif; ?>
                    <p class="card-text text-muted"><?php echo wp_trim_words(get_the_excerpt($course), 15); ?></p>
                    <a href="<?php echo get_permalink($course); ?>" class="stretched-link text-teal text-decoration-none mt-auto">Подробнее &rarr;</a>
                  </div>
                </div>
              </div>
            <?php
            endforeach;
          else :
            ?>
            <div class="col-12 text-center">
              <p class="text-muted">Курсы будут добавлены в ближайшее время.</p>
            </div>
          <?php endif; ?>
        </div>
      </div>
    </section>
  </main>

  <?php get_footer(); ?>
</div>