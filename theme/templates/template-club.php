<?php

/**
 * Template Name: О клубе
 */

get_header(); ?>

<div class="wrapper d-flex flex-column">
  <main>
    <?php sailenergy_breadcrumbs(); ?>

    <section class="py-5 bg-light" id="club">
      <div class="container py-5">
        <!-- HERO БЛОК -->
        <div class="row align-items-center g-5 mb-5">
          <div class="col-lg-6">
            <h1 class="display-4 fw-bold mb-4">
              <?php echo get_field('club_hero_title') ?: 'О клубе <span class="text-teal">SAIL ENERGY</span>'; ?>
            </h1>
            <p class="lead text-muted mb-4">
              <?php echo get_field('club_hero_text') ?: 'Мы — сообщество профессионалов и любителей, объединенных любовью к морю и ветру.'; ?>
            </p>
            <p class="text-muted">
              Наш клуб базируется в Санкт-Петербурге, но мы организуем регаты по всему миру: от Турции до Сочи. Мы учим яхтингу с нуля и готовим к участию в международных гонках.
            </p>
          </div>
          <div class="col-lg-6">
            <?php
            $hero_image = get_field('club_hero_image');
            $default_image = get_template_directory_uri() . '/assets/img/sailenergy-template-img-6.jpg';
            ?>
            <img src="<?php echo $hero_image ?: $default_image; ?>"
              class="img-fluid rounded-4 shadow-lg"
              alt="О клубе">
          </div>
        </div>

        <!-- СТАТИСТИКА -->
        <?php
        $stats_title = get_field('club_stats_title');
        if ($stats_title) :
        ?>
          <h2 class="text-center display-6 fw-bold mb-4"><?php echo esc_html($stats_title); ?></h2>
        <?php endif; ?>

        <div class="row text-center g-4">
          <div class="col-md-4">
            <div class="p-4 bg-white rounded-4 shadow-sm">
              <span class="display-5 fw-bold text-teal">
                <?php echo get_field('club_experience') ?: '25'; ?>+
              </span>
              <p class="text-muted small mt-2">
                <?php echo get_field('club_experience_label') ?: 'Лет опыта'; ?>
              </p>
            </div>
          </div>
          <div class="col-md-4">
            <div class="p-4 bg-white rounded-4 shadow-sm">
              <span class="display-5 fw-bold text-teal">
                <?php echo get_field('club_graduates') ?: '100'; ?>+
              </span>
              <p class="text-muted small mt-2">
                <?php echo get_field('club_graduates_label') ?: 'Выпускников'; ?>
              </p>
            </div>
          </div>
          <div class="col-md-4">
            <div class="p-4 bg-white rounded-4 shadow-sm">
              <span class="display-5 fw-bold text-teal">
                <?php echo get_field('club_regattas_count') ?: '50'; ?>+
              </span>
              <p class="text-muted small mt-2">
                <?php echo get_field('club_regattas_label') ?: 'Проведенных регат'; ?>
              </p>
            </div>
          </div>
        </div>

        <!-- ПОЛНОЕ ОПИСАНИЕ -->
        <?php
        $description = get_field('club_description');
        if ($description) :
        ?>
          <div class="row mt-5 pt-4 border-top">
            <div class="col-12">
              <?php
              $desc_title = get_field('club_description_title');
              if ($desc_title) :
              ?>
                <h2 class="fw-bold mb-4"><?php echo esc_html($desc_title); ?></h2>
              <?php endif; ?>
              <div class="text-muted">
                <?php echo $description; ?>
              </div>
            </div>
          </div>
        <?php endif; ?>
      </div>
    </section>
  </main>

  <?php get_footer(); ?>
</div>