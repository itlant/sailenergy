<section class="py-5" id="team">
  <div class="container py-5">
    <h2 class="display-5 fw-bold text-center mb-5 text-dark">
      Наша <span class="text-teal">команда</span>
    </h2>

    <div class="owl-carousel owl-theme team-carousel">
      <?php
      $instructors = get_posts(array(
        'post_type' => 'instructor',
        'posts_per_page' => -1,
        'orderby' => 'menu_order',
        'order' => 'ASC',
      ));

      if ($instructors) :
        foreach ($instructors as $instructor) :
          $position = get_field('instructor_position', $instructor->ID);
          $vk = get_field('instructor_social_vk', $instructor->ID);
          $telegram = get_field('instructor_social_telegram', $instructor->ID);
      ?>
          <div class="item">
            <div class="card instructor-card shadow-sm h-100 border-0 rounded-4 overflow-hidden">
              <?php if (has_post_thumbnail($instructor->ID)) : ?>
                <img src="<?php echo get_the_post_thumbnail_url($instructor->ID, 'medium'); ?>" class="card-img-top" alt="<?php echo esc_attr(get_the_title($instructor)); ?>" loading="lazy">
              <?php else : ?>
                <img src="<?php echo get_template_directory_uri(); ?>/assets/img/avatar-placeholder.jpg" class="card-img-top" alt="<?php echo esc_attr(get_the_title($instructor)); ?>" loading="lazy">
              <?php endif; ?>
              <div class="card-body text-center bg-white">
                <h3 class="card-title fw-bold text-dark mb-1"><?php echo get_the_title($instructor); ?></h3>
                <?php if ($position) : ?>
                  <p class="card-text text-muted small text-uppercase"><?php echo esc_html($position); ?></p>
                <?php endif; ?>
                <?php if ($vk || $telegram) : ?>
                  <div class="d-flex justify-content-center gap-3 mt-2">
                    <?php if ($vk) : ?>
                      <a href="<?php echo esc_url($vk); ?>" class="text-teal" target="_blank"><i class="fab fa-vk"></i></a>
                    <?php endif; ?>
                    <?php if ($telegram) : ?>
                      <a href="<?php echo esc_url($telegram); ?>" class="text-teal" target="_blank"><i class="fab fa-telegram"></i></a>
                    <?php endif; ?>
                  </div>
                <?php endif; ?>
                <a href="<?php echo get_permalink($instructor); ?>" class="stretched-link text-teal text-decoration-none mt-auto">Подробнее &rarr;</a>
              </div>
            </div>
          </div>
        <?php
        endforeach;
      else :
        ?>
        <div class="item">
          <div class="card instructor-card shadow-sm h-100 border-0 rounded-4 overflow-hidden">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/sailenergy-egor-ignatenko.jpg" class="card-img-top" alt="Егор Игнатенко" loading="lazy">
            <div class="card-body text-center bg-white">
              <h3 class="card-title fw-bold text-dark mb-1">Егор Игнатенко</h3>
              <p class="card-text text-muted small text-uppercase">Основатель, Мастер спорта</p>
              <a href="#" class="stretched-link text-teal text-decoration-none mt-auto">Подробнее &rarr;</a>
            </div>
          </div>
        </div>
        <div class="item">
          <div class="card instructor-card shadow-sm h-100 border-0 rounded-4 overflow-hidden">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/sailenergy-roman-konstantinov.jpg" class="card-img-top" alt="Роман Константинов" loading="lazy">
            <div class="card-body text-center bg-white">
              <h3 class="card-title fw-bold text-dark mb-1">Роман Константинов</h3>
              <p class="card-text text-muted small text-uppercase">Чемпион мира ORC</p>
              <a href="#" class="stretched-link text-teal text-decoration-none mt-auto">Подробнее &rarr;</a>
            </div>
          </div>
        </div>
        <div class="item">
          <div class="card instructor-card shadow-sm h-100 border-0 rounded-4 overflow-hidden">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/sailenergy-evgenii-egorov.jpg" class="card-img-top" alt="Евгений Егоров" loading="lazy">
            <div class="card-body text-center bg-white">
              <h3 class="card-title fw-bold text-dark mb-1">Евгений Егоров</h3>
              <p class="card-text text-muted small text-uppercase">Мастер спорта</p>
              <a href="#" class="stretched-link text-teal text-decoration-none mt-auto">Подробнее &rarr;</a>
            </div>
          </div>
        </div>
        <div class="item">
          <div class="card instructor-card shadow-sm h-100 border-0 rounded-4 overflow-hidden">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/sailenergy-mikhail-soldatov.jpg" class="card-img-top" alt="Михаил Солдатов" loading="lazy">
            <div class="card-body text-center bg-white">
              <h3 class="card-title fw-bold text-dark mb-1">Михаил Солдатов</h3>
              <p class="card-text text-muted small text-uppercase">Яхтсмен года 2010</p>
              <a href="#" class="stretched-link text-teal text-decoration-none mt-auto">Подробнее &rarr;</a>
            </div>
          </div>
        </div>
      <?php endif; ?>
    </div>
  </div>
</section>