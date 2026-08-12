<?php

/**
 * Кастомные типы записей для SAIL ENERGY Theme
 */

// ============================================
// РЕГАТЫ
// ============================================

function sailenergy_register_regatta_post_type()
{
  $labels = array(
    'name'               => __('Регаты', 'sailenergy'),
    'singular_name'      => __('Регата', 'sailenergy'),
    'add_new'            => __('Добавить новую', 'sailenergy'),
    'add_new_item'       => __('Добавить новую регату', 'sailenergy'),
    'edit_item'          => __('Редактировать регату', 'sailenergy'),
    'new_item'           => __('Новая регата', 'sailenergy'),
    'view_item'          => __('Просмотреть регату', 'sailenergy'),
    'search_items'       => __('Искать регаты', 'sailenergy'),
    'not_found'          => __('Регаты не найдены', 'sailenergy'),
    'not_found_in_trash' => __('Регаты не найдены в корзине', 'sailenergy'),
    'menu_name'          => __('Регаты', 'sailenergy'),
  );

  $args = array(
    'labels'             => $labels,
    'public'             => true,
    'publicly_queryable' => true,
    'show_ui'            => true,
    'show_in_menu'       => true,
    'query_var'          => true,
    'rewrite'            => array('slug' => 'regatta'),
    'capability_type'    => 'post',
    'has_archive'        => true,
    'hierarchical'       => false,
    'menu_position'      => 5,
    'menu_icon'          => 'dashicons-trophy',
    'supports'           => array('title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'),
    'show_in_rest'       => true,
  );

  register_post_type('regatta', $args);
}
add_action('init', 'sailenergy_register_regatta_post_type');

// ============================================
// КУРСЫ
// ============================================

function sailenergy_register_course_post_type()
{
  $labels = array(
    'name'               => __('Курсы', 'sailenergy'),
    'singular_name'      => __('Курс', 'sailenergy'),
    'add_new'            => __('Добавить новый', 'sailenergy'),
    'add_new_item'       => __('Добавить новый курс', 'sailenergy'),
    'edit_item'          => __('Редактировать курс', 'sailenergy'),
    'new_item'           => __('Новый курс', 'sailenergy'),
    'view_item'          => __('Просмотреть курс', 'sailenergy'),
    'search_items'       => __('Искать курсы', 'sailenergy'),
    'not_found'          => __('Курсы не найдены', 'sailenergy'),
    'not_found_in_trash' => __('Курсы не найдены в корзине', 'sailenergy'),
    'menu_name'          => __('Курсы', 'sailenergy'),
  );

  $args = array(
    'labels'             => $labels,
    'public'             => true,
    'publicly_queryable' => true,
    'show_ui'            => true,
    'show_in_menu'       => true,
    'query_var'          => true,
    'rewrite'            => array('slug' => 'course'),
    'capability_type'    => 'post',
    'has_archive'        => true,
    'hierarchical'       => false,
    'menu_position'      => 6,
    'menu_icon'          => 'dashicons-welcome-learn-more',
    'supports'           => array('title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'),
    'show_in_rest'       => true,
  );

  register_post_type('course', $args);
}
add_action('init', 'sailenergy_register_course_post_type');

// ============================================
// ИНСТРУКТОРЫ
// ============================================

function sailenergy_register_instructor_post_type()
{
  $labels = array(
    'name'               => __('Инструкторы', 'sailenergy'),
    'singular_name'      => __('Инструктор', 'sailenergy'),
    'add_new'            => __('Добавить нового', 'sailenergy'),
    'add_new_item'       => __('Добавить нового инструктора', 'sailenergy'),
    'edit_item'          => __('Редактировать инструктора', 'sailenergy'),
    'new_item'           => __('Новый инструктор', 'sailenergy'),
    'view_item'          => __('Просмотреть инструктора', 'sailenergy'),
    'search_items'       => __('Искать инструкторов', 'sailenergy'),
    'not_found'          => __('Инструкторы не найдены', 'sailenergy'),
    'not_found_in_trash' => __('Инструкторы не найдены в корзине', 'sailenergy'),
    'menu_name'          => __('Инструкторы', 'sailenergy'),
  );

  $args = array(
    'labels'             => $labels,
    'public'             => true,
    'publicly_queryable' => true,
    'show_ui'            => true,
    'show_in_menu'       => true,
    'query_var'          => true,
    'rewrite'            => array('slug' => 'instructor'),
    'capability_type'    => 'post',
    'has_archive'        => true,
    'hierarchical'       => false,
    'menu_position'      => 7,
    'menu_icon'          => 'dashicons-groups',
    'supports'           => array('title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'),
    'show_in_rest'       => true,
  );

  register_post_type('instructor', $args);
}
add_action('init', 'sailenergy_register_instructor_post_type');

// ============================================
// FAQ
// ============================================

function sailenergy_register_faq_post_type()
{
  $labels = array(
    'name'               => __('FAQ', 'sailenergy'),
    'singular_name'      => __('Вопрос', 'sailenergy'),
    'add_new'            => __('Добавить вопрос', 'sailenergy'),
    'add_new_item'       => __('Добавить новый вопрос', 'sailenergy'),
    'edit_item'          => __('Редактировать вопрос', 'sailenergy'),
    'new_item'           => __('Новый вопрос', 'sailenergy'),
    'view_item'          => __('Просмотреть вопрос', 'sailenergy'),
    'search_items'       => __('Искать вопросы', 'sailenergy'),
    'not_found'          => __('Вопросы не найдены', 'sailenergy'),
    'not_found_in_trash' => __('Вопросы не найдены в корзине', 'sailenergy'),
    'menu_name'          => __('FAQ', 'sailenergy'),
  );

  $args = array(
    'labels'             => $labels,
    'public'             => true,
    'publicly_queryable' => true,
    'show_ui'            => true,
    'show_in_menu'       => true,
    'query_var'          => true,
    'rewrite'            => array('slug' => 'faq'),
    'capability_type'    => 'post',
    'has_archive'        => false,
    'hierarchical'       => false,
    'menu_position'      => 8,
    'menu_icon'          => 'dashicons-editor-help',
    'supports'           => array('title', 'custom-fields'),
    'show_in_rest'       => true,
  );

  register_post_type('faq', $args);
}
add_action('init', 'sailenergy_register_faq_post_type');
