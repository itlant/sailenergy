<section class="py-5 bg-light" id="courses">
  <div class="container py-5">
    <div class="text-center mb-5" data-aos="fade-up">
      <h2 class="display-5 fw-bold text-dark">
        Выбери свой <span class="text-teal">курс</span>
      </h2>
      <p class="text-muted w-50 mx-auto">От первого шага до управления собственной яхтой.</p>
    </div>
    <div class="row g-4">
      <?php
      $courses = get_posts(array(
        'post_type' => 'course',
        'posts_per_page' => 3,
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
          <div class="col-md-4">
            <div class="card service-card h-100 p-4 shadow-sm text-center border-0 bg-white rounded-4">
              <div class="card-body d-flex flex-column align-items-center">
                <div class="icon-circle bg-light text-teal mb-4 rounded-circle d-flex align-items-center justify-content-center" style="width: 70px; height: 70px;">
                  <i class="<?php echo esc_attr($icon); ?> fs-2"></i>
                </div>
                <h4 class="card-title fw-bold"><?php echo get_the_title($course); ?></h4>
                <?php if ($level_label) : ?>
                  <span class="badge bg-teal text-white mb-2"><?php echo $level_label; ?></span>
                <?php endif; ?>
                <p class="card-text text-muted"><?php echo wp_trim_words(get_the_excerpt($course), 18); ?></p>
                <a href="<?php echo get_permalink($course); ?>" class="stretched-link text-teal text-decoration-none mt-auto">Подробнее &rarr;</a>
              </div>
            </div>
          </div>
        <?php
        endforeach;
      else :
        ?>
        <div class="col-md-4">
          <div class="card service-card h-100 p-4 shadow-sm text-center border-0 bg-white rounded-4">
            <div class="card-body d-flex flex-column align-items-center">
              <div class="icon-circle bg-light text-teal mb-4 rounded-circle d-flex align-items-center justify-content-center" style="width: 70px; height: 70px;">
                <i class="fas fa-anchor fs-2"></i>
              </div>
              <h4 class="card-title fw-bold">Матрос (Crew)</h4>
              <p class="card-text text-muted">Начальный курс для тех, кто хочет стать полезным членом команды.</p>
              <a href="#" class="stretched-link text-teal text-decoration-none mt-auto">Подробнее &rarr;</a>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card service-card h-100 p-4 shadow-sm text-center border-0 bg-white rounded-4">
            <div class="card-body d-flex flex-column align-items-center">
              <div class="icon-circle bg-light text-teal mb-4 rounded-circle d-flex align-items-center justify-content-center" style="width: 70px; height: 70px;">
                <i class="fas fa-ship fs-2"></i>
              </div>
              <h4 class="card-title fw-bold">Шкипер (Bareboat)</h4>
              <p class="card-text text-muted">14-дневный интенсив в Турции. Получите международную лицензию IYT.</p>
              <a href="#" class="stretched-link text-teal text-decoration-none mt-auto">Подробнее &rarr;</a>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card service-card h-100 p-4 shadow-sm text-center border-0 bg-white rounded-4">
            <div class="card-body d-flex flex-column align-items-center">
              <div class="icon-circle bg-light text-teal mb-4 rounded-circle d-flex align-items-center justify-content-center" style="width: 70px; height: 70px;">
                <i class="fas fa-map-signs fs-2"></i>
              </div>
              <h4 class="card-title fw-bold">Yachtmaster</h4>
              <p class="card-text text-muted">Профессиональный уровень для опытных капитанов.</p>
              <a href="#" class="stretched-link text-teal text-decoration-none mt-auto">Подробнее &rarr;</a>
            </div>
          </div>
        </div>
      <?php endif; ?>
    </div>
  </div>
</section>