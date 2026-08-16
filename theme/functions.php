<?php

/**
 * SAIL ENERGY Theme Functions
 */

// ============================================
// 1. НАСТРОЙКИ ТЕМЫ
// ============================================

function sailenergy_setup()
{
  // Поддержка заголовков
  add_theme_support('title-tag');

  // Поддержка миниатюр
  add_theme_support('post-thumbnails');

  // Поддержка логотипа
  add_theme_support('custom-logo', array(
    'height'      => 100,
    'width'       => 400,
    'flex-height' => true,
    'flex-width'  => true,
  ));

  // Поддержка HTML5
  add_theme_support('html5', array(
    'search-form',
    'comment-form',
    'comment-list',
    'gallery',
    'caption',
  ));

  // Поддержка меню
  register_nav_menus(array(
    'primary' => __('Главное меню', 'sailenergy'),
    'footer_1'  => __('Меню в подвале Навигация', 'sailenergy'),
    'footer_2'  => __('Меню в подвале Полезное', 'sailenergy'),
  ));

  // Поддержка виджетов
  add_theme_support('widgets');
}
add_action('after_setup_theme', 'sailenergy_setup');

// Поддержка подменю через кастомный walker
add_filter('nav_menu_submenu_css_class', function ($classes, $args, $depth) {
  $classes[] = 'dropdown-menu';
  return $classes;
}, 10, 3);

// Добавляем класс dropdown-item для подпунктов меню
add_filter('nav_menu_link_attributes', function ($atts, $item, $args, $depth) {
  // Если это пункт подменю (depth > 0)
  if ($depth > 0 && strpos($atts['class'] ?? '', 'dropdown-toggle') === false) {
    $atts['class'] = isset($atts['class']) ? $atts['class'] . ' dropdown-item' : 'dropdown-item';
  }
  return $atts;
}, 10, 4);

// ============================================
// 2. ПОДКЛЮЧЕНИЕ СТИЛЕЙ И СКРИПТОВ
// ============================================

function sailenergy_scripts()
{
  $version = wp_get_theme()->get('Version');

  // Стили
  wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css2?family=Montserrat:wght@600;700;800&family=Roboto:wght@300;400;500&display=swap', array(), null);
  wp_enqueue_style('fontawesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css', array(), null);
  wp_enqueue_style('aos', 'https://unpkg.com/aos@2.3.1/dist/aos.css', array(), null);
  wp_enqueue_style('bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css', array(), null);
  wp_enqueue_style('owl-theme', 'https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css', array(), null);
  wp_enqueue_style('owl-carousel', 'https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css', array(), null);
  wp_enqueue_style('sailenergy-style', get_template_directory_uri() . '/assets/css/style.min.css', array(), null);
  wp_enqueue_style('sailenergy-custom-style', get_template_directory_uri() . '/css/custom.css', array(), null);

  // Скрипты
  wp_enqueue_script('aos', 'https://unpkg.com/aos@2.3.1/dist/aos.js', array(), null, true);
  wp_enqueue_script('bootstrap-bundle', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js', array(), null, true);
  wp_enqueue_script('jquery', 'https://code.jquery.com/jquery-3.6.0.min.js', array(), null, true);
  wp_enqueue_script('owl-carousel', 'https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js', array('jquery'), null, true);
  wp_enqueue_script('sailenergy-main', get_template_directory_uri() . '/assets/js/main.min.js', array('jquery', 'aos', 'owl-carousel'), $version, true);

  // Локализация для AJAX
  wp_localize_script('sailenergy-main', 'sailenergy_ajax', array(
    'ajax_url' => admin_url('admin-ajax.php'),
    'nonce'    => wp_create_nonce('sailenergy_nonce'),
  ));
}
add_action('wp_enqueue_scripts', 'sailenergy_scripts');

// ============================================
// 3. ВИДЖЕТЫ
// ============================================

function sailenergy_widgets_init()
{
  register_sidebar(array(
    'name'          => __('Сайдбар для записей', 'sailenergy'),
    'id'            => 'sidebar-1',
    'description'   => __('Добавьте виджеты в сайдбар.', 'sailenergy'),
    'before_widget' => '<section id="%1$s" class="widget %2$s">',
    'after_widget'  => '</section>',
    'before_title'  => '<h5 class="widget-title">',
    'after_title'   => '</h5>',
  ));
}
add_action('widgets_init', 'sailenergy_widgets_init');

// ============================================
// 4. ПОДКЛЮЧЕНИЕ ФАЙЛОВ
// ============================================

// ACF поля
require_once get_template_directory() . '/inc/acf-fields.php';

// Кастомные типы записей
require_once get_template_directory() . '/inc/custom-post-types.php';

// Кастомные таксономии
require_once get_template_directory() . '/inc/custom-taxonomies.php';

// ============================================
// 5. ВСПОМОГАТЕЛЬНЫЕ ФУНКЦИИ
// ============================================

/**
 * Получение SVG логотипа
 */
function sailenergy_get_logo()
{
  $custom_logo_id = get_theme_mod('custom_logo');
  if ($custom_logo_id) {
    $logo_url = wp_get_attachment_image_src($custom_logo_id, 'full');
    return $logo_url ? $logo_url[0] : get_template_directory_uri() . '/assets/img/sailenergy-logo-web-dark.svg';
  }
  return get_template_directory_uri() . '/assets/img/sailenergy-logo-web-dark.svg';
}

/**
 * Получение социальных ссылок из ACF
 */
function sailenergy_get_socials()
{
  $socials = array();

  $socials['vk'] = get_field('social_vk', 'option');
  $socials['youtube'] = get_field('social_youtube', 'option');
  $socials['telegram'] = get_field('social_telegram', 'option');
  $socials['instagram'] = get_field('social_instagram', 'option');

  return array_filter($socials);
}

/**
 * Получение контактов из ACF
 */
function sailenergy_get_contacts()
{
  return array(
    'phone' => get_field('contact_phone', 'option'),
    'email' => get_field('contact_email', 'option'),
    'address' => get_field('contact_address', 'option'),
  );
}

/**
 * Хлебные крошки
 */
function sailenergy_breadcrumbs()
{
  if (is_front_page()) return;

  echo '<nav aria-label="Breadcrumb" class="breadcrumb-nav bg-light">';
  echo '<div class="container">';
  echo '<ol class="breadcrumb mb-0">';
  echo '<li class="breadcrumb-item"><a href="' . home_url() . '"><i class="fas fa-home"></i></a></li>';

  if (is_single()) {
    $post_type = get_post_type();

    // Для обычных постов
    if ($post_type === 'post') {
      $categories = get_the_category();
      if ($categories) {
        echo '<li class="breadcrumb-item"><a href="' . get_category_link($categories[0]->term_id) . '">' . $categories[0]->name . '</a></li>';
      }
    }
    // Для кастомных типов записей
    else {
      // Получаем архивную ссылку для CPT
      $post_type_obj = get_post_type_object($post_type);
      if ($post_type_obj && $post_type_obj->has_archive) {
        $archive_link = get_post_type_archive_link($post_type);
        $archive_label = $post_type_obj->labels->name;
        if ($archive_link) {
          echo '<li class="breadcrumb-item"><a href="' . esc_url($archive_link) . '">' . esc_html($archive_label) . '</a></li>';
        }
      }

      // Проверяем таксономии для CPT
      $taxonomies = get_object_taxonomies($post_type, 'objects');
      foreach ($taxonomies as $taxonomy) {
        if ($taxonomy->hierarchical) {
          $terms = get_the_terms(get_the_ID(), $taxonomy->name);
          if ($terms && !is_wp_error($terms)) {
            echo '<li class="breadcrumb-item"><a href="' . get_term_link($terms[0]) . '">' . $terms[0]->name . '</a></li>';
            break;
          }
        }
      }
    }

    echo '<li class="breadcrumb-item active" aria-current="page">' . get_the_title() . '</li>';
  } elseif (is_page()) {
    $parent_id = wp_get_post_parent_id(get_the_ID());
    if ($parent_id) {
      echo '<li class="breadcrumb-item"><a href="' . get_permalink($parent_id) . '">' . get_the_title($parent_id) . '</a></li>';
    }
    echo '<li class="breadcrumb-item active" aria-current="page">' . get_the_title() . '</li>';
  } elseif (is_category()) {
    echo '<li class="breadcrumb-item active" aria-current="page">' . single_cat_title('', false) . '</li>';
  } elseif (is_search()) {
    echo '<li class="breadcrumb-item active" aria-current="page">Результаты поиска: ' . get_search_query() . '</li>';
  } elseif (is_404()) {
    echo '<li class="breadcrumb-item active" aria-current="page">404 — Страница не найдена</li>';
  } elseif (is_post_type_archive()) {
    echo '<li class="breadcrumb-item active" aria-current="page">' . post_type_archive_title('', false) . '</li>';
  } elseif (is_tax()) {
    echo '<li class="breadcrumb-item active" aria-current="page">' . single_term_title('', false) . '</li>';
  }
  // Для архивов таксономий
  elseif (is_archive()) {
    echo '<li class="breadcrumb-item active" aria-current="page">' . get_the_archive_title() . '</li>';
  }

  echo '</ol>';
  echo '</div>';
  echo '</nav>';
}

/**
 * Пагинация
 */
function sailenergy_pagination()
{
  global $wp_query;
  $big = 999999999;

  $pages = paginate_links(array(
    'base'      => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
    'format'    => '?paged=%#%',
    'current'   => max(1, get_query_var('paged')),
    'total'     => $wp_query->max_num_pages,
    'type'      => 'array',
    'prev_text' => '<i class="fas fa-chevron-left"></i>',
    'next_text' => '<i class="fas fa-chevron-right"></i>',
  ));

  if (is_array($pages)) {
    echo '<nav aria-label="Навигация по страницам" class="mt-5">';
    echo '<ul class="pagination justify-content-center">';
    foreach ($pages as $page) {
      echo '<li class="page-item' . (strpos($page, 'current') !== false ? ' active' : '') . '">';
      echo str_replace('page-numbers', 'page-link', $page);
      echo '</li>';
    }
    echo '</ul>';
    echo '</nav>';
  }
}

// ============================================
// ПОДКЛЮЧЕНИЕ NAV WALKER
// ============================================

require_once get_template_directory() . '/inc/class-wp-bootstrap-navwalker.php';

// ============================================
// 6. ДОБАВЛЯЕМ КЛАССЫ ДЛЯ МЕНЮ
// ============================================

add_filter('nav_menu_link_attributes', function ($atts, $item, $args, $depth) {
  // Добавляем класс nav-link к ссылкам
  if (strpos($atts['class'] ?? '', 'dropdown-toggle') === false) {
    $atts['class'] = isset($atts['class']) ? $atts['class'] . ' nav-link' : 'nav-link';
  }
  return $atts;
}, 10, 4);

// Добавляем класс nav-item к li
add_filter('nav_menu_css_class', function ($classes, $item, $args, $depth) {
  if (!in_array('dropdown', $classes)) {
    $classes[] = 'nav-item';
  }
  return $classes;
}, 10, 4);

// ============================================
// 7. ПОДСТАНОВКА НАЗВАНИЯ ТЕКУЩЕГО КУРСА В ПОЛЕ CF7
// ============================================

function sailenergy_fill_current_course()
{
  if (is_singular('course') && function_exists('wpcf7')) {
    $current_course_id = get_the_ID();
    $current_course_title = get_the_title();
?>
    <script>
      document.addEventListener('DOMContentLoaded', function() {
        function fillCourseField() {
          var courseField = document.querySelector('#modalCourse');
          var courseHidden = document.querySelector('[name="course-id"]');

          if (courseField) {
            courseField.value = '<?php echo esc_js($current_course_title); ?>';
          }

          if (courseHidden) {
            courseHidden.value = '<?php echo esc_js($current_course_id); ?>';
          }
        }

        fillCourseField();

        var modal = document.getElementById('callbackModal');
        if (modal) {
          modal.addEventListener('shown.bs.modal', function() {
            setTimeout(fillCourseField, 100);
          });
        }
      });
    </script>
  <?php
  }
}
add_action('wp_footer', 'sailenergy_fill_current_course');

// ============================================
// 8. РЕДИРЕКТ ПОСЛЕ УСПЕШНОЙ ОТПРАВКИ CF7 (ПРОСТОЙ)
// ============================================

function sailenergy_cf7_success_redirect_js()
{
  if (function_exists('wpcf7')) {
    ?>
    <script>
      document.addEventListener('DOMContentLoaded', function() {
        document.addEventListener('wpcf7mailsent', function(event) {
          // Просто перенаправляем на страницу успеха
          window.location.href = '<?php echo home_url('/success/'); ?>';
        });
      });
    </script>
    <?php
  }
}
add_action('wp_footer', 'sailenergy_cf7_success_redirect_js', 999);
