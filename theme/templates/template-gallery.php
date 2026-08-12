<?php

/**
 * Template Name: Галерея
 */
?>

<?php get_header(); ?>

<div class="wrapper d-flex flex-column">
  <main>
    <?php sailenergy_breadcrumbs(); ?>

    <section class="py-5 bg-light">
      <div class="container py-5">
        <h1 class="display-5 fw-bold text-center mb-4">
          Галерея <span class="text-teal">событий</span>
        </h1>

        <div class="row g-4">
          <?php
          $gallery_images = get_field('gallery_images');
          if ($gallery_images) :
            foreach ($gallery_images as $image) :
          ?>
              <div class="col-md-6 col-lg-4">
                <div class="position-relative rounded-4 overflow-hidden shadow-sm">
                  <img src="<?php echo esc_url($image['url']); ?>"
                    class="img-fluid w-100"
                    style="height: 300px; object-fit: cover;"
                    alt="<?php echo esc_attr($image['alt']); ?>">
                  <div class="position-absolute bottom-0 start-0 w-100 p-3 text-white bg-dark-custom bg-opacity-75">
                    <p class="mb-0 fw-bold small"><?php echo esc_html($image['caption']); ?></p>
                  </div>
                </div>
              </div>
            <?php
            endforeach;
          else :
            ?>
            <div class="col-12 text-center">
              <p class="text-muted">Изображения будут добавлены в ближайшее время.</p>
            </div>
          <?php endif; ?>
        </div>
      </div>
    </section>
  </main>

  <?php get_footer(); ?>
</div>