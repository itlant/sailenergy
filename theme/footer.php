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

        <!-- SOCIALS START -->
        <?php get_template_part('template-parts/socials'); ?>
        <!-- SOCIALS END -->
      </div>
      <div class="col-lg-3 col-6">
        <p class="text-white mb-3 text-uppercase fs-6">Навигация</p>
        <?php
        wp_nav_menu(array(
          'theme_location' => 'footer_1',
          'container'      => false,
          'menu_class'     => 'list-unstyled d-flex flex-column gap-2',
          'fallback_cb'    => false,
          'depth'          => 1,
        ));
        ?>
      </div>
      <div class="col-lg-3 col-6">
        <p class="text-white mb-3 text-uppercase fs-6">Полезное</p>
        <?php
        wp_nav_menu(array(
          'theme_location' => 'footer_2',
          'container'      => false,
          'menu_class'     => 'list-unstyled d-flex flex-column gap-2',
          'fallback_cb'    => false,
          'depth'          => 1,
        ));
        ?>
      </div>
      <div class="col-lg-2">
        <p class="text-white mb-3 text-uppercase fs-6">Контакты</p>
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

<!-- MODALS START -->
<?php get_template_part('template-parts/modals'); ?>
<!-- MODALS END -->

<?php wp_footer(); ?>
</body>

</html>