<?php

/**
 * ACF Поля для SAIL ENERGY Theme
 */

// Проверяем, активен ли ACF
if (!function_exists('acf_add_local_field_group')) {
  return;
}

// ============================================
// ОПЦИИ ТЕМЫ (страница настроек)
// ============================================

if (function_exists('acf_add_options_page')) {
  acf_add_options_page(array(
    'page_title' => 'Настройки SAIL ENERGY',
    'menu_title' => 'Настройки темы',
    'menu_slug'  => 'sailenergy-settings',
    'capability' => 'manage_options',
    'redirect'   => false,
    'icon_url'   => 'dashicons-admin-settings',
  ));
}

// Контакты
acf_add_local_field_group(array(
  'key' => 'group_contacts',
  'title' => 'Контакты',
  'fields' => array(
    array(
      'key' => 'field_contact_phone',
      'label' => 'Телефон',
      'name' => 'contact_phone',
      'type' => 'text',
      'default_value' => '+7 921 588 23 78',
    ),
    array(
      'key' => 'field_contact_email',
      'label' => 'Email',
      'name' => 'contact_email',
      'type' => 'email',
      'default_value' => 'info@sailenergy.ru',
    ),
    array(
      'key' => 'field_contact_address',
      'label' => 'Адрес',
      'name' => 'contact_address',
      'type' => 'text',
      'default_value' => 'Санкт-Петербург, Яхтенный порт "Смоленка"',
    ),
  ),
  'location' => array(
    array(
      array(
        'param' => 'options_page',
        'operator' => '==',
        'value' => 'sailenergy-settings',
      ),
    ),
  ),
));

// Социальные сети
acf_add_local_field_group(array(
  'key' => 'group_socials',
  'title' => 'Социальные сети',
  'fields' => array(
    array(
      'key' => 'field_social_vk',
      'label' => 'VK',
      'name' => 'social_vk',
      'type' => 'url',
      'placeholder' => 'https://vk.com/...',
    ),
    array(
      'key' => 'field_social_youtube',
      'label' => 'YouTube',
      'name' => 'social_youtube',
      'type' => 'url',
      'placeholder' => 'https://youtube.com/...',
    ),
    array(
      'key' => 'field_social_telegram',
      'label' => 'Telegram',
      'name' => 'social_telegram',
      'type' => 'url',
      'placeholder' => 'https://t.me/...',
    ),
    array(
      'key' => 'field_social_instagram',
      'label' => 'Instagram',
      'name' => 'social_instagram',
      'type' => 'url',
      'placeholder' => 'https://instagram.com/...',
    ),
  ),
  'location' => array(
    array(
      array(
        'param' => 'options_page',
        'operator' => '==',
        'value' => 'sailenergy-settings',
      ),
    ),
  ),
));

// ============================================
// ПОЛЯ ДЛЯ РЕГАТ (Custom Post Type)
// ============================================

acf_add_local_field_group(array(
  'key' => 'group_regatta',
  'title' => 'Данные регаты',
  'fields' => array(
    array(
      'key' => 'field_regatta_date',
      'label' => 'Дата проведения',
      'name' => 'regatta_date',
      'type' => 'date_picker',
      'display_format' => 'd.m.Y',
      'return_format' => 'd.m.Y',
    ),
    array(
      'key' => 'field_regatta_location',
      'label' => 'Место проведения',
      'name' => 'regatta_location',
      'type' => 'text',
      'placeholder' => 'Гечек, Турция',
    ),
    array(
      'key' => 'field_regatta_badge',
      'label' => 'Текст бейджа',
      'name' => 'regatta_badge',
      'type' => 'text',
      'placeholder' => 'Май 2026',
    ),
    array(
      'key' => 'field_regatta_gallery',
      'label' => 'Галерея',
      'name' => 'regatta_gallery',
      'type' => 'gallery',
    ),
    array(
      'key' => 'field_regatta_register_link',
      'label' => 'Ссылка на регистрацию',
      'name' => 'regatta_register_link',
      'type' => 'url',
    ),
  ),
  'location' => array(
    array(
      array(
        'param' => 'post_type',
        'operator' => '==',
        'value' => 'regatta',
      ),
    ),
  ),
));

// ============================================
// ПОЛЯ ДЛЯ КУРСОВ (Custom Post Type)
// ============================================

acf_add_local_field_group(array(
  'key' => 'group_course',
  'title' => 'Данные курса',
  'fields' => array(
    array(
      'key' => 'field_course_level',
      'label' => 'Уровень',
      'name' => 'course_level',
      'type' => 'select',
      'choices' => array(
        'start' => 'Новичок',
        'pro' => 'Опытный',
        'master' => 'Профи (Yachtmaster)',
      ),
      'default_value' => 'start',
      'wrapper' => array(
        'width' => '25',
        'class' => '',
        'id' => '',
      ),
    ),
    array(
      'key' => 'field_course_duration',
      'label' => 'Длительность',
      'name' => 'course_duration',
      'type' => 'text',
      'placeholder' => '14 дней',
      'wrapper' => array(
        'width' => '25',
        'class' => '',
        'id' => '',
      ),
    ),
    array(
      'key' => 'field_course_price',
      'label' => 'Стоимость',
      'name' => 'course_price',
      'type' => 'text',
      'placeholder' => 'от 150 000 ₽',
      'wrapper' => array(
        'width' => '25',
        'class' => '',
        'id' => '',
      ),
    ),
    array(
      'key' => 'field_course_icon',
      'label' => 'Иконка (FontAwesome)',
      'name' => 'course_icon',
      'type' => 'text',
      'placeholder' => 'fas fa-anchor',
      'default_value' => 'fas fa-anchor',
      'wrapper' => array(
        'width' => '25',
        'class' => '',
        'id' => '',
      ),
    ),
    array(
      'key' => 'field_course_syllabus',
      'label' => 'Программа курса',
      'name' => 'course_syllabus',
      'type' => 'wysiwyg',
      'toolbar' => 'full',
      'wrapper' => array(
        'width' => '100',
        'class' => '',
        'id' => '',
      ),
    ),
    array(
      'key' => 'field_course_summary',
      'label' => 'Итог курса (краткое описание)',
      'name' => 'course_summary',
      'type' => 'textarea',
      'rows' => 3,
      'wrapper' => array(
        'width' => '100',
        'class' => '',
        'id' => '',
      ),
    ),
  ),
  'location' => array(
    array(
      array(
        'param' => 'post_type',
        'operator' => '==',
        'value' => 'course',
      ),
    ),
  ),
  'hide_on_screen' => array(
    'the_content',
  ),
));

// ============================================
// ПОЛЯ ДЛЯ ИНСТРУКТОРОВ (Custom Post Type)
// ============================================

acf_add_local_field_group(array(
  'key' => 'group_instructor',
  'title' => 'Данные инструктора',
  'fields' => array(
    array(
      'key' => 'field_instructor_position',
      'label' => 'Должность',
      'name' => 'instructor_position',
      'type' => 'text',
      'placeholder' => 'Основатель, Мастер спорта',
    ),
    array(
      'key' => 'field_instructor_achievements',
      'label' => 'Достижения',
      'name' => 'instructor_achievements',
      'type' => 'textarea',
      'placeholder' => 'Чемпион мира ORC, участник RC44...',
    ),
    array(
      'key' => 'field_instructor_social_vk',
      'label' => 'VK',
      'name' => 'instructor_social_vk',
      'type' => 'url',
    ),
    array(
      'key' => 'field_instructor_social_telegram',
      'label' => 'Telegram',
      'name' => 'instructor_social_telegram',
      'type' => 'url',
    ),
  ),
  'location' => array(
    array(
      array(
        'param' => 'post_type',
        'operator' => '==',
        'value' => 'instructor',
      ),
    ),
  ),
));

// ============================================
// ПОЛЯ ДЛЯ FAQ (Custom Post Type)
// ============================================

acf_add_local_field_group(array(
  'key' => 'group_faq',
  'title' => 'Данные FAQ',
  'fields' => array(
    array(
      'key' => 'field_faq_answer',
      'label' => 'Ответ',
      'name' => 'faq_answer',
      'type' => 'wysiwyg',
      'toolbar' => 'basic',
    ),
    array(
      'key' => 'field_faq_order',
      'label' => 'Порядок сортировки',
      'name' => 'faq_order',
      'type' => 'number',
      'default_value' => 0,
    ),
  ),
  'location' => array(
    array(
      array(
        'param' => 'post_type',
        'operator' => '==',
        'value' => 'faq',
      ),
    ),
  ),
));

// ============================================
// ПОЛЯ ДЛЯ СТРАНИЦЫ "О КЛУБЕ"
// ============================================

acf_add_local_field_group(array(
  'key' => 'group_club_page',
  'title' => 'Данные страницы "О клубе"',
  'fields' => array(
    // --- Hero блок ---
    array(
      'key' => 'field_club_hero_image',
      'label' => 'Изображение в hero-блоке',
      'name' => 'club_hero_image',
      'type' => 'image',
      'return_format' => 'url',
      'preview_size' => 'medium',
      'wrapper' => array(
        'width' => '50',
        'class' => '',
        'id' => '',
      ),
    ),
    array(
      'key' => 'field_club_hero_title',
      'label' => 'Заголовок hero-блока',
      'name' => 'club_hero_title',
      'type' => 'text',
      'default_value' => 'О клубе SAIL ENERGY',
      'wrapper' => array(
        'width' => '50',
        'class' => '',
        'id' => '',
      ),
    ),
    array(
      'key' => 'field_club_hero_text',
      'label' => 'Текст hero-блока (краткое описание)',
      'name' => 'club_hero_text',
      'type' => 'text',
      'default_value' => 'Мы — сообщество профессионалов и любителей, объединенных любовью к морю и ветру.',
      'wrapper' => array(
        'width' => '100',
        'class' => '',
        'id' => '',
      ),
    ),

    // --- Статистика ---
    array(
      'key' => 'field_club_stats_title',
      'label' => 'Заголовок блока статистики',
      'name' => 'club_stats_title',
      'type' => 'text',
      'default_value' => 'Наши достижения',
      'wrapper' => array(
        'width' => '100',
        'class' => '',
        'id' => '',
      ),
    ),
    array(
      'key' => 'field_club_experience',
      'label' => 'Лет опыта',
      'name' => 'club_experience',
      'type' => 'number',
      'default_value' => 25,
      'wrapper' => array(
        'width' => '50',
        'class' => '',
        'id' => '',
      ),
    ),
    array(
      'key' => 'field_club_experience_label',
      'label' => 'Подпись "Лет опыта"',
      'name' => 'club_experience_label',
      'type' => 'text',
      'default_value' => 'Лет опыта',
      'wrapper' => array(
        'width' => '50',
        'class' => '',
        'id' => '',
      ),
    ),
    array(
      'key' => 'field_club_graduates',
      'label' => 'Выпускников',
      'name' => 'club_graduates',
      'type' => 'number',
      'default_value' => 100,
      'wrapper' => array(
        'width' => '50',
        'class' => '',
        'id' => '',
      ),
    ),
    array(
      'key' => 'field_club_graduates_label',
      'label' => 'Подпись "Выпускников"',
      'name' => 'club_graduates_label',
      'type' => 'text',
      'default_value' => 'Выпускников',
      'wrapper' => array(
        'width' => '50',
        'class' => '',
        'id' => '',
      ),
    ),
    array(
      'key' => 'field_club_regattas_count',
      'label' => 'Проведенных регат',
      'name' => 'club_regattas_count',
      'type' => 'number',
      'default_value' => 50,
      'wrapper' => array(
        'width' => '50',
        'class' => '',
        'id' => '',
      ),
    ),
    array(
      'key' => 'field_club_regattas_label',
      'label' => 'Подпись "Проведенных регат"',
      'name' => 'club_regattas_label',
      'type' => 'text',
      'default_value' => 'Проведенных регат',
      'wrapper' => array(
        'width' => '50',
        'class' => '',
        'id' => '',
      ),
    ),

    // --- Полное описание ---
    array(
      'key' => 'field_club_description_title',
      'label' => 'Заголовок полного описания',
      'name' => 'club_description_title',
      'type' => 'text',
      'default_value' => 'О клубе',
      'wrapper' => array(
        'width' => '100',
        'class' => '',
        'id' => '',
      ),
    ),
    array(
      'key' => 'field_club_description',
      'label' => 'Полное описание клуба',
      'name' => 'club_description',
      'type' => 'wysiwyg',
      'toolbar' => 'full',
      'media_upload' => 1,
      'wrapper' => array(
        'width' => '100',
        'class' => '',
        'id' => '',
      ),
      'instructions' => 'Это полное описание клуба, которое будет показано ниже статистики.',
    ),
  ),
  'location' => array(
    array(
      array(
        'param' => 'page_template',
        'operator' => '==',
        'value' => 'templates/template-club.php',
      ),
    ),
  ),
  'hide_on_screen' => array(
    'the_content',
  ),
));

// ============================================
// ПОЛЯ ДЛЯ СТРАНИЦЫ "РЕГАТЫ"
// ============================================

acf_add_local_field_group(array(
  'key' => 'group_regattas_page',
  'title' => 'Настройки страницы регат',
  'fields' => array(
    array(
      'key' => 'field_regattas_hero_title',
      'label' => 'Заголовок hero-блока',
      'name' => 'regattas_hero_title',
      'type' => 'text',
      'default_value' => 'Календарь регат',
    ),
    array(
      'key' => 'field_regattas_hero_subtitle',
      'label' => 'Подзаголовок hero-блока',
      'name' => 'regattas_hero_subtitle',
      'type' => 'text',
      'default_value' => 'Примите участие в соревнованиях под парусом',
    ),
    array(
      'key' => 'field_regattas_hero_image',
      'label' => 'Изображение hero-блока',
      'name' => 'regattas_hero_image',
      'type' => 'image',
      'return_format' => 'url',
    ),
  ),
  'location' => array(
    array(
      array(
        'param' => 'page_template',
        'operator' => '==',
        'value' => 'templates/template-regattas.php',
      ),
    ),
  ),
));
