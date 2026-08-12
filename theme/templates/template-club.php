<?php

/**
 * Template Name: О клубе
 */
?>

<?php get_header(); ?>

<div class="wrapper d-flex flex-column">
  <main>
    <?php sailenergy_breadcrumbs(); ?>

    <section class="py-5 bg-light" id="club">
      <div class="container py-5">
        <div class="row align-items-center g-5 mb-5">
          <div class="col-lg-6">
            <h1 class="display-4 fw-bold mb-4">
              О клубе <span class="text-teal">SAIL ENERGY</span>
            </h1>
            <p class="lead text-muted mb-4">
              <?php echo get_field('club_description') ? wp_trim_words(get_field('club_description'), 20) : 'Мы — сообщество профессионалов и любителей, объединенных любовью к морю и ветру.'; ?>
            </p>
            <p class="text-muted">
              Наш клуб базируется в Санкт-Петербурге, но мы организуем регаты по всему миру: от Турции до Сочи.
            </p>
          </div>
          <div class="col-lg-6">
            <?php $hero_image = get_field('club_hero_image'); ?>
            <img src="<?php echo $hero_image ?: get_template_directory_uri() . '/assets/img/sailenergy-template-img-6.jpg'; ?>"
              class="img-fluid rounded-4 shadow-lg"
              alt="О клубе">
          </div>
        </div>

        <div class="row text-center g-4">
          <div class="col-md-4">
            <div class="p-4 bg-white rounded-4 shadow-sm">
              <span class="display-5 fw-bold text-teal"><?php echo get_field('club_experience') ?: '25'; ?>+</span>
              <p class="text-muted small mt-2">Лет опыта</p>
            </div>
          </div>
          <div class="col-md-4">
            <div class="p-4 bg-white rounded-4 shadow-sm">
              <span class="display-5 fw-bold text-teal"><?php echo get_field('club_graduates') ?: '100'; ?>+</span>
              <p class="text-muted small mt-2">Выпускников</p>
            </div>
          </div>
          <div class="col-md-4">
            <div class="p-4 bg-white rounded-4 shadow-sm">
              <span class="display-5 fw-bold text-teal"><?php echo get_field('club_regattas_count') ?: '50'; ?>+</span>
              <p class="text-muted small mt-2">Проведенных регат</p>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>

  <?php get_footer(); ?>
</div>