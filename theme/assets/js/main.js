/* --- HEADER SCROLL EFFECT --- */
document.addEventListener("DOMContentLoaded", function () {
  const navbar = document.querySelector(".navbar");

  if (navbar) {
    window.addEventListener("scroll", function () {
      if (window.scrollY > 50) {
        navbar.classList.add("navbar-shrink");
      } else {
        navbar.classList.remove("navbar-shrink");
      }
    });
  }
});

/* --- SEARCH TOGGLE --- */
document.addEventListener("DOMContentLoaded", function () {
  const searchToggle = document.querySelector(".search-toggle");
  const searchForm = document.querySelector(".search-form");
  const searchClose = document.querySelector(".search-close");

  if (searchToggle && searchForm) {
    searchToggle.addEventListener("click", function (e) {
      e.stopPropagation();
      searchForm.classList.toggle("active");
      const input = searchForm.querySelector("input");
      if (input && searchForm.classList.contains("active")) {
        setTimeout(() => input.focus(), 100);
      }
    });

    const closeSearch = function () {
      searchForm.classList.remove("active");
    };

    if (searchClose) {
      searchClose.addEventListener("click", closeSearch);
    }

    document.addEventListener("click", function (e) {
      if (!searchForm.contains(e.target) && e.target !== searchToggle) {
        closeSearch();
      }
    });

    document.addEventListener("keydown", function (e) {
      if (e.key === "Escape") {
        closeSearch();
      }
    });
  }
});

/* --- AOS ANIMATIONS --- */
document.addEventListener("DOMContentLoaded", function () {
  if (typeof AOS !== "undefined") {
    AOS.init({
      duration: 800,
      once: true,
    });
  }
});

/* --- TEAM CAROUSEL (Owl Carousel) --- */
document.addEventListener("DOMContentLoaded", function () {
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
          smartSpeed: 500,
          navText: [
            '<i class="fas fa-chevron-left"></i>',
            '<i class="fas fa-chevron-right"></i>',
          ],
          responsive: {
            0: { items: 1 },
            576: { items: 2 },
            992: { items: 4 },
          },
        });
      }
    });
  }
});

/* --- СКРОЛЛ ПО ССЫЛКАМ --- */
document.addEventListener("DOMContentLoaded", function () {
  document.querySelectorAll('a[href^="#"]').forEach((anchor) => {
    anchor.addEventListener("click", function (e) {
      const target = document.querySelector(this.getAttribute("href"));
      if (target) {
        e.preventDefault();
        const headerOffset = 100;
        const elementPosition = target.getBoundingClientRect().top;
        const offsetPosition =
          elementPosition + window.pageYOffset - headerOffset;
        window.scrollTo({
          top: offsetPosition,
          behavior: "smooth",
        });
      }
    });
  });
});
