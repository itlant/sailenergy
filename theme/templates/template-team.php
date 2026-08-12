<?php

/**
 * Template Name: Команда
 */
?>

<?php get_header(); ?>

<div class="wrapper d-flex flex-column">
  <main>
    <?php sailenergy_breadcrumbs(); ?>

    <section class="py-5 bg-light" id="team-page">
      <div class="container py-5">
        <div class="row mb-5">
          <div class="col-lg-8 mx-auto text-center">
            <h1 class="display-5 fw-bold">
              Наша <span class="text-teal">команда</span>
            </h1>
            <p class="lead text-muted">
              Наши инструкторы — действующие спортсмены, мастера спорта и участники престижных международных регат.
            </p>
          </div>
        </div>

        <div class="row g-4">
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
              <div class="col-lg-3 col-md-6">
                <div class="card instructor-card shadow-sm h-100 border-0 rounded-4 overflow-hidden">
                  <?php if (has_post_thumbnail($instructor->ID)) : ?>
                    <img src="<?php echo get_the_post_thumbnail_url($instructor->ID, 'medium'); ?>" class="card-img-top" alt="<?php echo esc_attr(get_the_title($instructor)); ?>" loading="lazy">
                  <?php else : ?>
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/avatar-placeholder.jpg" class="card-img-top" alt="<?php echo esc_attr(get_the_title($instructor)); ?>" loading="lazy">
                  <?php endif; ?>
                  <div class="card-body text-center bg-white">
                    <h5 class="card-title fw-bold text-dark mb-1"><?php echo get_the_title($instructor); ?></h5>
                    <?php if ($position) : ?>
                      <p class="card-text text-muted small text-uppercase"><?php echo esc_html($position); ?></p>
                    <?php endif; ?>
                    <?php if ($vk || $telegram) : ?>
                      <div class="d-flex justify-content-center gap-3 mt-3">
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
          endif;
          ?>
        </div>
      </div>
    </section>
  </main>

  <?php get_footer(); ?>
</div>