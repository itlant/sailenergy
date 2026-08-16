<aside class="sidebar sidebar-sticky">
  <?php if (is_active_sidebar('sidebar-1')) : ?>
    <?php dynamic_sidebar('sidebar-1'); ?>
  <?php else : ?>
    <div class="card border-0 shadow-sm rounded-4 p-4">
      <h5 class="fw-bold mb-3">Рубрики</h5>
      <ul class="list-unstyled">
        <?php wp_list_categories(array(
          'title_li' => '',
          'show_count' => true,
        )); ?>
      </ul>
    </div>

    <div class="card border-0 shadow-sm rounded-4 p-4 mt-4">
      <h5 class="fw-bold mb-3">Архивы</h5>
      <ul class="list-unstyled">
        <?php wp_get_archives(array('type' => 'monthly', 'limit' => 12)); ?>
      </ul>
    </div>
  <?php endif; ?>
</aside>