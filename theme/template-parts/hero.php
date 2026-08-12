<section class="hero-section position-relative overflow-hidden">
  <!-- ФОНОВОЕ ВИДЕО -->
  <video class="hero-video" autoplay loop muted playsinline poster="<?php echo get_template_directory_uri(); ?>/assets/img/hero-fallback.jpg">
    <source src="<?php echo get_template_directory_uri(); ?>/assets/img/hero-bg-max.mp4" type="video/mp4">
    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/hero-fallback.jpg" alt="Video fallback" style="width: 100%; height: 100%; object-fit: cover;">
  </video>

  <div class="hero-overlay"></div>

  <div class="container position-relative z-2">
    <div class="row">
      <div class="col-lg-8">
        <h1 class="display-3 fw-bold mb-4 text-white">
          <?php echo get_field('hero_title', 'option') ?: 'Обучение, регаты и путешествия под парусом'; ?>
        </h1>
        <p class="lead mb-5 text-white w-75">
          <?php echo get_field('hero_subtitle', 'option') ?: 'Парусный клуб SAIL ENERGY — это место, где обучение превращается в приключение, а гонки — в образ жизни.'; ?>
        </p>
        <div class="d-flex flex-wrap gap-3">
          <a href="<?php echo home_url('/courses/'); ?>" class="btn btn-teal btn-lg rounded-pill px-5">Пройти обучение</a>
          <a href="<?php echo home_url('/regattas/'); ?>" class="btn btn-outline-light btn-lg rounded-pill px-5 border-2">Хочу на регату</a>
        </div>
      </div>
    </div>
  </div>
</section>