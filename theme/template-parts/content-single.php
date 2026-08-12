<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
  <?php if (has_post_thumbnail()) : ?>
    <div class="mb-4">
      <img src="<?php the_post_thumbnail_url('large'); ?>" class="img-fluid rounded-4 shadow-sm" alt="<?php the_title(); ?>">
    </div>
  <?php endif; ?>

  <h1 class="display-5 fw-bold mb-4 text-dark"><?php the_title(); ?></h1>

  <div class="mb-4 d-flex gap-3 flex-wrap text-muted small">
    <span><i class="far fa-calendar-alt me-1"></i><?php echo get_the_date(); ?></span>
    <span><i class="far fa-user me-1"></i><?php the_author(); ?></span>
    <?php $categories = get_the_category(); ?>
    <?php if ($categories) : ?>
      <span><i class="far fa-folder me-1"></i>
        <?php foreach ($categories as $cat) : ?>
          <a href="<?php echo get_category_link($cat->term_id); ?>" class="text-decoration-none text-teal"><?php echo $cat->name; ?></a>
          <?php if (end($categories) !== $cat) echo ', '; ?>
        <?php endforeach; ?>
      </span>
    <?php endif; ?>
  </div>

  <div class="content-body text-muted">
    <?php the_content(); ?>
  </div>

  <?php wp_link_pages(array(
    'before' => '<div class="page-links">' . __('Страницы:', 'sailenergy'),
    'after' => '</div>',
  )); ?>

  <div class="mt-5 pt-4 border-top">
    <div class="d-flex flex-wrap gap-2">
      <?php the_tags('<span class="badge bg-light text-dark border">', '</span><span class="badge bg-light text-dark border">', '</span>'); ?>
    </div>
  </div>
</article>