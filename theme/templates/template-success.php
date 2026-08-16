<?php
/*
Template Name: Страница успеха
*/

get_header(); ?>

<div class="wrapper d-flex flex-column">
  <main>
    <section class="py-5 bg-light min-vh-100 d-flex align-items-center">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-md-8 col-lg-6">
            <div class="card border-0 shadow-sm rounded-4 p-5 text-center bg-white">
              <i class="fas fa-check-circle text-teal fs-1 mb-3"></i>

              <h2 class="fw-bold text-dark mb-3">Заявка отправлена!</h2>

              <p class="text-muted mb-4">
                Мы свяжемся с вами в ближайшее время для подтверждения бронирования.
              </p>

              <div class="mt-3">
                <a href="/" class="btn btn-teal rounded-pill px-5">На главную</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>

  <?php get_footer(); ?>
</div>