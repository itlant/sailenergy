<?php get_header(); ?>

<div class="wrapper d-flex flex-column min-vh-100">
  <main>
    <?php sailenergy_breadcrumbs(); ?>

    <section class="py-5 bg-light" id="archive-page">
      <div class="container py-5">
        <div class="row">
          <div class="col-lg-3">
            <div class="card border-0 shadow-sm rounded-4 p-4 sticky-top" style="top: 100px">
              <h5 class="fw-bold mb-3">Фильтр</h5>

              <div class="mb-3">
                <label class="fw-medium small text-muted mb-1">Поиск</label>
                <input type="text" class="form-control border-0 bg-light" id="articleSearch" placeholder="Поиск...">
              </div>

              <div class="mb-3">
                <label class="fw-medium small text-muted mb-1">Рубрика</label>
                <select class="form-select border-0 bg-light" id="categoryFilter">
                  <option value="all">Все рубрики</option>
                  <?php
                  $categories = get_categories(array('hide_empty' => true));
                  foreach ($categories as $cat) {
                    echo '<option value="' . esc_attr($cat->term_id) . '" ' . (is_category($cat->term_id) ? 'selected' : '') . '>' . esc_html($cat->name) . '</option>';
                  }
                  ?>
                </select>
              </div>

              <button class="btn btn-teal w-100" id="applyFilters">Применить</button>
            </div>
          </div>

          <div class="col-lg-9">
            <h1 class="display-5 fw-bold mb-4">
              <?php
              if (is_category()) {
                echo 'Все статьи в рубрике <span class="text-teal">' . single_cat_title('', false) . '</span>';
              } elseif (is_tag()) {
                echo 'Статьи с тегом <span class="text-teal">' . single_tag_title('', false) . '</span>';
              } else {
                echo 'Полезные <span class="text-teal">статьи</span>';
              }
              ?>
            </h1>

            <div class="row g-4" id="postsContainer">
              <?php if (have_posts()) : ?>
                <?php while (have_posts()) : the_post(); ?>
                  <div class="col-md-6 col-lg-4 post-item"
                    data-category="<?php echo implode(',', wp_get_post_categories(get_the_ID(), array('fields' => 'ids'))); ?>"
                    data-title="<?php echo esc_attr(strtolower(get_the_title())); ?>">

                    <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden">
                      <?php if (has_post_thumbnail()) : ?>
                        <img src="<?php the_post_thumbnail_url('medium'); ?>"
                          class="card-img-top"
                          style="height: 200px; object-fit: cover;"
                          alt="<?php the_title(); ?>"
                          loading="lazy">
                      <?php else : ?>
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/sailenergy-template-img-1.jpg"
                          class="card-img-top"
                          style="height: 200px; object-fit: cover;"
                          alt="<?php the_title(); ?>"
                          loading="lazy">
                      <?php endif; ?>

                      <div class="card-body p-4 d-flex flex-column">
                        <div class="mb-2">
                          <?php $categories = get_the_category(); ?>
                          <?php if ($categories) : ?>
                            <span class="badge bg-teal text-white"><?php echo esc_html($categories[0]->name); ?></span>
                          <?php endif; ?>
                          <span class="text-muted small ms-2">
                            <i class="far fa-calendar-alt me-1"></i><?php echo get_the_date('d.m.Y'); ?>
                          </span>
                        </div>

                        <h5 class="card-title fw-bold">
                          <a href="<?php the_permalink(); ?>" class="text-decoration-none text-dark hover-teal">
                            <?php the_title(); ?>
                          </a>
                        </h5>

                        <p class="card-text text-muted small flex-grow-1">
                          <?php echo wp_trim_words(get_the_excerpt(), 15); ?>
                        </p>

                        <a href="<?php the_permalink(); ?>" class="stretched-link text-teal text-decoration-none mt-auto">
                          Читать &rarr;
                        </a>
                      </div>
                    </div>
                  </div>
                <?php endwhile; ?>
              <?php else : ?>
                <div class="col-12 text-center py-5">
                  <p class="text-muted">Статьи не найдены.</p>
                </div>
              <?php endif; ?>
            </div>

            <?php sailenergy_pagination(); ?>
          </div>
        </div>
      </div>
    </section>
  </main>

  <?php get_footer(); ?>
</div>