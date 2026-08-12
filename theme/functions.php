<?php
function sailenergy_scripts()
{
  wp_enqueue_style('sailenergy-style', get_template_directory_uri() . '/assets/css/style.min.css');
  wp_enqueue_script('sailenergy-script', get_template_directory_uri() . '/assets/js/main.min.js', array(), null, true);
}
add_action('wp_enqueue_scripts', 'sailenergy_scripts');
