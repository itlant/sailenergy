/* --- HEADER SCROLL EFFECT & OFFSET --- */
document.addEventListener("DOMContentLoaded", function () {
  const navbar = document.querySelector(".navbar");
  let ticking = false;

  // Функция обновления отступа
  function updateHeaderOffset() {
    if (navbar) {
      const height = navbar.offsetHeight;
      document.documentElement.style.setProperty("--header-height", height + "px");
      document.body.style.paddingTop = height + "px";
    }
  }

  // Устанавливаем при загрузке
  updateHeaderOffset();

  // Эффект сжатия хедера
  if (navbar) {
    window.addEventListener("scroll", function () {
      if (!ticking) {
        window.requestAnimationFrame(function () {
          if (window.scrollY > 50) {
            navbar.classList.add("navbar-shrink");
          } else {
            navbar.classList.remove("navbar-shrink");
          }
          updateHeaderOffset();
          ticking = false;
        });
        ticking = true;
      }
    });
  }

  // Обновляем при изменении размера окна
  let resizeTimer;
  window.addEventListener("resize", function () {
    clearTimeout(resizeTimer);
    resizeTimer = setTimeout(updateHeaderOffset, 200);
  });
});

/* --- SEARCH TOGGLE --- */
document.addEventListener("DOMContentLoaded", function () {
  const searchToggle = document.querySelector(".search-toggle");
  const searchForm = document.querySelector(".search-form");
  const searchClose = document.querySelector(".search-close");

  if (searchToggle && searchForm) {
    // Открыть поиск
    searchToggle.addEventListener("click", function (e) {
      e.stopPropagation();
      searchForm.classList.add("active");
      // Автоматически ставим фокус в поле ввода
      const input = searchForm.querySelector("input");
      if (input) setTimeout(() => input.focus(), 100);
    });

    // Закрыть поиск
    const closeSearch = function () {
      searchForm.classList.remove("active");
    };

    if (searchClose) {
      searchClose.addEventListener("click", closeSearch);
    }

    // Закрыть поиск при клике вне формы
    document.addEventListener("click", function (e) {
      if (!searchForm.contains(e.target) && e.target !== searchToggle) {
        closeSearch();
      }
    });

    // Закрыть поиск по нажатию Escape
    document.addEventListener("keydown", function (e) {
      if (e.key === "Escape") {
        closeSearch();
      }
    });
  }
});

// AOS
AOS.init({
  duration: 800,
  once: true,
});

/* --- TEAM CAROUSEL (Owl Carousel) --- */
jQuery(document).ready(function ($) {
  const carousel = $(".team-carousel");

  if (carousel.length) {
    carousel.owlCarousel({
      loop: true, // Бесконечная прокрутка
      margin: 20, // Отступ между слайдами
      nav: true, // Стрелки влево/вправо
      dots: true, // Точки внизу
      smartSpeed: 500, // Скорость анимации
      navText: [
        '<i class="fas fa-chevron-left"></i>',
        '<i class="fas fa-chevron-right"></i>',
      ],
      responsive: {
        0: {
          items: 1, // На мобильных - 1 карточка
        },
        576: {
          items: 2, // На планшетах - 2 карточки
        },
        992: {
          items: 4, // На десктопах - 4 карточки
        },
      },
    });
  }
});
