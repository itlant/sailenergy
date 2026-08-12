<?php

/**
 * Кастомные таксономии для SAIL ENERGY Theme
 */

// ============================================
// ТАКСОНОМИЯ: Тип регаты
// ============================================

function sailenergy_register_regatta_taxonomy()
{
  $labels = array(
    'name'              => __('Типы регат', 'sailenergy'),
    'singular_name'     => __('Тип регаты', 'sailenergy'),
    'search_items'      => __('Искать типы', 'sailenergy'),
    'all_items'         => __('Все типы', 'sailenergy'),
    'parent_item'       => __('Родительский тип', 'sailenergy'),
    'parent_item_colon' => __('Родительский тип:', 'sailenergy'),
    'edit_item'         => __('Редактировать тип', 'sailenergy'),
    'update_item'       => __('Обновить тип', 'sailenergy'),
    'add_new_item'      => __('Добавить новый тип', 'sailenergy'),
    'new_item_name'     => __('Название нового типа', 'sailenergy'),
    'menu_name'         => __('Типы регат', 'sailenergy'),
  );

  $args = array(
    'hierarchical'      => true,
    'labels'            => $labels,
    'show_ui'           => true,
    'show_admin_column' => true,
    'query_var'         => true,
    'rewrite'           => array('slug' => 'regatta-type'),
    'show_in_rest'      => true,
  );

  register_taxonomy('regatta_type', array('regatta'), $args);
}
add_action('init', 'sailenergy_register_regatta_taxonomy');

// ============================================
// ТАКСОНОМИЯ: Уровень курса (для фильтрации)
// ============================================

function sailenergy_register_course_level_taxonomy()
{
  $labels = array(
    'name'              => __('Уровни курсов', 'sailenergy'),
    'singular_name'     => __('Уровень', 'sailenergy'),
    'search_items'      => __('Искать уровни', 'sailenergy'),
    'all_items'         => __('Все уровни', 'sailenergy'),
    'edit_item'         => __('Редактировать уровень', 'sailenergy'),
    'update_item'       => __('Обновить уровень', 'sailenergy'),
    'add_new_item'      => __('Добавить новый уровень', 'sailenergy'),
    'new_item_name'     => __('Название уровня', 'sailenergy'),
    'menu_name'         => __('Уровни курсов', 'sailenergy'),
  );

  $args = array(
    'hierarchical'      => true,
    'labels'            => $labels,
    'show_ui'           => true,
    'show_admin_column' => true,
    'query_var'         => true,
    'rewrite'           => array('slug' => 'course-level'),
    'show_in_rest'      => true,
  );

  register_taxonomy('course_level', array('course'), $args);
}
add_action('init', 'sailenergy_register_course_level_taxonomy');
