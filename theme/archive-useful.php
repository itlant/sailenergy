<?php

/**
 * Archive для полезных статей с фильтрацией
 */

get_header(); ?>

<div class="wrapper d-flex flex-column min-vh-100">
  <main>
    <?php sailenergy_breadcrumbs(); ?>

    <section class="py-5 bg-light" id="archive-useful">
      <div class="container py-5">
        <div class="row">
          <!-- САЙДБАР С ФИЛЬТРАМИ -->
          <div class="col-lg-3">
            <div class="card border-0 shadow-sm rounded-4 p-4 sticky-top" style="top: 100px">
              <h5 class="fw-bold mb-3">Фильтр</h5>

              <!-- ПОИСК -->
              <div class="mb-3">
                <label class="fw-medium small text-muted mb-1">Поиск по статьям</label>
                <input type="text" class="form-control border-0 bg-light" id="articleSearch" placeholder="Поиск...">
              </div>

              <!-- КАТЕГОРИИ -->
              <div class="mb-3">
                <label class="fw-medium small text-muted mb-1">Рубрика</label>
                <select class="form-select border-0 bg-light" id="categoryFilter">
                  <option value="all">Все рубрики</option>
                  <?php
                  $categories = get_categories(array(
                    'hide_empty' => true,
                    'orderby' => 'name',
                  ));
                  foreach ($categories as $category) {
                    echo '<option value="' . esc_attr($category->term_id) . '">' . esc_html($category->name) . '</option>';
                  }
                  ?>
                </select>
              </div>

              <!-- ТЭГИ -->
              <div class="mb-3">
                <label class="fw-medium small text-muted mb-1">Теги</label>
                <select class="form-select border-0 bg-light" id="tagFilter">
                  <option value="all">Все теги</option>
                  <?php
                  $tags = get_tags(array(
                    'hide_empty' => true,
                    'orderby' => 'name',
                  ));
                  foreach ($tags as $tag) {
                    echo '<option value="' . esc_attr($tag->term_id) . '">' . esc_html($tag->name) . '</option>';
                  }
                  ?>
                </select>
              </div>

              <!-- ДАТА -->
              <div class="mb-3">
                <label class="fw-medium small text-muted mb-1">Сортировка</label>
                <select class="form-select border-0 bg-light" id="sortFilter">
                  <option value="newest">Сначала новые</option>
                  <option value="oldest">Сначала старые</option>
                  <option value="popular">По популярности</option>
                </select>
              </div>

              <button class="btn btn-teal w-100" id="applyFilters">Применить</button>
              <button class="btn btn-outline-teal w-100 mt-2" id="resetFilters">Сбросить</button>
            </div>
          </div>

          <!-- КОНТЕНТ -->
          <div class="col-lg-9">
            <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap">
              <h1 class="display-5 fw-bold">
                <?php
                if (is_category()) {
                  echo single_cat_title('', false);
                } elseif (is_tag()) {
                  echo 'Тег: ' . single_tag_title('', false);
                } elseif (is_search()) {
                  echo 'Результаты поиска: ' . get_search_query();
                } else {
                  echo 'Полезные <span class="text-teal">статьи</span>';
                }
                ?>
              </h1>
              <span class="badge bg-teal text-white px-3 py-2" id="postsCount">
                <?php echo $wp_query->found_posts; ?> статей
              </span>
            </div>

            <div class="row g-4" id="postsContainer">
              <?php if (have_posts()) : ?>
                <?php while (have_posts()) : the_post(); ?>
                  <div class="col-md-6 col-lg-4 post-item"
                    data-category="<?php echo implode(',', wp_get_post_categories(get_the_ID(), array('fields' => 'ids'))); ?>"
                    data-tags="<?php echo implode(',', wp_get_post_tags(get_the_ID(), array('fields' => 'ids'))); ?>"
                    data-date="<?php echo get_the_date('U'); ?>"
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

                        <?php $tags = get_the_tags(); ?>
                        <?php if ($tags) : ?>
                          <div class="mb-2">
                            <?php foreach ($tags as $tag) : ?>
                              <span class="badge bg-light text-dark border">#<?php echo esc_html($tag->name); ?></span>
                            <?php endforeach; ?>
                          </div>
                        <?php endif; ?>

                        <a href="<?php the_permalink(); ?>" class="stretched-link text-teal text-decoration-none mt-auto">
                          Читать &rarr;
                        </a>
                      </div>
                    </div>
                  </div>
                <?php endwhile; ?>
              <?php else : ?>
                <div class="col-12 text-center py-5">
                  <i class="fas fa-search text-muted fs-1 mb-3"></i>
                  <p class="text-muted">Статьи не найдены. Попробуйте изменить параметры фильтра.</p>
                </div>
              <?php endif; ?>
            </div>

            <!-- ПАГИНАЦИЯ -->
            <?php sailenergy_pagination(); ?>
          </div>
        </div>
      </div>
    </section>
  </main>

  <?php get_footer(); ?>
</div>

<!-- JavaScript для фильтрации (AJAX) -->
<script>
  document.addEventListener('DOMContentLoaded', function() {
    const postsContainer = document.getElementById('postsContainer');
    const searchInput = document.getElementById('articleSearch');
    const categoryFilter = document.getElementById('categoryFilter');
    const tagFilter = document.getElementById('tagFilter');
    const sortFilter = document.getElementById('sortFilter');
    const applyBtn = document.getElementById('applyFilters');
    const resetBtn = document.getElementById('resetFilters');
    const postsCount = document.getElementById('postsCount');

    function filterPosts() {
      const searchTerm = searchInput.value.toLowerCase().trim();
      const category = categoryFilter.value;
      const tag = tagFilter.value;
      const sort = sortFilter.value;

      const posts = postsContainer.querySelectorAll('.post-item');
      let visibleCount = 0;

      // Собираем видимые посты в массив для сортировки
      let visiblePosts = [];

      posts.forEach(post => {
        const title = post.dataset.title || '';
        const postCategories = post.dataset.category ? post.dataset.category.split(',').map(Number) : [];
        const postTags = post.dataset.tags ? post.dataset.tags.split(',').map(Number) : [];
        const date = parseInt(post.dataset.date) || 0;

        let show = true;

        // Поиск по заголовку
        if (searchTerm && !title.includes(searchTerm)) {
          show = false;
        }

        // Фильтр по категории
        if (show && category !== 'all' && !postCategories.includes(parseInt(category))) {
          show = false;
        }

        // Фильтр по тегу
        if (show && tag !== 'all' && !postTags.includes(parseInt(tag))) {
          show = false;
        }

        // Применяем фильтр
        if (show) {
          post.style.display = 'block';
          visibleCount++;
          visiblePosts.push({
            element: post,
            date: date
          });
        } else {
          post.style.display = 'none';
        }
      });

      // Сортировка
      if (sort === 'newest') {
        visiblePosts.sort((a, b) => b.date - a.date);
      } else if (sort === 'oldest') {
        visiblePosts.sort((a, b) => a.date - b.date);
      }

      // Переставляем элементы в DOM
      if (sort === 'newest' || sort === 'oldest') {
        visiblePosts.forEach((item, index) => {
          postsContainer.appendChild(item.element);
        });
      }

      // Обновляем счетчик
      if (postsCount) {
        postsCount.textContent = visibleCount + ' статей';
      }

      // Показываем сообщение, если ничего не найдено
      const noResults = postsContainer.querySelector('.no-results');
      if (visibleCount === 0) {
        if (!noResults) {
          const msg = document.createElement('div');
          msg.className = 'col-12 text-center py-5 no-results';
          msg.innerHTML = '<i class="fas fa-search text-muted fs-1 mb-3"></i><p class="text-muted">По вашему запросу ничего не найдено.</p>';
          postsContainer.appendChild(msg);
        }
      } else {
        if (noResults) noResults.remove();
      }
    }

    // Применить фильтры
    applyBtn.addEventListener('click', filterPosts);

    // Автоматический поиск при вводе (с задержкой)
    let searchTimeout;
    searchInput.addEventListener('input', function() {
      clearTimeout(searchTimeout);
      searchTimeout = setTimeout(filterPosts, 300);
    });

    // Сброс фильтров
    resetBtn.addEventListener('click', function() {
      searchInput.value = '';
      categoryFilter.value = 'all';
      tagFilter.value = 'all';
      sortFilter.value = 'newest';
      filterPosts();
    });

    // Фильтрация при изменении select'ов
    [categoryFilter, tagFilter, sortFilter].forEach(el => {
      el.addEventListener('change', filterPosts);
    });

    // Инициализация: показываем все посты
    filterPosts();
  });
</script>