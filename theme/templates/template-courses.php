<?php

/**
 * Template Name: Обучение (лендинг)
 */
?>

<?php get_header(); ?>

<div class="wrapper d-flex flex-column">
  <main>
    <?php sailenergy_breadcrumbs(); ?>

    <section class="py-5 bg-light">
      <div class="container py-3">
        <h1 class="display-5 fw-bold text-center mb-4">
          Обучение <span class="text-teal">яхтингу</span>
        </h1>
        <p class="text-center text-muted mb-5">
          Выберите программу, которая соответствует вашему уровню подготовки
        </p>

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
                    <h4 class="card-title fw-bold"><?php echo get_the_title($course); ?></h4>
                    <?php if ($level_label) : ?>
                      <span class="badge bg-teal text-white mb-2"><?php echo $level_label; ?></span>
                    <?php endif; ?>
                    <p class="card-text text-muted"><?php echo wp_trim_words(get_the_excerpt($course), 15); ?></p>
                    <a href="<?php echo get_permalink($course); ?>" class="stretched-link text-teal text-decoration-none mt-auto">Подробнее &rarr;</a>
                  </div>
                </div>
              </div>
          <?php
            endforeach;
          endif;
          ?>
        </div>
      </div>
    </section>
  </main>

  <?php get_footer(); ?>
</div>