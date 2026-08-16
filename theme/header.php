<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
  <?php wp_body_open(); ?>

  <nav class="navbar navbar-expand-lg fixed-top navbar-dark bg-dark-custom py-3 transition-nav">
    <div class="container">
      <a class="navbar-brand d-flex align-items-center" href="<?php echo home_url(); ?>">
        <img src="<?php echo sailenergy_get_logo(); ?>" alt="Sail Energy logo" height="40" class="me-2">
      </a>

      <button class="navbar-toggler border-0 order-1 ms-auto" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="d-none d-lg-flex align-items-center order-lg-3 gap-lg-4 ms-4">
        <div class="header__search d-flex align-items-center">
          <button class="search-toggle btn btn-link text-white-50 p-0" aria-label="Открыть поиск">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
              <circle cx="11" cy="11" r="8"></circle>
              <path d="M21 21L16.65 16.65"></path>
            </svg>
          </button>

          <form class="search-form" action="<?php echo home_url(); ?>" method="get" role="search">
            <div class="input-group">
              <input type="text" class="form-control border-0 shadow-none" placeholder="Поиск по сайту..." name="s" aria-label="Поиск" value="<?php echo get_search_query(); ?>">
              <button class="btn btn-teal" type="submit" aria-label="Найти">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                  <circle cx="11" cy="11" r="8"></circle>
                  <path d="M21 21L16.65 16.65"></path>
                </svg>
              </button>
              <button type="button" class="btn btn-outline-light search-close" aria-label="Закрыть поиск">✕</button>
            </div>
          </form>
        </div>

        <?php get_template_part('template-parts/socials'); ?>

        <button class="btn btn-teal rounded-pill px-4 py-2 btn-header d-none d-lg-block" data-bs-toggle="modal" data-bs-target="#callbackModal">
          Личный кабинет
        </button>
      </div>

      <div class="collapse navbar-collapse order-3 order-lg-2" id="navbarNav">
        <?php
        wp_nav_menu(array(
          'theme_location' => 'primary',
          'container'      => false,
          'menu_class'     => 'navbar-nav ms-auto mb-2 mb-lg-0 align-items-lg-center gap-2 mt-3 mt-lg-0',
          'fallback_cb'    => 'WP_Bootstrap_Navwalker::fallback',
          'walker'         => new WP_Bootstrap_Navwalker(),
          'depth'          => 3,
        ));
        ?>

        <button class="btn btn-teal rounded-pill px-4 py-2 w-100 d-lg-none mt-3" data-bs-toggle="modal" data-bs-target="#callbackModal">
          Личный кабинет
        </button>
      </div>
    </div>
  </nav>