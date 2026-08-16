<!-- MODAL ORDER THE COURSE -->
<div class="modal fade" id="callbackModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">
      <div class="modal-header bg-dark-custom text-white border-0 p-4">
        <p class="modal-title fw-bold text-uppercase fs-4">
          Записаться на курс
          <?php if (get_post_type() === 'course') : ?>
            <small class="d-block fs-6 text-white-50 text-lowercase"><?php echo esc_html(get_the_title()); ?></small>
          <?php endif; ?>
        </p>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body p-4">
        <?php echo do_shortcode('[contact-form-7 id="8705603" title="Запись на курс"]'); ?>
      </div>
    </div>
  </div>
</div>