<section class="py-5 bg-light" id="regattas">
  <div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-5 flex-wrap">
      <h2 class="display-5 fw-bold text-dark">
        Календарь <span class="text-teal">регат</span>
      </h2>
      <a href="<?php echo home_url('/regattas/'); ?>" class="btn btn-outline-teal rounded-pill px-4 py-2 border-2 fw-bold">Все мероприятия</a>
    </div>
    <div class="row g-4">
      <?php
      $regattas = get_posts(array(
        'post_type' => 'regatta',
        'posts_per_page' => 4,
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
          <div class="col-md-6 col-lg-3">
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
                <h5 class="card-title fw-bold"><?php echo get_the_title($regatta); ?></h5>
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
        <div class="col-md-6 col-lg-3">
          <div class="card regatta-card bg-white text-dark border-0 h-100 shadow-sm rounded-4 overflow-hidden">
            <div class="position-relative">
              <span class="badge bg-teal text-white position-absolute top-0 start-0 m-3 px-3 py-2 rounded-pill">Май 2026</span>
              <img src="<?php echo get_template_directory_uri(); ?>/assets/img/sailenergy-template-img-6.jpg" class="card-img-top" alt="Open Sailing Week" loading="lazy">
            </div>
            <div class="card-body p-4 d-flex flex-column">
              <h5 class="card-title fw-bold">Open Sailing Week</h5>
              <p class="card-text text-muted small mb-0">Гечек, Турция. Старт сезона.</p>
              <a href="#" class="stretched-link text-teal text-decoration-none mt-auto">Подробнее &rarr;</a>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-3">
          <div class="card regatta-card bg-white text-dark border-0 h-100 shadow-sm rounded-4 overflow-hidden">
            <div class="position-relative">
              <span class="badge bg-teal text-white position-absolute top-0 start-0 m-3 px-3 py-2 rounded-pill">Октябрь</span>
              <img src="<?php echo get_template_directory_uri(); ?>/assets/img/sailenergy-template-img-5.jpg" class="card-img-top" alt="Marmaris Race Week" loading="lazy">
            </div>
            <div class="card-body p-4 d-flex flex-column">
              <h5 class="card-title fw-bold">Marmaris Race Week</h5>
              <p class="card-text text-muted small mb-0">Легендарная регата.</p>
              <a href="#" class="stretched-link text-teal text-decoration-none mt-auto">Подробнее &rarr;</a>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-3">
          <div class="card regatta-card bg-white text-dark border-0 h-100 shadow-sm rounded-4 overflow-hidden">
            <div class="position-relative">
              <span class="badge bg-teal text-white position-absolute top-0 start-0 m-3 px-3 py-2 rounded-pill">Зима</span>
              <img src="<?php echo get_template_directory_uri(); ?>/assets/img/sailenergy-template-img-1.jpg" class="card-img-top" alt="Tenzor Elite Cup" loading="lazy">
            </div>
            <div class="card-body p-4 d-flex flex-column">
              <h5 class="card-title fw-bold">Tenzor Elite Cup</h5>
              <p class="card-text text-muted small mb-0">Зимняя серия в Сочи.</p>
              <a href="#" class="stretched-link text-teal text-decoration-none mt-auto">Подробнее &rarr;</a>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-3">
          <div class="card regatta-card bg-white text-dark border-0 h-100 shadow-sm rounded-4 overflow-hidden">
            <div class="position-relative">
              <span class="badge bg-teal text-white position-absolute top-0 start-0 m-3 px-3 py-2 rounded-pill">Сезон</span>
              <img src="<?php echo get_template_directory_uri(); ?>/assets/img/sailenergy-template-img-2.jpg" class="card-img-top" alt="Корпоративная регата" loading="lazy">
            </div>
            <div class="card-body p-4 d-flex flex-column">
              <h5 class="card-title fw-bold">Корпоративная регата</h5>
              <p class="card-text text-muted small mb-0">Тимбилдинг в Санкт-Петербурге.</p>
              <a href="#" class="stretched-link text-teal text-decoration-none mt-auto">Подробнее &rarr;</a>
            </div>
          </div>
        </div>
      <?php endif; ?>
    </div>
  </div>
</section>