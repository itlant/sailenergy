<!-- FOOTER -->
<footer class="footer bg-dark-custom text-white-50 pt-5 pb-4">
  <div class="container">
    <div class="row g-4 mb-5">
      <div class="col-lg-4">
        <img src="<?php echo sailenergy_get_logo(); ?>" alt="Sail Energy Logo" height="40" class="mb-3">
        <p class="small">
          Парусный клуб и школа яхтинга SAIL ENERGY.<br>
          Обучение, регаты и путешествия.
        </p>

        <!-- SOCIALS -->
        <?php $socials = sailenergy_get_socials(); ?>
        <?php if (!empty($socials)): ?>
          <div class="d-flex gap-3">
            <?php if (!empty($socials['vk'])): ?>
              <a href="<?php echo esc_url($socials['vk']); ?>" class="text-white-50 hover-teal fs-4" target="_blank"><i class="fab fa-vk"></i></a>
            <?php endif; ?>
            <?php if (!empty($socials['youtube'])): ?>
              <a href="<?php echo esc_url($socials['youtube']); ?>" class="text-white-50 hover-teal fs-4" target="_blank"><i class="fab fa-youtube"></i></a>
            <?php endif; ?>
            <?php if (!empty($socials['telegram'])): ?>
              <a href="<?php echo esc_url($socials['telegram']); ?>" class="text-white-50 hover-teal fs-4" target="_blank"><i class="fab fa-telegram"></i></a>
            <?php endif; ?>
          </div>
        <?php endif; ?>
      </div>
      <div class="col-lg-3 col-6">
        <h6 class="text-white mb-3 text-uppercase fs-6">Навигация</h6>
        <?php
        wp_nav_menu(array(
          'theme_location' => 'footer',
          'container'      => false,
          'menu_class'     => 'list-unstyled d-flex flex-column gap-2',
          'fallback_cb'    => false,
          'depth'          => 1,
        ));
        ?>
      </div>
      <div class="col-lg-3 col-6">
        <h6 class="text-white mb-3 text-uppercase fs-6">Полезное</h6>
        <ul class="list-unstyled d-flex flex-column gap-2">
          <li><a href="<?php echo home_url('/useful/'); ?>" class="text-decoration-none text-white-50 hover-teal">Статьи о яхтинге</a></li>
          <li><a href="<?php echo home_url('/useful/'); ?>" class="text-decoration-none text-white-50 hover-teal">Сайты погоды</a></li>
          <li><a href="<?php echo home_url('/useful/'); ?>" class="text-decoration-none text-white-50 hover-teal">Навигация</a></li>
        </ul>
      </div>
      <div class="col-lg-2">
        <h6 class="text-white mb-3 text-uppercase fs-6">Контакты</h6>
        <?php $contacts = sailenergy_get_contacts(); ?>
        <ul class="list-unstyled d-flex flex-column gap-2">
          <?php if (!empty($contacts['email'])): ?>
            <li class="d-flex align-items-start">
              <i class="fas fa-envelope text-teal me-2 mt-1"></i>
              <a href="mailto:<?php echo esc_attr($contacts['email']); ?>" class="text-decoration-none text-white-50 hover-teal"><?php echo esc_html($contacts['email']); ?></a>
            </li>
          <?php endif; ?>
          <?php if (!empty($contacts['phone'])): ?>
            <li class="d-flex align-items-start">
              <i class="fas fa-phone text-teal me-2 mt-1"></i>
              <a href="tel:<?php echo esc_attr(str_replace(' ', '', $contacts['phone'])); ?>" class="text-decoration-none text-white-50 hover-teal"><?php echo esc_html($contacts['phone']); ?></a>
            </li>
          <?php endif; ?>
        </ul>
      </div>
    </div>

    <div class="row pt-4 border-top border-secondary">
      <div class="col-md-6 text-center text-md-start small">
        &copy; <?php echo date('Y'); ?> SAIL ENERGY. Все права защищены.
      </div>
      <div class="col-md-6 text-center text-md-end small">
        <a href="<?php echo home_url('/page-text/'); ?>" class="hover-teal">Политика конфиденциальности</a>
        |
        <a href="<?php echo home_url('/page-text/'); ?>" class="hover-teal">Условия использования</a>
        |
        <a href="<?php echo home_url('/sitemap/'); ?>" class="hover-teal">Карта сайта</a>
      </div>
    </div>
  </div>
</footer>

<!-- MODAL -->
<div class="modal fade" id="callbackModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">
      <div class="modal-header bg-dark-custom text-white border-0 p-4">
        <h5 class="modal-title fw-bold">Записаться на курс</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body p-4">
        <form action="#" method="POST">
          <div class="mb-3">
            <label for="modalName" class="form-label fw-medium">Ваше имя</label>
            <input type="text" class="form-control p-3 bg-light border-0" id="modalName" placeholder="Иван Иванов" required>
          </div>
          <div class="mb-3">
            <label for="modalPhone" class="form-label fw-medium">Телефон</label>
            <input type="tel" class="form-control p-3 bg-light border-0" id="modalPhone" placeholder="+7 (999) 999-99-99" required>
          </div>
          <div class="mb-4">
            <label for="modalCourse" class="form-label fw-medium">Интересующий курс</label>
            <select class="form-select p-3 bg-light border-0" id="modalCourse">
              <option selected value="">Выберите...</option>
              <option value="crew">Матрос (International Crew)</option>
              <option value="skipper">Шкипер (Bareboat Skipper)</option>
              <option value="yachtmaster">Капитан (Yachtmaster)</option>
            </select>
          </div>
          <button type="submit" class="btn btn-teal w-100 py-3 fw-bold rounded-3">Отправить заявку</button>
        </form>
      </div>
    </div>
  </div>
</div>

<?php wp_footer(); ?>
</body>

</html>