<?php

/**
 * WP Bootstrap Navwalker
 *
 * @package WP-Bootstrap-Navwalker
 */

if (! class_exists('WP_Bootstrap_Navwalker')) {

  /**
   * WP_Bootstrap_Navwalker class.
   */
  class WP_Bootstrap_Navwalker extends Walker_Nav_Menu
  {

    /**
     * Starts the list before the elements are added.
     */
    public function start_lvl(&$output, $depth = 0, $args = array())
    {
      if (isset($args->item_spacing) && 'discard' === $args->item_spacing) {
        $t = '';
        $n = '';
      } else {
        $t = "\t";
        $n = "\n";
      }
      $indent = str_repeat($t, $depth);

      // Default class to add to <ul>
      $classes = array('dropdown-menu');

      // Add submenu class for Bootstrap
      $output .= $n . $indent . '<ul class="' . implode(' ', $classes) . '">' . $n;
    }

    /**
     * Starts the element output.
     */
    public function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0)
    {
      if (isset($args->item_spacing) && 'discard' === $args->item_spacing) {
        $t = '';
        $n = '';
      } else {
        $t = "\t";
        $n = "\n";
      }
      $indent = ($depth) ? str_repeat($t, $depth) : '';

      $classes = empty($item->classes) ? array() : (array) $item->classes;

      // Add active class for current page
      if (in_array('current-menu-item', $classes, true) || in_array('current-page-ancestor', $classes, true)) {
        $classes[] = 'active';
      }

      // Add dropdown class if item has children
      if ($args->has_children) {
        $classes[] = 'dropdown';
      }

      /**
       * Filters the arguments for a single nav menu item.
       */
      $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args, $depth));
      $class_names = $class_names ? ' class="' . esc_attr($class_names) . '"' : '';

      /**
       * Filters the ID applied to a menu item's list item element.
       */
      $id = apply_filters('nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args, $depth);
      $id = $id ? ' id="' . esc_attr($id) . '"' : '';

      $output .= $indent . '<li' . $id . $class_names . '>';

      $atts           = array();
      $atts['title']  = ! empty($item->attr_title) ? $item->attr_title : '';
      $atts['target'] = ! empty($item->target) ? $item->target : '';
      $atts['rel']    = ! empty($item->xfn) ? $item->xfn : '';
      $atts['href']   = ! empty($item->url) ? $item->url : '';

      /**
       * Filters the HTML attributes applied to a menu item's anchor element.
       */
      $atts = apply_filters('nav_menu_link_attributes', $atts, $item, $args, $depth);

      $attributes = '';
      foreach ($atts as $attr => $value) {
        if (! empty($value)) {
          $value       = ('href' === $attr) ? esc_url($value) : esc_attr($value);
          $attributes .= ' ' . $attr . '="' . $value . '"';
        }
      }

      /** This filter is documented in wp-includes/post-template.php */
      $title = apply_filters('the_title', $item->title, $item->ID);

      /**
       * Filters a menu item's title.
       */
      $title = apply_filters('nav_menu_item_title', $title, $item, $args, $depth);

      // Add dropdown toggle for parent items
      if ($args->has_children) {
        $item_output  = $args->before;
        $item_output .= '<a class="nav-link dropdown-toggle" href="#"' . $attributes . ' role="button" data-bs-toggle="dropdown" aria-expanded="false">';
        $item_output .= $args->link_before . $title . $args->link_after;
        $item_output .= '</a>';
        $item_output .= $args->after;
      } else {
        $item_output  = $args->before;
        $item_output .= '<a class="nav-link"' . $attributes . '>';
        $item_output .= $args->link_before . $title . $args->link_after;
        $item_output .= '</a>';
        $item_output .= $args->after;
      }

      /**
       * Filters a menu item's starting output.
       */
      $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
    }

    /**
     * Ends the element output, if needed.
     */
    public function end_el(&$output, $item, $depth = 0, $args = array())
    {
      if (isset($args->item_spacing) && 'discard' === $args->item_spacing) {
        $t = '';
        $n = '';
      } else {
        $t = "\t";
        $n = "\n";
      }
      $output .= "</li>{$n}";
    }

    /**
     * Ends the list of after the elements are added.
     */
    public function end_lvl(&$output, $depth = 0, $args = array())
    {
      if (isset($args->item_spacing) && 'discard' === $args->item_spacing) {
        $t = '';
        $n = '';
      } else {
        $t = "\t";
        $n = "\n";
      }
      $indent  = str_repeat($t, $depth);
      $output .= "$indent</ul>{$n}";
    }

    /**
     * Display array of elements hierarchically.
     */
    public function display_element($element, &$children_elements, $max_depth, $depth, $args, &$output)
    {
      if (! $element) {
        return;
      }

      $id_field = $this->db_fields['id'];

      // Display this element.
      if (is_object($args[0])) {
        $args[0]->has_children = ! empty($children_elements[$element->$id_field]);
      }

      parent::display_element($element, $children_elements, $max_depth, $depth, $args, $output);
    }

    /**
     * Menu fallback
     */
    public static function fallback($args)
    {
      if (current_user_can('edit_theme_options')) {
        /* translators: %s: link to menu editor */
        $fallback_text = sprintf(
          __('Add a menu to this location. %s', 'sailenergy'),
          '<a href="' . admin_url('nav-menus.php') . '">' . __('Create a menu', 'sailenergy') . '</a>'
        );
      } else {
        $fallback_text = __('No menu assigned to this location.', 'sailenergy');
      }

      $defaults = array(
        'container'       => false,
        'menu_class'      => 'navbar-nav ms-auto mb-2 mb-lg-0 align-items-lg-center gap-2 mt-3 mt-lg-0',
        'fallback_cb'     => false,
        'echo'            => true,
        'depth'           => 2,
        'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
      );

      $args = wp_parse_args($args, $defaults);

      $fallback_output = '<ul class="' . esc_attr($args['menu_class']) . '">';
      $fallback_output .= '<li class="nav-item"><a class="nav-link" href="' . home_url() . '">' . __('Home', 'sailenergy') . '</a></li>';
      $fallback_output .= '<li class="nav-item"><a class="nav-link" href="' . admin_url('nav-menus.php') . '">' . __('Add menu', 'sailenergy') . '</a></li>';
      $fallback_output .= '</ul>';

      echo $fallback_output;
    }
  }
}
