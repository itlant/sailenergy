<?php get_header(); ?>

<div class="wrapper d-flex flex-column">
  <main>
    <?php sailenergy_breadcrumbs(); ?>

    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

        <?php
        $post_type = get_post_type();
        $post_type_labels = array(
          'post' => 'Статья',
          'regatta' => 'Регата',
          'course' => 'Курс',
          'instructor' => 'Инструктор',
          'faq' => 'FAQ',
        );
        $post_type_label = $post_type_labels[$post_type] ?? 'Запись';
        ?>

        <?php if ($post_type !== 'faq') : ?>
          <section class="hero-section position-relative overflow-hidden" style="min-height: 50vh; max-height: 500px;">
            <?php if (has_post_thumbnail()) : ?>
              <img src="<?php the_post_thumbnail_url('large'); ?>"
                class="position-absolute top-0 start-0 w-100 h-100 object-fit-cover"
                alt="<?php the_title(); ?>">
            <?php else : ?>
              <img src="<?php echo get_template_directory_uri(); ?>/assets/img/sailenergy-template-img-6.jpg"
                class="position-absolute top-0 start-0 w-100 h-100 object-fit-cover"
                alt="Заголовок">
            <?php endif; ?>
            <div class="hero-overlay"></div>
            <div class="container position-relative z-2 h-100">
              <div class="row align-items-center h-100">
                <div class="col-lg-8">
                  <!-- <span class="badge bg-teal text-white mb-3 px-3 py-2 rounded-pill">
                    <?php echo esc_html($post_type_label); ?>
                  </span> -->
                  <h1 class="display-4 fw-bold text-white mb-3"><?php the_title(); ?></h1>
                  <?php if ($post_type === 'regatta') : ?>
                    <div class="d-flex flex-wrap gap-3 text-white">
                      <?php $date = get_field('regatta_date'); ?>
                      <?php if ($date) : ?>
                        <span><i class="far fa-calendar-alt me-1"></i> <?php echo esc_html($date); ?></span>
                      <?php endif; ?>
                      <?php $location = get_field('regatta_location'); ?>
                      <?php if ($location) : ?>
                        <span><i class="fas fa-map-marker-alt me-1"></i> <?php echo esc_html($location); ?></span>
                      <?php endif; ?>
                    </div>
                  <?php endif; ?>
                  <?php if ($post_type === 'instructor') : ?>
                    <?php $position = get_field('instructor_position'); ?>
                    <?php if ($position) : ?>
                      <p class="lead text-white"><?php echo esc_html($position); ?></p>
                    <?php endif; ?>
                  <?php endif; ?>
                </div>
              </div>
            </div>
          </section>
        <?php endif; ?>

        <section class="py-5 bg-white">
          <div class="container py-3">
            <div class="row justify-content-center">
              <div class="col-lg-8">

                <?php if ($post_type === 'post') : ?>
                  <div class="mb-4 d-flex flex-wrap gap-3 text-muted small">
                    <span><i class="far fa-calendar-alt me-1"></i> <?php echo get_the_date(); ?></span>
                    <span><i class="far fa-user me-1"></i> <?php the_author(); ?></span>
                    <?php $categories = get_the_category(); ?>
                    <?php if ($categories) : ?>
                      <span><i class="far fa-folder me-1"></i>
                        <?php foreach ($categories as $cat) : ?>
                          <a href="<?php echo get_category_link($cat->term_id); ?>" class="text-decoration-none text-teal"><?php echo $cat->name; ?></a>
                          <?php if (end($categories) !== $cat) echo ', '; ?>
                        <?php endforeach; ?>
                      </span>
                    <?php endif; ?>
                  </div>
                <?php endif; ?>

                <?php if ($post_type === 'course') : ?>

                  <?php $level = get_field('course_level'); ?>
                  <?php $duration = get_field('course_duration'); ?>
                  <?php $price = get_field('course_price'); ?>
                  <?php $syllabus = get_field('course_syllabus'); ?>

                  <div class="card border-0 shadow-sm rounded-4 p-4 mb-4 bg-light">
                    <div class="row g-3">
                      <?php if ($level) : ?>
                        <div class="col-md-4">
                          <span class="text-muted small text-uppercase d-block">Уровень</span>
                          <span class="fw-bold">
                            <?php
                            $level_labels = array(
                              'start' => '🟢 Новичок',
                              'pro' => '🔵 Опытный',
                              'master' => '🔴 Профи (Yachtmaster)'
                            );
                            echo $level_labels[$level] ?? $level;
                            ?>
                          </span>
                        </div>
                      <?php endif; ?>
                      <?php if ($duration) : ?>
                        <div class="col-md-4">
                          <span class="text-muted small text-uppercase d-block">Длительность</span>
                          <span class="fw-bold"><?php echo esc_html($duration); ?></span>
                        </div>
                      <?php endif; ?>
                      <?php if ($price) : ?>
                        <div class="col-md-4">
                          <span class="text-muted small text-uppercase d-block">Стоимость</span>
                          <span class="fw-bold text-teal"><?php echo esc_html($price); ?></span>
                        </div>
                      <?php endif; ?>
                    </div>
                  </div>

                  <?php if ($syllabus) : ?>
                    <h2 class="fw-bold mb-3">Программа курса</h2>
                    <div class="text-muted mb-4"><?php echo $syllabus; ?></div>
                  <?php endif; ?>

                  <div class="text-muted"><?php the_content(); ?></div>

                  <div class="mt-4">
                    <a href="#" class="btn btn-teal rounded-pill px-5" data-bs-toggle="modal" data-bs-target="#callbackModal">Записаться на курс</a>
                  </div>

                <?php elseif ($post_type === 'regatta') : ?>
                  <?php $date = get_field('regatta_date'); ?>
                  <?php $location = get_field('regatta_location'); ?>
                  <?php $badge = get_field('regatta_badge'); ?>
                  <?php $gallery = get_field('regatta_gallery'); ?>
                  <?php $register_link = get_field('regatta_register_link'); ?>

                  <div class="card border-0 shadow-sm rounded-4 p-4 mb-4 bg-light">
                    <div class="row g-3">
                      <?php if ($date) : ?>
                        <div class="col-md-6">
                          <span class="text-muted small text-uppercase d-block">Дата проведения</span>
                          <span class="fw-bold"><i class="far fa-calendar-alt me-1"></i> <?php echo esc_html($date); ?></span>
                        </div>
                      <?php endif; ?>
                      <?php if ($location) : ?>
                        <div class="col-md-6">
                          <span class="text-muted small text-uppercase d-block">Место проведения</span>
                          <span class="fw-bold"><i class="fas fa-map-marker-alt me-1"></i> <?php echo esc_html($location); ?></span>
                        </div>
                      <?php endif; ?>
                      <?php if ($badge) : ?>
                        <div class="col-12">
                          <span class="badge bg-teal text-white px-3 py-2 rounded-pill"><?php echo esc_html($badge); ?></span>
                        </div>
                      <?php endif; ?>
                    </div>
                  </div>

                  <div class="text-muted"><?php the_content(); ?></div>

                  <?php if ($gallery) : ?>
                    <h3 class="fw-bold mt-5 mb-3">Галерея</h3>
                    <div class="row g-2">
                      <?php foreach ($gallery as $image) : ?>
                        <div class="col-6 col-md-4">
                          <a href="<?php echo esc_url($image['url']); ?>" data-fancybox="gallery">
                            <img src="<?php echo esc_url($image['sizes']['medium']); ?>" class="img-fluid rounded-3" alt="<?php echo esc_attr($image['alt']); ?>">
                          </a>
                        </div>
                      <?php endforeach; ?>
                    </div>
                  <?php endif; ?>

                  <?php if ($register_link) : ?>
                    <div class="mt-4">
                      <a href="<?php echo esc_url($register_link); ?>" class="btn btn-teal rounded-pill px-5" target="_blank">Зарегистрироваться</a>
                    </div>
                  <?php endif; ?>

                <?php elseif ($post_type === 'instructor') : ?>
                  <?php $position = get_field('instructor_position'); ?>
                  <?php $achievements = get_field('instructor_achievements'); ?>
                  <?php $vk = get_field('instructor_social_vk'); ?>
                  <?php $telegram = get_field('instructor_social_telegram'); ?>

                  <?php if ($position) : ?>
                    <div class="card border-0 shadow-sm rounded-4 p-4 mb-4 bg-light">
                      <span class="text-muted small text-uppercase d-block">Должность</span>
                      <span class="fw-bold"><?php echo esc_html($position); ?></span>
                    </div>
                  <?php endif; ?>

                  <?php if ($achievements) : ?>
                    <h3 class="fw-bold mb-3">Достижения</h3>
                    <p class="text-muted"><?php echo nl2br(esc_html($achievements)); ?></p>
                  <?php endif; ?>

                  <div class="text-muted"><?php the_content(); ?></div>

                  <?php if ($vk || $telegram) : ?>
                    <div class="mt-4 d-flex gap-3">
                      <span class="fw-bold">Социальные сети:</span>
                      <?php if ($vk) : ?>
                        <a href="<?php echo esc_url($vk); ?>" class="text-teal fs-4" target="_blank"><i class="fab fa-vk"></i></a>
                      <?php endif; ?>
                      <?php if ($telegram) : ?>
                        <a href="<?php echo esc_url($telegram); ?>" class="text-teal fs-4" target="_blank"><i class="fab fa-telegram"></i></a>
                      <?php endif; ?>
                    </div>
                  <?php endif; ?>

                <?php elseif ($post_type === 'faq') : ?>
                  <?php $answer = get_field('faq_answer'); ?>
                  <div class="card border-0 shadow-sm rounded-4 p-4 bg-light mb-4">
                    <h3 class="fw-bold text-dark mb-3"><?php the_title(); ?></h3>
                    <div class="text-muted"><?php echo $answer ?: 'Ответ на этот вопрос скоро появится.'; ?></div>
                  </div>

                <?php else : ?>
                  <!-- <?php if (has_post_thumbnail()) : ?>
                    <div class="mb-4">
                      <img src="<?php the_post_thumbnail_url('large'); ?>" class="img-fluid rounded-4 shadow-sm" alt="<?php the_title(); ?>">
                    </div>
                  <?php endif; ?> -->

                  <div class="content-body text-muted">
                    <?php the_content(); ?>
                  </div>

                  <?php wp_link_pages(array(
                    'before' => '<div class="page-links">' . __('Страницы:', 'sailenergy'),
                    'after' => '</div>',
                  )); ?>

                  <?php if (get_the_tags()) : ?>
                    <div class="mt-5 pt-4 border-top">
                      <div class="d-flex flex-wrap gap-2">
                        <?php the_tags('<span class="badge bg-light text-dark border">', '</span><span class="badge bg-light text-dark border">', '</span>'); ?>
                      </div>
                    </div>
                  <?php endif; ?>

                <?php endif; ?>

                <nav class="mt-5 pt-4 border-top d-flex justify-content-between">
                  <div class="prev-post">
                    <?php previous_post_link('%link', '← %title'); ?>
                  </div>
                  <div class="next-post">
                    <?php next_post_link('%link', '%title →'); ?>
                  </div>
                </nav>

                <?php if ($post_type === 'post' && comments_open()) : ?>
                  <div class="mt-5 pt-4 border-top">
                    <?php comments_template(); ?>
                  </div>
                <?php endif; ?>

              </div>

              <?php if ($post_type === 'post') : ?>
                <div class="col-lg-4">
                  <?php get_sidebar(); ?>
                </div>
              <?php endif; ?>
            </div>
          </div>
        </section>

        <?php if (in_array($post_type, array('post', 'regatta', 'course'))) : ?>
          <section class="py-5 bg-light">
            <div class="container py-3">
              <h2 class="display-5 fw-bold text-center mb-4">
                <?php
                $related_labels = array(
                  'post' => 'Похожие статьи',
                  'regatta' => 'Другие регаты',
                  'course' => 'Другие курсы'
                );
                echo $related_labels[$post_type] ?? 'Похожие записи';
                ?>
              </h2>
              <div class="row g-4">
                <?php
                $tax_query = array();
                if ($post_type === 'post') {
                  $categories = get_the_category();
                  if ($categories) {
                    $tax_query = array(
                      array(
                        'taxonomy' => 'category',
                        'field' => 'term_id',
                        'terms' => $categories[0]->term_id,
                      )
                    );
                  }
                } elseif ($post_type === 'regatta') {
                  $terms = get_the_terms(get_the_ID(), 'regatta_type');
                  if ($terms) {
                    $tax_query = array(
                      array(
                        'taxonomy' => 'regatta_type',
                        'field' => 'term_id',
                        'terms' => $terms[0]->term_id,
                      )
                    );
                  }
                } elseif ($post_type === 'course') {
                  $terms = get_the_terms(get_the_ID(), 'course_level');
                  if ($terms) {
                    $tax_query = array(
                      array(
                        'taxonomy' => 'course_level',
                        'field' => 'term_id',
                        'terms' => $terms[0]->term_id,
                      )
                    );
                  }
                }

                $related = get_posts(array(
                  'post_type' => $post_type,
                  'posts_per_page' => 3,
                  'post__not_in' => array(get_the_ID()),
                  'tax_query' => $tax_query,
                ));

                if ($related) :
                  foreach ($related as $post) : setup_postdata($post); ?>
                    <div class="col-md-4">
                      <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden">
                        <?php if (has_post_thumbnail()) : ?>
                          <img src="<?php the_post_thumbnail_url('medium'); ?>" class="card-img-top" style="height: 200px; object-fit: cover;" alt="<?php the_title(); ?>">
                        <?php endif; ?>
                        <div class="card-body p-4 d-flex flex-column">
                          <h3 class="card-title fw-bold"><?php the_title(); ?></h3>
                          <p class="card-text text-muted small"><?php echo wp_trim_words(get_the_excerpt(), 15); ?></p>
                          <a href="<?php the_permalink(); ?>" class="stretched-link text-teal text-decoration-none mt-auto">Подробнее &rarr;</a>
                        </div>
                      </div>
                    </div>
                  <?php endforeach;
                  wp_reset_postdata();
                else : ?>
                  <p class="text-center text-muted">Похожих записей пока нет.</p>
                <?php endif; ?>
              </div>
            </div>
          </section>
        <?php endif; ?>

    <?php endwhile;
    endif; ?>
  </main>

  <?php get_footer(); ?>
</div>