<article id="post-<?php the_ID(); ?>" <?php post_class('card border-0 shadow-sm rounded-4 overflow-hidden mb-4'); ?>>
  <?php if (has_post_thumbnail()) : ?>
    <img src="<?php the_post_thumbnail_url('large'); ?>" class="card-img-top" style="height: 300px; object-fit: cover;" alt="<?php the_title(); ?>">
  <?php endif; ?>

  <div class="card-body p-4">
    <div class="mb-2">
      <?php $categories = get_the_category(); ?>
      <?php if ($categories) : ?>
        <span class="badge bg-teal text-white"><?php echo esc_html($categories[0]->name); ?></span>
      <?php endif; ?>
      <span class="text-muted small ms-2"><i class="far fa-calendar-alt me-1"></i><?php echo get_the_date(); ?></span>
    </div>

    <h2 class="card-title fw-bold">
      <a href="<?php the_permalink(); ?>" class="text-decoration-none text-dark hover-teal"><?php the_title(); ?></a>
    </h2>

    <p class="card-text text-muted"><?php echo wp_trim_words(get_the_excerpt(), 30); ?></p>

    <a href="<?php the_permalink(); ?>" class="btn btn-outline-teal rounded-pill px-4">Читать далее</a>
  </div>
</article>