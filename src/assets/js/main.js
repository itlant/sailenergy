/* --- HEADER SCROLL EFFECT & OFFSET --- */
document.addEventListener("DOMContentLoaded", function () {
  const navbar = document.querySelector(".navbar");
  let ticking = false;

  // Функция обновления отступа
  function updateHeaderOffset() {
    if (navbar) {
      const height = navbar.offsetHeight;
      document.documentElement.style.setProperty(
        "--header-height",
        height + "px",
      );
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

/* --- МОБИЛЬНОЕ МЕНЮ: OVERLAY И БЛОКИРОВКА --- */
document.addEventListener("DOMContentLoaded", function () {
  const navbarToggler = document.querySelector(".navbar-toggler");
  const navbarCollapse = document.querySelector(".navbar-collapse");
  const overlay = document.querySelector(".navbar-overlay");
  const body = document.body;

  if (!navbarToggler || !navbarCollapse || !overlay) return;

  function toggleMenu(open) {
    const isOpen =
      open !== undefined ? open : navbarCollapse.classList.contains("show");

    if (isOpen) {
      // Открываем меню
      navbarCollapse.classList.add("show");
      overlay.classList.add("active");
      body.classList.add("menu-open");
      navbarToggler.setAttribute("aria-expanded", "true");
    } else {
      // Закрываем меню
      navbarCollapse.classList.remove("show");
      overlay.classList.remove("active");
      body.classList.remove("menu-open");
      navbarToggler.setAttribute("aria-expanded", "false");
    }
  }

  // Клик по бургеру
  navbarToggler.addEventListener("click", function (e) {
    e.stopPropagation();
    const isOpen = navbarCollapse.classList.contains("show");
    toggleMenu(!isOpen);
  });

  // Клик по overlay (закрывает меню)
  overlay.addEventListener("click", function () {
    toggleMenu(false);
  });

  // Закрытие по Escape
  document.addEventListener("keydown", function (e) {
    if (e.key === "Escape") {
      toggleMenu(false);
    }
  });

  // Закрытие при клике на ссылку в меню
  navbarCollapse
    .querySelectorAll(".nav-link, .dropdown-item, .btn")
    .forEach(function (link) {
      link.addEventListener("click", function () {
        // Не закрываем, если это dropdown-toggle
        if (!this.classList.contains("dropdown-toggle")) {
          toggleMenu(false);
        }
      });
    });

  // Обработка resize (закрываем при переходе на десктоп)
  let resizeTimer;
  window.addEventListener("resize", function () {
    clearTimeout(resizeTimer);
    resizeTimer = setTimeout(function () {
      if (window.innerWidth >= 992) {
        toggleMenu(false);
      }
    }, 250);
  });

  // Обработка dropdown-toggle на мобильных
  if (window.innerWidth < 992) {
    document
      .querySelectorAll(".navbar-nav .dropdown-toggle")
      .forEach(function (toggle) {
        toggle.addEventListener("click", function (e) {
          e.preventDefault();
          const parent = this.closest(".dropdown");
          if (parent) {
            const menu = parent.querySelector(".dropdown-menu");
            if (menu) {
              menu.classList.toggle("show");
            }
          }
        });
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
      smartSpeed: 1200, // Скорость анимации
      autoplay: true,
      autoplayTimeout: 3500,
      autoplayHoverPause: true,
      stagePadding: 0,
      navText: [
        '<i class="fas fa-chevron-left"></i>',
        '<i class="fas fa-chevron-right"></i>',
      ],
      responsive: {
        0: { items: 1, stagePadding: 0 },
        576: { items: 2, stagePadding: 30 },
        992: { items: 4, stagePadding: 40 },
      },
    });
  }
});
