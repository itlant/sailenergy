<?php

/**
 * Socials template part
 */
$socials = array(
  'vk' => 'https://vk.ru/sailenergy',
  'youtube' => 'https://youtube.com/@sail_energy',
  'telegram' => 'https://t.me/sailenergy'
);
?>
<div class="d-flex gap-3">
  <a href="<?php echo esc_url($socials['vk']); ?>" class="text-white-50 hover-teal fs-4" target="_blank" aria-label="Страница Вконтакте">
    <i class="fab fa-vk"></i>
  </a>
  <a href="<?php echo esc_url($socials['youtube']); ?>" class="text-white-50 hover-teal fs-4" target="_blank" aria-label="Страница YouTube">
    <i class="fab fa-youtube"></i>
  </a>
  <a href="<?php echo esc_url($socials['telegram']); ?>" class="text-white-50 hover-teal fs-4" target="_blank" aria-label="Канал в Telegram">
    <i class="fab fa-telegram"></i>
  </a>
</div>