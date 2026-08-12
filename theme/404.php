<?php get_header(); ?>

<div class="wrapper d-flex flex-column">
  <main>
    <?php sailenergy_breadcrumbs(); ?>

    <section class="py-5 bg-light min-vh-100 d-flex align-items-center">
      <div class="container text-center">
        <h1 class="display-1 fw-bold text-teal mb-3">404</h1>
        <h2 class="display-5 fw-bold text-dark mb-4">Страница не найдена</h2>
        <p class="lead text-muted mb-5">
          Возможно, вы перешли по неверной ссылке или страница была удалена.
        </p>
        <a href="<?php echo home_url(); ?>" class="btn btn-teal btn-lg rounded-pill px-5">Вернуться на главную</a>
      </div>
    </section>
  </main>

  <?php get_footer(); ?>
</div>