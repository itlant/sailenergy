/**
 * SAIL ENERGY — MAIN SCRIPT
 */

document.addEventListener("DOMContentLoaded", function () {
  // ============================================
  // 1. HEADER SCROLL EFFECT & OFFSET
  // ============================================
  (function initHeader() {
    const navbar = document.querySelector(".navbar");
    let ticking = false;
    let resizeTimer;

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

    // Эффект сжатия хедера при скролле
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
    window.addEventListener("resize", function () {
      clearTimeout(resizeTimer);
      resizeTimer = setTimeout(updateHeaderOffset, 200);
    });
  })();

  // ============================================
  // 2. SEARCH TOGGLE
  // ============================================
  (function initSearch() {
    const searchToggle = document.querySelector(".search-toggle");
    const searchForm = document.querySelector(".search-form");
    const searchClose = document.querySelector(".search-close");

    if (searchToggle && searchForm) {
      function openSearch(e) {
        e.stopPropagation();
        searchForm.classList.add("active");
        const input = searchForm.querySelector("input");
        if (input)
          setTimeout(function () {
            input.focus();
          }, 100);
      }

      function closeSearch() {
        searchForm.classList.remove("active");
      }

      searchToggle.addEventListener("click", openSearch);

      if (searchClose) {
        searchClose.addEventListener("click", closeSearch);
      }

      // Закрыть при клике вне формы
      document.addEventListener("click", function (e) {
        if (!searchForm.contains(e.target) && e.target !== searchToggle) {
          closeSearch();
        }
      });

      // Закрыть по Escape
      document.addEventListener("keydown", function (e) {
        if (e.key === "Escape") {
          closeSearch();
        }
      });
    }
  })();

  // ============================================
  // 3. MOBILE MENU: OVERLAY & BLOCK SCROLL
  // ============================================
  (function initMobileMenu() {
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
      toggleMenu(!navbarCollapse.classList.contains("show"));
    });

    // Клик по overlay
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
          if (!this.classList.contains("dropdown-toggle")) {
            toggleMenu(false);
          }
        });
      });

    // Закрываем при переходе на десктоп
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
  })();

  // ============================================
  // 4. AOS ANIMATIONS
  // ============================================
  if (typeof AOS !== "undefined") {
    AOS.init({
      duration: 800,
      once: true,
    });
  }

  // ============================================
  // 5. OWL CAROUSEL — TEAM SECTION
  // ============================================
  (function initTeamCarousel() {
    if (
      typeof jQuery !== "undefined" &&
      typeof jQuery.fn.owlCarousel !== "undefined"
    ) {
      jQuery(document).ready(function ($) {
        const carousel = $(".team-carousel");

        if (carousel.length) {
          carousel.owlCarousel({
            loop: true,
            margin: 20,
            nav: true,
            dots: true,
            smartSpeed: 1200,
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
    }
  })();

  // ============================================
  // 6. LAZY LOAD IMAGES (data-src)
  // ============================================
  (function initLazyLoad() {
    const lazyImages = document.querySelectorAll("img.lazy-load");

    if ("IntersectionObserver" in window) {
      const imageObserver = new IntersectionObserver(function (entries) {
        entries.forEach(function (entry) {
          if (entry.isIntersecting) {
            const img = entry.target;
            img.src = img.dataset.src;
            img.classList.remove("lazy-load");
            imageObserver.unobserve(img);
          }
        });
      });

      lazyImages.forEach(function (img) {
        imageObserver.observe(img);
      });
    } else {
      // Fallback для старых браузеров
      lazyImages.forEach(function (img) {
        img.src = img.dataset.src;
      });
    }
  })();

  // ============================================
  // 7. VIDEO FADE-IN ON LOAD
  // ============================================
  (function initVideoFade() {
    const video = document.querySelector(".hero-video");

    if (video) {
      // Показываем видео, когда данные загружены
      video.addEventListener("loadeddata", function () {
        this.classList.add("show");
      });

      // Если видео уже загружено (например, из кеша)
      if (video.readyState >= 3) {
        video.classList.add("show");
      }
    }
  })();
});
