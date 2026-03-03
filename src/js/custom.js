/**
 * Sail Energy - Custom JavaScript
 * @version 3.0.0
 */

(function ($) {
  "use strict";

  $(document).ready(function () {
    // Common
    initGalleryLightbox();
    initLikeButtons();
    initFilters();
    initCategoryTabs();
    initGalleryThumbs();
    initCalculator();
    initRelatedCarousel();
    initTermsNavigation();
    initAccountTabs();
    initPaymentMethods();
    initSearchFilters();
    initComparison();
    initInstructorTabs();
    initYachtCalendar();
    initFaqSearch();
    initFaqCategories();

    // Page specific
    if ($(".catalog-page").length) {
      initCatalogFilters();
    }

    if ($(".product-page").length) {
      initProductGallery();
      initProductTabs();
    }

    if ($(".account-page").length) {
      initAccountForms();
    }
  });

  /* ============================================================================
     01. Gallery Lightbox
     ============================================================================ */

  function initGalleryLightbox() {
    const galleryItems = document.querySelectorAll(".gallery-item");

    galleryItems.forEach((item) => {
      item.addEventListener("click", function (e) {
        e.preventDefault();

        const imgSrc = this.querySelector("img")?.src;
        if (!imgSrc) return;

        const lightbox = document.createElement("div");
        lightbox.className = "lightbox";
        lightbox.innerHTML = `
          <img src="${imgSrc}" style="max-width: 90%; max-height: 90%; object-fit: contain;">
          <button class="lightbox-close">&times;</button>
        `;

        document.body.appendChild(lightbox);

        lightbox.addEventListener("click", function (e) {
          if (e.target === lightbox || e.target.classList.contains("lightbox-close")) {
            document.body.removeChild(lightbox);
          }
        });
      });
    });
  }

  /* ============================================================================
     02. Like Buttons
     ============================================================================ */

  function initLikeButtons() {
    $(".review-like-btn").on("click", function () {
      const $btn = $(this);
      const $count = $btn.find(".like-count");
      let currentCount = parseInt($count.text());

      if ($btn.hasClass("liked")) {
        $btn.removeClass("liked").addClass("btn-outline-secondary");
        $count.text(currentCount - 1);
      } else {
        $btn.removeClass("btn-outline-secondary").addClass("liked");
        $count.text(currentCount + 1);
      }
    });
  }

  /* ============================================================================
     03. Filters
     ============================================================================ */

  function initFilters() {
    // Toggle filters on mobile
    $(".filters-title").on("click", function () {
      $(this).toggleClass("active");
      $(".filters-content").slideToggle();
    });

    // Remove filter tags
    $(".filter-tag i").on("click", function () {
      $(this).parent().remove();
    });
  }

  /* ============================================================================
     04. Category Tabs
     ============================================================================ */

  function initCategoryTabs() {
    $(".category-tab").on("click", function () {
      $(".category-tab").removeClass("active");
      $(this).addClass("active");
      // Здесь будет AJAX фильтрация
    });
  }

  /* ============================================================================
     05. Gallery Thumbs
     ============================================================================ */

  function initGalleryThumbs() {
    window.changeGalleryImage = function (thumb) {
      const mainImg = document.getElementById("galleryMain")?.querySelector("img");
      const thumbImg = thumb.querySelector("img");
      if (mainImg && thumbImg) {
        mainImg.src = thumbImg.src;

        document.querySelectorAll(".gallery-thumb").forEach((el) => {
          el.classList.remove("active");
        });
        thumb.classList.add("active");
      }
    };
  }

  /* ============================================================================
     06. Calculator
     ============================================================================ */

  function initCalculator() {
    $("#participants, #accommodation").on("change", function () {
      const participants = parseInt($("#participants").val()) || 1;
      const accommodation = $("#accommodation").val();
      const basePrice = 2400;

      let total = basePrice * participants;

      if (accommodation === "single") {
        total = total * 1.3;
      }

      $("#totalPrice").text(total.toLocaleString() + " €");
    });
  }

  /* ============================================================================
     07. Related Carousel
     ============================================================================ */

  function initRelatedCarousel() {
    $(".related-carousel").owlCarousel({
      loop: true,
      margin: 20,
      nav: true,
      dots: false,
      responsive: {
        0: { items: 1 },
        576: { items: 2 },
        992: { items: 3 },
      },
    });
  }

  /* ============================================================================
     08. Terms Navigation
     ============================================================================ */

  function initTermsNavigation() {
    // Smooth scroll for navigation
    $(".terms-nav-link, #mobileNav").on("click", function (e) {
      e.preventDefault();
      const target = $(this).attr("href");
      if (target && target.startsWith("#")) {
        const offset = $(".header").height() + 20;
        $("html, body").animate(
          {
            scrollTop: $(target).offset().top - offset,
          },
          500,
        );
      }
    });

    // Mobile navigation
    $("#mobileNav").on("change", function () {
      const target = $(this).val();
      if (target) {
        const offset = $(".header").height() + 20;
        $("html, body").animate(
          {
            scrollTop: $(target).offset().top - offset,
          },
          500,
        );
      }
    });

    // Active nav item on scroll
    $(window).on("scroll", function () {
      const scrollPos = $(document).scrollTop();
      const offset = $(".header").height() + 50;

      $(".terms-section").each(function () {
        const currLink = $(this);
        const refElement = $(currLink.attr("href"));
        if (refElement.length) {
          const refTop = refElement.offset().top - offset;
          if (refTop <= scrollPos && refTop + refElement.height() > scrollPos) {
            $(".terms-nav-link").removeClass("active");
            $('.terms-nav-link[href="#' + currLink.attr("id") + '"]').addClass("active");
          }
        }
      });
    });
  }

  /* ============================================================================
     09. Account Tabs
     ============================================================================ */

  function initAccountTabs() {
    $(".account-tab").on("click", function () {
      const tabId = $(this).data("tab");

      $(".account-tab").removeClass("active");
      $(this).addClass("active");

      $(".tab-pane").removeClass("active");
      $("#" + tabId).addClass("active");
    });
  }

  /* ============================================================================
     10. Payment Methods
     ============================================================================ */

  function initPaymentMethods() {
    $(".payment-method").on("click", function () {
      $(".payment-method").removeClass("active");
      $(this).addClass("active");
    });

    // Format card number
    $('input[placeholder="1234 5678 9012 3456"]').on("input", function () {
      let value = $(this).val().replace(/\D/g, "");
      let formatted = "";
      for (let i = 0; i < value.length; i++) {
        if (i > 0 && i % 4 === 0) {
          formatted += " ";
        }
        formatted += value[i];
      }
      $(this).val(formatted);
    });

    // Format expiry date
    $('input[placeholder="MM/YY"]').on("input", function () {
      let value = $(this).val().replace(/\D/g, "");
      if (value.length >= 2) {
        $(this).val(value.substring(0, 2) + "/" + value.substring(2, 4));
      }
    });
  }

  /* ============================================================================
     11. Search Filters
     ============================================================================ */

  function initSearchFilters() {
    $(".filter-tab").on("click", function () {
      $(".filter-tab").removeClass("active");
      $(this).addClass("active");
      // Здесь будет AJAX фильтрация результатов
    });
  }

  /* ============================================================================
     12. Comparison
     ============================================================================ */

  function initComparison() {
    $("#addCourse").on("click", function () {
      alert("Добавление третьего курса в разработке");
    });

    $("#course1, #course2").on("change", function () {
      // Здесь будет AJAX загрузка данных
      console.log("Обновление сравнения...");
    });
  }

  /* ============================================================================
     13. Instructor Tabs
     ============================================================================ */

  function initInstructorTabs() {
    $(".instructor-tab").on("click", function () {
      const tabId = $(this).data("tab");

      $(".instructor-tab").removeClass("active");
      $(this).addClass("active");

      $(".tab-pane").removeClass("active");
      $("#" + tabId).addClass("active");
    });
  }

  /* ============================================================================
     14. Yacht Calendar
     ============================================================================ */

  function initYachtCalendar() {
    // Calendar navigation
    $(".calendar-nav button").on("click", function () {
      // Здесь будет переключение месяца
    });
  }

  /* ============================================================================
     15. FAQ Search
     ============================================================================ */

  function initFaqSearch() {
    $(".faq-search-input").on("input", function () {
      const searchTerm = $(this).val().toLowerCase();

      $(".accordion-item").each(function () {
        const question = $(this).find(".accordion-button").text().toLowerCase();
        const answer = $(this).find(".accordion-body").text().toLowerCase();

        if (question.includes(searchTerm) || answer.includes(searchTerm)) {
          $(this).show();
        } else {
          $(this).hide();
        }
      });
    });
  }

  /* ============================================================================
     16. FAQ Categories
     ============================================================================ */

  function initFaqCategories() {
    $(".faq-category-btn").on("click", function () {
      const category = $(this).data("category");

      $(".faq-category-btn").removeClass("active");
      $(this).addClass("active");

      if (category === "all") {
        $(".faq-section").show();
      } else {
        $(".faq-section").each(function () {
          if ($(this).data("category") === category) {
            $(this).show();
          } else {
            $(this).hide();
          }
        });
      }
    });
  }

  /* ============================================================================
     17. Catalog Filters
     ============================================================================ */

  function initCatalogFilters() {
    // Здесь будет логика для каталога
  }

  /* ============================================================================
     18. Product Gallery
     ============================================================================ */

  function initProductGallery() {
    // Здесь будет логика для галереи товара
  }

  /* ============================================================================
     19. Product Tabs
     ============================================================================ */

  function initProductTabs() {
    // Здесь будет логика для табов товара
  }

  /* ============================================================================
     20. Account Forms
     ============================================================================ */

  function initAccountForms() {
    // Здесь будет логика для форм в личном кабинете
  }
})(jQuery);
